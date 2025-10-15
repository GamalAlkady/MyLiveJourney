@extends('layouts.frontend.master')
@section('title')
    Tourist Guide - {{ $tour->name }}
@endsection

@section('css')

@endsection



@section('content')

<div class="container my-5" style="padding-top: 120px">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                        <h2><strong>Package Details: </strong></h2>
                        <a href="{{ route('welcome') }}" class="btn btn-danger">Back to home</a> 
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        
        <table class="table my-3">
            <tr>
                <th>Package Name</th>
                <td>{{ $tour->name }}</td>
            </tr>
            <tr>
                <th>Package Added By</th>
                <td>{{ $tour->added_by }}</td>
            </tr>
            <tr>
                <th>Places</th>
                <td>
                    @foreach ($tour->places as $place)
                        <span style="background: orange; color:black" class="px-3 py-2 m-2">
                            <strong>{{ $place->name }}</strong>
                        </span>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>Package Price</th>
                <td>{{ $tour->price }}</td>
            </tr>
            <tr>
                <th>People</th>
                <td>{{ $tour->people }}</td>
            </tr>
            <tr>
                <th>Day</th>
                <td>{{ $tour->day }}</td>
            </tr>
        </table>
        <br>
        <h3 class="my-5" style="color: whitesmoke; background-color: black; padding:12px;">Description & rules: </h3>
       <div style="text-align: justify">  {!! $tour->description !!}</div>
    </div>
</div>




@endsection

@section('scripts')
   
@endsection

@section('css')

@endsection
      
