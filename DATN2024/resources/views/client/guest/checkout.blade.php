@extends('client.layouts.master')

@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="">Vận chuyển và Thanh toán</h2>

            <form action="{{ route('guest-checkout.process') }}" method="POST">
                @csrf
                <div class="checkout-form mb-5">
                    <div class="billing-info__wrapper">
                        <h4>CHI TIẾT THANH TOÁN</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="ship_user_name" placeholder="Họ và tên"
                                           name="ship_user_name" @error('ship_user_name') is-invalid @enderror">
                                    <label for="ship_user_name"> Tên</label>
                                    @error('ship_user_name')
                                        <div style="color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="email" class="form-control" id="ship_user_email" placeholder="Email"
                                           name="ship_user_email">
                                    <label for="ship_user_email">Email</label>
                                    @error('ship_user_email')
                                    <div style="color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="number" class="form-control" id="ship_user_phone" placeholder="Số điện thoại"
                                           name="ship_user_phone">
                                    <label for="ship_user_phone">Số điện thoại</label>
                                    @error('ship_user_phone')
                                    <div style="color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="ship_user_address" placeholder="Địa chỉ"
                                           name="ship_user_address">
                                    <label for="ship_user_address">Địa chỉ</label>
                                    @error('ship_user_address')
                                    <div style="color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating my-3">
                                <div class="row">
                                    <div class="form-group col-12 col-md-4">
                                        <label for="province">Tỉnh/Thành phố</label>
                                        <select id="province" name="province" class="form-control" onchange="fetchDistricts(this.value)">
                                            <option value="">Chọn Tỉnh/Thành Phố</option>
                                            @foreach($provinces['results'] as $province)
                                                <option value="{{ $province['province_id'] }}">{{ $province['province_name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('province')
                                        <div class="" style="color: #EA5651;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12 col-md-4">
                                        <label for="district">Huyện</label>
                                        <select id="district" name="district" class="form-control" onchange="fetchWards(this.value)">
                                            <option value="">Chọn Quận</option>
                                        </select>
                                        @error('district')
                                        <div class="" style="color: #EA5651;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12 col-md-4">
                                        <label for="ward">Phường/Xã</label>
                                        <select id="ward" name="ward" class="form-control">
                                            <option value="">Chọn Phường/Xã</option>
                                        </select>
                                        @error('ward')
                                        <div class="" style="color: #EA5651;">{{ $message }}</div>
                                        @enderror
                                    </div>
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
                    <div class="checkout__totals-wrapper mt-5">
                        <div class="sticky-content">
                            <div class="checkout__totals">
                                <h3>Đơn hàng của bạn</h3>
                                <table class="checkout-cart-items">
                                    <thead>
                                        <th>SẢN PHẨM</th>
                                        <th>DUNG LƯỢNG</th>
                                        <th>MÀU SẮC</th>
                                        <th>GIÁ</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($guest_cart as $item)
                                            <tr>
                                                <td>{{ $item['name'] }} x {{ $item['quantity'] }}</td>
                                                <td>{{ $item['capacity'] }}</td>
                                                <td>{{ $item['color'] }}</td>
                                                <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="checkout-totals">
                                    <tbody>
                                        <tr>
                                            <th>TỔNG CỘNG</th>
                                            <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        @if ($voucher)
                                            <tr>
                                                <th>MÃ giảm giá</th>
                                                <td>-{{ number_format($voucher->discount, 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th>Tổng</th>
                                            <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</td>
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
                                                {{ $method->description }}
                                            </span>
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                            <button type="submit" class="btn btn-primary mb-4" name="redirect">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection

@section('api-guest-address')
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
