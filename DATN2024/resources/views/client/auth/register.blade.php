@extends('client.layouts.master')
@section('title')
    TechStore
@endsection
@section('content')
   <div class="container2">
    <div class="container1" id="container1">
        <div class="form-container1 register-container1">
            <form class="form" action="{{ route('register') }}" method="POST">
                @csrf
                <h2><b>Đăng ký</b></h2>
                
                <input class="input form-control  @error('name') is-invalid @enderror" type="text" placeholder="Name" name="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <input class="input form-control @error('email') is-invalid @enderror" type="email" placeholder="Email"   name="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <input class="input form-control @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <input class="input form-control @error('password_confirmation') is-invalid @enderror" type="password" placeholder="Password confirm" name="password_confirmation">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <button class="button" type="submit">Đăng ký</button>
            </form>
        </div>
        <div class="form-container1 login-container1">

            <form class="form" action="{{ route('login') }}" method="POST">
                @csrf
                <h2><b>Đăng nhập</b></h2>
                <input class="input form-control @error('email') is-invalid @enderror" type="email" placeholder="Email" name="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                <input class="input form-control  @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="content1">
                        <div class="checkbox1">
                            <input class="input" type="checkbox" name="checkbox" id="checkbox">
                            <label for="checkbox">Ghi nhớ đăng nhập</label>
                        </div>
                        <div class="pass-link1">
                            <a href="{{ route('password.request') }}" style="text-decoration: underline;">Quên mật khẩu?</a>
                        </div>
                    </div>


                <button class="button" type="submit">Đăng nhập</button>
            </form>

        </div>
        <div class="overlay-container1">
            <div class="overlay1">
                <div class="overlay-panel1 overlay-left1">
                    <h1 class="title1">Đăng nhập <br></h1>
                    <p>Nếu bạn đã có tài khoản, vui lòng đăng nhập tại đây.</p>
                    <button class="button" id="login1">Đăng nhập
                        <i class="lni lni-arrow-left"></i>
                    </button>
                </div>
                <div>
                    <div class="overlay-panel1 overlay-right1">
                        <h1 class="title1">Đăng ký <br> </h1>
                        <p>Nếu bạn chưa có tài khoản, vui lòng đăng ký tại đây.</p>
                        <button class="button" id="register1">Đăng ký
                            <i class="lni lni-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>
@endsection
