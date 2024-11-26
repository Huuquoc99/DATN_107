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
                                    <input type="text" class="input" id="ship_user_name" placeholder="First Name"
                                           value="{{ old('ship_user_name', $user->name ?? '') }}" required name="ship_user_name">
                                    {{-- <label for="ship_user_name"> Name</label> --}}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="email" class="input" id="ship_user_email" placeholder="Email"
                                           value="{{ old('ship_user_email', $user->email ?? '') }}" required name="ship_user_email">
                                    {{-- <label for="ship_user_email">Email</label> --}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="number" class="input" id="ship_user_phone" placeholder="Phone"
                                           value="{{ old('ship_user_phone', $user->phone ?? '') }}" required name="ship_user_phone">
                                    {{-- <label for="ship_user_phone">Phone</label> --}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="input" id="ship_user_address" placeholder="Address"
                                           value="{{ old('ship_user_address', $user->address ?? '') }}" required name="ship_user_address">
                                    {{-- <label for="ship_user_address">Address</label> --}}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <div class="row">
                                        <div class="form-group col-12 col-md-4 ">
                                            <label for="province">Province/City</label>
                                            <select id="province" name="province" class="form-control" onchange="fetchDistricts(this.value)">
                                                <option value="">Select Province/City</option>
                                                @foreach($provinces['results'] as $province)
                                                    <option  value="{{ $province['province_id'] }}">{{ $province['province_name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12 col-md-4">
                                            <label for="district">District</label>
                                            <select id="district" name="district" class="form-control" onchange="fetchWards(this.value)">
                                                <option value="">Select District</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-12 col-md-4">
                                            <label for="ward">Ward/Commune</label>
                                            <select id="ward" name="ward" class="form-control">
                                                <option value="">Select Ward/Commune</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="mt-3">
                            <textarea class="form-control form-control_gray input" placeholder="Order Notes (optional)" cols="30" rows="8"
                                      name="ship_user_note"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="checkout__totals-wrapper mt-5">
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
                                    @if(Auth::check())
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td>{{ $item->productVariant->product->name }} x {{ $item->quantity }}</td>
                                                <td>{{ $item->productVariant->capacity->name }}</td>
                                                <td>{{ $item->productVariant->color->name }}</td>
                                                <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach ($guest_cart as $item)
                                                <tr>
                                                <td>{{ $item['name'] }} x {{ $item['quantity'] }}</td>
                                                <td>{{ $item['capacity'] }}</td>
                                                <td>{{ $item['color'] }}</td>
                                                <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <table class="checkout-totals">
                                    <tbody>
                                    @if(Auth::check())
                                        <tr>
                                            <th>SUBTOTAL</th>
                                            <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        @if ($voucher)
                                            <tr>
                                                <th>DISCOUNT</th>
                                                <td>-{{ number_format($voucher->discount, 0, ',', '.') }} VNĐ</td>
                                            <tr>
                                        @endif
                                        <tr>
                                            <th>TOTAL</th>
                                            <td>{{ number_format($item->price * $item->quantity - ($voucher ? $voucher->discount : 0), 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th>SUBTOTAL</th>
                                            <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        <tr>
                                            <th>TOTAL</th>
                                            <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                    @endif
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
                                                {{ $method->description }}
                                            </span>
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                            <button type="submit" class="btn btn-primary btn-checkout mb-4" name="redirect">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection

@section('api-address')
    <script>
        function fetchDistricts(provinceId) {
            if (!provinceId) {
                document.getElementById('district').innerHTML = '<option value="">Chọn Quận/Huyện</option>';
                document.getElementById('ward').innerHTML = '<option value="">Chọn Phường/Xã</option>';
                return;
            }

            fetch(`/order/districts/${provinceId}`)
                .then(response => response.json())
                .then(data => {

                    let districtOptions = '<option value="">Chọn Quận/Huyện</option>';

                    if (Array.isArray(data)) {
                        console.log(data);
                        data.forEach(district => {
                            districtOptions += `<option value="${district.district_id}">${district.district_name}</option>`;
                        });
                    } else {
                        console.error("Dữ liệu không phải là mảng:", data);
                    }

                    document.getElementById('district').innerHTML = districtOptions;
                    document.getElementById('ward').innerHTML = '<option value="">Chọn Phường/Xã</option>';
                })
                .catch(error => {
                    console.error("Lỗi khi fetch dữ liệu:", error);
                });
        }

        function fetchWards(districtId) {
            if (!districtId) {
                document.getElementById('ward').innerHTML = '<option value="">Chọn Phường/Xã</option>';
                return;
            }

            fetch(`/order/wards/${districtId}`)
                .then(response => response.json())
                .then(data => {
                    let wardOptions = '<option value="">Chọn Phường/Xã</option>';
                    data.forEach(ward => {
                        wardOptions += `<option value="${ward.ward_id}">${ward.ward_name}</option>`;
                    });
                    document.getElementById('ward').innerHTML = wardOptions;
                });
        }

    </script>
@endsection
