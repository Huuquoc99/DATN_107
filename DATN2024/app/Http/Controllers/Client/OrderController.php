<?php

namespace App\Http\Controllers\Client;

use App\Events\AdminNotification;
use App\Mail\AdminOrderCancelled;
use App\Mail\AdminOrderUpdated;
use App\Models\Order;
use App\Mail\OrderPlaced;
use App\Models\StatusOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\OrderCancelled;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Traits\VnPayTrait;

class OrderController extends Controller
{

    use VnPayTrait;

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
        $message = $orders->isEmpty() ? 'You have no orders yet.' : null;

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
        return response()->json(['message' => 'Order not found.'], 404);
    }


    public function cancelOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $cancelReason = $request->input('cancel_reason');

        if ($order->status_order_id == 1 || $order->status_order_id == 2) {
            $order->status_order_id = 6;

            if ($request->input('cancel_reason') == 'other') {
                $order->other_reason = $request->input('other_reason');
            }

            $order->cancel_reason = $cancelReason;

            $order->canceled_by = 'user';

            $order->save();

           $this->rollbackQuantity($order);

            $no = \App\Models\AdminNotification::create([
                'type' => 'Event\AdminNotification',
                'data' => [
                    'order' => $order,
                    'message' => 'order successfully cancelled #<b>'. $order->code .'<b>'
                ]
            ]);
            broadcast(new AdminNotification(\App\Models\AdminNotification::unread()->count()));

//            Mail::to(Auth::user()->email)->send(new OrderCancelled($order));

            \App\Events\OrderPlaced::dispatch($order, 'client_cancel');

            return redirect()->back()->with('success', 'Order has been cancelled.');
        }

        return redirect()->back()->with('error', 'Order cannot be cancelled..');
    }

    private function rollbackQuantity($order)
    {
        foreach ($order->orderItems as $item) {
            $item->productVariant->quantity += $item->quantity;
            $item->productVariant->save();
        }
    }

    public function updateStatus(Request $request, $id)
    {
        dd($request->all());
        $order = Order::findOrFail($id);

        $newStatusId = $request->input('status_order_id');

        if ($newStatusId != $order->status_order_id) {

            $order->status_order_id = $newStatusId;
            $order->save();

            if ($newStatusId == 6) {
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


    public function markAsReceived(Order $order)
    {
        try {
            if ($order->status_order_id == 4) {
                $order->status_order_id = 5;
                $order->save();

                Mail::to(Auth::user()->email)->send(new OrderPlaced($order));
                return redirect()->back()->with('success', 'The order has been updated to completed..');
            }

        } catch (\Exception $exception) {
            return redirect()->back()->with('success', 'The order has been updated to completed..');
        }
    }

    public function repayment($orderId)
    {
        $order = Order::findOrFail($orderId);
        if (
            ($order->status_payment_id == 1 || $order->status_payment_id == 3)
            && $order->status_order_id == 1
            && $order->payment_method_id == 2
        ){
            $this->processVNPAY($order);
        } else {
            return redirect()->back()->with('error', 'Unable to pay order.');
        }
    }
}
