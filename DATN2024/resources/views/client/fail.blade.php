@extends('client.layouts.master')

@section('content')
    <main>
        <section class="shop-checkout container">
            <div class="order-complete">
                <div class="order-complete__message">
                    <h3> <i class="fa-solid fa-triangle-exclamation fa-lg"></i>Thanh toán thất bại </h3>
                    <label>Thật không may, thanh toán của bạn không thành công. Vui lòng thử lại hoặc liên hệ với bộ phận hỗ trợ.</label>

                    <div class="m-4 text-center d-flex justify-content-center">
                        <form action="{{ route('account.orders.repayment', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" name="redirect" class="btn btn-primary mt-3">Thanh toán lại</button>
                        </form>
                        <a href="/home" class="btn btn-secondary" style="margin-left: 20px">Về trang chủ</a>
                    </div>

                </div>
                <div class="order-info">
                    <div class="order-info__item">
                        <label>Mã đơn hàng</label>
                        <span>{{ $order->code }}</span>
                    </div>
                    <div class="order-info__item">
                        <label>Ngày</label>
                        <span>{{ $order->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="order-info__item">
                        <label>Tổng</label>
                        <span>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</span>
                    </div>
                    <div class="order-info__item">
                        <label>Phương thức thanh toán</label>
                        <span>{{ $order->paymentMethod->name }}</span>
                    </div>
                </div>
                <div class="checkout__totals-wrapper">
                    <div class="checkout__totals">
                        <h3>Chi tiết đơn hàng</h3>
                        <table class="checkout-cart-items">
                            <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Màu</th>
                                <th>Dung lượng</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product_name }} x {{ $item->quantity }}</td>
                                    <td>
                                        @if ($item->product_capacity_id)
                                            {{ $item->capacity->name }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->product_color_id)
                                            {{ $item->color->name }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <table class="checkout-totals">
                            <tbody>
                            <tr>
                                <th class="align-left">Tổng</th>
                                <td class="align-right">{{ number_format($order->subtotal, 0, ',', '.') }} VNĐ</td>
                            </tr>
                            @if ($order->voucher)
                                <tr>
                                    <th class="align-left">Giảm giá</th>
                                    <td class="align-right">-{{ number_format($order->voucher->discount, 0, ',', '.') }} VNĐ</td>
                                </tr>
                            @endif
                            <tr>
                                <th class="align-left">Tổng thanh toán</th>
                                <td class="align-right">{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        .checkout-totals th.align-left {
            text-align: left;
        }

        .checkout-totals td.align-right {
            text-align: right;
        }

        .checkout-totals {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .checkout-totals th, .checkout-totals td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .checkout-totals tr:last-child td, .checkout-totals tr:last-child th {
            font-weight: bold;
            border-bottom: none;
        }

    </style>

@endsection
