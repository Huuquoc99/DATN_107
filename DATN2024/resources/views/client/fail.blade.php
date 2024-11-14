@extends('client.layouts.master')

@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Order Failed</h2>
            <div class="order-complete">
                <div class="order-complete__message">
                    <i class="fa-solid fa-circle-exclamation fa-xl"></i>
                    <h3>Payment Failed</h3>
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
