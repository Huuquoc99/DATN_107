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
                <h1 class="h1">Email Address</h1>
                <input class="input" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                <button class="button">Send Password Reset Link</button>
            </form>
        </div>
    </div>
@endsection
