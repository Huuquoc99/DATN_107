@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>Danh sách hóa đơn</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID Đơn hàng</th>
                <th>Tên người dùng</th>
                <th>Tổng giá</th>
                <th>Ngày tạo</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->order_id }}</td>
                <td>{{ $invoice->user_name }}</td>
                <td>{{ $invoice->total_price }}</td>
                <td>{{ $invoice->created_at }}</td>
                <td><a href="{{ route('admin.invoices.show', $invoice->order_id) }}">Xem chi tiết</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
