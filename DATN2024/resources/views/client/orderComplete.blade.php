@extends('client.layouts.master')

@section('content')
<main>

    <section class="order-complete container">

        <h2>Order Complete</h2>

        <p>Thank you for your order!</p>

        <h4>Your Order Details</h4>

        <table class="table">

            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td> <!-- Thay đổi theo tên sản phẩm -->
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->product_price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        <p>Total Price: ${{ number_format($order->total_price, 2) }}</p>

    </section>

</main>
@endsection

