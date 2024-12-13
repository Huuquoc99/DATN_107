@extends('admin.layouts.master')
@section('title', 'Voucher ')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Voucher </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                        <li class="breadcrumb-item active">List  </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Voucher Giảm Giá Theo Tiền Mặt</h5>
                    <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary mb-3">
                        Thêm mới <i class="fa-regular fa-plus"></i>
                    </a>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive table-data">
                        @if (session("success"))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session("success") }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center" style="width:100%">
                            <thead>
                                <tr >
                                    <th>Code</th>
                                    <th>Tên</th>
                                    <th>Giảm giá</th>
                                    <th>Hoạt động</th>
                                    <th>Số lượng đã sử dụng/Số lượng</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày hết hạn</th>
                                    <th>Giá trị tối thiểu</th>
                                    <th>Ngày tạo</th>
                                    <th>Sản phẩm</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="product-list">
                                @foreach($listVoucher as $key => $item)
                                    @if($item->discount_type == 'amount')
                                        <tr>
                                            <td>{{ $item->code }}</td>
                                            <td>
                                                <a href="{{ route('admin.vouchers.edit', $item) }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{ $item->name }}">
                                                    {{ \Illuminate\Support\Str::limit($item->name, 15, '...') }}
                                                </a>
                                            </td>
                                            <td>{{ number_format($item->discount) }} VND</td>
                                            <td>{!! $item->is_active ? '<span class="badge bg-primary">Active</span>' : '<span class="badge bg-danger">No active</span>' !!}</td>
                                            <td>{{ $item->used_quantity }} / {{ $item->quantity }}</td>
                                            <td>
                                                @if ($item->start_date)
                                                    <span id="invoice-date">
                                                        {{ \Carbon\Carbon::parse($item->start_date)->format('d M, Y') }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            
                                                                                 
                                            <td>
                                                @if ($item->expiration_date)
                                                    <span id="invoice-date">
                                                        {{ \Carbon\Carbon::parse($item->expiration_date)->format('d M, Y') }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>{{ number_format($item->min_order_value) }} VND</td>
                                            <td>
                                                @if ($item->created_at)
                                                    <span id="invoice-date">{{ $item->created_at->format('d M, Y') }}</span>
                                                    <small class="text-muted" id="invoice-time">{{ $item->created_at->format('h:iA') }}</small>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->products->count())
                                                <ul class="color-list">
                                                    @foreach($item->products as $product)
                                                        <li>- {{ $product->name }}</li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.vouchers.edit', $item) }}">
                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Chỉnh sửa
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item remove-list" href="#" data-id="{{ $item->id }}" data-voucher-name="{{ $item->name }}" data-bs-toggle="modal" data-bs-target="#removeVoucherModal">
                                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Xoá
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            
                                                <div id="removeVoucherModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mt-2 text-center">
                                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                                                    <div class="mt-4 pt-2 fs-15 mx-sm-5">
                                                                        <h4>Bạn có chắc chắn?</h4>
                                                                        <p class="text-muted mx-4 mb-0">Bạn có chắc chắn muốn xoá <strong id="voucher-name"></strong> không?</p>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Đóng</button>
                                                                    <form id="delete-form" action="{{ route('admin.vouchers.destroy', $item) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn w-sm btn-danger">Vâng, xoá nó!</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Voucher Giảm Giá Theo Phần Trăm</h5>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive table-data">
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Tên</th>
                                    <th>Giảm giá</th>
                                    <th>Hoạt động</th>
                                    <th>Số lượng đã sử dụng/Số lượng</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày hết hạn</th>
                                    <th>Giá trị tối thiểu</th>
                                    <th>Ngày tạo</th>
                                    <th>Sản phẩm</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="product-list">
                                @foreach($listVoucher as $key => $item)
                                    @if($item->discount_type == 'percent')
                                        <tr>
                                            <td>{{ $item->code }}</td>
                                            <td>
                                                <a href="{{ route('admin.vouchers.edit', $item) }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{ $item->name }}">
                                                    {{ \Illuminate\Support\Str::limit($item->name, 15, '...') }}
                                                </a>
                                            </td>
                                            <td>{{ $item->discount }}%</td>
                                            <td>{!! $item->is_active ? '<span class="badge bg-primary">Active</span>' : '<span class="badge bg-danger">No active</span>' !!}</td>
                                            <td>{{ $item->used_quantity }} / {{ $item->quantity }}</td>
                                            <td>
                                                @if ($item->start_date)
                                                    <span id="invoice-date">
                                                        {{ \Carbon\Carbon::parse($item->start_date)->format('d M, Y') }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            
                                                                                 
                                            <td>
                                                @if ($item->expiration_date)
                                                    <span id="invoice-date">
                                                        {{ \Carbon\Carbon::parse($item->expiration_date)->format('d M, Y') }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>{{ number_format($item->min_order_value) }} VND</td>
                                            <td>
                                                @if ($item->created_at)
                                                    <span id="invoice-date">{{ $item->created_at->format('d M, Y') }}</span>
                                                    <small class="text-muted" id="invoice-time">{{ $item->created_at->format('h:iA') }}</small>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->products->count())
                                                <ul class="color-list">
                                                    @foreach($item->products as $product)
                                                        <li>- {{ $product->name }}</li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </td>
                                            
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.vouchers.edit', $item) }}">
                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Chỉnh sửa
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item remove-list" href="#" data-id="{{ $item->id }}" data-voucher-name="{{ $item->name }}" data-bs-toggle="modal" data-bs-target="#removeVoucherModal">
                                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Xoá
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            
                                                <div id="removeVoucherModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mt-2 text-center">
                                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                                                    <div class="mt-4 pt-2 fs-15 mx-sm-5">
                                                                        <h4>Bạn có chắc chắn?</h4>
                                                                        <p class="text-muted mx-4 mb-0">Bạn có chắc chắn muốn xoá <strong id="voucher-name"></strong> không?</p>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Đóng</button>
                                                                    <form id="delete-form" action="{{ route('admin.vouchers.destroy', $item) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn w-sm btn-danger">Vâng, xoá nó!</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Voucher Giảm Giá Theo Phần Trăm Max</h5>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive table-data">
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Tên</th>
                                    <th>Giảm giá</th>
                                    <th>Hoạt động</th>
                                    <th>Số lượng đã sử dụng/Số lượng</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày hết hạn</th>
                                    <th>Giá trị tối thiểu</th>
                                    <th>Giá trị tối đa</th>
                                    <th>Ngày tạo</th>
                                    <th>Sản phẩm</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="product-list">
                                @foreach($listVoucher as $key => $item)
                                    @if($item->discount_type == 'percent_max')
                                        <tr>
                                            <td>{{ $item->code }}</td>
                                            <td>
                                                <a href="{{ route('admin.vouchers.edit', $item) }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{ $item->name }}">
                                                    {{ \Illuminate\Support\Str::limit($item->name, 15, '...') }}
                                                </a>
                                            </td>
                                            <td>{{ $item->discount }}%</td>
                                            <td>{!! $item->is_active ? '<span class="badge bg-primary">Active</span>' : '<span class="badge bg-danger">No active</span>' !!}</td>
                                            <td>{{ $item->used_quantity }} / {{ $item->quantity }}</td>
                                            <td>
                                                @if ($item->start_date)
                                                    <span id="invoice-date">
                                                        {{ \Carbon\Carbon::parse($item->start_date)->format('d M, Y') }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            
                                                                                 
                                            <td>
                                                @if ($item->expiration_date)
                                                    <span id="invoice-date">
                                                        {{ \Carbon\Carbon::parse($item->expiration_date)->format('d M, Y') }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>{{ number_format($item->min_order_value) }} VND</td>
                                            <td>{{ number_format($item->max_discount) }} VND</td>
                                            <td>
                                                @if ($item->created_at)
                                                    <span id="invoice-date">{{ $item->created_at->format('d M, Y') }}</span>
                                                    <small class="text-muted" id="invoice-time">{{ $item->created_at->format('h:iA') }}</small>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->products->count())
                                                <ul class="color-list">
                                                    @foreach($item->products as $product)
                                                        <li>- {{ $product->name }}</li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </td>
                                            
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.vouchers.edit', $item) }}">
                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Chỉnh sửa
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item remove-list" href="#" data-id="{{ $item->id }}" data-voucher-name="{{ $item->name }}" data-bs-toggle="modal" data-bs-target="#removeVoucherModal">
                                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Xoá
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            
                                                <div id="removeVoucherModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mt-2 text-center">
                                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                                                    <div class="mt-4 pt-2 fs-15 mx-sm-5">
                                                                        <h4>Bạn có chắc chắn?</h4>
                                                                        <p class="text-muted mx-4 mb-0">Bạn có chắc chắn muốn xoá <strong id="voucher-name"></strong> không?</p>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Đóng</button>
                                                                    <form id="delete-form" action="{{ route('admin.vouchers.destroy', $item) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn w-sm btn-danger">Vâng, xoá nó!</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .color-list {
            list-style-type: none; 
            padding: 0;            
            margin: 0;             
            text-align: left;     
        }

        .color-list li {
            margin-bottom: 15px;    
        }

        .table-responsive {
            max-height: 400px; 
            overflow-y: auto; 
        }
    </style>
@endsection
@section('style-libs')
@endsection
