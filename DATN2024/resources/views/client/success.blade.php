@extends('client.layouts.master')

@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Order Failed</h2>
            <div class="order-complete">
                <div class="order-complete__message">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="40" cy="40" r="40" fill="#FF6F61"/>
                        <path d="M40 28.8C39.402 28.8 38.8 29.402 38.8 30C38.8 30.598 39.402 31.2 40 31.2C40.598 31.2 41.2 30.598 41.2 30C41.2 29.402 40.598 28.8 40 28.8Z" fill="white"/>
                        <path d="M40 51.2C39.402 51.2 38.8 51.802 38.8 52.4V52.8C38.8 53.398 39.402 54 40 54C40.598 54 41.2 53.398 41.2 52.8V52.4C41.2 51.802 40.598 51.2 40 51.2Z" fill="white"/>
                    </svg>
                    <h3>Payment Success</h3>
                    <p>Unfortunately, your payment was not successful. Please try again or contact support.</p>
                </div>
                <div class="order-info">
                    <div class="order-info__item">
                        <label>Order Number</label>
                        <span>{{ $order->code }}</span>
                    </div>
                    <div class="order-info__item">
                        <label>Date</label>
                        <span>{{ $order->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="order-info__item">
                        <label>Total</label>
                        <span>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</span>
                    </div>
                    <div class="order-info__item">
                        <label>Payment Method</label>
                        <span>{{ $order->paymentMethod->name }}</span>
                    </div>
                </div>
                <div class="checkout__totals-wrapper">
                    <div class="checkout__totals">
                        <h3>Order Details</h3>
                        <table class="checkout-cart-items">
                            <thead>
                            <tr>
                                <th>PRODUCT</th>
                                <th>COLOR</th>
                                <th>CAPACITY</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>
                                        {{ $item->product_name }} x {{ $item->quantity }}
                                    </td>
                                    <td>
                                        @if ($item->product_capacity_id)
                                            {{ $item->capacity->name }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->product_color_id)
                                            {{ $item->color->name }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <table class="checkout-totals">
                            <tbody>
                            <tr>
                                <th>SUBTOTAL</th>
                                <td>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                            </tr>
                            <tr>
                                <th>TOTAL</th>
                                <td>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
