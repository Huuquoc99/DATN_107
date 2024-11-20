@extends('admin.layouts.master')

@section('title', 'Order Management')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Order Management</h4>

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
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header border-0">
                    <div class="row align-items-center gy-3">
                        <div class="col-sm">
                            <h5 class="card-title mb-0">Order</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-5 col-sm-6">
                                <div class="search-box">
                                    <input type="text" class="form-control search" value="{{request()->get('search')}}" id="search-input" placeholder="Search for order ID, customer, order status or something...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-6">
                                <div>
                                    <input type="date" id="date-datepicker" class="form-control" value="{{request()->get('date')}}" placeholder="Select date">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                            <li class="nav-item">

                                <button class="btn py-3 filter-status {{empty(request()->status) ? 'text-success': ''}}" data-status="">
                                    <i class="ri-store-2-fill me-1 align-bottom"></i>All Orders
                                </button>
                            </li>

                            @foreach($orderStatuses as $orderStatus)
                                <li class="nav-item">
                                    <button class="btn py-3 filter-status {{ request()->status == $orderStatus->id ? 'text-success' : '' }}" data-status="{{ $orderStatus->id }}">
                                        @switch($orderStatus->id)
                                            @case(1)
                                                <i class="ri-time-line"></i>
                                                @break
                                            @case(2)
                                                <i class="ri-truck-line me-1 align-bottom"></i>
                                                @break
                                            @case(3)
                                                <i class="ri-checkbox-circle-line me-1 align-bottom"></i>
                                                @break
                                            @case(4)
                                            <i class="ri-close-circle-line me-1 align-bottom"></i>
                                                @break
                                            @default
                                                <i class="ri-store-2-fill me-1 align-bottom"></i>
                                        @endswitch
                                        {{ $orderStatus->name }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="table-responsive table-card mb-1">

                            @if (session("success"))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session("success")}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <table class="table table-nowrap align-middle" id="orderTable">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th scope="col" style="width: 25px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                            </div>
                                        </th>
                                        <th class="sort" data-sort="id">Order ID</th>
                                        <th class="sort" data-sort="customer_name">Customer</th>
                                        <th class="sort" data-sort="date">Order Date</th>
                                        <th class="sort" data-sort="amount">Amount</th>
                                        <th class="sort" data-sort="payment">Payment Method</th>
                                        <th class="sort" data-sort="status">Order status</th></th>
                                        <th class="sort" data-sort="city">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach($orders as $order)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="checkAll" value="option1">
                                                </div>
                                            </th>
                                            <td class="id">
                                                <a href="{{ route('admin.orders.show', $order) }}" class="fw-medium link-primary">#{{ $order->code }}</a>
                                            </td>
                                            <td class="customer_name">{{ $order->user->name }}</td>
                                            <td class="date">
                                                <span id="invoice-date">{{ $order->created_at->format('d M, Y') }}</span>
                                                <small class="text-muted" id="invoice-time">{{ $order->created_at->format('h:iA') }}</small>
                                            </td>
                                            <td class="amount">{{ $order->total_price }} VND</td>
                                            <td class="payment">
                                                @if ($order->statusPayment->id == 1)
                                                    <span class="badge bg-warning-subtle text-warning text-uppercase">{{ $order->statusPayment->name }}</span>
                                                @elseif ($order->statusPayment->id == 2)
                                                    <span class="badge bg-success-subtle text-success text-uppercase">{{ $order->statusPayment->name }}</span>
                                                @else
                                                    <span class="badge bg-info-subtle text-info text-uppercase">{{ $order->statusPayment->name }}</span>
                                                @endif
                                            </td>
                                            <td class="status">
                                                @if ($order->statusOrder->id == 1)
                                                    <span class="badge bg-warning-subtle text-warning text-uppercase">{{ $order->statusOrder->name }}</span>
                                                @elseif ($order->statusOrder->id == 2)
                                                    <span class="badge bg-secondary-subtle text-secondary text-uppercase">{{ $order->statusOrder->name }}</span>
                                                @elseif ($order->statusOrder->id == 3)
                                                    <span class="badge bg-success-subtle text-success text-uppercase">{{ $order->statusOrder->name }}</span>
                                                @elseif ($order->statusOrder->id == 4)
                                                    <span class="badge bg-danger-subtle text-danger text-uppercase"> {{ $order->statusOrder->name }}</span>
                                                @else
                                                    <span class="badge bg-info-subtle text-info text-uppercase">{{ $order->statusOrder->name }}</span>
                                                @endif
                                            </td>
                                            </td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-primary d-inline-block">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} orders</p>
                            </div>
                            <div>
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                        <div class="card-body" id="order-lists">
                            @include('admin.orders.data')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script-libs')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">
    $(document).ready(function(){
        let debounce;
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            let url = $(this).attr('href');
            getData(url);
        });

        $(document).on('click', '.filter-status', function (e) {
            e.preventDefault();

            let status = $(this).data('status');
            let currentUrl = new URL(window.location.href);
            let params = new URLSearchParams(currentUrl.search);

            if (status === "") {
                params.delete('status');
            } else {
                params.set('status', status);
            }
            params.delete('page');
            let url = currentUrl.origin + currentUrl.pathname + '?' + params.toString();

            $('.filter-status').removeClass('text-success');
            $(this).addClass('text-success');

            getData(url);
        });

        $(document).on('keyup', '#search-input', function (e) {
            e.preventDefault();

            let query = $(this).val();
            debounce = setTimeout(function () {
                let currentUrl = new URL(window.location.href);
                let params = new URLSearchParams(currentUrl.search);

                params.set('search', query);
                params.delete('page');
                let url = currentUrl.origin + currentUrl.pathname + '?' + params.toString();
                getData(url);
            }, 500);
        });

        $(document).on('change', '#date-datepicker', function (e) {
            e.preventDefault();

            let date = $(this).val();
            let currentUrl = new URL(window.location.href);
            let params = new URLSearchParams(currentUrl.search);

            params.set('date', date);
            params.delete('page');
            let url = currentUrl.origin + currentUrl.pathname + '?' + params.toString(); // Tạo URL mới
            getData(url);
        });


        function getData(url){
            $.ajax({
                url: url,
                type: "get",
                datatype: "html",
                success: function (data) {
                    $("#order-lists").html(data);
                    history.pushState(null, '', url);
                }
            })
        }
    });
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#date-datepicker", {
            altInput: true,
            altFormat: "d M Y",
            dateFormat: "Y-m-d",
        });
    });
</script>
@endsection
