@extends('client.layouts.master')
@section('title')
    TechStore
@endsection
@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Tài khoản của tôi</h2>
            <div class="row">
                <div class="col-lg-3">
                    <ul class="account-nav">
                        <li><a href="{{ route('account.dashboard') }}"
                                class="menu-link menu-link_us-s menu-link_active"style="color: black">Bảng điều khiển</a></li>
                        <li><a href="{{ route('history') }}" class="menu-link menu-link_us-s"style="color: black">Đơn hàng</a></li>
                        <li><a href="{{ route('favorites.list') }}" class="menu-link menu-link_us-s"style="color: black">Danh sách yêu thích</a></li>
                        <li><a href="{{ route('accountdetail') }}" class="menu-link menu-link_us-s"style="color: black">Chi tiết tài khoản</a></li>
                        <li><a href="{{ route('account.changePassword') }}" class="menu-link menu-link_us-s"style="color: black">Thay đổi mật khẩu</a></li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__dashboard">
                        @auth
                            <p>Xin chào <strong>{{ Auth::user()->name }}</strong> (not <strong>{{ Auth::user()->name }}?</strong>)
                            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit" class="button">Đăng xuat</button>
                            </form>
                            </p>
                            <p>Từ bảng điều khiển tài khoản của bạn, bạn có thể xem <a class="unerline-link"
                                    href="{{ route('history') }}">đơn hàng gần đây</a> và <a class="unerline-link"
                                    href="{{ route('accountdetail') }}">chỉnh sửa mật khẩu và thông tin tài khoản của bạn.</a></p>
                        @endauth
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
