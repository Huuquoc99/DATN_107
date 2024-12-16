<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; background-color: #f9f9f9; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
        <h2 style="color: #4CAF50; font-size: 24px; text-align: center;">Đơn hàng của bạn đã bị hủy.</h2>

        @php
            $cancelReasons = [
                'product-out-in-stock' => 'Sản phẩm hết hàng trong kho.',
                'payment-failed' => 'Thanh toán không thành công.',
                'defective-product' => 'Phát hiện lỗi trong đơn hàng (sai giá, thông tin sản phẩm).',
                'unable-to-contact' => 'Không thể liên lạc với khách để xác nhận đơn hàng.',
                'no_confirmation_email' => 'Không có mail xác nhận đơn hàng',
                 'changed_mind' => 'Tôi đã thay đổi ý định',
                'found_cheaper' => 'Đã tìm thấy một lựa chọn rẻ hơn',
                'delivery_delay' => 'Giao hàng mất quá nhiều thời gian',
                'incorrect_item' => 'Chi tiết mặt hàng sai',
                'cost_high' => 'Chi phí vận chuyển quá cao',
                'other' => 'Khác'
            ];
        @endphp

        <p style="font-size: 14px; color: #777;">Chúng tôi xin thông báo rằng đơn hàng của bạn với mã đơn hàng <strong>{{ $order->code }}</strong> đã bị hủy theo yêu cầu của bạn.</p>
        <p><strong>Lý do hủy đơn:</strong>{{ $order->cancel_reason === 'other' ? $order->cancel_reason : ($cancelReasons[$order->cancel_reason] ?? 'Không có lý do') }}</p>

        <h3 style="font-size: 18px; color: #333;">Thông tin đơn hàng</h3>
        <p><strong>Mã đơn hàng:</strong> {{ $order->code }}</p>
        <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d M, Y h:iA') }}</p>
        <p><strong>Tình trạng thanh toán:</strong> {{ $order->statusPayment->name }}</p>
        <p><strong>Tổng:</strong> {{ number_format($order->total_price, 0, ',', '.') }} VND</p>

        <h3 style="font-size: 18px; color: #333;">Thông tin giao hàng</h3>
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <div style="width: 45%; padding-right: 10px;">
                <h4 style="font-size: 16px; color: #333;">Địa chỉ</h4>
                <p>{{ $order->user_name }}</p>
                <p>{{ $order->user_address }}</p>
                <p>{{ $order->user_email }}</p>
                <p>{{ $order->user_phone }}</p>
            </div>
            <div style="width: 45%; padding-left: 10px;">
                <h4 style="font-size: 16px; color: #333;">Địa chỉ</h4>
                <p>{{ $order->ship_user_name }}</p>
                <p>{{ $order->ship_user_address }}</p>
                <p>{{ $order->ship_user_email }}</p>
                <p>{{ $order->ship_user_phone }}</p>
            </div>
        </div>

        <h3 style="font-size: 18px; color: #333;">Chi tiết đơn hàng</h3>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Sản phẩm</th>
                    <th style="text-align: right; padding: 10px; border-bottom: 1px solid #ddd;">Số lượng</th>
                    <th style="text-align: right; padding: 10px; border-bottom: 1px solid #ddd;">Giá</th>
                    <th style="text-align: right; padding: 10px; border-bottom: 1px solid #ddd;">Tổng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                    <tr>
                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">
                            {{ $item->product_name }} <br>
                            <span style="font-size: 12px; color: #666;">{{ $item->capacity->name ?? 'N/A' }} - {{ $item->color->name ?? 'N/A' }}</span>
                        </td>
                        <td style="text-align: right; padding: 10px; border-bottom: 1px solid #ddd;">{{ $item->quantity }}</td>
                        <td style="text-align: right; padding: 10px; border-bottom: 1px solid #ddd;">{{ number_format($item->product_price_sale, 0, ',', '.') }} VND</td>
                        <td style="text-align: right; padding: 10px; border-bottom: 1px solid #ddd;">
                            {{ number_format($item->product_price_sale * $item->quantity, 0, ',', '.') }} VND
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3 style="font-size: 18px; color: #333;">Thông tin thanh toán</h3>
        <p><strong>Phương thức thanh toán:</strong> {{ $order->paymentMethod->name }}</p>

        <div style="text-align: center; margin-top: 30px;">
            <p style="font-size: 14px; color: #777;">We apologize for the inconvenience. If you have any questions or need further assistance, please contact us via email: <a href="mailto:techstore@gmail.com" style="color: #4CAF50;">techstore@gmail.com</a></p>
            <p style="font-size: 14px; color: #777;">Thank you for using our service!</p>

        </div>
    </div>
</body>
</html>


