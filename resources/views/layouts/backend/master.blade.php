<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@hasSection('title')@yield('title') | @endif {{ config('app.name', Lang::get('titles.app')) }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="shortcut icon" href="/favicon.ico">
    {{-- <link rel="preconnect" href="https://fonts.bunny.net"> --}}
    {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

    <link rel="stylesheet" href="{{ asset('backend/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="shortcut icon" href="/favicon.ico">
    {{-- <link rel="preconnect" href="https://fonts.bunny.net"> --}}
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @yield('css')
    <style type="text/css">
        .help-block {
            color: rgb(247, 100, 100);
            margin-inline-start: 5px;
        }


        @if (Auth::User() && Auth::User()->profile && Auth::User()->profile->avatar_status == 0)
            .user-avatar-nav {
                background: url({{ Gravatar::get(Auth::user()->email) }}) 50% 50% no-repeat;
                background-size: auto 100%;
            }
        @endif

    </style>

    {{-- Scripts --}}
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    @if (Auth::User() && Auth::User()->profile && $theme->link != null && $theme->link != 'null')
        <link rel="stylesheet" type="text/css" href="{{ $theme->link }}">
    @endif
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="app">

        <!-- Navbar -->
        @include('layouts.backend.inc.nav')
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('layouts.backend.inc.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-fluid mt-2">
                <div class="row">
                    <div class="col-12">
                        @include('partials.successMessage')
                    </div>
                </div>
            </div>
            <!-- Main content -->

            <div class="container-fluid">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Control Sidebar -->
        @include('layouts.backend.inc.control-sidebar')
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <script>
        setTimeout(function() {
            $('.alert').fadeOut('fast');
        }, 6000);
    </script>


    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')

</body>

</html>
