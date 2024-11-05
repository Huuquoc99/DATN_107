<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\StatusOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status_order_id' => 'required|exists:status_orders,id',
        ]);

        if ($order->status_order_id == 4) {
            return redirect()->back()->withErrors(['error' => 'Cannot update status. This order has been cancelled.']);
        }

        $currentStatusId = $order->status_order_id;
        $newStatusId = $request->input('status_order_id');

        $statusOrderIds = StatusOrder::pluck('id')->toArray();

        if (array_search($newStatusId, $statusOrderIds) <= array_search($currentStatusId, $statusOrderIds)) {
            return redirect()->back()->withErrors(['error' => 'You can only update your status.']);
        }

        $order->update(['status_order_id' => $newStatusId]);

        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Order status has been updated.');
    }

}
