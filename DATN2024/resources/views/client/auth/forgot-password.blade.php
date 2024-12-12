@extends('client.layouts.master')
@section('title')
    TechStore
@endsection
@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="login-register container">
            <h2 class="section-title text-center fs-3 mb-xl-5">Đặt lại mật khẩu của bạn</h2>
            <p>Chúng tôi sẽ gửi cho bạn một email để đặt lại mật khẩu của bạn</p>
            <div class="reset-form">
                <form action="{{ route('forgot-password') }}" name="reset-form" method="POST" class="needs-validation"
                    novalidate>
                    @csrf
                    <div class="form-floating mb-3">
                        <input name="email" type="email" class="form-control form-control_gray "
                            id="customerNameEmailInput" placeholder="Email *" required>
                        <label for="customerNameEmailInput">Địa chỉ email *</label>
                    </div>

                    <button class="btn btn-primary w-100 text-uppercase" type="submit">Gửi</button>

                    <div class="customer-option mt-4 text-center">
                        <span class="text-secondary">Quay lại</span>
                        <a href="/login" class="btn-text js-show-register">Đăng nhập</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
