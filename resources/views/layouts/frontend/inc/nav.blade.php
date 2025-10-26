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
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i> {{ __('titles.home') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">
                            <i class="fas fa-info-circle me-1"></i> {{ __('titles.aboutus') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('places') }}">
                            <i class="fas fa-map-marker-alt me-1"></i> {{ __('titles.models.places') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tours') }}">
                            <i class="fas fa-route me-1"></i> {{ __('titles.models.tours') }}
                        </a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i> {{ __('titles.login') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary nav-btn" href="{{ route('register') }}">
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
