<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function getInvoices(Request $request)
    {
        $query = Order::where('status_payment_id', 2)
            ->where('status_order_id', 5)
            ->orderBy('created_at', 'desc');
    
        if ($request->filled('search')) {
            $search = $request->input('search');
            
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%$search%")
                    ->orWhere('ship_user_name', 'like', "%$search%")
                    ->orWhere('ship_user_phone', 'like', "%$search%")
                    ->orWhereHas('statusOrder', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    })
                    ->orWhere('status_payment_id', 'like', "%$search%");
            });
        }
    
        $invoices = $query->paginate(5, [ 
            'id', 
            'code',
            'ship_user_name', 
            'ship_user_phone',
            'total_price', 
            'created_at',
            'status_payment_id',
            'status_order_id',
        ]);
    
        return view('admin.invoices.index', compact('invoices'));
    }
    
    public function showInvoice($id)
    {
        $order = Order::with('orderItems')
            ->where('id', $id)
            ->first();

        return view('admin.invoices.show', compact('order'));
    }
}
