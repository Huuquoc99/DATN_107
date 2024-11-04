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

                        <div
                            class="product-single__prev-next d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
                            <a href="#" class="text-uppercase fw-medium disabled">
                                <svg class="mb-1px" width="10" height="10" viewBox="0 0 25 25"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_prev_md"/>
                                </svg>
                                <span class="menu-link menu-link_us-s">Prev</span></a>
                            <a href="product2_variable.html" class="text-uppercase fw-medium"><span
                                    class="menu-link menu-link_us-s">Next</span>
                                <svg class="mb-1px" width="10" height="10" viewBox="0 0 25 25"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_next_md"/>
                                </svg>
                            </a>
                        </div><!-- /.shop-acs -->
                    </div>
                    <h1 class="product-single__name">{{ $product->name }}</h1>
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
                    <div class="product-single__price">
                        <span>{{ number_format($product->price_regular, 0, ',', '.') }} VND</span>
                        <span style=" font-size: 20px; color: red"><i><del>{{ number_format($product->price_sale, 0, ',', '.') }} VND</del></i></span>

                        {{--                        @foreach($product->variants as $variant)--}}
{{--                        <span>{{ $variant->price }}</span>--}}
{{--                        @endforeach--}}
                    </div>
                    <div class="product-single__short-desc">
                        <p>{{ $product->short_description }}</p>
                    </div>
                    <form action="{{ route('cart.add-to-cart') }}" name="addtocart-form" method="post" class="product-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
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
                            <div class="quantity-control mb-4">
                                <label class="option-label">Số lượng:</label>
                                <div class="quantity-wrapper">
                                    <button type="button" class="quantity-btn minus">-</button>
                                    <input type="number"
                                           name="quantity"
                                           value="1"
                                           min="1"
                                           class="quantity-input">
                                    <button type="button" class="quantity-btn plus">+</button>
                                </div>
                            </div>

                            <!-- Add to Cart Button -->
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



            <div class="product-single__details-tab">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab"
                           href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false">Reviews
                            (2)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                         aria-labelledby="tab-description-tab">

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
                                                <use href="#icon_star"/>
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star"/>
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star"/>
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star"/>
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="review-date">April 06, 2023</div>
                                    <div class="review-text">
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit
                                            quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda
                                            est…</p>
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
                                                <use href="#icon_star"/>
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star"/>
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star"/>
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star"/>
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="review-date">April 06, 2023</div>
                                    <div class="review-text">
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit
                                            quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda
                                            est…</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-single__review-form">
                            <form name="customer-review-form">
                                <h5>Be the first to review “Message Cotton T-Shirt”</h5>
                                <p>Your email address will not be published. Required fields are marked *</p>
                                <div class="select-star-rating">
                                    <label>Your rating *</label>
                                    <span class="star-rating">
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"/>
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"/>
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"/>
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"/>
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"/>
                    </svg>
                  </span>
                                    <input type="hidden" id="form-input-rating" value="">
                                </div>
                                <div class="mb-4">
                                    <textarea id="form-input-review" class="form-control form-control_gray"
                                              placeholder="Your Review" cols="30" rows="8"></textarea>
                                </div>
                                <div class="form-label-fixed mb-4">
                                    <label for="form-input-name" class="form-label">Name *</label>
                                    <input id="form-input-name" class="form-control form-control-md form-control_gray">
                                </div>
                                <div class="form-label-fixed mb-4">
                                    <label for="form-input-email" class="form-label">Email address *</label>
                                    <input id="form-input-email" class="form-control form-control-md form-control_gray">
                                </div>
                                <div class="form-check mb-4">
                                    <input class="form-check-input form-check-input_fill" type="checkbox" value=""
                                           id="remember_checkbox">
                                    <label class="form-check-label" for="remember_checkbox">
                                        Save my name, email, and website in this browser for the next time I comment.
                                    </label>
                                </div>
                                <div class="form-action">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="products-carousel container">
            <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">Related <strong>Products</strong></h2>

            <div id="related_products" class="position-relative">
                <div class="swiper-container js-swiper-slider"
                     data-settings='{
            "autoplay": false,
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": true,
            "pagination": {
              "el": "#related_products .products-pagination",
              "type": "bullets",
              "clickable": true
            },
            "navigation": {
              "nextEl": "#related_products .products-carousel__next",
              "prevEl": "#related_products .products-carousel__prev"
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 3,
                "slidesPerGroup": 3,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 4,
                "slidesPerGroup": 4,
                "spaceBetween": 30
              }
            }
          }'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide product-card">
                            <div class="pc__img-wrapper">
                                <a href="product1_simple.html">
                                    <img loading="lazy" src="{{asset('theme/client/images/products/product_3.jpg')}}"
                                         width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                                    <img loading="lazy" src="{{asset('theme/client/images/products/product_3-1.jpg')}}"
                                         width="330" height="400" alt="Cropped Faux leather Jacket"
                                         class="pc__img pc__img-second">
                                </a>
                                <button
                                    class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart js-open-aside"
                                    data-aside="cartDrawer" title="Add To Cart">Add To Cart
                                </button>
                            </div>

                            <div class="pc__info position-relative">
                                <p class="pc__category">Dresses</p>
                                <h6 class="pc__title"><a href="product1_simple.html">Kirby T-Shirt</a></h6>
                                <div class="product-card__price d-flex">
                                    <span class="money price">$17</span>
                                </div>

                                <button
                                    class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                                    title="Add To Wishlist">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_heart"/>
                                    </svg>
                                </button>
                            </div>
                        </div>


                    </div><!-- /.swiper-wrapper -->
                </div><!-- /.swiper-container js-swiper-slider -->

                <div
                    class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_prev_md"/>
                    </svg>
                </div><!-- /.products-carousel__prev -->
                <div
                    class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_next_md"/>
                    </svg>
                </div><!-- /.products-carousel__next -->

                <div class="products-pagination mt-4 mb-5 d-flex align-items-center justify-content-center"></div>
                <!-- /.products-pagination -->
            </div><!-- /.position-relative -->

        </section><!-- /.products-carousel container -->
    </main>
@endsection
