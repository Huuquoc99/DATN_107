<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminNotification;
use App\Models\Order;
use App\Models\OrderStatusLog;
use App\Models\StatusOrder;
use App\Mail\OrderCancelled;
use Illuminate\Http\Request;
use App\Mail\AdminOrderUpdated;
use App\Mail\AdminOrderCancelled;
use App\Http\Controllers\Controller;
use App\Models\StatusPayment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $orders = Order::with('user', 'statusOrder', 'statusPayment', 'orderItems')->orderBy('created_at', 'desc');

        if ($request->ajax()) {
            $status = $request->input('status');
            $search = $request->input('search');
            $date = $request->input('date');

            if (isset($status)) {
                $orders->where('status_order_id', $status);
            }
            if (isset($search)) {
                $orders->where(function ($query) use ($search) {
                    $query->where('user_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('code', 'LIKE', '%' . $search . '%')
                        ->orWhere('user_email', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('statusOrder', function ($q) use ($search) {
                            $q->where('name', 'LIKE', '%' . $search . '%');
                        })
                        ->orWhereHas('statusPayment', function ($q) use ($search) {
                            $q->where('name', 'LIKE', '%' . $search . '%');
                        });
                });
            }

            if (isset($date)) {
                $orders->whereDate('created_at', $date);
            }
            $orders = $orders->paginate(10);
            return view('admin.orders.data', compact('orders', ));
        }
        $orderStatuses = StatusOrder::all();
        $statusPayments  = StatusPayment::all();
        $orders = $orders->paginate(10);

        return view('admin.orders.index', compact('orders', 'orderStatuses', 'statusPayments'));
    }


    public function show(Order $order)
    {
        $statusLogs = OrderStatusLog::where('loggable_type', Order::class)
            ->where('loggable_id', $order->id)
            ->with(['loggable', 'changedBy'])
            ->orderBy('created_at', 'asc')
            ->get();


        if (!empty(request()->get('noti'))) {
            $notification = AdminNotification::find(request()->get('noti'));
            $notification->read_at = now();
            $notification->save();

            broadcast(new \App\Events\AdminNotification(
                \App\Models\AdminNotification::unread()->count()
            ));
        }

        $order->load('orderItems.product', 'statusOrder', 'statusPayment');

        $statusOrders = StatusOrder::all()->map(function ($status) use ($order) {
            $status->is_disabled = $this->checkStatusSelectable($status, $order);
            return $status;
        });

        $statusPayments = StatusPayment::all();

        return view('admin.orders.show', compact('order', 'statusOrders', 'statusPayments','statusLogs'));
    }


    protected function checkStatusSelectable($status, $order)
    {
        $currentStatus = $order->status_order_id;

        $allowedTransitions = [
            1 => [3, 4, 5],
            2 => [1, 4, 5],
            3 => [1, 2, 5, 6],
            4 => [1, 2, 3, 6],
            5 => [1, 2, 3, 4, 6],
            6 => [1, 2, 3, 4, 5],
        ];


        if ($status->id == $currentStatus) {
            return false;
        }

        if ($currentStatus == 4 && $status->id == 5) {
            $lastUpdated = $order->updated_at;
            $timeElapsed = $lastUpdated ? now()->diffInMinutes($lastUpdated) : null;

            if ($timeElapsed !== null && $timeElapsed <= 4320) {
                return false;
            }
        }

        return in_array($status->id, $allowedTransitions[$currentStatus] ?? []);
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
//
//        \Log::info('Before Status Change', [
//            'current_status' => $order->status_order_id
//        ]);
//
//        $statusHistory = $order->statusChanges()->get();
//
////        dd($statusHistory);

        $validator = Validator::make($request->all(), [
            'status_order_id' => [
                'required',
                'exists:status_orders,id',
                function ($attribute, $value, $fail) use ($order) {
                    $currentStatus = $order->status_order_id;

                    $allowedTransitions = [
                        1 => [2, 6],
                        2 => [3, 6],
                        3 => [3, 4],
                        4 => [5],
                        5 => [5],
                        6 => [6],
                    ];

                    if (!in_array($value, $allowedTransitions[$currentStatus] ?? [])) {
                        $fail('Không được phép chuyển đổi trạng thái.');
                    }

                   if ($currentStatus == 4 && $value == 5) {
                       $lastUpdated = $order->updated_at;
                       $timeElapsed = $lastUpdated ? now()->diffInMinutes($lastUpdated) : null;

                       if ($timeElapsed !== null && $timeElapsed <= 4320) {
                           $fail('Không thể thay đổi trạng thái thành Đã hủy trong vòng 10 phút sau khi thành công.');
                       }
                   }

                    if ($order->status_payment_id == '3' && !in_array($value, [6])) {
                        $fail('Không thể cập nhật đơn hàng vì thanh toán không thành công. Chỉ được phép hủy bỏ.');
                    }

                }
            ]
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->all() as $error) {
                toastr()->error($error);
            }

            return redirect()->route('admin.orders.show', $id)
                ->withInput();
        }

        $newStatusId = $request->input('status_order_id');

        if ($newStatusId != $order->status_order_id) {
            $order->status_order_id = $newStatusId;
            $order->touch();
            $order->save();

            if ($order->payment_method_id == '1' && in_array($newStatusId, [5])) {
                $order->status_payment_id = '2';
                $order->save();
            }

            if ($newStatusId == 6) {
                $cancelReason = $request->input('cancel_reason');
                if ($request->input('cancel_reason') == 'other') {
                    $order->other_reason = $request->input('other_reason');
                }

                $order->cancel_reason = $cancelReason;
                $order->canceled_by = 'admin';
                $order->save();

                $this->rollbackQuantity($order);
                \App\Events\OrderPlaced::dispatch($order, 'admin_cancel');
            } else {
                \App\Events\OrderPlaced::dispatch($order, 'update');
            }

            return redirect()->route('admin.orders.show', $id)
                ->with('success', 'Trạng thái đơn hàng được cập nhật thành công!');
        } else {
            return redirect()->route('admin.orders.show', $id)
                ->with('error', 'Không có thay đổi về trạng thái đơn hàng.');
        }
    }




    private function rollbackQuantity($order)
    {
        foreach ($order->orderItems as $item) {
            $item->productVariant->quantity += $item->quantity;
            $item->productVariant->save();
        }
    }


    public function updatePaymentStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $newPaymentStatusId = $request->input('status_payment_id');
        $currentStatusId = $order->status_payment_id;

        $allowedTransitions = [
            1 => [],
            2 => [],
            3 => [],
        ];

        if (!in_array($newPaymentStatusId, $allowedTransitions[$currentStatusId] ?? [])) {
            return redirect()->route('admin.orders.show', $id)
                ->with('error', 'Không được phép chuyển đổi trạng thái thanh toán.');
        }

        if ($newPaymentStatusId != $currentStatusId) {
            $order->status_payment_id = $newPaymentStatusId;
            $order->save();

            return redirect()->route('admin.orders.show', $id)
                ->with('success', 'Trạng thái thanh toán đã được cập nhật thành công.');
        }

        return redirect()->route('admin.orders.show', $id)
            ->with('error', 'Không có thay đổi về trạng thái thanh toán.');
    }

}


