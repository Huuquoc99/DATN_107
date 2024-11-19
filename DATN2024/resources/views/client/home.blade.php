@extends('client.layouts.master')

@section('content')
@include('client.layouts.partials.banner')
@include('client.layouts.partials.shop-by-categories')


<div class="bg-grey">
    <div class="mb-3 mb-xl-5 pb-3 pt-1 pb-xl-5"></div>

    <section class="featured-products container">
        <div class="d-flex align-items-center justify-content-md-between flex-wrap mb-3 mb-xl-4">
            <h2 class="section-title fw-semi-bold fs-30 theme-color text-uppercase">Special Offers on Car Parts</h2>
            <ul class="nav nav-tabs justify-content-center" id="collections-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore underscore-md text-uppercase theme-color fs-13 fw-semi-bold active"
                        id="collections-tab-1-trigger" data-bs-toggle="tab" href="#collections-tab-1" role="tab"
                        aria-controls="collections-tab-1" aria-selected="true">New Arrivals</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore underscore-md text-uppercase fs-13 fw-semi-bold theme-color"
                        id="collections-tab-2-trigger" data-bs-toggle="tab" href="#collections-tab-2" role="tab"
                        aria-controls="collections-tab-2" aria-selected="true">Bestsellers</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore underscore-md text-uppercase fs-13 fw-semi-bold theme-color"
                        id="collections-tab-3-trigger" data-bs-toggle="tab" href="#collections-tab-3" role="tab"
                        aria-controls="collections-tab-3" aria-selected="true">Most Views</a>
                </li>
            </ul>
        </div>
        <div class="tab-content pt-2" id="collections-tab-content">
            <div class="tab-pane fade show active" id="collections-tab-1" role="tabpanel"
                aria-labelledby="collections-tab-1-trigger">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 gx-3 gy-4">
                    @foreach($products as $item)
                        <div class="col">
                            <div class="product-card product-card_style9 border rounded-3 bg-white h-100">
                                <div class="position-relative">
                                    <a href="{{ route('product.detail', $item->slug) }}" class="">
                                        <div class="pc__img-wrapper pc__img-wrapper_wide3 overflow-hidden ">
                                            <img loading="lazy"
                                            src="{{ \Illuminate\Support\Facades\Storage::url($item->img_thumbnail) }}"
                                                alt="{{ $item->name }}" class="pc__img img-fluid w-100 h-200px" />
                                        </div>
                                    </a>

                                    <div class="anim_appear-bottom position-absolute w-100 h-50 text-center">
                                        <button
                                            class="btn btn-round btn-hover-red border-0 text-uppercase me-2 js-add-cart js-open-aside d-inline-flex align-items-center justify-content-center"
                                            data-aside="cartDrawer" title="Add To Cart">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </button>
                                        <button
                                            class="btn btn-round btn-hover-red border-0 text-uppercase me-2 js-quick-view d-inline-flex align-items-center justify-content-center"
                                            data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="pc__info position-relative">
                                    <h6 class="pc__title__name "><a href="">{{ $item->name }}</a></h6>
                                    <div class="product-card__review d-sm-flex align-items-center">
                                        <span
                                            class="reviews-note text-lowercase  text-decoration-line-through text-secondary fs-16 ms-sm-1">{{ $item->price_regular }}
                                            đ</span>
                                    </div>
                                    <div class="product-card__review d-sm-flex align-items-center">
                                        <span
                                            class="reviews-note product_pricesale text-lowercase text-secondary fs-18 ms-sm-1">{{ $item->price_sale }}
                                            đ</span>
                                    </div>
                                    <div class="product-card__price d-flex">
                                        <span class="money price fs-16 fw-semi-bold"></span>
                                    </div>
                                    <div id="accordion-filter-2" class="accordion-collapse collapse show border-0"
                                        aria-labelledby="accordion-heading-1" data-bs-parent="#color-filters">

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="tab-pane fade" id="collections-tab-2" role="tabpanel"
                aria-labelledby="collections-tab-2-trigger">
            </div>

            <div class="tab-pane fade" id="collections-tab-3" role="tabpanel"
                aria-labelledby="collections-tab-3-trigger">
            </div>
        </div>
    </section>
</div>



{{-- @include('client.layouts.partials.shop-brand') --}}

@endsection