@extends('layouts.backend.master')
@section('title')
    Tourist Guide - District
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
                    {!! trans('titles.icon_text.districts') !!} {{ __('titles.data') }}
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
                        {!! __('titles.showingAll',['name'=>__('titles.districts')]) !!}  ({{ $districts->count() }})
                    </h1>
                    {{-- <a href="{{ route('user.districts.create') }}"
                                class="btn btn-success btn-md float-right c-white">Add New <i class="fa fa-plus"></i></a> --}}
                    @permission('add.districts')
                        <button type="button" id="submitFormNew" class="btn btn-success btn-md float-right c-white"
                            data-target="#submitForm" data-modalClass="modal-success" data-toggle="modal"
                            data-title="{{ trans('titles.create', ['name' => __('titles.district')]) }}"
                            data-action="{{ route('user.districts.store') }}">{!! __('buttons.add_new') !!}</button>
                    @endpermission
                </div>
            </div>
            <!-- card-header -->
            @if ($districts->count() > 0)
                <div class="card-body">
                    @if (config('usersmanagement.enableSearchUsers'))
                        @include('partials.search-form', ['route' => 'user.search-districts'])
                    @endif
                    <div class="table-responsive container-table">
                        <table id="data_table" class="table table-striped table-sm data-table">
                            <thead>
                                <tr>
                                    <th>{!! trans('labels.icon_text.name') !!}</th>
                                    <th>{!! trans('labels.icon_text.placeCount') !!}</th>
                                    <th>{!! trans('labels.icon_text.created') !!}</th>
                                    @permission('delete.districts|edit.districts')
                                        <th width="10%">{!! trans('labels.icon_text.actions') !!}</th>
                                    @endpermission
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($districts as $key => $district)
                                    <tr>
                                        <td>{{ $district->name }}</td>
                                        <td>{{ $district->places->count() }}</td>
                                        <td>{{ $district->created_at }}</td>
                                        {{-- <td>{{ $district->created_at->toFormattedDateString() }}</td> --}}
                                        @role('admin')
                                            <td class="d-flex justify-content-between align-items-center">
                                                {{-- <a href="{{ route('user.districts.edit', $district->id) }}"
                                                        class="btn btn-info"><i class="fa fa-edit"></i></a> --}}

                                                <button type="button" id="submitFormNew"
                                                    class="btn btn-success d-inline-block c-white"
                                                    data-value="{{ $district->name }}" data-target="#submitForm"
                                                    data-modalClass="modal-success" data-toggle="modal"
                                                    data-title="{{ trans('titles.edit', ['name' => __('titles.district')]) }}"
                                                    data-action="{{ route('user.districts.update', $district->id) }}"><i
                                                        class="fa fa-edit"></i></button>

                                                {!! Form::open([
                                                    'url' => route('user.districts.destroy', $district->id),
                                                    'class' => 'd-inline-block',
                                                    'data-toggle' => 'tooltip',
                                                    'title' => 'Delete',
                                                ]) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::button(trans('buttons.delete'), [
                                                    'class' => 'btn btn-danger d-inline-block',
                                                    'type' => 'button',
                                                    'data-toggle' => 'modal',
                                                    'data-target' => '#confirmDelete',
                                                    'data-title' => 'Delete District',
                                                    'data-message' => trans('modals.ConfirmDeleteMessage', ['name' => $district->name]),
                                                ]) !!}
                                                {!! Form::close() !!}
                                                {{-- <button type="submit"
                                                        onclick="handleDeleteDistrict( {{ $district->id }}) "
                                                        class="btn btn-danger">
                                                    </button> --}}
                                            </td>
                                        @endrole
                                    </tr>
                                @endforeach
                            </tbody>
                            @if (config('usersmanagement.enableSearchUsers'))
                                <tbody id="search_results"></tbody>
                            @endif
                        </table>
                        @if (config('settings.enablePagination'))
                            <div class="pagination">
                                {{ $districts->links() }}
                            </div>
                        @endif
                    </div>

                </div>
            @else
                <h2 class="text-center text-info font-weight-bold m-3">{!! __('messages.no_data_found', ['name' => __('titles.district')]) !!}</h2>
            @endif

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    </div>

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
        @include('scripts.table-search')
        {{-- <script src="{{ asset('assets/js/table-search.js') }}"></script> --}}
        <script>
            $(function() {
                initAjaxSearch({
                    route: "{{ route('user.search-districts') }}",
                    columns: [{
                            name: "name",
                            label: "Name"
                        },

                        {
                            name: "places",
                            label: "Places Count",
                            render: (val, row) => {
                                return val ? val.length : 0;
                            }
                        },
                        {
                            name: "created_at",
                            label: "Added By",
                        },

                    ],
                    @permission('delete.districts|edit.districts')
                    actions: {

                        @permission('edit.places')
                            edit: '/place',
                        @endpermission
                        @permission('delete.places')
                            delete: '/place',
                        @endpermission
                        // custom: function(val) {
                        //     return `<a href="/users/${val.id}/roles" class="btn btn-warning btn-sm">Roles</a>`;
                        // }
                    },
                    @endpermission
                    defaultTitle: `{!! __('titles.icon_text.districts') !!}({{ $districts->count() }})`,
                });
            });
        </script>
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
