@extends('client.layouts.master')

@section('title')
    Shop
@endsection

@section('content')
<main >
    <section class="shop-main container d-flex pt-1 pt-xl-5">
        <div class="shop-sidebar side-sticky bg-body" id="shopFilter">
            <div class="aside-header d-flex d-lg-none align-items-center">
                <h3 class="text-uppercase fs-6 mb-0">Filter By</h3>
                <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
            </div><!-- /.aside-header -->

            <div class="pt-4 pt-lg-0"></div>

            <div class="accordion" id="categories-list">
                <div class="accordion-item mb-4 pb-3">
                    <h5 class="accordion-header" id="accordion-heading-11">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                            data-bs-toggle="collapse" data-bs-target="#accordion-filter-1" aria-expanded="true"
                            aria-controls="accordion-filter-1">
                            Product Categories
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <div id="accordion-filter-1" class="accordion-collapse collapse show border-0"
                             aria-labelledby="accordion-heading-11" data-bs-parent="#categories-list">
                            <div class="accordion-body px-0 pb-0 pt-3" style="margin-top: -10px;" >
                                <ul class="list list-inline mb-0 text-dask">
                                    @foreach($catalogues as $catalogue)
                                        <li class="list-item" style="height: 40px; transition: background-color 0.3s;font-size: 24px;">
                                            <a href="{{ route('shop', array_merge(request()->except('c'), request()->get('c') ==  $catalogue->id ? [] : ['c' => $catalogue->id])) }}"
                                                style="color: black" class="menu-link py-1 {{ request()->get('c') == $catalogue->id ? 'shop_active' : '' }}">{{$catalogue->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                </div>
            </div>


            <div class="accordion" id="color-filters">
                <div class="accordion-item mb-4 pb-3">
                    <h5 class="accordion-header" id="accordion-heading-1">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                            data-bs-toggle="collapse" data-bs-target="#accordion-filter-2" aria-expanded="true"
                            aria-controls="accordion-filter-2">
                            Color
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <div id="accordion-filter-2" class="accordion-collapse collapse show border-0"
                        aria-labelledby="accordion-heading-1" data-bs-parent="#color-filters">
                        <div class="accordion-body px-0 pb-0">
                        <div class="d-flex flex-wrap">
    @foreach($colors as $color)
        <a href="{{ route('shop', array_merge(request()->except('color'), request()->get('color') == $color ? [] : ['color' => $color])) }}"
           class="swatch-color {{ request()->get('color') == $color ? 'swatch_active' : '' }}"
           style="color: {{$color}}; border: 1px solid black; width: 30px; height: 30px; display: inline-block; border-radius: 50%; margin: 5px;">
        </a>
    @endforeach
</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion" id="size-filters">
                <div class="accordion-item mb-4 pb-3">
                    <h5 class="accordion-header" id="accordion-heading-size">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                            data-bs-toggle="collapse" data-bs-target="#accordion-filter-size" aria-expanded="true"
                            aria-controls="accordion-filter-size">
                            capacity
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <div id="accordion-filter-size" class="accordion-collapse collapse show border-0"
                        aria-labelledby="accordion-heading-size" data-bs-parent="#size-filters">
                        <div class="accordion-body px-0 pb-0">
                            <div class="d-flex flex-wrap">
                                @foreach($capacities as $capacity)
                                    <a href="{{ route('shop', array_merge(request()->except('capacity'), request()->get('capacity') == $capacity ? [] : ['capacity' => $capacity])) }}"
                                        class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 text-uppercase {{ request()->get('capacity') == $capacity ? 'swatch_active' : '' }}">{{$capacity}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion" id="brand-filters">
                <div class="accordion-item mb-4 pb-3">
                    <h5 class="accordion-header" id="accordion-heading-brand">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                            data-bs-toggle="collapse" data-bs-target="#accordion-filter-brand" aria-expanded="true"
                            aria-controls="accordion-filter-brand">
                            PRICE
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <div id="accordion-filter-brand" class="accordion-collapse collapse show border-0"
                        aria-labelledby="accordion-heading-brand" data-bs-parent="#brand-filters">
                        @php
                            $selectedPrices = explode(',', request()->get('prices', ''));
                        @endphp
                        <div class="search-field multi-select accordion-body px-0 pb-0">
                            <select id="price-filter" class="d-none" multiple name="price-list">
                                <option value="1" {{ in_array('1', $selectedPrices) ? 'selected' : '' }}>Dưới 1
                                    triệu
                                </option>
                                <option value="2" {{ in_array('2', $selectedPrices) ? 'selected' : '' }}>1 đến 3
                                    triệu
                                </option>
                                <option value="3" {{ in_array('3', $selectedPrices) ? 'selected' : '' }}>3 đến 5
                                    triệu
                                </option>
                                <option value="4" {{ in_array('4', $selectedPrices) ? 'selected' : '' }}>5 đến 10
                                    triệu
                                </option>
                                <option value="5" {{ in_array('5', $selectedPrices) ? 'selected' : '' }}>10 đến 15
                                    triệu
                                </option>
                                <option value="6" {{ in_array('6', $selectedPrices) ? 'selected' : '' }}>15 đến 20
                                    triệu
                                </option>
                                <option value="7" {{ in_array('7', $selectedPrices) ? 'selected' : '' }}>20 đến 30
                                    triệu
                                </option>
                                <option value="8" {{ in_array('8', $selectedPrices) ? 'selected' : '' }}>trên 30
                                    triệu
                                </option>
                            </select>

                            <ul class="multi-select__list list-unstyled" style="display: flex; flex-direction: column; padding: 0; margin: 0;">
    <li class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select js-price-select {{ in_array('1', $selectedPrices) ? 'mult-select__item_selected' : '' }}">
        <span class="me-auto">Dưới 1 triệu</span>
    </li>
    <li class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select js-price-select {{ in_array('2', $selectedPrices) ? 'mult-select__item_selected' : '' }}">
        <span class="me-auto">1 đến 3 triệu</span>
    </li>
    <li class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select js-price-select {{ in_array('3', $selectedPrices) ? 'mult-select__item_selected' : '' }}">
        <span class="me-auto">3 đến 5 triệu</span>
    </li>
    <li class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select js-price-select {{ in_array('4', $selectedPrices) ? 'mult-select__item_selected' : '' }}">
        <span class="me-auto">5 đến 10 triệu</span>
    </li>
    <li class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select js-price-select {{ in_array('5', $selectedPrices) ? 'mult-select__item_selected' : '' }}">
        <span class="me-auto">10 đến 15 triệu</span>
    </li>
    <li class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select js-price-select {{ in_array('6', $selectedPrices) ? 'mult-select__item_selected' : '' }}">
        <span class="me-auto">15 đến 20 triệu</span>
    </li>
    <li class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select js-price-select {{ in_array('7', $selectedPrices) ? 'mult-select__item_selected' : '' }}">
        <span class="me-auto">20 đến 30 triệu</span>
    </li>
    <li class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select js-price-select {{ in_array('8', $selectedPrices) ? 'mult-select__item_selected' : '' }}">
        <span class="me-auto">trên 30 triệu</span>
    </li>
</ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="shop-list flex-grow-1">
            <div class="d-flex justify-content-between mb-4 pb-md-2 ">
                <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1" style="margin-top: -25px;">
                    <a href="{{route('home')}}" class="menu-link menu-link_us-s text-uppercase fw-medium" style="color: black">Home</a>
                    <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1" style="color: black">/</span>
                    <a href="{{route('shop')}}" class="menu-link menu-link_us-s text-uppercase fw-medium" style="color: black">The
                        Shop</a>
                </div>
            </div>
            @if(count($products))
            <div class="products-grid row g-4 p-2" style="margin-top: -65px;" id="products-grid">
                @foreach($products as $product)
                    <div class="product-card-wrapper col-12 col-md-6 col-lg-4">
                        <div class="product-card h-100 border rounded overflow-hidden position-relative shadow-sm">
                            <div class="pc__img-wrapper">
                                <a href="{{ route('product.detail', $product->slug) }}">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($product->img_thumbnail) }}"
                                         alt="{{ $product->name }}"
                                         class="img-fluid w-100 product-img">
                                </a>
                            </div>
                            <div class="p-3">
                                <p class="pc__category text-muted mb-2">
                                    {{ $product->catalogue->name ?? 'Danh mục chưa xác định' }}
                                </p>
                                <h6 class="pc__title">
                                    <a href="{{ route('product.detail', $product->slug) }}" class="text-dark text-decoration-none">
                                        <b>{{ \Illuminate\Support\Str::limit($product->name, 30) }}</b>
                                    </a>
                                </h6>
                                <div class="product-card__price mt-2">
                                    <span class="money price text-success fw-bold">
                                        {{ number_format($product->price_regular, 0, ',', '.') }} VND
                                    </span>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <nav class="shop-pages d-flex justify-content-between mt-3" aria-label="Page navigation">
                @if ($products->onFirstPage())
                    <span class="btn-link d-inline-flex align-items-center text-muted">
                        <svg class="me-1" width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_prev_sm" />
                        </svg>
                        <span class="fw-medium">PREV</span>
                    </span>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="btn-link d-inline-flex align-items-center">
                        <svg class="me-1" width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_prev_sm" />
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
                            <use href="#icon_next_sm" />
                        </svg>
                    </a>
                @else
                    <span class="btn-link d-inline-flex align-items-center text-muted">
                        <span class="fw-medium me-1">NEXT</span>
                        <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_next_sm" />
                        </svg>
                    </span>
                @endif
            </nav>
        @else
            <div class="text-center">Không có sản phẩm nào</div>
        @endif

        </div>
    </section>
</main>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('.js-price-select').on('click', function () {
            const selectedValues = $('select[name="price-list"]').val() || [];
            const currentUrl = new URL(window.location.href);
            const params = new URLSearchParams(currentUrl.search);

            if (selectedValues.length === 0) {
                params.delete('prices');
            } else {
                params.set('prices', selectedValues.join(','));
            }
            location.href = currentUrl.origin + currentUrl.pathname + '?' + params.toString();
        });
    });
</script>
@endsection
