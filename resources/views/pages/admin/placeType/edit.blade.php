@extends('layouts.backend.master')
@section('title')
    Tourist Guide - Place Type Edit
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-1">
            <div class="card-header">
                <h3 class="card-title float-left"><strong>Update Place Type</strong></h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @include('partials.errors')
                <form action="{{ route('admin.placetype.update', $placetype->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name"> Name: </label>
                        <input type="text" class="form-control" placeholder="Enter District Name" id="name"
                            name="name" value="{{ old('name', $placetype->name) }}">
                    </div>


                    <div class="form-group d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ URL::previous() }}" class="btn btn-danger wave-effect">Back</a>
                    </div>

                </form>

            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
