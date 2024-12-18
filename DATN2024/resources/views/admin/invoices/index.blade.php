{{-- @extends('admin.layouts.master')

@section("title", "TechStore")
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Hoá đơn</h4>

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
    <div class="col-lg-12">
        <div class="card" id="invoiceList">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Hoá đơn</h5>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-2 flex-wrap">
                            <button class="btn btn-primary" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body bg-light-subtle border border-dashed border-start-0 border-end-0">
                <form action="{{ route('admin.invoices.index') }}" method="GET" class="d-flex">
                    <div class="input-group" style="width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm hóa đơn..." value="{{ request('search') }}">
                        <span class="input-group-text"><i class="ri-search-line"></i></span>
                    </div>
                </form>
                
            </div>
            <div class="card-body">
                <div>
                    <div class="table-responsive table-card">
                        <table class="table align-middle table-nowrap text-center" id="invoiceTable">
                            <thead class="text-muted">
                                <tr>
                                    <th class="sort text-uppercase" data-sort="invoice_id">Code</th>
                                    <th class="sort text-uppercase" data-sort="customer_name">Khách hàng</th>
                                    <th class="sort text-uppercase" data-sort="country">Điện thoại</th>
                                    <th class="sort text-uppercase" data-sort="date">Ngày tạo</th>
                                    <th class="sort text-uppercase" data-sort="invoice_amount">Tổng đơn hàng</th>
                                    <th class="sort text-uppercase" data-sort="status">Trạng thái thanh toán</th>
                                    <th class="sort text-uppercase" data-sort="status">Trạng thái đơn hàng</th>
                                    <th class="sort text-uppercase" data-sort="action">Hành động</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="invoice-list-data">
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.invoices.show', $invoice) }}">{{ $invoice->code }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.customers.show', $invoice) }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{ $invoice->ship_user_name }}">
                                                {{ \Illuminate\Support\Str::limit($invoice->ship_user_name, 15, '...') }}</td>
                                            </a>
                                            

                                        <td>{{ $invoice->ship_user_phone }}</td>
                                        <td>
                                            <span id="invoice-date">{{ $invoice->created_at->format('d M, Y') }}</span> 
                                            <small class="text-muted" id="invoice-time">{{ $invoice->created_at->format('h:iA') }}</small>
                                        </td>
                                        <td>{{ number_format($invoice->total_price, 0, ',', '.') }} VND</td>
                                        <td>
                                            @switch($invoice->statusPayment->id)
                                                @case(1)
                                                    <span class="badge bg-primary">{{ $invoice->statusPayment->name }}</span>
                                                    @break
                                                @case(2)
                                                    <span class="badge bg-success">{{ $invoice->statusPayment->name }}</span>
                                                    @break
                                                @case(3)
                                                    <span class="badge bg-warning">{{ $invoice->statusPayment->name }}</span>
                                                    @break
                                                @case(4)
                                                    <span class="badge bg-danger">{{ $invoice->statusPayment->name }}</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-secondary">{{ $invoice->statusPayment->name }}</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            @switch($invoice->statusOrder->id)
                                                @case(1)
                                                    <span class="badge bg-warning">{{ $invoice->statusOrder->name }}</span>
                                                    @break
                                                @case(2)
                                                    <span class="badge bg-secondary">{{ $invoice->statusOrder->name }}</span>
                                                    @break
                                                @case(3)
                                                    <span class="badge bg-info">{{ $invoice->statusOrder->name }}</span>
                                                    @break
                                                @case(4)
                                                    <span class="badge bg-primary">{{ $invoice->statusOrder->name }}</span>
                                                    @break
                                                @case(5)
                                                    <span class="badge bg-success">{{ $invoice->statusOrder->name }}</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-danger">{{ $invoice->statusOrder->name }}</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2  justify-content-center">
                                                <a href="{{ route('admin.invoices.show', $invoice) }}" class="btn btn-info btn-sm">Chi tiết 
                                                    <i class="fa-solid fa-circle-info fa-sm"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  
                    <div class="d-flex justify-content-between mt-3">
                        <div>
                            <p>Hiển thị từ {{ $invoices->firstItem() }} đến {{ $invoices->lastItem() }} trong tổng số {{ $invoices->total() }} hoá đơn</p>
                        </div>
                        <div>
                            {{ $invoices->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</div>

@endsection --}}


@extends('admin.layouts.master')

@section("title", "TechStore")
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Hoá đơn</h4>

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
    <div class="col-lg-12">
        <div class="card" id="invoiceList">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Hoá đơn</h5>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-2 flex-wrap">
                            <button class="btn btn-primary" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body bg-light-subtle border border-dashed border-start-0 border-end-0">
                <form action="{{ route('admin.invoices.index') }}" method="GET" class="d-flex">
                    <div class="col-xxl-5 col-sm-6">
                        <div class="search-box">
                            <input type="text" class="form-control search" value="{{ request()->get('search') }}" id="search-input" name="search" placeholder="Tìm kiếm theo code, tên khách hàng...">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="card-body">
                @if($invoices->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Không có hoá đơn nào.
                    </div>
                @else
                    <div>
                        <div class="table-responsive table-card">
                            <table class="table align-middle table-nowrap text-center" id="invoiceTable">
                                <thead class="text-muted">
                                    <tr>
                                        <th class="sort text-uppercase" data-sort="invoice_id">Code</th>
                                        <th class="sort text-uppercase" data-sort="customer_name">Khách hàng</th>
                                        <th class="sort text-uppercase" data-sort="country">Điện thoại</th>
                                        <th class="sort text-uppercase" data-sort="date">Ngày tạo</th>
                                        <th class="sort text-uppercase" data-sort="invoice_amount">Tổng đơn hàng</th>
                                        <th class="sort text-uppercase" data-sort="status">Trạng thái thanh toán</th>
                                        <th class="sort text-uppercase" data-sort="status">Trạng thái đơn hàng</th>
                                        <th class="sort text-uppercase" data-sort="action">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all" id="invoice-list-data">
                                    @foreach($invoices as $invoice)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.invoices.show', $invoice) }}">{{ $invoice->code }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.customers.show', $invoice) }}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{ $invoice->ship_user_name }}">
                                                    {{ \Illuminate\Support\Str::limit($invoice->ship_user_name, 15, '...') }}
                                                </a>
                                            </td>
                                            <td>{{ $invoice->ship_user_phone }}</td>
                                            <td>
                                                <span id="invoice-date">{{ $invoice->created_at->format('d M, Y') }}</span> 
                                                <small class="text-muted" id="invoice-time">{{ $invoice->created_at->format('h:iA') }}</small>
                                            </td>
                                            <td>{{ number_format($invoice->total_price, 0, ',', '.') }} VND</td>
                                            <td>
                                                @switch($invoice->statusPayment->id)
                                                    @case(1)
                                                        <span class="badge bg-primary">{{ $invoice->statusPayment->name }}</span>
                                                        @break
                                                    @case(2)
                                                        <span class="badge bg-success">{{ $invoice->statusPayment->name }}</span>
                                                        @break
                                                    @case(3)
                                                        <span class="badge bg-warning">{{ $invoice->statusPayment->name }}</span>
                                                        @break
                                                    @case(4)
                                                        <span class="badge bg-danger">{{ $invoice->statusPayment->name }}</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-secondary">{{ $invoice->statusPayment->name }}</span>
                                                @endswitch
                                            </td>
                                            <td>
                                                @switch($invoice->statusOrder->id)
                                                    @case(1)
                                                        <span class="badge bg-warning">{{ $invoice->statusOrder->name }}</span>
                                                        @break
                                                    @case(2)
                                                        <span class="badge bg-secondary">{{ $invoice->statusOrder->name }}</span>
                                                        @break
                                                    @case(3)
                                                        <span class="badge bg-info">{{ $invoice->statusOrder->name }}</span>
                                                        @break
                                                    @case(4)
                                                        <span class="badge bg-primary">{{ $invoice->statusOrder->name }}</span>
                                                        @break
                                                    @case(5)
                                                        <span class="badge bg-success">{{ $invoice->statusOrder->name }}</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-danger">{{ $invoice->statusOrder->name }}</span>
                                                @endswitch
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2  justify-content-center">
                                                    <a href="{{ route('admin.invoices.show', $invoice) }}" class="btn btn-info btn-sm">Chi tiết 
                                                        <i class="fa-solid fa-circle-info fa-sm"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                      
                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                <p>Hiển thị từ {{ $invoices->firstItem() }} đến {{ $invoices->lastItem() }} trong tổng số {{ $invoices->total() }} hoá đơn</p>
                            </div>
                            <div>
                                {{ $invoices->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
    
</div>

@endsection
