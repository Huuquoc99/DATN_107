@extends('admin.layouts.master')

@section('title')
    Order #{{ $order->id }}
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mt-4 mt-xl-3">
                                <h4 class="mt-1 mb-3">Order #{{ $order->code }}</h4>
                                <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <tbody>
                                        <tr>
                                            <th>User name</th>
                                            <td>{{ $order->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>User email</th>
                                            <td>{{ $order->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>User phone</th>
                                            <td>{{ $order->user->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>User address</th>
                                            <td>{{ $order->user->address }}</td>
                                        </tr>
                                        <tr>
                                            <th>User note:</th>
                                            <td>{{ $order->user_note }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="mt-4 mt-xl-3">
                                <h4 class="mt-1 mb-3">Shipping Information</h4>
                                <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <tbody>
                                        <tr>
                                            <th>Ship user name</th>
                                            <td>{{ $order->ship_user_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ship user email</th>
                                            <td>{{ $order->ship_user_email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ship user phone</th>
                                            <td>{{ $order->ship_user_phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ship user address</th>
                                            <td>{{ $order->ship_user_address }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ship user note</th>
                                            <td>{{ $order->ship_user_note }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-xl-6">
                            <div class="mt-4 mt-xl-3">
                                <h4 class="mt-1 mb-3">Order Details</h4>

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

                                <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <tbody>
                                        <tr>
                                            <th>Status order</th>
                                            <td>
                                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}"
                                                    method="POST" class="d-flex align-items-center">
                                                    @csrf
                                                    <div class="form-group mb-0 mr-2">
                                                        <select name="status_order_id" id="status_order_id"
                                                            class="form-control me-3" style="width:150px">
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
                                                </form>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status payment</th>
                                            <td>{{ $order->statusPayment->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment method</th>
                                            <td>{{ $order->paymentMethod->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total price</th>
                                            <td>{{ number_format($order->total_price, 2) }} đ</td>
                                        </tr>
                                        <tr>
                                            <th>Created at</th>
                                            <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-4 mt-xl-3">
                        <h4 class="mt-1 mb-3">Products in Order</h4>
                        <table id="example"
                            class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>SKU</th>
                                    <th>Quantity</th>
                                    <th>Price Regular</th>
                                    <th>Price Sale</th>
                                    <th>Variant</th>
                                </tr>
                            </thead>
                            <tbody id="product-list">
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                                        <td>{{ $item->product->sku ?? 'N/A' }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->product_price_regular, 2) }} VND</td>
                                        <td>{{ number_format($item->product_price_sale, 2) }} VND</td>
                                        <td>
                                            @if ($item->product_capacity_id)
                                                {{ $item->capacity->name ?? 'N/A' }}
                                            @endif
                                            @if ($item->product_color_id)
                                                - {{ $item->color->name ?? 'N/A' }}
                                            @endif
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
@endsection
