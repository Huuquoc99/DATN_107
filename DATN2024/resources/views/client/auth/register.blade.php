@extends('client.layouts.master')

@section('content')
    {{-- <section class="login-register container">
        <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link nav-link_underscore active" id="register-tab" data-bs-toggle="tab" href="#tab-item-register"
                    role="tab" aria-controls="tab-item-register" aria-selected="true">Register</a>
            </li>
        </ul>

        <div class="tab-content pt-2" id="login_register_tab_content">
            <div class="tab-pane fade show active" id="tab-item-register" role="tabpanel" aria-labelledby="register-tab">
                <div class="register-form">
                    <form name="register-form" class="needs-validation" autocomplete="off" novalidate method="POST"
                        action="{{ route('register') }} ">
                        @csrf
                        <div class="form-floating mb-3">
                            <input name="name" type="text" class="form-control form-control_gray"
                                id="customerNameRegisterInput" placeholder="Username"required autocomplete="off">
                            <label for="customerNameRegisterInput">Username</label>
                            @error('name')
                                <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;"
                                    role="alert">
                                    <p class="text-danger">{{ $message }}</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @enderror
                        </div>

                        <div class="pb-3"></div>

                        <div class="form-floating mb-3">
                            <input name="email" type="email" class="form-control form-control_gray"
                                id="customerEmailRegisterInput" placeholder="Email address *" required autocomplete="off">
                            <label for="customerEmailRegisterInput">Email address *</label>
                            @error('email')
                                <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;"
                                    role="alert">
                                    <p class="text-danger">{{ $message }}</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @enderror
                        </div>

                        <div class="pb-3"></div>

                        <div class="form-floating mb-3">
                            <input name="password" type="password" class="form-control form-control_gray"
                                id="customerPasswodRegisterInput" placeholder="Password *" required
                                autocomplete="new-password">
                            <label for="customerPasswodRegisterInput">Password *</label>
                            @error('password')
                                <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;"
                                    role="alert">
                                    <p class="text-danger">{{ $message }}</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @enderror
                        </div>
                        <div class="pb-3"></div>
                        <div class="form-floating mb-3">
                            <input name="password_confirmation" type="password" class="form-control form-control_gray"
                                id="customerPasswodRegisterInput" placeholder="Password *" required
                                autocomplete="new-password">
                            <label for="customerPasswodRegisterInput"> Confirm Password *</label>
                            @error('confirmed')
                                <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;"
                                    role="alert">
                                    <p class="text-danger">{{ $message }}</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @enderror
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
    </section> --}}
    {{-- <div class="mb-3 mb-xl-5 pb-3 pt-1 pb-xl-4"></div> --}}
   <div class="container2">
    <div class="container1" id="container1">
        <div class="form-container1 register-container1">
            <form class="form" action="{{ route('register') }}" method="POST">
                @csrf
                <h2><b>Sign up</b></h2>
                {{-- <div> --}}
                    <input class="input  @error('name') is-invalid @enderror" type="text" placeholder="Name" name="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                {{-- </div> --}}
                <input class="input  @error('email') is-invalid @enderror" type="email" placeholder="Email"   name="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <input class="input  @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <input class="input  @error('password_confirmation') is-invalid @enderror" type="password" placeholder="Password confirm" name="password_confirmation">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <button class="button" type="submit">Sign up</button>
                {{-- <span class="span1">Đăng nhập bằng</span>
                <div class="social-container1">
                    <a href="#" class="social1"><i class="lni lni-facebook"></i></a>
                    <a href="#" class="social1"><i class="lni lni-tiktok"></i></a>
                    <a href="#" class="social1"><i class="lni lni-google"></i></a>
                </div> --}}
            </form>
        </div>
        <div class="form-container1 login-container1">
            <form class="form" action="{{ route('login') }}" method="POST">
                @csrf
                <h2><b>Sign In</b></h2>
                <input class="input l @error('email') is-invalid @enderror" type="email" placeholder="Email" name="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <input class="input  @error('password') is-invalid @enderror" type="password " placeholder="Password" name="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <div class="content1">
                    <div class="checkbox1">
                        <input class="input" type="checkbox" name="checkbox" id="checkbox">
                        <label>Remember me</label>
                    </div>
                    <div class="pass-link1 m-3">
                        <a href="{{ route('password.request') }}" style="text-decoration: underline;">Forgot password?</a>
                    </div>
                </div>
                <button class="button" type="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container1">
            <div class="overlay1">
                <div class="overlay-panel1 overlay-left1">
                    <h1 class="title1">Sign In <br></h1>
                    <p>If you already have an account, please login here.</p>
                    <button  class="button" id="login1">Sign In 
                        <i class="lni lni-arrow-left"></i>
                    </button>
                </div>
                <div>
                    <div class="overlay-panel1 overlay-right1">
                        <h1 class="title1">Sign up <br> </h1>
                        <p>If you do not have an account, please register here.</p>
                        <button class="button" id="register1">Sign up
                            <i class="lni lni-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>
    {{-- <div class="mb-3 mb-xl-5 pb-3 pt-1 pb-xl-4"></div> --}}
@endsection
