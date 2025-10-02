@extends('layouts.backend.master')

@section('title')
    {{ __('messages.tours') }}
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary rounded-circle p-2 me-3">
                            <i class="fas fa-map-marked-alt text-white fs-4"></i>
                        </div>
                        <h2 class="mb-0">{{ __('messages.all_tours') }}</h2>
                    </div>
                    <div>
                        <a href="{{ route('admin.tour.create') }}"
                            class="btn btn-outline-primary btn-md  px-4 py-2 rounded hover-effect">
                            <i class="fas fa-plus-circle text-success me-2"></i>
                            {{ __('messages.add_new_tour') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                @if (config('usersmanagement.enableSearchUsers'))
                    @include('partials.search-users-form')
                @endif

                <div class="table-responsive users-table">
                    <table class="table table-striped table-sm data-table">
                        <caption id="user_count">
                            {{ trans_choice('pagination.caption', 1, ['count' => $tours->count(), 'name' => __('titles.tour')]) }}
                        </caption>
                        {{-- <caption id="user_count" class="text-center">
                             <h3 class="m-auto">{{ __('messages.no_data_found') }}</h3>
                        </caption> --}}
                        <thead class="thead">
                            <tr>
                                <th>{!! trans('usersmanagement.users-table.id') !!}</th>
                                <th>{!! trans('forms.name') !!}</th>
                                <th class="hidden-xs">{!! trans('forms.price') !!}</th>
                                <th class="hidden-xs">{!! trans('forms.people') !!}</th>
                                <th class="hidden-xs">{!! trans('forms.days') !!}</th>
                                <th>{!! trans('forms.date') !!}</th>
                                <th>{!! trans('usersmanagement.users-table.actions') !!}</th>
                            </tr>
                        </thead>
                        <tbody id="users_table">
                            @foreach ($tours as $tour)
                                <tr>
                                    <td>{{ $tour->id }}</td>
                                    <td>{{ $tour->name }}</td>
                                    <td class="hidden-xs"><span
                                            class="col-md-8 ms-auto text-primary fw-bold">{{ $tour->price }}
                                            {{ __('messages.currency') }}</span></td>
                                    <td class="hidden-xs">{{ $tour->people }}</td>
                                    <td class="hidden-xs">{{ $tour->day }}</td>
                                    <td>
                                        <span class="col-8 ms-auto text-info fw-bold">{{ $tour->date }} -
                                            {{ Carbon\Carbon::parse($tour->date)->addDays($tour->day - 1)->format('Y-m-d') }}</span>
                                    </td>

                                    <td>
                                        {{-- Button for delete user --}}
                                        {!! Form::open([
                                            'url' => 'admin/tour/' . $tour->id,
                                            'class' => 'd-inline-block',
                                            'data-toggle' => 'tooltip',
                                            'title' => 'Delete',
                                        ]) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::button(trans('buttons.delete'), [
                                            'class' => 'btn btn-danger',
                                            'type' => 'button',
                                            'data-toggle' => 'modal',
                                            'data-target' => '#confirmDelete',
                                            'data-title' => __('modals.ConfirmDeleteTitle', ['name' => __('titles.tour')]),
                                            'data-message' => trans('modals.ConfirmDeleteMessage', ['name' => $tour->name]),
                                        ]) !!}
                                        {!! Form::close() !!}

                                        {{-- Button for show user --}}
                                        <a class="btn btn-success btn-inline-block"
                                            href="{{ route('admin.tour.show', $tour->id) }}" data-toggle="tooltip"
                                            title="Show">
                                            {!! trans('buttons.show') !!}
                                        </a>

                                        {{-- Button for edit user --}}
                                        <a class="btn btn-info btn-inline-block"
                                            href="{{ route('admin.tour.edit', $tour->id) }}" data-toggle="tooltip"
                                            title="Edit">
                                            {!! trans('buttons.edit') !!}
                                        </a>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tbody id="search_results"></tbody>
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
        @include('scripts.search-users')
    @endif
@endsection
