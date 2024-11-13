@extends('client.layouts.master')

@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Orders</h2>
            <div class="row">
                <div class="col-lg-3">
                    <ul class="account-nav">
                        <li><a href="{{ route('account.dashboard') }}" class="menu-link menu-link_us-s ">Dashboard</a></li>
                        <li><a href="{{ route('history') }}" class="menu-link menu-link_us-s menu-link_active">Orders</a></li>
                        <li><a href="{{ route('accountdetail') }}" class="menu-link menu-link_us-s">Account Details</a></li>
                        <li><a href="{{ route('account.changePassword') }}" class="menu-link menu-link_us-s">Change password</a></li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__orders-list">
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
                                        <td>{{ $order['created_at']->format('F j, Y') }}</td>
                                        
                                        <td>
                                            @if ($order['status_order_id'] == 1)
                                                <span class="badge bg-warning text-dark">{{ $order['status_order_name'] }}</span>
                                            @elseif ($order['status_order_id'] == 2)
                                                <span class="badge bg-primary">{{ $order['status_order_name'] }}</span>
                                            @elseif ($order['status_order_id'] == 3)
                                                <span class="badge bg-success text-dark">{{ $order['status_order_name'] }}</span>
                                            @else
                                                <span class="badge bg-secondary text-dark">{{ $order['status_order_name'] }}</span>
                                            @endif
                                        </td>
                                        
                                        <td>{{ number_format($order['total_price'], 2) }} VND</td>
                                        <td><a href="{{ route('account.orders.show', $order['id']) }}"
                                                class="btn btn-primary">VIEW</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Bạn chưa có đơn hàng nào.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
