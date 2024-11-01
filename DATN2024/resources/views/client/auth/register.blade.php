@extends('client.layouts.master')

@section('content')
<<<<<<< HEAD
    <section class="login-register container">
        <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link nav-link_underscore active" id="register-tab" data-bs-toggle="tab" href="#tab-item-register"
                   role="tab" aria-controls="tab-item-register" aria-selected="true">Register</a>
            </li>
        </ul>
        <div class="tab-content pt-2" id="login_register_tab_content">
            <div class="tab-pane fade show active" id="tab-item-register" role="tabpanel" aria-labelledby="register-tab">
                <div class="register-form">
                    <form name="register-form" class="needs-validation" autocomplete="off" novalidate>
                        <div class="form-floating mb-3">
                            <input name="register_username" type="text" class="form-control form-control_gray"
                                   id="customerNameRegisterInput" placeholder="Username" required autocomplete="off">
                            <label for="customerNameRegisterInput">Username</label>
                        </div>

                        <div class="pb-3"></div>

                        <div class="form-floating mb-3">
                            <input name="register_email" type="email" class="form-control form-control_gray"
                                   id="customerEmailRegisterInput" placeholder="Email address *" required autocomplete="off">
                            <label for="customerEmailRegisterInput">Email address *</label>
                        </div>

                        <div class="pb-3"></div>

                        <div class="form-floating mb-3">
                            <input name="register_password" type="password" class="form-control form-control_gray"
                                   id="customerPasswodRegisterInput" placeholder="Password *" required autocomplete="new-password">
                            <label for="customerPasswodRegisterInput">Password *</label>
                        </div>

                        <div class="d-flex align-items-center mb-3 pb-2">
                            <p class="m-0">Your personal data will be used to support your experience throughout this
                                website, to manage access to your account, and for other purposes described in our
                                privacy policy.</p>
                        </div>

                        <button class="btn btn-primary w-100 text-uppercase" type="submit">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
=======
<main>
    <section class="login-register container">
        <h2 class="d-none">Register</h2>
        <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
            <li class="nav-item" role="presentation">
                <a
                    class="nav-link nav-link_underscore"
                    id="login-tab"
                    data-bs-toggle="tab"
                    href="login"

                    role="tab"
                    aria-controls="tab-item-login"
                    aria-selected="true"
                     onclick="window.location.href='login';"
                >
                    Login
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a
                    class="nav-link nav-link_underscore active"
                    id="register-tab"
                    data-bs-toggle="tab"
                    href="register"
                    role="tab"
                    aria-controls="tab-item-register"
                    aria-selected="false"
                >
                    Register
                </a>
            </li>
        </ul>
        <div class="register-form">
            <form name="register-form" class="needs-validation" novalidate>
                <div class="form-floating mb-3">
                    <input
                        name="register_username"
                        type="text"
                        class="form-control form-control_gray"
                        id="customerNameRegisterInput"
                        placeholder="Username"
                        required
                    />
                    <label for="customerNameRegisterInput">Username</label>
                </div>

                <div class="form-floating mb-3">
                    <input
                        name="register_email"
                        type="email"
                        class="form-control form-control_gray"
                        id="customerEmailRegisterInput"
                        placeholder="Email address *"
                        required
                    />
                    <label for="customerEmailRegisterInput">Email address *</label>
                </div>

                <div class="form-floating mb-3">
                    <input
                        name="register_password"
                        type="password"
                        class="form-control form-control_gray"
                        id="customerPasswodRegisterInput"
                        placeholder="Password *"
                        required
                    />
                    <label for="customerPasswodRegisterInput">Password *</label>
                </div>

                <div class="d-flex align-items-center mb-3 pb-2">
                    <p class="m-0">
                        Your personal data will be used to support your experience throughout this
                        website, to manage access to your account, and for other purposes described in
                        our privacy policy.
                    </p>
                </div>

                <button class="btn btn-primary w-100 text-uppercase" type="submit">
                    Register
                </button>
            </form>
        </div>
    </section>
</main>
@endsection
>>>>>>> 494b3221808695d2ee494655b03d7f0f15d5f351
