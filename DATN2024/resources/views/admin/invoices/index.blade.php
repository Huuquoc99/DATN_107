@extends('admin.layouts.master')

@section("title", "Invoice")
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Invoice</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </div>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-xl-3 col-md-6">
        
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium text-muted mb-0">Invoices Sent</p>
                    </div>
                    <div class="flex-shrink-0">
                        <h5 class="text-success fs-14 mb-0">
                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +89.24 %
                        </h5>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="559.25">0</span>k</h4>
                        <span class="badge bg-warning me-1">2,258</span> <span class="text-muted">Invoices sent</span>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-light rounded fs-3">
                            <i data-feather="file-text" class="text-success icon-dual-success"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium text-muted mb-0">Paid Invoices</p>
                    </div>
                    <div class="flex-shrink-0">
                        <h5 class="text-danger fs-14 mb-0">
                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i> +8.09 %
                        </h5>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="409.66">0</span>k</h4>
                        <span class="badge bg-warning me-1">1,958</span> <span class="text-muted">Paid by clients</span>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-light rounded fs-3">
                            <i data-feather="check-square" class="text-success icon-dual-success"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
       
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium text-muted mb-0">Unpaid Invoices</p>
                    </div>
                    <div class="flex-shrink-0">
                        <h5 class="text-danger fs-14 mb-0">
                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i> +9.01 %
                        </h5>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="136.98">0</span>k</h4>
                        <span class="badge bg-warning me-1">338</span> <span class="text-muted">Unpaid by clients</span>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-light rounded fs-3">
                            <i data-feather="clock" class="text-success icon-dual-success"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium text-muted mb-0">Cancelled Invoices</p>
                    </div>
                    <div class="flex-shrink-0">
                        <h5 class="text-success fs-14 mb-0">
                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +7.55 %
                        </h5>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="84.20">0</span>k</h4>
                        <span class="badge bg-warning me-1">502</span> <span class="text-muted">Cancelled by clients</span>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-light rounded fs-3">
                            <i data-feather="x-octagon" class="text-success icon-dual-success"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<div class="row">
    <div class="col-lg-12">
        <div class="card" id="invoiceList">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Invoices</h5>
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
                                <input type="text" class="form-control search bg-light border-light" placeholder="Search for customer, email, country, status or something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        
                        <div class="col-xxl-3 col-sm-4">
                            <input type="text" class="form-control bg-light border-light" id="datepicker-range" placeholder="Select date">
                        </div>
                     
                        <div class="col-xxl-3 col-sm-4">
                            <div class="input-light">
                                <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                    <option value="">Status</option>
                                    <option value="all" selected>All</option>
                                    <option value="Unpaid">Unpaid</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Cancel">Cancel</option>
                                    <option value="Refund">Refund</option>
                                </select>
                            </div>
                        </div>
                        

                        <div class="col-xxl-1 col-sm-4">
                            <button type="button" class="btn btn-primary w-100" onclick="SearchData();">
                                <i class="ri-equalizer-fill me-1 align-bottom"></i> Filters
                            </button>
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
                                    <th scope="col" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th>
                                    <th class="sort text-uppercase" data-sort="invoice_id">Code</th>
                                    <th class="sort text-uppercase" data-sort="customer_name">Customer</th>
                                    <th class="sort text-uppercase" data-sort="country">Phone</th>
                                    <th class="sort text-uppercase" data-sort="date">Date</th>
                                    <th class="sort text-uppercase" data-sort="invoice_amount">Amount</th>
                                    <th class="sort text-uppercase" data-sort="status">Payment Status</th>
                                    <th class="sort text-uppercase" data-sort="action">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="invoice-list-data">
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                            </div>
                                        </th>
                                        <td>
                                            <a href="{{ route('admin.customers.show', $invoice) }}">{{ $invoice->code }}</a>
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
                                            <div class="d-flex gap-2  justify-content-center">
                                                <a href="{{ route('admin.invoices.show', $invoice) }}" class="btn btn-info btn-sm">Show 
                                                    <i class="fa-solid fa-circle-info fa-sm"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <div class="pagination-wrap hstack gap-2">
                            <a class="page-item pagination-prev disabled" href="#">
                                Previous
                            </a>
                            <ul class="pagination listjs-pagination mb-0"></ul>
                            <a class="page-item pagination-next" href="#">
                                Next
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</div>

@endsection
