<div class="aside aside_right overflow-hidden customer-forms" id="customerForms">


    <div class="container9 mt-5" style="max-width: 400px; margin-top: 200px;">
        <button class="btn-close-lg js-close-aside position-absolute top-0 end-0 m-2" aria-label="Close">
        </button>
        @auth
            <div class="card9 shadow-lg">
                <div class="card9-header text-center bg-primary text-white">
                    <h4 class="mb-0" style="color: white">Thông tin người dùng</h4>
                </div>
                <div class="card-body text-center">
                    <p class="mb-2">Xin chào, <strong>{{ Auth::user()->name }}</strong>!</p>
                    <p class="text-muted">Email: <strong>{{ Auth::user()->email }}</strong></p>
                    <form action="{{ route('logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">Đăng xuất</button>
                    </form>
                    <a href="{{ route('account.dashboard') }}" class="btn btn-primary w-100 mt-2">Quản lý tài khoản</a>
                </div>
            </div>
        @endauth
    </div>

    @guest
        <div class="customer-forms__wrapper d-flex position-relative">
            <div class="customer__login">
                <div class="aside-header d-flex align-items-center">
                    <h1 class="text-uppercase fs-6 mb-0">Đăng nhập</h1>
                </div><!-- /.aside-header -->

                <form action="{{ route('login') }}" method="POST" class="aside-content">
                    @csrf
                    <input name="email" type="email" class="input form-control @error('email') is-invalid @enderror"
                           id="customerNameEmailInput" placeholder="Email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="pb-3"></div>

                    <input name="password" id="customerPasswordInput"
                           class="input form-control @error('password') is-invalid @enderror" type="password"
                           placeholder="Mật khẩu">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    @if (session('error'))
                        <div class="text-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <button class="btn btn-primary w-100 text-uppercase mt-3" type="submit">Đăng nhập</button>

                    <div class="customer-option mt-4 text-center">
                        <span class="text-secondary">Chưa có tài khoản?</span>
                        <a href="{{ route('register') }}" class="btn-text js-show-register">Tạo tài khoản</a>
                    </div>
                </form>
            </div>
        </div>
    @endguest
</div>


<header id="header" class="fixed-top header w-100 theme-bg-color bg-dark">
    <!-- <div class="header-top bordered-20per">
        <div class="header-container mx-auto d-flex align-items-center">
            <ul class="list-unstyled d-flex flex-1 gap-3 m-0">
                <li><a href="#" class="menu-link menu-link_us-s fs-13 text-white">Shipping</a></li>
                <li><a href="#" class="menu-link menu-link_us-s fs-13 text-white">FAQ</a></li>
                <li><a href="contact.html" class="menu-link menu-link_us-s fs-13 text-white">Contact</a></li>
                <li><a href="#" class="menu-link menu-link_us-s fs-13 text-white">Track Order</a></li>
            </ul>
            <div class="header-top__right flex-1 d-flex gap-1 justify-content-end">
                <ul class="social-links list-unstyled d-flex flex-wrap mb-0">
                    <li>
                        <a href="https://facebook.com/" class="footer__social-link d-block text-white">
                            <i class="fa-brands fa-facebook fa-xl"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/" class="footer__social-link d-block text-white">
                            <i class="fa-brands fa-twitter fa-xl"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://instagram.com/" class="footer__social-link d-block text-white">
                            <i class="fa-brands fa-instagram fa-xl"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://pinterest.com/" class="footer__social-link d-block text-white">
                            <i class="fa-brands fa-pinterest fa-xl"></i>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </div> -->
    <div class="header-desk_type_6 container style2">
        <div class="header-middle  border-0 position-relative py-2">
            <div class="header-container mx-auto d-flex align-items-center">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('theme/client/images/techStore.png') }}" alt="Uomo" class="logo__image">
                    </a>
                </div>

                <nav class="navigation flex-grow-1 fs-15" style="display: flex; padding: 0; margin: 0; align-items: center; margin-top:10px;">
    <ul class="navigation__list list-unstyled d-flex" style="display: flex; padding: 0; margin: 0;">
        <li class="navigation__item" style="margin-right: 20px; margin-left: 10px;">
            <a href="{{ route('home') }}" class="navigation__link text-white" style="text-decoration: none; color: white; line-height: 1; padding: 10px 0;">Trang chủ</a>
        </li>
        <li class="navigation__item" style="margin-right: 20px; margin-left: 10px;">
            <a href="/shop" class="navigation__link text-white" style="text-decoration: none; color: white; line-height: 1; padding: 10px 0;">Cửa hàng</a>
        </li>
        <li class="navigation__item" style="margin-right: 20px; margin-left:10px;">
            <a href="{{ route('blog') }}" class="navigation__link text-white" style="text-decoration: none; color: white; line-height: 1; padding: 10px 0;">Tin Tức</a>
        </li>
        <li class="navigation__item" style="margin-right: 20px; margin-left: 10px;">
            <a href="{{ route('voucher') }}" class="navigation__link text-white" style="text-decoration: none; color: white; line-height: 1; padding: 10px 0;">Mã Giảm Giá</a>
        </li>
        <li class="navigation__item" style="margin-right: 20px; margin-left: 10px;">
            <a href="{{ route('about') }}" class="navigation__link text-white" style="text-decoration: none; color: white; line-height: 1; padding: 10px 0;">Giới thiệu</a>
        </li>
        <li class="navigation__item" style="margin-left: 15px;">
            <a href="{{ route('contact') }}" class="navigation__link text-white" style="text-decoration: none; color: white; line-height: 1; padding: 10px 0;">Liên hệ</a>
        </li>
    </ul>
</nav>

                <div class="header-tools d-flex align-items-center me-0">
                    <div class="header-tools__item hover-container">
                        <a class="header-tools__item js-open-aside" href="#" data-aside="customerForms">
                            <i class="fa-regular fa-user fa-xl text-white"></i>
                        </a>
                    </div>
                    <div class="header-tools__item hover-container">
                        <a class="" href="{{ route('favorites.list') }}" data-aside="customerForms">
                            <i class="fa-regular fa-heart fa-xl" style="color: #f2f2f2;"></i>
                        </a>
                    </div>
                    <a href="{{ route('cart.list') }}" class="header-tools__item header-tools__cart">
                        <i class="fa-solid fa-cart-shopping fa-xl text-white"></i>
{{--                        <span class="cart-amount d-block position-absolute js-cart-items-count">1</span>--}}
                    </a>
                </div>
            </div>
        </div>

        <div class="header-bottom pb-4">
            <div class="header-container mx-auto d-flex align-items-center ">
                <div class="categories-nav position-relative">
                    <h3 style="border-top-left-radius: 10px; border-top-right-radius: 10px;"
                        class="categories-nav__title d-flex align-items-center gap-4 py-2 btn-50 theme-bg-color-secondary text-primary px-4">
                        <i class="fa-solid fa-bars fa-xl"></i>
                        <span class="fw-semi-bold lh-1">Danh mục</span>
                        <i class="fa-solid fa-angle-down fa-xl"></i>

                    </h3>
                    <ul class="categories-nav__list list-unstyled">
    @if(isset($catalogues) && $catalogues->isNotEmpty())
        @foreach($catalogues as $catalogue)
            <li class="categories-nav__item" style="height: 40px;  display: flex; align-items: center; justify-content: center; transition: background-color 0.3s;">
                <a href="{{ route('shop', array_merge(request()->except('c'), request()->get('c') ==  $catalogue->id ? [] : ['c' => $catalogue->id])) }}"
                   style="color: black; text-align: center; display: block; width: 100%;" class="menu-link py-1 {{ request()->get('c') == $catalogue->id ? 'shop_active' : '' }}">
                   {{$catalogue->name}}
                </a>
            </li>
        @endforeach
    @endif
</ul>

                    <style>
                        .categories-nav__item:hover {
                            background-color: #d3d3d3; /* Màu xám */
                        }
                    </style>
                </div>

            
                <form action="{{route('search')}}" method="GET"
                      class="header-search search-field me-0 border-radius-10">
                    <button class="btn header-search__btn" type="submit">
                        <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                    </button>
                    <input class="header-search__input w-100" type="text" name="k"
                           value="{{request()->routeIs('search') ? request()->get('k') : '' }}"
                           placeholder="Tìm kiếm sản phẩm ..." style="">
                </form>
            </div>
        </div>
    </div>
</header>

<!-- End Header Type 6 -->
{{-- <div class="aside aside_right overflow-hidden cart-drawer" id="cartDrawer">
    <div class="aside-header d-flex align-items-center">
        <h3 class="text-uppercase fs-6 mb-0">Giỏ hàng ( <span class="cart-amount js-cart-items-count">1</span> )
        </h3>
        <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
    </div><!-- /.aside-header -->

    <div class="aside-content cart-drawer-items-list">
        <div class="cart-drawer-item d-flex position-relative">
            <div class="position-relative">
                <a href="product1_simple.html">
                    <img loading="lazy" class="cart-drawer-item__img"
                         src="{{ asset('theme/client/images/cart-item-1.jpg') }}" alt="">
                </a>
            </div>
            <div class="cart-drawer-item__info flex-grow-1">
                <h6 class="cart-drawer-item__title fw-normal"><a href="product1_simple.html">Zessi Dresses</a></h6>
                <p class="cart-drawer-item__option text-secondary">Color: Yellow</p>
                <p class="cart-drawer-item__option text-secondary">Size: L</p>
                <div class="d-flex align-items-center justify-content-between mt-1">
                    <div class="qty-control position-relative">
                        <input type="number" name="quantity" value="1" min="1"
                               class="qty-control__number border-0 text-center">
                        <div class="qty-control__reduce text-start">-</div>
                        <div class="qty-control__increase text-end">+</div>
                    </div><!-- .qty-control -->
                    <span class="cart-drawer-item__price money price">$99</span>
                </div>
            </div>

            <button class="btn-close-xs position-absolute top-0 end-0 js-cart-item-remove"></button>
        </div><!-- /.cart-drawer-item d-flex -->

        <hr class="cart-drawer-divider">

        <div class="cart-drawer-item d-flex position-relative">
            <div class="position-relative">
                <a href="product1_simple.html">
                    <img loading="lazy" class="cart-drawer-item__img"
                         src="{{ asset('theme/client/images/cart-item-2.jpg') }}" alt="">
                </a>
            </div>
            <div class="cart-drawer-item__info flex-grow-1">
                <h6 class="cart-drawer-item__title fw-normal"><a href="product1_simple.html">Kirby T-Shirt</a></h6>
                <p class="cart-drawer-item__option text-secondary">Color: Black</p>
                <p class="cart-drawer-item__option text-secondary">Size: XS</p>
                <div class="d-flex align-items-center justify-content-between mt-1">
                    <div class="qty-control position-relative">
                        <input type="number" name="quantity" value="4" min="1"
                               class="qty-control__number border-0 text-center">
                        <div class="qty-control__reduce text-start">-</div>
                        <div class="qty-control__increase text-end">+</div>
                    </div><!-- .qty-control -->
                    <span class="cart-drawer-item__price money price">$89</span>
                </div>
            </div>

            <button class="btn-close-xs position-absolute top-0 end-0 js-cart-item-remove"></button>
        </div><!-- /.cart-drawer-item d-flex -->

        <hr class="cart-drawer-divider">

        <div class="cart-drawer-item d-flex position-relative">
            <div class="position-relative">
                <a href="product1_simple.html">
                    <img loading="lazy" class="cart-drawer-item__img"
                         src="{{ asset('theme/client/images/cart-item-3.jpg') }}" alt="">
                </a>
            </div>
            <div class="cart-drawer-item__info flex-grow-1">
                <h6 class="cart-drawer-item__title fw-normal"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                <p class="cart-drawer-item__option text-secondary">Color: Green</p>
                <p class="cart-drawer-item__option text-secondary">Size: L</p>
                <div class="d-flex align-items-center justify-content-between mt-1">
                    <div class="qty-control position-relative">
                        <input type="number" name="quantity" value="3" min="1"
                               class="qty-control__number border-0 text-center">
                        <div class="qty-control__reduce text-start">-</div>
                        <div class="qty-control__increase text-end">+</div>
                    </div><!-- .qty-control -->
                    <span class="cart-drawer-item__price money price">$129</span>
                </div>
            </div>

            <button class="btn-close-xs position-absolute top-0 end-0 js-cart-item-remove"></button>
        </div><!-- /.cart-drawer-item d-flex -->

    </div><!-- /.aside-content -->

    <div class="cart-drawer-actions position-absolute start-0 bottom-0 w-100">
        <hr class="cart-drawer-divider">
        <div class="d-flex justify-content-between">
            <h6 class="fs-base fw-medium">SUBTOTAL:</h6>
            <span class="cart-subtotal fw-medium">$176.00</span>
        </div>
        <a href="shop_cart.html" class="btn btn-light mt-3 d-block">View Cart</a>
        <a href="shop_checkout.html" class="btn btn-primary mt-3 d-block">Checkout</a>
    </div>
</div> --}}
