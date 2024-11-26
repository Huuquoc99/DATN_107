@extends('client.layouts.master')

@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Orders</h2>
            <div class="row">
                <div class="col-lg-3">
                    <ul class="account-nav">
                        <li><a href="{{ route('account.dashboard') }}" class="menu-link menu-link_us-s "style="color: black">Dashboard</a></li>
                        <li><a href="{{ route('history') }}" class="menu-link menu-link_us-s menu-link_active"style="color: black">Orders</a></li>
                        <li><a href="{{ route('accountdetail') }}" class="menu-link menu-link_us-s"style="color: black">Account Details</a></li>
                        <li><a href="{{ route('account.changePassword') }}" class="menu-link menu-link_us-s"style="color: black">Change password</a></li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="mb-3">
                        <ul class="nav nav-pills mb-3">
                            <li class="nav-item">
                                <button class="btn py-3 filter-status {{ request()->status_order == 'all' ? 'text-success' : '' }}" data-status="all">
                                    <i class="ri-store-2-fill me-1 align-bottom"></i>
                                    All
                                </button>
                            </li>
                            @foreach($statusOrders as $orderStatus)
                                <li class="nav-item">
                                    <button class="btn py-3 filter-status {{ request()->status_order == $orderStatus->id ? 'text-success' : '' }}" data-status="{{ $orderStatus->id }}">
                                        @switch($orderStatus->id)
                                            @case(1)
                                                <i class="ri-time-line"></i>
                                                @break
                                            @case(2)
                                                <i class="ri-truck-line me-1 align-bottom"></i>
                                                @break
                                            @case(3)
                                                <i class="ri-checkbox-circle-line me-1 align-bottom"></i>
                                                @break
                                            @case(4)
                                                <i class="ri-close-circle-line me-1 align-bottom"></i>
                                                @break
                                            @default
                                                <i class="ri-store-2-fill me-1 align-bottom"></i>
                                        @endswitch
                                        {{ $orderStatus->name }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="page-content my-account__orders-list">
                        @if (isset($message))
                            <p class="text-center text-muted">{{ $message }}</p>
                        @else
                            <table class="orders-table">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>{{ $order['code'] }}</td>
                                            <td>
                                                {{-- <span id="invoice-date">{{ $item->created_at ? $item->created_at->format('d M, Y') : 'N/A' }}</span>
                                                <small class="text-muted" id="invoice-time">{{ $item->created_at ? $item->created_at->format('h:iA') : '' }}</small> --}}

                                                <span id="invoice-date">{{ $order['created_at'] ? $order['created_at']->format('d M, Y') : 'N/A' }}</span>
                                                <small class="text-muted" id="invoice-time">{{ $order['created_at'] ? $order['created_at']->format('h:iA') : '' }}</small>
                                                
                                            </td>
                                            <td>
                                                @switch($order['status_order_id'])
                                                    @case(1)
                                                        <span class="badge bg-warning text-dark">{{ $order['status_order_name'] }}</span>
                                                        @break
                                                    @case(2)
                                                        <span class="badge bg-primary">{{ $order['status_order_name'] }}</span>
                                                        @break
                                                    @case(3)
                                                        <span class="badge bg-success text-dark">{{ $order['status_order_name'] }}</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-secondary text-dark">{{ $order['status_order_name'] }}</span>
                                                @endswitch
                                            </td>
                                            <td>{{ number_format($order['total_price'], 2) }} VND</td>
                                            <td><a href="{{ route('account.orders.show', $order['id']) }}" class="btn btn-primary">VIEW</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Bạn chưa có đơn hàng nào.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $orders->links() }}
                            </div>
                        @endif
                    </div>
                </div>
                
            </div>
        </section>
    </main>
    <script>
        document.querySelectorAll('.filter-status').forEach(button => {
            button.addEventListener('click', function () {
                const status = this.getAttribute('data-status');
                const url = new URL(window.location.href);
                url.searchParams.set('status_order', status);
                window.location.href = url.toString();
            });
        });
    </script>
@endsection
