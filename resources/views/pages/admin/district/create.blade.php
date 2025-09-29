@extends('layouts.backend.master')
@section('title')
    Tourist Guide - Create District
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-1">
                    <div class="card-header">
                        <h3 class="card-title float-left"><strong>Create District</strong></h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        {{-- @include('partials.errors') --}}

                        <form action="{{ route('admin.district.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name"> Name: </label>
                                <input type="text" class="form-control" placeholder="Enter District Name" id="name"
                                    name="name">
                            </div>

                            <div class="form-group d-flex justify-content-between">
                                <button type="submit" class="btn btn-success">Create</button>
                                <a href="{{ URL::previous() }}" class="btn btn-danger wave-effect">Back</a>
                            </div>


                        </form>


                    </div>

                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->
@endsection
