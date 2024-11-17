<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\StatusOrder;
use App\Mail\OrderCancelled;
use Illuminate\Http\Request;
use App\Mail\AdminOrderUpdated;
use App\Mail\AdminOrderCancelled;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // $statusOrders = StatusOrder::all();
        $orders = Order::with('user', 'statusOrder', 'statusPayment', 'orderItems')->orderBy('created_at', 'desc');

        if ($request->has('status')) {
            $orders->where('status_order_id', $request->input('status'));
        }

        $orders = $orders->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {

        $order->load('orderItems.product', 'statusOrder', 'statusPayment'); 
        $statusOrders = StatusOrder::all(); 
    
        return view('admin.orders.show', compact('order', 'statusOrders'));
    }
    


    // public function updateStatus(Request $request, $id)
    // {
    //     $order = Order::findOrFail($id);

    //     $newStatusId = $request->input('status_order_id');

    //     if ($newStatusId > $order->status_order_id) {
    //         $order->status_order_id = $newStatusId;
    //         $order->save();

    //         Mail::to($order->user->email)->send(new AdminOrderCancelled($order));
    //         return redirect()->route('admin.orders.show', $id)->with('success', 'Order status updated successfully.');
    //     } else {
    //         return redirect()->route('admin.orders.show', $id)->with('error', 'Cannot update to a lower status.');
    //     }
    // }



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
                            ->with('info', 'No change in order status.');
        }
    }

    
    

}
