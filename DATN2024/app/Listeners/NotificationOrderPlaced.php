<?php

namespace App\Listeners;

use App\Events\AdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificationOrderPlaced
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
    public function handle(object $event): void
    {
        // gửi thông báo cho admin
        $order = $event->order;

        \App\Models\AdminNotification::create([
            'type' => 'Event\AdminNotification',
            'data' => [
                'order' => $order,
                'message' => 'đã đặt hàng thành công đơn hàng #<b>'. $order->code .'<b>'
            ]
        ]);
        broadcast(new AdminNotification(\App\Models\AdminNotification::unread()->count()));
    }
}
