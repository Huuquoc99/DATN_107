<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo hủy đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 20px;
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .content p {
            margin: 15px 0;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            margin-top: 20px;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .order-details {
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 10px;
            margin: 20px 0;
        }

        .order-details strong {
            color: #007bff;
        }
    </style>
</head>

<body>

<<<<<<< HEAD
<div class="container">
    <div class="header">
        <h2 style="padding-left: 20px">Thông báo hủy đơn hàng</h2>
    </div>

    @php
        $cancelReasons = [
            'product-out-in-stock' => 'Sản phẩm hết hàng trong kho.',
            'payment-failed' => 'Thanh toán không thành công.',
            'defective-product' => 'Phát hiện lỗi trong đơn hàng (sai giá, thông tin sản phẩm).',
            'unable-to-contact' => 'Không thể liên lạc với khách để xác nhận đơn hàng.',
            'other' => 'Khác'
        ];
    @endphp

    <div class="content">
        <p>Xin chào <strong>{{ $order->user ? $order->user->name : $order->ship_user_name }}</strong>,</p>
        <p>Chúng tôi rất tiếc thông báo rằng đơn hàng với mã <strong>{{ $order->code }}</strong> đã bị hủy theo yêu cầu.</p>

        <div class="order-details">
            <p><strong>Chi tiết đơn hàng:</strong></p>
            <p>Mã đơn hàng: <strong>{{ $order->code }}</strong></p>
            <p>Trạng thái: <strong>{{ $order->statusOrder->name }}</strong></p>
            <p>Lý do hủy: <strong>{{ $order->cancel_reason === 'other' ? $order->cancel_reason : ($cancelReasons[$order->cancel_reason] ?? 'Không có lý do') }}</strong></p>
            <p>Người hủy: <strong>{{ $order->canceled_by }}</strong></p>
        </div>

        <p>Chúng tôi xin lỗi vì bất kỳ sự bất tiện nào. Nếu bạn có bất kỳ câu hỏi nào hoặc cần hỗ trợ thêm, vui lòng liên hệ với chúng tôi qua email hoặc số điện thoại bên dưới.</p>

        <p>Chân thành cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
    </div>

    <div class="footer">
        <p><a href="mailto:techstore@gmail.com">Email hỗ trợ</a> | <a href="tel:0987654321">Liên hệ qua số điện thoại</a></p>
        <p>Trân trọng, TechStore</p>
=======
    <div class="container">
        <div class="header">
            <h2 style="padding-left: 20px">Thông báo hủy đơn hàng</h2>
        </div>

        <div class="content">
            <p>Xin chào <strong> {{ $order->user ? $order->user->name : $order->ship_user_name }}</strong>,</p>
            <p>Chúng tôi rất tiếc phải thông báo rằng đơn hàng có mã <strong>{{ $order->code }}</strong> của bạn đã bị
                hủy theo yêu cầu của người quản lý.</p>

            <div class="order-details">
                <p><strong>Chi tiết đơn hàng:</strong></p>
                <p>Mã đơn hàng: <strong>{{ $order->code }}</strong></p>
                <p>Trạng thái: <strong>{{ $order->statusOrder->name }}</strong></p>
            </div>

            <p>Chúng tôi xin lỗi vì bất kỳ sự bất tiện nào. Nếu bạn có bất kỳ câu hỏi nào hoặc cần hỗ trợ thêm, vui lòng
                liên hệ với chúng tôi qua email hoặc số điện thoại bên dưới.</p>

            <p>Cảm ơn bạn rất nhiều vì đã sử dụng dịch vụ của chúng tôi!</p>
        </div>

        <div class="footer">
            <p><a href="mailto:techstore@gmail.com">Email hỗ trợ</a> | <a href="tel:0987654321">Liên hệ qua điện
                    thoại</a></p>
            <p>Trân trọng, TechStore</p>
        </div>
>>>>>>> hoa04
    </div>

</body>

</html>
