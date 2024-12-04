@extends('client.layouts.master')

@section('content')
   <div class="container2">
    <div class="container1" id="container1">
        <div class="form-container1 register-container1">
            <form class="form" action="{{ route('register') }}" method="POST">
                @csrf
                <h2><b>Sign up</b></h2>
                {{-- <div> --}}
                    <input class="input form-control  @error('name') is-invalid @enderror" type="text" placeholder="Name" name="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                {{-- </div> --}}
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
                <button class="button" type="submit">Sign up</button>
            </form>
        </div>
        <div class="form-container1 login-container1">
            
            <form class="form" action="{{ route('login') }}" method="POST">
                @csrf
                <h2><b>Sign In</b></h2>
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
                    {{-- @if (session('error'))
                        <div class="text-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif --}}
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
@endsection
