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
                                        <!-- Check if user exists and has an avatar -->
                                        @if($order->user && $order->user->avatar)
                                            <img src="{{ Storage::url($order->user->avatar) }}" alt="" class="avatar-sm rounded">
                                        @else
                                            <img src="{{ asset('theme/admin/assets/images/default-avatar.png') }}" alt="Default Avatar" class="avatar-sm rounded">
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 mb-1">
                                            {{ \Illuminate\Support\Str::limit($order->user->name ?? 'Unknown User', 20, '...') }}
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
                                {{ $order->user->email ?? 'No email available' }}
                            </li>
                            <li>
                                <i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>
                                {{ $order->user->phone ?? 'No phone available' }}
                            </li>
                            <li>
                                <i class="ri-map-pin-line me-2 align-middle text-muted fs-16"></i>
                                {{ \Illuminate\Support\Str::limit($order->user->address ?? 'No address available', 20, '...') }}
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
                                {{ \Illuminate\Support\Str::limit($order->user_name ?? 'Người dùng không xác định', 25, '...') }}
                            </li>
                            <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $order->user_email ?? 'Không có email nào khả dụng' }}</li>
                            <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $order->user_phone ?? 'Không có điện thoại nào có sẵn' }}</li>
                            <li>
                                <i class="ri-map-pin-line me-2 align-middle text-muted fs-16"></i>
                                {{ \Illuminate\Support\Str::limit($order->user_address ?? 'Không có địa chỉ nào có sẵn', 20, '...') }}
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
                                    {{ \Illuminate\Support\Str::limit($order->statusOrder->name, 25, '...') }}
                                </h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Trạng thái thanh toán:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">
                                    {{ \Illuminate\Support\Str::limit($order->statusPayment->name, 20, '...') }}
                                </h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Phương thức thanh toán:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">
                                    {{ \Illuminate\Support\Str::limit($order->paymentMethod->name, 15, '...') }}
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
                                <h6 class="mb-0">{{ number_format($order->total_price, 0, ',', '.') }} VND</h6>
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
                                        <th scope="col" class="text-end">Total Amount</th>
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

                                    {{-- @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->product_sku ?? 'N/A' }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                        @php
                                                            $url = null;
                                                            if (isset($item->productVariant)) {
                                                                $url = $item->productVariant->image;
                                                                if ($url && !Str::contains($url, 'http')) {
                                                                    $url = \Illuminate\Support\Facades\Storage::url($url);
                                                                }
                                                            }
                                                        @endphp
                                                        @if ($url)
                                                            <img src="{{ $url }}" alt="Product Image" class="img-fluid d-block">
                                                        @else
                                                            <img src="{{ asset('theme/admin/assets/images/default-avatar.png') }}" 
                                                                alt="Không có hình ảnh nào có sẵn" 
                                                                class="img-fluid d-block">
                                                        @endif
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <!-- Other product details -->
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ number_format($item->product_price_regular, 0, ',', '.') }} VND</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-end">{{ number_format($item->total, 0, ',', '.') }} VND</td>
                                        </tr>
                                    @endforeach --}}

                                    <tr class="border-top border-top-dashed">
                                        <td colspan="3"></td>
                                        <td colspan="2" class="fw-medium p-0">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>Tổng cộng :</td>
                                                        <td class="text-end">
                                                            {{ number_format($item->order->total_price, 0, '.', ',') }} VND
                                                        </td>
                                                    </tr>
                                                    <tr class="border-top border-top-dashed">
                                                        <th scope="row">Tổng tiền:</th>
                                                        <th class="text-end">
                                                            {{ number_format($item->order->total_price, 0, '.', ',') }} VND
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
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="ri-money-dollar-circle-fill"></i>Trạng thái thanh toán</h5>

                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-grow-1 ms-3 me-3">
                                <form action="{{ route('admin.orders.updatePaymentStatus', $order->id) }}" method="POST"
                                    class="d-flex flex-column align-items-start">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3">
                                        <select name="status_payment_id" id="status_payment_id" class="form-control" style="width:320px">
                                            @foreach ($statusPayments as $status)
                                                <option value="{{ $status->id }}"
                                                    {{ $order->status_payment_id == $status->id ? 'selected' : '' }}
                                                    {{ $order->status_payment_id == 2 && $status->id == 1 ? 'disabled' : '' }}>
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 mb-3">Cập nhật trạng thái thanh toán</button>
                                </form>
                                @if (session('error1'))
                                    <div class="alert alert-danger">
                                        {{ session('error1') }}
                                    </div>
                                @endif

                                @if (session('success1'))
                                    <div class="alert alert-success">
                                        {{ session('success1') }}
                                    </div>
                                @endif
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
                                <select name="status_order_id" id="status_order_id" class="form-control" style="width: 320px;" onchange="checkStatus()">
                                    @foreach ($statusOrders as $status)
                                        <option value="{{ $status->id }}" {{ $status->is_disabled ? 'disabled' : '' }}
                                            {{ $order->status_order_id == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cancelOrderModalLabel">Hủy đơn hàng</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Lý do hủy đơn -->
                                            <div class="list-group">
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="changed_mind">
                                                    Đã thay đổi suy nghĩ của tôi
                                                </label>
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="found_cheaper">
                                                    Đã tìm thấy một lựa chọn rẻ hơn
                                                </label>
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="other">
                                                    Khác
                                                </label>
                                                <div class="mb-3" id="otherReasonContainer" style="display: none;">
                                                    <label for="otherReason" class="form-label">Vui lòng nêu rõ lý do của bạn</label>
                                                    <textarea class="form-control" id="otherReason" name="other_reason" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal">
                                                <i class="ri-close-line me-1 align-middle"></i> Đóng
                                            </button>
                                            <button type="submit" class="btn btn-primary">Gửi</button>
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

        function handleSubmit() {
            const updateButton = document.getElementById("updateStatusButton");

            if (updateButton.dataset.statusId === "6") {
                const modal = new bootstrap.Modal(document.getElementById('cancelOrderModal'));
                modal.show();
            } else {
                document.getElementById("updateStatusForm").submit();
            }
        }

        document.addEventListener("DOMContentLoaded", checkStatus);
    </script>

            <script>
                function confirmReceived() {
                    if (confirm('Are you sure you want to mark this order as received?')) {
                        document.getElementById('markAsReceivedForm').submit();
                    }
                }

                function confirmCancel() {
                    var cancelOrderModal = new bootstrap.Modal(document.getElementById('cancelOrderModal'));
                    cancelOrderModal.show();
                }

                document.querySelectorAll('input[name="cancel_reason"]').forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        var otherReasonContainer = document.getElementById('otherReasonContainer');
                        otherReasonContainer.style.display = (this.value === 'other') ? 'block' : 'none';
                    });
                });

                document.getElementById('confirmCancelBtn').addEventListener('click', function() {
                    var form = document.getElementById('cancelOrderReasonForm');
                    var errorCancelReason = document.getElementById('error_cancel_reason');
                    var errorOtherReason = document.getElementById('error_other_reason');
                    var selectedReason = document.querySelector('input[name="cancel_reason"]:checked');

                    if (!selectedReason) {
                        errorCancelReason.innerHTML = 'Please select a reason for cancellation';
                        errorCancelReason.style.display = 'block';
                        return;
                    } else {
                        errorCancelReason.innerHTML = '';
                        errorCancelReason.style.display = 'none';
                    }

                    if (selectedReason.value === 'other') {
                        var otherReasonText = document.getElementById('otherReason').value.trim();

                        if (!otherReasonText) {
                            errorOtherReason.innerHTML = 'Please enter reason for cancellation!';
                            errorOtherReason.style.display = 'block';
                            return;
                        }
                    }
                    form.submit();
                });

            </script>

@endsection
