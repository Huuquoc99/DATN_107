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
                            <textarea class="form-control form-control_gray" placeholder="Order Notes (optional)"
                                      cols="30" rows="8"
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
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    @foreach ($guest_cart as $item)
                                        @php
                                            $subtotal += $item['price'] * $item['quantity'];
                                        @endphp
                                        <tr>
                                            <td>{{ $item['name'] }} x {{ $item['quantity'] }}</td>
                                            <td>{{ $item['capacity'] }}</td>
                                            <td>{{ $item['color'] }}</td>
                                            <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
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
                                        <tr>
                                            <th>SUBTOTAL</th>
                                            <td>{{ number_format($subtotal, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        @if ($voucher)
                                            <tr>
                                                <th>DISCOUNT</th>
                                                <td>-{{ number_format($voucher->discount, 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th>TOTAL</th>
                                            <td>{{ number_format($subtotal - ($voucher ? $voucher->discount : 0), 0, ',', '.') }} VNĐ</td>
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
                $(document).ready(function () {
                    var emailVerificationModal = new bootstrap.Modal(document.getElementById('emailVerificationModal'));

                    function validateFields() {
                        let isValid = true;

                        const name = $('#ship_user_name').val().trim();
                        if (name === '') {
                            $('#ship_user_name').addClass('is-invalid');
                            $('#ship_user_name').next('.invalid-feedback').remove();
                            $('#ship_user_name').after('<div class="invalid-feedback" style="display:block;">Vui lòng nhập tên</div>');
                            isValid = false;
                        } else {
                            $('#ship_user_name').removeClass('is-invalid');
                            $('#ship_user_name').next('.invalid-feedback').remove();
                        }

                        const email = $('#ship_user_email').val().trim();
                        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                        if (email === '' || !emailRegex.test(email)) {
                            $('#ship_user_email').addClass('is-invalid');
                            $('#ship_user_email').next('.invalid-feedback').remove();
                            $('#ship_user_email').after('<div class="invalid-feedback" style="display:block;">Vui lòng nhập email hợp lệ</div>');
                            isValid = false;
                        } else {
                            $('#ship_user_email').removeClass('is-invalid');
                            $('#ship_user_email').next('.invalid-feedback').remove();
                        }

                        const phone = $('#ship_user_phone').val().trim();
                        const phoneRegex = /^(0[1-9][0-9]{8,9})$/;
                        if (phone === '' || !phoneRegex.test(phone)) {
                            $('#ship_user_phone').addClass('is-invalid');
                            $('#ship_user_phone').next('.invalid-feedback').remove();
                            $('#ship_user_phone').after('<div class="invalid-feedback" style="display:block;">Vui lòng nhập số điện thoại hợp lệ</div>');
                            isValid = false;
                        } else {
                            $('#ship_user_phone').removeClass('is-invalid');
                            $('#ship_user_phone').next('.invalid-feedback').remove();
                        }

                        const address = $('#ship_user_address').val().trim();
                        if (address === '') {
                            $('#ship_user_address').addClass('is-invalid');
                            $('#ship_user_address').next('.invalid-feedback').remove();
                            $('#ship_user_address').after('<div class="invalid-feedback" style="display:block;">Vui lòng nhập địa chỉ</div>');
                            isValid = false;
                        } else {
                            $('#ship_user_address').removeClass('is-invalid');
                            $('#ship_user_address').next('.invalid-feedback').remove();
                        }

                        const province = $('#province').val();
                        if (province === '') {
                            $('#province').addClass('is-invalid');
                            $('#province').next('.invalid-feedback').remove();
                            $('#province').after('<div class="invalid-feedback" style="display:block;">Vui lòng chọn Tỉnh/Thành phố</div>');
                            isValid = false;
                        } else {
                            $('#province').removeClass('is-invalid');
                            $('#province').next('.invalid-feedback').remove();
                        }

                        const district = $('#district').val();
                        if (district === '') {
                            $('#district').addClass('is-invalid');
                            $('#district').next('.invalid-feedback').remove();
                            $('#district').after('<div class="invalid-feedback" style="display:block;">Vui lòng chọn Quận/Huyện</div>');
                            isValid = false;
                        } else {
                            $('#district').removeClass('is-invalid');
                            $('#district').next('.invalid-feedback').remove();
                        }

                        const ward = $('#ward').val();
                        if (ward === '') {
                            $('#ward').addClass('is-invalid');
                            $('#ward').next('.invalid-feedback').remove();
                            $('#ward').after('<div class="invalid-feedback" style="display:block;">Vui lòng chọn Phường/Xã</div>');
                            isValid = false;
                        } else {
                            $('#ward').removeClass('is-invalid');
                            $('#ward').next('.invalid-feedback').remove();
                        }

                        return isValid;
                    }

                    $('#ship_user_name, #ship_user_email, #ship_user_phone, #ship_user_address, #province, #district, #ward')
                        .on('input change', function() {
                            validateFields();
                        });

                    $('#checkoutForm').on('submit', function (e) {
                        e.preventDefault();

                        if (!validateFields()) {
                            return false;
                        }

                        var email = $('#ship_user_email').val();
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
                                Toastify({
                                    text: "Có lỗi xảy ra khi gửi mã xác thực!",
                                    duration: 3000,
                                    close: true,
                                    gravity: "top",
                                    position: "right",
                                    backgroundColor: "#405189",
                                    stopOnFocus: true
                                }).showToast();
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
                                Toastify({
                                    text: "Mã xác thực mới đã được gửi",
                                    duration: 3000,
                                    close: true,
                                    gravity: "top",
                                    position: "right",
                                    backgroundColor: "#405189",
                                    stopOnFocus: true
                                }).showToast();
                            },

                            error: function (xhr) {
                                Toastify({
                                    text: "Có lỗi xảy ra khi gửi mã xác thực!",
                                    duration: 3000,
                                    close: true,
                                    gravity: "top",
                                    position: "right",
                                    backgroundColor: "#405189",
                                    stopOnFocus: true
                                }).showToast();
                            }
                        });
                    });
                });

                $('#emailVerificationModal').on('hidden.bs.modal', function () {
                    $('.modal-backdrop').remove();
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
