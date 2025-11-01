<style>
    .admin-tools .show {
        display: flex;
        flex-direction: column;
        align-items: start;
        margin-inline-start: 0.5rem;
    }

    .rotated {
        transform: rotate(180deg);
        transition: transform 0.25s ease;
    }

    .main-sidebar .nav-item {
        transition: width 0.3s ease-in-out !important;
        width: 250px;
        /* padding-left: 10px; */
    }

    .sidebar-collapse .main-sidebar .nav-item {
        width: 3.3rem;
    }

    .sidebar-collapse .main-sidebar:hover .nav-item {
        width: 250px;
    }

    .overlay {
        background: #0e100fab;
        position: fixed;
        z-index: 1000;
    }
</style>
<div class="overlay w-100 h-100 d-md-none"></div>
<aside class="main-sidebar elevation-4 bg-light" style="transition: all 0.3s ease-in-out !important;">
    <!-- Brand Logo -->
    <div class="pr-1 user-panel mt-3 pb-3 mb-1 d-flex align-items-center shadow" style="padding-inline-start: 0.25rem;">
        <div class="image">
            <a href="{{ url('/profile/' . Auth::user()->name) }}">
                @if (Auth::User()->profile && Auth::user()->profile->avatar_status == 1)
                    <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="user-avatar-nav">
                @else
                    <div class="user-avatar-nav"></div>
                @endif
                {{-- <img src="{{ Auth::user()->image != null ? asset('storage/profile_photo/' . Auth::user()->image) : asset('assets/admin/img/user2-160x160.jpg') }}" --}}
                {{-- class="img-circle elevation-2" alt="User Image"> --}}
            </a>

        </div>
        <div class="info">
            <a href="{{ route('home') }}" class="d-block font-weight-bold">{{ __('titles.home') }}</a>
        </div>
        {{-- <button class="btn btn-outline-light btn-sm rounded-circle ml-auto d-md-none" id="sidebarCollapse"><i class="fa fa-times text-danger"></i></button> --}}
    </div>


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                @php
                    // $role = auth()->user()->roles()->first()->slug;
                    $role = 'user';
                @endphp
                {{-- @dd($role) --}}
                <li class="nav-item has-treeview">
                    <a href="{{ route($role . '.dashboard') }}"
                        class="nav-link {{ Request::routeIs($role . '.dashboard') ? 'active' : '' }}">
                        {!! iconText('dashboard', class: 'fa-xl me-4') !!}
                    </a>
                </li>

                {{-- @permission('view.districts') --}}
                <div class="dropdown-divider"></div>
                <li class="nav-item has-treeview">
                    <a href="{{ route($role . '.districts.index') }}"
                        class="nav-link {{ Request::routeIs($role . '.districts.index') ? 'active' : '' }}">
                        {!! iconText(name: 'districts', class: 'fa-xl me-4') !!}
                    </a>
                </li>
                {{-- @endpermission --}}

                {{-- @permission('view.placetypes') --}}
                <li class="nav-item has-treeview">
                    <a href="{{ route($role . '.placetypes.index') }}"
                        class="nav-link {{ Request::routeIs($role . '.placetypes.*') ? 'active' : '' }}">
                        {!! iconText('placetypes', class: 'fa-xl me-4') !!}
                    </a>
                </li>
                {{-- @endpermission --}}

                <li class="nav-item has-treeview">
                    <a href="{{ route($role . '.places.index') }}"
                        class="nav-link {{ Request::routeIs($role . '.places.*') ? 'active' : '' }}">
                        {!! iconText('places', class: 'fa-xl me-4') !!}
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('user.tours.index') }}"
                        class="nav-link {{ Request::is('admin/tour*') ? 'active' : '' }}">
                        {!! iconText('tours', class: 'fa-xl me-4') !!}
                        {{-- {!! trans('titles.icon.tours') !!} --}}
                    </a>
                </li>
                {{--
                @role('admin')
                    <div class="dropdown-divider"></div>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('user.guides') }}"
                            class="nav-link {{ Request::is('user/guide*') ? 'active' : '' }}">
                            {!! trans('titles.icon.guides') !!}
                        </a>
                    </li>
                @endrole --}}

                @permission('view.users')
                    <div class="dropdown-divider"></div>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('user.users.index') }}"
                            class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                            {!! iconText('users', class: 'fa-xl me-4') !!}
                        </a>
                    </li>
                @endpermission


                <div class="dropdown-divider"></div>
                {{-- Chat nav --}}
                <li class="nav-item has-treeview">
                    <a href="{{ route('user.chats.index') }}"
                        class="nav-link {{ Request::routeIs('user.chats.index') ? 'active' : '' }}">
                        {!! iconText('chat', __('titles.room.chats'), class: 'fa-xl me-4') !!}
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item has-treeview">
                    <a href="{{ route('user.bookings.index') }}"
                        class="nav-link {{ Request::routeIs('user.bookings.index') ? 'active' : '' }}">
                        {!! iconText('bookings', class: 'fa-xl me-4') !!}
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('user.bookings.pending') }}"
                        class="nav-link {{ Request::routeIs('user.bookings.pending') ? 'active' : '' }}">
                        {!! iconText('booking', __('titles.pending_bookings'), 'fa-xl me-4') !!}
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('user.bookings.approved') }}"
                        class="nav-link {{ Request::routeIs('user.bookings.approved') ? 'active' : '' }}">
                        {!! iconText('approved_bookings', class: 'fa-xl me-4') !!}
                        {{-- {!! __('titles.icon.approved_bookings') !!} --}}
                    </a>
                </li>

                @role('admin|guide')
                    <div class="dropdown-divider"></div>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('user.tours.running') }}"
                            class="nav-link {{ Request::routeIs('user.tours.running') ? 'active' : '' }}">
                            {!! iconText('tours', trans('titles.running_tours'), class: 'fa-xl me-4') !!}
                        </a>
                    </li>
                @endrole

                @role('admin')
                    {{-- <div class="dropdown-divider"></div> --}}
                    <li class="nav-item d-none">
                        <a class="nav-link {{ Request::is('roles') || Request::is('permissions') ? 'active' : null }}"
                            href="{{ route('laravelroles::roles.index') }}">
                            <i class="fas fa-user-shield"></i>
                            {!! trans('titles.laravelroles') !!}
                        </a>
                    </li>
                @endrole


                {{-- <li class="nav-item has-treeview">
                    <a href="{{ route('user.tour.history') }}"
                        class="nav-link {{ Request::is('user/tour-history/list') ? 'active' : '' }}">
                        <i class="fas fa-history"></i>
                        <p class="ml-2">
                            Tour History
                        </p>
                    </a>
                </li> --}}




                {{-- @endrole --}}

                @role('admin2')
                    <div class="dropdown-divider"></div>
                    <li class="nav-item has-treeview">
                        <a class="nav-link {{ Request::is('themes', 'themes/create') ? 'active' : null }}"
                            href="{{ url('/themes') }}">
                            <i class="fas fa-palette"></i>
                            {!! trans('titles.adminThemesList') !!}
                        </a>
                    </li>

                    <div class="dropdown-divider"></div>
                    <li class="nav-item admin-tools d-non">
                        <a class="nav-link {{ Request::is('logs', 'activity', 'phpinfo', 'routes', 'active-users', 'blocker') ? 'active' : null }}"
                            data-toggle="collapse" href="#collapseAdminTools" role="button" aria-expanded="false"
                            aria-controls="collapseAdminTools">
                            <i class="fas fa-cogs"></i>
                            <p class="ml-2 w-75">
                                {!! trans('titles.adminTools') !!}
                                <i id="adminToolsIcon" class="fas fa-angle-down float-right"></i>
                            </p>
                        </a>
                        <ul class="nav collapse show" id="collapseAdminTools">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('logs') ? 'active' : null }}"
                                    href="{{ url('/user/logs') }}">{!! trans('titles.adminLogs') !!}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('activity') ? 'active' : null }}"
                                    href="{{ url('/activity') }}">{!! trans('titles.adminActivity') !!}</a>
                            </li>

                            <div class="dropdown-divider"></div>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('phpinfo') ? 'active' : null }}"
                                    href="{{ url('/phpinfo') }}">{!! trans('titles.adminPHP') !!}</a>
                            </li>

                            <div class="dropdown-divider"></div>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('user/routes') ? 'active' : null }}"
                                    href="{{ url('user/routes') }}">{!! trans('titles.adminRoutes') !!}</a>
                            </li>

                            <div class="dropdown-divider"></div>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('user/roles') ? 'active' : null }}"
                                    href="{{ route('laravelroles::roles.index') }}">{!! trans('titles.laravelroles') !!}</a>
                            </li>

                            {{-- <div class="dropdown-divider"></div> --}}
                            <li class="nav-item ">
                                <a class="nav-link {{ Request::is('blocker') ? 'active' : null }}"
                                    href="{{ route('laravelblocker::blocker.index') }}">{!! trans('titles.laravelBlocker') !!}</a>
                            </li>
                        </ul>
                    </li>
                @endrole

                {{-- <div class="dropdown-divider"></div>
                <li class="nav-item has-treeview">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="fas fa-pager"></i>
                        <p class="ml-2">
                            {{ __('titles.home') }}
                        </p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        $('#collapseAdminTools').on('shown.bs.collapse', function() {
            console.log('collapse shown');

            $('#adminToolsIcon').removeClass('fa-angle-down').addClass('fa-angle-up');
        })

        $('#collapseAdminTools').on('hidden.bs.collapse', function() {

            $('#adminToolsIcon').removeClass('fa-angle-up').addClass('fa-angle-down');
        })
    });
</script>
