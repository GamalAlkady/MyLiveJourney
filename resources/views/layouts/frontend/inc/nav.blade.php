<style>
    .active {
        background-color: #8e4103 !important;
        color: #fff !important;
        border-top-right-radius: 10px;
        border-bottom-left-radius: 10px;
    }
</style>
<section id="nav-bar" class="navigation-wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-gradient">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-compass me-2"></i>
                <span class="brand-text">{{ __('titles.' . config('app.name', trans('titles.app'))) }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i> {{ __('titles.home') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('places', 'place.details') ? 'active' : '' }}"
                            href="{{ route('places') }}">
                            <i class="fas fa-map-marker-alt me-1"></i> {{ __('titles.places') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tours', 'tour.details') ? 'active' : '' }}"
                            href="{{ route('tours') }}">
                            <i class="fas fa-route me-1"></i> {{ __('titles.tours') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            <i class="fas fa-info-circle me-1"></i> {{ __('titles.aboutus') }}
                        </a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login')? 'active' : '' }}" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i> {{ __('titles.login') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('register')? 'active' : '' }}" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i> <b>{{ __('titles.signup') }}</b>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-1"></i> {{ __('titles.dashboard') }}
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</section>
