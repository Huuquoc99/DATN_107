<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Home - Shoppe')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('client.layouts.partials.css')

</head>
<body>
    @include('client.layouts.partials.header')
    @include('client.layouts.partials.banner')

    @yield('content')

    <footer class="site-footer border-top">
        @include('client.layouts.partials.footer')
    </footer>


@include('client.layouts.partials.js')

</body>
</html>