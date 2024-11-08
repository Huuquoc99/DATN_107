@extends('client.layouts.master')

@section('content')
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
                    <form name="register-form" class="needs-validation" autocomplete="off" novalidate method="POST" action="{{ route('register') }} ">
                        @csrf
                        <div class="form-floating mb-3">
                            <input name="name" type="text" class="form-control form-control_gray"
                                   id="customerNameRegisterInput" placeholder="Username"required autocomplete="off">
                            <label for="customerNameRegisterInput">Username</label>
                        </div>

                        <div class="pb-3"></div>

                        <div class="form-floating mb-3">
                            <input name="email" type="email" class="form-control form-control_gray"
                                   id="customerEmailRegisterInput" placeholder="Email address *" required autocomplete="off">
                            <label for="customerEmailRegisterInput">Email address *</label>
                        </div>

                        <div class="pb-3"></div>

                        <div class="form-floating mb-3">
                            <input name="password" type="password" class="form-control form-control_gray"
                                   id="customerPasswodRegisterInput" placeholder="Password *" required autocomplete="new-password">
                            <label for="customerPasswodRegisterInput">Password *</label>
                        </div>
                        <div class="pb-3"></div>
                        <div class="form-floating mb-3">
                            <input name="password_confirmation" type="password" class="form-control form-control_gray"
                                   id="customerPasswodRegisterInput" placeholder="Password *" required autocomplete="new-password">
                            <label for="customerPasswodRegisterInput"> Confirm Password *</label>
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
