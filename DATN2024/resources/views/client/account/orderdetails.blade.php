@extends('client.layouts.master')

@section('content')
<main class="container py-6">
    <h2 class="text-center mb-5 display-4 text-uppercase text-danger">Order Detail - {{ $order->code }}</h2>

    <div class="row mb-3">
        <!-- Customer Details -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-2 h-100">
                <div class="card-header bg-primary text-white text-uppercase">Customer Details</div>
                <div class="card-body equal-height">
                    <p><strong>Name:</strong> {{ $order->user_name }}</p>
                    <p><strong>Email:</strong> {{ $order->user_email }}</p>
                    <p><strong>Phone:</strong> {{ $order->user_phone }}</p>
                    <p><strong>Address:</strong> {{ $order->user_address }}</p>
                </div>
            </div>
        </div>
        <!-- Billing Details -->
       
        <!-- Shipping Details -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-2 h-100">
                <div class="card-header bg-primary text-white text-uppercase">Shipping Address</div>
                <div class="card-body equal-height">
                    <p><strong>Email:</strong>{{ Auth::user()->email }}</p>
                    <p><strong>Phone:</strong> {{ $order->user_phone }}</p>
                    <p><strong>Address:</strong> {{ $order->user_address }}</p>
                    <p><strong>Note:</strong> {{ $order->user_note }}</p>
                </div>
            </div>
        </div>
        <!-- Order Summary -->
        <div class="col-md-6 col-lg-4 ">
            <div class="card shadow-sm border-2 h-100">
                <div class="card-header bg-dark text-white text-uppercase">Order Details</div>
                <div class="card-body equal-height">
                    {{-- <p><strong>Status:</strong> 
                        {{ $order->statusOrder->name ?? 'N/A' }}
                        @if ($order->status_order_id == 1)
                            <form action="{{ route('account.orders.cancel', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-red btn-sm ms-2">Hủy đơn hàng</button>
                            </form>
                        @elseif ($order->status_order_id == 2)
                            <form action="{{ route('account.orders.markAsReceived', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm ms-2">Mark as Received</button>
                            </form>
                        @elseif ($order->status_order_id == 3)
                            <span class="text-success">Completed</span>
                        @elseif ($order->status_order_id == 4)
                            <span class="text-danger">Cancelled</span>
                        @endif
                    </p> --}}
                    <p><strong>Payment Status:</strong> {{ $order->statusPayment->name ?? 'N/A' }}</p>
                    <p><strong>Payment Method:</strong> {{ $order->paymentMethod->name ?? 'N/A' }}</p>
                    <p><strong>Created At:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Total:</strong> {{ number_format($order->total_price, 2) }} VND</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Items -->
    <section>
        <div class="row py-5">
            <!-- Bảng Order Items chiếm 2/3 chiều dài màn hình -->
            <div class="col-md-8">
                <div class="card-body card">
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
                                    <td>{{ number_format($item->product_price, 2) }} VND</td>
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
                </div>
            </div>
            <!-- Bảng Order Status chiếm 1/3 chiều dài màn hình -->
            <div class="col-md-4">
                <div class="card card-body border-0 shadow-sm">
                    <div class="card-header bg-dark text-white text-uppercase">Order Status</div>
                    <div class="card-body">
                        <p><strong>Status:</strong> 
                            {{ $order->statusOrder->name ?? 'N/A' }}
                            @if ($order->status_order_id == 1)
                                <form action="{{ route('account.orders.cancel', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-red btn-sm ms-2">Hủy đơn hàng</button>
                                </form>
                            @elseif ($order->status_order_id == 2)
                                <form action="{{ route('account.orders.markAsReceived', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm ms-2">Mark as Received</button>
                                </form>
                            @elseif ($order->status_order_id == 3)
                                <span class="text-success">Completed</span>
                            @elseif ($order->status_order_id == 4)
                                <span class="text-danger">Cancelled</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <a href="{{ route('orders.index') }}" class="btn btn-primary mt-3 mb-3">Back</a>

    </div>
</main>
@endsection
