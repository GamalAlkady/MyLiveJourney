@extends('layouts.backend.master')
@section('title')
    {{ __('titles.placetypes') }}
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
                    {!! trans('titles.icon_text.placetypes') !!} {{ __('titles.data') }}
                </h1>
                {{-- <a href="{{ route('user.users.index') }}" class="btn btn-light">
                    {!! trans('buttons.back_to', ['name' => __('usersmanagement.users')]) !!}
                </a> --}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            {{-- @include('partials.successMessage') --}}

            <div class="card mt-1">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h3 text-gray-800 card-title">
                            {!! __('titles.showingAll', ['name' => __('titles.placetypes')]) !!} ({{ $types->count() }})
                        </h1>
                        @permission('create.placetypes')
                            <button type="button" id="submitFormNew" class="btn btn-success btn-md float-right c-white"
                                data-target="#submitForm" data-modalClass="modal-success" data-toggle="modal"
                                data-title="{{ trans('titles.create', ['name' => __('titles.placetype')]) }}"
                                data-action="{{ route('user.placetypes.store') }}">{!! __('buttons.add_new') !!}</button>
                        @endpermission
                    </div>
                    {{-- <a href="{{ route('user.placetypes.create') }}" class="btn btn-success btn-md float-right c-white">Add
                            New <i class="fa fa-plus"></i></a> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (config('usersmanagement.enableSearchUsers'))
                        @include('partials.search-form', ['route' => 'user.placetypes.index'])
                    @endif
                    <div class="table-responsive container-table">

                        <table id="data_table" class="table table-striped table-sm data-table">
                            <thead>
                                <tr>
                                    <th>{!! __('forms.labels.icon.name') !!}</th>
                                    <th>{!! __('forms.labels.icon.placeCount') !!}</th>
                                    <th>{!! __('forms.labels.icon.created') !!}</th>
                                    @permission('update.placetypes|delete.placetypes')
                                        <th>{!! __('forms.labels.icon.actions') !!}</th>
                                    @endpermission
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($types as $key => $type)
                                    <tr>
                                        <td>{{ $type->name }}</td>
                                        <td>{{ $type->places->count() }}</td>
                                        <td>{{ $type->created_at->toFormattedDateString() }}</td>

                                        @permission('update.placetypes|delete.placetypes')
                                            <td class="d-flex">

                                                {{-- <a href="{{ route('user.placetypes.edit', $type->id) }}"
                                                        class="btn btn-info "><i class="fa fa-edit"></i></a> --}}

                                                @permission('update.placetypes')
                                                    <button type="button" id="btnUpdate"
                                                        class="btn btn-success d-inline-block c-white flex-fill me-1"
                                                        data-value="{{ $type->name }}" data-target="#submitForm"
                                                        data-modalClass="modal-success" data-toggle="modal"
                                                        data-title="{{ trans('titles.edit', ['name' => __('titles.placetype')]) }}"
                                                        data-action="{{ route('user.placetypes.update', $type->id) }}">
                                                        <i class="fa fa-edit"></i></button>
                                                @endpermission

                                                @permission('delete.placetypes')
                                                    {!! Form::open([
                                                        'url' => route('user.placetypes.destroy', $type->id),
                                                        'class' => 'd-inline-block flex-fill me-1',
                                                        'data-toggle' => 'tooltip',
                                                        'title' => trans('titles.delete', ['name' => __('titles.placetype')]),
                                                    ]) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button(trans('buttons.delete'), [
                                                        'class' => 'btn btn-danger d-inline-block w-100',
                                                        'type' => 'button',
                                                        'id' => 'btnDelete',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#confirmDelete',
                                                        'data-title' => trans('modals.ConfirmDeleteTitle', ['name' => __('titles.placetype')]),
                                                        'data-message' => __('modals.ConfirmDeleteMessage', ['name' => $type->name]),
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                @endpermission
                                            </td>
                                        @endpermission

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-info font-weight-bold">
                                            {!! __('messages.no_data_found', ['name' => __('titles.placetypes')]) !!}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if (config('usersmanagement.enableSearchUsers'))
                                <tbody id="search_results"></tbody>
                            @endif
                        </table>
                    </div>



                </div> <!-- /.card-body -->

                @if (config('settings.enablePagination'))
                    <div class="pagination">
                        {{ $types->links() }}
                    </div>
                @endif

            </div>
            <!-- /.card -->
        </div>
    </div>

    @include('modals.modal-delete')
    @include('modals.modal-submit')

@endsection

@push('scripts')
    @if (count($types) > config('usersmanagement.datatablesJsStartCount') && config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.submit-modal-script')
    @if (config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if (config('usersmanagement.enableSearchUsers'))
        {{-- @include('scripts.table-search')
        <script>
            $(function() {
                initAjaxSearch({
                    route: "{{ route('search-placetypes') }}",
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
                    @permission('delete.placetype|edit.placetype')
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
                    defaultTitle: `{!! __('titles.icon_text.placetypes') !!}({{ $types->count() }})`,
                });
            });
        </script> --}}
    @endif
@endpush
