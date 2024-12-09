@extends('client.layouts.master')

@section('content')
    <div class="breadcrumb">
        <div class="shop-checkout container">
            @include('client.components.breadcrumb', [
                   'breadcrumbs' => [
                       ['label' => 'Giỏ hàng', 'url' => null],
                       ['label' => 'Thanh toán', 'url' => null],
                   ]
               ])
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="checkout-form">
                    @if (session('error'))
                            <div class="" style="color: #EA5651;">
                                {{ session('error') }}
                            </div>
                        @endif
                    <div class="billing-info__wrapper">
                        <h4>CHI TIẾT THANH TOÁN</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="input" id="ship_user_name" placeholder="Họ và tên"
                                           value="{{ old('ship_user_name', $user->name ?? '') }}" name="ship_user_name">
                                </div>
                                @error('ship_user_name')
                                <div class="" style="color: #EA5651;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="email" class="input" id="ship_user_email" placeholder="Email"
                                           value="{{ old('ship_user_email', $user->email ?? '') }}" name="ship_user_email">
                                </div>
                                @error('ship_user_email')
                                <div class="" style="color: #EA5651;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="number" class="input" id="ship_user_phone" placeholder="Số điện thoại"
                                           value="{{ old('ship_user_phone', $user->phone ?? '') }}" name="ship_user_phone">
                                </div>
                                @error('ship_user_phone')
                                <div class="" style="color: #EA5651;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="input" id="ship_user_address" placeholder="Địa chỉ"
                                           value="{{ old('ship_user_address', $user->address ?? '') }}" name="ship_user_address">
                                </div>
                                @error('ship_user_address')
                                <div class="" style="color: #EA5651;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <div class="row">
                                        <div class="form-group col-12 col-md-4 ">
                                            <label for="province">Tỉnh/Thành phố</label>
                                            <select id="province" name="province" class="form-control" onchange="fetchDistricts(this.value)">
                                                <option value="">Chọn Tỉnh/Thành Phố</option>
                                                @foreach($provinces['results'] as $province)
                                                    <option  value="{{ $province['province_id'] }}">{{ $province['province_name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('province')
                                            <div class="" style="color: #EA5651;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-12 col-md-4">
                                            <label for="district">Huyện</label>
                                            <select id="district" name="district" class="form-control" onchange="fetchWards(this.value)">
                                                <option value="">Chọn Huyện</option>
                                            </select>
                                            @error('district')
                                            <div class="" style="color: #EA5651;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-12 col-md-4">
                                            <label for="ward">Phường/Xã</label>
                                            <select id="ward" name="ward" class="form-control">
                                                <option value=""> ChọnPhường/Xã</option>
                                            </select>
                                            @error('ward')
                                            <div class="" style="color: #EA5651;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="mt-3">
                            <textarea class="form-control form-control_gray input" placeholder="Ghi chú đơn hàng (tùy chọn)" cols="30" rows="8"
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
                                        <th>SẢN PHẨM</th>
                                        <th>DUNG LƯỢNG</th>
                                        <th>MÀU SẮC</th>
                                        <th>GIÁ</th>
                                    </thead>
                                    <tbody>
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    @foreach ($cartItems as $item)
                                        @php
                                            $subtotal += $item->price * $item->quantity;
                                        @endphp
                                        <tr>
                                            <td>{{ $item->productVariant->product->name }} x {{ $item->quantity }}</td>
                                            <td>{{ $item->productVariant->capacity->name }}</td>
                                            <td>{{ $item->productVariant->color->name }}</td>
                                            <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <div class="mb-3 pb-3 border-bottom">
                                        <div class="fw-medium mb-2">VOUCHER</div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="voucher-code-input" value="{{ session('voucher') }}" placeholder="Enter voucher code">
                                            <button type="button" class="btn btn-dark" id="apply-voucher">Apply</button>
                                        </div>
                                        <div class="invalid-feedback d-none mt-2" id="error-message-add-voucher">
                                            The voucher code is invalid or has expired.
                                        </div>
                                    </div>
                                </table>
                                <table class="checkout-totals">
                                    <tbody>
                                    @if(Auth::check())
                                        <tr>
                                            <input type="hidden" name="subtotal" value="{{$subtotal}}">
                                            <th>SUBTOTAL</th>
                                            <td>{{ number_format($subtotal, 0, ',', '.') }} VNĐ</td>
                                            <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                        </tr>
                                        @if ($voucher)
                                            <tr>
                                                <input type="hidden" name="voucher" value="{{$voucher->discount}}">
                                                <th>GIẢM GIÁ</th>
                                                {{-- <td>-{{ number_format($voucher->discount, 0, ',', '.') }} VNĐ</td> --}}
                                                <td>
                                                    @if($voucher->discount_type == 'amount')
                                                        -{{ number_format($voucher->discount, 0, ',', '.') }} VNĐ
                                                    @elseif($voucher->discount_type == 'percent')
                                                        {{-- -{{ $voucher->discount }}% --}}
                                                        -{{ number_format($subtotal * $voucher->discount / 100, 0, ',', '.') }} VNĐ ({{ $voucher->discount }}%)
                                                    @endif
                                                </td>
                                                
                                            </tr>
                                        @endif
                                        <tr>
                                            <input type="hidden" name="total" value="{{$subtotal - ($voucher ? $voucher->discount : 0)}}">
                                            <th>TOTAL</th>
                                            {{-- <td>{{ number_format($subtotal - ($voucher ? $voucher->discount : 0), 0, ',', '.') }} VNĐ</td> --}}
                                            <td>
                                                @if($voucher)
                                                    @if($voucher->discount_type == 'percent')
                                                        {{ number_format($subtotal - ($subtotal * $voucher->discount / 100), 0, ',', '.') }} VNĐ
                                                    @else
                                                        {{ number_format($subtotal - $voucher->discount, 0, ',', '.') }} VNĐ
                                                    @endif
                                                @else
                                                    {{ number_format($subtotal, 0, ',', '.') }} VNĐ
                                                @endif
                                            </td>
                                            
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
                            <button type="submit" class="btn btn-primary btn-checkout mb-4" name="redirect">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        </div>
@endsection

@section('api-address')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#apply-voucher').on('click', function(event) {
                event.preventDefault();
                var voucherCode = $('#voucher-code-input').val();

                $.ajax({
                    url: '/apply-voucher',
                    method: 'POST',
                    data: {
                        code: voucherCode,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr) {
                        $('#error-message-add-voucher')
                            .removeClass('d-none')
                            .addClass('d-block')
                            .removeClass('valid-feedback')
                            .addClass('invalid-feedback')
                            .text(xhr.responseJSON.message);
                    }
                });
            });
        });

    </script>
    <script>
        function fetchDistricts(provinceId) {
            if (!provinceId) {
                document.getElementById('district').innerHTML = '<option value="">Select District</option>';
                document.getElementById('ward').innerHTML = '<option value="">Select Ward/Commune</option>';
                return;
            }

            fetch(`/order/districts/${provinceId}`)
                .then(response => response.json())
                .then(data => {

                    let districtOptions = '<option value="">Select District</option>';

                    if (Array.isArray(data)) {
                        console.log(data);
                        data.forEach(district => {
                            districtOptions += `<option value="${district.district_id}">${district.district_name}</option>`;
                        });
                    } else {
                        console.error("Data is not an array:", data);
                    }

                    document.getElementById('district').innerHTML = districtOptions;
                    document.getElementById('ward').innerHTML = '<option value="">Select Ward/Commune</option>';
                })
                .catch(error => {
                    console.error("Error while fetching data:", error);
                });
        }

        function fetchWards(districtId) {
            if (!districtId) {
                document.getElementById('ward').innerHTML = '<option value="">Select Ward/Commune</option>';
                return;
            }

            fetch(`/order/wards/${districtId}`)
                .then(response => response.json())
                .then(data => {
                    let wardOptions = '<option value="">Select Ward/Commune</option>';
                    data.forEach(ward => {
                        wardOptions += `<option value="${ward.ward_id}">${ward.ward_name}</option>`;
                    });
                    document.getElementById('ward').innerHTML = wardOptions;
                });
        }

            </script>
@endsection
