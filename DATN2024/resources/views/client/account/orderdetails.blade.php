@extends('client.layouts.master')

@section('content')
<div class="mb-3 mb-xl-5 pb-3 pt-1 pb-xl-5"></div>

    <div class="my-account container">
        <h2 class="page-title pt-5 ">Order detail - {{ $order->code }}</h2>
    </div>
    <section class="my-account container">
        <h2 class="page-title pt-5">Order Details</h2>
        <div class="row">
            <div class="col-lg-4">
                <div class="info-box">
                    <h4>Order Information</h4>
                    <table class="info-table">
                        <tr>
                            <td><strong>Status order:</strong></td>
                            <td>
                                @if ($order->status_order_id == 1 || $order->status_order_id == 2)
                                    {{ $order->statusOrder->name ?? 'N/A' }}
                                    <form action="{{ route('account.orders.cancel', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                    </form>
                                @elseif ($order->status_order_id == 3)
                                    {{ $order->statusOrder->name ?? 'N/A' }}
                                @elseif ($order->status_order_id == 4)
                                    {{ $order->statusOrder->name ?? 'N/A' }}
                                    <form action="{{ route('account.orders.markAsReceived', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Received</button>
                                    </form>
                                @elseif ($order->status_order_id == 5)
                                    <span class="text-success">Completed</span>
                                @elseif ($order->status_order_id == 6)
                                    <span class="text-danger">Canceled</span>
                                @else
                                    <span class="text-muted">Unknown</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Status payment:</strong></td>
                            <td>
                                {{ $order->statusPayment->name ?? 'N/A' }}
                                @if (($order->statusPayment->id == 1 || $order->statusPayment->id == 3) && $order->statusOrder->id == 1 && $order->paymentMethod->id == 2)
                                    <form action="{{ route('account.orders.repayment', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" name="redirect" class="btn btn-warning btn-sm">Repayment</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Payment method:</strong></td>
                            <td>{{ $order->paymentMethod->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total price:</strong></td>
                            <td>{{ number_format($order->total_price) }} VND</td>
                        </tr>
                        <tr>
                            <td><strong>Create at:</strong></td>
                            <td>
                                <span id="invoice-date">{{ $order->created_at->format('d M, Y') }}</span>
                                <small class="text-muted" id="invoice-time">{{ $order->created_at->format('h:iA') }}</small>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="info-box">
                    <h4>Order Items</h4>
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                {{-- <th>SKU</th> --}}
                                <th>Quantity</th>
                                <th>Price Regular</th>
                                {{-- <th>Price Sale</th> --}}
                                <th>Variant</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    {{-- <td>{{ $item->product_sku }}</td> --}}
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->product_price_regular, 0) }} VND</td>
                                    {{-- <td>{{ number_format($item->product_price_sale, 2) }} VND</td> --}}
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
    </section>
    <section class="my-account container">
        <h2 class="page-title pt-5">User Information</h2>
        <div class=" mb-xl-2 pb-3 pt-1 pb-xl-5"></div>
        <div class="row">
            <div class="col-lg-6">
                <div class="info-box">
                    <h4>User Information</h4>
                    <table class="info-table">
                        <tr>
                            <td><strong>Name:</strong></td>
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
            <div class="col-lg-6">
                <div class="info-box">
                    <h4>Shipping Information</h4>
                    <table class="info-table">
                        <tr>
                            <td><strong>Name:</strong></td>
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
                            <td>
                                {{ \Illuminate\Support\Str::limit($order->ship_user_address, 20, '...') }},
                                {{ \Illuminate\Support\Str::limit($order->shipping_ward, 20, '...') }},
                                {{ \Illuminate\Support\Str::limit($order->shipping_district, 20, '...') }},
                                {{ \Illuminate\Support\Str::limit($order->shipping_province, 20, '...') }},
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Note:</strong></td>
                            <td>{{ $order->ship_user_note }}</td>
                        </tr>
                    </table>
                </div>
            </div>      
        </div>
    </section>
    <div class="mb-2 mb-xl-5 pb-3 pt-1 pb-xl-5"></div>
@endsection
@section('script')
    <script type="text/javascript">
        const orderId = {{ $order->id }};
        Pusher.logToConsole = true;
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        var channel = pusher.subscribe('channel-notification');
        channel.bind('update-order', function(data) {
            if (data.orderId == orderId) {
                location.reload();
            }
        });
    </script>
@endsection