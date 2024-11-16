@extends('client.layouts.master')

@section('content')

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <label for="email">Email Address</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

    <button type="submit">
        Send Password Reset Link
    </button>
</form>
@endsection