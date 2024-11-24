<?php

namespace App\Http\Controllers\Client;

use App\Models\Order;
use App\Mail\OrderPlaced;
use App\Models\StatusOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\OrderCancelled;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    // {

    //     $orders = Auth::user()->orders->map(function ($order) {
    //         return [
    //             'id' => $order->id,
    //             'code' => $order->code,
    //             'created_at' => $order->created_at,
    //             'status_order_id' => $order->statusOrder->id, 
    //             'status_order_name' => $order->statusOrder->name, 
    //             'status_payment' => $order->statusPayment->name,
    //             'total_price' => $order->total_price,
    //         ];
    //     });

    //     if ($orders->isEmpty()) {
    //         return response()->json(['message' => 'Bạn chưa có đơn hàng nào.'], 200);
    //     }

    //     // return response()->json($orders, 201);
    //     return view('client.account.history', compact('orders'));
    // }

    // public function index()
    // {
    //     // Không được xoá mặc dù nó đỏ
    //     $orders = Auth::user()->orders()
    //         ->with(['statusOrder', 'statusPayment'])
    //         ->latest() 
    //         ->paginate(7); 

    //     $mappedOrders = $orders->getCollection()->map(function ($order) {
    //         return [
    //             'id' => $order->id,
    //             'code' => $order->code,
    //             'created_at' => $order->created_at,
    //             'status_order_id' => $order->statusOrder->id,
    //             'status_order_name' => $order->statusOrder->name,
    //             'status_payment' => $order->statusPayment->name,
    //             'total_price' => $order->total_price,
    //         ];
    //     });

    //     $orders->setCollection(collect($mappedOrders));

    //     if ($orders->isEmpty()) {
    //         $message = 'Bạn chưa có đơn hàng nào.';
    //         return view('client.account.history', compact('message', 'orders'));
    //     }

    //     return view('client.account.history', compact('orders'));
    // }

//     public function index(Request $request)
// {
//     $statusFilter = $request->input('status_order', 'all');
//     $query = Auth::user()->orders()->with(['statusOrder', 'statusPayment']);

//     // Lọc theo trạng thái nếu không chọn "All"
//     if ($statusFilter !== 'all') {
//         $query->where('status_order_id', $statusFilter);
//     }

//     $orders = $query->latest()->paginate(7);

//     $mappedOrders = $orders->getCollection()->map(function ($order) {
//         return [
//             'id' => $order->id,
//             'code' => $order->code,
//             'created_at' => $order->created_at,
//             'status_order_id' => $order->statusOrder->id,
//             'status_order_name' => $order->statusOrder->name,
//             'status_payment' => $order->statusPayment->name,
//             'total_price' => $order->total_price,
//         ];
//     });

//     $orders->setCollection(collect($mappedOrders));

//     // Lấy danh sách trạng thái đơn hàng
//     $statusOrders = \App\Models\StatusOrder::all();

//     $message = $orders->isEmpty() ? 'Bạn chưa có đơn hàng nào.' : null;

//     return view('client.account.history', compact('orders', 'statusOrders', 'statusFilter', 'message'));
// }

    public function index(Request $request)
    {
        $statusFilter = $request->input('status_order', 'all');
        $query = Auth::user()->orders()->with(['statusOrder', 'statusPayment']);

        if ($statusFilter !== 'all') {
            $query->where('status_order_id', $statusFilter);
        }

        $orders = $query->latest()->paginate(7);
        $mappedOrders = $orders->getCollection()->map(function ($order) {
            return [
                'id' => $order->id,
                'code' => $order->code,
                'created_at' => $order->created_at,
                'status_order_id' => $order->statusOrder->id,
                'status_order_name' => $order->statusOrder->name,
                'status_payment' => $order->statusPayment->name,
                'total_price' => $order->total_price,
            ];
        });

        $orders->setCollection(collect($mappedOrders));
        $statusOrders = StatusOrder::all();
        $message = $orders->isEmpty() ? 'Bạn chưa có đơn hàng nào.' : null;

        return view('client.account.history', compact('orders', 'statusOrders', 'statusFilter', 'message'));
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
        return view('client.account.orderdetails', [
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

            $this->rollbackQuantity($order);

            Mail::to(Auth::user()->email)->send(new OrderCancelled($order));
            return redirect()->back()->with('success', 'Đơn hàng đã được hủy.');
        }

        return redirect()->back()->with('error', 'Không thể hủy đơn hàng.');
    }

    private function rollbackQuantity($order)
    {
        foreach ($order->orderItems as $item) {
            $item->productVariant->quantity += $item->quantity;
            $item->productVariant->save();
        }
    }


    public function markAsReceived(Order $order)
    {

        if ($order->status_order_id == 2) {
            $order->status_order_id = 3;
            $order->save();

            Mail::to(Auth::user()->email)->send(new OrderPlaced($order));
            return redirect()->back()->with('success', 'Đơn hàng đã được cập nhật thành hoàn thành.');
        }

        return redirect()->back()->with('error', 'Không thể cập nhật trạng thái đơn hàng.');
    }
}
