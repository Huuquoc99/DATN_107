<?php

namespace App\Http\Controllers\Admin;

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
    // public function index(Request $request)
    // {
    //     // $statusOrders = StatusOrder::all();
    //     $orders = Order::with('user', 'statusOrder', 'statusPayment', 'orderItems')->orderBy('created_at', 'desc');

    //     if ($request->has('status')) {
    //         $orders->where('status_order_id', $request->input('status'));
    //     }

    //     $orders = $orders->paginate(10);

    //     return view('admin.orders.index', compact('orders'));
    // }

    public function index(Request $request)
    {
        $orders = Order::with('user', 'statusOrder', 'statusPayment', 'orderItems')->orderBy('created_at', 'desc');

        // if ($request->has('status')) {
        //     $orders->where('status_order_id', $request->input('status'));
        // }

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
        $orders = $orders->paginate(10);

        return view('admin.orders.index', compact('orders', 'orderStatuses'));
    }

    public function show(Order $order)
    {

        $order->load('orderItems.product', 'statusOrder', 'statusPayment'); 
        $statusOrders = StatusOrder::all(); 
        $statusPayments = StatusPayment::all();
    
        return view('admin.orders.show', compact('order', 'statusOrders', "statusPayments"));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $newStatusId = $request->input('status_order_id');

        if ($newStatusId != $order->status_order_id) {
            
            $order->status_order_id = $newStatusId;
            $order->save();

            if ($newStatusId == 4) { 
                Mail::to($order->user->email)->send(new AdminOrderCancelled($order));
            } else {
                Mail::to($order->user->email)->send(new AdminOrderUpdated($order));
            }

            return redirect()->route('admin.orders.show', $id)
                            ->with('success', 'Order status updated successfully.');
        } else {
            return redirect()->route('admin.orders.show', $id)
                            ->with('error', 'No change in order status.');
        }
    }

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
