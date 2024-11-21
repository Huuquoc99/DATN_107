<table>
    <thead>
    <tr>
        <th>Product</th>
        <th>Sales Quantity</th>
        <th>Total Revenue</th>
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
