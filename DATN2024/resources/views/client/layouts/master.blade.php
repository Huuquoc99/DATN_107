<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Home - Shoppe')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('client.layouts.partials.css')

</head>
<body class="!overflow-x-hidden" style="overflow-x: hidden">
    <header>
        <style>
            header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 1000;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                height: 150px;

            }


            body {
                padding-top: 60px;
            }
        </style>
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
{{-- <styl>
    body {
        transform: scale(0.8); 
        transform-origin: top center;
}
 </styl> --}}