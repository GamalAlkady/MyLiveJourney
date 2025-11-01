@extends('layouts.frontend.master')
@section('title')
    Tourist Guide - {{ $placetype->name }}
@endsection

@section('content')
<div class="places-section">
    <div class="container">
        <div class="section-title">
            <h1><strong>{{ trans_choice('titles.amazing_places', $places->count(), ['name' => $placetype->name]) }}</strong>
            </h1>
        </div>
        <x-place-card :places="$places" />
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('home') }}"
                    class="btn btn-light my-5">{!! trans('buttons.back_to', ['name' => __('titles.home')]) !!}</a>
            </div>

        </div>

    </div>
</div>
@endsection
