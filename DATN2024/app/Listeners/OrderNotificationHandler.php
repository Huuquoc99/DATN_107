<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class OrderNotificationHandler implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function handle(OrderPlaced $event)
    {
        $order = $event->order;
        $action = $event->action;

        if ($action === 'admin_cancel') {
            Mail::send('admin.orders.mailCancel', ['order' => $order], function ($message) use ($order) {
                $message->to([$order->user_email, $order->ship_user_email])
                    ->subject('Your order has been cancelled.');
                $message->from('hoadtph31026@fpt.edu.vn', 'Techstore');
            });

        } elseif ($action === 'update') {
            Mail::send('admin.orders.mailUpdate', ['order' => $order], function ($message) use ($order) {
                $message->to([$order->user_email, $order->ship_user_email])
                    ->subject('Your order status has been updated');
                $message->from('hoadtph31026@fpt.edu.vn', 'Techstore');
            });
        } elseif ($action === 'client_cancel') {
            Mail::send('client.mail.cancel', ['order' => $order], function ($message) use ($order) {
                $message->to([$order->user_email, $order->ship_user_email])
                ->subject('Your order has been cancelled.');
                $message->from('hoadtph31026@fpt.edu.vn', 'Techstore');
            });
        } elseif ($action === 'order_fail_guest') {
            Mail::send('client.guest.mailFailed', ['order' => $order], function ($message) use ($order) {
                $message->to([$order->user_email, $order->ship_user_email])
                    ->subject('Đơn hàng của bạn chưa hoàn thành.');
                $message->from('hoadtph31026@fpt.edu.vn', 'Techstore');
            });
        }
        elseif ($action === 'order_fail_user') {
            Mail::send('client.mail.failed', ['order' => $order], function ($message) use ($order) {
                $message->to([$order->user_email, $order->ship_user_email])
                    ->subject('Đơn hàng của bạn chưa hoàn thành.');
                $message->from('hoadtph31026@fpt.edu.vn', 'Techstore');
            });
        }
    }
}
