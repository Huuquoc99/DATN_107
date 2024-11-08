<?php

namespace App\Http\Controllers\Client;

use App\Models\Order;
use App\Mail\OrderPlaced;
use App\Models\StatusOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('orders.index')->with('error', 'Unauthorized action.');
        }

        $orderWithItems = $order->load([
            'orderItems',
            'statusOrder:id,name',
            'statusPayment:id,name',
            'paymentMethod:id,name',
        ]);
        $statusOrders = StatusOrder::all();
        return view('client.orderdetails', [
            'order' => $orderWithItems,
            'statusOrders' => $statusOrders,
        ]);
    }


    public function getStatusHistory($orderId)
    {
        $order = Order::find($orderId);
        if ($order) {
            return response()->json(['history' => json_decode($order->history)]);
        }
        return response()->json(['message' => 'Không tìm thấy đơn hàng.'], 404);
    }

    public function updateStatus(Request $request, $orderId)
    {
        $order = Order::find($orderId);
        $statusId = $request->status_order_id;

        $status = StatusOrder::find($statusId);
        if ($order && $status) {
            $history = json_decode($order->history, true) ?? [];
            $history[] = [
                'status_order_id' => $statusId,
                'updated_at' => now()
            ];
            $order->history = json_encode($history);

            $order->status_order_id = $statusId;
            $order->save();

            return redirect()->route('account.orders.show', $order->id)
                ->with('success', 'Order status has been updated.');
        }
        return redirect()->route('account.orders.show', $order->id)
            ->with('error', 'Order status is invalid or not found.');
    }


    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status_order_id == 1) {
            $order->status_order_id = 4;
            $order->save();

            Mail::to(Auth::user()->user_email)->send(new OrderPlaced($order));
            return redirect()->back()->with('success', 'Đơn hàng đã được hủy.');
        }

        return redirect()->back()->with('error', 'Không thể hủy đơn hàng.');
    }


    public function markAsReceived(Order $order)
    {

        if ($order->status_order_id == 2) {
            $order->status_order_id = 3;
            $order->save();

            Mail::to(Auth::user()->user_email)->send(new OrderPlaced($order));
            return redirect()->back()->with('success', 'Đơn hàng đã được cập nhật thành hoàn thành.');
        }

        return redirect()->back()->with('error', 'Không thể cập nhật trạng thái đơn hàng.');
    }
}
