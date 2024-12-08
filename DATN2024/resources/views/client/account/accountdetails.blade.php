@extends('client.layouts.master')

@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Chi tiết tài khoản</h2>
            <div class="row">
                <div class="col-lg-3">
                    <ul class="account-nav">
                        <li>
                            <a href="{{ route('account.dashboard') }}" class="menu-link menu-link_us-s "
                               style="color: black">Bảng điều khiển</a>
                        </li>
                        <li>
                            <a href="{{ route('history') }}" class="menu-link menu-link_us-s" style="color: black">Đơn hàng</a>
                        </li>
                        <li>
                            <a href="{{ route('favorites.list') }}" class="menu-link menu-link_us-s"
                               style="color: black">Danh sách yêu thích</a>
                        </li>

                        <li>
                            <a href="{{ route('accountdetail') }}" class="menu-link menu-link_us-s menu-link_active"
                               style="color: black">Chi tiết tài khoản</a>
                        </li>
                        <li>
                            <a href="{{ route('account.changePassword') }}" class="menu-link menu-link_us-s"
                               style="color: black">Thay đổi mật khẩu</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__edit">
                        <div class="row">
                            <div class="col-md-5 d-flex align-items-center">
                                <form action="{{ route('account.updateAvatar', $user->id) }}" method="POST"
                                      enctype="multipart/form-data" class="text-center">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <div class="user-avatar-container position-relative">
                                            @if ($user->avatar)
                                                <img src="{{ asset('storage/' . $user->avatar) }}"
                                                     id="preview-avatar"
                                                     class="rounded-circle avatar-sm img-thumbnail user-profile-image"
                                                     alt="user-profile-image">
                                            @else
                                                <img src="{{ asset('theme/admin/assets/images/default-avatar.png') }}"
                                                     id="preview-avatar"
                                                     class="rounded-circle avatar-sm img-thumbnail user-profile-image"
                                                >
                                            @endif

                                            <div class="profile-img-container position-absolute bottom-0 end-0">
                                                <input id="profile-img-file-input" type="file" name="avatar"
                                                       class="profile-img-input d-none"
                                                       onchange="previewImage(event)">
                                                <label for="profile-img-file-input"
                                                       class="profile-img-label d-flex align-items-center justify-content-center">
                                                    <div class="profile-img-overlay">
                                                        <i class="ri-camera-fill"></i>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mb-3">Cập nhật hình đại diện</button>
                                    @if (session('success1'))
                                        <div class="alert alert-success">
                                            {{ session('success1') }}
                                        </div>
                                    @endif
                                    @if ($errors->has('avatar'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('avatar') }}
                                        </div>
                                    @endif

                                </form>

                                <script>
                                    function previewImage(event) {
                                        const input = event.target;
                                        const reader = new FileReader();

                                        reader.onload = function () {
                                            const preview = document.getElementById('preview-avatar');
                                            preview.src = reader.result;
                                        };

                                        if (input.files && input.files[0]) {
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                </script>

                            </div>
                            <div class="col-md-7">
                                <div class="my-account__edit-form">

                                    <div class="col-md-12">
                                        <div class="my-3">
                                            <h5 class="text-uppercase mb-0">Thông tin người dùng</h5>
                                        </div>
                                    </div>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <form name="account_edit_form" class="needs-validation" novalidate
                                          action="{{ route('account.updateProfile', ['id' => $user->id]) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <input type="text"
                                                           class="input form-control @error('name') is-invalid @enderror"
                                                           id="name" placeholder="Tên"
                                                           value="{{ old('name', $user->name) }}" name="name">
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating ">
                                                    <input type="email"
                                                           class="input form-control @error('email') is-invalid @enderror"
                                                           id="email" placeholder="Email"
                                                           value="{{ old('email', $user->email) }}" name="email">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <input type="text"
                                                           class="input form-control @error('phone') is-invalid @enderror"
                                                           id="phone" placeholder="Số điện thoại"
                                                           value="{{ old('phone', $user->phone) }}" name="phone">
                                                    @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <input type="text"
                                                           class="input form-control @error('address') is-invalid @enderror"
                                                           id="address"
                                                           placeholder="Địa chỉ"
                                                           value="{{ old('address', $user->address) }}"
                                                           name="address">
                                                    @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="my-3 text-center">
                                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
