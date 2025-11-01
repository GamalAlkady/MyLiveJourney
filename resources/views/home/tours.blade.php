@extends('layouts.frontend.master')
@section('title')
    {{ trans('titles.all_tours') }}
@endsection

@section('content')
    <div class="places-section">
        <div class="container">
            <h1 class="section-title">{{ trans('titles.explore_available_tours') }}</h1>
            <div class="row">
                @each('partials.tour-card', $tours, 'tour', 'partials.empty')
            </div>
            <div class="d-flex justify-content-between">
                {{-- <div>
                    <a href="{{ route('home') }}"
                        class="btn btn-light my-5">{!! trans('buttons.back_to', ['name' => __('titles.home')]) !!}</a>
                </div> --}}
                <div class="my-5">
                    {{ $tours->links() }}
                </div>
            </div>


        </div>
    </div>
@endsection
