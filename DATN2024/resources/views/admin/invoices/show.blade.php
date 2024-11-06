@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    @if(!$order)
        <div class="alert alert-danger">
            Hóa đơn không tồn tại hoặc không khả dụng.
        </div>
    @else
        <div class="card shadow-sm border-light mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Chi tiết hóa đơn cho đơn hàng #{{ $order->code }}</h5>
            </div>
            <div class="card-body">
                <h6 class="card-title">Thông tin khách hàng</h6>
                <p class="card-text">Tên: <strong>{{ $order->user_name }}</strong></p>
                <p class="card-text">Ngày tạo: <strong>{{ $order->created_at->format('d/m/Y H:i') }}</strong></p>
                <p class="card-text">Tổng giá: <strong class="text-danger">{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</strong></p>
            </div>
        </div>

        <h3 class="mt-4">Danh sách sản phẩm</h3>
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary">Quay lại danh sách hóa đơn</a>
            <button class="btn btn-success">Tải hóa đơn PDF</button>
        </div>
    @endif
</div>

<style>
    .card {
        border-radius: 10px;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }
    .btn {
        border-radius: 5px;
    }
</style>
@endsection




