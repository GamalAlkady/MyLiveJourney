<!DOCTYPE html>
<html lang="{{ app('laravellocalization')->getCurrentLocale() }}"
    dir="{{ app('laravellocalization')->getCurrentLocaleDirection() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @hasSection('title')
            @yield('title') |
        @endif {{ config('app.name', Lang::get('titles.app')) }}
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="shortcut icon" href="/favicon.ico">
    {{-- <link rel="preconnect" href="https://fonts.bunny.net"> --}}
    {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

    <link rel="stylesheet" href="{{ asset('backend/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="shortcut icon" href="/favicon.ico">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    {{-- <link rel="preconnect" href="https://fonts.bunny.net"> --}}
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])

    @if (app('laravellocalization')->getCurrentLocaleDirection() == 'rtl')
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css"
            integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
    @endif
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    @yield('css')
    @stack('css')
    <style type="text/css">
        .help-block {
            color: rgb(247, 100, 100);
            margin-inline-start: 5px;
        }

        body {
            font-family: 'Tahoma', sans-serif;
        }
    </style>
    @if (Auth::User() && Auth::User()->profile && Auth::User()->profile->avatar_status == 0)
        <style type="text/css">
            .user-avatar-nav {
                background: url({{ Gravatar::get(Auth::user()->email) }}) 50% 50% no-repeat;
                background-size: auto 100%;
                width: 35px;
                height: 35px;
            }
        </style>
    @endif


    {{-- Scripts --}}
    {{-- <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script> --}}
    @if (Auth::User() && Auth::User()->profile && $theme->link != null && $theme->link != 'null')
        <link rel="stylesheet" type="text/css" href="{{ $theme->link }}">
    @endif
</head>


<body class="hold-transition sidebar-mini layout-fixed"
    dir="{{ app('laravellocalization')->getCurrentLocaleDirection() }}">
    <div class="wrapper" id="app">

        <!-- Navbar -->
        @include('layouts.backend.inc.nav')
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('layouts.backend.inc.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper bg-transparent">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mt-3">
                        @include('partials.successMessage')
                    </div>
                </div>
            </div>
            <!-- Main content -->

            <div class="container-fluid py-4 mt-3 px-4">

                @yield('content')

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


    <x-a-i-assistant />
    @stack('modals')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            var sidebarState = localStorage.getItem('sidebarState');
            if (sidebarState === 'true' && window.matchMedia('(min-width: 768px)').matches == true) {
                $('body').addClass('sidebar-collapse');
            }
        })

        $('#toggleSidebar,.overlay').click(function() {
            if (window.matchMedia('(min-width: 768px)').matches == true) {
                $('body').toggleClass('sidebar-collapse');
                $('.main-sidebar,.main-header,.content-wrapper').attr('style',
                    'transition: all 0.3s ease-in-out !important;');

                localStorage.setItem('sidebarState', $('body').hasClass('sidebar-collapse'));
            }
            else{
                $('.main-sidebar').toggleClass('sidebar-open');
                $('.overlay').toggleClass('open');
            }

        })
    </script>
    @yield('scripts')
    @stack('scripts')

</body>

</html>
