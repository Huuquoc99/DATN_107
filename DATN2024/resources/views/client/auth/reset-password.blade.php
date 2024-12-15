@extends('client.layouts.master')
@section('title')
    TechStore
@endsection
@section('content')
<main>
    <section class="login-register container">
        <h2 class="d-none">Đổi mật khẩu</h2>
        <ul
                    class="nav nav-tabs mb-5"
                    id="login_register"
                    role="tablist"
                >
                    <li class="nav-item" role="presentation">
                        <a
                            class="nav-link nav-link_underscore active"
                            id="login-tab"
                            data-bs-toggle="tab"
                            href="/login"
                            role="tab"
                            aria-controls="tab-item-login"
                            aria-selected="true"
                            >Đổi mật khẩu</a
                        >
                    </li>
                </ul>
        <div class="login-form">
            <form name="login-form" class="needs-validation" method="POST" action="{{ route('reset-password') }}" novalidate>
                @csrf

                <div class="form-floating mb-3">
                    <input
                        name="password"
                        type="password"
                        class="form-control form-control_gray"
                        id="customerPasswodInput"
                        placeholder="Mật khẩu *"
                        required
                    />
                    <label for="customerPasswodInput">Password *</label>
                </div>

                <div class="form-floating mb-3">
                    <input
                        name="password_comfirmation"
                        type="password"
                        class="form-control form-control_gray"
                        id="customerPasswodInput"
                        placeholder="Nhập lại mật khẩu *"
                        required
                    />
                    <label for="customerPasswodInput"> Xác nhận mật khẩu *</label>
                </div>

                <div class="d-flex align-items-center mb-3 pb-2">
                    <div class="form-check mb-0">
                        <input
                            name="remember"
                            class="form-check-input form-check-input_fill"
                            type="checkbox"
                            id="flexCheckDefault1"
                        />
                        <label class="form-check-label text-secondary" for="flexCheckDefault1">Nhớ đăng nhập</label>
                    </div>
                    <a href="/reset_password" class="btn-text ms-auto">Quên mậyt khẩu?</a>
                </div>

                <button class="btn btn-primary w-100 text-uppercase" type="submit">
                    Log In
                </button>

                <div class="customer-option mt-4 text-center">
                    <span class="text-secondary">Chưa có tài khoản?</span>
                    <a href="/register" class="btn-text">Tạo tài khoản</a>
                </div>
            </form>
        </div>
    </section>
</main>
@endsection
