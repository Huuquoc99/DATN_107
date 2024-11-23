@extends('client.layouts.master')

@section('content')
{{-- <div class="container">
    <h2>Reset Password</h2>
    
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control">
        </div>
        
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" name="password" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" required class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div> --}}
<div class="container2">
    <div class="container4">
        <form class="form" action="{{route('password.update')}}" method="POST">
            @csrf
            <h1 class="h1">Reset Password</h1>
            <input type="hidden" name="token" value="{{ $token }}">
            <input class="input" type="text" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
            <input class="input" type="password" placeholder="New Password" name="password" required>
            <input class="input" type="password" placeholder="Confirm Password" name="password_confirmation">
            <button class="button">Reset Password</button>
        </form>
    </div>
</div>
@endsection
