<h1>Xác nhận đơn hàng của bạn</h1>
<p>Mã đơn hàng: {{ $order_code }}</p>

<h3>Thông tin khách hàng:</h3>
<p>Tên: {{ $customer_name }}</p>
<p>Email: {{ $customer_email }}</p>
<p>Điện thoại: {{ $customer_phone }}</p>
<p>Địa chỉ: {{ $customer_address }}</p>

<h3>Thông tin giao hàng:</h3>
<p>Tên: {{ $shipping_name }}</p>
<p>Email: {{ $shipping_email }}</p>
<p>Điện thoại: {{ $shipping_phone }}</p>
<p>Địa chỉ: {{ $shipping_address }}</p>

<p>Phương thức thanh toán: {{ $payment_method_id == 1 ? 'Thanh toán khi nhận hàng' : 'VNPay' }}</p>
<p>Tổng tiền: {{ number_format($total_price, 0, ',', '.') }} VND</p>

<h3>Chi tiết sản phẩm:</h3>
<ul>
    @foreach ($items as $item)
        <li>
            Tên sản phẩm: {{ $item->product_name }} <br>
            SKU: {{ $item->product_sku }} <br>
            Giá: {{ number_format($item->product_price_sale ?? $item->product_price_regular, 0, ',', '.') }} VND <br>
            Số lượng: {{ $item->quantity }}
        </li>
    @endforeach
</ul>
