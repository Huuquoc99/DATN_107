@extends('client.layouts.master')
@section('title')
    TechStore
@endsection
@section('content')
    <div class="breadcrumb">
        <section class="shop-checkout container">
            @include('client.components.breadcrumb', [
                'breadcrumbs' => [
                    ['label' => 'Giỏ hàng', 'url' => '/cart/list']
                ]
            ])
            <div class="shopping-cart" style="margin-bottom: 200px">
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
                                <th>Ảnh</th>
                                <th>Sản phẩm</th>
                                <th>GIá</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($unifiedCart as $item)
                                <tr>

                                    <td>
                                        <div class="shopping-cart__product-item">
                                            <img loading="lazy"
                                                 src="{{ \Illuminate\Support\Facades\Storage::url($item['image'] ?? 'default-image.jpg') }}"
                                                 width="120" height="120" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shopping-cart__product-item__detail">
                                            <h4><a
                                                    href="#">{{ \Illuminate\Support\Str::limit($item['name'], 25) }}</a>
                                            </h4>
                                            <ul class="shopping-cart__product-item__options">
                                                <li>{{ $item['color'] }}</li>
                                                <li>{{ $item['capacity'] }}</li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="shopping-cart__product-price">{{ number_format($item['price'], 0, ',', '.') }}
                                            VND</span>
                                    </td>
                                    <td>
                                        <div class="qty-control position-relative">
                                            <input type="number" data-id="{{ $item['product_variant_id'] }}"
                                                   name="quantity" value="{{ $item['quantity'] }}"
                                                   class="qty-control__number text-center">
                                            <div class="qty-control__reduce" id="new_quantity">-</div>
                                            <div class="qty-control__increase" id="new_quantity">+</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="shopping-cart__subtotal"
                                              id="total">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                            VND</span>
                                    </td>
                                    <td>
                                        <a href="#" class="remove-cart-v2"
                                           data-id="{{ $item['product_variant_id'] }}">
                                            <i class="fa-solid fa-trash-can fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="shopping-cart__totals-wrapper ">
                        <div class="sticky-content">
                            <div class="mb-3 pb-3 border-bottom">
                
                            </div>
                            <div class="mobile_fixed-btn_wrapper">
                                <div class="button-wrapper container">
                                    <a href="{{ route('checkout.index') }}">
                                        <button style="" class="btn btn-primary btn-checkout">TIẾN HÀNH THANH TOÁN
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="row">
                                <div class="col-6 empty-cart mt-5">
                                    <h6>Chưa có sản phẩm nào trong giỏ hàng!</h6>
                                    <label class="mt-2">Cùng mua sắm hàng ngàn sản phẩm tại TechStore nhé!</label>
                                    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Tiếp tục mua sắm.</a>
                                </div>

                                <div class="col-6">
                                    <img src="{{ asset('theme/client/images/empty_cart.png') }}">
                                </div>
                            </div>
                        @endif
                    </div>
        </section>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#apply-voucher').on('click', function (e) {
                e.preventDefault();

                var voucherCode = $('#voucher-code-input').val();
                $('#error-message-add-voucher').removeClass('d-block').addClass('d-none');
                if (!voucherCode) {
                    $('#error-message-add-voucher').removeClass('d-none').addClass('d-block');
                    $('#error-message-add-voucher').text('Please enter a voucher code.');
                    return;
                }

                $.ajax({
                    url: '/apply-voucher',
                    method: 'POST',
                    data: {
                        code: voucherCode,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $('#error-message-add-voucher').removeClass('d-none invalid-feedback').addClass('d-block valid-feedback');
                        $('#error-message-add-voucher').text('Voucher applied successfully!');
                        location.reload();
                    },
                    error: function (error) {
                        $('#error-message-add-voucher').removeClass('d-none').addClass('d-block invalid-feedback');
                        if (error.responseJSON && error.responseJSON.message) {
                            $('#error-message-add-voucher').text(error.responseJSON.message);
                        } else {
                            $('#error-message-add-voucher').text('An error occurred. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endsection
