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
                <form>
                    <div class="row g-3">
                        <div class="col-xxl-5 col-sm-12">
                            <div class="search-box">
                                <input type="text" class="form-control search bg-light border-light" placeholder="Tìm kiếm khách hàng, sản phẩm, trạng thái.">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                    </div>
                  
                </form>
            </div>
            <div class="card-body">
                <div>
                    <div class="table-responsive table-card">
                        <table class="table align-middle table-nowrap text-center" id="invoiceTable">
                            <thead class="text-muted">
                                <tr>
                                    {{-- <th scope="col" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th> --}}
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
                                        {{-- <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                            </div>
                                        </th> --}}
                                        <td>
                                            <a href="{{ route('admin.invoices.show', $invoice) }}">{{ $invoice->code }}</a>
                                        </td>
                                        <td>{{ $invoice->ship_user_name }}</td>
                                        <td>{{ $invoice->ship_user_phone }}</td>
                                        <td>
                                            <span id="invoice-date">{{ $invoice->created_at->format('d M, Y') }}</span> 
                                            <small class="text-muted" id="invoice-time">{{ $invoice->created_at->format('h:iA') }}</small>
                                        </td>
                                        <td>{{ $invoice->total_price }}</td>
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

@endsection
