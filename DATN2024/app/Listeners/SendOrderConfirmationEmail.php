<?php

namespace App\Listeners;

use App\Events\GuestOrderPlaced;
use App\Models\ProductCapacity;
use App\Models\ProductColor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmationEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(GuestOrderPlaced $event): void
    {
        try {
            $order = $event->order;
            $orderItems = $order->orderItems;

            foreach ($orderItems as $item) {
                $capacity = ProductCapacity::find($item->product_capacity_id);
                $color = ProductColor::find($item->product_color_id);
                $colorName = $color ? $color->name : 'Un know';
                $capacityName = $capacity ? $capacity->name : 'Un know';

                $item->color_name = $colorName;
                $item->capacity_name = $capacityName;
            }

            $data = [
                'order_code' => $order->code,
                'customer_name' => $order->user_name,
                'customer_email' => $order->user_email,
                'customer_phone' => $order->user_phone,
                'customer_address' => $order->user_address,
                'shipping_name' => $order->ship_user_name,
                'shipping_email' => $order->ship_user_email,
                'shipping_phone' => $order->ship_user_phone,
                'shipping_address' => $order->ship_user_address,
                'payment_method_id' => $order->payment_method_id,
                'total_price' => $order->total_price,
                'items' => $orderItems,
            ];

//            dd($data);
            Mail::send('client.mail.confirm-order', $data, function ($message) use ($order) {
                $message->to($order->user_email, $order->user_name)
                    ->subject('Xác nhận đơn hàng #' . $order->code);
                $message->from('dinhpvph31545@fpt.edu.vn', 'Techstore');
            });

            Log::info("Order confirmation email sent for Order #" . $order->code);
        } catch (\Exception $e) {
            Log::error("Failed to send order confirmation email: " . $e->getMessage());
        }
    }

}
