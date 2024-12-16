@extends('client.layouts.master')
@section('title')
    TechStore
@endsection
@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container" style="margin-top: -100px;">
            @include('client.components.breadcrumb', [
                 'breadcrumbs' => [
                     ['label' => 'Thanh toán', 'url' => null],
                 ]
             ])
            <div style="margin-top: 100px; margin-bottom: 200px;">
                <h3><i class="fa-regular fa-circle-check fa-lg" style="color: #d8cb9c;"></i> Đặt hàng thành công</h3>
                <div class="order-complete">
                    <div class="order-complete__message">
                        <h6>Thanh toán thành công! Cảm ơn bạn đã mua sắm tại Techstore. Thông tin đơn hàng sẽ được gửi đến
                            email của bạn!
                        </h6>
                    </div>
                    <div class="m-4 text-center d-flex justify-content-center">
                    <a href="/home" class="btn btn-primary" style="margin-left: 20px">Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
