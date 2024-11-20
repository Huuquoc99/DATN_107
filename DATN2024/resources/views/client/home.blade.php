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
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">
                        @foreach($products as $item)
                        <div class="product-card-wrapper mb-4">
                            <div class="product-card product-card_style9 border rounded-3 bg-white h-100">
                                <div class="position-relative pb-3">
                                    <div class="pc__img-wrapper pc__img-wrapper_wide3 overflow-hidden">
                                        <a href="{{ route('product.detail', $item->slug) }}">
                                            <img loading="lazy"
                                                 src="{{ \Illuminate\Support\Facades\Storage::url($item->img_thumbnail) }}"
                                                 alt="{{ $item->name }}"
                                                 class="pc__img img-fluid w-75 h-auto" style="margin-left: 25px">
                                        </a>
                                    </div>
                                </div>
                                <div class="pc__info position-relative">
                                    <p class="pc__category fs-13 fw-medium">{{ $item->catalogue ? $item->catalogue->name : 'No category' }}</p>
                                    <h6 class="pc__title fs-16 mb-2"><a href="">{{ \Illuminate\Support\Str::limit($item->name, 20) }}</a></h6>
                                    <div class="product-card__review d-sm-flex align-items-center">
                                        <div class="reviews-group d-flex">
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.0172 0.313075L2.91869 2.64013L0.460942 3.0145C0.0201949 3.08129 -0.15644 3.64899 0.163185 3.97415L1.94131 5.78447L1.52075 8.34177C1.44505 8.80402 1.91103 9.15026 2.30131 8.93408L4.5 7.72661L6.69869 8.93408C7.08897 9.14851 7.55495 8.80402 7.47925 8.34177L7.05869 5.78447L8.83682 3.97415C9.15644 3.64899 8.97981 3.08129 8.53906 3.0145L6.08131 2.64013L4.9828 0.313075C4.78598 -0.101718 4.2157 -0.10699 4.0172 0.313075Z"></path>
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.0172 0.313075L2.91869 2.64013L0.460942 3.0145C0.0201949 3.08129 -0.15644 3.64899 0.163185 3.97415L1.94131 5.78447L1.52075 8.34177C1.44505 8.80402 1.91103 9.15026 2.30131 8.93408L4.5 7.72661L6.69869 8.93408C7.08897 9.14851 7.55495 8.80402 7.47925 8.34177L7.05869 5.78447L8.83682 3.97415C9.15644 3.64899 8.97981 3.08129 8.53906 3.0145L6.08131 2.64013L4.9828 0.313075C4.78598 -0.101718 4.2157 -0.10699 4.0172 0.313075Z"></path>
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.0172 0.313075L2.91869 2.64013L0.460942 3.0145C0.0201949 3.08129 -0.15644 3.64899 0.163185 3.97415L1.94131 5.78447L1.52075 8.34177C1.44505 8.80402 1.91103 9.15026 2.30131 8.93408L4.5 7.72661L6.69869 8.93408C7.08897 9.14851 7.55495 8.80402 7.47925 8.34177L7.05869 5.78447L8.83682 3.97415C9.15644 3.64899 8.97981 3.08129 8.53906 3.0145L6.08131 2.64013L4.9828 0.313075C4.78598 -0.101718 4.2157 -0.10699 4.0172 0.313075Z"></path>
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.0172 0.313075L2.91869 2.64013L0.460942 3.0145C0.0201949 3.08129 -0.15644 3.64899 0.163185 3.97415L1.94131 5.78447L1.52075 8.34177C1.44505 8.80402 1.91103 9.15026 2.30131 8.93408L4.5 7.72661L6.69869 8.93408C7.08897 9.14851 7.55495 8.80402 7.47925 8.34177L7.05869 5.78447L8.83682 3.97415C9.15644 3.64899 8.97981 3.08129 8.53906 3.0145L6.08131 2.64013L4.9828 0.313075C4.78598 -0.101718 4.2157 -0.10699 4.0172 0.313075Z"></path>
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.0172 0.313075L2.91869 2.64013L0.460942 3.0145C0.0201949 3.08129 -0.15644 3.64899 0.163185 3.97415L1.94131 5.78447L1.52075 8.34177C1.44505 8.80402 1.91103 9.15026 2.30131 8.93408L4.5 7.72661L6.69869 8.93408C7.08897 9.14851 7.55495 8.80402 7.47925 8.34177L7.05869 5.78447L8.83682 3.97415C9.15644 3.64899 8.97981 3.08129 8.53906 3.0145L6.08131 2.64013L4.9828 0.313075C4.78598 -0.101718 4.2157 -0.10699 4.0172 0.313075Z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="product-card__price d-flex">
                                        <span class="money price fs-16 fw-semi-bold">{{ number_format($item->price_regular, 0, ',', '.') }} VND</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="collections-tab-2" role="tabpanel" aria-labelledby="collections-tab-2-trigger">
                </div>

                <div class="tab-pane fade" id="collections-tab-3" role="tabpanel" aria-labelledby="collections-tab-3-trigger">
                </div>
            </div>
        </section>
    </div>



    {{-- @include('client.layouts.partials.shop-brand') --}}
@endsection
