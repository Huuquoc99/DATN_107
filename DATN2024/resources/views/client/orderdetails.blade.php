@extends('client.layouts.master')

@section('content')
    <h2 class="page-title pt-5">Order detail - {{ $order->code }}</h2>

    <section class="my-account container">
        <h2 class="page-title pt-5">User information</h2>
        <div class="row">
            <div class="col-lg-6">
                <div class="page-content my-account__orders-list">
                    <table class="orders-table ">
                        <tr>
                            <td><strong>User name:</strong></td>
                            <td>{{ $order->user_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>User email:</strong></td>
                            <td>{{ $order->user_email }}</td>
                        </tr>
                        <tr>
                            <td><strong>User phone:</strong></td>
                            <td>{{ $order->user_phone }}</td>
                        </tr>
                        <tr>
                            <td><strong>User address:</strong></td>
                            <td>{{ $order->user_address }}</td>
                        </tr>
                        <tr>
                            <td><strong>User note:</strong></td>
                            <td>{{ $order->user_note }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="page-content my-account__orders-list">
                    <table class="orders-table ">
                        <tr>
                            <td><strong>Ship user name:</strong></td>
                            <td>{{ $order->ship_user_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ship user email:</strong></td>
                            <td>{{ $order->ship_user_email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ship user phone:</strong></td>
                            <td>{{ $order->ship_user_phone }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ship user address:</strong></td>
                            <td>{{ $order->ship_user_address }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ship user note:</strong></td>
                            <td>{{ $order->ship_user_note }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        </div>

        </div>
    </section>
    <section class="my-account container">
        <h2 class="page-title pt-5">Order information</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-7 ">
                <div class="page-content my-account__orders-list">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <table class="orders-table ">
                        <form action="{{ route('account.orders.updateStatus', $order->id) }}" method="POST" id="update-status-form">
                            @csrf
                            <td>
                                <select id="status" name="status_order_id" class="form-select"
                                aria-label="Default select example">
                                @foreach ($statusOrders as $status)
                                    <option value="{{ $status->id }}"
                                        {{ $order->status_order_id == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary mt-2">Update Status</button>

                            </td>

                        </form>
                        <tr>
                            <td class="w-50"><strong>Status order</strong></td>
                            <td class="w-50">{{ $order->statusOrder->name ?? 'N/A' }}</td>
                            
                        </tr>
                        <tr>
                            <td><strong>Status payment:</strong></td>
                            <td>{{ $order->statusPayment->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Payment method:</strong></td>
                            <td>{{ $order->paymentMethod->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total price:</strong></td>
                            <td>{{ number_format($order->total_price, 2) }} VND</td>
                        </tr>
                        <tr>
                            <td><strong>Create at:</strong></td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        </div>

        </div>
    </section>

    <section class="my-account container">
        <h2 class="page-title pt-5">Orders</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content my-account__orders-list">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Quantity</th>
                                <th>Price regular</th>
                                <th>Price sale</th>
                                <th>Variant</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->product_sku }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->product_price_regular, 2) }} VND</td>
                                    <td>{{ number_format($item->product_price_sale, 2) }} VND</td>
                                    <td>
                                        @if ($item->product_capacity_id)
                                            {{ $item->capacity->name ?? 'N/A' }}
                                        @endif
                                        @if ($item->product_color_id)
                                            - {{ $item->color->name ?? 'N/A' }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('orders.index') }}" class="btn btn-primary mt-3 mb-3">Back</a>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
