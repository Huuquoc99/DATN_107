<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #495057;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-header img {
            height: 30px;
        }
        .email-body {
            text-align: center;
            font-size: 14px;
            line-height: 1.6;
        }
        .email-body h4 {
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 15px;
        }
        .verification-code {
            display: inline-block;
            background-color: #405189;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            margin: 20px 0;
        }
        .email-footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #98a6ad;
        }
        .email-footer a {
            color: #495057;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="email-wrapper">
    <!-- Body -->
    <div class="email-body">
        <h4>Vui lòng xác minh email của bạn!</h4>
        <p>Chúng tôi đã gửi cho bạn mã xác minh để xác nhận địa chỉ email của bạn. Vui lòng sử dụng mã bên dưới để xác minh:</p>
        <h4>Mã xác thực của bạn là: </h6>
        <div class="verification-code">{{ $code }}</div>
        <p>Ngoài ra, bạn có thể tryt cập trang web của chúng tôi tại đây!</p>
        <a href="http://127.0.0.1:8000/" target="_blank">Tại đây!</a>
    </div>

    <!-- Footer -->
    <div class="email-footer">
        <p>Nếu bạn có bất kỳ câu hỏi hoặc cần trợ giúp, vui lòng liên hệ với chúng tôi tại <a href="phdinh1403@gmail.com">Mail đến chúng tôi!</a>.</p>
        <p>Design & Develop by Techstore</p>
    </div>
</div>
</body>
</html>
