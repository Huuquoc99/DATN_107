<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mail1.css">
    <title>Document</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .email1-container {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        width: 100%;
        padding: 20px;
        text-align: center;
        background-image: url('https://png.pngtree.com/thumb_back/fh260/background/20190221/ourmid/pngtree-5g-smart-phone-technology-banner-image_17947.jpg');
        background-size: cover;
        background-position: center center;
        /* background-color: #333; */
    }

    .email1-header h1 {
        color: #e74c3c;
        margin-bottom: 20px;
    }

    .icon {
        width: 100px;
        margin: 20px 0;
    }

    .email1-content p {
        color: #333;
        margin: 10px 0;
        line-height: 1.5;
    }

    .email1-content a {
        color: #3498db;
        text-decoration: none;
    }

    .retry-btn {
        background-color: #e74c3c;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 20px;
    }

    .retry-btn:hover {
        background-color: #c0392b;
    }

    .email1-footer {
        margin-top: 20px;
        color: #aaa;
        font-size: 14px;
    }


</style>
<body>
<div class="email1-container">
    <div class="email1-header">
        <h2 style="color: white;">Thanh Toán Thất Bại</h2>
    </div>
    <div class="email1-content">
        <p style="color: white;">Chào @if($order->user_name) {{ $order->ship_user_name }} @endif,,</p>
        <p style="color: white;">Đơn hàng <b>{{ $order->code }}</b> có thể bị hủy nếu bạn không hoàn tất thanh toán!
        <p style="color: white;">Chúng tôi rất tiếc thông báo rằng quá trình thanh toán của bạn đã không thành công. Vui lòng kiểm tra thông tin thanh toán hoặc thử lại sau.</p>
        <p style="color: white;">Nếu cần hỗ trợ, hãy liên hệ với chúng tôi qua email: <a href="http://127.0.0.1:8000/contact">support@.com</a>.</p>
        <a style="color: white; margin-top: 30px;" href="http://127.0.0.1:8000/about" class="retry-btn">Thông tin thêm</a>
    </div>
    <div class="email1-footer">
        <p style="color: white;">Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
        <p style="color: white;">&copy; 2024 Công ty ABC</p>
    </div>
</div>
</body>
</html><?php
