@extends('client.layouts.master')

@section('content')
    <div class="breadcrumb">
        <section class="product-single container">
            @include('client.components.breadcrumb', [
                'breadcrumbs' => [
                    [
                        'label' => 'Điện thoại ' . $product->catalogue->name,
                        'url' => route('shop', array_merge(request()->except('c'),
                            request()->get('c') == $product->catalogue->id
                                ? []
                                : ['c' => $product->catalogue->id])
                        )
                    ]
                ]
            ])
                
            <div class="row">
                <div class="col-lg-7">
                    <div class="" data-media-type="vertical-thumbnail">
                        <div class="product-single__image">
                            <div class="swiper-container">
                                <div class="product-gallery-horizontal d-flex justify-content-center">
                                    <div class="main-image-container">
                                        <img id="mainImage" style="height: 515px; width: 600px;"
                                            src="{{ Storage::url($product->img_thumbnail) }}" class="main-image"
                                            alt="{{ $product->name }}">
                                        <a href="{{ Storage::url($product->img_thumbnail) }}" class="zoom-btn"
                                            data-fancybox="gallery">
                                            <i class="fas fa-search-plus"></i>
                                        </a>
                                    </div>
                                    <div class="thumbnail-column" style="padding-left: 30px">
                                        @foreach ($product->galleries as $image)
                                            <div class="thumb-item">
                                                <img src="{{ Storage::url($image->image) }}"
                                                    onclick="changeImage('{{ Storage::url($image->image) }}')"
                                                    alt="{{ $product->name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <h4 class="product"><b>{{ $product->name }}</b></h4>

                    <h6 class="product-single__price mt-3" id="product-price" style="font-size: 30px">
                        <span style=" font-size: 20px; color: red">{{ number_format($product->price_sale, 0, ',', '.') }}
                                    VND</span>
                        <span><i><del>{{ number_format($product->price_regular, 0, ',', '.') }} VND</del></i></span>
                    </h6>
                    <div class="product-single__short-desc">
                        {{ \Illuminate\Support\Str::limit($product->short_description, 200) }}
                    </div>
                    <form action="{{ route('cart.add-to-cart') }}" name="addtocart-form" method="post" class="">
                        @csrf
                        <input type="hidden" name="product_id" data-product-id="{{ $product->id }}"
                            value="{{ $product->id }}">
                        <div class="product-options">
                            <div class="option-group mb-2">
                                <label class="option-label">Màu sắc:</label>
                                <div class="option-selections">
                                    @foreach ($colors as $id => $color)
                                        <div class="option-item">
                                            <input type="radio" class="btn-check" id="radio_color_{{ $id }}"
                                                name="product_color_id" value="{{ $id }}"
                                                {{ $loop->first ? 'checked' : '' }} required>
                                            <label class="btn btn-outline color-choice"
                                                for="radio_color_{{ $id }}">
                                                {{-- <span class="color-dot"
                                                    style="background-color: {{ $color['color_code'] }};"></span>
                                                <span class="color-name">{{ $color['name'] }}</span> --}}
                                                <div class="color-dot"
                                                    style="background-color: {{ $color['color_code'] }};"></div>
                                                <div class="color-name">{{ $color['name'] }}</div>
                                            </label>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="option-group" style="margin-bottom:10px;">
                                <label class="option-label">Dung lượng:</label>
                                <div class="option-selections">
                                    @foreach ($capacities as $id => $name)
                                        <div class="option-item">
                                            <input type="radio" class="btn-check" id="radio_size_{{ $id }}"
                                                name="product_capacity_id" value="{{ $id }}"
                                                {{ $loop->first ? 'checked' : '' }} required>
                                            <label class="btn btn-outline-secondary" for="radio_size_{{ $id }}">
                                                {{ $name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="quantity-control d-flex align-items-center mb-4">
                                <label class="option-label" style="padding-top: 9px;">Số lượng:</label>
                                <div class="quantity-wrapper" style="margin-left: 35px;">
                                    <button type="button" class="quantity-btn minus">-</button>
                                    <input type="number" name="quantity" value="1"
                                        class="quantity-input @error('quantity') is-invalid @enderror">
                                    <button type="button" class="quantity-btn plus">+</button>
                                </div>

                                @error('quantity')
                                    <div class="text-dark h6">{{ $message }}</div>
                                @enderror
                            </div>
                            <span class="option-label">Trạng thái: <span id="stock-status"></span></span>

                            <button type="submit" class="btn btn-primary btn-lg w-100 btn-addtocart"
                                data-aside="cartDrawer">
                                <i class="ri-shopping-cart-line me-2"></i>
                                Thêm giỏ hàng
                            </button>

                            <a class="mt-5 fs-15" type="submit"
                                onclick="toggleFavorite({{ $product->id }})"
                                data-product-id="{{ $product->id }}">
                                THÊM VÀO DANH SÁCH YÊU THÍCH
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="product-single__details-tab">
                <ul class="nav nav-tabs" id="myTab1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab"
                            href="#tab-description" role="tab" aria-controls="tab-description"
                            aria-selected="true">Mô tả</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab"
                            href="#tab-additional-info" role="tab" aria-controls="tab-additional-info"
                            aria-selected="false">Thông tin bổ sung</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab"
                            href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false">Đánh giá
                            ( <span id="review-count">{{ $comments->total() }} </span>)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                        aria-labelledby="tab-description-tab">
                        <div class="product-single__description">
                            <p class="content">{!! $product->description !!}</p>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab-additional-info" role="tabpanel" aria-labelledby="tab-additional-info-tab">
                        <div class="product-single__additional-info p-3">
                            <div class="row gy-3">
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <label class="h6 mb-0">Screen Size</label>
                                        <span>{{ $product->screen_size }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <label class="h6 mb-0">Battery Capacity</label>
                                        <span>{{ $product->battery_capacity }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <label class="h6 mb-0">Camera Resolution</label>
                                        <span>{{ $product->camera_resolution }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <label class="h6 mb-0">Operating System</label>
                                        <span>{{ $product->operating_system }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <label class="h6 mb-0">Processor</label>
                                        <span>{{ $product->processor }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <label class="h6 mb-0">RAM</label>
                                        <span>{{ $product->ram }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <label class="h6 mb-0">Storage</label>
                                        <span>{{ $product->storage }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <label class="h6 mb-0">SIM Type</label>
                                        <span>{{ $product->sim_type }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <label class="h6 mb-0">Network Connectivity</label>
                                        <span>{{ $product->network_connectivity }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
                        <h2 class="product-single__reviews-title">Đánh giá</h2>
                        @include('client.list-comment', [
                            'productId' => $product->id,
                            'comments' => $comments,
                        ])
                        <div class="text-center load-more-container"
                            style="display: {{ $comments->hasMorePages() ? 'block' : 'none' }}">
                            <button id="load-more-reviews" class="btn btn-sm btn-primary load-more-reviews">Tải nhiều hơn</button>
                        </div>
                        <div class="product-single__review-form mt-4">
                            @include('client.comment', [
                                'comments' => $comments,
                                'product_id' => $product->id,
                            ])
                        </div>
                    </div>
                </div>
            </div>
            @include('client.modal-update-comment', [
                'comments' => $comments,
                'product_id' => $product->id,
            ])

            <div class="tab-pane fade show active" id="collections-tab-3" role="tabpanel"
                aria-labelledby="collections-tab-3-trigger">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-4">
                    @foreach ($relatedProducts as $item)
                        <div class="product-card-wrapper mb-4">
                            <div class="product-card product-card_style9 border rounded-3 bg-white h-100">
                                <div class="position-relative">
                                    <a href="{{ route('product.detail', $item->slug) }}" class="">
                                        <div class="pc__img-wrapper pc__img-wrapper_wide3 overflow-hidden ">
                                            <img loading="lazy"
                                                src="{{ \Illuminate\Support\Facades\Storage::url($item->img_thumbnail) }}"
                                                alt="{{ $item->name }}" class="pc__img img-fluid w-75 h-auto"
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
                                        {{ $item->catalogue ? $item->catalogue->name : 'No category' }}</p>
                                    <h6 class="pc__title fs-16 mb-2"><a
                                            href="">{{ \Illuminate\Support\Str::limit($item->name, 20) }}</a></h6>

                                    <div class="product-card__price d-flex">
                                        <span
                                            class="money price fs-16 fw-semi-bold">{{ number_format($item->price_regular, 0, ',', '.') }}
                                            VND</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </section>
    </div>
@endsection
