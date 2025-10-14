@extends('layouts.backend.master')
@section('title')
    {{ __('titles.dashboard') }}
@endsection
@section('content')
{{-- <div class="container">
    <div class="row pt-5">
        <h2 class="m-auto" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif"><strong>Admin Dashboard</strong></h2>
    </div>
</div> --}}
<div class="main-section">
    <div class="dashbord">
        <div class="icon-section">
            <i class="fas fa-chart-area"></i><br>
            {{ __('titles.districts') }}
            <p>{{ $countDistricts }}</p>
        </div>
        <div class="detail-section">
            <a href="{{ route('user.districts.index') }}">{{ __('messages.more') }} </a>
        </div>
    </div>
    <div class="dashbord dashbord-green">
        <div class="icon-section">
            <i class="fas fa-atlas"></i><br>
            {{ __('titles.placetypes') }}
            <p>{{ $countPlacetypes }}</p>
        </div>
        <div class="detail-section">
            <a href="{{ route('user.placetypes.index') }}">{{ __('messages.more') }} </a>
        </div>
    </div>
    <div class="dashbord dashbord-orange">
        <div class="icon-section">
            <i class="fa fa-info-circle" aria-hidden="true"></i><br>
            {{ __('titles.places') }}
                <p>{{ $countPlaces }}</p>
        </div>
        <div class="detail-section">
            <a href="{{ route('user.places.index') }}">{{ __('messages.more') }} </a>
        </div>
    </div>

    <div class="dashbord dashbord-red">
        <div class="icon-section">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i><br>
            {{ __('titles.tours') }}
            <p>{{ $countTours }}</p>
        </div>
        <div class="detail-section">
            <a href="{{ route('user.tours.index') }}">{{ __('messages.more') }} </a>
        </div>
    </div>

      <div class="dashbord dashbord-blue">
        <div class="icon-section">
            <i class="fa fa-user" aria-hidden="true"></i><br>
            {{ __('titles.guides') }}
            <p>{{ $countGuides }}</p>
        </div>
        <div class="detail-section">
            <a href="{{ route('user.users.index') .'?type=guide'}}">{{ __('messages.more') }}</a>
        </div>
    </div>

    <div class="dashbord dashbord-skyblue">
        <div class="icon-section">
            <i class="fa fa-users" aria-hidden="true"></i><br>
            {{ __('titles.users') }}
            <p>{{ $countUsers }}</p>
        </div>
        <div class="detail-section">
            <a href="{{ route('user.users.index').'?type=user' }}">{{ __('messages.more') }}</a>
        </div>
    </div>
</div>
 @endsection

