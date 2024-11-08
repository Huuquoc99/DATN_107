<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\StatusOrder;
use App\Mail\OrderCancelled;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AdminOrderCancelled;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('user', 'statusOrder', 'statusPayment', 'orderItems')->get();

        if ($request->has('status')) {
            $orders = $orders->where('status_order_id', $request->input('status'));
        }

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {

        $order->load('orderItems.product', 'statusOrder', 'statusPayment'); 
        $statusOrders = StatusOrder::all(); 
    
        return view('admin.orders.show', compact('order', 'statusOrders'));
    }
    


    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $newStatusId = $request->input('status_order_id');

        if ($newStatusId > $order->status_order_id) {
            $order->status_order_id = $newStatusId;
            $order->save();

            Mail::to($order->user->email)->send(new AdminOrderCancelled($order));
            return redirect()->route('admin.orders.show', $id)->with('success', 'Order status updated successfully.');
        } else {
            return redirect()->route('admin.orders.show', $id)->with('error', 'Cannot update to a lower status.');
        }
    }


    
    

}
