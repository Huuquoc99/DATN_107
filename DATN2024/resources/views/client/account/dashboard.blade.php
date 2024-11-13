@extends('client.layouts.master')

@section('content')
<main>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">My Account</h2>
      <div class="row">
        <div class="col-lg-3">
          <ul class="account-nav">
            <li><a href="{{ route('account.dashboard') }}" class="menu-link menu-link_us-s menu-link_active">Dashboard</a></li>
            <li><a href="{{ route('history') }}" class="menu-link menu-link_us-s">Orders</a></li>
            <li><a href="{{ route('accountdetail') }}" class="menu-link menu-link_us-s">Account Details</a></li>
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
            <p>From your account dashboard you can view your <a class="unerline-link" href="account_orders.html">recent orders</a>, manage your <a class="unerline-link" href="account_edit_address.html">shipping and billing addresses</a>, and <a class="unerline-link" href="account_edit.html">edit your password and account details.</a></p>
          @endauth
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection