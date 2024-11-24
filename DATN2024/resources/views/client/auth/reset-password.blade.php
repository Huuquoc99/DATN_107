@extends('client.layouts.master')

@section('content')
<main>
    <section class="login-register container">
        <h2 class="d-none">Change password</h2>
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
                            >Change password</a
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
                        placeholder="Password *"
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
                        placeholder="Password confirmation *"
                        required
                    />
                    <label for="customerPasswodInput"> Confirm Password *</label>
                </div>

                <div class="d-flex align-items-center mb-3 pb-2">
                    <div class="form-check mb-0">
                        <input
                            name="remember"
                            class="form-check-input form-check-input_fill"
                            type="checkbox"
                            id="flexCheckDefault1"
                        />
                        <label class="form-check-label text-secondary" for="flexCheckDefault1">Remember me</label>
                    </div>
                    <a href="/reset_password" class="btn-text ms-auto">Lost password?</a>
                </div>

                <button class="btn btn-primary w-100 text-uppercase" type="submit">
                    Log In
                </button>

                <div class="customer-option mt-4 text-center">
                    <span class="text-secondary">No account yet?</span>
                    <a href="/register" class="btn-text">Create Account</a>
                </div>
            </form>
        </div>
    </section>
</main>
@endsection
