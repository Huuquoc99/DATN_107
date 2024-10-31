
<div class="aside aside_right overflow-hidden customer-forms" id="customerForms">
  <div class="customer-forms__wrapper d-flex position-relative">
    <div class="customer__login">
      <div class="aside-header d-flex align-items-center">
        <h3 class="text-uppercase fs-6 mb-0">Login</h3>
        <button class="btn-close-lg js-close-aside ms-auto"></button>
      </div><!-- /.aside-header -->

      <form action="https://uomo-html.flexkitux.com/Demo18/login_register.html" method="POST" class="aside-content">
        <div class="form-floating mb-3">
          <input name="email" type="email" class="form-control form-control_gray" id="customerNameEmailInput" placeholder="name@example.com">
          <label for="customerNameEmailInput">Username or email address *</label>
        </div>

        <div class="pb-3"></div>

        <div class="form-label-fixed mb-3">
          <label for="customerPasswordInput" class="form-label">Password *</label>
          <input name="password" id="customerPasswordInput" class="form-control form-control_gray" type="password" placeholder="********">
        </div>

        <div class="d-flex align-items-center mb-3 pb-2">
          <div class="form-check mb-0">
            <input name="remember" class="form-check-input form-check-input_fill" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label text-secondary" for="flexCheckDefault">Remember me</label>
          </div>
          <a href="reset_password.html" class="btn-text ms-auto">Lost password?</a>
        </div>

        <button class="btn btn-primary w-100 text-uppercase" type="submit">Log In</button>

        <div class="customer-option mt-4 text-center">
          <span class="text-secondary">No account yet?</span>
          <a href="login_register.html#register-tab" class="btn-text js-show-register">Create Account</a>
        </div>
      </form>
    </div><!-- /.customer__login -->

    <div class="customer__register">
      <div class="aside-header d-flex align-items-center">
        <h3 class="text-uppercase fs-6 mb-0">Create an account</h3>
        <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
      </div><!-- /.aside-header -->

      <form action="https://uomo-html.flexkitux.com/Demo18/login_register.html" method="POST" class="aside-content">
        <div class="form-floating mb-4">
          <input name="username" type="text" class="form-control form-control_gray" id="registerUserNameInput" placeholder="Username">
          <label for="registerUserNameInput">Username</label>
        </div>

        <div class="pb-1"></div>

        <div class="form-floating mb-4">
          <input name="email" type="email" class="form-control form-control_gray" id="registerUserEmailInput" placeholder="user@company.com">
          <label for="registerUserEmailInput">Email address *</label>
        </div>

        <div class="pb-1"></div>

        <div class="form-label-fixed mb-4">
          <label for="registerPasswordInput" class="form-label">Password *</label>
          <input name="password" id="registerPasswordInput" class="form-control form-control_gray" type="password" placeholder="*******">
        </div>

        <p class="text-secondary mb-4">Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.</p>

        <button class="btn btn-primary w-100 text-uppercase" type="submit">Register</button>

        <div class="customer-option mt-4 text-center">
          <span class="text-secondary">Already have account?</span>
          <a href="#" class="btn-text js-show-login">Login</a>
        </div>
      </form>
    </div><!-- /.customer__register -->
  </div><!-- /.customer-forms__wrapper -->
</div><!-- /.aside aside_right -->


<header id="header" class="header sticky_disabled header_sticky-bg_dark w-100 theme-bg-color">
  <div class="header-top bordered-20per">
    <div class="container d-flex align-items-center">
      <ul class="list-unstyled d-flex flex-1 gap-3 m-0">
        <li><a href="#" class="menu-link menu-link_us-s fs-13">Shipping</a></li>
        <li><a href="#" class="menu-link menu-link_us-s fs-13">FAQ</a></li>
        <li><a href="contact.html" class="menu-link menu-link_us-s fs-13">Contact</a></li>
        <li><a href="#" class="menu-link menu-link_us-s fs-13">Track Order</a></li>
      </ul>
      <div class="heeader-top__right flex-1 d-flex gap-1 justify-content-end">
        <ul class="social-links list-unstyled d-flex flex-wrap mb-0">
          <li>
            <a href="https://facebook.com/" class="footer__social-link d-block">
              <i class="fa-brands fa-facebook fa-xl"></i>            </a>
          </li>
          <li>
            <a href="https://twitter.com/" class="footer__social-link d-block">
              <i class="fa-brands fa-twitter fa-xl"></i>            </a>
          </li>
          <li>
            <a href="https://instagram.com/" class="footer__social-link d-block">
              <i class="fa-brands fa-instagram fa-xl"></i>            </a>
          </li>
          <li>
            <a href="https://pinterest.com/" class="footer__social-link d-block">
              <i class="fa-brands fa-pinterest fa-xl"></i>            </a>
          </li>
        </ul>
        <select class="form-select form-select-sm bg-transparent color-white fs-13" name="store-language">
          <option value="english" selected>English</option>
          <option value="german">German</option>
          <option value="french">French</option>
          <option value="swedish">Swedish</option>
        </select>
        <select class="form-select form-select-sm bg-transparent color-white fs-13" name="store-currency">
          <option value="usd" selected>$ USD</option>
          <option value="gbp">£ GBP</option>
          <option value="eur">€ EURO</option>
        </select>
      </div>
    </div>
  </div>
  <div class="header-desk_type_6 style2">
    <div class="header-middle border-0 position-relative py-4">
      <div class="container d-flex align-items-center">
        <div class="logo">
          <a href="index.html">
            <img src="{{ asset('theme/client/images/logo-cars.png') }}" alt="Uomo" class="logo__image">
          </a>
        </div><!-- /.logo -->

        <nav class="navigation flex-grow-1 fs-15 fw-semi-bold">
          <ul class="navigation__list list-unstyled d-flex">
            <li class="navigation__item">
              <a href="#" class="navigation__link">Home</a>
            </li>
            <li class="navigation__item">
              <a href="#" class="navigation__link">Shop</a>

            </li>
            <li class="navigation__item">
              <a href="#" class="navigation__link">Blog</a>
              {{-- <ul class="default-menu list-unstyled">
                <li class="sub-menu__item"><a href="blog_list1.html" class="menu-link menu-link_us-s">Blog V1</a></li>
                <li class="sub-menu__item"><a href="blog_list2.html" class="menu-link menu-link_us-s">Blog V2</a></li>
                <li class="sub-menu__item"><a href="blog_list3.html" class="menu-link menu-link_us-s">Blog V3</a></li>
                <li class="sub-menu__item"><a href="blog_single.html" class="menu-link menu-link_us-s">Blog Detail</a></li>
              </ul><!-- /.box-menu --> --}}
            </li>
            <li class="navigation__item">
              <a href="#" class="navigation__link">Pages</a>
              {{-- <ul class="default-menu list-unstyled">
                <li class="sub-menu__item"><a href="account_dashboard.html" class="menu-link menu-link_us-s">My Account</a></li>
                <li class="sub-menu__item"><a href="login_register.html" class="menu-link menu-link_us-s">Login / Register</a></li>
                <li class="sub-menu__item"><a href="store_location.html" class="menu-link menu-link_us-s">Store Locator</a></li>
                <li class="sub-menu__item"><a href="lookbook.html" class="menu-link menu-link_us-s">Lookbook</a></li>
                <li class="sub-menu__item"><a href="faq.html" class="menu-link menu-link_us-s">Faq</a></li>
                <li class="sub-menu__item"><a href="terms.html" class="menu-link menu-link_us-s">Terms</a></li>
                <li class="sub-menu__item"><a href="404.html" class="menu-link menu-link_us-s">404 Error</a></li>
                <li class="sub-menu__item"><a href="coming_soon.html" class="menu-link menu-link_us-s">Coming Soon</a></li>
              </ul><!-- /.box-menu --> --}}
            </li>
            <li class="navigation__item">
              <a href="about.html" class="navigation__link">About</a>
            </li>
            <li class="navigation__item">
              <a href="contact.html" class="navigation__link">Contact</a>
            </li>
          </ul><!-- /.navigation__list -->
        </nav><!-- /.navigation -->

        <div class="header-tools d-flex align-items-center me-0">
          <div class="header-tools__item text-white d-none d-xxl-block">
            <span class="fs-15 fw-semi-bold text-uppercase">Need Help? 0020 500</span>
          </div>

          <div class="header-tools__item hover-container">
            <a class="header-tools__item js-open-aside" href="#" data-aside="customerForms">
              <i class="fa-regular fa-user fa-xl"></i>
            </a>
          </div>
  
          <a class="header-tools__item" href="account_wishlist.html">
            <i class="fa-regular fa-heart fa-xl"></i>
          </a>
  
          <a href="#" class="header-tools__item header-tools__cart js-open-aside" data-aside="cartDrawer">
            <i class="fa-solid fa-cart-shopping fa-xl"></i>
            <span class="cart-amount d-block position-absolute js-cart-items-count">3</span>
          </a>
        </div><!-- /.header__tools -->
      </div>
    </div><!-- /.header-middle -->

    <div class="header-bottom pb-4 mb-2">
      <div class="container d-flex align-items-center">
        <div class="categories-nav position-relative">
          <h3 class="categories-nav__title d-flex align-items-center gap-4 py-2 btn-50 theme-bg-color-secondary text-primary px-4 border-radius-10">
            <i class="fa-solid fa-bars fa-xl"></i>
              <use href="#icon_nav"/>
            </svg>
            <span class="fw-semi-bold lh-1">Browse Categories</span>
            <i class="fa-solid fa-angle-down fa-xl"></i>
              <use href="#icon_down"/>
            </svg>
          </h3>
          <ul class="categories-nav__list list-unstyled border-radius-10">
            <li class="categories-nav__item"><a class="text-primary" href="#">Electronics</a></li>
            <li class="categories-nav__item"><a class="text-primary" href="#">Computers</a></li>
            <li class="categories-nav__item"><a class="text-primary" href="#">Audio & Video</a></li>
            <li class="categories-nav__item"><a class="text-primary" href="#">Mobiles & Tablets</a></li>
            <li class="categories-nav__item"><a class="text-primary" href="#">TV & Audio</a></li>
            <li class="categories-nav__item"><a class="text-primary" href="#">Car & Motorbike</a></li>
            <li class="categories-nav__item"><a class="text-primary" href="#">Hmoe & Garden</a></li>
            <li class="categories-nav__item"><a class="text-primary" href="#">Toys & Kids</a></li>
            <li class="categories-nav__item"><a class="text-primary" href="#">Sporting Goods</a></li>
            <li class="categories-nav__item"><a class="text-primary" href="#">Pet Supplies</a></li>
          </ul>
        </div>

        <form action="https://uomo-html.flexkitux.com/Demo18/" method="GET" class="header-search search-field me-0 border-radius-10">
          <button class="btn header-search__btn" type="submit">
            <i class="fa-solid fa-magnifying-glass fa-xl"></i>
          </button>
          <input class="header-search__input w-100" type="text" name="search-keyword" placeholder="Search products...">
          <div class="hover-container position-relative">
            <div class="js-hover__open">
              <input class="header-search__category search-field__actor border-0 bg-white w-100 fw-semi-bold" type="text" name="search-category" placeholder="ALL CATEGORY" readonly>
            </div>
            <div class="header-search__category-list js-hidden-content mt-2">
              <ul class="search-suggestion list-unstyled">
                <li class="search-suggestion__item js-search-select">All Category</li>
                <li class="search-suggestion__item js-search-select">Men</li>
                <li class="search-suggestion__item js-search-select">Women</li>
                <li class="search-suggestion__item js-search-select">Kids</li>
              </ul>
            </div>
          </div>
        </form><!-- /.header-search -->
      </div>
    </div><!-- /.header-bottom -->
  </div><!-- /.header-desk header-desk_type_6 -->
</header>

<!-- End Header Type 6 -->
<div class="aside aside_right overflow-hidden cart-drawer" id="cartDrawer">
  <div class="aside-header d-flex align-items-center">
    <h3 class="text-uppercase fs-6 mb-0">SHOPPING BAG ( <span class="cart-amount js-cart-items-count">1</span> ) </h3>
    <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
  </div><!-- /.aside-header -->

  <div class="aside-content cart-drawer-items-list">
    <div class="cart-drawer-item d-flex position-relative">
      <div class="position-relative">
        <a href="product1_simple.html">
          <img loading="lazy" class="cart-drawer-item__img" src="{{ asset('theme/client/images/cart-item-1.jpg') }}" alt="">
        </a>
      </div>
      <div class="cart-drawer-item__info flex-grow-1">
        <h6 class="cart-drawer-item__title fw-normal"><a href="product1_simple.html">Zessi Dresses</a></h6>
        <p class="cart-drawer-item__option text-secondary">Color: Yellow</p>
        <p class="cart-drawer-item__option text-secondary">Size: L</p>
        <div class="d-flex align-items-center justify-content-between mt-1">
          <div class="qty-control position-relative">
            <input type="number" name="quantity" value="1" min="1" class="qty-control__number border-0 text-center">
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
          <img loading="lazy" class="cart-drawer-item__img" src="{{ asset('theme/client/images/cart-item-2.jpg') }}" alt="">
        </a>
      </div>
      <div class="cart-drawer-item__info flex-grow-1">
        <h6 class="cart-drawer-item__title fw-normal"><a href="product1_simple.html">Kirby T-Shirt</a></h6>
        <p class="cart-drawer-item__option text-secondary">Color: Black</p>
        <p class="cart-drawer-item__option text-secondary">Size: XS</p>
        <div class="d-flex align-items-center justify-content-between mt-1">
          <div class="qty-control position-relative">
            <input type="number" name="quantity" value="4" min="1" class="qty-control__number border-0 text-center">
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
          <img loading="lazy" class="cart-drawer-item__img" src="{{ asset('theme/client/images/cart-item-3.jpg') }}" alt="">
        </a>
      </div>
      <div class="cart-drawer-item__info flex-grow-1">
        <h6 class="cart-drawer-item__title fw-normal"><a href="product1_simple.html">Cableknit Shawl</a></h6>
        <p class="cart-drawer-item__option text-secondary">Color: Green</p>
        <p class="cart-drawer-item__option text-secondary">Size: L</p>
        <div class="d-flex align-items-center justify-content-between mt-1">
          <div class="qty-control position-relative">
            <input type="number" name="quantity" value="3" min="1" class="qty-control__number border-0 text-center">
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