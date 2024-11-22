@extends('client.layouts.master')

@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Password change</h2>
            <div class="row">
                <div class="col-lg-3">
                    <ul class="account-nav">
                        <li><a href="{{ route('account.dashboard') }}" class="menu-link menu-link_us-s ">Dashboard</a></li>
                        <li><a href="{{ route('history') }}" class="menu-link menu-link_us-s">Orders</a></li>
                        <li><a href="{{ route('accountdetail') }}" class="menu-link menu-link_us-s">Account Details</a></li>
                        <li><a href="{{ route('account.changePassword') }}"
                                class="menu-link menu-link_us-s menu-link_active">Password change</a></li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__edit">
                        <div class="my-account__edit-form">
                            <div class="col-md-12">
                                <div class="my-3">
                                    <h5 class="text-uppercase mb-0">Password change</h5>
                                </div>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                            <form name="account_edit_form" class="needs-validation" novalidate action="{{ route('account.updatePassword', Auth::user()->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input type="password" class="input" id="old_password" placeholder="Password" name="old_password">
                                            {{-- <label for="old_password">Old Password</label> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input type="password" class="input" id="new_password" placeholder="Phone" name="new_password">
                                            {{-- <label for="new_password">New Password</label> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input type="password" class="input" id="new_password_confirmation" placeholder="Email" name="new_password_confirmation">
                                            {{-- <label for="new_password_confirmation">Confirm password</label> --}}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="my-3">
                                            <button class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
