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
                                <button
                                    onclick="toggleFavorite({{ $item->id }})"
                                    data-product-id="{{ $item->id }}"
                                    class="favorite-btn {{ in_array($item->id, $favoriteProductIds) ? 'text-red-500' : '' }}">
                                    {{ in_array($item->id, $favoriteProductIds) ? '❤️ Đã thích' : '🤍 Thích' }}
                                </button>
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
        </section>
    </div>
    <script>
        function toggleFavorite(productId) {
            axios.post('/toggle-favorite', { product_id: productId })
                .then(response => {
                    const favoriteButton = document.querySelector(`[data-product-id="${productId}"]`);

                    if (response.data.is_favorite) {
                        favoriteButton.classList.add('text-red-500');
                        favoriteButton.innerHTML = '❤️ Đã thích';
                    } else {
                        favoriteButton.classList.remove('text-red-500');
                        favoriteButton.innerHTML = '🤍 Thích';
                    }

                    // Hiển thị thông báo toast
                    Toastify({
                        text: response.data.message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: response.data.is_favorite
                            ? "linear-gradient(to right, #00b09b, #96c93d)"
                            : "linear-gradient(to right, #ff5f6d, #ffc371)"
                    }).showToast();
                })
                .catch(error => {
                    if (error.response.status === 401) {
                        // Hiển thị thông báo yêu cầu người dùng đăng nhập
                        Toastify({
                            text: 'You need to login to perform this action.. ' +
                                '<a href="#" style="color: #fff; text-decoration: underline;">Login here.</a>',
                            duration: 5000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)", // Màu nền
                            escapeMarkup: false,
                        }).showToast();

                        document.querySelector("a[href='#']").addEventListener('click', function(e) {
                            e.preventDefault();
                            window.location.href = '/login';
                        });

                    }
                });


        }


    </script>
@endsection

