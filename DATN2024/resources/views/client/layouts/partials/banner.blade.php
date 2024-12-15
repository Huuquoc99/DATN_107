<section class="banner collections-grid_masonry bg-white h-auto" style="margin-top: 111px;">
    <div class="container pt-3">
        <div class="row mt-lg-n2">
            <div class="col-lg-6 slideshow-boxed-right mb-4" style="width: 100%">
                <div class="slideshow swiper-container js-swiper-slider w-100 bg-white mx-0 mt-0">
                    <div class="swiper-wrapper">
                        @foreach ($banners as $banner)
                            <div class="swiper-slide">
                                <div class="overflow-hidden position-relative border-radius-10 h-100 mt-3">
                                    <a href="{{ $banner->link }}">
                                        <img loading="lazy" src="{{ asset('storage/' . $banner->image) }}"
                                             class="position-absolute w-100 h-100 object-fit-cover"
                                             alt="{{ $banner->title }}">
                                    </a>
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

<section class="service-promotion horizontal container mw-1200 pt-0 mb-md-4 pb-md-4 mb-xl-5">
    <div class="row">
        <div class="col-md-4 text-center mb-5 mb-md-0">
            <div class="service-promotion__icon mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/869/869126.png" alt="Shipping Icon" width="52"
                     height="52"/>
            </div>
            <h3 class="service-promotion__title fs-6 text-uppercase">Giao hàng nhanh và miễn phí</h3>
            <p class="service-promotion__content text-secondary">Giao hàng miễn phí cho tất cả các đơn hàng </p>
        </div><!-- /.col-md-4 text-center-->

        <div class="col-md-4 text-center mb-5 mb-md-0">
            <div class="service-promotion__icon mb-4">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTClomf-mZmmDxN6XaEAcuuRjqW1hIAVkniUw&s"
                     alt="Support Icon" width="52" height="52"/>
            </div>
            <h3 class="service-promotion__title fs-6 text-uppercase">Hỗ trợ khách hàng 24/7</h3>
            <p class="service-promotion__content text-secondary">
                Hỗ trợ khách hàng thân thiện 24/7</p>
        </div><!-- /.col-md-4 text-center-->

        <div class="col-md-4 text-center mb-4 pb-1 mb-md-0">
            <div class="service-promotion__icon mb-4">
                <img
                    src="https://png.pngtree.com/png-clipart/20190705/original/pngtree-shield-icon-design-png-image_4273189.jpg"
                    alt="Guarantee Icon" width="52" height="52"/>
            </div>
            <h3 class="service-promotion__title fs-6 text-uppercase">Đảm bảo hoàn tiền</h3>
            <p class="service-promotion__content text-secondary">Hoàn trả lại tiền trong vòng 30 ngày</p>
        </div><!-- /.col-md-4 text-center-->
    </div><!-- /.row -->
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
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
