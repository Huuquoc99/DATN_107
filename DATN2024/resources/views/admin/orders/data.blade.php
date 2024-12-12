@if(!empty($orders))
    <div class="table-responsive table-card mb-1 text-center">
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
                <th class="sort" data-sort="id">Order</th>
                <th class="sort" data-sort="customer_name">Khách hàng</th>
                <th class="sort" data-sort="date">Ngày đặt hàng</th>
                <th class="sort" data-sort="payment">Phương thức thanh toán</th>
                <th class="sort" data-sort="status">Trạng thái thanh toán</th>
                <th class="sort" data-sort="status">Trạng thái đơn hàng</th>
                <th class="sort" data-sort="amount">Tổng tiền</th>
                <th class="sort" data-sort="city">Hành động</th>
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
                    <td class="customer_name">
                        <a href="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{ $order->user?->name ?? 'Guest' }}">
                            {{ $order->user ? \Illuminate\Support\Str::limit($order->user->name, 15, '...') : 'Guest' }}
                        </a>
                        
                    </td>
                    <td class="date">
                        <span id="invoice-date">{{ $order->created_at->format('d M, Y') }}</span>
                        <small class="text-muted" id="invoice-time">{{ $order->created_at->format('h:iA') }}</small>
                    </td>
                    <td class="payment">
                        @if ($order->payment_method_id == 1)
                            <span class="badge bg-warning-subtle text-warning text-uppercase">{{ $order->paymentMethod?->name }}</span>
                        @elseif ($order->status_payment_id == 2)
                            <span class="badge bg-success-subtle text-success text-uppercase">{{ $order->paymentMethod?->name }}</span>
                        @else
                            <span class="badge bg-info-subtle text-info text-uppercase">{{ $order->paymentMethod?->name }}</span>
                        @endif
                    </td>
                    
                    <td class="status">
                        @if ($order->status_payment_id == 1)
                            <span class="badge bg-warning-subtle text-warning text-uppercase">{{ $order->statusPayment?->name }}</span>
                        @elseif ($order->status_payment_id == 2)
                            <span class="badge bg-success-subtle text-success text-uppercase">{{ $order->statusPayment?->name }}</span>
                        @else
                            <span class="badge bg-info-subtle text-info text-uppercase">{{ $order->statusPayment?->name }}</span>
                        @endif
                    </td>
                    <td class="status">
                        @if ($order->status_order_id == 1 || $order->status_order_id == 2)
                            <span class="badge bg-warning-subtle text-warning text-uppercase">{{ $order->statusOrder?->name }}</span>
                        @elseif ($order->status_order_id == 3)
                            <span class="badge bg-secondary-subtle text-secondary text-uppercase">{{ $order->statusOrder?->name }}</span>
                        @elseif ($order->status_order_id == 4)
                            <span class="badge bg-success-subtle text-success text-uppercase">{{ $order->statusOrder?->name }}</span>
                        @elseif ($order->status_order_id == 5)
                            <span class="badge bg-danger-subtle text-danger text-uppercase"> {{ $order->statusOrder?->name }}</span>
                        @else
                            <span class="badge bg-info-subtle text-info text-uppercase">{{ $order->statusOrder?->name }}</span>
                        @endif
                    </td>
                    <td class="amount">{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                    <td>
                        <ul class="list-inline hstack gap-2 mb-0">
                            <li class="list-inline-item" style="padding-left: 45px" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
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
    </div>
    <div class="d-flex justify-content-between">
        <div>
            <p>Hiển thị từ {{ $orders->firstItem() }} đến {{ $orders->lastItem() }} trong tổng số {{ $orders->total() }} đơn hàng</p>
        </div>
        <div>
            {!! $orders->withQueryString()->links() !!}
        </div>
    </div>
@else
    <div class="noresult">
        <div class="text-center">
            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
            <h5 class="mt-2">Xin lỗi! Không tìm thấy kết quả</h5>
            <p class="text-muted">Chúng tôi đã tìm kiếm nhưng chúng tôi không tìm thấy bất kỳ đơn hàng nào cho bạn tìm kiếm.</p>
        </div>
    </div>
@endif
