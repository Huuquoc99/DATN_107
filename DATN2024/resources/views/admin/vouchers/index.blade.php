@extends('admin.layouts.master')
@section('title', 'TechStore')
@section('content')
  <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Voucher</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                    <li class="breadcrumb-item active">Danh sách</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-xxl-4 col-sm-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Voucher Giảm Giá Theo Tiền Mặt</p>
                        <h4 class="mt-4 ff-secondary fw-semibold">Voucher Giảm Giá Theo Tiền Mặt</h4>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-4">
                                <i class="ri-ticket-2-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-3 toggle-details" data-target="#voucherDetails">
                    Xem chi tiết
                </button>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Voucher Giảm Giá Theo Phần Trăm</p>
                        <h4 class="mt-4 ff-secondary fw-semibold">Voucher Giảm Giá Theo Phần Trăm</h4>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-warning-subtle text-warning rounded-circle fs-4">
                                <i class="mdi mdi-timer-sand"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-3 toggle-details" data-target="#voucherDetails1">
                    Xem chi tiết
                </button>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0 ">Voucher Giảm Giá Theo Phần Trăm Max</p>
                        <h4 class="mt-4 ff-secondary fw-semibold">Voucher Giảm Giá Theo Phần Trăm Max</h4>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-success-subtle text-success rounded-circle fs-4">
                                <i class="ri-shopping-bag-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-3 toggle-details" data-target="#voucherDetails2">
                    Xem chi tiết
                </button>
            </div>
        </div>
    </div>

</div>
    <div id="voucherDetails" class="row" style="display: none;">
        <div class="col-lg-12">
            <div class="card" id="ticketsList">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Voucher Giảm Giá Theo Tiền Mặt</h5>
                        <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary mb-3">
                            Thêm mới <i class="fa-regular fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-5 col-sm-12">
                                <div class="search-box">
                                    <input type="text" class="form-control search bg-light border-light" placeholder="Search for ticket details or something...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
            
                        </div>
                    
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card mb-4">
                        <table class="table align-middle table-nowrap mb-0 text-center" id="ticketTable">
                            <thead>
                                <tr >
                                    <th data-sort="id">Code</th>
                                    <th data-sort="tasks_name">Tên</th>
                                    <th data-sort="client_name">Giảm giá</th>
                                    <th data-sort="status">Hoạt động</th>
                                    <th data-sort="create_date">Số lượng đã sử dụng/Số lượng</th>
                                    <th data-sort="due_date">Ngày bắt đầu</th>
                                    <th data-sort="due_date">Ngày hết hạn</th>
                                    <th data-sort="priority">Giá trị tối thiểu</th>
                                    <th data-sort="due_date">Ngày tạo</th>
                                    <th data-sort="due_date">Sản phẩm</th>
                                    <th data-sort="due_date">Hành động</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="ticket-list-data">
                                @foreach($listVoucher as $key => $item)
                                        @if($item->discount_type == 'amount')
                                            <tr>
                                                <td class="id">{{ $item->code }}</td>
                                                <td class="tasks_name">
                                                    <a href="{{ route('admin.vouchers.edit', $item) }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{ $item->name }}">
                                                        {{ \Illuminate\Support\Str::limit($item->name, 15, '...') }}
                                                    </a>
                                                </td>
                                                <td class="client_name"> {{ number_format($item->discount) }} VND</td>
                                                <td class="status">{!! $item->is_active ? '<span class="badge bg-primary">Active</span>' : '<span class="badge bg-danger">No active</span>' !!}</td>
                                                <td class="create_date">{{ $item->used_quantity }} / {{ $item->quantity }}</td>
                                                <td class="create_date">
                                                    @if ($item->start_date)
                                                        <span id="invoice-date">
                                                            {{ \Carbon\Carbon::parse($item->start_date)->format('d M, Y') }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                
                                                                                    
                                                <td class="create_date">
                                                    @if ($item->expiration_date)
                                                        <span id="invoice-date">
                                                            {{ \Carbon\Carbon::parse($item->expiration_date)->format('d M, Y') }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="status">{{ number_format($item->min_order_value) }} VND</td>
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
    <div id="voucherDetails1" class="row" style="display: none;">
        <div class="col-lg-12">
            <div class="card" id="ticketsList">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Voucher Giảm Giá Theo Phần Trăm</h5>
                        <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary mb-3">
                            Thêm mới <i class="fa-regular fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-5 col-sm-12">
                                <div class="search-box">
                                    <input type="text" class="form-control search bg-light border-light" placeholder="Search for ticket details or something...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
            
                        </div>
                    
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card mb-4">
                        <table class="table align-middle table-nowrap mb-0 text-center" id="ticketTable">
                            <thead>
                                <tr >
                                    <th data-sort="id">Code</th>
                                    <th data-sort="tasks_name">Tên</th>
                                    <th data-sort="client_name">Giảm giá</th>
                                    <th data-sort="status">Hoạt động</th>
                                    <th data-sort="create_date">Số lượng đã sử dụng/Số lượng</th>
                                    <th data-sort="due_date">Ngày bắt đầu</th>
                                    <th data-sort="due_date">Ngày hết hạn</th>
                                    <th data-sort="priority">Giá trị tối thiểu</th>
                                    <th data-sort="due_date">Ngày tạo</th>
                                    <th data-sort="due_date">Sản phẩm</th>
                                    <th data-sort="due_date">Hành động</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="ticket-list-data">
                                @foreach($listVoucher as $key => $item)
                                        @if($item->discount_type == 'percent')
                                            <tr>
                                                <td class="id">{{ $item->code }}</td>
                                                <td class="tasks_name">
                                                    <a href="{{ route('admin.vouchers.edit', $item) }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{ $item->name }}">
                                                        {{ \Illuminate\Support\Str::limit($item->name, 15, '...') }}
                                                    </a>
                                                </td>
                                                <td class="client_name"> {{ number_format($item->discount) }} VND</td>
                                                <td class="status">{!! $item->is_active ? '<span class="badge bg-primary">Active</span>' : '<span class="badge bg-danger">No active</span>' !!}</td>
                                                <td class="create_date">{{ $item->used_quantity }} / {{ $item->quantity }}</td>
                                                <td class="create_date">
                                                    @if ($item->start_date)
                                                        <span id="invoice-date">
                                                            {{ \Carbon\Carbon::parse($item->start_date)->format('d M, Y') }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                
                                                                                    
                                                <td class="create_date">
                                                    @if ($item->expiration_date)
                                                        <span id="invoice-date">
                                                            {{ \Carbon\Carbon::parse($item->expiration_date)->format('d M, Y') }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="status">{{ number_format($item->min_order_value) }} VND</td>
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
    <div id="voucherDetails2" class="row" style="display: none;">
        <div class="col-lg-12">
            <div class="card" id="ticketsList">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Voucher Giảm Giá Theo Phần Trăm Max</h5>
                        <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary mb-3">
                            Thêm mới <i class="fa-regular fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-5 col-sm-12">
                                <div class="search-box">
                                    <input type="text" class="form-control search bg-light border-light" placeholder="Search for ticket details or something...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
            
                        </div>
                    
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card mb-4">
                        <table class="table align-middle table-nowrap mb-0 text-center" id="ticketTable">
                            <thead>
                                <tr >
                                    <th data-sort="id">Code</th>
                                    <th data-sort="tasks_name">Tên</th>
                                    <th data-sort="client_name">Giảm giá</th>
                                    <th data-sort="status">Hoạt động</th>
                                    <th data-sort="create_date">Số lượng đã sử dụng/Số lượng</th>
                                    <th data-sort="due_date">Ngày bắt đầu</th>
                                    <th data-sort="due_date">Ngày hết hạn</th>
                                    <th data-sort="priority">Giá trị tối thiểu</th>
                                    <th data-sort="priority">Giá trị tối đa</th>
                                    <th data-sort="due_date">Ngày tạo</th>
                                    <th data-sort="due_date">Sản phẩm</th>
                                    <th data-sort="due_date">Hành động</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="ticket-list-data">
                                @foreach($listVoucher as $key => $item)
                                        @if($item->discount_type == 'percent_max')
                                            <tr>
                                                <td class="id">{{ $item->code }}</td>
                                                <td class="tasks_name">
                                                    <a href="{{ route('admin.vouchers.edit', $item) }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{ $item->name }}">
                                                        {{ \Illuminate\Support\Str::limit($item->name, 15, '...') }}
                                                    </a>
                                                </td>
                                                <td class="client_name"> {{ number_format($item->discount) }} VND</td>
                                                <td class="status">{!! $item->is_active ? '<span class="badge bg-primary">Active</span>' : '<span class="badge bg-danger">No active</span>' !!}</td>
                                                <td class="create_date">{{ $item->used_quantity }} / {{ $item->quantity }}</td>
                                                <td class="create_date">
                                                    @if ($item->start_date)
                                                        <span id="invoice-date">
                                                            {{ \Carbon\Carbon::parse($item->start_date)->format('d M, Y') }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                
                                                                                    
                                                <td class="create_date">
                                                    @if ($item->expiration_date)
                                                        <span id="invoice-date">
                                                            {{ \Carbon\Carbon::parse($item->expiration_date)->format('d M, Y') }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="status">{{ number_format($item->min_order_value) }} VND</td>
                                                <td class="status">{{ number_format($item->max_discount) }} VND</td>
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

    /* .table-responsive {
        max-height: 400px; 
        overflow-y: auto; 
    } */
</style>
@endsection
@section('style-libs')
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const defaultDetails = document.querySelector("#voucherDetails");
    if (defaultDetails) {
        defaultDetails.style.display = "block";
    }

    const toggleButtons = document.querySelectorAll(".toggle-details");

    toggleButtons.forEach((button) => {
        button.addEventListener("click", function () {
            document.querySelectorAll(".row[id^='voucherDetails']").forEach((details) => {
                details.style.display = "none";
            });

            const targetId = this.getAttribute("data-target");
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.style.display = "block";
            }
        });
    });
});

</script>
@endsection
