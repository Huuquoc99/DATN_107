@extends('client.layouts.master')

@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Thay đổi mật khẩu</h2>
            <div class="row">
                <div class="col-lg-3">
                    <ul class="account-nav">
                        <li><a href="{{ route('account.dashboard') }}" class="menu-link menu-link_us-s "style="color: black">Bảng điều khiển</a></li>
                        <li><a href="{{ route('history') }}" class="menu-link menu-link_us-s" style="color: black">Đơn hàng</a></li>
                        <li><a href="{{ route('favorites.list') }}" class="menu-link menu-link_us-s"style="color: black">Danh sách yêu thích</a></li>
                        <li><a href="{{ route('accountdetail') }}" class="menu-link menu-link_us-s" style="color: black">Chi tiết tài khoản</a></li>
                        <li><a href="{{ route('account.changePassword') }}"
                                class="menu-link menu-link_us-s menu-link_active" style="color: black">Thay đổi mật khẩu</a></li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__edit">
                        <div class="my-account__edit-form">
                            <div class="col-md-12">
                                <div class="my-3">
                                    <h5 class="text-uppercase mb-0">Thay đổi mật khẩu</h5>
                                </div>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form name="account_edit_form" class="needs-validation" novalidate action="{{ route('account.updatePassword', Auth::user()->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="password" class="input form-control @error('old_password') is-invalid @enderror" id="old_password" placeholder="Mật khẩu" name="old_password">
                                            @error('old_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="password" class="input form-control @error('new_password') is-invalid @enderror" id="new_password" placeholder="Mật khẩu mới" name="new_password">
                                            @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="password" class="input form-control @error('new_password_confirmation') is-invalid @enderror" id="Nhập lại mật khẩu mới" placeholder="new_password_confirmation" name="new_password_confirmation">
                                            @error('new_password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="my-3">
                                            <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
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
