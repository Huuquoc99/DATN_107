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
    
        if ($timeElapsed !== null && $timeElapsed <= 1) {
            return false; 
        }
    }
    
    


    return in_array($status->id, $allowedTransitions[$currentStatus] ?? []);
}


    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status_order_id' => [
                'required',
                'exists:status_orders,id',
                function ($attribute, $value, $fail) use ($order) {
                    $currentStatus = $order->status_order_id;

                    $allowedTransitions = [
                        1 => [2, 6], 
                        2 => [3, 6], 
                        3 => [4],    
                        4 => [5],     
                        5 => [],     
                        6 => [],
                    ];

                    if ($currentStatus == 4 && $value == 5) {
                        $lastUpdated = $order->updated_at;
                        $timeElapsed = $lastUpdated ? now()->diffInMinutes($lastUpdated) : null;

                        if ($timeElapsed !== null && $timeElapsed <= 1) {
                            $fail('Cannot change status to Canceled within 10 minutes of success.');
                        }
                    }


                    if (!in_array($value, $allowedTransitions[$currentStatus] ?? [])) {
                        $fail('The status transition is not allowed.');
                    }

                
                    
                }
            ]
        ]);
        $newStatusId = $request->input('status_order_id');

        if ($newStatusId != $order->status_order_id) {
            $order->status_order_id = $newStatusId;
            $order->touch(); 
            $order->save();

            $recipientEmail = $order->user ? $order->user->email : $order->ship_user_email;

            if ($newStatusId == 6) {
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
        if ($currentStatusId == 2 && $newPaymentStatusId == 1) {
            return redirect()->route('admin.orders.show', $id)
                ->with('error', 'Cannot revert to previous payment status.');
        }

        if ($newPaymentStatusId != $currentStatusId) {
            $order->status_payment_id = $newPaymentStatusId;
            $order->save();

            return redirect()->route('admin.orders.show', $id)
                ->with('success1', 'Payment status updated successfully.');
        }

        return redirect()->route('admin.orders.show', $id)
            ->with('error1', 'No change in payment status.');
    }

}


