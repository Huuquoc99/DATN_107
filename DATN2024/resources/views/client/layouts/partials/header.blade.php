<div class="aside aside_right overflow-hidden customer-forms" id="customerForms" style>
    <div class="container mt-5" style="max-width: 400px;">
        @auth
            <div class="card shadow-sm">
                <div class="card-header text-center bg-primary text-white">
                    <h4 class="mb-0">Thông tin người dùng</h4>
                </div>
                <div class="card-body text-center">
                    <p class="mb-2">Xin chào, <strong>{{ Auth::user()->name }}</strong>!</p>
                    <p class="text-muted">Email: <strong>{{ Auth::user()->email }}</strong></p>
                    {{-- Thêm các thông tin khác nếu cần --}}
                    <form action="{{ route('logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">Đăng xuất</button>
                    </form>
                    <a href="{{ route('account.dashboard') }}" class="btn btn-primary">My Account</a>

                </div>
            </div>
        @endauth
    </div>
    @guest
        <div class="customer-forms__wrapper d-flex position-relative">
            <div class="customer__login">
                <div class="aside-header d-flex align-items-center">
                    <h3 class="text-uppercase fs-6 mb-0">Đăng nhập</h3>
                    <button class="btn-close-lg js-close-aside ms-auto"></button>
                </div><!-- /.aside-header -->

                <form action="{{ route('login') }}" method="POST" class="aside-content">
                    @csrf
                    <div class="form-floating mb-3">
                        <input name="email" type="email" class="form-control form-control_gray" id="customerNameEmailInput"
                            placeholder="name@example.com" required>
                        <label for="customerNameEmailInput">Email *</label>
                    </div>

                    <div class="pb-3"></div>

                    <div class="form-label-fixed mb-3">
                        <label for="customerPasswordInput" class="form-label">Mật khẩu *</label>
                        <input name="password" id="customerPasswordInput" class="form-control form-control_gray"
                            type="password" placeholder="********" required>
                    </div>

                    <div class="d-flex align-items-center mb-3 pb-2">
                        <div class="form-check mb-0">
                            <input name="remember" class="form-check-input form-check-input_fill" type="checkbox"
                                id="flexCheckDefault">
                            <label class="form-check-label text-secondary" for="flexCheckDefault">Nhớ tài khoản</label>
                        </div>
                        <a href="{{ route('forgot-password') }}" class="btn-text ms-auto">Quên mật khẩu?</a>
                    </div>

                    <button class="btn btn-primary w-100 text-uppercase" type="submit">Đăng nhập</button>

                    <div class="customer-option mt-4 text-center">
                        <span class="text-secondary">Chưa có tài khoản?</span>
                        <a href="{{ route('register') }}" class="btn-text js-show-register">Tạo tài khoản</a>
                    </div>
                </form>
            </div>
        </div>
    @endguest
</div>




<header id="header" class="header w-100 theme-bg-color bg-dark">
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
    <div class="header-desk_type_6 style2">
        <div class="header-middle border-0 position-relative py-4">
            <div class="header-container mx-auto d-flex align-items-center">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('theme/client/images/techStore.png') }}" alt="Uomo" class="logo__image">
                    </a>
                </div>

                <nav class="navigation flex-grow-1 fs-15 fw-semi-bold">
                    <ul class="navigation__list list-unstyled d-flex">
                        <li class="navigation__item">
                            <a href="{{ route('home') }}" class="navigation__link text-white">Home</a>
                        </li>
                        <li class="navigation__item">
                            <a href="/shop" class="navigation__link text-white">Shop</a>
                        </li>
                        <li class="navigation__item">
                            <a href="#" class="navigation__link text-white">Blog</a>
                        </li>
                        <li class="navigation__item">
                            <a href="#" class="navigation__link text-white">Pages</a>
                        </li>
                        <li class="navigation__item">
                            <a href="{{ route('about') }}" class="navigation__link text-white">About</a>
                        </li>
                        <li class="navigation__item">
                            <a href="{{ route('contact') }}" class="navigation__link text-white">Contact</a>
                        </li>
                    </ul>
                </nav>

                <div class="header-tools d-flex align-items-center me-0">
                   

                    <div class="header-tools__item hover-container">
                        <a class="header-tools__item js-open-aside" href="#" data-aside="customerForms">
                            <i class="fa-regular fa-user fa-xl text-white"></i>
                        </a>
                    </div>

                    <a href="{{ route('cart.list') }}" class="header-tools__item header-tools__cart">
                        <i class="fa-solid fa-cart-shopping fa-xl text-white"></i>
                        <span class="cart-amount d-block position-absolute js-cart-items-count">3</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="header-bottom pb-4 mb-2">
            <div class="header-container mx-auto d-flex align-items-center">
                <div class="categories-nav position-relative">
                    <h3
                        class="categories-nav__title d-flex align-items-center gap-4 py-2 btn-50 theme-bg-color-secondary text-primary px-4 border-radius-10">
                        <i class="fa-solid fa-bars fa-xl"></i>
                        <span class="fw-semi-bold lh-1">Browse Categories</span>
                        <i class="fa-solid fa-angle-down fa-xl"></i>
                    </h3>
                    <ul class="categories-nav__list list-unstyled border-radius-10">
                        <li class="categories-nav__item"><a class="text-primary" href="#">Electronics</a></li>
                        <li class="categories-nav__item"><a class="text-primary" href="#">Computers</a></li>
                        <li class="categories-nav__item"><a class="text-primary" href="#">Audio & Video</a></li>
                    </ul>
                </div>

                <form action="https://uomo-html.flexkitux.com/Demo18/" method="GET"
                    class="header-search search-field me-0 border-radius-10">
                    <button class="btn header-search__btn" type="submit">
                        <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                    </button>
                    <input class="header-search__input w-100" type="text" name="search-keyword"
                        placeholder="Search products...">
                </form>
            </div>
        </div>
    </div>
</header>

<!-- End Header Type 6 -->
<div class="aside aside_right overflow-hidden cart-drawer" id="cartDrawer">
    <div class="aside-header d-flex align-items-center">
        <h3 class="text-uppercase fs-6 mb-0">SHOPPING BAG ( <span class="cart-amount js-cart-items-count">1</span> )
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
</div>