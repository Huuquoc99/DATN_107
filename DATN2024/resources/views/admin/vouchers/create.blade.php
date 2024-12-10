@extends('admin.layouts.master')
@section('title')
    Voucher
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Voucher </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng </a></li>
                        <li class="breadcrumb-item active"> Thêm mới</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.vouchers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thêm mới</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="mt-3">
                                        <label for="name" class="form-label">Tên</label>
                                        <input type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="quantity" class="form-label">Số lượng</label>
                                        <input type="number"
                                            class="form-control @error('quantity') is-invalid @enderror"
                                            name="quantity" id="quantity">
                                        @error('quantity')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="date-datepicker" class="form-label">Ngày bắt đầu</label>
                                        <input type="date" id="date-datepicker"
                                            class="form-control @error('start_date') is-invalid @enderror"
                                            name="start_date" placeholder="Select date">
                                        @error('start_date')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="date-datepicker" class="form-label">Ngày hết hạn</label>
                                        <input type="date" id="date-datepicker"
                                            class="form-control @error('expiration_date') is-invalid @enderror"
                                            name="expiration_date" placeholder="Select date">
                                        @error('expiration_date')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        @php
                                            $is = [
                                                'is_active' => ['name' => 'Hoạt động', 'color' => 'primary'],
                                            ];
                                        @endphp
                                        @foreach ($is as $key => $value)
                                            <div class="col-md-4 mb-3">
                                                <div
                                                    class="form-check form-switch form-switch-{{ $value['color'] }} d-flex align-items-center">
                                                    <input class="form-check-input me-2" type="checkbox" role="switch"
                                                        name="is_active" value="1" id="{{ $key }}"
                                                        @if ($key == 'is_active') checked @endif>
                                                    <label class="form-check-label"
                                                        for="{{ $key }}">{{ $value['name'] }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mt-3">
                                        <label for="code" class="form-label">Code</label>
                                        <input type="text"
                                            class="form-control @error('code') is-invalid @enderror"
                                            name="code" id="code" max="10"
                                            value="{{ strtoupper(\Str::random(8)) }}">
                                        @error('code')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group mt-3">
                                        <label for="discount_type">Loại giảm giá</label>
                                        <select name="discount_type" id="discount_type" class="form-control">
                                            <option value="amount" {{ old('discount_type', $voucher->discount_type ?? '') == 'amount' ? 'selected' : '' }}>Theo số tiền</option>
                                            <option value="percent" {{ old('discount_type', $voucher->discount_type ?? '') == 'percent' ? 'selected' : '' }}>Theo tỷ lệ phần trăm</option>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label for="discount" class="form-label">Giảm giá</label>
                                        <input type="number"
                                            class="form-control @error('discount') is-invalid @enderror"
                                            name="discount" id="discount">
                                        @error('discount')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group mt-3">
                                        <label for="discount_type">Loại giảm giá</label>
                                        <select name="discount_type" id="discount_type" class="form-control">
                                            <option value="amount" {{ old('discount_type', $voucher->discount_type ?? '') == 'amount' ? 'selected' : '' }}>Theo số tiền</option>
                                            <option value="percent" {{ old('discount_type', $voucher->discount_type ?? '') == 'percent' ? 'selected' : '' }}>Theo tỷ lệ phần trăm</option>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label for="discount" class="form-label">Giảm giá</label>
                                        <input type="number"
                                            class="form-control @error('discount') is-invalid @enderror"
                                            name="discount" id="discount" value="{{ old('discount', $voucher->discount ?? '') }}">
                                        @error('discount')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mt-3">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                            rows="2"></textarea>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="min_order_value" class="form-label">Giá trị đơn hàng tối thiểu</label>
                                        <input type="number" name="min_order_value" class="form-control @error('min_order_value') is-invalid @enderror" value="{{ old('min_order_value') }}">
                                        @error('min_order_value')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <button class="btn btn-primary">Thêm mới <i class="fa-regular fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#date-datepicker", {
            altInput: true,
            altFormat: "d M Y",
            dateFormat: "Y-m-d",
        });
    </script>
@endsection
