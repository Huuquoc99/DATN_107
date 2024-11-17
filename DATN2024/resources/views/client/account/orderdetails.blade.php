@extends('client.layouts.master')

@section('content')
    <main class="container py-5">
        <!-- Order Code -->
        <h2 class="page-title text-center mb-5">Order Detail - {{ $order->code }}</h2>

        <section class="mb-5">
            <div class="mt-4">
                <h3 class="page-title py-2 mb-3 fw-bold text-white">User Information</h3>
            </div>
                <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">User Details</div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>User Name:</strong></td>
                                    <td>{{ $order->user_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $order->user_email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone:</strong></td>
                                    <td>{{ $order->user_phone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Address:</strong></td>
                                    <td>{{ $order->user_address }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Note:</strong></td>
                                    <td>{{ $order->user_note }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">Shipping Details</div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Ship Name:</strong></td>
                                    <td>{{ $order->ship_user_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $order->ship_user_email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone:</strong></td>
                                    <td>{{ $order->ship_user_phone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Address:</strong></td>
                                    <td>{{ $order->ship_user_address }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Note:</strong></td>
                                    <td>{{ $order->ship_user_note }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Order Information -->
        <section class="mb-5">
            <h3 class="page-title mb-4">Order Information</h3>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">Order Status</div>
                        <div class="card-body">
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
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold">Status:</td>
                                    <td>
                                        @if ($order->status_order_id == 1)
                                            <span class="badge badge-warning bg-danger text-white">{{ $order->statusOrder->name ?? 'N/A' }}</span>
                                            <form action="{{ route('account.orders.cancel', $order->id) }}" method="POST" class="mt-2">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">    Hủy đơn hàng</button>
                                            </form>
                                        @elseif ($order->status_order_id == 2)
                                            <span class="badge bg-primary">{{ $order->statusOrder->name ?? 'N/A' }}</span>
                                            <form action="{{ route('account.orders.markAsReceived', $order->id) }}" method="POST" class="mt-2">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Mark as Received</button>
                                            </form>
                                        @elseif ($order->status_order_id == 3)
                                            <span class="text-success">Completed</span>
                                        @elseif ($order->status_order_id == 4)
                                            <span class="text-danger">Cancelled</span>
                                        @else
                                            <span class="text-muted">Unknown Status</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Payment Status:</td>
                                    <td>{{ $order->statusPayment->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Payment Method:</td>
                                    <td>{{ $order->paymentMethod->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Total Price:</td>
                                    <td>{{ number_format($order->total_price, 2) }} VND</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Created At:</td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Order Items -->
        <section>
            <h3 class="page-title mb-4">Order Items</h3>
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Quantity</th>
                                <th>Price Regular</th>
                                <th>Price Sale</th>
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
                    <a href="{{ route('orders.index') }}" class="btn btn-primary mt-3">Back</a>
                </div>
            </div>
        </section>
    </main>
@endsection
