@extends('layouts.backend.master')
@section('title')
    {{ __('titles.districts') }}
@endsection


@section('css')
    @if (config('usersmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
    @endif
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    {!! trans('titles.icon.districts') !!} {{ __('titles.data') }}
                </h1>
                {{-- <a href="{{ route('user.users.index') }}" class="btn btn-light">
                    {!! trans('buttons.back_to', ['name' => __('usersmanagement.users')]) !!}
                </a> --}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">

            {{-- @include('partials.successMessage') --}}

            <div class="card mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h3 text-gray-800 card-title">
                            {!! __('titles.showingAll', ['name' => __('titles.districts')]) !!} ({{ $districts->count() }})
                        </h1>
                        {{-- <a href="{{ route('user.districts.create') }}"
                                class="btn btn-success btn-md float-right c-white">Add New <i class="fa fa-plus"></i></a> --}}
                        @permission('create.districts')
                            <button type="button" id="submitFormNew" class="btn btn-success btn-md float-right c-white"
                                data-target="#submitForm" data-modalClass="modal-success" data-toggle="modal"
                                data-title="{{ trans('titles.create', ['name' => __('titles.district')]) }}"
                                data-action="{{ route('user.districts.store') }}">{!! __('buttons.add_new') !!}</button>
                        @endpermission
                    </div>
                </div>
                <!-- card-header -->
                <div class="card-body">
                    @if (config('usersmanagement.enableSearchUsers'))
                        @include('partials.search-form', ['route' => 'user.districts.index'])
                    @endif
                    <div class="table-responsive container-table">
                        <table id="data_table" class="table table-striped table-sm data-table">
                            <thead>
                                <tr>
                                    <th>{!! trans('forms.labels.icon.name') !!}</th>
                                    <th>{!! trans('forms.labels.icon.placeCount') !!}</th>
                                    <th>{!! trans('forms.labels.icon.created') !!}</th>
                                    @permission('delete.districts|update.districts')
                                        <th width="10%">{!! trans('forms.labels.icon.actions') !!}</th>
                                    @endpermission
                                </tr>
                                {{-- @if ($districts->count() > 0) --}}
                            </thead>
                            <tbody>
                                @forelse ($districts as $key => $district)
                                    <tr>
                                        <td>{{ $district->name }}</td>
                                        <td>{{ $district->places->count() }}</td>
                                        <td>{{ $district->created_at }}</td>
                                        {{-- <td>{{ $district->created_at->toFormattedDateString() }}</td> --}}
                                        @permission('delete.districts|update.districts')
                                            <td class="d-flex justify-content-between align-items-center">
                                                {{-- <a href="{{ route('user.districts.edit', $district->id) }}"
                                                        class="btn btn-info"><i class="fa fa-edit"></i></a> --}}

                                                @permission('update.districts')
                                                    <button type="button" id="submitFormNew"
                                                        class="btn btn-success d-inline-block c-white flex-fill me-1"
                                                        data-value="{{ $district->name }}" data-target="#submitForm"
                                                        data-modalClass="modal-success" data-toggle="modal"
                                                        data-title="{{ trans('titles.edit', ['name' => __('titles.district')]) }}"
                                                        data-action="{{ route('user.districts.update', $district->id) }}"><i
                                                            class="fa fa-edit"></i></button>
                                                @endpermission

                                                @permission('delete.districts')
                                                    {!! Form::open([
                                                        'url' => route('user.districts.destroy', $district->id),
                                                        'class' => 'd-inline-block flex-fill me-1',
                                                        'data-toggle' => 'tooltip',
                                                        'title' => trans('titles.delete', ['name' => __('titles.district')]),
                                                    ]) !!}
                                                    
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button(trans('buttons.delete'), [
                                                        'class' => 'btn btn-danger d-inline-block w-100',
                                                        'type' => 'button',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#confirmDelete',
                                                        'data-title' => trans('modals.ConfirmDeleteTitle', ['name' => __('titles.district')]),
                                                        'data-message' => trans('modals.ConfirmDeleteMessage', ['name' => $district->name]),
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                @endpermission
                                                {{-- <button type="submit"
                                                        onclick="handleDeleteDistrict( {{ $district->id }}) "
                                                        class="btn btn-danger">
                                                    </button> --}}
                                            </td>
                                        @endpermission
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-info font-weight-bold">
                                            {!! __('messages.no_data_found', ['name' => __('titles.district')]) !!}</td>
                                    </tr>
                                @endforelse

                        </table>
                        @if (config('settings.enablePagination'))
                            <div class="pagination">
                                {{ $districts->links() }}
                            </div>
                        @endif
                    </div>

                </div>
                {{-- @else
                    <h2 class="text-center text-info font-weight-bold m-3">{!! __('messages.no_data_found', ['name' => __('titles.district')]) !!}</h2>
                @endif --}}

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    @include('modals.modal-delete')
    @include('modals.modal-submit')
@endsection

@push('scripts')
    @if (count($districts) > config('usersmanagement.datatablesJsStartCount') &&
            config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.submit-modal-script')

    @if (config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endpush
