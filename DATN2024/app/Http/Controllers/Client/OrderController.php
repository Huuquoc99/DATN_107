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
                'total_price' => $order->total_price, 
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
        // Kiểm tra quyền truy cập
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('orders.index')->with('error', 'Unauthorized action.');
        }
    
        // Tải thông tin đơn hàng và các sản phẩm trong đơn hàng
        $orderWithItems = $order->load([
            'orderItems',
            'statusOrder:id,name', 
            'statusPayment:id,name',
            'paymentMethod:id,name', // Nếu có bảng payment_method để lấy tên
        ]);
    
        // Truyền dữ liệu vào view
        return view('client.orderdetails', [
            'order' => $orderWithItems
        ]);
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
