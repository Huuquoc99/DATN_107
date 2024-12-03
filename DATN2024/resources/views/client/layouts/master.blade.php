<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('client.layouts.partials.css')

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Đảm bảo body chiếm ít nhất 100% chiều cao của cửa sổ trình duyệt */
            padding-top: 15px; /* Để tránh nội dung bị che bởi header */
            overflow-x: hidden; /* Ẩn thanh cuộn ngang */
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            height: 150px;
        }

        section {
            flex: 1; /* Để phần nội dung chính lấp đầy không gian còn lại */
            padding: 20px; /* Thêm khoảng cách cho nội dung */
        }

        .site-footer {
            
            
            text-align: center; /* Canh giữa nội dung footer */
            
        }
    </style>
</head>
<body class="!overflow-x-hidden">
    <header>
        @include('client.layouts.partials.header')
    </header>
    <section>
        @yield('content')
    </section>

    <footer class="site-footer border-top">
        @include('client.layouts.partials.footer')
    </footer>

    @include('client.layouts.partials.js')
    @yield('script')
</body>
</html>