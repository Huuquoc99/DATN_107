@extends('client.layouts.master')

@section('content')
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container" style="margin-bottom: 40px">
        <h4 class="page-title">Cart</h4>
        <a href="{{ route('cart.list') }}" class="checkout-steps__item active">
            <span class="checkout-steps__item-title">
            <span>SHOPPING BAG</span>
            <em>Manage your shopping bag</em>
          </span>
        </a>
        <div id="delete-success"></div>
        <div class="shopping-cart">
            @if (count($unifiedCart) > 0)
                <div class="cart-table__wrapper">
                    <table class="cart-table">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <thead>
                        <tr>
                            <th></th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($unifiedCart as $item)
                            <tr>

                                <td>
                                    <div class="shopping-cart__product-item">
                                        <img loading="lazy" src="{{ \Illuminate\Support\Facades\Storage::url($item['image'] ?? 'default-image.jpg') }}" width="120" height="120" alt="">
                                    </div>
                                </td>
                                <td>
                                    <div class="shopping-cart__product-item__detail">
                                        <h4><a href="#">{{ \Illuminate\Support\Str::limit($item['name'], 25) }}</a></h4>
                                        <ul class="shopping-cart__product-item__options">
                                            <li>{{ $item['color'] }}</li>
                                            <li>{{ $item['capacity'] }}</li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <span class="shopping-cart__product-price">{{ number_format($item['price'], 0, ',', '.') }} VND</span>
                                </td>
                                <td>
                                    <div class="qty-control position-relative">
                                        <input type="number" data-id="{{ $item['product_variant_id'] }}" name="quantity" value="{{ $item['quantity'] }}" class="qty-control__number text-center">
                                        <div class="qty-control__reduce" id="new_quantity">-</div>
                                        <div class="qty-control__increase" id="new_quantity">+</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="shopping-cart__subtotal" id="total">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VND</span>
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
                </div>

                <div class="shopping-cart__totals-wrapper">
                    <div class="sticky-content">
                        <div class="shopping-cart__totals">
                            <h3>Cart Totals</h3>
                            <table class="cart-totals">
                                <tbody>
                                <tr>
                                    <th>Subtotal</th>
                                    <td id="totalAmount">0 VND</td>
                                </tr>
                                <tr>
                                    <th>Shipping</th>
                                    <td>
                                        <!-- Các lựa chọn shipping -->
                                    </td>
                                </tr>
                                <tr>
                                    <th>VAT</th>
                                    <td>$19</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td id="finalTotal">0 VND</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mobile_fixed-btn_wrapper">
                            <div class="button-wrapper container">
                                <a href="{{ route('checkout.index') }}">
                                    <button class="btn btn-primary btn-checkout">PROCEED TO CHECKOUT</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="empty-cart">
                            <p>You have no products in your shopping cart.</p>
                            <a href="{{ route('home') }}" class="btn btn-primary">Continue shopping.</a>
                        </div>
                    @endif
        </div>
    </section>

@endsection
