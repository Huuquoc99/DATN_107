@extends('admin.layouts.master')

@section('title')
    TechStore
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Đơn hàng</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Bảng</a></li>
                        <li class="breadcrumb-item active">Chi tiết</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div >
        <div class="row">
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h5 class="card-title flex-grow-1 mb-0">Chi tiết người dùng</h5>
                            <div class="flex-shrink-0">
                                @if($order->user && $order->user->id)
                                    <a href="{{ route('admin.customers.show', $order->user->id) }}" class="link-secondary">Xem thông tin</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-unstyled mb-0 vstack gap-3">
                            <li>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        @if($order->user && $order->user->avatar)
                                            <img src="{{ Storage::url($order->user->avatar) }}" alt="" class="avatar-sm rounded">
                                        @else
                                            <img src="{{ asset('theme/admin/assets/images/default-avatar.png') }}" alt="Default Avatar" class="avatar-sm rounded">
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 mb-1">
                                            {{ \Illuminate\Support\Str::limit($order->user->name ?? 'Guest', 20, '...') }}
                                        </h6>
                                        <p class="text-muted mb-0">
                                            @if ($order->user && $order->user->type == 1)
                                                Admin
                                            @elseif ($order->user && $order->user->type == 0)
                                                Client
                                            @else
                                                Unknown
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>
                                {{ $order->user->email ?? 'Không có thông tin' }}
                            </li>
                            <li>
                                <i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>
                                {{ $order->user->phone ?? 'Không có thông tin' }}
                            </li>
                            <li>
                                <i class="ri-map-pin-line me-2 align-middle text-muted fs-16"></i>
                                {{ \Illuminate\Support\Str::limit($order->user->address ?? 'Không có thông tin', 20, '...') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Địa chỉ đặt hàng</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled vstack fs-13 mb-0 gap-3">
                            <li class="fw-medium fs-14">
                                {{ \Illuminate\Support\Str::limit($order->user_name ?? 'Không có thông tin', 25, '...') }}
                            </li>
                            <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $order->user_email ?? 'Không có thông tin' }}</li>
                            <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $order->user_phone ?? 'Không có thông tin' }}</li>
                            <li>
                                <i class="ri-map-pin-line me-2 align-middle text-muted fs-16"></i>
                                {{ \Illuminate\Support\Str::limit($order->user_address ?? 'Không có thông tin', 20, '...') }}
                            </li>
                            <li><i class="ri-sticky-note-line me-2 align-middle text-muted fs-16"></i>{{ $order->user_note ?? 'Không có ghi chú nào được cung cấp' }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i>
                            Địa chỉ nhận hàng</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled vstack gap-3 fs-13 mb-0">
                            <li class="fw-medium fs-14">
                                {{ \Illuminate\Support\Str::limit($order->ship_user_name, 25, '...') }}
                            </li>
                            <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $order->ship_user_email }}</li>
                            <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $order->ship_user_phone }}</li>
                            <li>
                                <i class="ri-map-pin-line me-2 align-middle text-muted fs-16"></i>
                                {{ \Illuminate\Support\Str::limit($order->ship_user_address, 20, '...') }},
                                {{ \Illuminate\Support\Str::limit($order->shipping_ward, 20, '...') }},
                                {{ \Illuminate\Support\Str::limit($order->shipping_district, 20, '...') }},
                                {{ \Illuminate\Support\Str::limit($order->shipping_province, 20, '...') }},
                            </li>
                            <li><i class="ri-sticky-note-line me-2 align-middle text-muted fs-16"></i>{{ $order->ship_user_note ?: 'Không có ghi chú nào được cung cấp' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="ri-secure-payment-line align-bottom me-1 text-muted"></i> Chi tiết đơn hàng</h5>
                    </div>
                    <div class="card-body ">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Trạng thái đơn hàng:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">
                                    <td class="status">
                                        @if ($order->statusOrder->id == 1)
                                            <span class="badge bg-warning-subtle text-warning text-uppercase">
                                                {{ $order->statusOrder?->name }}
                                            </span>
                                        @elseif ($order->statusOrder->id == 2)
                                            <span class="badge bg-secondary-subtle text-secondary text-uppercase">
                                                {{ $order->statusOrder?->name }}
                                            </span>
                                        @elseif ($order->statusOrder->id == 3)
                                            <span class="badge bg-dask-subtle text-dask text-uppercase">
                                                {{ $order->statusOrder?->name }}
                                            </span>
                                        @elseif ($order->statusOrder->id == 4)
                                            <span class="badge bg-primary-subtle text-primary text-uppercase">
                                                {{ $order->statusOrder?->name }}
                                            </span>
                                        @elseif ($order->statusOrder->id == 5)
                                            <span class="badge bg-success-subtle text-success text-uppercase">
                                                {{ $order->statusOrder?->name }}
                                            </span>
                                        @elseif ($order->statusOrder->id == 6)
                                            <span class="badge bg-danger-subtle text-danger text-uppercase">
                                                {{ $order->statusOrder?->name }}
                                            </span>
                                        @else
                                            <span class="badge bg-info-subtle text-info text-uppercase">
                                                {{ $order->statusOrder?->name }}
                                            </span>
                                        @endif
                                    </td>
                                </h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Trạng thái thanh toán:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">
                                    <td class="status">
                                        @if ($order->statusPayment->id == 1)
                                            <span class="badge bg-warning-subtle text-warning text-uppercase">
                                                {{ $order->statusPayment?->name }}
                                            </span>
                                        @elseif ($order->statusPayment->id == 2)
                                            <span class="badge bg-success-subtle text-success text-uppercase">
                                                {{ $order->statusPayment?->name }}
                                            </span>
                                        @elseif ($order->statusPayment->id == 3)
                                            <span class="badge bg-danger-subtle text-danger text-uppercase">
                                                {{ $order->statusPayment?->name }}
                                            </span>
                                        @else
                                            <span class="badge bg-info-subtle text-info text-uppercase">
                                                {{ $order->statusPayment?->name }}
                                            </span>
                                        @endif
                                    </td>
                                </h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Phương thức thanh toán:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">
                                    <td class="status">
                                        @if ($order->paymentMethod->id == 1)
                                            <span class="badge bg-primary-subtle text-primary text-uppercase">
                                                {{ $order->paymentMethod?->name }}
                                            </span>
                                        @elseif ($order->paymentMethod->id == 2)
                                            <span class="badge bg-success-subtle text-success text-uppercase">
                                                {{ $order->paymentMethod?->name }}
                                            </span>
                                        @else
                                            <span class="badge bg-info-subtle text-info text-uppercase">
                                                {{ $order->paymentMethod?->name }}
                                            </span>
                                        @endif
                                    </td>
                                </h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Ngày tạo: </p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">
                                    <span id="invoice-date">{{ $order->created_at->format('d M, Y') }}</span>
                                    <small class="text-muted" id="invoice-time">{{ $order->created_at->format('h:iA') }}</small>
                                </h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Tổng tiền:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0 text-danger"><b>{{ number_format($order->total_price, 0, ',', '.') }} VND</b></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h3 class="card-title flex-grow-1 mb-0"><b>#{{ $order->code }}</b></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-nowrap align-middle table-borderless mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col" class="text-center">SKU</th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col" class="text-center">Giá</th>
                                        <th scope="col" class="text-center">Số lượng</th>
                                        <th scope="col" class="text-end">Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->product_sku ?? 'N/A' }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                        @php
                                                            $url = $item->productVariant->image;
                                                            if (!Str::contains($url, 'http')) {
                                                                $url = \Illuminate\Support\Facades\Storage::url($url);
                                                            }
                                                        @endphp
                                                        @if ($url)
                                                            <img src="{{ $url }}" alt=""
                                                                class="img-fluid d-block">
                                                        @else
                                                            <img src="{{ asset('theme/admin/assets/images/default-avatar.png') }}" alt="Không có hình ảnh nào có sẵn"
                                                                class="img-fluid d-block">
                                                        @endif
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-15">
                                                            <a href="{{ route('admin.products.show', $item->productVariant->product->id) }}">
                                                                {{ \Illuminate\Support\Str::limit($item->product_name ?? 'N/A', 15, '...') }}
                                                            </a>
                                                        </h5>
                                                        <p class="text-muted mb-0">Màu sắc:
                                                            <span class="fw-medium">
                                                                @if ($item->product_color_id)
                                                                    {{ $item->color->name ?? 'N/A' }}
                                                                @endif
                                                            </span>
                                                        </p>
                                                        <p class="text-muted mb-0">Dung lượng:
                                                            <span class="fw-medium">
                                                                @if ($item->product_capacity_id)
                                                                    {{ $item->capacity->name ?? 'N/A' }}
                                                                @endif
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ number_format($item->productVariant->price, 0, '.', ',') }} VND</td>
                                            <td class="text-center">{{ $item->quantity }}</td>

                                            <td class="fw-medium text-end">
                                                {{ number_format($item->productVariant->price * $item->quantity, 0, '.', ',') }} VND
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr class="border-top border-top-dashed">
                                        <td colspan="3"></td>
                                        <td colspan="2" class="fw-medium p-0">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>Tổng cộng :</td>
                                                        <td class="text-end">
                                                            {{ number_format($order->subtotal, 0, '.', ',') }} VND
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
                                                    <tr class="border-top border-top-dashed">
                                                        <th scope="row">Tổng tiền:</th>
                                                        <th class="text-end">
                                                            <h5 class="text-danger"><b>{{ number_format($order->total_price, 0, '.', ',') }} VND</b></h5>
                                                        </th>
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
            </div>
            <div class="col-xl-3">
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h5 class="card-title mb-0"><i class="ri-money-dollar-circle-fill"></i>Trạng thái thanh toán</h5>--}}

{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="d-flex align-items-center mb-2">--}}
{{--                            <div class="flex-grow-1 ms-3 me-3">--}}
{{--                                <form action="{{ route('admin.orders.updatePaymentStatus', $order->id) }}" method="POST"--}}
{{--                                    class="d-flex flex-column align-items-start">--}}
{{--                                    @csrf--}}
{{--                                    @method('PUT')--}}
{{--                                    <div class="form-group mb-3">--}}
{{--                                        <select name="status_payment_id" id="status_payment_id" class="form-control" style="width: 400px;">--}}
{{--                                            @foreach ($statusPayments as $status)--}}
{{--                                                <option value="{{ $status->id }}"--}}
{{--                                                    {{ $order->status_payment_id == $status->id ? 'selected' : '' }}--}}
{{--                                                    {{ $order->status_payment_id == 2 && $status->id == 1 ? 'disabled' : '' }}>--}}
{{--                                                    {{ $status->name }}--}}
{{--                                                </option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <button type="submit" class="btn btn-primary w-100 mb-3">Cập nhật trạng thái thanh toán</button>--}}
{{--                                </form>--}}
{{--                                @if (session('error1'))--}}
{{--                                    <div class="alert alert-danger">--}}
{{--                                        {{ session('error1') }}--}}
{{--                                    </div>--}}
{{--                                @endif--}}

{{--                                @if (session('success1'))--}}
{{--                                    <div class="alert alert-success">--}}
{{--                                        {{ session('success1') }}--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                    @php
                        $statusMap = [
                            '1' => 'Chờ xử lý',
                            '2' => 'Đã xác nhận',
                            '3' => 'Đang giao hàng',
                            '4' => 'Đã giao',
                            '5' => 'Thành công',
                            '6' => 'Hủy',
                        ];
                        $status_icon = [
                            '1' => 'ri-shopping-bag-line',
                            '2' => 'mdi mdi-gift-outline',
                            '3' => 'ri-truck-line',
                            '4' => 'ri-takeaway-fill',
                            '5' => 'mdi mdi-package-variant',
                            '6' => 'mdi mdi-archive-remove-outline align-middle me-1'
                        ];

                        $status_text = [
                            '1' => 'đã xác nhận đơn hàng.',
                            '2' => 'đã xác nhận đơn hàng đang được vận chuyển.',
                            '3' => 'xác nhận đơn hàng được đã giao thành công.',
                            '4' => 'đã xác nhận đơn hàng.',
                            '5' => 'thành công',
                            '6' => 'đã hủy đơn hàng.',
                        ];

                        $cancelReasons = [
                            'product-out-in-stock' => 'Sản phẩm hết hàng trong kho.',
                            'payment-failed' => 'Thanh toán không thành công.',
                            'defective-product' => 'Phát hiện lỗi trong đơn hàng (sai giá, thông tin sản phẩm).',
                            'unable-to-contact' => 'Không thể liên lạc với khách để xác nhận đơn hàng.',
                            'no_confirmation_email' => 'Không có mail xác nhận đơn hàng',
                             'changed_mind' => 'Tôi đã thay đổi ý định',
                            'found_cheaper' => 'Đã tìm thấy một lựa chọn rẻ hơn',
                            'delivery_delay' => 'Giao hàng mất quá nhiều thời gian',
                            'incorrect_item' => 'Chi tiết mặt hàng sai',
                            'cost_high' => 'Chi phí vận chuyển quá cao',
                            'other' => 'Khác'
                        ];
                    @endphp

                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">Lịch sử thay đổi</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="profile-timeline">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    @foreach ($statusLogs as $log)
                                        <div class="accordion-item border-0">
                                            <div class="accordion-header" id="heading{{ $loop->index }}">
                                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapse{{ $loop->index }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $loop->index }}">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 avatar-xs">
                                                            <div class="avatar-title bg-success rounded-circle">
                                                                <i class="{{ $status_icon[$log->new_status] }}"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="fs-15 mb-0 fw-semibold"> {{ $statusMap[$log->new_status] ?? 'Unknown' }} - <span class="fw-normal">{{ \Carbon\Carbon::parse($log->changed_at)->setTimezone('Asia/Ho_Chi_Minh')->translatedFormat('l, d F Y - H:i A') }}</span></h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                    @if($log->new_status == 6)
                                                        <h6 class="mb-2">
                                                            <a href="{{ route('admin.customers.show', ['customer' => optional($log->changedBy)->id]) }}" class="text-decoration-none">
                                                                {{ optional($log->changedBy)->name ?? 'N/A' }}
                                                            </a>

                                                            {{ $status_text[$log->new_status] }}</h6>
                                                        @php
                                                            $cancelReason = $log->loggable ? $log->loggable->cancel_reason : '';
                                                            $otherReason = $log->loggable ? $log->loggable->other_reason : '';
                                                        @endphp

                                                        @if ($cancelReason == 'other')
                                                            <strong>{{ $otherReason ?? '' }}</strong>
                                                        @else
                                                            <strong class="mt-2">Lý do hủy: {{ $cancelReasons[$cancelReason] ?? '' }}</strong>
                                                        @endif
                                                    @else
                                                        <h6 class="mb-1">
                                                            <a href="{{ route('admin.customers.show', ['customer' => optional($log->changedBy)->id]) }}" class="text-decoration-none fs-15">
                                                               <i> {{ optional($log->changedBy)->name ?? 'N/A' }}</i>
                                                            </a> {{ $status_text[$log->old_status] }}
                                                        </h6>
                                                    @endif
                                                    <p class="text-muted">{{ \Carbon\Carbon::parse($log->changed_at)->format('D, d M Y - H:i A') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
            </div>




            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="ri-bubble-chart-fill"></i> Trạng thái đơn hàng</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" id="updateStatusForm">
                            @csrf
                            <div class="form-group mb-3">
                                <select name="status_order_id" id="status_order_id" class="form-control" style="width: 100%;" onchange="checkStatus()">
                                    @foreach ($statusOrders as $status)
                                        <option value="{{ $status->id }}" {{ $status->is_disabled ? 'disabled' : '' }}
                                            {{ $order->status_order_id == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cancelOrderModalLabel">Hủy đơn hàng</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="list-group">
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="product-out-in-stock">
                                                    Sản phẩm hết hàng trong kho.
                                                </label>
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="payment-failed">
                                                    Thanh toán không thành công.
                                                </label>
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="defective-product">
                                                    Phát hiện lỗi trong đơn hàng (sai giá, thông tin sản phẩm).
                                                </label>
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="unable-to-contact">
                                                    Không thể liên lạc với khách để xác nhận đơn hàng.
                                                </label>
                                                <div id="error_cancel_reason" class="text-danger mb-3" style="display: none;"></div>

                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="other">
                                                    Khác
                                                </label>
                                                <div class="mb-3" id="otherReasonContainer" style="display: none;">
                                                    <label for="otherReason" class="form-label">Vui lòng nêu rõ lý do của bạn</label>
                                                    <textarea class="form-control" id="otherReason" name="other_reason" rows="3"></textarea>
                                                </div>
                                                <div id="error_cancel_reason" class="text-danger mb-3" style="display: none;"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal">
                                                <i class="ri-close-line me-1 align-middle"></i> Đóng
                                            </button>
                                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="updateStatusButton" class="btn btn-primary w-100 mb-3" onclick="handleSubmit()">Cập nhật trạng thái đơn hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <script>

        @if (session('success'))
        toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
        toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
        toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
        toastr.info("{{ session('info') }}");
        @endif
    </script>
@endsection

@section('scripts')
    <script type="text/javascript">
        const orderId = {{ $order->id }};
        Pusher.logToConsole = true;
        var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
            cluster: '{{env('PUSHER_APP_CLUSTER')}}'
        });
        var channel = pusher.subscribe('channel-notification');
        channel.bind('update-order', function(data) {
            if (data.orderId == orderId) {
                location.reload();
            }
        });
    </script>

    <script>
        function checkStatus() {
            const statusSelect = document.getElementById("status_order_id");
            const updateButton = document.getElementById("updateStatusButton");

            updateButton.dataset.statusId = statusSelect.value;
        }

        document.querySelectorAll('input[name="cancel_reason"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                var otherReasonContainer = document.getElementById('otherReasonContainer');
                otherReasonContainer.style.display = (this.value === 'other') ? 'block' : 'none';
            });
        });

        function handleSubmit() {
            const statusSelect = document.getElementById("status_order_id");

            if (statusSelect.value === "6") {
                const modal = new bootstrap.Modal(document.getElementById('cancelOrderModal'));

                const confirmButton = modal._element.querySelector('.modal-footer .btn-primary');
                confirmButton.addEventListener('click', function(e) {
                    const selectedReason = modal._element.querySelector('input[name="cancel_reason"]:checked');

                    const errorReasonElement = modal._element.querySelector('#error_cancel_reason');
                    errorReasonElement.innerHTML = '';
                    errorReasonElement.style.display = 'none';

                    if (!selectedReason) {
                        errorReasonElement.innerHTML = 'Vui lòng chọn lý do hủy đơn';
                        errorReasonElement.style.display = 'block';
                        e.preventDefault();
                        return;
                    }

                    if (selectedReason.value === 'other') {
                        const otherReasonText = modal._element.querySelector('#otherReason').value.trim();

                        if (!otherReasonText) {
                            errorReasonElement.innerHTML = 'Vui lòng nhập lý do cụ thể';
                            errorReasonElement.style.display = 'block';
                            e.preventDefault();
                            return;
                        }
                    }

                    document.getElementById('updateStatusForm').submit();
                });

                modal.show();
            } else {
                document.getElementById("updateStatusForm").submit();
            }
        }
    </script>


@endsection
