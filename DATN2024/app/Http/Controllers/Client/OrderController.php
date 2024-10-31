<?php

namespace App\Http\Controllers\Client;

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
}
