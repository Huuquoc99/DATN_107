<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <head>
        <meta charset="utf-8"/>
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @yield('style-libs')
        <!-- Layout config Js -->
        <script src="{{ asset('theme/admin/assets/js/layout.js') }}"></script>
        <!-- Bootstrap Css -->
        <link href="{{ asset('theme/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <!-- Icons Css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link href="{{ asset('theme/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
        <!-- App Css-->
        <link href="{{ asset('theme/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css"/>
        <!-- custom Css-->
        <link href="{{ asset('theme/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css"/>

        <!--datatable css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
        <!--datatable responsive css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>

        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        @yield('styles')

    </head>

<body>

<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4 auth-one-bg h-100">
                                    <div class="bg-overlay"></div>
                                    <div class="position-relative h-100 d-flex flex-column">
                                        <div class="mb-4">
                                            <a href="{{ route("admin.login")}}" class="d-block">
                                                <img src="{{ asset('theme/admin/assets/images/tech-store-logo.png') }}" alt="" height="30">
                                            </a>
                                        </div>
                                        <div class="mt-auto">
                                            <img src="{{ asset('theme/admin/assets/images/login.png') }}" alt="" height="200px" style="padding-left: 130px">

                                            <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-indicators">
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                </div>
                                                <div class="carousel-inner text-center text-white-50 pb-5">
                                                    <div class="carousel-item active">
                                                        <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <p class="fs-15 fst-italic">" The theme is really great with an amazing customer support."</p>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4">
                                    <div>
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p class="text-muted">Sign in to continue to TechStore.</p>
                                    </div>

                                    <div class="mt-4">
                                        
                                        <form action="{{ route('admin.login') }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control mb-3 @error('email') is-invalid @enderror" id="email" placeholder="Enter email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                                
                                            <div class="mb-3">
                                                
                                                <label class="form-label" for="password-input">Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" name="password" class="form-control pe-5 password-input mb-3 @error('password') is-invalid @enderror" placeholder="Enter password" id="password-input" >
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                                <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                                <div class="float-end">
                                                    <a href="{{ route('admin.password.request') }}" class="text-muted" style="text-decoration: underline;">Forgot password?</a>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                            </div>
                                        </form>
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
                            <script>document.write(new Date().getFullYear())</script> TechStore. Crafted with <i class="mdi mdi-heart text-danger"></i> by TechStore
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('theme/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('theme/admin/assets/js/plugins.js') }}"></script>
<script src="{{ asset('theme/admin/assets/js/database-table.js') }}"></script>
<script src="{{ asset('theme/admin/assets/js/product-galleries.js') }}"></script>
<script src="{{ asset('theme/admin/assets/js/product.js') }}"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

@yield('script-libs')

<!-- App js -->
<script src="{{ asset('theme/admin/assets/js/app.js') }}"></script>
</body>

</html>
