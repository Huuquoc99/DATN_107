<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('theme/admin/assets/images/tech-store-logo.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('theme/admin/assets/images/tech-store-logo.png') }}" alt="" height="40px" width="50px">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('theme/admin/assets/images/tech-store-logo.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('theme/admin/assets/images/tech-store-logo.png') }}" alt="" height="40px" width="200px">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.dashboard') }}"
                       aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts9" data-bs-toggle="collapse" role="button"
                       aria-controls="sidebarLayouts">
                       <i class="ri-group-line"></i><span data-key="t-layouts">Quản lý người dùng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts9">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.customers.index') }}" class="nav-link">Danh sách người dùng</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button"
                       aria-controls="sidebarLayouts">
                       <i class="ri-layout-2-fill"></i> <span data-key="t-layouts">Quản lý danh mục</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.catalogues.index') }}" class="nav-link">Danh sách danh mục</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.catalogues.create') }}" class="nav-link">Thêm mới danh mục</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts2" data-bs-toggle="collapse" role="button"
                       aria-controls="sidebarLayouts">
                       <i class="ri-checkbox-multiple-blank-fill"></i> <span data-key="t-layouts">Quản lý sản phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts2">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.products.index') }}" class="nav-link">Danh sách sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.products.create') }}" class="nav-link">Thêm mới sản phẩm</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts14" data-bs-toggle="collapse" role="button"
                       aria-controls="sidebarLayouts">
                       <i class="ri-bookmark-line"></i> <span data-key="t-layouts">Quản lý tag</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts14">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.tags.index') }}" class="nav-link">Danh sách tag
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.tags.create') }}" class="nav-link">Thêm mới tag</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts13" data-bs-toggle="collapse" role="button"
                       aria-controls="sidebarLayouts">
                       <i class="ri-question-answer-line"></i><span data-key="t-layouts">Quản lý bình luận</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts13">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.comments.index') }}" class="nav-link">Danh sách bình luận</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts3" data-bs-toggle="collapse" role="button"
                       aria-controls="sidebarLayouts3">
                       <i class="ri-mist-fill"></i> <span data-key="t-layouts">Quản lý banner</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts3">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.banners.index') }}" class="nav-link">Danh sách banner</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.banners.create') }}" class="nav-link">Thêm mới banner</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts4" data-bs-toggle="collapse" role="button"
                       aria-controls="sidebarLayouts3">
                       <i class="ri-bank-card-fill"></i><span data-key="t-layouts">Phương thức thanh toán</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts4">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.paymentMethods.index') }}" class="nav-link">Danh sách</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.paymentMethods.create') }}" class="nav-link">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts5" data-bs-toggle="collapse" role="button"
                       aria-controls="sidebarLayouts3">
                       <i class="ri-sensor-fill"></i> <span data-key="t-layouts">Quản lý dung lượng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts5">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.productCapacities.index') }}" class="nav-link">Danh sách dung lượng</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.productCapacities.create') }}" class="nav-link">Thêm mới dung lượng</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts6" data-bs-toggle="collapse" role="button"
                       aria-controls="sidebarLayouts3">
                       <i class="ri-pantone-fill"></i>
                       <span data-key="t-layouts">Quản lý màu sắc</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts6">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.productColors.index') }}" class="nav-link">Danh sách màu sắc</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.productColors.create') }}" class="nav-link">Thêm mới màu sắc</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts7" data-bs-toggle="collapse" role="button"
                       aria-controls="sidebarLayouts3">
                       <i class="ri-bubble-chart-fill"></i> <span data-key="t-layouts">Trạng thái đơn hàng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts7">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.statusOrders.index') }}" class="nav-link">Danh sách</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.statusOrders.create') }}" class="nav-link">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts8" data-bs-toggle="collapse" role="button"
                       aria-controls="sidebarLayouts3">
                       <i class="ri-copper-coin-line"></i> <span data-key="t-layouts">Trạng thái thanh toán</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts8">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.statusPayments.index') }}" class="nav-link">Danh sách</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.statusPayments.create') }}" class="nav-link">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts11" data-bs-toggle="collapse" role="button"
                       aria-controls="sidebarLayouts3">
                       <i class="ri-shopping-cart-2-line"></i> <span data-key="t-layouts">Quản lý đơn hàng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts11">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index') }}" class="nav-link">Danh sách đơn hàng</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts12" data-bs-toggle="collapse" role="button"
                       aria-controls="sidebarLayouts3">
                       <i class="ri-file-text-line"></i> <span data-key="t-layouts">Quản lý hoá đơn</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts12">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.invoices.index') }}" class="nav-link">Danh sách hoá đơn</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarVoucher" data-bs-toggle="collapse" role="button"
                       aria-controls="sidebarLayouts3">
                        <i class="fas fa-ticket-alt"></i> <span data-key="t-layouts">Quản lý voucher</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarVoucher">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.vouchers.index') }}" class="nav-link">Danh sách voucher</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.vouchers.create') }}" class="nav-link">Thêm mới voucher</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts10" data-bs-toggle="collapse" role="button"
                       aria-controls="sidebarLayouts3">
                       <i class="ri-delete-bin-line"></i> <span data-key="t-layouts">Thùng rác</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts10">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.trashed') }}" class="nav-link">Thùng rác</a>
                            </li>
                        </ul>
                    </div>
                </li>

                


            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
