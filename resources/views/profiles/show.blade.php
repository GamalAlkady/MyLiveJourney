
@extends('layouts.backend.master')

@section('title')
    {{ $user->name }}'s Profile
@endsection

@section('css')
<style>
    #map-canvas {
        min-height: 300px;
        height: 100%;
        width: 100%;
    }
    .profile-avatar {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        margin-top: -70px;
        background: #f8f9fa;
    }
    .profile-header {
        background: linear-gradient(90deg, #007bff 0%, #6c63ff 100%);
        color: #fff;
        border-top-left-radius: .5rem;
        border-top-right-radius: .5rem;
        padding: 2rem 1rem 5rem 1rem;
        text-align: center;
        position: relative;
    }
    .profile-card {
        /* margin-top: 3rem; */
        border-radius: .5rem;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(0,0,0,0.08);
    }
    .profile-info-list dt {
        font-weight: bold;
        color: #495057;
        margin-bottom: 0.25rem;
    }
    .profile-info-list dd {
        margin-bottom: 1rem;
        color: #333;
    }
    .profile-social a {
        margin-right: 10px;
        font-size: 1.2rem;
    }
</style>
@endsection

@php
    $currentUser = Auth::user();
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
            <div class="profile-card bg-white">
                <div class="profile-header">
                    <img src="@if ($user->profile->avatar_status == 1) {{ $user->profile->avatar }} @else {{ Gravatar::get($user->email) }} @endif" alt="{{ $user->name }}" class="profile-avatar shadow">
                    <h3 class="mt-3 mb-0">{{ $user->name }}</h3>
                    <p class="mb-2">{{ $user->first_name }} {{ $user->last_name }}</p>
                    @if ($user->profile && $user->profile->location)
                        <p class="mb-0"><i class="fa fa-map-marker-alt"></i> {{ $user->profile->location }}</p>
                    @endif
                </div>
                <div class="p-4">
                    <dl class="profile-info-list row">
                        <dt class="col-sm-4">{{ trans('profile.showProfileUsername') }}</dt>
                        <dd class="col-sm-8">{{ $user->name }}</dd>

                        <dt class="col-sm-4">{{ trans('profile.showProfileFirstName') }}</dt>
                        <dd class="col-sm-8">{{ $user->first_name }}</dd>

                        @if ($user->last_name && ($currentUser->id == $user->id || $currentUser->hasRole('admin')))
                            <dt class="col-sm-4">{{ trans('profile.showProfileLastName') }}</dt>
                            <dd class="col-sm-8">{{ $user->last_name }}</dd>
                        @endif

                        @if ($user->email && ($currentUser->id == $user->id || $currentUser->hasRole('admin')))
                            <dt class="col-sm-4">{{ trans('profile.showProfileEmail') }}</dt>
                            <dd class="col-sm-8">{{ $user->email }}</dd>
                        @endif

                        @if ($user->profile)
                            @if ($user->profile->theme_id && ($currentUser->id == $user->id || $currentUser->hasRole('admin')))
                                <dt class="col-sm-4">{{ trans('profile.showProfileTheme') }}</dt>
                                <dd class="col-sm-8">{{ $currentTheme->name }}</dd>
                            @endif

                            @if ($user->profile->location)
                                <dt class="col-sm-4">{{ trans('profile.showProfileLocation') }}</dt>
                                <dd class="col-sm-8">
                                    {{ $user->profile->location }}
                                    @if(config('settings.googleMapsAPIStatus'))
                                        <br>
                                        <span class="text-muted small">Latitude: <span id="latitude"></span> / Longitude: <span id="longitude"></span></span>
                                        <div id="map-canvas" class="mt-2"></div>
                                    @endif
                                </dd>
                            @endif

                            @if ($user->profile->bio && ($currentUser->id == $user->id || $currentUser->hasRole('admin')))
                                <dt class="col-sm-4">{{ trans('profile.showProfileBio') }}</dt>
                                <dd class="col-sm-8">{{ $user->profile->bio }}</dd>
                            @endif

                            @if ($user->profile->twitter_username || $user->profile->github_username)
                                <dt class="col-sm-4">{{ trans('profile.showProfileSocial') }}</dt>
                                <dd class="col-sm-8 profile-social">
                                    @if ($user->profile->twitter_username)
                                        <a href="https://twitter.com/{{ $user->profile->twitter_username }}" class="text-info" target="_blank"><i class="fab fa-twitter"></i> @{{ $user->profile->twitter_username }}</a>
                                    @endif
                                    @if ($user->profile->github_username)
                                        <a href="https://github.com/{{ $user->profile->github_username }}" class="text-dark" target="_blank"><i class="fab fa-github"></i> {{ $user->profile->github_username }}</a>
                                    @endif
                                </dd>
                            @endif
                        @endif
                    </dl>

                    @if ($user->profile)
                        @if ($currentUser->id == $user->id)
                            <a href="{{ url('/profile/'.$currentUser->name.'/edit') }}" class="btn btn-info btn-block mt-3"><i class="fa fa-cog"></i> {{ trans('titles.editProfile') }}</a>
                        @endif
                    @else
                        <p class="text-center text-muted">{{ trans('profile.noProfileYet') }}</p>
                        <a href="{{ url('/profile/'.$currentUser->name.'/edit') }}" class="btn btn-info btn-block mt-3"><i class="fa fa-plus"></i> {{ trans('titles.createProfile') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.google-maps-geocode-and-map')
    @endif
@endsection
