<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Thất Bại</title>
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

        .email-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            padding: 30px;
            text-align: center;
            background-color: #f8f8f8;
        }

        .email-header h1 {
            color: #e74c3c;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .email-content p {
            color: #333;
            margin: 15px 0;
            line-height: 1.6;
        }

        .email-content a {
            color: #3498db;
            text-decoration: none;
        }

        .retry-btn {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .retry-btn:hover {
            background-color: #c0392b;
        }

        .email-footer {
            margin-top: 30px;
            color: #aaa;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .email-container {
                padding: 20px;
            }

            .email-header h1 {
                font-size: 20px;
            }

            .retry-btn {
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h1>Thanh Toán Thất Bại</h1>
    </div>
    <div class="email-content">
        <p>Chào @if($order->user_name) {{ $order->ship_user_name }} @endif,</p>
        <p>Đơn hàng <strong>{{ $order->code }}</strong> có thể bị hủy nếu bạn không hoàn tất thanh toán!</p>
        <p>Chúng tôi rất tiếc thông báo rằng quá trình thanh toán của bạn đã không thành công. Vui lòng kiểm tra thông tin thanh toán hoặc thử lại sau.</p>
        <p>Nếu cần hỗ trợ, hãy liên hệ với chúng tôi qua email: <a href="mailto:support@company.com">support@company.com</a>.</p>
        <a href="http://127.0.0.1:8000/about" class="retry-btn">Thông tin thêm</a>
    </div>
    <div class="email-footer">
        <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
        <p>&copy; 2024 Công ty ABC</p>
    </div>
</div>
</body>
</html>
