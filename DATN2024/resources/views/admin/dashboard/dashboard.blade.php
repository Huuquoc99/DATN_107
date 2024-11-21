@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col">

        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            @php
                                $hour = now()->format('H'); // Lấy giờ hiện tại (24 giờ)
                                if ($hour < 12) {
                                    $greeting = 'Good Morning';
                                } elseif ($hour < 18) {
                                    $greeting = 'Good Afternoon';
                                } else {
                                    $greeting = 'Good Evening';
                                }
                            @endphp

                            <h4 class="fs-16 mb-1">{{ $greeting }}, {{ \Illuminate\Support\Str::limit(Auth::user()->name, 12, '...') }}!</h4>

                            {{-- <h4 class="fs-16 mb-1">Good Morning, Anna!</h4> --}}
                            <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total Earnings</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-14 mb-0">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="559.25">0</span>k </h4>
                                    <a href="" class="text-decoration-underline">View net earnings</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Earnings</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-14 mb-0">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        $<span class="counter-value">{{ number_format($totalEarnings, 2) }}</span>
                                    </h4>
                                    <a href="" class="text-decoration-underline">View net earnings</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success-subtle rounded fs-3">
                                        <i class="bx bx-dollar-circle text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Orders</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-danger fs-14 mb-0">
                                        <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="36894">0</span></h4>
                                    <a href="" class="text-decoration-underline">View all orders</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle rounded fs-3">
                                            <i class="bx bx-shopping-bag text-info"></i>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Customers</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-14 mb-0">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +29.08 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="183.35">0</span>M </h4>
                                    <a href="" class="text-decoration-underline">See details</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                            <i class="bx bx-user-circle text-warning"></i>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> My Balance</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-muted fs-14 mb-0">
                                        +0.00 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="165.89">0</span>k </h4>
                                    <a href="" class="text-decoration-underline">Withdraw money</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-wallet text-primary"></i>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                            <form action="{{ route('admin.dashboard') }}" method="GET">
                                <label for="start_date">Start Date:</label>
                                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">

                                <label for="end_date">End Date:</label>
                                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">

                                <button type="submit">Filter</button>
                            </form>
                        </div>

                        <div class="card-header p-0 border-0 bg-light-subtle">
                            <div class="row g-0 text-center">
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1"><span class="counter-value" data-target="7585">0</span></h5>
                                        <p class="text-muted mb-0">Orders</p>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1">$<span class="counter-value" data-target="22.89">0</span>k</h5>
                                        <p class="text-muted mb-0">Earnings</p>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1"><span class="counter-value" data-target="367">0</span></h5>
                                        <p class="text-muted mb-0">Refunds</p>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0 border-end-0">
                                        <h5 class="mb-1 text-success"><span class="counter-value" data-target="18.92">0</span>%</h5>
                                        <p class="text-muted mb-0">Conversation Ratio</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0 pb-2">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Sales by Locations</h4>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-soft-primary btn-sm">
                                    Export Report
                                </button>
                            </div>
                        </div>

                        <div class="card-body">

                            <div id="sales-by-locations" data-colors='["--vz-light", "--vz-success", "--vz-primary"]' style="height: 269px" dir="ltr"></div>

                            <div class="px-2 py-2 mt-1">
                                <p class="mb-1">Canada <span class="float-end">75%</span></p>
                                <div class="progress mt-2" style="height: 6px;">
                                    <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="75"></div>
                                </div>

                                <p class="mt-3 mb-1">Greenland <span class="float-end">47%</span>
                                </p>
                                <div class="progress mt-2" style="height: 6px;">
                                    <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 47%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="47"></div>
                                </div>

                                <p class="mt-3 mb-1">Russia <span class="float-end">82%</span></p>
                                <div class="progress mt-2" style="height: 6px;">
                                    <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="82"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Best Selling Products</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                    <tbody id="productTableBody">

                                    </tbody>
                                </table>


                            </div>
                            <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                <div class="col-sm">
                                    <div class="text-muted">
                                        Showing <span class="fw-semibold">5</span> of <span class="fw-semibold">25</span> Results
                                    </div>
                                </div>
                                <div class="col-sm-auto  mt-3 mt-sm-0">
                                    <ul class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                        <li class="page-item">
                                            <a href="javascript:prevPageProduct()" id="btn_prev" class="page-link">←</a>
                                        </li>
                                        <li class="page-item">
                                            <span id="page" class="page-link"></span>
                                        </li>
                                        <li class="page-item">
                                            <a href="javascript:nextPageProduct()" id="btn_next" class="page-link">→</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Top Sellers</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                                    <tbody id="customerTableBody">

                                    </tbody>
                                </table>
                            </div>

                            <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                <div class="col-sm-auto  mt-3 mt-sm-0">
                                    <ul class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                        <li class="page-item disabled">
                                            <a href="javascript:prevPageCustomer()" id="btn_prev1" class="page-link">←</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link"><span id="page1"></span>
                                            </a>
                                        </li>
                                        <li class="page-item">
                                            <a id="btn_next1" href="javascript:prevPageCustomer()" class="page-link">→</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div> 
                </div>
            </div> 

            <div class="row">
                <div class="col-xl-4">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Store Visits by Source</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Download Report</a>
                                        <a class="dropdown-item" href="#">Export</a>
                                        <a class="dropdown-item" href="#">Import</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div id="store-visits-source" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div> 
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Recent Orders</h4>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-soft-info btn-sm">
                                    <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Vendor</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Rating</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#VZ2112</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Alex Smith</div>
                                            </div>
                                        </td>
                                        <td>Clothes</td>
                                        <td>
                                            <span class="text-success">$109.00</span>
                                        </td>
                                        <td>Zoetic Fashion</td>
                                        <td>
                                            <span class="badge bg-success-subtle text-success">Paid</span>
                                        </td>
                                        <td>
                                            <h5 class="fs-14 fw-medium mb-0">5.0<span class="text-muted fs-11 ms-1">(61 votes)</span></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#VZ2111</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Jansh Brown</div>
                                            </div>
                                        </td>
                                        <td>Kitchen Storage</td>
                                        <td>
                                            <span class="text-success">$149.00</span>
                                        </td>
                                        <td>Micro Design</td>
                                        <td>
                                            <span class="badge bg-warning-subtle text-warning">Pending</span>
                                        </td>
                                        <td>
                                            <h5 class="fs-14 fw-medium mb-0">4.5<span class="text-muted fs-11 ms-1">(61 votes)</span></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#VZ2109</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Ayaan Bowen</div>
                                            </div>
                                        </td>
                                        <td>Bike Accessories</td>
                                        <td>
                                            <span class="text-success">$215.00</span>
                                        </td>
                                        <td>Nesta Technologies</td>
                                        <td>
                                            <span class="badge bg-success-subtle text-success">Paid</span>
                                        </td>
                                        <td>
                                            <h5 class="fs-14 fw-medium mb-0">4.9<span class="text-muted fs-11 ms-1">(89 votes)</span></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#VZ2108</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Prezy Mark</div>
                                            </div>
                                        </td>
                                        <td>Furniture</td>
                                        <td>
                                            <span class="text-success">$199.00</span>
                                        </td>
                                        <td>Syntyce Solutions</td>
                                        <td>
                                            <span class="badge bg-danger-subtle text-danger">Unpaid</span>
                                        </td>
                                        <td>
                                            <h5 class="fs-14 fw-medium mb-0">4.3<span class="text-muted fs-11 ms-1">(47 votes)</span></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">#VZ2107</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Vihan Hudda</div>
                                            </div>
                                        </td>
                                        <td>Bags and Wallets</td>
                                        <td>
                                            <span class="text-success">$330.00</span>
                                        </td>
                                        <td>iTest Factory</td>
                                        <td>
                                            <span class="badge bg-success-subtle text-success">Paid</span>
                                        </td>
                                        <td>
                                            <h5 class="fs-14 fw-medium mb-0">4.7<span class="text-muted fs-11 ms-1">(161 votes)</span></h5>
                                        </td>
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
</div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Dữ liệu từ controller (đã được chuyển sang JSON)
        const labels = @json($statistics->pluck('month_year')); // Lấy tháng/năm
        const data = @json($statistics->pluck('total_quantity_sold')); // Lấy số lượng bán ra
        const revenueData = @json($statistics->pluck('total_revenue')); // Lấy doanh thu

        const config = {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Số lượng sản phẩm đã bán',
                        data: data,
                        borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                    },
                    {
                        label: 'Doanh thu',
                        data: revenueData,
                        borderColor: 'rgb(255, 99, 132)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true,
                    },
                ],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        };

        // Khởi tạo biểu đồ
        new Chart(document.getElementById('myChart'), config);
    </script>
    <script>
        var topProducts = @json($topProducts);
        var topCustomers = @json($topCustomers);
        console.log(topProducts);
        console.log(topCustomers);
    </script>

    <script>
        var current_page_product = 1;
        var records_per_page = 5;

        var current_page_customer = 1;

        function prevPageProduct() {
            if (current_page_product > 1) {
                current_page_product--;
                changePageProduct(current_page_product);
            }
        }

        function nextPageProduct() {
            if (current_page_product < numPagesProduct()) {
                current_page_product++;
                changePageProduct(current_page_product);
            }
        }

        function changePageProduct(page) {
            var btn_next = document.getElementById("btn_next");
            var btn_prev = document.getElementById("btn_prev");
            var page_span = document.getElementById("page");
            var listing_table_body = document.getElementById("productTableBody");

            if (page < 1) page = 1;
            if (page > numPagesProduct()) page = numPagesProduct();

            listing_table_body.innerHTML = "";

            // Hiển thị dữ liệu của từng sản phẩm
            for (var i = (page - 1) * records_per_page; i < (page * records_per_page) && i < topProducts.length; i++) {
                var product = topProducts[i];
                listing_table_body.innerHTML += `
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-light rounded p-1 me-2">
                                <img src="${product.img_thumbnail}" alt="" class="img-fluid d-block" />
                            </div>
                            <div>
                                <h5 class="fs-14 my-1">
                                    <a href="apps-ecommerce-product-details.html" class="text-reset">${product.name}</a>
                                </h5>
                                <span class="text-muted">${new Date(product.created_at).toLocaleDateString()}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <h5 class="fs-14 my-1 fw-normal">${product.price_regular}</h5>
                        <span class="text-muted">Price</span>
                    </td>
                    <td>
                        <h5 class="fs-14 my-1 fw-normal">${product.sku}</h5>
                        <span class="text-muted">SKU</span>
                    </td>
                    <td>
                        <h5 class="fs-14 my-1 fw-normal">${product.short_description}</h5>
                        <span class="text-muted">Short Description</span>
                    </td>
                </tr>
            `;
            }

            page_span.innerHTML = page;

            btn_prev.style.visibility = page == 1 ? "hidden" : "visible";
            btn_next.style.visibility = page == numPagesProduct() ? "hidden" : "visible";
        }

        function numPagesProduct() {
            return Math.ceil(topProducts.length / records_per_page);
        }

        // Customer Pagination
        function prevPageCustomer() {
            if (current_page_customer > 1) {
                current_page_customer--;
                changePageCustomer(current_page_customer);
            }
        }

        function nextPageCustomer() {
            if (current_page_customer < numPagesCustomer()) {
                current_page_customer++;
                changePageCustomer(current_page_customer);
            }
        }

        function changePageCustomer(page) {
            var btn_next1 = document.getElementById("btn_next1");
            var btn_prev1 = document.getElementById("btn_prev1");
            var page_span1 = document.getElementById("page1");
            var listing_table_body = document.getElementById("customerTableBody");

            if (page < 1) page = 1;
            if (page > numPagesCustomer()) page = numPagesCustomer();

            listing_table_body.innerHTML = "";

            // Hiển thị dữ liệu của từng khách hàng
            for (var i = (page - 1) * records_per_page; i < (page * records_per_page) && i < topCustomers.length; i++) {
                var customer = topCustomers[i];
                listing_table_body.innerHTML += `
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <img src="${customer.avatar}" alt="" class="avatar-sm p-2" />
                            </div>
                            <div>
                                <h5 class="fs-14 my-1">
                                    <a href="apps-ecommerce-customer-details.html" class="text-reset">${customer.name}</a>
                                </h5>
                                <span class="text-muted">${customer.email}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <h5 class="fs-14 my-1 fw-normal">${customer.total_orders}</h5>
                        <span class="text-muted">Orders</span>
                    </td>
                    <td>
                        <h5 class="fs-14 my-1 fw-normal">${customer.total_quantity_bought}</h5>
                        <span class="text-muted">Quantity</span>
                    </td>
                    <td>
                        <h5 class="fs-14 my-1 fw-normal">${customer.total_spent}</h5>
                        <span class="text-muted">Spent</span>
                    </td>
                </tr>
            `;
            }

            page_span1.innerHTML = page;

            btn_prev1.style.visibility = page == 1 ? "hidden" : "visible";
            btn_next1.style.visibility = page == numPagesCustomer() ? "hidden" : "visible";
        }

        function numPagesCustomer() {
            return Math.ceil(topCustomers.length / records_per_page);
        }

        // Hợp nhất code để chỉ có 1 window.onload
        window.onload = function() {
            changePageProduct(1);
            changePageCustomer(1);
        };
    </script>
@endsection

@section('script_libs')
    <script src="{{ asset('theme/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('theme/admin/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('theme/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('theme/admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
@endsection

@section('style_libs')
    <link href="{{ asset('theme/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('theme/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
