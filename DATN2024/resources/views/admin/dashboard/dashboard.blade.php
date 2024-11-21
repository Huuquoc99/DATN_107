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
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Earnings</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        <span>{{ number_format($totalEarnings, 0, ',', '.') }} VND</span>
                                    </h4>
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
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        <span>
                                            {{ $totalOrders }}
                                        </span>
                                    </h4>
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
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        <span>{{$totalCustomers}}</span>
                                    </h4>
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Products</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        <span>{{$totalProducts}}</span>
                                    </h4>
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
                            
                        </div>

                        <div class="card-header p-0 border-0 bg-light-subtle">
                            <div class="border border-dashed border-start-0">
                                <div class="d-flex justify-content-center align-items-center" style="height: 100%; min-height: 100px;">
                                    <form action="{{ route('admin.dashboard') }}" method="GET" class="row g-3 align-items-center">
                                        <div class="col-auto">
                                            <label for="start_date" class="form-label mb-0">Start Date:</label>
                                            <input type="date" id="start_date" name="start_date" 
                                                class="form-control" style="width: 200px" value="{{ request('start_date') }}">
                                        </div>
                                        <div class="col-auto">
                                            <label for="end_date" class="form-label mb-0">End Date:</label>
                                            <input type="date" id="end_date" name="end_date" 
                                                class="form-control" style="width: 200px" value="{{ request('end_date') }}">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary mt-3" style="width: 100px">Filter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="card-body pt-3 pb-3 d-flex justify-content-center align-items-center">
                            <div style="width:80%" >
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1"> Top Sellers</h4>
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
                            <h4 class="card-title mb-0 flex-grow-1">Recent Orders</h4>
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
    {{-- <script>
        const labels = @json($statistics->pluck('month_year')); 
        const data = @json($statistics->pluck('total_quantity_sold')); 
        const revenueData = @json($statistics->pluck('total_revenue')); 

        const config = {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Number of products sold',
                        data: data,
                        borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                    },
                    {
                        label: 'Revenue',
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

        new Chart(document.getElementById('myChart'), config);
    </script> --}}

    <script>
        const labels = @json($statistics->pluck('month_year')); 
        const data = @json($statistics->pluck('total_quantity_sold')); 
        const revenueData = @json($statistics->pluck('total_revenue')); 

        const config = {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Number of products sold',
                        data: data,
                        borderColor: '#9ba4c1', 
                        backgroundColor: '#45558c', 
                        borderWidth: 1,
                        fill: false, 
                        type: 'bar', 
                    },
                    {
                        label: 'Revenue', 
                        data: revenueData,
                        borderColor: 'rgb(255, 99, 132)', 
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', 
                        fill: false, 
                        type: 'line', 
                        borderWidth: 2, 
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
                plugins: {
                    legend: {
                        position: 'bottom', 
                        labels: {
                            padding: 50,
                            boxWidth: 30, 
                        },
                    },
                },
            },
        };

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

            for (var i = (page - 1) * records_per_page; i < (page * records_per_page) && i < topProducts.length; i++) {
                var product = topProducts[i];
                var productImage = product.img_thumbnail ? product.img_thumbnail : '/theme/admin/assets/images/default-avatar.png';
                listing_table_body.innerHTML += `
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-light rounded p-1 me-2">
                                <img src="${productImage}" alt="Product Image" class="img-fluid d-block" />
                            </div>
                           
                            <div>
                                <h5 class="fs-14 my-1">
                                    <a href="/admin/products/${product.id}" class="text-reset">
                                        ${product.name.length > 15 ? product.name.substring(0, 15) + "..." : product.name}
                                    </a>
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
                var avatars = customer.avatar ? customer.avatar : '/theme/admin/assets/images/default-avatar.png';
                listing_table_body.innerHTML += `
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <img src="${avatars}" alt="" class="avatar-sm p-2" />
                            </div>
                            <div>
                                <h5 class="fs-14 my-1">
                                    <a href="/admin/customers/${customer.id}" class="text-reset">
                                        ${customer.name.length > 15 ? customer.name.substring(0, 20) + "..." : customer.name}
                                    </a>
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
