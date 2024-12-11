{{-- @extends('admin.layouts.master')
@section('title', 'Voucher ')
@section('content')
    <!-- start page title -->
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
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Danh sách </h5>
                    <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary mb-3">
                        Thêm mới <i class="fa-regular fa-plus"></i>
                    </a>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive table-data ">
                        @if (session("success"))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session("success")}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Tên</th>
                                <th>Giảm giá</th>
                                <th>Hoạt động</th>
                                <th>Số lượng đã sử dụng/Số lượng</th>
                        
                                <th>Ngày hết hạn</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="product-list">
                                @foreach($listVoucher as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>
                                            <a href="{{ route('admin.vouchers.edit', $item) }}">
                                                {{ $item->name }}
                                            </a>
                                        </td>
                                        <td>{{ number_format($item->discount) }}</td>
                                        <td>{!! $item->is_active ? '<span class="badge bg-primary">Active</span>' : '<span class="badge bg-danger">No active</span>' !!}</td>
                                        <td>{{ $item->used_quantity }} / {{ $item->quantity }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->expiration_date)->format('Y-m-d') }}</td>
                                        <td>
                                            @if($item->created_at)
                                                <span id="invoice-date">{{ $item->created_at->format('d M, Y') }}</span>
                                                <small class="text-muted" id="invoice-time">{{ $item->created_at->format('h:iA') }}</small>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if($item->updated_at)
                                                <span id="invoice-date">{{ $item->updated_at->format('d M, Y') }}</span>
                                                <small class="text-muted" id="invoice-time">{{ $item->updated_at->format('h:iA') }}</small>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                               
                                                <a href="{{ route('admin.vouchers.edit', $item) }}" class="btn btn-primary btn-sm">Chỉnh sửa 
                                                    <i class="fa-regular fa-pen-to-square fa-sm"></i>
                                                </a>
                                                <form action="{{ route('admin.vouchers.destroy', $item) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Bạn có chắn chắn muốn xoá không?')" type="submit" class="btn btn-danger btn-sm">Xoá 
                                                        <i class="fa-solid fa-delete-left fa-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('style-libs')
@endsection --}}


@extends('admin.layouts.master')
@section('title', 'Voucher ')
@section('content')
    <!-- start page title -->
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
    <!-- end page title -->

    <!-- Voucher theo tiền mặt -->
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
                                    {{-- <th>Ngày cập nhật</th> --}}
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="product-list">
                                @foreach($listVoucher as $key => $item)
                                    @if($item->discount_type == 'amount')
                                        <tr>
                                            <td>{{ $item->code }}</td>
                                            <td><a href="{{ route('admin.vouchers.edit', $item) }}">{{ $item->name }}</a></td>
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
                                            {{-- <td>{{ $item->created_at ? $item->created_at->format('d M, Y h:iA') : 'N/A' }}</td> --}}
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
                                            {{-- <td>{{ $item->updated_at ? $item->updated_at->format('d M, Y h:iA') : 'N/A' }}</td> --}}
                                            <td>
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <a href="{{ route('admin.vouchers.edit', $item) }}" class="btn btn-primary btn-sm">Chỉnh sửa 
                                                        <i class="fa-regular fa-pen-to-square fa-sm"></i>
                                                    </a>
                                                    <form action="{{ route('admin.vouchers.destroy', $item) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Bạn có chắn chắn muốn xoá không?')" type="submit" class="btn btn-danger btn-sm">Xoá 
                                                            <i class="fa-solid fa-delete-left fa-sm"></i>
                                                        </button>
                                                    </form>
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

    <!-- Voucher theo phần trăm -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Voucher Giảm Giá Theo Phần Trăm</h5>
                    {{-- <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary mb-3">
                        Thêm mới <i class="fa-regular fa-plus"></i>
                    </a> --}}
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
                                    {{-- <th>Ngày cập nhật</th> --}}
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="product-list">
                                @foreach($listVoucher as $key => $item)
                                    @if($item->discount_type == 'percent')
                                        <tr>
                                            <td>{{ $item->code }}</td>
                                            <td><a href="{{ route('admin.vouchers.edit', $item) }}">{{ $item->name }}</a></td>
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
                                            {{-- <td>{{ $item->updated_at ? $item->updated_at->format('d M, Y h:iA') : 'N/A' }}</td> --}}
                                            
                                            <td>
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <a href="{{ route('admin.vouchers.edit', $item) }}" class="btn btn-primary btn-sm">Chỉnh sửa 
                                                        <i class="fa-regular fa-pen-to-square fa-sm"></i>
                                                    </a>
                                                    <form action="{{ route('admin.vouchers.destroy', $item) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Bạn có chắn chắn muốn xoá không?')" type="submit" class="btn btn-danger btn-sm">Xoá 
                                                            <i class="fa-solid fa-delete-left fa-sm"></i>
                                                        </button>
                                                    </form>
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
            list-style-type: none; /* Xóa ký hiệu mặc định của danh sách */
            padding: 0;            /* Xóa khoảng cách padding mặc định */
            margin: 0;             /* Xóa khoảng cách margin mặc định */
            text-align: left;      /* Căn trái các mục */
        }

        .color-list li {
            margin-bottom: 15px;    /* Khoảng cách giữa các mục */
        }

    </style>
    <!-- end row -->
@endsection
@section('style-libs')
@endsection
