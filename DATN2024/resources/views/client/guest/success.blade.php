@extends('client.layouts.master')
@section('title')
    TechStore
@endsection
@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Đặt hàng thành công</h2>
            <div class="order-complete">
                <div class="order-complete__message">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="40" cy="40" r="40" fill="#FF6F61"/>
                        <path d="M40 28.8C39.402 28.8 38.8 29.402 38.8 30C38.8 30.598 39.402 31.2 40 31.2C40.598 31.2 41.2 30.598 41.2 30C41.2 29.402 40.598 28.8 40 28.8Z" fill="white"/>
                        <path d="M40 51.2C39.402 51.2 38.8 51.802 38.8 52.4V52.8C38.8 53.398 39.402 54 40 54C40.598 54 41.2 53.398 41.2 52.8V52.4C41.2 51.802 40.598 51.2 40 51.2Z" fill="white"/>
                    </svg>
                    <h3>Đặt hàng thành công</h3>
                    <h6>Thanh toán thành công! Cảm ơn bạn đã mua sắm tại Techstore. Thông tin đơn hàng sẽ được gửi đến email của bạn!</h6>
                </div>
            </div>
        </section>
    </main>

@endsection
