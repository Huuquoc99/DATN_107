<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>TechStore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('theme/admin/assets/images/favicon.ico')}}">

    <!-- Layout config Js -->
    <script src="{{ asset('theme/admin/assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('theme/admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('theme/admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('theme/admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('theme/admin/assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row justify-content-center g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="{{ route("admin.login")}}" class="d-block">
                                                    <img src="{{ asset('theme/admin/assets/images/tech-store-logo.png') }}" alt="" height="30">
                                                </a>
                                            </div>
                                            <div class="mt-5">
                                                <img src="{{ asset('theme/admin/assets/images/login.png') }}" alt="" height="200px" style="padding-left: 130px">

                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white-50 pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">" Tuyệt vời! Mã sạch, thiết kế sạch, dễ tùy chỉnh. Cảm ơn rất nhiều!"</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Chủ đề này thực sự tuyệt vời với dịch vụ hỗ trợ khách hàng tuyệt vời."</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Tuyệt vời! Mã sạch, thiết kế sạch, dễ tùy chỉnh. Cảm ơn rất nhiều!"</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-3">
                                        <h5 class="text-primary">Forgot Password?</h5>
                                        <p class="text-muted">Đặt lại mật khẩu</p>

                                        <div class="text-center">
                                            <lord-icon
                                                src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#516090" class="avatar-xl">
                                            </lord-icon>
                                        </div>

                                        <div class="alert border-0 alert-warning text-center mb-2 mx-2" role="alert">
                                            Nhập email của bạn và hướng dẫn sẽ được gửi đến bạn!
                                        </div>
                                        
                                        <div class="p-2">
                                            
                                            <form method="POST" action="{{ route('admin.password.email') }}">
                                                @csrf
                                                <div class="mb-4">
                                                    <label class="form-label" for="email">{{ __('Email') }}</label>
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
        

                                                <div class="text-center mt-4">
                                                    <button class="btn btn-primary w-100" type="submit">{{ __('Send Reset Link') }}</button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="mt-3 text-center">
                                            <p class="mb-0">Đợi đã, tôi nhớ ra mật khẩu của mình rồi... <a href="{{ route("admin.login")}}" class="fw-semibold text-primary text-decoration-underline"> Nhấp vào đây </a> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">&copy;
                                <script>document.write(new Date().getFullYear())</script> TechStore. Được chế tạo bởi <i class="mdi mdi-heart text-danger"></i>TechStore
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ asset('theme/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('theme/admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ asset('theme/admin/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{ asset('theme/admin/assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{ asset('theme/admin/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{ asset('theme/admin/assets/js/plugins.js')}}"></script>
</body>

</html>