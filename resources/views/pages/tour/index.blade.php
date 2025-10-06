@extends('layouts.backend.master')

@section('title')
    {{ __('titles.tours') }}
@endsection
{{-- TODO:change route tour to tours --}}
@php
    $page = 'tours';
@endphp

@section('content')

    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    {!! trans('titles.icon_text.tours') !!} {{ __('titles.data') }}
                </h1>
                {{-- <a href="{{ route('user.users.index') }}" class="btn btn-light">
                    {!! trans('buttons.back_to', ['name' => __('usersmanagement.users')]) !!}
                </a> --}}
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 text-gray-800 card-title">
                        {!! __('titles.showingAll',['name'=>__('titles.tours')]) !!}  ({{ $tours->count() }})
                    </h1>
                    <div>
                        @permission('create.tours')
                            <a href="{{ route('user.tours.create') }}"
                                class="btn btn-success btn-md  px-4 py-2 rounded hover-effect">
                                {!! __('buttons.add_new') !!}
                            </a>
                        @endpermission
                    </div>
                </div>
            </div>
            <div class="card-body">

                @if (config('usersmanagement.enableSearchUsers'))
                    @include('partials.search-form',['route' => 'user.search-tours'])
                @endif

                <div class="table-responsive container-table">
                    <table class="table table-striped table-sm data-table">
                        <caption id="data_count">
                            {{ trans_choice('pagination.caption', 1, ['count' => $tours->count(), 'name' => __('titles.tour')]) }}
                        </caption>
                        {{-- <caption id="user_count" class="text-center">
                             <h3 class="m-auto">{{ __('messages.no_data_found') }}</h3>
                        </caption> --}}
                        <thead class="thead">
                            <tr>
                                <th>{!! trans('labels.icon_text.id') !!}</th>
                                <th>{!! trans('labels.icon_text.name') !!}</th>
                                <th>{!! trans('labels.icon_text.price') !!}</th>
                                <th>{!! trans('labels.icon_text.people') !!}</th>
                                <th>{!! trans('labels.icon_text.days') !!}</th>
                                <th>{!! trans('labels.icon_text.date') !!}</th>
                                <th>{!! trans('labels.icon_text.actions') !!}</th>
                            </tr>
                        </thead>
                        <tbody id="users_table">
                            @foreach ($tours as $tour)
                                <tr>
                                    <td>{{ $tour->id }}</td>
                                    <td>{{ $tour->name }}</td>
                                    <td class="hidden-xs"><span
                                            class="col-md-8 ms-auto fw-bold">{{ $tour->price }}
                                            {{ __('labels.currency') }}</span></td>
                                    <td class="hidden-xs">{{ $tour->people }}</td>
                                    <td class="hidden-xs">{{ $tour->day }}</td>
                                    <td>
                                        <span class="col-8 ms-auto fw-bold">{{ $tour->date }} -
                                            {{ Carbon\Carbon::parse($tour->date)->addDays($tour->day - 1)->format('Y-m-d') }}</span>
                                    </td>

                                    <td class="d-flex">
                                        {{-- Button for show user --}}
                                        <a class="btn btn-success btn-inline-block flex-fill me-1"
                                            href="{{ route('user.tours.show', $tour->id) }}" data-toggle="tooltip"
                                            title="Show">
                                            {!! trans('buttons.show') !!}
                                        </a>
                                        @permission('update.tours')
                                            {{-- Button for edit user --}}
                                            <a class="btn btn-info btn-inline-block flex-fill me-1"
                                                href="{{ route('user.tours.edit', $tour->id) }}" data-toggle="tooltip"
                                                title="Edit">
                                                {!! trans('buttons.edit') !!}
                                            </a>
                                        @endpermission
                                        @permission('delete.tours')
                                            {{-- Button for delete user --}}
                                            {!! Form::open([
                                                'url' => 'tours/' . $tour->id,
                                                'class' => 'd-inline-block flex-fill me-1',
                                                'data-toggle' => 'tooltip',
                                                'title' => 'Delete',
                                            ]) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('buttons.delete'), [
                                                'class' => 'btn btn-danger w-100',
                                                'type' => 'button',
                                                'data-toggle' => 'modal',
                                                'data-target' => '#confirmDelete',
                                                'data-title' => __('modals.ConfirmDeleteTitle', ['name' => __('titles.tour')]),
                                                'data-message' => trans('modals.ConfirmDeleteMessage', ['name' => $tour->name]),
                                            ]) !!}
                                            {!! Form::close() !!}
                                        @endpermission

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @if (config('usersmanagement.enableSearchUsers'))
                            <tbody id="search_results"></tbody>
                        @endif

                    </table>
                    @if (config('usersmanagement.enablePagination'))
                        {{ $tours->links() }}
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>


    <!-- نافذة الحوار لحذف الحزمة -->
    @include('modals.modal-delete')
@endsection

@section('scripts')
    @if (count($tours) > config('usersmanagement.datatablesJsStartCount') && config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if (config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if (config('usersmanagement.enableSearchUsers'))
        @include('scripts.table-search')
        {{-- <script src="{{ asset('assets/js/table-search.js') }}"></script> --}}
        <script>
            $(function() {
                initAjaxSearch({
                    route: "{{ route('user.search-tours') }}",
                    columns: [
                        {
                            name: "id",

                        },
                        {
                            name: "name",
                            label: "Name"
                        },

                        {name:'price', label: 'Price'},
                        {name: 'people', label: 'People'},
                        {name:'day', label: 'Days'},
                        {name:'date', label: 'Date'},

                    ],
                        actions: {

                            show:"/{{ $page }}",
                            @permission("edit.$page")
                                edit: "/{{ $page }}",
                            @endpermission
                            @permission("delete.$page")
                                delete: '/{{ $page }}',
                            @endpermission
                            // custom: function(val) {
                            //     return `<a href="/users/${val.id}/roles" class="btn btn-warning btn-sm">Roles</a>`;
                            // }
                        },
                    defaultTitle: `{!! __("titles.icon_text.$page") !!}({{ $tours->count() }})`,
                });
            });
        </script>
    @endif
@endsection
