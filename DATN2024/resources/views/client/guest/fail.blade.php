@extends('client.layouts.master')

@section('content')
    <main style="margin-bottom: 300px">
        <section class="payment-failed">
            <div class="content container">

                @include('client.components.breadcrumb', [
                    'breadcrumbs' => [
                        ['label' => 'Thanh toán', 'url' => null]
                    ]
                ])

                <h2 class="mb-3 text-center"> <i class="fa-solid fa-triangle-exclamation" style="color: #237e11;"></i> Thanh toán không thành công!</h2>
                <h3 class="mb-3">Chúng tôi rất tiếc nhưng giao dịch của bạn không thể hoàn tất.</h3>
                <p class="mb-3" style="color: black">
                    Đã xảy ra sự cố khi xử lý khoản thanh toán của bạn. Vui lòng kiểm tra chi tiết thanh toán của bạn hoặc thử lại sau. Nếu sự cố vẫn tiếp diễn, hãy liên hệ với nhóm hỗ trợ của chúng tôi.
                </p>
                <div class="m-4 text-center">
                    <a href="/checkout" class="btn btn-primary">Thanh toán lại</a>
                    <a href="/home" class="btn btn-secondary">Về trang chủ</a>
                </div>
            </div>
        </section>
    </main>
@endsection
