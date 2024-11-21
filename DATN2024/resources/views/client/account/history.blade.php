@extends('client.layouts.master')

@section('content')
<div class="container mb-4 main-container py-5">
    <div class="row">
        <div class="col-lg-4 pb-5">
            <div class="author-card pb-3">
                <div class="author-card-profile">
                    <div class="author-card-details">
                        <h5 class="author-card-name text-lg">
                            <p>Hello <strong>{{ Auth::user()->name }}</strong> (Email : <strong>{{ Auth::user()->email }}</strong>) 
                                </p>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="wizard">
                <ul class="account-nav list-group shadow-sm">
                    <li class="list-group-item {{ request()->routeIs('account.dashboard') ? 'bg-dark text-white' : '' }}">
                        <a href="{{ route('account.dashboard') }}" class="menu-link text-decoration-none {{ request()->routeIs('account.dashboard') ? 'text-white' : '' }}">
                            Dashboard
                        </a>
                    </li>
                    <li class="list-group-item {{ request()->routeIs('history') ? 'bg-dark text-white' : '' }}">
                        <a href="{{ route('history') }}" class="menu-link text-decoration-none {{ request()->routeIs('history') ? 'text-white' : '' }}">
                            Orders
                        </a>
                    </li>
                    <li class="list-group-item {{ request()->routeIs('accountdetail') ? 'bg-dark text-white' : '' }}">
                        <a href="{{ route('accountdetail') }}" class="menu-link text-decoration-none {{ request()->routeIs('accountdetail') ? 'text-white' : '' }}">
                            Account Details
                        </a>
                    </li>
                    <li class="list-group-item {{ request()->routeIs('account.changePassword') ? 'bg-dark text-white' : '' }}">
                        <a href="{{ route('account.changePassword') }}" class="menu-link text-decoration-none {{ request()->routeIs('account.changePassword') ? 'text-white' : '' }}">
                            Change Password
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-8 pb-5">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date Purchased</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Order Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>
                                        {{ $order['code'] }}
                                </td>
                                <td>{{ $order['created_at']->format('F j, Y') }}</td>
                                <td>
                                    @if ($order['status_order_id'] == 1)
                                                    <span class="badge bg-warning text-dark">{{ $order['status_order_name'] }}</span>
                                                @elseif ($order['status_order_id'] == 2)
                                                    <span class="badge bg-primary">{{ $order['status_order_name'] }}</span>
                                                @elseif ($order['status_order_id'] == 3)
                                                    <span class="badge bg-success text-white">{{ $order['status_order_name'] }}</span>
                                                @else
                                                    <span class="badge bg-secondary text-dark">{{ $order['status_order_name'] }}</span>
                                                @endif
                                </td>
                                <td>{{ number_format($order['total_price'], 2) }} VND</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('account.orders.show', $order['id']) }}">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">You have no orders yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection