@extends('client.layouts.master')

@section('content')
    <div class="mb-3 mb-xl-5 pb-3 pt-1 pb-xl-5"></div>

    <div class="my-account container">
        <h2 class="page-title pt-5 ">Order detail - {{ $order->code }}</h2>
    </div>


    <section class="my-account container">
        <h2 class="page-title pt-5">User Information</h2>
        <div class=" mb-xl-2 pb-3 pt-1 pb-xl-5"></div>
        <div class="row">
            <!-- User Information -->
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
            <!-- Shipping Information -->
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
    </section>
    <section class="my-account container">
        <h2 class="page-title pt-5">Order Details</h2>
        <div class="row">
            <!-- Order Information (Chiếm 3 phần) -->
            <div class="col-lg-4">
                <div class="info-box">
                    <h4>Order Information</h4>
                    <table class="info-table">
                        <tr>
                            <td><strong>Status order:</strong></td>
                            <td>
                                @if ($order->status_order_id == 1)
                                    {{ $order->statusOrder->name ?? 'N/A' }}
                                    <form action="{{ route('account.orders.cancel', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                    </form>
                                @elseif ($order->status_order_id == 2)
                                    {{ $order->statusOrder->name ?? 'N/A' }}
                                    <form action="{{ route('account.orders.markAsReceived', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Mark as Received</button>
                                    </form>
                                @elseif ($order->status_order_id == 3)
                                    <span class="text-success">Completed</span>
                                @elseif ($order->status_order_id == 4)
                                    <span class="text-danger">Canceled</span>
                                @else
                                    <span class="text-muted">Unknown</span>
                                    {{-- <td class="w-50"><strong>Status order</strong></td>
                            <td class="w-50">
                                {{ $order->statusOrder->name ?? 'N/A' }}
                            </td>
                            <td>
                                @if ($order->statusOrder->name == 'Pending')
                                    <form action="{{ route('account.orders.cancel', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Cancelled</button>
                                    </form>
                                @elseif ($order->statusOrder->name == 'Shipped')
                                    <form action="{{ route('account.orders.markAsReceived', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Received</button>
                                    </form>
                                @endif
                            </td> --}}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Status payment:</strong></td>
                            <td>
                                {{ $order->statusPayment->name ?? 'N/A' }}
                                @if (
                                    ($order->statusPayment->id == 1 || $order->statusPayment->id == 3) &&
                                        $order->statusOrder->id == 1 &&
                                        $order->paymentMethod->id == 2)
                                    <form action="{{ route('account.orders.repayment', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">Repayment</button>
                                        {{-- <td>{{ $order->statusPayment->name ?? 'N/A' }}
                            </td>
                            <td class="w-30">
                                @if (($order->statusPayment->name == 'Pending' || $order->statusPayment->name == 'Failed') && $order->statusOrder->name == 'Pending' && $order->paymentMethod->name == 'VN Pay')
                                    <form action="{{ route('account.orders.repayment', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" name="redirect" class="btn btn-success">Repayment</button>
                                    </form>
                                @endif
                            </td> --}}
                                    </form>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Payment method:</strong></td>
                            <td>{{ $order->paymentMethod->name ?? 'N/A' }}</td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td><strong>Total price:</strong></td>
                            <td>{{ number_format($order->total_price, 2) }} VND</td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td><strong>Create at:</strong></td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td> </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Orders List (Chiếm 7 phần) -->
            <div class="col-lg-8">
                <div class="info-box">
                    <h4>Order Items</h4>
                    <table class="orders-table">
                        <thead>
                            <<<<<<< HEAD <tr>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Quantity</th>
                                <th>Price Regular</th>
                                <th>Price Sale</th>
                                <th>Variant</th>
                                </tr>
                                =======
                                <tr>
                                    <th>Product</th>
                                    <th>SKU</th>
                                    <th>Quantity</th>
                                    <th>Price regular</th>
                                    <th>Price sale</th>
                                    <th>Variant</th>
                                </tr>
                                >>>>>>> dinh03
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
