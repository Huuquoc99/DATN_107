@component('mail::message')
    # Order Confirmation

    Thank you for your purchase!

    **Order ID:** {{ $order->code }}
    **Total Amount:** {{ number_format($order->total_price, 0, ',', '.') }} VND

    @component('mail::button', ['url' => route('order.details', $order->id)])
        View Order
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
