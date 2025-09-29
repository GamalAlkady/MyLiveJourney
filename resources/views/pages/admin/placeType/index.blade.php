@extends('layouts.backend.master')
@section('title')
    Tourist Guide - Type
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                {{-- @include('partials.successMessage') --}}

                <div class="card mt-1">
                    <div class="card-header">
                        <h3 class="card-title float-left"><strong>Manage Place Type ({{ $typescount }})</strong></h3>

                        <a href="{{ route('admin.placetype.create') }}" class="btn btn-success btn-md float-right c-white">Add
                            New <i class="fa fa-plus"></i></a>
                    </div>
                    <!-- /.card-header -->
                    @if ($types->count() > 0)
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
                                        @foreach ($types as $key => $type)
                                            <tr>
                                                <td>{{ $type->name }}</td>
                                                <td>{{ $type->created_at->toFormattedDateString() }}</td>
                                                <td>{{ $type->places->count() }}</td>
                                                <td>

                                                    <a href="{{ route('admin.placetype.edit', $type->id) }}"
                                                        class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                                    {!! Form::open([
                                                        'url' => route('admin.placetype.destroy', $type->id),
                                                        'class' => 'd-inline-block',
                                                        'data-toggle' => 'tooltip',
                                                        'title' => 'Delete',
                                                    ]) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button(trans('buttons.delete'), [
                                                        'class' => 'btn btn-danger btn-sm d-inline-block',
                                                        'type' => 'button',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#confirmDelete',
                                                        'data-title' => 'Delete Place Type',
                                                        'data-message' => 'Are you sure you want to delete this place type ?',
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>



                        </div> <!-- /.card-body -->
                    @else
                        <h2 class="text-center text-info font-weight-bold m-3">No Place Type Found</h2>
                    @endif

                    <div class="pagination">
                        {{ $types->links() }}
                    </div>

                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->
    @include('modals.modal-delete')

@endsection

@section('scripts')
    @if (count($types) > config('usersmanagement.datatablesJsStartCount') &&
            config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if (config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if (config('usersmanagement.enableSearchUsers'))
        @include('scripts.search-users')
    @endif
@endsection
