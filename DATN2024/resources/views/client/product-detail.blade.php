@extends('client.layouts.master')

@section('content')
    <main>
        <div class="mb-md-1 pb-md-3"></div>
        <section class="product-single container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="" data-media-type="vertical-thumbnail">
                        <div class="product-single__image">
                            <div class="swiper-container">
                                <div class="d-flex justify-content-between mb-4 pb-md-2" style="padding-left: 55px">
                                    <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                                        <a href="{{ route('home') }}" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                                        <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                                        <a href="{{ route('shop') }}" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
                                    </div><!-- /.breadcrumb -->
                                </div>
                                <div class="product-gallery-horizontal d-flex justify-content-center" style="padding-left: 55px">
                                    <div class="main-image-container">
                                        <img id="mainImage" style="height: 500px; width: 600px;" src="{{ Storage::url($product->img_thumbnail) }}"
                                            class="main-image" alt="{{ $product->name }}">
                                        <a href="{{ Storage::url($product->img_thumbnail) }}" class="zoom-btn"
                                            data-fancybox="gallery">
                                            <i class="fas fa-search-plus"></i>
                                        </a>
                                    </div>
                                    <div class="thumbnail-column">
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
                <div class="col-lg-5 mt-5">
                    <h4 class="product"><b>{{ $product->name }}</b></h4>

                    <h6 class="product-single__price mt-3" id="product-price" style="font-size: 30px">
                        <span>{{ number_format($product->price_regular, 0, ',', '.') }} VND</span>
                        <span style=" font-size: 20px; color: red"><i><del>{{ number_format($product->price_sale, 0, ',', '.') }}
                                    VND</del></i></span>
                    </h6>
                    <div class="product-single__short-desc">
                        {{ \Illuminate\Support\Str::limit($product->short_description, 200) }}
                    </div>
                    <form action="{{ route('cart.add-to-cart') }}" name="addtocart-form" method="post"
                        class="product-form">
                        @csrf
                        <input type="hidden" name="product_id" data-product-id="{{ $product->id }}"
                            value="{{ $product->id }}">
                        <div class="product-options">
                            <!-- Color Selection -->
                            <div class="option-group mb-4">
                                <label class="option-label">Màu sắc:</label>
                                <div class="option-selections">
                                    @foreach ($colors as $id => $color)
                                        <div class="option-item">
                                            <input type="radio" class="btn-check" id="radio_color_{{ $id }}"
                                                name="product_color_id" value="{{ $id }}"
                                                {{ $loop->first ? 'checked' : '' }} required>
                                            <label class="btn btn-outline color-choice"
                                                for="radio_color_{{ $id }}">
                                                <span class="color-dot"
                                                    style="background-color: {{ $color['color_code'] }};"></span>
                                                <span class="color-name">{{ $color['name'] }}</span>
                                            </label>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                            <!-- Capacity Selection -->
                            <div class="option-group mb-4">
                                <label class="option-label">Dung lượng:</label>
                                <div class="option-selections">
                                    @foreach ($capacities as $id => $name)
                                        <div class="option-item">
                                            <input type="radio" class="btn-check" id="radio_size_{{ $id }}"
                                                name="product_capacity_id" value="{{ $id }}"
                                                {{ $loop->first ? 'checked' : '' }} required>
                                            <label class="btn btn-outline-secondary"
                                                for="radio_size_{{ $id }}">
                                                {{ $name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Quantity Control -->
                            <span class="option-label">Tình trạng: <span id="stock-status"></span></span>
                            <div class="quantity-control mb-4">
                                <label class="option-label">Số lượng</label>
                                <div class="quantity-wrapper">
                                    <button type="button" class="quantity-btn minus">-</button>
                                    <input type="number" name="quantity" value="1"
                                        class="quantity-input @error('quantity') is-invalid @enderror">
                                    <button type="button" class="quantity-btn plus">+</button>
                                </div>

                                @error('quantity')
                                    <div class="text-dark h6">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 btn-addtocart"
                                data-aside="cartDrawer">
                                <i class="ri-shopping-cart-line me-2"></i>
                                Thêm vào giỏ hàng
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="product-single__details-tab">
                <ul class="nav nav-tabs" id="myTab1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab"
                            href="#tab-description" role="tab" aria-controls="tab-description"
                            aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab"
                            href="#tab-additional-info" role="tab" aria-controls="tab-additional-info"
                            aria-selected="false">Additional Information</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab"
                            href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false">Reviews
                            (2)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                        aria-labelledby="tab-description-tab">
                        <div class="product-single__description">
                            <p class="content">{!! $product->description !!} ưdefrgthyju</p>

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
                        <h2 class="product-single__reviews-title">Reviews</h2>
                        <div class="product-single__reviews-list">
                            <div class="product-single__reviews-item">
                                <div class="customer-avatar">
                                    <img loading="lazy" src="../images/avatar.jpg" alt="">
                                </div>
                                <div class="customer-review">
                                    <div class="customer-name">
                                        <h6>Janice Miller</h6>
                                        <div class="reviews-group d-flex">
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="review-date">April 06, 2023</div>
                                    <div class="review-text">
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
                                            minus id quod maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                                    </div>
                                </div>
                            </div>
                            <div class="product-single__reviews-item">
                                <div class="customer-avatar">
                                    <img loading="lazy" src="../images/avatar.jpg" alt="">
                                </div>
                                <div class="customer-review">
                                    <div class="customer-name">
                                        <h6>Benjam Porter</h6>
                                        <div class="reviews-group d-flex">
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="review-date">April 06, 2023</div>
                                    <div class="review-text">
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
                                            minus id quod maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-single__review-form">
                            @include('client.comment')
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>
@endsection
