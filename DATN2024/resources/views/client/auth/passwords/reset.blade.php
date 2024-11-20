@extends('client.layouts.master')

@section('content')
<div class="container">
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
</div>
@endsection
