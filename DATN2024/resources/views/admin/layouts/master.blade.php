<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8"/>
    <title>@yield('title')</title>
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
    <link href="{{ asset('theme/admin/assets/css/show-product.css') }}" rel="stylesheet" type="text/css"/>

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

<!-- Begin page -->
<div id="layout-wrapper">

    @include('admin.layouts.header');

    @include('admin.layouts.sidebar');

    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        @include('admin.layouts.footer');
    </div>
    <!-- end main content-->

</div>

<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>

<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<div class="customizer-setting d-none d-md-block">
    <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas"
         data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
        <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
    </div>
</div>

{{--<script>--}}
{{--    const PATH_ROOT = '{{ asset('theme/admin') }}';--}}
{{--</script>--}}
{{--<!-- JAVASCRIPT -->--}}

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
{{--<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>--}}
{{--<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>--}}

@yield('script-libs')

<!-- App js -->
<script src="{{ asset('theme/admin/assets/js/app.js') }}"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
        cluster: '{{env('PUSHER_APP_CLUSTER')}}'
    });
    console.log(123)
    var channel = pusher.subscribe('channel-notification');
    channel.bind('notification-admin', function(data) {
        console.log(1)
        console.log(data.count)
        $('.count-noti').html(data.count)
        getNoti()
    });
    $('#page-header-notifications-dropdown').click(function () {
        getNoti()
    })

    function getNoti(){
        console.log(12111)
        $.ajax({
            url: '{{route('admin.notification.index')}}',
            type: "get",
            datatype: "html",
            success: function (data) {
                $("#notification-content").html(data);
            }
        })
    }
</script>
@yield('scripts')
</body>

</html>
