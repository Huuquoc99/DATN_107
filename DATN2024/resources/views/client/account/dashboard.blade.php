@extends('client.layouts.master')
@section('title')
    TechStore
@endsection
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Tài khoản của tôi</h2>
            <div class="row">
                <div class="col-lg-2 shadow">
                    <ul class="account-nav">
                        <li><a href="{{ route('account.dashboard') }}"
                                class="menu-link menu-link_us-s menu-link_active"style="color: black">Bảng điều khiển</a></li>
                        <li><a href="{{ route('history') }}" class="menu-link menu-link_us-s"style="color: black">Đơn hàng</a></li>
                        <li><a href="{{ route('favorites.list') }}" class="menu-link menu-link_us-s"style="color: black">Danh sách yêu thích</a></li>
                        <li><a href="{{ route('accountdetail') }}" class="menu-link menu-link_us-s"style="color: black">Chi tiết tài khoản</a></li>
                        <li><a href="{{ route('account.changePassword') }}" class="menu-link menu-link_us-s"style="color: black">Thay đổi mật khẩu</a></li>
                    </ul>
                </div>
                <div class="col-lg-10 shadow" style="padding-top: 45px">
                    <div class="page-content my-account__dashboard">
                        @auth
                            <p>Xin chào <strong>{{ Auth::user()->name }}</strong> (không phải <strong>{{ Auth::user()->name }}?</strong>)
                            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit" class="button">Đăng xuất</button>
                            </form>
                            </p>
                            <p>Từ bảng điều khiển tài khoản của bạn, bạn có thể xem <a class="unerline-link"
                                    href="{{ route('history') }}">đơn hàng gần đây</a> và <a class="unerline-link"
                                    href="{{ route('accountdetail') }}">chỉnh sửa mật khẩu và thông tin tài khoản của bạn.</a></p>
                        
                            <div class="wallet-container">
                                <h4>Ví Xu của bạn:</h4>
                                <div class="wallet-box">
                                    <div class="coin-icon">
                                        <i class="fas fa-coins"></i> 
                                        {{ Auth::user()->userPoints ? Auth::user()->userPoints->points : 0 }} VND
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </section>
    </main>
    <style>
        .wallet-container {
            /* text-align: center; */
            margin: 20px;
            font-family: Arial, sans-serif;
        }

        .wallet-box {
            display: inline-block;
            background-color: #f8f9fa; 
            border: 2px solid gold; 
            border-radius: 10px; 
            padding: 15px 25px;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.1); 
            margin-top: 10px;
        }

        .coin-icon {
            font-size: 24px;
            color: gold; 
            font-weight: bold;
        }

        .coin-icon span {
            color: #007bff; 
            font-size: 18px;
        }

        h4 {
            color: #333;
            font-size: 20px;
            margin-bottom: 10px;
        }
    </style>
@endsection
