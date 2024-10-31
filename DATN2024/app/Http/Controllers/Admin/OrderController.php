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

        // Lọc theo trạng thái 
        if ($request->has('status')) {
            $orders = $orders->where('status_order_id', $request->input('status'));
        }

        $result = $orders->map(function ($order) {
            return [
                'order_id' => $order->id,
                'code' => $order->code,
                'user_name' => $order->user_name,
                'status_order' => $order->statusOrder->name ?? 'Unknown', 
                'status_payment' => $order->statusPayment->name ?? 'Unknown', 
                'total_price' => $order->total_price,
                'orderItems' => $order->orderItems->map(function ($orderItems) {
                    return [
                        'product_name' => $orderItems->product_name,
                        'product_img_thumbnail' => $orderItems->product_img_thumbnail,
                        'product_price' => $orderItems->product_price_regular,
                        'quantity' => $orderItems->quantity,
                    ];
                }),
            ];
        });

        return response()->json($result);
    }

     // Xem chi tiết đơn hàng
    public function show(Order $order)
    {
        $order->load('orderItems', 'statusOrder', 'statusPayment');

        return response()->json($order);
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status_order_id' => 'required|exists:status_orders,id',
        ]);

        if ($order->status_order_id == 2) {// Id status huỷ
            return response()->json(['error' => 'Cannot update status. This order has been cancelled.'], 400);
        }

        $currentStatusId = $order->status_order_id;
        $newStatusId = $request->input('status_order_id');

        $statusOrderIds = StatusOrder::pluck('id')->toArray();

        if (array_search($newStatusId, $statusOrderIds) <= array_search($currentStatusId, $statusOrderIds)) {
            return response()->json(['error' => 'You can only update your status.'], 400);
        }

        $order->update(['status_order_id' => $newStatusId]);

        return response()->json(['message' => 'Order status has been updated.']);
    }

}
