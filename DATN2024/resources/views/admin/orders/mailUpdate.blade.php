<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Update Notification</title>
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
        <h2 style="padding-left: 20px">Order Status Update Notification</h2>
    </div>

    <div class="content">
        <p>
            Hello
            <strong>
                {{ $order->user ? $order->user->name : $order->ship_user_name }}
            </strong>,
        </p>
        <p>
            We would like to inform you that your order with code
            <strong>{{ $order->code }}</strong>
            has been updated by admin to status:
            <strong>{{ $order->statusOrder->name }}</strong>
        </p>

        <div class="order-details">
            <p><strong>Order details:</strong></p>
            <p>Order code: <strong>{{ $order->code }}</strong></p>
            <p>Status: <strong>{{ $order->statusOrder->name }}</strong></p>
        </div>

        <p>
            @if ($order->user)
                If you have any questions or need further assistance, please contact us via email or phone number below.
            @else
                As you placed this order as a guest, if you have any questions or need support, please provide your order code when contacting us.
            @endif
        </p>

        <p>Thank you very much for using our service!</p>
    </div>

    <div class="footer">
        <p><a href="mailto:techstore@gmail.com">Support Email</a> | <a href="tel:0987654321">Contact by phone</a></p>
        <p>Best regards, TechStore</p>
    </div>
</div>


</body>
</html>
