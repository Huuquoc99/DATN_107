<table>
    <thead>
    <tr>
        <th>Tên Sản Phẩm</th>
        <th>Số Lượng Bán</th>
        <th>Tổng Doanh Thu</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($salesData as $data)
        <tr>
            <td>{{ $data->product_name }}</td>
            <td>{{ $data->total_quantity }}</td>
            <td>{{ number_format($data->total_sales, 2) }} VND</td>
        </tr>
    @endforeach
    </tbody>
</table>
