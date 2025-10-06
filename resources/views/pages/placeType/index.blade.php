@extends('layouts.backend.master')
@section('title')
    {{ __('titles.placetypes') }}
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
                                {!! __('titles.showingAll',['name'=>__('titles.placetypes')]) !!}  ({{ $types->count() }})
                            </h1>
                            @permission('add.placetype')
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
                    @if ($types->count() > 0)
                        <div class="card-body">
                            @if (config('usersmanagement.enableSearchUsers'))
                                @include('partials.search-form', ['route' => 'user.search-placetypes'])
                            @endif
                            <div class="table-responsive container-table">

                                <table id="data_table" class="table table-bordered table-striped data-table">
                                    <thead>
                                        <tr>
                                            <th>{!! __('labels.icon_text.name') !!}</th>
                                            <th>{!! __('labels.icon_text.placeCount') !!}</th>
                                            <th>{!! __('labels.icon_text.created') !!}</th>
                                            @permission('edit.placetype|delete.placetype|view.placetype')
                                                <th width="10%">{!! __('labels.icon_text.actions') !!}</th>
                                            @endpermission
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($types as $key => $type)
                                            <tr>
                                                <td>{{ $type->name }}</td>
                                                <td>{{ $type->places->count() }}</td>
                                                <td>{{ $type->created_at->toFormattedDateString() }}</td>

                                                @permission('edit.placetype|delete.placetype|view.placetype')
                                                    <td>

                                                        {{-- <a href="{{ route('user.placetypes.edit', $type->id) }}"
                                                        class="btn btn-info "><i class="fa fa-edit"></i></a> --}}

                                                        @permission('edit.placetype')
                                                        <button type="button" id="submitFormNew"
                                                            class="btn btn-success d-inline-block c-white"
                                                            data-value="{{ $type->name }}" data-target="#submitForm"
                                                            data-modalClass="modal-success" data-toggle="modal"
                                                            data-title="{{ trans('titles.edit', ['name' => __('titles.placetype')]) }}"
                                                            data-action="{{ route('user.placetypes.update', $type->id) }}"><i
                                                                class="fa fa-edit"></i></button>
                                                        @endpermission

                                                        @permission('delete.placetype')
                                                        {!! Form::open([
                                                            'url' => route('user.placetypes.destroy', $type->id),
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
                                                            'data-title' => 'Delete Place Type',
                                                            'data-message' => 'Are you sure you want to delete this place type ?',
                                                        ]) !!}
                                                        {!! Form::close() !!}
                                                        @endpermission
                                                    </td>
                                                @endpermission

                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @if (config('usersmanagement.enableSearchUsers'))
                                        <tbody id="search_results"></tbody>
                                    @endif
                                </table>
                            </div>



                        </div> <!-- /.card-body -->
                    @else
                        <h2 class="text-center text-info font-weight-bold m-3">{!! __('messages.no_data_found', ['name' => __('titles.placetype')]) !!}/h2>
                    @endif
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

@section('scripts')
    @if (count($types) > config('usersmanagement.datatablesJsStartCount') && config('usersmanagement.enabledDatatablesJs'))
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
                    route: "{{ route('user.search-placetypes') }}",
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
        </script>
    @endif
@endsection
