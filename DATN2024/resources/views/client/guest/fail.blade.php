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
                <h5 class="mb-3">Vui lòng ấn "thanh toán lại" để hoàn tất đơn hàng! Nếu bạn không thanh toán lại thì đừng lo, hãy vào giỏ hàng và tạo lại đơn hàng mới. Cảm ơn!.</h5>
                <b class="mb-3" style="color: #2c0b0e">
                    Đã xảy ra sự cố khi xử lý khoản thanh toán của bạn. Vui lòng kiểm tra chi tiết thanh toán của bạn hoặc thử lại sau. Nếu sự cố vẫn tiếp diễn, hãy liên hệ với nhóm hỗ trợ của chúng tôi.
                </b>
                <div class="m-4 text-center d-flex justify-content-center">
                    <form action="{{ route('guest.repayment') }}" method="POST">
                        @csrf
                        <button type="submit" name="redirect" class="btn btn-primary mt-3">Thanh toán lại</button>
                    </form>
                    <a href="/home" class="btn btn-secondary" style="margin-left: 20px">Về trang chủ</a>
                </div>

            </div>
        </section>
    </main>
@endsection
