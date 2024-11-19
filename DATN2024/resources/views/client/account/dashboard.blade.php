@extends('client.layouts.master')

@section('content')
    <main>
        <section class="my-account container py-4">
            <h2 class="page-title">My Account</h2>
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
                    <div class="page-content my-account__dashboard">
                        @auth
                            <p>Hello <strong>{{ Auth::user()->name }}</strong> (not <strong>{{ Auth::user()->name }}?</strong>)
                            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">Đăng xuất</button>
                            </form>
                            </p>
                            <p>From your account dashboard you can view your <a class="unerline-link"
                                    href="{{ route('history') }}">recent orders</a> and <a class="unerline-link"
                                    href="{{ route('accountdetail') }}">edit your password and account details.</a></p>
                        @endauth
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
