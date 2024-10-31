<?php

namespace App\Http\Controllers\Client;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        
        $orders = Auth::user()->orders->map(function ($order) {
            return [
                'id' => $order->id,
                'code' => $order->code,
                'created_at' => $order->created_at,
                'status_order' => $order->statusOrder->name,
                'status_payment' => $order->statusPayment->name, 
                'total' => $order->total_price, 
            ];
        });

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'Bạn chưa có đơn hàng nào.'], 200);
        }

        return response()->json($orders, 201);
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized action.'], 403);
        }
        // $orderWithItems = $order->load('orderItems');

        $orderWithItems = $order->load([
            'orderItems:id,order_id,product_variant_id,quantity,product_name,product_sku,product_img_thumbnail,variant_capacity_name,variant_color_name',
            'statusOrder:id,name', 
            'statusPayment:id,name', 
        ]);

        $response = [
            'id' => $orderWithItems->id,
            'code' => $orderWithItems->code,
            'user_name' => $orderWithItems->user_name,
            'user_email' => $orderWithItems->user_email,
            'user_phone' => $orderWithItems->user_phone,
            'user_address' => $orderWithItems->user_address,
            'user_note' => $orderWithItems->user_note,
            'ship_user_name' => $orderWithItems->ship_user_name,
            'ship_user_email' => $orderWithItems->ship_user_email,
            'ship_user_phone' => $orderWithItems->ship_user_phone,
            'ship_user_address' => $orderWithItems->ship_user_address,
            'ship_user_note' => $orderWithItems->ship_user_note,
            'status_order' => $orderWithItems->statusOrder->name ?? null, 
            'status_payment' => $orderWithItems->statusPayment->name ?? null, 
            'total_price' => $orderWithItems->total_price,
            'created_at' => $orderWithItems->created_at,
            'order_items' => $orderWithItems->orderItems, 
        ];
    
        return response()->json($response);

    }
}
