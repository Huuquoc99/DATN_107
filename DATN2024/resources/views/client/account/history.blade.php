@extends('client.layouts.master')
@section('title')
    TechStore
@endsection
@section('content')
    <main>
        <section class="my-account container">
            @include('client.components.breadcrumb', [
                'breadcrumbs' => [['label' => 'Đơn hàng', 'url' => null]],
            ])

            <div class="row">
                <div class="col-lg-2 shadow">
                    <ul class="account-nav">
                        <li><a href="{{ route('account.dashboard') }}" class="menu-link menu-link_us-s "
                                style="color: black">Bảng điều khiển</a></li>
                        <li><a href="{{ route('history') }}" class="menu-link menu-link_us-s menu-link_active"
                                style="color: black">Đơn hàng</a></li>
                        <li><a href="{{ route('favorites.list') }}" class="menu-link menu-link_us-s"
                                style="color: black">Danh sách yêu thích</a></li>
                        <li><a href="{{ route('accountdetail') }}" class="menu-link menu-link_us-s" style="color: black">Chi
                                tiết tài khoản</a></li>
                        <li><a href="{{ route('account.changePassword') }}" class="menu-link menu-link_us-s"
                                style="color: black">Thay đổi mật khẩu</a></li>
                    </ul>
                </div>
                {{-- dropdown --}}
                <div class="col-lg-10 shadow">
                    <div class="mb-3 d-flex justify-content-between">
                        <form id="searchFormOrder" action="{{ route('search_order') }}" method="post"
                            class="header-search search-field me-0 border-radius-10">
                            @csrf
                            <button class="btn header-search__btn" type="submit">
                                <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                            </button>
                            <input id="searchInputOrder" class="header-search__input" type="text" name="k"
                                placeholder="Tìm kiếm đơn hàng..." style="width: 360px">
                        </form>

                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle py-3" type="button" id="statusOrderDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Trạng thái đơn hàng
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="statusOrderDropdown">
                                <li>
                                    <a class="dropdown-item filter-status {{ request()->status_order == 'all' ? 'text-success' : '' }}"
                                        href="{{ route('search_order', ['status_order' => 'all']) }}">
                                        <i class="ri-store-2-fill me-1 align-bottom"></i> Tất cả
                                    </a>
                                </li>
                                @foreach ($statusOrders as $orderStatus)
                                    <li>
                                        <a class="dropdown-item filter-status {{ request()->status_order == $orderStatus->id ? 'text-success' : '' }}"
                                            href="{{ route('search_order', ['status_order' => $orderStatus->id]) }}">
                                            @switch($orderStatus->id)
                                                @case(1)
                                                    <i class="ri-time-line"></i> {{ $orderStatus->name }}
                                                @break

                                                @case(2)
                                                    <i class="ri-truck-line me-1 align-bottom"></i> {{ $orderStatus->name }}
                                                @break

                                                @case(3)
                                                    <i class="ri-checkbox-circle-line me-1 align-bottom"></i>
                                                    {{ $orderStatus->name }}
                                                @break

                                                @case(4)
                                                    <i class="ri-close-circle-line me-1 align-bottom"></i> {{ $orderStatus->name }}
                                                @break

                                                @default
                                                    <i class="ri-store-2-fill me-1 align-bottom"></i> {{ $orderStatus->name }}
                                            @endswitch
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="page-content my-account__orders-list" id="ordersList">
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
                                                <span
                                                    id="invoice-date">{{ $order['created_at'] ? $order['created_at']->format('d M, Y') : 'N/A' }}</span>
                                                <small class="text-muted"
                                                    id="invoice-time">{{ $order['created_at'] ? $order['created_at']->format('h:iA') : '' }}</small>
                                            </td>
                                            <td>
                                                @switch($order['status_order_id'])
                                                    @case(1)
                                                        <span
                                                            class="badge bg-warning text-dark">{{ $order['status_order_name'] }}</span>
                                                    @break

                                                    @case(2)
                                                        <span class="badge bg-primary">{{ $order['status_order_name'] }}</span>
                                                    @break

                                                    @case(3)
                                                        <span
                                                            class="badge bg-success text-dark">{{ $order['status_order_name'] }}</span>
                                                    @break

                                                    @default
                                                        <span
                                                            class="badge bg-secondary text-dark">{{ $order['status_order_name'] }}</span>
                                                @endswitch
                                            </td>
                                            <td>{{ number_format($order['total_price']) }} VND</td>
                                            <td><a href="{{ route('account.orders.show', $order['id']) }}"
                                                    class="btn btn-primary">XEM</a></td>
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
                        </div>
                    </div>

                </div>

                {{-- select --}}
                {{-- <div class="col-lg-10 shadow">
                    <div class="mb-3 d-flex justify-content-between">
                        <form id="searchFormOrder" action="{{ route('search_order') }}" method="post" class="header-search search-field me-0 border-radius-10">
                            @csrf
                            <button class="btn header-search__btn" type="submit">
                                <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                            </button>
                            <input id="searchInputOrder" class="header-search__input" type="text" name="k" placeholder="Tìm kiếm đơn hàng..." style="width: 360px">
                        </form>
                
                        <form action="{{ route('search_order') }}" method="get" class="d-inline">
                            <div class="form-group">
                                <select class="form-select py-3" name="status_order" onchange="this.form.submit()">
                                    <option value="all" {{ request()->status_order == 'all' ? 'selected' : '' }}>
                                        Tất cả
                                    </option>
                                    @foreach ($statusOrders as $orderStatus)
                                        <option value="{{ $orderStatus->id }}" {{ request()->status_order == $orderStatus->id ? 'selected' : '' }}>
                                            @switch($orderStatus->id)
                                                @case(1)
                                                    <i class="ri-time-line"></i> {{ $orderStatus->name }}
                                                    @break
                                                @case(2)
                                                    <i class="ri-truck-line me-1 align-bottom"></i> {{ $orderStatus->name }}
                                                    @break
                                                @case(3)
                                                    <i class="ri-checkbox-circle-line me-1 align-bottom"></i> {{ $orderStatus->name }}
                                                    @break
                                                @case(4)
                                                    <i class="ri-close-circle-line me-1 align-bottom"></i> {{ $orderStatus->name }}
                                                    @break
                                                @default
                                                    <i class="ri-store-2-fill me-1 align-bottom"></i> {{ $orderStatus->name }}
                                            @endswitch
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                
                    <div class="page-content my-account__orders-list" id="ordersList">
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
                    </div>
                </div> --}}
                
            </section>
        </main>
        <script>
            document.querySelectorAll('.filter-status').forEach(button => {
                button.addEventListener('click', function() {
                    const status = this.getAttribute('data-status');
                    const url = new URL(window.location.href);
                    url.searchParams.set('status_order', status);
                    window.location.href = url.toString();
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#searchFormOrder').on('submit', function(a) {
                    a.preventDefault();
                    const searchTerm = $('#searchInputOrder').val();

                    $.ajax({
                        url: "{{ route('search_order') }}",
                        method: 'POST',
                        data: {
                            k: searchTerm,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#ordersList').html(response.html);
                        },
                        error: function(xhr) {
                            console.error('Search failed:', xhr);
                            alert('Không thể tìm kiếm đơn hàng. Vui lòng thử lại.');
                        }
                    });
                });
            });
        </script>
    @endsection
