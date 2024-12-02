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
                <h2 class="section-title fw-semi-bold fs-30 theme-color text-uppercase">Special Offers</h2>
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
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-4">
                        @foreach($productNew as $item)
                        <div class="product-card-wrapper mb-4">
                            <div class="product-card product-card_style9 border rounded-3 bg-white h-100">
                                <div class="position-relative">
                                    <a href="{{ route('product.detail', $item->slug) }}" class="">
                                        <div class="pc__img-wrapper pc__img-wrapper_wide3 overflow-hidden ">
                                            <img loading="lazy"
                                                 src="{{ \Illuminate\Support\Facades\Storage::url($item->img_thumbnail) }}"
                                                 alt="{{ $item->name }}"
                                                 class="pc__img img-fluid w-75 h-auto" style="margin-left: 25px; margin-top:20px;">
                                        </a>
                                    </div>
                                </div>
                                <div class="pc__info position-relative">
                                    <p class="pc__category fs-13 fw-medium">{{ $item->catalogue ? $item->catalogue->name : 'No category' }}</p>
                                    <h6 class="pc__title fs-16 mb-2"><a href="">{{ \Illuminate\Support\Str::limit($item->name, 20) }}</a></h6>

                                    <div class="product-card__price d-flex">
                                        <span class="money price fs-16 fw-semi-bold">{{ number_format($item->price_regular, 0, ',', '.') }} VND</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="collections-tab-2" role="tabpanel" aria-labelledby="collections-tab-2-trigger">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-4">
                        @foreach($productHot as $item)
                        <div class="product-card-wrapper mb-4">
                            <div class="product-card product-card_style9 border rounded-3 bg-white h-100">
                                <div class="position-relative">
                                    <a href="{{ route('product.detail', $item->slug) }}" class="">
                                        <div class="pc__img-wrapper pc__img-wrapper_wide3 overflow-hidden ">
                                            <img loading="lazy"
                                                 src="{{ \Illuminate\Support\Facades\Storage::url($item->img_thumbnail) }}"
                                                 alt="{{ $item->name }}"
                                                 class="pc__img img-fluid w-75 h-auto" style="margin-left: 25px; margin-top:20px;">
                                        </a>
                                    </div>
                                </div>
                                <div class="pc__info position-relative">
                                    <p class="pc__category fs-13 fw-medium">{{ $item->catalogue ? $item->catalogue->name : 'No category' }}</p>
                                    <h6 class="pc__title fs-16 mb-2"><a href="">{{ \Illuminate\Support\Str::limit($item->name, 20) }}</a></h6>

                                    <div class="product-card__price d-flex">
                                        <span class="money price fs-16 fw-semi-bold">{{ number_format($item->price_regular, 0, ',', '.') }} VND</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="collections-tab-3" role="tabpanel" aria-labelledby="collections-tab-3-trigger">
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
                                                 class="pc__img img-fluid w-75 h-auto" style="margin-left: 25px; margin-top:20px;">
                                        </a>
                                    </div>
                                </div>
                                <div class="pc__info position-relative">
                                    <p class="pc__category fs-13 fw-medium">{{ $item->catalogue ? $item->catalogue->name : 'No category' }}</p>
                                    <h6 class="pc__title fs-16 mb-2"><a href="">{{ \Illuminate\Support\Str::limit($item->name, 20) }}</a></h6>

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
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
  <!-- <div class="carousel-inner">
    <div class="tab-pane fade show active" id="collections-tab-1" role="tabpanel" aria-labelledby="collections-tab-1-trigger">
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-4">
        @foreach($productNew as $index => $item)
          @if($index % 12 === 0) 
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
              <div class="row">
          @endif
          <div class="product-card-wrapper mb-4">
            <div class="product-card product-card_style9 border rounded-3 bg-white h-100">
              <div class="position-relative">
                <a href="{{ route('product.detail', $item->slug) }}">
                  <div class="pc__img-wrapper pc__img-wrapper_wide3 overflow-hidden">
                    <img loading="lazy"
                         src="{{ \Illuminate\Support\Facades\Storage::url($item->img_thumbnail) }}"
                         alt="{{ $item->name }}"
                         class="pc__img img-fluid w-75 h-auto" style="margin-left: 25px; margin-top:20px;">
                  </a>
                </div>
              </div>
              <div class="pc__info position-relative">
                <p class="pc__category fs-13 fw-medium">{{ $item->catalogue ? $item->catalogue->name : 'No category' }}</p>
                <h6 class="pc__title fs-16 mb-2"><a href="">{{ \Illuminate\Support\Str::limit($item->name, 20) }}</a></h6>
                <div class="product-card__price d-flex">
                  <span class="money price fs-16 fw-semi-bold">{{ number_format($item->price_regular, 0, ',', '.') }} VND</span>
                </div>
              </div>
            </div>
          </div>
          @if($index % 12 === 11 || $index === count($productNew) - 1) 
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </div>
  
  <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button> -->
        </section>

       

  
</div>

      
    </div>
@endsection
