
<section class="banner collections-grid_masonry bg-white h-auto" style="margin-top: 90px;">
    <div class="container pt-3">
        <div class="row mt-lg-n2">
            <div class="col-lg-6 slideshow-boxed-right mb-4" style="width: 100%">
                <div class="slideshow swiper-container js-swiper-slider w-100 bg-white mx-0 mt-0">
                    <div class="swiper-wrapper">
                        @foreach ($banners as $banner)
                            <div class="swiper-slide">
                                <div class="overflow-hidden position-relative border-radius-10 h-100">
                                    <a href="{{ $banner->link }}">
                                        <img loading="lazy" src="{{ asset('storage/' . $banner->image) }}"
                                            class="position-absolute w-100 h-100 object-fit-cover"
                                            alt="{{ $banner->title }}">
                                    </a>

                                    {{-- <div
                                        class="slideshow-text full-width_padding position-absolute start-50 top-50 translate-middle pb-4 pb-xl-5">
                                        <p
                                            class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3 text-white mb-2">
                                            {{ $banner->description }}
                                        </p>
                                        <h2
                                            class="fs-45 fw-semi-bold animate animate_fade animate_btt animate_delay-5 mb-2 text-white text-uppercase lh-1">
                                            {{ $banner->title }}
                                        </h2>
                                        <div class="animate animate_fade animate_btt animate_delay-7 pt-4">
                                            <a href="/shop"
                                                class="btn btn-primary border-0 fw-semi-bold text-uppercase theme-bg-color-secondary border-radius-10 btn-50 fs-base text-primary">Shop
                                                Now</a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev" style="color:white"></div>
                    <div class="swiper-button-next" style="color:white"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 3000,
            },
            slidesPerView: 1, 
            effect: 'fade', 
            pagination: {
                el: '.swiper-pagination', 
                clickable: true,
                type: 'bullets',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev', 
            }
        });
    });
</script>
