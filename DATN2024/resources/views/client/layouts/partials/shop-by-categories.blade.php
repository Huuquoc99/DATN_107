<div class="bg-grey">
    <div class="mb-3 mb-xl-5 pb-3 pt-1 pb-xl-5"></div>
    <section class="category-carousel container">
        <div class="d-flex align-items-center justify-content-md-between flex-wrap mb-3 mb-xl-4">
            <h4 class="section-title fw-semi-bold fs-30 theme-color text-uppercase">Shop by categories</h4>
            <a class="btn-link default-underline text-uppercase fs-13 fw-semi-bold theme-color" href="{{ route('shop') }}">Shop
                All Products</a>
        </div>

        <div class="swiper-wrapper row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-content-start">
            @foreach($catalogues as $item)
                <div class="col text-center d-flex flex-column align-items-center" style="width: 220px;">
                    <a href="{{ route('catalogue.product', $item->id) }}">
                        <div class="d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; overflow: hidden;">
                            <img class="h-auto" src="{{ \Illuminate\Support\Facades\Storage::url($item->cover) }}"
                                 style="max-width: 100%; max-height: 100%;"
                                 alt="{{ $item->name }}">
                        </div>
                        <p class="menu-link menu-link_us-s fw-semi-bold fs-15 theme-color text-uppercase mt-2">{{ $item->name }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
</div>
