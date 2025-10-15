@extends('layouts.frontend.master')
@section('title')
    Tourist Guide - Home
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
                        <h1 class="display-3 fw-bold text-white mb-4">Your Journey Starts Here</h1>
                        <p class="lead text-white mb-5">Begin Your Adventure</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Amazing Places Section --}}
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-4">{{ trans('titles.amazing_places') }}</h2>
            <p class="lead text-muted">{{ trans('titles.discover_the_destinations') }}</p>
        </div>

        <div class="row">
            <x-place-card :places="$places" />
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('all.place') }}" class="btn btn-outline-primary btn-lg">عرض المزيد من الأماكن</a>
        </div>
    </div>

    {{-- Features Section --}}
    <section class="features-section plan">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4">خطط رحلتك بسهولة</h2>
                <p class="lead text-muted">كل ما تحتاجه لرحلة مثالية</p>
            </div>

            <div class="row text-center">
                <div class="col mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa fa-vr-cardboard"></i>
                        </div>
                        <h3>جولات افتراضية</h3>
                        <p class="text-muted">اختر من بين جولاتنا</p>
                    </div>
                </div>

                <div class="col mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa fa-map"></i>
                        </div>
                        <h3>خطط رحلتي</h3>
                        <p class="text-muted">اختر وجهتك المفضلة</p>
                    </div>
                </div>


                <div class="col mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa fa-comments"></i>
                        </div>
                        <h3>مساعد سياحي</h3>
                        <p class="text-muted">دعم فني متخصص</p>
                    </div>
                </div>

                <div class="col mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa fa-sitemap"></i>
                        </div>
                        <h3>تنظيم متكامل</h3>
                        <p class="text-muted">رحلات منظمة بعناية فائقة</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- tours Section --}}
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-4">باقاتنا المميزة</h2>
            <p class="lead text-muted">اختر ما يناسبك من باقاتنا المتنوعة</p>
        </div>

        <div class="row">
            @forelse ($tours as $tour)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="tour-places-images">
                            @foreach ($tour->places as $place)
                                <div class="place-thumbnail">
                                    <img src="{{ asset('storage/place/' . $place->image) }}" alt="{{ $place->name }}"
                                        class="place-img" data-toggle="tooltip" title="{{ $place->name }}">
                                </div>
                            @endforeach
                        </div>

                        {{-- <img src="{{ asset('storage/tourImage/' . $tour->tour_image) }}" class="card-img-top" --}}
                        {{-- alt="{{ $tour->name }}"> --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $tour->name }}</h5>
                            <p class="card-text">
                                <strong>السعر:</strong> {{ $tour->price }}<br>
                                <strong>عدد الأشخاص:</strong> {{ $tour->people }}
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('tour.details', $tour->id) }}"
                                    class="btn btn-outline-primary">التفاصيل</a>
                                @auth
                                    @role('user')
                                        <a href="{{ route('tour.booking', $tour->id) }}" class="btn btn-primary">احجز
                                            الآن</a>
                                    @endrole
                                @endauth
                                @guest
                                    <a href="{{ route('login') }}" class="btn btn-primary">احجز الآن</a>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center p-5">
                        <h3>لم يتم العثور على باقات. الرجاء إضافة بعض الباقات.</h3>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('all.tours') }}" class="btn btn-primary btn-lg">عرض جميع الباقات</a>
        </div>
    </div>

    {{-- Districts Section --}}
    <section class="bg-light py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4">استكشف حسب المنطقة</h2>
                <p class="lead text-muted">اختر وجهتك المفضلة</p>
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
                            <h3>لم يتم العثور على مناطق. الرجاء إضافة بعض المناطق.</h3>
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
                    <h2 class="display-4 mb-4">ابحث عن وجهتك</h2>
                    <form action="{{ route('search') }}" method="GET" class="mb-3">
                        @csrf
                        @if (session('search'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('search') }}
                            </div>
                        @endif
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" placeholder="ابحث عن مكان..."
                                name="query">
                            <button type="submit" class="btn btn-light btn-lg">بحث</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Social Media Section --}}
    <section class="py-5">
        <div class="container text-center">
            <h3 class="mb-4">تابعنا على وسائل التواصل الاجتماعي</h3>
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
