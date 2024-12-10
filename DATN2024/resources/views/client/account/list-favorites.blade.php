@extends('client.layouts.master')

@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Danh sách yêu thích</h2>
            <div class="row">
                <div class="col-lg-2">
                    <ul class="account-nav">
                        <li><a href="{{ route('account.dashboard') }}" class="menu-link">Bảng điều khiển</a></li>
                        <li><a href="{{ route('history') }}" class="menu-link">Đơn hàng</a></li>
                        <li><a href="{{ route('favorites.list') }}" class="menu-link menu-link_active">Danh sách yêu thích</a></li>
                        <li><a href="{{ route('accountdetail') }}" class="menu-link">Chi tiết tài khoản</a></li>
                        <li><a href="{{ route('account.changePassword') }}" class="menu-link">Thay đổi mật khẩu</a></li>
                    </ul>
                </div>

                <div class="col-lg-9">
                    <div class="page-content my-account__dashboard">
                        <div class="row">
                            @foreach($favorites as $item)
                            <div class="col-md-3 mb-4">
                                <div class="product-card-wrapper">
                                    <div class="product-card product-card_style9 border rounded-3 bg-white h-100 position-relative">
                                        <div class="position-relative">
                                            <a href="{{ route('product.detail', $item->product->slug) }}">
                                                <div class="pc__img-wrapper pc__img-wrapper_wide3 overflow-hidden">
                                                    <img loading="lazy"
                                                         src="{{ \Illuminate\Support\Facades\Storage::url($item->product->img_thumbnail) }}"
                                                         alt="{{ $item->product->name }}"
                                                         class="pc__img img-fluid w-100 h-auto">
                                                </div>
                                            </a>
                                        </div>
                    
                                        <div class="product-card__overlay">
                                            <button class="favorite-btn"
                                                    onclick="removeFavorite({{ $item->product->id }})"
                                                    data-product-id="{{ $item->product->id }}">
                                                ❤️
                                            </button>
                    
                                            <button class="product-card-view quick-view-btn"
                                                    onclick="openQuickView({{ $item->id }})"
                                                    data-product-id="{{ $item->id }}"
                                                    title="Quick View">
                                                👀
                                            </button>
                                        </div>
                    
                                        <div class="pc__info position-relative">
                                            <p class="pc__category fs-13 fw-medium">
                                                {{ $item->product->catalogue ? $item->product->catalogue->name : 'No category' }}
                                            </p>
                                            <a href="{{ route('product.detail', $item->product->slug) }}">
                                                {{ \Illuminate\Support\Str::limit($item->product->name, 18) }}
                                            </a>
                                            <div class="product-card__price d-flex">
                                                <span class="money price fs-16 fw-semi-bold">
                                                    {{ number_format($item->product->price_regular, 0, ',', '.') }} VND
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
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

