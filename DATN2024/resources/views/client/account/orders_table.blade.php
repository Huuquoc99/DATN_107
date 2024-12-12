@if (isset($message))
    <p class="text-center text-muted">{{ $message }}</p>
@else
    <table class="orders-table">
        <thead>
        <tr>
            <th>Đơn hàng</th>
            <th>Ngày</th>
            <th>Trạng thái</th>
            <th>Tổng cộng</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($orders as $order)
            <tr>
                <td>{{ $order['code'] }}</td>
                <td>
                    <span id="invoice-date">{{ $order['created_at'] ? $order['created_at']->format('d M, Y') : 'N/A' }}</span>
                    <small class="text-muted" id="invoice-time">{{ $order['created_at'] ? $order['created_at']->format('h:iA') : '' }}</small>
                </td>
                <td>
                    @switch($order['status_order_id'])
                        @case(1)
                            <span class="badge bg-warning text-dark">{{ $order['status_order_name'] }}</span>
                            @break
                        @case(2)
                            <span class="badge bg-primary">{{ $order['status_order_name'] }}</span>
                            @break
                        @case(3)
                            <span class="badge bg-success text-dark">{{ $order['status_order_name'] }}</span>
                            @break
                        @default
                            <span class="badge bg-secondary text-dark">{{ $order['status_order_name'] }}</span>
                    @endswitch
                </td>
                <td>{{ number_format($order['total_price']) }} VND</td>
                <td><a href="{{ route('account.orders.show', $order['id']) }}" class="btn btn-primary">XEM</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Bạn chưa có đơn hàng nào.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="pagination-container">
        {{ $orders->links() }}
    </div>
@endif
