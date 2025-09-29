@extends('layouts.backend.master')

@section('title')
    {{ __('messages.tour_details') }} - {{ $tour->name }}
@endsection

@section('content')
<div class="container py-4">
    <!-- عنوان الصفحة وأزرار الإجراءات -->
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-gradient text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3">
                        <i class="fas fa-map-marked-alt text-white fs-4"></i>
                    </div>
                    <h2 class="mb-0">{{ __('messages.tour_details') }}: {{ $tour->name }}</h2>
                </div>
                <div class="d-flex">
                    <a href="{{ route('admin.tour.index') }}" class="btn btn-light btn-md px-4 py-2 rounded hover-effect me-2">
                        {!! __('buttons.back_to',['name' => __('messages.tours')]) !!}
                    </a>
                    <a href="{{ route('admin.tour.edit', ['tour'=>$tour->id]) }}" class="btn btn-info btn-md px-4 py-2 ml-2 rounded hover-effect">
                        {!! __('buttons.edit_name',['name' => __('messages.tour')]) !!}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- معلومات الجولة -->
    <div class="row">
        <!-- صورة الجولة -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header bg-light py-3">
                    <h4 class="mb-0 text-center">{{ __('messages.tour_image') }}</h4>
                </div>
                <div class="card-body p-3">
                    <div class="tour-image-container">
                        <img src="{{ asset('storage/tourImage/'.$tour->image) }}"
                             alt="{{ $tour->name }}"
                             class="img-fluid rounded shadow"
                             onerror="this.onerror=null; this.src='{{ asset('assets/admin/img/default-150x150.png') }}';">
                    </div>
                </div>
            </div>
        </div>

        <!-- تفاصيل الجولة -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow h-100">
                <div class="card-header bg-light py-3">
                    <h4 class="mb-0 text-center">{{ __('messages.tour_info') }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4 ">
                            <div class="info-box p-3 rounded bg-light row">

                                <div class="d-flex align-items-center mb-3 col-12">
                                    <i class="fas fa-tag text-primary fa-2x me-3"></i>
                                    <div>
                                        <h6 class="mb-0 text-gray">{{ __('messages.name') }}</h6>
                                        <p class="mb-0 fw-bold">{{ $tour->name }}</p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mb-3 col-12">
                                    <i class="fas fa-user-tie text-success fa-2x me-3"></i>
                                    <div>
                                        <h6 class="mb-0 text-gray">{{ __('messages.added_by') }}</h6>
                                        <p class="mb-0 fw-bold">{{ $tour->added_by }}</p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center  col-12">
                                    <i class="fas fa-money-bill-wave text-info fa-2x me-3"></i>
                                    <div>
                                        <h6 class="mb-0 text-gray">{{ __('messages.price') }}</h6>
                                        <p class="mb-0 fw-bold text-primary">{{ $tour->price }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="info-box p-3 rounded bg-light row">
                                <div class="d-flex align-items-center mb-3  col-12">
                                    <i class="fas fa-users text-warning fa-2x me-3"></i>
                                    <div>
                                        <h6 class="mb-0 text-gray">{{ __('messages.people') }}</h6>
                                        <p class="mb-0 fw-bold">{{ $tour->people }}</p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mb-3  col-12">
                                    <i class="fas fa-calendar-alt text-danger fa-2x me-2"></i>
                                    <div>
                                        <h6 class="mb-0 text-gray">{{ __('messages.days') }}</h6>
                                        <p class="mb-0 fw-bold">{{ $tour->day }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- الأماكن -->
                    <div class="mt-4">
                        <h5 class="mb-3 text-primary">
                            <i class="fas fa-map-marker-alt me-2"></i>{{ __('messages.places') }}
                        </h5>
                        <div class="d-flex flex-wrap">
                            @foreach ($tour->places as $place)
                                <span class="badge bg-primary text-white px-3 py-2 me-2">
                                    <i class="fas fa-map-marker-alt me-1"></i>{{ $place->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الوصف والقواعد -->
    <div class="card shadow-lg">
        <div class="card-header bg-gradient text-white py-3">
            <h3 class="mb-0 text-center">
                <i class="fas fa-file-alt me-2"></i>{{ __('messages.description') }}
            </h3>
        </div>
        <div class="card-body p-4">
            <div class="description-content">
                {!! $tour->description !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* تصميم عام */
    .info-box {
        transition: all 0.3s ease;
        height: 100%;
    }

    .info-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .tour-image-container img {
        width: 100%;
        height: auto;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .tour-image-container:hover img {
        transform: scale(1.03);
    }

    .bg-gradient {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    }

    .hover-effect {
        transition: all 0.3s ease;
    }

    .hover-effect:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .description-content {
        text-align: justify;
        line-height: 1.8;
        font-size: 1.1rem;
    }

    /* تصميم متجاوب */
    @media (max-width: 768px) {
        .info-box {
            margin-bottom: 1rem;
        }
    }
</style>
@endsection
