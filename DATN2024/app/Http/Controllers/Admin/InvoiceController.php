<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function getInvoices(Request $request)
    {
        $invoices = Order::where('status_payment_id', 5)
            ->where('status_order_id', 5)
            ->get(['id as order_id', 'user_name', 'total_price', 'created_at']);

        return response()->json($invoices);
    }

    public function showInvoice($id)
    {
        $order = Order::with('orderItems')
            ->where('id', $id)
            ->where('status_payment_id', 5)
            ->where('status_order_id', 5)
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Invoice not found or not available'], 404);
        }

        return response()->json($order);
    }
}
