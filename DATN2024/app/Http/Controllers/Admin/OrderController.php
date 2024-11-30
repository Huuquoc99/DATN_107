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
        // Xử lý notification (nếu có)
        if (!empty(request()->get('noti'))) {
            $notification = AdminNotification::find(request()->get('noti'));
            $notification->read_at = now();
            $notification->save();

            broadcast(new \App\Events\AdminNotification(
                \App\Models\AdminNotification::unread()->count()
            ));
        }

        // Nạp các mối quan hệ
        $order->load('orderItems.product', 'statusOrder', 'statusPayment');

        $statusOrders = StatusOrder::all()->map(function ($status) use ($order) {
            $status->is_disabled = $this->checkStatusSelectable($status, $order);
            return $status;
        });

        $statusPayments = StatusPayment::all();

        // Trả về view
        return view('admin.orders.show', compact('order', 'statusOrders', 'statusPayments'));
    }

    protected function checkStatusSelectable($status, $order)
    {
        $currentStatus = $order->status_order_id;

        $allowedTransitions = [
            1 => [ // Pending
                2, // Confirmed
                5,
            ],
            2 => [ // Confirmed
                3, // Shipping
                4,
                5,
            ],
            3 => [ // Shipping
                4, // Success
            ],
            4 => [ // Delivered
                //Không thể Canceled và các bước trước
            ],
            5 => [ // Canceled
                // Không chuyển được nữa
            ],
//            6 => [ // Nếu success ở đây thì sẽ cũng không chuyển được
//                // Không chuyển được nữa
//            ]
        ];

        // Trạng thái hiện tại luôn được chọn
        if ($status->id == $currentStatus) {
            return false;
        }

        // Kiểm tra xem trạng thái có được phép chuyển không
        return !in_array($status->id, $allowedTransitions[$currentStatus] ?? []);
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

                    // Define allowed transitions
                    $allowedTransitions = [
                        1 => [2, 5],    // Pending: Confirmed, Canceled
                        2 => [3, 4, 5], // Confirmed: Shipping, Canceled
                        3 => [4],       // Shipping: Delivered
                        4 => [],        // Success: No changes allowed
                        5 => [],        // Canceled: No changes allowed
                    ];

                    if (!in_array($value, $allowedTransitions[$currentStatus] ?? [])) {
                        $fail('The status transition is not allowed.');
                    }
                }
            ]
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Order status update failed due to invalid data.');
        }

        $newStatusId = $request->input('status_order_id');

        if ($newStatusId != $order->status_order_id) {
            $order->status_order_id = $newStatusId;
            $order->save();

            $recipientEmail = $order->user ? $order->user->email : $order->ship_user_email;

            if ($newStatusId == 5) { // Trạng thái hủy đơn
                $this->rollbackQuantity($order);
                Mail::to($recipientEmail)->send(new AdminOrderCancelled($order));
            } else {
                Mail::to($recipientEmail)->send(new AdminOrderUpdated($order));
            }

            return redirect()->route('admin.orders.show', $id)
                ->with('success', 'Order status updated successfully.');
        } else {
            return redirect()->route('admin.orders.show', $id)
                ->with('error', 'No change in order status.');
        }
    }

    private function rollbackQuantity($order)
    {
        foreach ($order->orderItems as $item) {
            $item->productVariant->quantity += $item->quantity;
            $item->productVariant->save();
        }}

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

}


