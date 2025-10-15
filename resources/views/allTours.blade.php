@extends('layouts.frontend.master')
@section('title')
    Tourist Guide - All Packages
@endsection

@section('css')

@endsection



@section('content')


<div class="container all-places">
    {{-- <x-alert message="تم الحفظ بنجاح!" type="success" /> --}}
    <div class="row justify-content-center py-5">
        <h1><strong>All Packages</strong></h1>
    </div>
    <div class="row">
        @forelse ($tours as $tour)
                <div class="col-md-4">
                    <div class="card mx-2 my-3" style="border: 2px solid black">
                        <div class="card-header">
                            <img src="{{ asset('storage/tour/'.$tour->tour_image) }}" alt="" class="img-fluid p-0 m-0">
                        </div>
                        <div class="card-body tour-details">
                            <p>Package Name: {{ $tour->name }}</p>
                            <p>Price: {{ $tour->price }}</p>
                            <p>People: {{ $tour->people }}</p>
                        </div>
                        <div class="card-footer bg-dark" >
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('tour.details', $tour->id) }}" class="btn btn-info">Details</a>
                                </div>
                                <div>
                                    @auth
                                        @role ('user')
                                            <a href="{{ route('tour.booking', $tour->id) }}" class="btn btn-success">Book Now</a>
                                        @endrole
                                    @endauth

                                    @guest
                                        <a href="{{ route('login') }}" class="btn btn-success">Book Now</a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <h2 class="my-5 bg-info text-white text-center p-3">No Package Found. Please add some place.</h2>
                @endforelse
    </div>
    <div class="d-flex justify-content-between">
        <div>
            <a href="{{ route('welcome') }}" class="btn btn-danger my-5">Back to home</a>
        </div>
        <div class="my-5">
            {{ $tours->links() }}
        </div>
    </div>


</div>



@endsection

@section('scripts')

@endsection

@section('css')

@endsection

