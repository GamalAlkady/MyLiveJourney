@extends('layouts.backend.master')
@section('title')
    {{ __('titles.places') }}
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
                    {!! trans('titles.icon_text.places') !!} {{ __('titles.data') }}
                </h1>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-md-12">

        {{-- @include('partials.successMessage') --}}



        <div class="card my-1 mx-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 text-gray-800 card-title" >
                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            {!! __('titles.showingAll',['name'=>__('titles.places')]) !!}
                            <span id="data_count">({{ $places->count() }})</span>
                    </h1>
                    @permission('add.places')
                    <a href="{{ route('user.place.create') }}"
                        class="btn btn-success btn-md float-right c-white">{!! __('buttons.add_new') !!}</a>
                    @endpermission
                </div>
            </div>
            <!-- card-header -->
            @if ($places->count() > 0)
                <div class="card-body">
                    @if (config('usersmanagement.enableSearchUsers'))
                        @include('partials.search-form', ['route' => 'user.search-places'])
                    @endif
                    <div class="table-responsive container-table">
                        <table id="data_table" class="table table-striped table-sm data-table">
                            <thead>
                                <tr>
                                    <th>{!! trans('labels.icon_text.name') !!}</th>
                                    <th>{!! trans('labels.icon_text.added_by') !!}</th>
                                    <th>{!! trans('titles.icon_text.district') !!}</th>
                                    <th>{!! trans('titles.icon_text.placetype') !!}</th>
                                    <th class="hidden-sm hidden-xs">{!! trans('labels.icon_text.image') !!}</th>
                                    <th width="15%">{!! trans('labels.icon_text.actions') !!}</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                                {{-- Load users from database --}}
                                {{-- @foreach ($users as $user) --}}
                                {{-- @include('partials.table-row', ['user' => $user]) --}}
                                {{-- @endforeach --}}
                                {{-- Load users from database --}}
                                @foreach ($places as $key => $place)
                                    <tr>
                                        <td>{{ $place->name }}</td>
                                        <td>{{ $place->addedBy }}</td>
                                        <td>{{ $place->district->name }}</td>
                                        <td>{{ $place->placetype->name }}</td>
                                        <td>
                                            <img style="width:50px;height:50px;" class="img-fluid"
                                                src="{{ asset('storage/place/' . $place->image) }}" alt="image">
                                        </td>
                                        <td class="d-flex">
                                            {{-- Button for show user --}}

                                            <a href="{{ route('user.places.show', $place->id) }}"
                                                class="btn btn-success flex-fill me-1">{!! trans('buttons.show') !!}</a>

                                            @permission('edit.places')
                                                <a href="{{ route('user.place.edit', $place->id) }}"
                                                    class="btn btn-info flex-fill me-1">{!! trans('buttons.edit') !!}</a>
                                            @endpermission

                                            {{-- Button for delete user --}}
                                            @permission('delete.places')
                                                {!! Form::open([
                                                    'url' => 'place/' . $place->id,
                                                    'class' => 'd-inline-block flex-fill',
                                                    'data-toggle' => 'tooltip',
                                                    'title' => 'Delete',
                                                ]) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::button(trans('buttons.delete'), [
                                                    'class' => 'btn btn-danger',
                                                    'type' => 'button',
                                                    'data-toggle' => 'modal',
                                                    'data-target' => '#confirmDelete',
                                                    'data-title' => __('modals.ConfirmDeleteTitle', ['name' => __('titles.place')]),
                                                    'data-message' => trans('modals.ConfirmDeleteMessage', ['name' => $place->name]),
                                                ]) !!}
                                                {!! Form::close() !!}
                                            @endpermission
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- <tbody id="search_results"></tbody> --}}
                            @if (config('usersmanagement.enableSearchUsers'))
                                <tbody id="search_results"></tbody>
                            @endif
                        </table>

                        <div class="pagination ml-3" id="pagination">
                            {{ $places->links() }}
                        </div>

                    </div>

                </div>
            @else
                <h2 class="text-center text-info font-weight-bold m-3">{!! __('messages.no_data_found', ['name' => __('titles.place')]) !!}</h2>
            @endif

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
    @include('modals.modal-delete')

@endsection

@section('scripts')
    @if (count($places) > config('usersmanagement.datatablesJsStartCount') && config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @if (config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if (config('usersmanagement.enableSearchUsers'))
        @include('scripts.table-search')
        {{-- <script src="{{ asset('assets/js/table-search.js') }}"></script> --}}
        <script>
            $(function() {
                initAjaxSearch({
                    route: "{{ route('user.search-places') }}",
                    columns: [{
                            name: "name",
                            label: "Name"
                        },

                        {
                            name: "addedBy",
                            label: "Added By"
                        },
                        {
                            name: "district.name",
                            label: "District"
                        },
                        {
                            name: "placetype.name",
                            label: "Type"
                        },
                        {
                            name: "image",
                            label: "Image",
                            render: (val,row) =>
                                `<img src="/storage/place/${val}" style="width:50px;height:50px;">`
                        },
                    ],
                    actions: {
                        show: "{{ route('user.places.show', '') }}",
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
                    defaultTitle: "All Places",
                });
            });
        </script>
    @endif
@endsection
