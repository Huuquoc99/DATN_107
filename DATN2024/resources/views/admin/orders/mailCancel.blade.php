<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Cancellation Notice</title>
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

        .footer {
            font-size: 14px;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2 style="padding-left: 20px">Order Cancellation Notice</h2>
    </div>

    <div class="content">
        <p>Hello <strong>{{ $order->user->name }}</strong>,</p>
        <p>We regret to inform you that your order with code <strong>{{ $order->code }}</strong> has been cancelled at the request of the administrator.</p>

        <div class="order-details">
            <p><strong>Order details:</strong></p>
            <p>Order code: <strong>{{ $order->code }}</strong></p>
            <p>Status: <strong>{{ $order->statusOrder->name }}</strong></p>
        </div>

        <p>We apologize for any inconvenience. If you have any questions or need further assistance, please contact us via email or phone number below.</p>

        <p>Thank you very much for using our service!</p>
    </div>

    <div class="footer">
        <p><a href="mailto:techstore@gmail.com">Support Email</a> | <a href="tel:0987654321">Contact by phone</a></p>
        <p>Best regards, TechStore</p>
    </div>
</div>

</body>
</html>
