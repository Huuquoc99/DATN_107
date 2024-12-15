<div class="bg-grey" style="margin-top: -55px;">
    {{-- <div class="mb-3 mb-xl-5 pb-3 pt-1 pb-xl-5"></div> --}}
    <section class="category-carousel container">
        <div class="d-flex align-items-center justify-content-md-between flex-wrap mb-3 mb-xl-4">
            <h4 class="section-title fw-semi-bold fs-30 theme-color text-uppercase"> Mua sắm theo danh mục </h4>
            <a class="btn-link default-underline text-uppercase fs-13 fw-semi-bold theme-color"
                href="{{ route('shop') }}">Mua tất cả sản phẩm</a>
        </div>

        <div class="swiper-wrapper row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-content-center">
            @foreach($catalogues as $catalogue)
            <div class="col text-center d-flex flex-column align-items-center" style="width: 180px;">
                <a href="{{ route('shop', array_merge(request()->except('c'), request()->get('c') ==  $catalogue->id ? [] : ['c' => $catalogue->id])) }}"
                    class="menu-link py-1 {{ request()->get('c') == $catalogue->id ? 'shop_active' : '' }}">
                    <div class="d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; border-radius: 50%; border: 2px solid #ccc; overflow: hidden; position: relative;">
                        <img class="h-auto" src="{{ \Illuminate\Support\Facades\Storage::url($catalogue->cover) }}"
                            style="width: 70%; height: 70%; object-fit: cover; margin: auto; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"
                            alt="{{ $catalogue->name }}">
                    </div>
                    <p class="menu-link menu-link_us-s fw-semi-bold fs-15 theme-color text-uppercase mt-2">{{$catalogue->name}}</p>
                </a>
            </div>
            @endforeach
        </div>
    </section>
</div>
