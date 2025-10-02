<aside class="main-sidebar elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link text-center">
        <span class="brand-text font-weight-bold">{{ Auth::user()->isAdmin() ? 'Admin Panel' : 'User Panel' }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <a href="{{ url('/profile/' . Auth::user()->name) }}">
                    @if (Auth::User()->profile && Auth::user()->profile->avatar_status == 1)
                        <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}"
                            class="user-avatar-nav">
                    @else
                        <div class="user-avatar-nav"></div>
                    @endif
                    {{-- <img src="{{ Auth::user()->image != null ? asset('storage/profile_photo/' . Auth::user()->image) : asset('assets/admin/img/user2-160x160.jpg') }}" --}}
                    {{-- class="img-circle elevation-2" alt="User Image"> --}}
                </a>

            </div>
            <div class="info">
                <a href="{{ url('/profile/' . Auth::user()->name) }}"
                    class="d-block font-weight-bold">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                @php
                    $role = auth()->user()->roles->first()->slug;
                @endphp
                <li class="nav-item has-treeview">
                    <a href="{{ route($role . '.dashboard') }}"
                        class="nav-link {{ Request::is($role . '/dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>

                        <p class="ml-2">
                            Dashboard
                        </p>
                    </a>
                </li>

                <div class="dropdown-divider"></div>
                <li class="nav-item has-treeview">
                    <a href="{{ route($role . '.district.index') }}"
                        class="nav-link {{ Request::is($role . '/district*') ? 'active' : '' }}">
                        <i class="fas fa-chart-area"></i>
                        <p class="ml-2">
                            District
                        </p>
                    </a>
                </li>

                <div class="dropdown-divider"></div>
                <li class="nav-item has-treeview">
                    <a href="{{ route($role . '.placetype.index') }}"
                        class="nav-link {{ Request::is($role . '/placetype') ? 'active' : '' }}">
                        <i class="fas fa-atlas"></i>
                        <p class="ml-2">
                            {{ trans('titles.placeType') }}
                        </p>
                    </a>
                </li>

                <div class="dropdown-divider"></div>
                <li class="nav-item has-treeview">
                    <a href="{{ route($role . '.place.index') }}"
                        class="nav-link {{ Request::is($role . '/place') ? 'active' : '' }}">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        <p class="ml-2">
                            {{ trans('titles.place') }}
                        </p>
                    </a>
                </li>

                @role('admin')
                    {{-- <div class="dropdown-divider"></div>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('admin.about.index') }}"
                            class="nav-link {{ Request::is('admin/about*') ? 'active' : '' }}">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                            <p class="ml-2">
                                About
                            </p>
                        </a>
                    </li> --}}

                    <div class="dropdown-divider"></div>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('admin.users.index') }}"
                            class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <p class="ml-2">
                                Users
                            </p>
                        </a>
                    </li>


                    <div class="dropdown-divider"></div>

                    <li class="nav-item has-treeview">
                        <a href="{{ route('admin.tour.index') }}"
                            class="nav-link {{ Request::is('admin/tour*') ? 'active' : '' }}">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <p class="ml-2">
                                {{ trans('messages.tours') }}
                            </p>
                        </a>
                    </li>

                    <div class="dropdown-divider"></div>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('admin.pending.booking') }}"
                            class="nav-link {{ Request::is('admin/booking-request/list') ? 'active' : '' }}">
                            <i class="fas fa-chalkboard"></i>
                            <p class="ml-2">
                                Booking Request
                            </p>
                        </a>
                    </li>


                    <div class="dropdown-divider"></div>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('admin.package.running') }}"
                            class="nav-link {{ Request::is('admin/running/package*') ? 'active' : '' }}">
                            <i class="fas fa-box"></i>
                            <p class="ml-2">
                                Running Package
                            </p>
                        </a>
                    </li>


                    <div class="dropdown-divider"></div>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('admin.tour.history') }}"
                            class="nav-link {{ Request::is('admin/tour-history/list') ? 'active' : '' }}">
                            <i class="fas fa-history"></i>
                            <p class="ml-2">
                                Tour History
                            </p>
                        </a>
                    </li>

                    {{-- <div class="dropdown-divider"></div> --}}
                    <li class="nav-item d-none">
                        <a class="nav-link {{ Request::is('roles') || Request::is('permissions') ? 'active' : null }}"
                            href="{{ route('laravelroles::roles.index') }}">
                            <i class="fas fa-user-shield"></i>
                            {!! trans('titles.laravelroles') !!}
                        </a>
                    </li>

                    <div class="dropdown-divider"></div>
                    <li class="nav-item has-treeview">
                        <a class="nav-link {{ Request::is('themes', 'themes/create') ? 'active' : null }}"
                            href="{{ url('/themes') }}">
                            <i class="fas fa-palette"></i>
                            {!! trans('titles.adminThemesList') !!}
                        </a>
                    </li>


                    <div class="dropdown-divider"></div>

                    <li class="nav-item admin-tools d-none">
                        <a class="nav-link {{ Request::is('admin/logs', 'activity', 'phpinfo', 'routes', 'active-users', 'blocker') || Request::is('logs') || Request::is('activity') || Request::is('phpinfo') || Request::is('routes') || Request::is('active-users') || Request::is('blocker') ? 'active' : null }}"
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
                                    href="{{ url('/admin/logs') }}">{!! trans('titles.adminLogs') !!}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('activity') ? 'active' : null }}"
                                    href="{{ url('/activity') }}">{!! trans('titles.adminActivity') !!}</a>
                            </li>

                            {{-- <div class="dropdown-divider"></div> --}}
{{--
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('phpinfo') ? 'active' : null }}"
                                    href="{{ url('/phpinfo') }}">{!! trans('titles.adminPHP') !!}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('admin/routes') ? 'active' : null }}"
                                    href="{{ url('/admin/routes') }}">{!! trans('titles.adminRoutes') !!}</a>
                            </li> --}}

                            {{-- <div class="dropdown-divider"></div> --}}
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('blocker') ? 'active' : null }}"
                                    href="{{ route('laravelblocker::blocker.index') }}">{!! trans('titles.laravelBlocker') !!}</a>
                            </li>
                        </ul>
                    </li>
                @endrole

                @role('user')
                    <li class="nav-item has-treeview">
                        <a href="{{ route('user.guide') }}"
                            class="nav-link {{ Request::is('user/guide*') ? 'active' : '' }}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <p class="ml-2">
                                Guides
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="{{ route('user.package') }}"
                            class="nav-link {{ Request::is('user/package*') ? 'active' : '' }}">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <p class="ml-2">
                                Packages
                            </p>
                        </a>
                    </li>

                    {{-- <li class="nav-item has-treeview">
                        <a href="{{ route('user.profile.show') }}"
                            class="nav-link {{ Request::is('user/profile-info*') ? 'active' : '' }}">
                            <i class="far fa-id-badge"></i>
                            <p class="ml-2">
                                Your Profile
                            </p>
                        </a>
                    </li> --}}

                    <li class="nav-item has-treeview">
                        <a href="{{ route('user.pending.booking') }}"
                            class="nav-link {{ Request::is('user/booking-request/list') ? 'active' : '' }}">
                            <i class="fas fa-chalkboard"></i>
                            <p class="ml-2">
                                Pending Request
                            </p>
                        </a>
                    </li>


                    <li class="nav-item has-treeview">
                        <a href="{{ route('user.tour.history') }}"
                            class="nav-link {{ Request::is('user/tour-history/list') ? 'active' : '' }}">
                            <i class="fas fa-history"></i>
                            <p class="ml-2">
                                Tour History
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="{{ route('welcome') }}" class="nav-link">
                            <i class="fas fa-pager"></i>
                            <p class="ml-2">
                                Home Page
                            </p>
                        </a>
                    </li>
                @endrole
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
<style>
    .admin-tools .show{
        display: flex;
        flex-direction: column;
        align-items: start;
        margin-inline-start: 0.5rem;
    }
    .rotated {
        transform: rotate(180deg);
        transition: transform 0.25s ease;
    }
</style>
