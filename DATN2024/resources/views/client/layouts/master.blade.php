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
    @include('client.layouts.partials.header')
    <section>
        @yield('content')
    </section>
    

    <footer class="site-footer border-top">
        @include('client.layouts.partials.footer')
    </footer>


@include('client.layouts.partials.js')

</body>
</html>
 {{-- <style>
    body {
        transform: scale(0.8); 
        transform-origin: top center;
}
 </style> --}}