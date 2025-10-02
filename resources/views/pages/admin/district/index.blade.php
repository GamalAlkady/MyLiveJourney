@extends('layouts.backend.master')
@section('title')
    Tourist Guide - District
@endsection


@section('css')
    @if (config('usersmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .users-table {
            border: 0;
        }

        .users-table tr td:first-child {
            padding-left: 15px;
        }

        .users-table tr td:last-child {
            padding-right: 15px;
        }

        .users-table.table-responsive,
        .users-table.table-responsive table {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                {{-- @include('partials.successMessage') --}}

                <div class="card mt-1">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title float-left p-0 m-0"><strong>Manage District</strong>
                            </h3>
                            {{-- <a href="{{ route('admin.district.create') }}"
                                class="btn btn-success btn-md float-right c-white">Add New <i class="fa fa-plus"></i></a> --}}
                            <button type="button" id="submitFormNew" class="btn btn-success btn-md float-right c-white"
                                data-target="#submitForm" data-modalClass="modal-success" data-toggle="modal"
                                data-title="{{ trans('titles.create', ['name' => __('titles.district')]) }}"
                                data-action="{{ route('admin.district.store') }}">{!! __('buttons.add_new') !!}</button>
                        </div>
                    </div>
                    <!-- card-header -->
                    @if ($districts->count() > 0)
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTableId" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Added</th>
                                            <th>Place Count</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($districts as $key => $district)
                                            <tr>
                                                <td>{{ $district->name }}</td>
                                                <td>{{ $district->created_at->toFormattedDateString() }}</td>
                                                <td>{{ $district->places->count() }}</td>
                                                <td class="d-flex justify-content-between align-items-center">
                                                    {{-- <a href="{{ route('admin.district.edit', $district->id) }}"
                                                        class="btn btn-info"><i class="fa fa-edit"></i></a> --}}

                                                    <button type="button" id="submitFormNew"
                                                        class="btn btn-success d-inline-block c-white"
                                                        data-value="{{ $district->name }}" data-target="#submitForm"
                                                        data-modalClass="modal-success" data-toggle="modal"
                                                        data-title="{{ trans('titles.edit', ['name' => __('titles.district')]) }}"
                                                        data-action="{{ route('admin.district.update', $district->id) }}"><i
                                                            class="fa fa-edit"></i></button>

                                                    {!! Form::open([
                                                        'url' => route('admin.district.destroy', $district->id),
                                                        'class' => 'd-inline-block',
                                                        'data-toggle' => 'tooltip',
                                                        'title' => 'Delete',
                                                    ]) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button(trans('buttons.delete'), [
                                                        'class' => 'btn btn-danger d-inline-block',
                                                        'type' => 'button',
                                                        'id' => 'deleteDistrict' . $district->id,
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#confirmDelete',
                                                        'data-title' => 'Delete District',
                                                        'data-message' => 'Are you sure you want to delete this district ?',
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                    {{-- <button type="submit"
                                                        onclick="handleDeleteDistrict( {{ $district->id }}) "
                                                        class="btn btn-danger">
                                                    </button> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- @dd(config('usersmanagement.enablePagination')) --}}

                            </div>



                        </div>
                    @else
                        <h2 class="text-center text-info font-weight-bold m-3">No District Found</h2>
                    @endif
                    <div class="pagination">
                        @if (config('settings.enablePagination'))
                            {{ $districts->links() }}
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->
    @include('modals.modal-delete')
    @include('modals.modal-submit')

@endsection

@section('scripts')
    @if (count($districts) > config('usersmanagement.datatablesJsStartCount') &&
            config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.submit-modal-script')

    @if (config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if (config('usersmanagement.enableSearchUsers'))
        @include('scripts.search-users')
    @endif
@endsection
{{-- @section('scripts')
    <script>
        function handleDeleteDistrict(id) {

            var form = document.getElementById('deleteDistrictForm')
            form.action = 'district/' + id
            $('#deleteDistrictModal').modal('show')
            //console.log(form)
        }
    </script>
@endsection --}}
