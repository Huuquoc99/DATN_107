@extends('client.layouts.master')

@section('content')
{{-- <div class="container">
    <h2>Reset Password</h2>
    
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" autofocus class="form-control">
        </div>
        
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" name="password" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div> --}}
<div class="container2">
    <div class="container4">
        <form class="form" action="{{route('password.update')}}" method="POST">
            @csrf
            <h2 style="font-size: 50px"><b>Reset Password</b></h2>
            <input type="hidden" name="token" value="{{ $token }}">
            <input class="input form-control @error('email') is-invalid @enderror" type="text" placeholder="Email" name="email" value="{{ old('email') }}" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            <input class="input form-control @error('password') is-invalid @enderror" type="password" placeholder="New Password" name="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            <input class="input form-control @error('password_confirmation') is-invalid @enderror" type="password" placeholder="Confirm Password" name="password_confirmation">
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            <button class="button" type="submit">Reset Password</button>
        </form>
    </div>
</div>
@endsection
