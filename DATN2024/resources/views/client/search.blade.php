@extends('client.layouts.master')

@section('title')
    TechStore
@endsection

@section('content')
    <main>
        <section class="featured-products container">
            <div class="d-flex align-items-center justify-content-md-between flex-wrap my-3 mb-xl-4">
                @if($products->count() > 0)
                    <h2 class="section-title fw-semi-bold fs-30 theme-color text-uppercase">Đã tìm thấy {{$products->count()}} kết quả</h2>
                @else
                    <h2 class="section-title fw-semi-bold fs-30 theme-color text-uppercase">Không tìm thấy kết quả phù hợp</h2>
                @endif

            </div>

            <div class="tab-content pt-2" id="collections-tab-content">
                <div class="tab-pane fade show active" id="collections-tab-1" role="tabpanel" aria-labelledby="collections-tab-1-trigger">
                    @if(count($products))
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">

                                @foreach($products as $product)
                                    <div class="product-card-wrapper mb-2">
                                        <div class="product-card product-card_style9 border rounded-3 mb-3 mb-md-4 bg-white">
                                            <div class="position-relative pb-3">
                                                <div class="pc__img-wrapper pc__img-wrapper_wide3">
                                                    <a href="{{ route('product.detail', $product->slug) }}">
                                                        <img loading="lazy" src="{{ \Illuminate\Support\Facades\Storage::url($product->img_thumbnail) }}" width="255" height="200" alt="{{ $product->name }}" class="pc__img">
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="pc__info position-relative">
                                                <p class="pc__category fs-13 fw-medium">{{ $product->catalogue->name ?? 'null' }}</p>
                                                <h6 class="pc__title fs-16 mb-2"><a href="{{ route('product.detail', $product->slug) }}">{{$product->name}}</a></h6>
                                                <div class="product-card__price d-flex">
                                                    <span class="money price fs-16 fw-semi-bold">{{ number_format($product->price_regular, 0, ',', '.') }} VND</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                        <nav class="shop-pages d-flex justify-content-between my-3" aria-label="Page navigation">
                            @if ($products->onFirstPage())
                                <span class="btn-link d-inline-flex align-items-center text-muted">
                        <svg class="me-1" width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_prev_sm"/>
                        </svg>
                            <span class="fw-medium">PREV</span>
                        </span>
                            @else
                                <a href="{{ $products->previousPageUrl() }}" class="btn-link d-inline-flex align-items-center">
                                    <svg class="me-1" width="7" height="11" viewBox="0 0 7 11"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_prev_sm"/>
                                    </svg>
                                    <span class="fw-medium">PREV</span>
                                </a>
                            @endif

                            <ul class="pagination mb-0">
                                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                    <li class="page-item{{ $page == $products->currentPage() ? ' active' : '' }}">
                                        <a class="btn-link px-1 mx-2{{ $page == $products->currentPage() ? ' btn-link_active' : '' }}"
                                           href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                            </ul>

                            @if ($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}" class="btn-link d-inline-flex align-items-center">
                                    <span class="fw-medium me-1">NEXT</span>
                                    <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_next_sm"/>
                                    </svg>
                                </a>
                            @else
                                <span class="btn-link d-inline-flex align-items-center text-muted">
                            <span class="fw-medium me-1">NEXT</span>
                            <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_next_sm"/>
                            </svg>
                        </span>
                            @endif
                        </nav>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection
