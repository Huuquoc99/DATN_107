@extends('client.layouts.master')

@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Shipping and Checkout</h2>

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
