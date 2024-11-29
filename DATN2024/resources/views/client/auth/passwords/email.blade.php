@extends('client.layouts.master')

@section('content')
    <div class="container2">
        <div class="container3">
            
            <form class="form" action="{{ route('password.email') }} " method="POST">
                @csrf
                <h2 style="font-size: 50px"><b>Forgot password</b></h2>
                @if (session("status"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session("status")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <input class="input @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
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
