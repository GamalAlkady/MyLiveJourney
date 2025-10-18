@extends('layouts.frontend.master')
@section('title')
    {{ trans('titles.home') }}
@endsection

@section('css')
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("{{ asset('frontend/img/39b5165c510284ea96c6c61ff832e9f9.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
        }
    </style>
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100 text-center">
                <div class="col-md-8">
                    <div class="hero-content">
                        <div class="location-icon mb-4">
                            <i class="fa fa-map-marker fa-3x text-warning"></i>
                        </div>
                        <h1 class="display-3 fw-bold text-white mb-4">{{ trans('titles.start_journey') }}</h1>
                        <p class="lead text-white mb-5">{{ trans('titles.begin_adventure') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Amazing Places Section --}}
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-4">{{ trans_choice('titles.amazing_places',0) }}</h2>
            <p class="lead text-muted">{{ trans('titles.discover_the_destinations') }}</p>
        </div>

        <div class="row">
            <x-place-card :places="$places" />
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('places') }}"
                class="btn btn-outline-primary btn-lg">{!! trans('buttons.view_all') !!}</a>
        </div>
    </div>

    {{-- Features Section --}}
    <section class="features-section plan">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4">{{ trans('messages.features_section.title') }}</h2>
                <p class="lead text-muted">{{ trans('messages.features_section.description') }}</p>
            </div>

            <div class="row text-center">
                @foreach (__('messages.features_section.features') as $key => $feature)
                    <div class="col mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fa {{ $feature['icon'] }}"></i>
                            </div>
                            <h3>{{ $feature['title'] }}</h3>
                            <p class="text-muted">{{ $feature['description'] }}</p>
                        </div>
                    </div>          
                @endforeach
          
            </div>
        </div>
    </section>

    {{-- tours Section --}}
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-4">{{ trans('messages.featured_tours.title') }}</h2>
            <p class="lead text-muted">{{ trans('messages.featured_tours.description') }}</p>
        </div>

        <div class="row">
        @each('partials.tour-card',$tours ,'tour','partials.empty' )
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('tours') }}" class="btn btn-outline-primary btn-lg">{{ trans('buttons.view_all') }}</a>
        </div>
    </div>

    {{-- Districts Section --}}
    <section class="bg-light py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4">{{ trans('messages.explore_by_district') }}</h2>
                <p class="lead text-muted">{{ trans('messages.choose_your_destination') }}</p>
            </div>

            <div class="row justify-content-center">
                @forelse ($districts as $district)
                    <div class="col-auto mb-3">
                        <a href="{{ route('district.wise.place', $district->id) }}" class="district-btn btn">
                            {{ $district->name }} ({{ $district->places->count() }})
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <h3>{{ trans('alerts.no_districts') }}</h3>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Search Section --}}
    <section class="search-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="display-4 mb-4">{{ trans('messages.search_your_destination') }}</h2>
                    <form action="{{ route('search') }}" method="GET" class="mb-3">
                        @csrf
                        @if (session('search'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('search') }}
                            </div>
                        @endif
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" placeholder="{{ trans('forms.placeholders.search_placeholder') }}"
                                name="query">
                            <button type="submit" class="btn btn-light btn-lg">{{ trans('buttons.search') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Social Media Section --}}
    <section class="py-5">
        <div class="container text-center">
            <h3 class="mb-4">{{ trans('messages.follow_us') }}</h3>
            <div class="social-icon d-flex justify-content-center gap-4">
                <a href="https://www.facebook.com/" target="_blank"><img src="{{ asset('frontend/img/facebook.png') }}"
                        alt="Facebook"></a>
                <a href="https://twitter.com/" target="_blank"><img src="{{ asset('frontend/img/twitter.png') }}"
                        alt="Twitter"></a>
                <a href="https://www.instagram.com/" target="_blank"><img
                        src="{{ asset('frontend/img/instagram.png') }}" alt="Instagram"></a>
                <a href="https://www.linkedin.com/" target="_blank"><img src="{{ asset('frontend/img/linkedin.png') }}"
                        alt="LinkedIn"></a>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        $(function() {
            // $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
