<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <div class="navbar-brand-box horizontal-logo">
                    <a href="#" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('theme/admin/assets/images/tech-store-logo') }}" alt=""
                                 height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('theme/admin/assets/images/tech-store-logo') }}" alt=""
                                 height="17">
                        </span>
                    </a>

                    <a href="#" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('theme/admin/assets/images/tech-store-logo') }}" alt=""
                                 height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('theme/admin/assets/images/tech-store-logo') }}" alt=""
                                 height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                        id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                            id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                         aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..."
                                           aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                            data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                            class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-bell fs-22'></i>
                        <span
                            class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger count-noti">{{\App\Models\AdminNotification::unread()->count()}}</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                         aria-labelledby="page-header-notifications-dropdown" id="notification-content">

                        <div class="notification-actions" id="notification-actions">
                            <div class="d-flex text-muted justify-content-center">
                                Select <div id="select-content" class="text-body fw-semibold px-1">0</div> Result
                                <button type="button" class="btn btn-link link-danger p-0 ms-3"
                                        id="removeNotificationModal"
                                        data-bs-toggle="modal"
                                        data-bs-target="#removeNotificationModal">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
                @auth
                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                @if (Auth::user()->avatar)
                                    <img class="rounded-circle header-profile-user"
                                         src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Header Avatar">
                                @else
                                    <img src="{{ asset('theme/admin/assets/images/default-avatar.png') }}"
                                        class="rounded-circle header-profile-user"
                                        alt="user-profile-image">
                                @endif
                                <span class="text-start ms-xl-2">
                                    <span
                                        class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ \Illuminate\Support\Str::limit(Auth::user()->name, 12, '...') }}
                                    </span>
                                    <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{ Auth::user()->type == 1 ? 'Admin' : 'User' }}</span>
                                </span>
                            </span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end">
                            <h6 class="dropdown-header">Xin chào, {{ \Illuminate\Support\Str::limit(Auth::user()->name, 12, '...') }}!</h6>
                            <a class="dropdown-item"
                               href="{{ route('admin.account.edit', ['id' => Auth::user()->id]) }}">
                                <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Hồ sơ</span>
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>

                            <a class="dropdown-item" href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle" data-key="t-logout">Đăng xuất</span>
                            </a>
                        </div>
                        @endauth
                    </div>
            </div>
        </div>
    </div>
</header>
