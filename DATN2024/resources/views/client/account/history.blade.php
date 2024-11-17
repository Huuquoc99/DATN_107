@extends('client.layouts.master')

@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title ">My Orders</h2>
            <div class="row">
                <div class="col-lg-3">
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

                <div class="col-lg-9">
                    <div class="page-content my-account__orders-list shadow-sm p-4  rounded">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Order</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Total</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td><strong>{{ $order['code'] }}</strong></td>
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
                                            <td class="text-center">
                                                <a href="{{ route('account.orders.show', $order['id']) }}" class="btn btn-sm btn-primary">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">You have no orders yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    
                        
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
