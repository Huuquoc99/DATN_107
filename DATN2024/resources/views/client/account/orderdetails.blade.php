@extends('client.layouts.master')

@section('content')

<div class="mb-3 mb-xl-5 pb-3 pt-1 pb-xl-5"></div>
    <section class="my-account container">
        @include('client.components.breadcrumb', [
              'breadcrumbs' => [
                  ['label' => 'Đơn hàng', 'url' => route('history')],
                  ['label' =>  $order->code, 'url' => null],
              ]
          ])
        <div class="row">
            <div class="col-lg-4">
                <div class="info-box">
                    <h4>Thông tin đặt hàng</h4>
                    <table class="info-table">
                        <tr>
                            <td><strong>Đơn hàng:</strong></td>
                            <td>
                                @if ($order->status_order_id == 1 || $order->status_order_id == 2)
                                    {{ $order->statusOrder->name ?? 'N/A' }}
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelOrderModal">Hủy đơn hàng</button>

                                    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true" >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="cancelOrderModalLabel">Hủy đơn hàng</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="cancelOrderReasonForm" action="{{ route('account.orders.cancel', $order->id) }}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label class="form-label">Lý do hủy bỏ:</label>
                                                            <div class="list-group">
                                                                <label class="list-group-item">
                                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="changed_mind" required>
                                                                    Tôi đã thay đổi ý định
                                                                </label>
                                                                <label class="list-group-item">
                                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="found_cheaper">
                                                                    Đã tìm thấy một lựa chọn rẻ hơn
                                                                </label>
                                                                <label class="list-group-item">
                                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="delivery_delay">
                                                                    Giao hàng mất quá nhiều thời gian
                                                                </label>
                                                                <label class="list-group-item">
                                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="incorrect_item">
                                                                    Chi tiết mặt hàng sai
                                                                </label>
                                                                <label class="list-group-item">
                                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="no_confirmation_email">
                                                                    Không nhận được email xác nhận
                                                                </label>
                                                                <label class="list-group-item">
                                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="cost_high">
                                                                    Chi phí vận chuyển quá cao
                                                                </label>
                                                                <label class="list-group-item">
                                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="other">
                                                                    Khác
                                                                </label>
                                                                <div class="text-primary mt-2" id="error_cancel_reason"></div>
                                                                @error('cancel_reason')
                                                                <div class="text-danger" id="error_cancel_reason">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="mb-3" id="otherReasonContainer" style="display: none;">
                                                            <label for="otherReason" class="form-label">Vui lòng nêu rõ lý do của bạn</label>
                                                            <textarea class="form-control" id="otherReason" name="other_reason" rows="3"></textarea>
                                                            @error('other_reason')
                                                            <div class="text-danger" id="error_other_reason">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                            <div class="text-primary mt-2" id="error_other_reason"></div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer mb-3 mx-4">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                    <button type="button" class="btn btn-danger" id="confirmCancelBtn">Xác nhận Hủy bỏ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @elseif ($order->status_order_id == 3)
                                    {{ $order->statusOrder->name ?? 'N/A' }}
                                @elseif ($order->status_order_id == 4)
                                    {{ $order->statusOrder->name ?? 'N/A' }}
                                    <form id="markAsReceivedForm" action="{{ route('account.orders.markAsReceived', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="button" class="btn btn-success btn-sm" onclick="confirmReceived(event)">Đã nhận</button>
                                    </form>

                                @elseif ($order->status_order_id == 5)
                                    <span class="text-success">Hoàn thành</span>
                                @elseif ($order->status_order_id == 6)
                                    <span class="text-danger">Đã hủy</span>
                                @else
                                    <span class="text-muted">Không rõ</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Trạng thái:</strong></td>
                            <td>
                                {{ $order->statusPayment->name ?? 'N/A' }}
                                @if (($order->statusPayment->id == 1 || $order->statusPayment->id == 3) && $order->statusOrder->id == 1 && $order->paymentMethod->id == 2)
                                    <form action="{{ route('account.orders.repayment', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" name="redirect" class="btn btn-warning btn-sm">Thanh toán lại</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Thanh toán:</strong></td>
                            <td>{{ $order->paymentMethod->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tổng giá:</strong></td>
                            <td>{{ number_format($order->total_price) }} VND</td>
                        </tr>
                        <tr>
                            <td><strong>Tạo vào lúc:</strong></td>
                            <td>
                                <span id="invoice-date">{{ $order->created_at->format('d M, Y') }}</span>
                                <small class="text-muted" id="invoice-time">{{ $order->created_at->format('h:iA') }}</small>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="info-box">
                    <h4>Đơn hàng</h4>
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Dung lượng</th>
                                <th>Màu sắc</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Tổng cộng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('product.detail', $item->productVariant->product->slug) }}">
                                            {{ $item->product_name }}
                                        </a>
                                    </td>
                                    <td>
                                        @if ($item->product_capacity_id)
                                            {{ $item->capacity->name ?? 'N/A' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->product_color_id)
                                            {{ $item->color->name ?? 'N/A' }}
                                        @endif
                                    </td>

                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->product_price_sale, 0, ',', '.') }} VND</td>

                                    @php
                                        $subTotal = $item->quantity * $item->productVariant->price
                                    @endphp
                                    <td>{{ number_format($subTotal, 0, ',', '.') }} VND</td>


                                </tr>

                            @endforeach
                        </tbody>
                    </table>
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
                                            -{{ number_format($order->voucher->discount, 0, '.', ',' ?? 0) }} VND
                                        </td>
                                       @endif
                                    </tr>
                                    <tr class="border-top border-top-dashed">
                                        <th scope="row">Tổng tiền:</th>
                                            <th class="text-end">
                                                {{ number_format($order->total_price, 0, '.', ',') }} VND
                                            </th>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <div class="d-flex justify-content-end gap-2 mt-3 mb-3">
                        <a href="{{ route('orders.index') }}" class="btn btn-primary">Quay lại</a>
                        <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#statusLogModal">
                            Xem lịch sử
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="statusLogModal" tabindex="-1" aria-labelledby="statusLogModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusLogModalLabel">Lịch sử trạng thái</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-primary table-hover">
                            <thead class="bg-gradient">
                            <tr>
                                <th>#</th>
                                <th>Thay đổi bởi</th>
                                <th>Quá trình</th>
                                <th>Ngày cập nhật</th>
                                <th>Lý do (nếu hủy)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $statusMap = [
                                    '1' => 'Chờ xử lý',
                                    '2' => 'Đã xác nhận',
                                    '3' => 'Đang giao hàng',
                                    '4' => 'Đã giao',
                                    '5' => 'Thành công',
                                    '6' => 'Hủy',
                                ];

                                $statusColors = [
                                    '1' => '#6c757d',
                                    '2' => '#007bff',
                                    '3' => '#17a2b8',
                                    '4' => '#3d3393  ',
                                    '5' => '#fa709a ',
                                    '6' => '#dc3545  ',
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

                            @foreach ($statusLogs as $log)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($log->changedBy)->name ?? 'N/A' }}</td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                        <span style="background-color: {{ $statusColors[$log->old_status] ?? '#000' }}; color: #fff; padding: 5px 10px; border-radius: 4px;">
                                            {{ $statusMap[$log->old_status] ?? 'Unknown' }}
                                        </span>
                                            <span style="font-weight: bold;">
                                            <i class="fa-solid fa-arrow-right fa-lg" style="color: #B197FC;"></i>
                                        </span>
                                            <span style="background-color: {{ $statusColors[$log->new_status] ?? '#000' }}; color: #fff; padding: 5px 10px; border-radius: 4px;">
                                            {{ $statusMap[$log->new_status] ?? 'Unknown' }}
                                        </span>
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($log->changed_at)->format('H:i, d/m/Y') }}</td>
                                    <td>
                                        @if ($log->new_status == 6)
                                            @php
                                                $cancelReason = $log->loggable ? $log->loggable->cancel_reason : '';
                                                $otherReason = $log->loggable ? $log->loggable->other_reason : '';
                                            @endphp

                                            @if ($cancelReason == 'other')
                                                <strong>{{ $otherReason ?? 'Khác' }}</strong>
                                            @else
                                                <strong>{{ $cancelReasons[$cancelReason] ?? 'N/A' }}</strong>
                                            @endif
                                        @else
                                            ---
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" style="margin: 20px;" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>



    </section>
    <section class="my-account container">
        <h6 class="page-title pt-5">Thông tin người dùng</h6>
        <div class=" mb-xl-2 pb-3 pt-1 pb-xl-5"></div>
        <div class="row">
            <div class="col-lg-6">
                <div class="info-box">
                    <h4>Thông tin người dùng</h4>
                    <table class="info-table">
                        <tr>
                            <td><strong>Tên:</strong></td>
                            <td>{{ $order->user_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>{{ $order->user_email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Số điện thoại:</strong></td>
                            <td>{{ $order->user_phone }}</td>
                        </tr>
                        <tr>
                            <td><strong>Địa chỉ:</strong></td>
                            <td>{{ $order->user_address }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ghi chú:</strong></td>
                            <td>{{ $order->user_note }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="info-box">
                    <h4>Thông tin vận chuyển</h4>
                    <table class="info-table">
                        <tr>
                            <td><strong>Tên:</strong></td>
                            <td>{{ $order->ship_user_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>{{ $order->ship_user_email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Số điện thoại:</strong></td>
                            <td>{{ $order->ship_user_phone }}</td>
                        </tr>
                        <tr>
                            <td><strong>Địa chỉ:</strong></td>
                            <td>
                                {{ \Illuminate\Support\Str::limit($order->ship_user_address, 20, '...') }},
                                {{ \Illuminate\Support\Str::limit($order->shipping_ward, 20, '...') }},
                                {{ \Illuminate\Support\Str::limit($order->shipping_district, 20, '...') }},
                                {{ \Illuminate\Support\Str::limit($order->shipping_province, 20, '...') }},
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Ghi chú:</strong></td>
                            <td>{{ $order->ship_user_note }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="mb-2 mb-xl-5 pb-3 pt-1 pb-xl-5"></div>
@endsection
@section('script')
    <script type="text/javascript">
        const orderId = {{ $order->id }};
        Pusher.logToConsole = true;
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        var channel = pusher.subscribe('channel-notification');
        channel.bind('update-order', function(data) {
            if (data.orderId == orderId) {
                location.reload();
            }
        });
    </script>
    <script>
        function confirmReceived(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Bạn chắc chắn chứ ?',
                text: 'Bạn có muốn xác nhận đã nhận đơn hàng này không ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Vâng, tôi đã nhận!',
                cancelButtonText: 'Chưa, tôi vẫn chưa nhận!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('markAsReceivedForm').submit();
                }
            });
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
