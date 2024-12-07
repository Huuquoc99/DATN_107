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
            <form id="checkoutForm" action="{{ route('guest-checkout.process') }}" method="POST">
                @csrf
                <div class="checkout-form mb-5">
                    <div class="billing-info__wrapper">
                        <h4>BILLING DETAILS</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="ship_user_name" placeholder="First Name"
                                           name="ship_user_name" @error('ship_user_name') is-invalid @enderror">
                                    <label for="ship_user_name"> Name</label>
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
                                    <input type="number" class="form-control" id="ship_user_phone" placeholder="Phone"
                                           name="ship_user_phone">
                                    <label for="ship_user_phone">Phone</label>
                                    @error('ship_user_phone')
                                    <div style="color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="ship_user_address" placeholder="Address"
                                           name="ship_user_address">
                                    <label for="ship_user_address">Address</label>
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
                                        <label for="province">Province/City</label>
                                        <select id="province" name="province" class="form-control"
                                                onchange="fetchDistricts(this.value)">
                                            <option value="">Select Province/City</option>
                                            @foreach($provinces['results'] as $province)
                                                <option
                                                    value="{{ $province['province_id'] }}">{{ $province['province_name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('province')
                                        <div class="" style="color: #EA5651;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12 col-md-4">
                                        <label for="district">District</label>
                                        <select id="district" name="district" class="form-control"
                                                onchange="fetchWards(this.value)">
                                            <option value="">Select District</option>
                                        </select>
                                        @error('district')
                                        <div class="" style="color: #EA5651;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12 col-md-4">
                                        <label for="ward">Ward/Commune</label>
                                        <select id="ward" name="ward" class="form-control">
                                            <option value="">Select Ward/Commune</option>
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
                            <textarea class="form-control form-control_gray" placeholder="Order Notes (optional)"
                                      cols="30" rows="8"
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
                                        <th>SUBTOTAL</th>
                                        <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                                    </tr>
                                    @if ($voucher)
                                        <tr>
                                            <th>VOUCHER</th>
                                            <td>-{{ number_format($voucher->discount, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>TOTAL</th>
                                        <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}VNĐ
                                        </td>
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
                                <input type="hidden" name="redirect" value="true">
                                <button type="submit" class="btn btn-primary mb-4" name="redirect">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </form>
            </section>
        </div>

        <div class="mt-5">
            <div class="modal" id="emailVerificationModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Xác Thực Email</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <label>Chúng tôi đã gửi mã xác thực đến email: <b><span id="verificationEmail"></span></b></label>
                            <div class="form-group">
                                <label>Nhập mã xác thực:</label>
                                <input type="text" id="verificationCode" class="form-control"
                                       placeholder="Nhập mã 6 số">
                                <label id="verificationError" style="display:none; color: #EA5651;"></label>
                            </div>
                        </div>
                        <div class="modal-footer m-3">
                            <button type="button" id="resendCodeBtn" class="btn btn-secondary">Gửi lại mã</button>
                            <button type="button" id="verifyCodeBtn" class="btn btn-primary" name="redirect">Xác Thực</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .modal-backdrop {
                display: none !important;
            }
        </style>
        @endsection

        @section('api-guest-address')
            <script>

                $(document).ready(function () {
                    var emailVerificationModal = new bootstrap.Modal(document.getElementById('emailVerificationModal'));

                    $('#checkoutForm').on('submit', function (e) {
                        e.preventDefault();

                        var email = $('#ship_user_email').val();

                        if (!validateEmail(email)) {
                            alert('Vui lòng nhập email hợp lệ');
                            return false;
                        }

                        $('.modal-backdrop').remove();

                        $.ajax({
                            url: '{{ route("send-verification-code") }}',
                            method: 'POST',
                            data: {
                                email: email,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                $('#verificationEmail').text(email);
                                emailVerificationModal.show();
                            },
                            error: function (xhr) {
                                alert('Có lỗi xảy ra khi gửi mã xác thực');
                            }
                        });
                    });

                    $('#verifyCodeBtn').on('click', function () {
                        var email = $('#ship_user_email').val();
                        var verificationCode = $('#verificationCode').val();

                        $.ajax({
                            url: '{{ route("verify-email-code") }}',
                            method: 'POST',
                            data: {
                                email: email,
                                verification_code: verificationCode,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                if (response.verified) {
                                    emailVerificationModal.hide();

                                    $('#checkoutForm')[0].submit();
                                } else {
                                    $('#verificationError').text('Mã xác thực không đúng').show();
                                }
                            },
                            error: function (xhr) {
                                $('#verificationError').text('Mã xác thực không chính xác!').show();
                            }
                        });
                    });

                    function validateEmail(email) {
                        const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                        return re.test(String(email).toLowerCase());
                    }

                    $('#resendCodeBtn').on('click', function () {
                        var email = $('#ship_user_email').val();

                        $.ajax({
                            url: '{{ route("send-verification-code") }}',
                            method: 'POST',
                            data: {
                                email: email,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                alert('Mã xác thực mới đã được gửi');
                            },
                            error: function (xhr) {
                                alert('Có lỗi xảy ra khi gửi lại mã');
                            }
                        });
                    });
                });

                $('#emailVerificationModal').on('hidden.bs.modal', function () {
                    $('.modal-backdrop').remove(); // Xóa backdrop nếu có
                });

            </script>
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
