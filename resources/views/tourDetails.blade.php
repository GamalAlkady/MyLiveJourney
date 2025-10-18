@extends('layouts.frontend.master')
@section('title')
    Tourist Guide - {{ $tour->name }}
@endsection

@section('css')
    <style>
        .tour-header {
            background: linear-gradient(135deg, #1a2a6c, #b21f1f);
            color: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .tour-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .tour-places {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin: 1rem 0;
        }

        .place-tag {
            background: linear-gradient(45deg, #FF8C00, #FFA500);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .place-tag:hover {
            transform: translateY(-2px);
        }

        .tour-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .info-card {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .info-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #1a2a6c;
        }

        .description-section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .description-header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 1rem 2rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .back-button {
            background: linear-gradient(45deg, #ff4b2b, #ff416c);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin-top: 1rem;
        }

        .back-button:hover {
            transform: translateX(-5px);
            box-shadow: 0 5px 15px rgba(255, 75, 43, 0.3);
        }
    </style>
@endsection

@section('content')
    <div class="container my-5" style="padding-top: 120px">
        <div class="tour-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-0 w-50"><i class="fas fa-map-marked-alt "></i> {{ $tour->title }}</h1>
                <a href="javascript:;" onclick="history.back()" class="back-button">

                    {!! trans('buttons.back') !!}
                </a>
            </div>
            <p class="text-light mt-3 mb-0">
                {!! icon('user','user-icon') !!}  {{ trans('forms.labels.added_by') }}: {{ $tour->guide->name }}
            </p>
        </div>

        <div class="tour-card">
            <h3 class="mb-4">{!! trans('titles.icon.places') !!}</h3>
            <div class="tour-places">
                @foreach ($tour->places as $place)
                    <a href="{{ route('place.details', $place->id) }}" class="place-tag">
                        {!! icon('location','place-icon') !!} {{ $place->name }}
                    </a>
                @endforeach
            </div>

            <div class="tour-info ow">
                <div class="info-card">
                    {!! icon('mony','info-icon') !!}
                    <h4>{!! trans('forms.labels.price') !!}</h4>
                    <p class="mb-0 fs-5"> {{ $tour->price }}</p>
                </div>

                <div class="info-card">
                    {!! icon('users','info-icon') !!}
                    <h4>{!! trans('forms.labels.group') !!}</h4>
                    <p class="mb-0 fs-5"> {{(($tour->max_seats-$tour->remaining_seats).'/'. $tour->max_seats) }}</p>
                </div>

                <div class="info-card">
                    {!! icon('date','info-icon') !!}
                    <h4>{!! trans('forms.labels.start_date') !!}</h4>
                    <p class="mb-0 fs-5">{{ $tour->start_date }} </p>
                </div>
             
                <div class="info-card">
                    {!! icon('date','info-icon') !!}
                    <h4>{!! trans('forms.labels.end_date') !!}</h4>
                    <p class="mb-0 fs-5">{{ $tour->end_date }} </p>
                </div>
            </div>
        </div>

        <div class="description-section">
            <div class="description-header">
                <h3 class="mb-0"><i class="fas fa-info-circle me-2"></i>{{ trans('forms.labels.description') }}</h3>
            </div>
            <div class="tour-description">
                {!! $tour->description !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Add smooth scroll animation for back button
        document.querySelector('.back-button').addEventListener('click', function (e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            window.location.href = href;
        });
    </script>
@endsection