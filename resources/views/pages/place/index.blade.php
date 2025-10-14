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
                        <h1 class="h3 text-gray-800 card-title">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            {!! __('titles.showingAll', ['name' => __('titles.places')]) !!}
                            <span id="data_count">({{ $places->count() }})</span>
                        </h1>
                        @permission('create.places')
                            <a href="{{ route('user.places.create') }}"
                                class="btn btn-success btn-md float-right c-white">{!! __('buttons.add_new') !!}</a>
                        @endpermission
                    </div>
                </div>
                <!-- card-header -->
                <div class="card-body">
                    @if (config('usersmanagement.enableSearchUsers'))
                        @include('partials.search-form', ['route' => 'user.places.index'])
                    @endif
                    <div class="table-responsive container-table">
                        <table id="data_table" class="table table-striped table-sm data-table">
                            <thead>
                                <tr>
                                    <th>{!! trans('forms.labels.icon.name') !!}</th>
                                    <th>{!! trans('forms.labels.icon.added_by') !!}</th>
                                    <th>{!! trans('titles.icon_text.district') !!}</th>
                                    <th>{!! trans('titles.icon_text.placetype') !!}</th>
                                    <th class="hidden-sm hidden-xs">{!! trans('forms.labels.icon.image') !!}</th>
                                    <th width="15%">{!! trans('forms.labels.icon.actions') !!}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Load users from database --}}
                                {{-- @foreach ($users as $user) --}}
                                {{-- @include('partials.table-row', ['user' => $user]) --}}
                                {{-- @endforeach --}}
                                {{-- Load users from database --}}
                                @forelse ($places as $key => $place)
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

                                            @permission('update.places')
                                                <a href="{{ route('user.places.edit', $place->id) }}"
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
                                                    'class' => 'btn btn-danger w-100',
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
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <h2 class="text-info font-weight-bold">{!! __('messages.no_data_found', ['name' => __('titles.place')]) !!}</h2>
                                        </td>
                                    </tr>
                                @endforelse
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


                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    @include('modals.modal-delete')
@endsection

@push('scripts')
    @if (count($places) > config('usersmanagement.datatablesJsStartCount') && config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @if (config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif

@endpush
