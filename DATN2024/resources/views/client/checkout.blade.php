@extends('client.layouts.master')

@section('content')
    {{-- <main>
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
      <h2 class="page-title">Shipping and Checkout</h2>
      <div class="checkout-steps">
        <a href="shop_cart.html" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">01</span>
          <span class="checkout-steps__item-title">
            <span>Shopping Bag</span>
            <em>Manage Your Items List</em>
          </span>
        </a>
        <a href="shop_checkout.html" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">02</span>
          <span class="checkout-steps__item-title">
            <span>Shipping and Checkout</span>
            <em>Checkout Your Items List</em>
          </span>
        </a>
        <a href="shop_order_complete.html" class="checkout-steps__item">
          <span class="checkout-steps__item-number">03</span>
          <span class="checkout-steps__item-title">
            <span>Confirmation</span>
            <em>Review And Submit Your Order</em>
          </span>
        </a>
      </div>
      <form name="checkout-form" action="https://uomo-html.flexkitux.com/Demo18/shop_order_complete.html">
        <div class="checkout-form">
          <div class="billing-info__wrapper">
            <h4>BILLING DETAILS</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="checkout_first_name" placeholder="First Name">
                  <label for="checkout_first_name">First Name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="checkout_last_name" placeholder="Last Name">
                  <label for="checkout_last_name">Last Name</label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="checkout_company_name" placeholder="Company Name (optional)">
                  <label for="checkout_company_name">Company Name (optional)</label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="search-field my-3">
                  <div class="form-label-fixed hover-container">
                    <label for="search-dropdown" class="form-label">Country / Region*</label>
                    <div class="js-hover__open">
                      <input type="text" class="form-control form-control-lg search-field__actor search-field__arrow-down" id="search-dropdown" name="search-keyword" readonly placeholder="Choose a location...">
                    </div>
                    <div class="filters-container js-hidden-content mt-2">
                      <div class="search-field__input-wrapper">
                        <input type="text" class="search-field__input form-control form-control-sm bg-lighter border-lighter" placeholder="Search">
                      </div>
                      <ul class="search-suggestion list-unstyled">
                        <li class="search-suggestion__item js-search-select">Australia</li>
                        <li class="search-suggestion__item js-search-select">Canada</li>
                        <li class="search-suggestion__item js-search-select">United Kingdom</li>
                        <li class="search-suggestion__item js-search-select">United States</li>
                        <li class="search-suggestion__item js-search-select">Turkey</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-floating mt-3 mb-3">
                  <input type="text" class="form-control" id="checkout_street_address" placeholder="Street Address *">
                  <label for="checkout_company_name">Street Address *</label>
                </div>
                <div class="form-floating mt-3 mb-3">
                  <input type="text" class="form-control" id="checkout_street_address_2">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="checkout_city" placeholder="Town / City *">
                  <label for="checkout_city">Town / City *</label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="checkout_zipcode" placeholder="Postcode / ZIP *">
                  <label for="checkout_zipcode">Postcode / ZIP *</label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="checkout_province" placeholder="Province *">
                  <label for="checkout_province">Province *</label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="checkout_phone" placeholder="Phone *">
                  <label for="checkout_phone">Phone *</label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-floating my-3">
                  <input type="email" class="form-control" id="checkout_email" placeholder="Your Mail *">
                  <label for="checkout_email">Your Mail *</label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-check mt-3">
                  <input class="form-check-input form-check-input_fill" type="checkbox" value="" id="create_account">
                  <label class="form-check-label" for="create_account">CREATE AN ACCOUNT?</label>
                </div>
                <div class="form-check mb-3">
                  <input class="form-check-input form-check-input_fill" type="checkbox" value="" id="ship_different_address">
                  <label class="form-check-label" for="ship_different_address">SHIP TO A DIFFERENT ADDRESS?</label>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="mt-3">
                <textarea class="form-control form-control_gray" placeholder="Order Notes (optional)" cols="30" rows="8"></textarea>
              </div>
            </div>
          </div>
          <div class="checkout__totals-wrapper">
            <div class="sticky-content">
              <div class="checkout__totals">
                <h3>Your Order</h3>
                <table class="checkout-cart-items">
                  <thead>
                    <tr>
                      <th>PRODUCT</th>
                      <th>SUBTOTAL</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        Zessi Dresses x 2
                      </td>
                      <td>
                        $32.50
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Kirby T-Shirt
                      </td>
                      <td>
                        $29.90
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table class="checkout-totals">
                  <tbody>
                    <tr>
                      <th>SUBTOTAL</th>
                      <td>$62.40</td>
                    </tr>
                    <tr>
                      <th>SHIPPING</th>
                      <td>Free shipping</td>
                    </tr>
                    <tr>
                      <th>VAT</th>
                      <td>$19</td>
                    </tr>
                    <tr>
                      <th>TOTAL</th>
                      <td>$81.40</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="checkout__payment-methods">
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="checkout_payment_method" id="checkout_payment_method_1" checked>
                  <label class="form-check-label" for="checkout_payment_method_1">
                    Direct bank transfer
                    <span class="option-detail d-block">
                      Make your payment directly into our bank account. Please use your Order ID as the payment reference.Your order will not be shipped until the funds have cleared in our account.
                    </span>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="checkout_payment_method" id="checkout_payment_method_2">
                  <label class="form-check-label" for="checkout_payment_method_2">
                    Check payments
                    <span class="option-detail d-block">
                      Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida nec dui. Aenean aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra nunc, ut aliquet magna posuere eget.
                    </span>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="checkout_payment_method" id="checkout_payment_method_3">
                  <label class="form-check-label" for="checkout_payment_method_3">
                    Cash on delivery
                    <span class="option-detail d-block">
                      Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida nec dui. Aenean aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra nunc, ut aliquet magna posuere eget.
                    </span>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="checkout_payment_method" id="checkout_payment_method_4">
                  <label class="form-check-label" for="checkout_payment_method_4">
                    Paypal
                    <span class="option-detail d-block">
                      Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida nec dui. Aenean aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra nunc, ut aliquet magna posuere eget.
                    </span>
                  </label>
                </div>
                <div class="policy-text">
                  Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="terms.html" target="_blank">privacy policy</a>.
                </div>
              </div>
              <button class="btn btn-primary btn-checkout">PLACE ORDER</button>
            </div>
          </div>
        </div>
      </form>
    </section>
  </main> --}}

    {{--   
  <div class="container">
    <h2 class="page-title">Thanh toán</h2>
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div>
            <label for="ship_user_name">Tên người nhận:</label>
            <input type="text" id="ship_user_name" name="ship_user_name" value="{{ old('ship_user_name', $user->name) }}" required>
        </div>
        <div>
            <label for="ship_user_email">Email:</label>
            <input type="email" id="ship_user_email" name="ship_user_email" value="{{ old('ship_user_email', $user->email) }}" required>
        </div>
        <div>
            <label for="ship_user_phone">Số điện thoại:</label>
            <input type="text" id="ship_user_phone" name="ship_user_phone" value="{{ old('ship_user_phone', $user->phone) }}" required>
        </div>
        <div>
            <label for="ship_user_address">Địa chỉ:</label>
            <input type="text" id="ship_user_address" name="ship_user_address" required value="{{ old('ship_user_address', $user->address) }}">
        </div>
        <div class="form-group">
          <label for="payment_method_id">Phương thức thanh toán:</label>
          <select name="payment_method_id" id="payment_method_id" class="form-control" required>
              <option value="">Chọn phương thức thanh toán</option>
              @foreach ($paymentMethods as $method)
                  <option value="{{ $method->id }}">{{ $method->name }}</option>
              @endforeach
          </select>
      </div>
        <button type="submit">Xác nhận đơn hàng</button>
    </form>

    <h3>Thông tin giỏ hàng:</h3>
    <table>
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Màu</th>
                <th>Dung lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item->productVariant->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{$item->productVariant->capacity->name}}</td>
                    <td>{{$item->productVariant->color->name}}</td>
                    <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                    <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}

    <main>
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Shipping and Checkout</h2>
            {{-- <div class="checkout-steps">
                <a href="shop_cart.html" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Shopping Bag</span>
                        <em>Manage Your Items List</em>
                    </span>
                </a>
                <a href="shop_checkout.html" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Shipping and Checkout</span>
                        <em>Checkout Your Items List</em>
                    </span>
                </a>
                <a href="shop_order_complete.html" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Confirmation</span>
                        <em>Review And Submit Your Order</em>
                    </span>
                </a>
            </div> --}}

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="checkout-form">
                    <div class="billing-info__wrapper">
                        <h4>BILLING DETAILS</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="ship_user_name" placeholder="First Name"
                                        value="{{ old('ship_user_name', $user->name) }}" required name="ship_user_name">
                                    <label for="ship_user_name"> Name</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="email" class="form-control" id="ship_user_email" placeholder="Email"
                                        value="{{ old('ship_user_email', $user->email) }}" required name="ship_user_email">
                                    <label for="ship_user_email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="number" class="form-control" id="ship_user_phone" placeholder="Phone"
                                        value="{{ old('ship_user_phone', $user->phone) }}" required name="ship_user_phone">
                                    <label for="ship_user_phone">Phone</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="ship_user_address" placeholder="Address"
                                        value="{{ old('ship_user_address', $user->address) }}" required
                                        name="ship_user_address">
                                    <label for="ship_user_address">Address</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mt-3">
                                <textarea class="form-control form-control_gray" placeholder="Order Notes (optional)" cols="30" rows="8"
                                    name="ship_user_note"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="checkout__totals-wrapper">
                        <div class="sticky-content">
                            <div class="checkout__totals">
                                <h3>Your Order</h3>
                                <table class="checkout-cart-items">
                                    <thead>
                                        <th>PRODUCT</th>
                                        <th>CAPACITY</th>
                                        <th>COLOR</th>
                                        <th>PRICE</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->productVariant->product->name }} x {{ $item->quantity }}
                                                </td>
                                                <td>{{ $item->productVariant->capacity->name }}</td>
                                                <td>{{ $item->productVariant->color->name }}</td>
                                                <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="checkout-totals">
                                    <tbody>
                                        <tr>
                                            <th>SUBTOTAL</th>
                                            <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        <tr>
                                            <th>TOTAL</th>
                                            <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="checkout__payment-methods">
                                @foreach ($paymentMethods as $method)
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input_fill" type="radio"
                                            name="payment_method_id" id="checkout_payment_method_{{ $method->id }}"
                                            value="{{ $method->id }}" @if ($loop->first) checked @endif>
                                        <label class="form-check-label" for="checkout_payment_method_{{ $method->id }}">
                                            {{ $method->name }}
                                            <span class="option-detail d-block">
                                                Make your payment directly into our bank account. Please use your Order ID
                                                as the payment reference. Your order will not be shipped until the funds
                                                have cleared in our account.
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                                <div class="policy-text">
                                    Your personal data will be used to process your order, support your experience
                                    throughout this website, and for other purposes described in our <a href="terms.html"
                                        target="_blank">privacy policy</a>.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-checkout mb-4">PLACE ORDER</button>
                        </div>
                    </div>
                </div>

            </form>
        </section>
    </main>
@endsection
