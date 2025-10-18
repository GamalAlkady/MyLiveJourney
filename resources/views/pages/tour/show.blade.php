@extends('layouts.backend.master')

@section('title')
    {{ __('titles.details') }} - {{ $tour->name }}
@endsection

@section('content')
    <!-- عنوان الصفحة وأزرار الإجراءات -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    {!! trans('titles.icon.tour') !!} {{ __('titles.details') }}
                </h1>
                <a href="{{ route('user.tours.index') }}" class="btn btn-light btn-sm px-3 py-2 rounded hover-effect me-2">
                    {!! trans('buttons.back_to', ['name' => __('titles.tours')]) !!}
                </a>
            </div>
        </div>
    </div>


    <!-- معلومات الجولة -->
    <div class="row">



        <!-- تفاصيل الجولة -->
        <div class="col-lg-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header bg-primary py-3">
                    <h4 class="mb-0 text-center ">{{ __('titles.details') }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4 ">
                            <div class="info-box p-3 rounded bg-light  row">

                                <div class="d-flex align-items-center mb-3 col-12 row">
                                    <div class="col-6">
                                        <i class="fas fa-tag text-primary fa-2x me-3"></i>
                                        <strong class="mb-0 ">{{ __('forms.labels.title') }}</strong>
                                    </div>
                                    <p class="mb-0 fw-bold">{{ $tour->title }}</p>
                                </div>

                                <div class="d-flex align-items-center mb-3 col-12 row">
                                    <div class="col-6">
                                    <i class="fas fa-user-tie text-success fa-2x me-3"></i>
                                    <strong class="mb-0">{{ __('forms.labels.added_by') }} </strong>
                                    </div>
                                    <p class="mb-0 fw-bold"> {{ $tour->guide->name }}</p>
                                </div>

                                <div class="d-flex align-items-center  col-12 row">
                                    <div class="col-6">
                                    <i class="fas fa-money-bill-wave text-info fa-2x me-3"></i>
                                    <strong class="mb-0">{{ __('forms.labels.price') }}</strong>
                                    </div>
                                    <p class="mb-0 fw-bold">{{ formatPrice($tour->price) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="info-box p-3 rounded bg-light   row">
                                <div class="d-flex align-items-center justify-content-start mb-3  col-12 row">
                                    <div class="col-6">
                                    <i class="fas fa-chair text-warning fa-2x me-3"></i>
                                    <strong class="mb-0">{!! __('forms.labels.max_seats') !!}</strong>
                                    </div>
                                    <p class="mb-0 fw-bold ">{{ $tour->max_seats . '  ' . __('titles.seats') }}
                                    </p>
                                </div>

                                <div class="d-flex align-items-center mb-3  col-12 row">
                                    <div class="col-7">
                                    <i class="fas fa-chair text-danger fa-2x me-2"></i>
                                    <strong class="mb-0 text-gra">{{ __('forms.labels.booked_seats') }}</strong>
                                    </div>
                                    <p class="mb-0 fw-bold">{{ $tour->booked_seats . '  ' . __('titles.seats') }}</p>
                                </div>
                            </div>
                        </div>

                           <div class="col-md-4 mb-4">
                            <div class="info-box p-3 rounded bg-light   row">
                                <div class="d-flex align-items-center justify-content-start mb-3  col-12 row">
                                    <div class="col-6">
                                    <strong class="mb-0">{!! __('forms.labels.icon.start_date',['class'=>' text-info fa-1x']) !!}</strong>
                                    </div>
                                    <p class="mb-0 fw-bold ">{{ getDate2($tour->start_date) }}</p>
                                </div>

                                <div class="d-flex align-items-center justify-content-start mb-3  col-12 row">
                                    <div class="col-6">
                                    <strong class="mb-0">{!! __('forms.labels.icon.start_time',['class'=>' text-info fa-1x']) !!}</strong>
                                    </div>
                                    <p class="mb-0 fw-bold ">{{ getTime($tour->start_date) }}</p>
                                </div>

                                <div class="col-12 border-bottom mb-3"></div>
                                <div class="d-flex align-items-center justify-content-start mb-3  col-12 row">
                                    <div class="col-6">
                                    <strong class="mb-0">{!! __('forms.labels.icon.end_date',['class'=>' text-warning fa-1x']) !!}</strong>
                                    </div>
                                    <p class="mb-0 fw-bold ">{{ getDate2($tour->end_date) }}</p>
                                </div>

                                <div class="d-flex align-items-center justify-content-start mb-3  col-12 row">
                                    <div class="col-6">
                                    <strong class="mb-0">{!! __('forms.labels.icon.end_time',['class'=>' text-warning fa-1x']) !!}</strong>
                                    </div>
                                    <p class="mb-0 fw-bold ">{{ getTime($tour->end_date) }}</p>
                                </div>


                            </div>
                        </div>

                    </div>

                    <!-- الأماكن -->
                    <div class="mt-4">
                        <h5 class="mb-3">
                            {!! __('titles.icon.places') !!}
                        </h5>
                        <div class="d-flex flex-wrap">
                            @foreach ($tour->places as $place)
                                <span class="badge bg-primary  px-3 py-2 me-2">
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
        <div class="card-header bg-primary py-3">
            <h3 class="mb-0 text-center">
                {!! __('forms.labels.icon.description') !!}
            </h3>
        </div>
        <div class="card-body p-4">
            <div class="description-content">
                {!! $tour->description !!}
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
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
