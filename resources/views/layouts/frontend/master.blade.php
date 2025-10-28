<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='48' fill='%230e7490'/%3E%3Ctext x='50%25' y='60%25' dominant-baseline='middle' text-anchor='middle' font-size='55' font-weight='normal' font-family='Font Awesome 5 Free' fill='white'%3E%F0%9F%8C%8F%3C/text%3E%3C/svg%3E">
    <!-- تحميل الخط "Inter" (للحفاظ على المظهر العصري) -->
    @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])

    @yield('css')
</head>

<body>


    <!-- Navbar -->
    @include('layouts.frontend.inc.nav')


    <!-- Main content -->
    @yield('content')


    {{-- footer --}}
    @include('layouts.frontend.inc.footer')
    <script src="{{ asset('frontend/js/jquery-1.12.4.min.js') }}"></script>
    {{-- <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script> --}}

    <script>
        setTimeout(function () {
            $('#alert').fadeOut('fast');
        }, 6000);
    </script>


    @yield('scripts')
    @stack('scripts')

</body>

</html>