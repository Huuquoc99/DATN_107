
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mail.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        /* General styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f4f6;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            max-height: 1200px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px;
            transition: all 0.3s ease-in-out;
            
        
            background-image: url('https://www.bing.com/th/id/OGC.0dcee7f6333565ad73e68c69df4bddf6?pid=1.7&rurl=https%3a%2f%2fkhoinguonsangtao.vn%2fwp-content%2fuploads%2f2022%2f08%2fanh-dong-3d.gif&ehk=Ma5H3gplCsdEaq%2fd%2fwSbqdgcT80xnTAyuyoP7YHcsIk%3d');
            
            background-size: cover;
            background-position: center center; 
            /* background-attachment: fixed; */
        }

        .email-container:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.15);
        }

        .header {
            text-align: center;
            background: linear-gradient(90deg, #4bb6b7, #3a9e9f);
            color: white;
            padding: 30px 20px;
            border-radius: 16px 16px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            letter-spacing: 1.2px;
            font-weight: bold;
        }

        .section {
            margin: 30px 0;
        }

        .section h2 {
            font-size: 22px;
            color: #4bb6b7;
            margin-bottom: 15px;
            border-left: 5px solid #4bb6b7;
            padding-left: 10px;
            font-weight: bold;
        }

        .section p {
            margin: 6px 0;
            line-height: 1.8;
            color: #555;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }

        .details-table th,
        .details-table td {
            border: 1px solid #e0e0e0;
            padding: 12px;
            text-align: left;
            font-size: 14px;
            color: #333;
        }

        .details-table th {
            background: #f1f8f8;
            color: #4bb6b7;
            font-weight: bold;
        }

        .details-table tbody tr:nth-child(odd) {
            background: #fcfcfc;
        }

        .details-table tbody tr:hover {
            background: #f0fcfc;
            transition: background 0.3s ease-in-out;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
            color: #333;
            margin-top: 10px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
        }

        .footer a {
            color: #4bb6b7;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #3a9e9f;
            text-decoration: underline;
        }

        /* Button styles (if needed) */
        .button {
            display: inline-block;
            padding: 12px 24px;
            background: #4bb6b7;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
            margin-top: 15px;
            transition: background 0.3s ease-in-out;
            text-align: center;
        }

        .button:hover {
            background: #3a9e9f;
            cursor: pointer;
        }

        /* Additional Hover Effects for Containers */
        .email-container:hover .header {
            background: linear-gradient(90deg, #3a9e9f, #4bb6b7);
        }

        .section:hover h2 {
            color: #3a9e9f;
            border-left-color: #3a9e9f;
            transition: color 0.3s, border-color 0.3s;
        }

        /* General layout for address section */
        .address-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 15px;
        }

        .address {
            flex: 1; /* Equal width for both sections */
            background: #f9fafa;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }

        .address:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .address h3 {
            margin-bottom: 10px;
            font-size: 16px;
            color: #4bb6b7;
            border-left: 5px solid #4bb6b7;
            padding-left: 10px;
            font-weight: bold;
        }

        .address p {
            margin: 6px 0;
            color: #555;
            line-height: 1.6;
        }

    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>Thank you for ordering at TechStore!</h1>
        </div>

        <!-- Order Information -->
        <div class="section">
            <h2>Order information</h2>
            <p style="color: white;"><strong>Order code:</strong> ORDER-67457F27E2251</p>
            <p style="color: white;"><strong>Order date:</strong> 26 Nov, 2024 07:56AM</p>
            <p style="color: white;"><strong>Payment Status:</strong> Đang chờ xử lý</p>
            <p style="color: white;"><strong>Total:</strong> 269.000 VND</p>
        </div>

        <!-- Delivery Information -->
        <div class="section">
            <h2>Delivery information</h2>
            <div class="address-container">
                <!-- Billing Address -->
                <div class="address">
                    <h3>Billing address:</h3>
                    <p>Dương Hữu Quốc</p>
                    <p>P. Trịnh Văn Bô</p>
                    <p>duonghuuquoc99@gmail.com</p>
                    <p>3453452345</p>
                </div>
                
                <!-- Shipping Address -->
                <div class="address">
                    <h3>Shipping address:</h3>
                    <p>Dương Hữu Quốc</p>
                    <p>P. Trịnh Văn Bô</p>
                    <p>duonghuuquoc99@gmail.com</p>
                    <p>3453452345</p>
                </div>
            </div>
        </div>
        <!-- Order Details -->
        <div class="section">
            <h2>Order details</h2>
            <table class="details-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>132</td>
                        <td>20GB - 23</td>
                        <td>12 VND</td>
                        <td>36.000 VND</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Payment Information -->
        <div class="section">
            <h2  style="color: white;">Payment information</h2>
            <p  style="color: white;"><strong>Payment method:</strong> Tiền mặt :</p>
            <p  style="color: white;">234234234234324</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Cảm ơn bạn đã mua sắm tại TechStore!</p>
            <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua email: <a href="mailto:techstore@gmail.com">techstore@gmail.com</a></p>
        </div>
    </div>
</body>
</html>