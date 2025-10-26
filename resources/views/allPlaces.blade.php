@extends('layouts.frontend.master')
@section('title')
    {{ trans('titles.all_places') }}
@endsection

@section('content')
    <div class="places-section">
        <div class="container">
            <h1 class="section-title">{{ trans('titles.explore_tourist_attractions') }}</h1>
            {{-- <h1 class="section-title">استكشف الأماكن السياحية</h1> --}}

            <x-place-card :places="$places" />

            {{--
        </div> --}}
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('home') }}"
                    class="btn btn-light my-5">{!! trans('buttons.back_to', ['name' => __('titles.home')]) !!}</a>
            </div>
            <div class="pagination">
                {{ $places->links() }}
            </div>
        </div>
    </div>
    </div>
@endsection