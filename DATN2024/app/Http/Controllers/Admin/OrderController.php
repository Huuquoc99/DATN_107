<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminNotification;
use App\Models\Order;
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

        return view('admin.orders.show', compact('order', 'statusOrders', 'statusPayments'));
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

            if ($timeElapsed !== null && $timeElapsed <= 10) {
                return false;
            }
        }

        return in_array($status->id, $allowedTransitions[$currentStatus] ?? []);
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status_order_id' => [
                'required',
                'exists:status_orders,id',
                function ($attribute, $value, $fail) use ($order) {
                    $currentStatus = $order->status_order_id;

                    $allowedTransitions = [
                        1 => [2, 6],     // Pending      -> Processing, Cancelled
                        2 => [3, 6],     // Processing   -> Shipped, Cancelled
                        3 => [3, 4],     // Shipped      -> Delivered, Canceled
                        4 => [5],        // Delivered    -> Success
                        5 => [5],        // Completed has no further transitions
                        6 => [6],        // Canceled has no further transitions
                    ];

                    if (!in_array($value, $allowedTransitions[$currentStatus] ?? [])) {
                        $fail('The status transition is not allowed.');
                    }

                    // Bổ sung quy tắc hủy đơn hàng trong vòng 10 phút kể từ khi thành công
//                    if ($currentStatus == 4 && $value == 5) {
//                        $lastUpdated = $order->updated_at;
//                        $timeElapsed = $lastUpdated ? now()->diffInMinutes($lastUpdated) : null;
//
//                        if ($timeElapsed !== null && $timeElapsed <= 10) {
//                            $fail('Cannot change status to Canceled within 10 minutes of success.');
//                        }
//                    }

                    // Kiểm tra xem thanh toán có thất bại hay không: Chỉ cho phép hủy
                    if ($order->status_payment_id == '3' && !in_array($value, [6])) { // 6 = Canceled
                        $fail('Không thể cập nhật đơn hàng vì thanh toán không thành công. Chỉ được phép hủy bỏ.');
                    }

                    // Kiểm tra xem đơn hàng có phải là COD hay không và người dùng xác nhận đã nhận là đã thanh toán
                    if ($order->payment_method_id == '1' && $value == 5) {
                        if ($order->status_order_id != '5') {
                            $fail('Không thể xác nhận đơn là "Hoàn thành" khi người dùng chưa xác nhận đơn hàng!');
                        }
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

            // Khi trạng thái đơn hàng chuyển về "Success" (5) đối với đơn hàng COD,cập nhật trạng thái thanh toán thành "Paid"
            if ($order->payment_method_id == '1' && in_array($newStatusId, [5])) {
                $order->status_payment_id = '2';
                $order->save();
            }

            if ($newStatusId == 6) { // 6 = Cancelled
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

        // Quy tắc chuyển đổi trạng thái
        $allowedTransitions = [
            1 => [2, 3], // Pending -> Paid hoặc Failed
            2 => [],     // Paid    -> Không thể thay đổi
            3 => [2],    // Failed  -> Paid (repayment)
        ];

        if (!in_array($newPaymentStatusId, $allowedTransitions[$currentStatusId] ?? [])) {
            return redirect()->route('admin.orders.show', $id)
                ->with('error', 'Payment status transition is not allowed.');
        }

        if ($newPaymentStatusId != $currentStatusId) {
            $order->status_payment_id = $newPaymentStatusId;
            $order->save();

            return redirect()->route('admin.orders.show', $id)
                ->with('success', 'Payment status updated successfully.');
        }

        return redirect()->route('admin.orders.show', $id)
            ->with('error', 'No change in payment status.');
    }

//    public function updateStatus(Request $request, $id)
//    {
//        $order = Order::findOrFail($id);
//
//        $validator = Validator::make($request->all(), [
//            'status_order_id' => [
//                'required',
//                'exists:status_orders,id',
//                function ($attribute, $value, $fail) use ($order) {
//                    $currentStatus = $order->status_order_id;
//
//                    $allowedTransitions = [
//                        1 => [2, 6],
//                        2 => [3, 6],
//                        3 => [4],
//                        4 => [5],
//                        5 => [],
//                        6 => [],
//                    ];
//
//                    if ($currentStatus == 4 && $value == 5) {
//                        $lastUpdated = $order->updated_at;
//                        $timeElapsed = $lastUpdated ? now()->diffInMinutes($lastUpdated) : null;
//
//                        if ($timeElapsed !== null && $timeElapsed < 10) {
//                            $fail('Cannot change status to Canceled within 10 minutes of success.');
//                        }
//                    }
//
//                    if (!in_array($value, $allowedTransitions[$currentStatus] ?? [])) {
//                        $fail('The status transition is not allowed.');
//                    }
//                }
//            ]
//        ]);
//
//        if ($validator->fails()) {
//            return redirect()->route('admin.orders.show', $id)
//                ->withErrors($validator)
//                ->withInput();
//        }
//
//        $newStatusId = $request->input('status_order_id');
//
//        if ($newStatusId != $order->status_order_id) {
//            $order->status_order_id = $newStatusId;
//            $order->save();
//
//            $recipientEmail = $order->user ? $order->user->email : $order->ship_user_email;
//
//            try {
//                if ($newStatusId == 6) {
//                    $this->rollbackQuantity($order);
//                    Mail::to($recipientEmail)->send(new AdminOrderCancelled($order));
//                } else {
//                    Mail::to($recipientEmail)->send(new AdminOrderUpdated($order));
//                }
//
//                return redirect()->route('admin.orders.show', $id)
//                    ->with('success', 'Order status updated successfully.');
//            } catch (\Exception $e) {
//                return redirect()->route('admin.orders.show', $id)
//                    ->with('error', 'Order status updated, but failed to send email.');
//            }
//        } else {
//            return redirect()->route('admin.orders.show', $id)
//                ->with('error', 'No change in order status.');
//        }
//    }

}


