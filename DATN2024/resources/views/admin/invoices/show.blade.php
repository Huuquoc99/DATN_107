@extends('admin.layouts.master')
@section("title", "TechStore")
@section('content')
<div>
    @if(!$order)
        <div class="alert alert-danger">
            Hóa đơn không tồn tại hoặc không có sẵn.
        </div>
    @else
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Hoá đơn</h4>
    
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                        <li class="breadcrumb-item active"> Chi tiết</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xxl-9">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header border-bottom-dashed p-4">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <img src="{{ asset('theme/admin/assets/images/techStore.png') }}" class="card-logo card-logo-dark mt-3" alt="logo dark" height="40" >
                                    <img src="{{ asset('theme/admin/assets/images/techStore.png') }}" class="card-logo card-logo-light" alt="logo light" height="40">
                                    <div class="mt-sm-5 mt-4">
                                        <h6 class="text-muted text-uppercase fw-semibold">Địa chỉ</h6>
                                        <p class="text-muted mb-1" id="address-details">Hà Nôi, Việt Nam</p>
                                        <p class="text-muted mb-0" id="zip-code"><span>Mã bưu điện:</span> 100000</p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 mt-sm-0 mt-3">
                                    <h6><span class="text-muted fw-normal">Số đăng ký pháp lý:</span><span id="legal-register-no">987654</span></h6>
                                    <h6><span class="text-muted fw-normal">Email:</span><span id="email">techstore@gmail.com</span></h6>
                                    <h6><span class="text-muted fw-normal">Website:</span> <a href="https://techstore.com/" class="link-primary" target="_blank" id="website">www.techstore.com</a></h6>
                                    <h6 class="mb-0"><span class="text-muted fw-normal">Số liên lạc: </span><span id="contact-no"> +(84) 987 654 321</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Số hóa đơn</p>
                                    <h5 class="fs-14 mb-0">#<span id="invoice-no">{{ $order->code }}</span></h5>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Ngày tạo</p>
                                    <h5 class="fs-14 mb-0">
                                        <span id="invoice-date">{{ $order->created_at->format('d M, Y') }}</span> 
                                        <small class="text-muted" id="invoice-time">{{ $order->created_at->format('h:iA') }}</small>
                                    </h5>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="pb-3">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Trạng thái thanh toán</p>
                                        @switch($order->statusPayment->id)
                                            @case(1)
                                                <span class="badge bg-primary-subtle text-primary fs-11" id="payment-status">{{ $order->statusPayment->name }}</span>
                                                @break
                                            @case(2)
                                                <span class="badge bg-success-subtle text-success fs-11" id="payment-status">{{ $order->statusPayment->name }}</span>
                                                @break
                                            @case(3)
                                                <span class="badge bg-warning-subtle text-warning fs-11" id="payment-status">{{ $order->statusPayment->name }}</span>
                                                @break
                                            @case(4)
                                                <span class="badge bg-danger-subtle text-danger fs-11">{{ $order->statusPayment->name }}</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary-subtle text-secondary fs-11">{{ $order->statusPayment->name }}</span>
                                        @endswitch
                                    </div>

                                    <div>
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Trạng thái đơn hàng</p>
                                        @switch($order->statusOrder->id)
                                            @case(1)
                                                <span class="badge bg-warning-subtle text-warning fs-11" id="payment-status">{{ $order->statusOrder->name }}</span>
                                                @break
                                            @case(2)
                                                <span class="badge bg-info-subtle text-info fs-11" id="payment-status">{{ $order->statusOrder->name }}</span>
                                                @break
                                            @case(3)
                                                <span class="badge bg-secondary-subtle text-secondary fs-11" id="payment-status">{{ $order->statusOrder->name }}</span>
                                                @break
                                            @case(4)
                                                <span class="badge bg-primary-subtle text-primary fs-11">{{ $order->statusOrder->name }}</span>
                                                @break
                                            @case(5)
                                                <span class="badge bg-success-subtle text-success fs-11">{{ $order->statusOrder->name }}</span>
                                                @break
                                            @default
                                                <span class="badge bg-danger-subtle text-danger fs-11">{{ $order->statusOrder->name }}</span>
                                        @endswitch
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Total Amount</p>
                                    <h5 class="fs-14 mb-0"><span id="total-amount">{{ number_format($order->total_price, 0, ',', '.') }}</span> VND</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body p-4 border-top border-top-dashed">
                            <div class="row g-3">
                                <div class="col-6">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Địa chỉ thanh toán</h6>
                                    <p class="fw-medium mb-2" id="billing-name">{{$order->user_name}}</p>
                                    <p class="text-muted mb-1">{{$order->user_address}}</p>
                                    <p class="text-muted mb-1">{{$order->user_email}} </p>
                                    <p class="text-muted mb-1">{{$order->user_phone}}</p>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Địa chỉ nhận hàng</h6>
                                    <p class="fw-medium mb-2" id="shipping-name">{{$order->ship_user_name}}</p>
                                    <p class="text-muted mb-1">{{$order->ship_user_address}}</p>
                                    <p class="text-muted mb-1">{{$order->ship_user_email}}</p>
                                    <p class="text-muted mb-1">{{$order->ship_user_phone}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr class="table-active">
                                            <th scope="col" style="width: 50px;">#</th>
                                            <th scope="col">Sản phẩm</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col" class="text-end">Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-list">
                                        @foreach($order->orderItems as $item)
                                            <tr>
                                                <th scope="row">{{ $item->product_sku }}</th>
                                                <td class="text-start text-center">
                                                    <span class="fw-medium">{{ $item->product_name }}</span>
                                                    <p class="text-muted mb-0">
                                                        @if ($item->product_capacity_id)
                                                            {{ $item->capacity->name ?? 'N/A' }}
                                                        @endif
                                                        @if ($item->product_color_id)
                                                            - {{ $item->color->name ?? 'N/A' }}
                                                        @endif
                                                    </p>
                                                </td>
                                                <td>{{ $item->productVariant ? number_format($item->productVariant->price, 0, ',', '.') . ' VND' : 'N/A' }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td class="text-end">
                                                    {{ $item->productVariant ? number_format($item->productVariant->price * $item->quantity, 0, ',', '.') . ' VND' : 'N/A' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top border-top-dashed mt-2">
                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                    <tbody>
                                        <tr>
                                            <td>Tổng cộng</td>
                                            <td class="text-end">
                                                {{ $item->productVariant?->price ? number_format($item->productVariant->price * $item->quantity, 0, ',', '.') . ' VND' : 'N/A' }}
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            @if ($order->voucher)
                                                <td>Giảm giá :</td>
                                                <td class="text-end">
                                                    @if ($order->voucher->discount_type === 'percent')
                                                        -{{ number_format(($order->subtotal * $order->voucher->discount / 100), 0, '.', ',') }} VND ({{ $order->voucher->discount }}%)
                                                    @elseif ($order->voucher->discount_type === 'percent_max')
                                                        @php
                                                            $discount_value = $order->subtotal * $order->voucher->discount / 100;
                                                            $discount_value = min($discount_value, $order->voucher->max_discount);
                                                        @endphp
                                                        -{{ number_format($discount_value, 0, '.', ',') }} VND ({{ $order->voucher->discount }}%, tối đa {{ number_format($order->voucher->max_discount, 0, '.', ',') }} VND)
                                                    @elseif ($order->voucher->discount_type === 'amount')
                                                        -{{ number_format($order->voucher->discount, 0, '.', ',') }} VND
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($order->use_points)
                                                <td>Điểm thưởng</td>
                                                <td class="text-end">
                                                    -{{ $order->use_points }} VND
                                                </td>
                                            @endif
                                        </tr>
                                        <tr class="border-top border-top-dashed fs-15">
                                            <th scope="row">Tổng tiền: </th>
                                            <th class="text-end ">
                                                <h5 class="text-danger"><b>{{ number_format($order->total_price, 0, ',', '.') }} VND</b></h5>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Payment Details:</h6>
                                <p class="text-muted mb-1">Phương thức thanh toán: <span class="fw-medium" id="payment-method">{{ $order->paymentMethod->name }}</span></p>
                                <p class="text-muted">Tổng tiền:
                                    <span class="fw-medium" id=""></span>
                                    <span id="card-total-amount">
                                        <span class="text-danger"><b>{{ number_format($order->total_price, 0, ',', '.') }} VND</b></span>
                                    </span>
                                </p>
                            </div>
                            <div class="mt-4">
                                <div class="alert alert-info">
                                    <p class="mb-0"><span class="fw-semibold">NOTES:</span>
                                        <span id="note">All accounts are to be paid within 7 days from receipt of invoice. To be paid by cheque or
                                            credit card or direct payment online. If account is not paid within 7
                                            days the credits details supplied as confirmation of work undertaken
                                            will be charged the agreed quoted fee noted above.
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary"><i class="ri-arrow-left-line"></i> Quay lại</a>
                                <a href="javascript:window.print()" class="btn btn-primary"><i class="ri-printer-line align-bottom me-1"></i> In hoá đơn</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection




