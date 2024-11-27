@extends('client.layouts.master')

@section('content')
    <div style="padding-top: 110px;">
        <section class="product-single container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="" data-media-type="vertical-thumbnail">
                        <div class="product-single__image">
                            <div class="swiper-container">
                                <div class="d-flex justify-content-between mb-4 pb-md-2" style="padding-left: 55px">
                                    <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                                        <a href="{{ route('home') }}"
                                            class="menu-link menu-link_us-s text-uppercase fw-medium"
                                            style="color:black">Home</a>
                                        <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1"
                                            style="color:black">/</span>
                                        <a href="{{ route('shop') }}"
                                            class="menu-link menu-link_us-s text-uppercase fw-medium"
                                            style="color:black">The Shop</a>
                                    </div><!-- /.breadcrumb -->
                                </div>
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
                    <form action="{{ route('cart.add-to-cart') }}" name="addtocart-form" method="post" class="">
                        @csrf
                        <input type="hidden" name="product_id" data-product-id="{{ $product->id }}"
                            value="{{ $product->id }}">
                        <div class="product-options">
                            <!-- Color Selection -->
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
                                                <span class="color-dot"
                                                    style="background-color: {{ $color['color_code'] }};"></span>
                                                <span class="color-name">{{ $color['name'] }}</span>
                                            </label>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                            <!-- Capacity Selection -->
                            <div class="option-group mb-3">
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

                            <!-- Quantity Control -->

                            <div class="quantity-control d-flex align-items-center mb-4">
                                <label class="option-label" style="padding-top: 9px;">Số lượng</label>
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
                            <span class="option-label">Tình trạng: <span id="stock-status"></span></span>

                            <button type="submit" class="btn btn-primary btn-lg w-100 btn-addtocart"
                                data-aside="cartDrawer">
                                <i class="ri-shopping-cart-line me-2"></i>
                                Add to cart
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

                    <div class="tab-pane fade" id="tab-additional-info" role="tabpanel"
                        aria-labelledby="tab-additional-info-tab">
                        <div class="product-single__additional-info p-3">
                            <div class="product-gallery-horizontal d-flex justify-content-center"
                                style="padding-left: 55px; position: relative;">
                                <div class="main-image-container" style="position: relative;">
                                    <img id="mainImage" style="height: 500px; width: 600px; object-fit: cover;"
                                        src="{{ Storage::url($product->img_thumbnail) }}" class="main-image"
                                        alt="{{ $product->name }}">
                                    <a href="{{ Storage::url($product->img_thumbnail) }}" class="zoom-btn"
                                        data-fancybox="gallery">
                                        <i class="fas fa-search-plus"></i>
                                    </a>
                                </div>
                                <div class="thumbnail-column"
                                    style="display: flex; flex-direction: column; margin-left: 20px; position: absolute; top: 0; left: 650px;">
                                    @foreach ($product->galleries as $image)
                                        <div class="thumb-item" style="margin-bottom: 10px;">
                                            <img src="{{ Storage::url($image->image) }}"
                                                style="width: 100px; height: auto; cursor: pointer;"
                                                onclick="changeImage('{{ Storage::url($image->image) }}')"
                                                alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="tab-pane fade" id="tab-additional-info" role="tabpanel" aria-labelledby="tab-additional-info-tab">
    <div class="product-single__additional-info">
        <div class="row gy-3">
            <div class="info-row d-flex justify-content-between">
                <span class="info-label">Screen Size</span>
                <span class="info-value">{{ $product->screen_size }}</span>
            </div>
            <div class="info-row d-flex justify-content-between">
                <span class="info-label">Battery Capacity</span>
                <span class="info-value">{{ $product->battery_capacity }}</span>
            </div>
            <div class="info-row d-flex justify-content-between">
                <span class="info-label">Camera Resolution</span>
                <span class="info-value">{{ $product->camera_resolution }}</span>
            </div>
            <div class="info-row d-flex justify-content-between">
                <span class="info-label">Operating System</span>
                <span class="info-value">{{ $product->operating_system }}</span>
            </div>
            <div class="info-row d-flex justify-content-between">
                <span class="info-label">Processor</span>
                <span class="info-value">{{ $product->processor }}</span>
            </div>
            <div class="info-row d-flex justify-content-between">
                <span class="info-label">RAM</span>
                <span class="info-value">{{ $product->ram }}</span>
            </div>
            <div class="info-row d-flex justify-content-between">
                <span class="info-label">Storage</span>
                <span class="info-value">{{ $product->storage }}</span>
            </div>
            <div class="info-row d-flex justify-content-between">
                <span class="info-label">SIM Type</span>
                <span class="info-value">{{ $product->sim_type }}</span>
            </div>
            <div class="info-row d-flex justify-content-between">
                <span class="info-label">Network Connectivity</span>
                <span class="info-value">{{ $product->network_connectivity }}</span>
            </div>
        </div>
    </div>
</div> --}}




                    <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
                        <h2 class="product-single__reviews-title">Reviews</h2>
                        @include('client.list-comment', [
                            'productId' => $product->id,
                            'comments' => $comments,
                        ])
                        <div class="text-center load-more-container"
                            style="display: {{ $comments->hasMorePages() ? 'block' : 'none' }}">
                            <button id="load-more-reviews" class="btn btn-sm btn-primary load-more-reviews">Load
                                More</button>
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
