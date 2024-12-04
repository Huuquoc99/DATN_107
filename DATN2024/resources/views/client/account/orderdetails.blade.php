@extends('client.layouts.master')

@section('content')
<div class="mb-3 mb-xl-5 pb-3 pt-1 pb-xl-5"></div>

    <div class="my-account container">
        <h2 class="page-title pt-5 ">Order detail: {{ $order->code }}</h2>
    </div>
    <section class="my-account container">
        <h2 class="page-title pt-5">Order Details</h2>
        <div class="row">
            <div class="col-lg-4">
                <div class="info-box">
                    <h4>Order Information</h4>
                    <table class="info-table">
                        <tr>
                            <td><strong>Status order:</strong></td>
                            <td>
                                @if ($order->status_order_id == 1 || $order->status_order_id == 2)
                                    {{ $order->statusOrder->name ?? 'N/A' }}

{{--                                    <form action="{{ route('account.orders.cancel', $order->id) }}" method="POST" id="cancelOrderForm">--}}
{{--                                        @csrf--}}
{{--                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmCancel()">Cancel</button>--}}
{{--                                    </form>--}}

                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelOrderModal">Cancel</button>

                                    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true" >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="cancelOrderModalLabel">Cancel Order</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="cancelOrderReasonForm" action="{{ route('account.orders.cancel', $order->id) }}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label class="form-label">Reason for cancellation:</label>
                                                            <div class="list-group">
                                                                <label class="list-group-item">
                                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="changed_mind" required>
                                                                    Changed my mind
                                                                </label>
                                                                <label class="list-group-item">
                                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="found_cheaper">
                                                                    Found a cheaper option
                                                                </label>
                                                                <label class="list-group-item">
                                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="delivery_delay">
                                                                    Delivery is taking too long
                                                                </label>
                                                                <label class="list-group-item">
                                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="incorrect_item">
                                                                    Incorrect item details
                                                                </label>
                                                                <label class="list-group-item">
                                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="no_confirmation_email">
                                                                    Didn't receive a confirmation email
                                                                </label>
                                                                <label class="list-group-item">
                                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="cost_high">
                                                                    Shipping cost is too high
                                                                </label>
                                                                <label class="list-group-item">
                                                                    <input class="form-check-input me-1" type="radio" name="cancel_reason" value="other">
                                                                    Other
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
                                                            <label for="otherReason" class="form-label">Please specify your reason</label>
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
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-danger" id="confirmCancelBtn">Confirm Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                @elseif ($order->status_order_id == 3)
                                    {{ $order->statusOrder->name ?? 'N/A' }}
                                @elseif ($order->status_order_id == 4)
                                    {{ $order->statusOrder->name ?? 'N/A' }}
                                    <form action="{{ route('account.orders.markAsReceived', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm" onclick="confirmReceived()">Received</button>
                                    </form>
                                @elseif ($order->status_order_id == 5)
                                    <span class="text-success">Completed</span>
                                @elseif ($order->status_order_id == 6)
                                    <span class="text-danger">Canceled</span>
                                @else
                                    <span class="text-muted">Unknown</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Status payment:</strong></td>
                            <td>
                                {{ $order->statusPayment->name ?? 'N/A' }}
                                @if (($order->statusPayment->id == 1 || $order->statusPayment->id == 3) && $order->statusOrder->id == 1 && $order->paymentMethod->id == 2)
                                    <form action="{{ route('account.orders.repayment', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" name="redirect" class="btn btn-warning btn-sm">Repayment</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Payment method:</strong></td>
                            <td>{{ $order->paymentMethod->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total price:</strong></td>
                            <td>{{ number_format($order->total_price) }} VND</td>
                        </tr>
                        <tr>
                            <td><strong>Create at:</strong></td>
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
                    <h4>Order Items</h4>
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Capacity</th>
                                <th>Color</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->productVariant->price, 0) }} VND</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('orders.index') }}" class="btn btn-primary mt-3 mb-3">Back</a>
                </div>
            </div>
        </div>
    </section>
    <section class="my-account container">
        <h2 class="page-title pt-5">User Information</h2>
        <div class=" mb-xl-2 pb-3 pt-1 pb-xl-5"></div>
        <div class="row">
            <div class="col-lg-6">
                <div class="info-box">
                    <h4>User Information</h4>
                    <table class="info-table">
                        <tr>
                            <td><strong>Name:</strong></td>
                            <td>{{ $order->user_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>{{ $order->user_email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Phone:</strong></td>
                            <td>{{ $order->user_phone }}</td>
                        </tr>
                        <tr>
                            <td><strong>Address:</strong></td>
                            <td>{{ $order->user_address }}</td>
                        </tr>
                        <tr>
                            <td><strong>Note:</strong></td>
                            <td>{{ $order->user_note }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="info-box">
                    <h4>Shipping Information</h4>
                    <table class="info-table">
                        <tr>
                            <td><strong>Name:</strong></td>
                            <td>{{ $order->ship_user_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>{{ $order->ship_user_email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Phone:</strong></td>
                            <td>{{ $order->ship_user_phone }}</td>
                        </tr>
                        <tr>
                            <td><strong>Address:</strong></td>
                            <td>
                                {{ \Illuminate\Support\Str::limit($order->ship_user_address, 20, '...') }},
                                {{ \Illuminate\Support\Str::limit($order->shipping_ward, 20, '...') }},
                                {{ \Illuminate\Support\Str::limit($order->shipping_district, 20, '...') }},
                                {{ \Illuminate\Support\Str::limit($order->shipping_province, 20, '...') }},
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Note:</strong></td>
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
