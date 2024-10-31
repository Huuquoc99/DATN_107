<?php

namespace App\Http\Controllers\Client;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // Xác thực dữ liệu
        $validated = $request->validate([
            'ship_user_name' => 'required|string|max:255',
            'ship_user_email' => 'required|email|max:255',
            'ship_user_phone' => 'required|string|max:15',
            'ship_user_address' => 'required|string|max:255',
            'ship_user_note' => 'nullable|string',
            'cart_items' => 'required|array',
            'cart_items.*.product_variant_id' => 'required|exists:product_variants,id',
            'cart_items.*.quantity' => 'required|integer|min:1',
        ]);
    
        $user = Auth::user(); 
    
        $totalPrice = 0; 
        $code = 'Order_' . strtoupper(uniqid());
       
        $order = Order::create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_phone' => $user->phone, 
            'user_address' => $user->address, 
            'total_price' => 0, 
            'status_order_id' => 1, 
            'status_payment_id' => 1, 
        ]);

        $orderCode = $this->generateUniqueOrderCode($order->id);
        $order->code = $orderCode;
    
        // Lưu thông tin người nhận hàng từ input
        $order->ship_user_name = $validated['ship_user_name'];
        $order->ship_user_email = $validated['ship_user_email'];
        $order->ship_user_phone = $validated['ship_user_phone'];
        $order->ship_user_address = $validated['ship_user_address'];
        $order->ship_user_note = $validated['ship_user_note'];
        $order->save();
    
        $orderItems = []; 
    
        foreach ($validated['cart_items'] as $item) {
           
            $productVariant = ProductVariant::findOrFail($item['product_variant_id']);
    
           
            $totalPrice += $productVariant->price * $item['quantity'];

            $orderItems[] = [
                'order_id' => $order->id,
                'product_variant_id' => $item['product_variant_id'],
                'quantity' => $item['quantity'],
                'product_name' => $productVariant->product->name,
                'product_sku' => $productVariant->product->sku,
                'product_price_regular' => $productVariant->price,
                'product_price_sale' => $productVariant->product->price_sale,
                'product_img_thumbnail' => $productVariant->product->thumbnail,
                'variant_capacity_name' => $productVariant->capacity->name,
                'variant_color_name' => $productVariant->color->name,
            ];
        }
    
    
        OrderItem::insert($orderItems);

        $order->update(['total_price' => $totalPrice]);
    
        return response()->json(['message' => 'Checkout successful!', 'order_id' => $order->id, 'code' => $order->code], 201);
    }


    // Code order
    function generateUniqueOrderCode($orderId)
    {
        do {
            $code = "ORD-" . $orderId; // Sử dụng order_id
        } while (Order::where("code", $code)->exists());
    
        return $code;
    }
}
