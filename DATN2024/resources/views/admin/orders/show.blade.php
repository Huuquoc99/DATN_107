@extends('admin.layouts.master')

@section('title')
    #{{ $order->code }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Order</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Table</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0"> #{{ $order->code }}</h5>
                        <div class="flex-shrink-0">
                            {{-- <a href="{{ route('admin.invoices.show', $invoice) }}" class="btn btn-success btn-sm"><i class="ri-download-2-fill align-middle me-1"></i> Invoice</a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        {{-- @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif --}}
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th scope="col">Product Details</th>
                                    <th scope="col">Item Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col" class="text-end">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                    {{-- <img src="assets/images/products/img-8.png" alt="" class="img-fluid d-block"> --}}
                                                    @php
                                                        $url = $item->productVariant->image;
                                                        if (!Str::contains($url, 'http')) {
                                                            $url = \Illuminate\Support\Facades\Storage::url($url);
                                                        }
                                                    @endphp
                                                    {{-- <img src="{{ $url }}" alt="" class="img-fluid d-block"> --}}
                                                    @if ($url)
                                                        <img src="{{ $url }}" alt=""
                                                            class="img-fluid d-block">
                                                    @else
                                                        <img src="path/to/placeholder-image.png" alt="No image available"
                                                            class="img-fluid d-block">
                                                    @endif
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-15">{{ $item->product_name ?? 'N/A' }}</h5>
                                                    <p class="text-muted mb-0">Color:
                                                        <span class="fw-medium">
                                                            @if ($item->product_color_id)
                                                                {{ $item->color->name ?? 'N/A' }}
                                                            @endif
                                                        </span>
                                                    </p>
                                                    <p class="text-muted mb-0">Capacity:
                                                        <span class="fw-medium">
                                                            @if ($item->product_capacity_id)
                                                                {{ $item->capacity->name ?? 'N/A' }}
                                                            @endif
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ number_format($item->product_price_sale, 2) }} VND</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->product_sku ?? 'N/A' }}</td>
                                        <td class="fw-medium text-end">
                                            $239.98
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="border-top border-top-dashed">
                                    <td colspan="3"></td>
                                    <td colspan="2" class="fw-medium p-0">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>Sub Total :</td>
                                                    <td class="text-end">$359.96</td>
                                                </tr>
                                                <tr class="border-top border-top-dashed">
                                                    <th scope="row">Total (USD) :</th>
                                                    <th class="text-end">$415.96</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Order Status</h5>
                        <div class="flex-shrink-0 mt-2 mt-sm-0">
                            <a href="javascript:void(0);" class="btn btn-soft-info btn-sm mt-2 mt-sm-0"><i
                                    class="ri-map-pin-line align-middle me-1"></i> Change Address</a>
                            <a href="javascript:void(0);" class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"><i
                                    class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel Order</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingOne">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                        href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="ri-shopping-bag-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-0 fw-semibold">Order Placed - <span
                                                        class="fw-normal">Wed, 15 Dec 2021</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="mb-1">An order has been placed.</h6>
                                        <p class="text-muted">Wed, 15 Dec 2021 - 05:34PM</p>

                                        <h6 class="mb-1">Seller has processed your order.</h6>
                                        <p class="text-muted mb-0">Thu, 16 Dec 2021 - 5:48AM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingTwo">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                        href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="mdi mdi-gift-outline"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-1 fw-semibold">Packed - <span class="fw-normal">Thu,
                                                        16 Dec 2021</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="mb-1">Your Item has been picked up by courier partner</h6>
                                        <p class="text-muted mb-0">Fri, 17 Dec 2021 - 9:45AM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingThree">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                        href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="ri-truck-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-1 fw-semibold">Shipping - <span class="fw-normal">Thu,
                                                        16 Dec 2021</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseThree" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="fs-14">RQK Logistics - MFDS1400457854</h6>
                                        <h6 class="mb-1">Your item has been shipped.</h6>
                                        <p class="text-muted mb-0">Sat, 18 Dec 2021 - 4.54PM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingFour">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                        href="#collapseFour" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-light text-success rounded-circle">
                                                    <i class="ri-takeaway-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-0 fw-semibold">Out For Delivery</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingFive">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                        href="#collapseFile" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-light text-success rounded-circle">
                                                    <i class="mdi mdi-package-variant"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-0 fw-semibold">Delivered</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--end accordion-->
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xl-3">
            {{-- <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0"><i class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Logistics Details</h5>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="badge bg-primary-subtle text-primary fs-11">Track Order</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:80px;height:80px"></lord-icon>
                        <h5 class="fs-16 mt-2">RQK Logistics</h5>
                        <p class="text-muted mb-0">ID: MFDS1400457854</p>
                        <p class="text-muted mb-0">Payment Mode : Debit Card</p>
                    </div>
                </div>
            </div> --}}
            <!--end card-->

            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Customer Details</h5>
                        <div class="flex-shrink-0">
                            <a href="{{ route('admin.customers.show', $order->user->id) }}" class="link-secondary">View
                                Profile</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ Storage::url($order->user->avatar) }}" alt=""
                                        class="avatar-sm rounded">

                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">{{ $order->user->name }}</h6>
                                    <p class="text-muted mb-0">
                                        @if ($order->user->type == 1)
                                            Admin
                                        @elseif ($order->user->type == 0)
                                            Client
                                        @else
                                            Unknown
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $order->user->email }}</li>
                        <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $order->user->phone }}</li>
                        {{-- <li><i class="ri-map-pin-line align-middle me-1 text-muted"></i>{{ $order->user->address }}</li> --}}

                    </ul>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Billing
                        Address</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                        <li class="fw-medium fs-14">{{ $order->user->name }}</li>
                        <li>{{ $order->user->email }}</li>
                        <li>{{ $order->user->phone }}</li>
                        <li>{{ $order->user->address }}</li>
                        <li>{{ $order->user_note }}</li>
                        {{-- <li>United States</li> --}}
                    </ul>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Shipping
                        Address</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                        <li class="fw-medium fs-14">{{ $order->ship_user_name }}</li>
                        <li>{{ $order->ship_user_email }}</li>
                        <li>{{ $order->ship_user_phone }}</li>
                        <li>{{ $order->ship_user_address }}</li>
                        <li>{{ $order->ship_user_note }}</li>
                    </ul>
                </div>
            </div>
            <!--end card-->

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-secure-payment-line align-bottom me-1 text-muted"></i> Order Details</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Status order:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{ $order->statusOrder->name }}</h6>
                            {{-- <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST"
                                class="d-flex align-items-center">
                                @csrf
                                <div class="form-group mb-0 mr-2">
                                    <select name="status_order_id" id="status_order_id" class="form-control me-3"
                                        style="width:150px">
                                        @foreach ($statusOrders as $status)
                                            <option value="{{ $status->id }}"
                                                {{ $order->status_order_id == $status->id ? 'selected' : '' }}
                                                {{ $status->id < $order->status_order_id ||
                                                (($order->status_order_id == 2 || $order->status_order_id == 3) && $status->id == 4)
                                                    ? 'disabled'
                                                    : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary ml-2">Update
                                    status</button>
                            </form> --}}
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Status payment:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{ $order->statusPayment->name }}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Payment method:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{ $order->paymentMethod->name }}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Created at: </p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{ $order->created_at->format('d/m/Y H:i:s') }}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Total Amount:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{ number_format($order->total_price, 2) }} VND</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-bubble-chart-fill"></i> Order Status</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        {{-- <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Status order:</p>
                        </div> --}}
                        {{-- <div class="flex-grow-1 ms-2">
                            
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST"
                                class="d-flex align-items-center">
                                @csrf
                                <div class="form-group mb-0 mr-2">
                                    <select name="status_order_id" id="status_order_id" class="form-control me-3"
                                        style="width:150px">
                                        @foreach ($statusOrders as $status)
                                            <option value="{{ $status->id }}"
                                                {{ $order->status_order_id == $status->id ? 'selected' : '' }}
                                                {{ $status->id < $order->status_order_id ||
                                                (($order->status_order_id == 2 || $order->status_order_id == 3) && $status->id == 4)
                                                    ? 'disabled'
                                                    : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary ml-2">Update status</button>
                            </form>
                        </div> --}}

                        
                        <div class="flex-grow-1 ms-2">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            {{-- <h6 class="mb-0">{{ $order->statusOrder->name }}</h6> --}}
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-flex flex-column align-items-start">
                                @csrf
                                <div class="form-group mb-2">
                                    <select name="status_order_id" id="status_order_id" class="form-control" style="width:245px">
                                        @foreach ($statusOrders as $status)
                                            <option value="{{ $status->id }}"
                                                {{ $order->status_order_id == $status->id ? 'selected' : '' }}
                                                {{ $status->id < $order->status_order_id ||
                                                (($order->status_order_id == 2 || $order->status_order_id == 3) && $status->id == 4) ? 'disabled' : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Update status</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
@endsection
