@extends('client.layouts.master')

@section('content')
    {{-- <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label for="email">Email Address</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

        <button type="submit">
            Send Password Reset Link
        </button>
    </form> --}}
    <div class="container2">
        <div class="container3">
            
            <form class="form" action="{{ route('password.email') }} " method="POST">
                @csrf
                {{-- <h1>Forgot password</h1> --}}
                <h2 style="font-size: 50px"><b>Forgot password</b></h2>
                @if (session("status"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session("status")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <input class="input form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <button class="button">Send Password Reset Link</button>
            </form>
        </div>
    </div>
@endsection
