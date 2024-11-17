@extends('admin.layouts.master')

@section('title')
    Account
@endsection

@section('content')
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            @if ($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" class="profile-wid-img" alt="">
            @else
                <img src="{{ asset('theme/admin/assets/images/default-avatar.png') }}" class="profile-wid-img" alt="">
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">

                        <form action="{{ route('admin.account.updateAvatar', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                                    @if ($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}"
                                            class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                            alt="user-profile-image">
                                    @else
                                        <img src="{{ asset('theme/admin/assets/images/default-avatar.png') }}"
                                            class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                            alt="user-profile-image">
                                    @endif
                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                        <input id="profile-img-file-input" type="file" name="avatar"
                                            class="profile-img-file-input">
                                        <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                <i class="ri-camera-fill"></i>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update avatar</button>
                        </form>

                        <h5 class="fs-16 mb-1 mt-3">{{ Auth::user()->name }}</h5>
                        <p class="text-muted mb-0">{{ Auth::user()->type == 1 ? 'Admin' : 'User' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i> Personal Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i> Change Password
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif --}}
                            <form action="{{ route('admin.account.updateProfile', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name"
                                                value="{{ old('name', $user->name) }}" name="name">
                                            @error('name')
                                                <div class="alert alert-danger alert-dismissible fade show mt-4"
                                                    style="height: 45px;" role="alert">
                                                    <p class="text-danger">{{ $message }}</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email"
                                                value="{{ old('email', $user->email) }}" name="email">
                                            @error('email')
                                                <div class="alert alert-danger alert-dismissible fade show mt-4"
                                                    style="height: 45px;" role="alert">
                                                    <p class="text-danger">{{ $message }}</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="number" class="form-control" id="phone"
                                                value="{{ old('phone', $user->phone) }}" name="phone">
                                            @error('phone')
                                                <div class="alert alert-danger alert-dismissible fade show mt-4"
                                                    style="height: 45px;" role="alert">
                                                    <p class="text-danger">{{ $message }}</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address"
                                                value="{{ old('address', $user->address) }}" name="address">
                                            @error('address')
                                                <div class="alert alert-danger alert-dismissible fade show mt-4"
                                                    style="height: 45px;" role="alert">
                                                    <p class="text-danger">{{ $message }}</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Updates</button>
                                            {{-- <button type="button" class="btn btn-soft-success">Cancel</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane" id="changePassword" role="tabpanel">

                            @if (session('success1'))
                                <div class="alert alert-success">
                                    {{ session('success1') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error1)
                                        {{ $error1 }}
                                    @endforeach
                                </div>
                            @endif

                            <form action="{{ route('admin.account.changePassword', Auth::user()->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row g-2">
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                            <input type="password" name="old_password" class="form-control"
                                                id="oldpasswordInput" placeholder="Enter current password">
                                            {{-- @error('old_password') 
                                                <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;" role="alert">
                                                    <p class="text-danger">{{ $message }}</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="newpasswordInput" class="form-label">New Password*</label>
                                            <input type="password" name="new_password" class="form-control"
                                                id="newpasswordInput" placeholder="Enter new password">
                                            {{-- @error('new_password') 
                                                <div class="alert alert-danger alert-dismissible fade show mt-4" style="height: 45px;" role="alert">
                                                    <p class="text-danger">{{ $message }}</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="new_password_confirmation" class="form-label">Confirm
                                                Password*</label>
                                            <input type="password" name="new_password_confirmation" class="form-control"
                                                id="new_password_confirmation" placeholder="Confirm password">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Change Password</button>
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



@endsection

@section('script-libs')
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
@endsection
