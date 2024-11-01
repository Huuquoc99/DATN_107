@extends('client.layouts.master')

@section('content')
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container" style="margin-bottom: 40px">
        <h2 class="page-title">Giỏ hàng</h2>
        <a href="{{ route('cart.list') }}" class="checkout-steps__item active">
            <span class="checkout-steps__item-title">
            <span>TÚI MUA SẮM</span>
            <em>Quản lý túi mua sắm của bạn</em>
          </span>
        </a>
        <div class="shopping-cart">
            <div class="cart-table__wrapper">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th></th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($unifiedCart as $item)
                        <tr>
                            <td>
                                <div class="shopping-cart__product-item">
                                    <a href="{{ route('product.detail', $item['product_id']) }}">
                                        <img loading="lazy" src="{{ \Illuminate\Support\Facades\Storage::url($item['image'] ?? 'default-image.jpg') }}" width="120" height="120" alt="">
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="shopping-cart__product-item__detail">
                                    <h4><a href="{{ route('product.detail', $item['product_id']) }}">{{ $item['name'] }}</a></h4>
                                    <ul class="shopping-cart__product-item__options">
                                        <li>{{ $item['color'] }}</li>  <!-- Fixed typo here -->
                                        <li>{{ $item['capacity'] }}</li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__product-price">{{ number_format($item['price'], 0, ',', '.') }} VND</span> <!-- Format price if needed -->
                            </td>
                            <td>
                                <div class="qty-control position-relative">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="qty-control__number text-center"> <!-- Use quantity from item -->
                                    <div class="qty-control__reduce">-</div>
                                    <div class="qty-control__increase">+</div>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__subtotal">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VND</span> <!-- Calculate subtotal -->
                            </td>
                            <td>
                                <a href="#" class="remove-cart-v2" data-id="{{ $item['product_variant_id'] }}">
                                    <i class="fa-solid fa-trash-can fa-lg"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                <div class="cart-table-footer">
                    <form action="https://uomo-html.flexkitux.com/Demo18/" class="position-relative bg-body">
                        <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code">
                        <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                               value="APPLY COUPON">
                    </form>
                    <button class="btn btn-light">UPDATE CART</button>
                </div>
            </div>
            <div class="shopping-cart__totals-wrapper">
                <div class="sticky-content">
                    <div class="shopping-cart__totals">
                        <h3>Cart Totals</h3>
                        <table class="cart-totals">
                            <tbody>
                            <tr>
                                <th>Subtotal</th>
                                <td>$1300</td>
                            </tr>
                            <tr>
                                <th>Shipping</th>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input_fill" type="checkbox" value=""
                                               id="free_shipping">
                                        <label class="form-check-label" for="free_shipping">Free shipping</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input_fill" type="checkbox" value=""
                                               id="flat_rate">
                                        <label class="form-check-label" for="flat_rate">Flat rate: $49</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input_fill" type="checkbox" value=""
                                               id="local_pickup">
                                        <label class="form-check-label" for="local_pickup">Local pickup: $8</label>
                                    </div>
                                    <div>Shipping to AL.</div>
                                    <div>
                                        <a href="#" class="menu-link menu-link_us-s">CHANGE ADDRESS</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>VAT</th>
                                <td>$19</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>$1319</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mobile_fixed-btn_wrapper">
                        <div class="button-wrapper container">
                            <button class="btn btn-primary btn-checkout">PROCEED TO CHECKOUT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
