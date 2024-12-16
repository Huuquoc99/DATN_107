@extends('client.layouts.master')

@section('title')
    TechStore - Payment Failed
@endsection

@section('content')
    <main style="margin-bottom: 300px">
        <section class="payment-failed">
            <div class="content container text-center py-5">
                <div class="icon mb-4">
                    <i class="fa-solid fa-triangle-exclamation fa-3x" style="color: #ff4d4f;"></i>
                </div>
                <h2 class="mb-3 text-danger fw-bold">Thanh toán không thành công!</h2>
                <p class="mb-4 fs-5 text-muted">
                    Chúng tôi rất tiếc nhưng giao dịch của bạn không thể hoàn tất.
                    Vui lòng thử lại hoặc kiểm tra thông tin thanh toán của bạn.
                </p>
                <div class="alert alert-warning mb-4" role="alert">
                    <strong>Lưu ý:</strong> Nếu bạn không thanh toán lại, đơn hàng của bạn sẽ không được xử lý. Bạn có thể vào giỏ hàng để tạo lại đơn hàng mới. Cảm ơn!
                </div>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <form action="{{ route('guest.repayment') }}" method="POST">
                        @csrf
                        <button type="submit" name="redirect" class="btn btn-primary px-4 py-2 mt-3">Thanh toán lại</button>
                    </form>
                    <a href="/home" class="btn btn-outline-secondary px-4 py-2">Về trang chủ</a>
                </div>
            </div>
        </section>
    </main>
@endsection
