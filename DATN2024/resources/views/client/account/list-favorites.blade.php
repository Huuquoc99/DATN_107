@extends('client.layouts.master')
@section('title')
    TechStore
@endsection
@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Danh sách yêu thích</h2>
            <div class="row">
                <div class="col-lg-2 shadow">
                    <ul class="account-nav">
                        <li><a href="{{ route('account.dashboard') }}" class="menu-link">Bảng điều khiển</a></li>
                        <li><a href="{{ route('history') }}" class="menu-link">Đơn hàng</a></li>
                        <li><a href="{{ route('favorites.list') }}" class="menu-link menu-link_active">Danh sách yêu thích</a></li>
                        <li><a href="{{ route('accountdetail') }}" class="menu-link">Chi tiết tài khoản</a></li>
                        <li><a href="{{ route('account.changePassword') }}" class="menu-link">Thay đổi mật khẩu</a></li>
                    </ul>
                </div>

                <div class="col-lg-10 shadow mt-5">
                    <div class="row g-4">
                        @foreach($favorites as $item)
                            <div class="col-lg-4 col-md-6">
                                <div class="card h-100 shadow-sm">
                                    <div class="position-relative">
                                        <a href="{{ route('product.detail', $item->product->slug) }}">
                                            <img loading="lazy"
                                                 src="{{ \Illuminate\Support\Facades\Storage::url($item->product->img_thumbnail) }}"
                                                 alt="{{ $item->product->name }}"
                                                 class="card-img-top">
                                        </a>
                                        <div class="position-absolute top-0 end-0 p-2">
                                            <button class="btn btn-light btn-sm" onclick="removeFavorite({{ $item->product->id }})">
                                                ❤️
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body text-center">
                                        <label class="card-text">
                                            {{ $item->product->catalogue ? $item->product->catalogue->name : 'No category' }}
                                        </label>
                                        <h6 class="card-title mb-2">
                                            <a href="{{ route('product.detail', $item->product->slug) }}"
                                               class="text-decoration-none text-dark">
                                                {{ \Illuminate\Support\Str::limit($item->product->name, 18) }}
                                            </a>
                                        </h6>
                                        <p class="fw-bold text">
                                            {{ number_format($item->product->price_regular, 0, ',', '.') }} VND
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        .product-card-wrapper {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .product-card-wrapper.removed {
            transform: translateY(-20px);
            opacity: 0;
        }
    </style>
@endsection