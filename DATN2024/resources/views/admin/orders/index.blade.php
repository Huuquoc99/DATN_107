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

    {{-- <div class="row">
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
                        <div class="card-body" id="order-lists">
                            @include('admin.orders.data')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}
@endsection

@section('script-libs')
   
@endsection