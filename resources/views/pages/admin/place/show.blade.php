@extends('layouts.backend.master')
@
@section('title')
    Tourist Guide - {{ $place->name }} Details
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                    Place Details
                </h1>
                <a href="{{ route('admin.place.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Places
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-image mr-1"></i>
                        Place Gallery
                    </h6>
                </div>
                <div class="card-body">
                    <div class="image-gallery-container">
                        <img src="{{ asset('storage/place/'.$place->image) }}"
                             alt="{{ $place->name }}"
                             class="img-fluid rounded shadow-sm"
                             style="max-height: 500px; object-fit: cover; width: 100%;">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary py-3">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-info-circle mr-1"></i>
                        Quick Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="text-primary mb-2">{{ $place->name }}</h4>
                        <div class="text-muted small">
                            <i class="fas fa-user mr-1"></i>
                            Added by <strong>{{ $place->addedBy }}</strong>
                            <br>
                            <i class="fas fa-clock mr-1"></i>
                            {{ $place->created_at->format('M d, Y') }}
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <span class="text-primary font-weight-bold">District:</span>
                        <p class="mb-0">{{ $place->district->name }}</p>
                    </div>

                    <div class="mb-3">
                        <span class="text-primary font-weight-bold">Place Type:</span>
                        <p class="mb-0">{{ $place->placetype->name }}</p>
                    </div>

                    <div class="mb-3">
                        <span class="text-primary font-weight-bold">Created:</span>
                        <p class="mb-0">{{ $place->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary py-3">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-file-alt mr-1"></i>
                        Description
                    </h6>
                </div>
                <div class="card-body">
                    <div class="description-content">
                        <p style="text-align: justify">{!! $place->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
.image-gallery-container {
    position: relative;
    overflow: hidden;
    border-radius: 0.35rem;
}

.description-content {
    line-height: 1.8;
}

.card {
    border-radius: 0.5rem;
    border: none;
}

.card-body {
    padding: 1.5rem;
}

@media (max-width: 768px) {
    .container-fluid {
        padding: 0.5rem;
    }

    .card-body {
        padding: 1rem;
    }
}
</style>
