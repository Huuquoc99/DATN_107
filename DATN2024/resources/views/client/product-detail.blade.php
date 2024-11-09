@extends('client.layouts.master')

@section('content')
    <main>
        <div class="mb-md-1 pb-md-3"></div>
        <section class="product-single container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="product-single__media" data-media-type="vertical-thumbnail">
                        <div class="product-single__image">
                            <div class="swiper-container">
                                <div class="product-gallery-horizontal">
                                    <div class="main-image-container">
                                        <img id="mainImage" src="{{ Storage::url($product->img_thumbnail) }}" class="main-image" alt="{{ $product->name }}">
                                        <a href="{{ Storage::url($product->img_thumbnail) }}" class="zoom-btn" data-fancybox="gallery">
                                            <i class="fas fa-search-plus"></i>
                                        </a>
                                        <div class="swiper-button-next">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </div>
                                    </div>
                                    <div class="thumbnail-column">
                                        @foreach($product->galleries as $image)
                                            <div class="thumb-item">
                                                <img src="{{ Storage::url($image->image) }}"
                                                     onclick="changeImage('{{ Storage::url($image->image) }}')"
                                                     alt="{{ $product->name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="swiper-button-prev">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex justify-content-between mb-4 pb-md-2">
                        <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                            <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
                        </div><!-- /.breadcrumb -->


                    </div>
                    <h4 class="product">{{ $product->name }}</h4>
                    <div class="product-single__rating">
                        <div class="reviews-group d-flex">
                            <i class="fa-regular fa-star fa-sm" style="color: #c1e510;"></i>
                            <i class="fa-regular fa-star fa-sm" style="color: #c1e510;"></i>
                            <i class="fa-regular fa-star fa-sm" style="color: #c1e510;"></i>
                            <i class="fa-regular fa-star fa-sm" style="color: #c1e510;"></i>
                            <i class="fa-regular fa-star fa-sm" style="color: #c1e510;"></i>
                        </div>
                        <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>
                    </div>
                    <h5 class="product-single__price" id="product-price">
                        <span>{{ number_format($product->price_regular, 0, ',', '.') }} VND</span>
                        <span style=" font-size: 20px; color: red"><i><del>{{ number_format($product->price_sale, 0, ',', '.') }} VND</del></i></span>
                    </h5>
                    <div class="product-single__short-desc">
                        <p>{{ $product->short_description }}</p>
                    </div>
                    <form action="{{ route('cart.add-to-cart') }}" name="addtocart-form" method="post" class="product-form">
                        @csrf
                        <input type="hidden" name="product_id" data-product-id="{{ $product->id }}" value="{{ $product->id }}">
                        <div class="product-options">
                            <!-- Color Selection -->
                            <div class="option-group mb-4">
                                <label class="option-label">Màu sắc:</label>
                                <div class="option-selections">
                                    @foreach($colors as $id => $color)
                                        <div class="option-item">
                                            <input type="radio"
                                                   class="btn-check"
                                                   id="radio_color_{{ $id }}"
                                                   name="product_color_id"
                                                   value="{{ $id }}"
                                                   {{ $loop->first ? 'checked' : '' }}
                                                   required>
                                            <label class="btn btn-outline color-choice" for="radio_color_{{ $id }}">
                                                <span class="color-dot" style="background-color: {{ $color['color_code'] }};"></span>
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
                                    @foreach($capacities as $id => $name)
                                        <div class="option-item">
                                            <input type="radio"
                                                   class="btn-check"
                                                   id="radio_size_{{ $id }}"
                                                   name="product_capacity_id"
                                                   value="{{ $id }}"
                                                   {{ $loop->first ? 'checked' : '' }}
                                                   required>
                                            <label class="btn btn-outline-secondary" for="radio_size_{{ $id }}">
                                                {{ $name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Quantity Control -->
                            <span class="option-label">Tình trạng:  <span id="stock-status"></span></span>
                            <div class="quantity-control mb-4">
                                <label class="option-label">Số lượng</label>
                                <div class="quantity-wrapper">
                                    <button type="button" class="quantity-btn minus">-</button>
                                    <input type="number"
                                           name="quantity"
                                           value="1"
                                           class="quantity-input @error('quantity') is-invalid @enderror">
                                    <button type="button" class="quantity-btn plus">+</button>
                                </div>

                                @error('quantity')
                                    <div class="text-dark h6">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit"
                                    class="btn btn-primary btn-lg w-100 btn-addtocart"
                                    data-aside="cartDrawer">
                                <i class="ri-shopping-cart-line me-2"></i>
                                Thêm vào giỏ hàng
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
