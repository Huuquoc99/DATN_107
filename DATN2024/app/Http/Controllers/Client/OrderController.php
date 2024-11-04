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

        // return response()->json($orders, 201);
        return view('client.history', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    
        // Tải thông tin đơn hàng và các mục trong đơn hàng
        $orderWithItems = $order->load([
            'orderItems:id,order_id,product_variant_id,quantity,product_name,product_sku,product_img_thumbnail',
            'statusOrder:id,name', 
            'statusPayment:id,name', 
        ]);
    
        return view('client.orderdetails', compact('orderWithItems'));
    }
    

    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized action.'], 403);
        }

        if ($order->status_order_id === 1) {
            $order->status_order_id = 2; // sửa lại thành id của cancel
            $order->save();
            return response()->json(['success' => 'Order cancelled successfully.']);
        }

        return response()->json(['error' => 'Order cannot be cancelled.'], 400);
    }
}
