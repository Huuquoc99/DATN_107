<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function getInvoices(Request $request)
    {
        $invoices = Order::where('status_payment_id', 2)
            ->where('status_order_id', 3)
            ->get(['id as order_id', 'user_name', 'total_price', 'created_at']);

        return view('admin.invoices.index', compact('invoices'));
    }

    public function showInvoice($id)
    {
        $order = Order::with('orderItems')
            ->where('id', $id)
            ->where('status_payment_id', 2)
            ->where('status_order_id', 3)
            ->first();

        return view('admin.invoices.show', compact('order'));
    }
}
