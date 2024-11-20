@extends('admin.layouts.master')

@section('title', 'Order Management')

@section('content')

    <!-- start page title -->
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
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header border-0">
                    <div class="row align-items-center gy-3">
                        <div class="col-sm">
                            <h5 class="card-title mb-0">Order History</h5>
                        </div>
                        {{-- <div class="col-sm-auto">
                            <div class="d-flex gap-1 flex-wrap">
                                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create Order</button>
                                <button type="button" class="btn btn-info"><i class="ri-file-download-line align-bottom me-1"></i> Import</button>
                                <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                            </div>
                        </div> --}}
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
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-6">
                                <div>
                                    <input type="date" id="date-datepicker" class="form-control" value="{{request()->get('date')}}" placeholder="Select date">
                                </div>
                            </div>
{{--                            <!--end col-->--}}
{{--                            <div class="col-xxl-2 col-sm-4">--}}
{{--                                <div>--}}
{{--                                    <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idStatus">--}}
{{--                                        <option value="">Status</option>--}}
{{--                                        <option value="all" selected>All</option>--}}
{{--                                        <option value="Pending">Pending</option>--}}
{{--                                        <option value="Inprogress">Inprogress</option>--}}
{{--                                        <option value="Cancelled">Cancelled</option>--}}
{{--                                        <option value="Pickups">Pickups</option>--}}
{{--                                        <option value="Returns">Returns</option>--}}
{{--                                        <option value="Delivered">Delivered</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--end col-->--}}
{{--                            <div class="col-xxl-2 col-sm-4">--}}
{{--                                <div>--}}
{{--                                    <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idPayment">--}}
{{--                                        <option value="">Select Payment</option>--}}
{{--                                        <option value="all" selected>All</option>--}}
{{--                                        <option value="Mastercard">Mastercard</option>--}}
{{--                                        <option value="Paypal">Paypal</option>--}}
{{--                                        <option value="Visa">Visa</option>--}}
{{--                                        <option value="COD">COD</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--end col-->--}}
{{--                            <div class="col-xxl-1 col-sm-4">--}}
{{--                                <div>--}}
{{--                                    <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i class="ri-equalizer-fill me-1 align-bottom"></i>--}}
{{--                                        Filters--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!--end col-->
                        </div>
                        <!--end row-->
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
                                    <button class="btn py-3 filter-status {{request()->status == $orderStatus->id ? 'text-success': ''}}" data-status="{{$orderStatus->id}}">
                                        <i class="ri-store-2-fill me-1 align-bottom"></i> {{$orderStatus->name}}
                                    </button>
                                </li>
                            @endforeach
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link py-3 Delivered" data-bs-toggle="tab" id="Delivered" href="#delivered" role="tab" aria-selected="false">--}}
{{--                                    <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Delivered--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link py-3 Pickups" data-bs-toggle="tab" id="Pickups" href="#pickups" role="tab" aria-selected="false">--}}
{{--                                    <i class="ri-truck-line me-1 align-bottom"></i> Pickups <span class="badge bg-danger align-middle ms-1">2</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link py-3 Returns" data-bs-toggle="tab" id="Returns" href="#returns" role="tab" aria-selected="false">--}}
{{--                                    <i class="ri-arrow-left-right-fill me-1 align-bottom"></i> Returns--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link py-3 Cancelled" data-bs-toggle="tab" id="Cancelled" href="#cancelled" role="tab" aria-selected="false">--}}
{{--                                    <i class="ri-close-circle-line me-1 align-bottom"></i> Cancelled--}}
{{--                                </a>--}}
{{--                            </li>--}}
                        </ul>
                        <div class="card-body" id="order-lists">
                            @include('admin.orders.data')
                        </div>
                    </div>
                    {{-- <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
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
                                <form class="tablelist-form" autocomplete="off" action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" id="id-field" />
                                        <div>
                                            <label for="delivered-status" class="form-label">Delivery Status</label>
                                            <select class="form-control" data-trigger name="status_order_id" required id="status_order_id">
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
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" id="add-btn">Add Order</button>
                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Order Status</h5> <!-- Tiêu đề cho modal -->
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                
                                <!-- Hiển thị thông báo nếu có lỗi hoặc thành công -->
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
                    
                                <form class="tablelist-form" autocomplete="off" action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <!-- Bạn có thể loại bỏ input này nếu không dùng đến -->
                                        <input type="hidden" id="id-field" />
                    
                                        <div>
                                            <label for="delivered-status" class="form-label">Delivery Status</label>
                                            <select class="form-control" data-trigger name="status_order_id" required id="status_order_id">
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
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <!-- Nút đóng modal -->
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            
                                            <!-- Nút cập nhật trạng thái đơn hàng -->
                                            <button type="submit" class="btn btn-success" id="add-btn">Update Status</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                    
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!-- end row -->
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