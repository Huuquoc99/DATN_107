@extends('client.layouts.master')

@section('title')
    Home
@endsection

@section('content')
    @include('client.layouts.partials.banner')

    @include('client.layouts.partials.shop-by-categories')

    <div class="bg-grey">
        <section class="featured-products container">
            <div class="d-flex align-items-center justify-content-md-between flex-wrap mb-3 mb-xl-4">
                <h2 class="section-title fw-semi-bold fs-30 theme-color text-uppercase">Ưu Đãi Đặc Biệt</h2>
                <ul class="nav nav-tabs justify-content-center" id="collections-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore underscore-md text-uppercase theme-color fs-13 fw-semi-bold active"
                           id="collections-tab-1-trigger" data-bs-toggle="tab" href="#collections-tab-1" role="tab"
                           aria-controls="collections-tab-1" aria-selected="true">Sản Phẩm Mới</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore underscore-md text-uppercase fs-13 fw-semi-bold theme-color"
                           id="collections-tab-2-trigger" data-bs-toggle="tab" href="#collections-tab-2" role="tab"
                           aria-controls="collections-tab-2" aria-selected="true">Bán Chạy Nhất</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore underscore-md text-uppercase fs-13 fw-semi-bold theme-color"
                           id="collections-tab-3-trigger" data-bs-toggle="tab" href="#collections-tab-3" role="tab"
                           aria-controls="collections-tab-3" aria-selected="true">Xem Nhiều Nhất</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content pt-2" id="collections-tab-content">
                <div class="tab-pane fade show active" id="collections-tab-1" role="tabpanel"
                     aria-labelledby="collections-tab-1-trigger">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-4">
                        @foreach($productNew as $item)
                            <div class="product-card-wrapper mb-4">
                                <div
                                    class="product-card product-card_style9 border rounded-3 bg-white h-100 position-relative">
                                    <div class="position-relative">
                                        <a href="{{ route('product.detail', $item->slug) }}" class="">
                                            <div class="pc__img-wrapper pc__img-wrapper_wide3 overflow-hidden">
                                                <img loading="lazy"
                                                     src="{{ \Illuminate\Support\Facades\Storage::url($item->img_thumbnail) }}"
                                                     alt="{{ $item->name }}"
                                                     class="pc__img img-fluid w-75 h-auto"
                                                     style="margin-left: 25px; margin-top:20px;">
                                            </div>
                                        </a>

                                        <div class="product-card__overlay">
                                            <button class="product-card__action-btn favorite-btn"
                                                    onclick="toggleFavorite({{ $item->id }})"
                                                    data-product-id="{{ $item->id }}">
                                                {{ in_array($item->id, $favoriteProductIds) ? '❤️' : '🤍' }}
                                            </button>

                                            <button class="product-card-view quick-view-btn"
                                                    onclick="openQuickView({{ $item->id }})"
                                                    data-product-id="{{ $item->id }}"
                                                    title="Quick View">
                                                👀
                                            </button>

                                        </div>

                                    </div>

                                    <div class="pc__info position-relative">
                                        <p class="pc__category fs-13 fw-medium">
                                            {{ $item->catalogue ? $item->catalogue->name : 'No category' }}
                                        </p>
                                        <h6 class="pc__title fs-16 mb-2">
                                            <a
                                                href="{{ route('product.detail', $item->slug) }}" title="{{ $item->name }}">{{ \Illuminate\Support\Str::limit($item->name, 20) }}
                                            </a>
                                        </h6>
                                        <div class="product-card__price d-flex">
                                            <span class="money price fs-16 fw-semi-bold">
                                                {{ number_format($item->price_regular, 0, ',', '.') }} VND
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="tab-pane fade" id="collections-tab-2" role="tabpanel"
                     aria-labelledby="collections-tab-2-trigger">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-4">
                        @foreach($productHot as $item)
                            <div class="product-card-wrapper mb-4">
                                <div
                                    class="product-card product-card_style9 border rounded-3 bg-white h-100 position-relative">
                                    <div class="position-relative">
                                        <a href="{{ route('product.detail', $item->slug) }}" class="">
                                            <div class="pc__img-wrapper pc__img-wrapper_wide3 overflow-hidden">
                                                <img loading="lazy"
                                                     src="{{ \Illuminate\Support\Facades\Storage::url($item->img_thumbnail) }}"
                                                     alt="{{ $item->name }}"
                                                     class="pc__img img-fluid w-75 h-auto"
                                                     style="margin-left: 25px; margin-top:20px;">
                                            </div>
                                        </a>

                                        <div class="product-card__overlay">
                                            <button class="product-card__action-btn favorite-btn"
                                                    onclick="toggleFavorite({{ $item->id }})"
                                                    data-product-id="{{ $item->id }}">
                                                {{ in_array($item->id, $favoriteProductIds) ? '❤️' : '🤍' }}
                                            </button>

                                            <button class="product-card-view quick-view-btn"
                                                    onclick="openQuickView({{ $item->id }})"
                                                    data-product-id="{{ $item->id }}"
                                                    title="Quick View">
                                                👀
                                            </button>

                                        </div>

                                    </div>

                                    <div class="pc__info position-relative">
                                        <p class="pc__category fs-13 fw-medium">
                                            {{ $item->catalogue ? $item->catalogue->name : 'No category' }}
                                        </p>
                                        <h6 class="pc__title fs-16 mb-2">
                                            <a
                                                href="{{ route('product.detail', $item->slug) }}" title="{{ $item->name }}">{{ \Illuminate\Support\Str::limit($item->name, 20) }}
                                            </a>
                                        </h6>
                                        <div class="product-card__price d-flex">
                                            <span class="money price fs-16 fw-semi-bold">
                                                {{ number_format($item->price_regular, 0, ',', '.') }} VND
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="collections-tab-3" role="tabpanel"
                     aria-labelledby="collections-tab-3-trigger">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-4">
                        @foreach($productGood as $item)
                            <div class="product-card-wrapper mb-4">
                                <div class="product-card product-card_style9 border rounded-3 bg-white h-100">
                                    <div class="position-relative">
                                        <a href="{{ route('product.detail', $item->slug) }}" class="">
                                            <div class="pc__img-wrapper pc__img-wrapper_wide3 overflow-hidden ">
                                                <img loading="lazy"
                                                     src="{{ \Illuminate\Support\Facades\Storage::url($item->img_thumbnail) }}"
                                                     alt="{{ $item->name }}"
                                                     class="pc__img img-fluid w-75 h-auto"
                                                     style="margin-left: 25px; margin-top:20px;">
                                        </a>
                                    </div>
                                </div>
                                <div class="pc__info position-relative">
                                    <p class="pc__category fs-13 fw-medium">{{ $item->catalogue ? $item->catalogue->name : 'No category' }}</p>
                                    <h6 class="pc__title fs-16 mb-2">
                                        <a
                                            href="{{ route('product.detail', $item->slug) }}" title="{{ $item->name }}">{{ \Illuminate\Support\Str::limit($item->name, 20) }}
                                        </a>
                                    </h6>

                                    <div class="product-card__price d-flex">
                                        <span class="money price fs-16 fw-semi-bold">{{ number_format($item->price_regular, 0, ',', '.') }} VND</span>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>

                
            </div>
    </div>
    </section>
    <section class="banners container">
        <div class="row">
            @foreach ($banners as $banner)
            @if ($banner->id == 1 || $banner->id == 2 ||$banner->id == 3)
                <div class="col-lg-4">
                    <div class="position-relative overflow-hidden border-radius-10">
                        <img loading="lazy" src="{{ asset('storage/' . $banner->image) }}" width="448" height="235" alt="{{ $banner->title }}">
                    
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </section>
    
    <div class="bg-grey py-5">
    <section class="featured-products container">
        {{-- <div class="d-flex align-items-center justify-content-between mb-4">
            <h2 class="section-title fw-semi-bold fs-30 theme-color text-uppercase">Ưu Đãi Đặc Biệt</h2>
            <div>
                <button class="btn btn-outline-secondary me-2" data-bs-target="#productCarousel" data-bs-slide="prev">❮</button>
                <button class="btn btn-outline-secondary" data-bs-target="#productCarousel" data-bs-slide="next">❯</button>
            </div>
        </div> --}}

        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        @foreach($productNew as $key => $item)
                            @if($key % 4 == 0 && $key != 0)
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                            @endif
                            <div class="col-6 col-md-3">
                                <div class="product-card border rounded-3 bg-white h-100 position-relative">
                                    <a href="{{ route('product.detail', $item->slug) }}">
                                        <div class="pc__img-wrapper overflow-hidden">
                                            <img loading="lazy"
                                                 src="{{ \Illuminate\Support\Facades\Storage::url($item->img_thumbnail) }}"
                                                 alt="{{ $item->name }}"
                                                 class="pc__img img-fluid w-75 h-auto"
                                                     style="margin-left: 25px; margin-top:20px;">
                                        </div>
                                    </a>
                                    <div class="pc__info mt-3 text-center">
                                        <p class="pc__category fs-13 fw-medium">
                                            {{ $item->catalogue ? $item->catalogue->name : 'No category' }}
                                        </p>
                                        <h6 class="pc__title fs-16 mb-2">
                                            <a href="{{ route('product.detail', $item->slug) }}">
                                                {{ \Illuminate\Support\Str::limit($item->name, 20) }}
                                            </a>
                                        </h6>
                                        <div class="product-card__price">
                                            <span class="money price fs-16 fw-semi-bold">
                                                {{ number_format($item->price_regular, 0, ',', '.') }} VND
                                            </span>
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
</div>


    </section>
    </div>

@endsection
