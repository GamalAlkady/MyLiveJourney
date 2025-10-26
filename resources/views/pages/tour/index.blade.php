@extends('layouts.backend.master')

@section('title')
    {{ __('titles.tours') }}
@endsection

@use('App\Enums\TourStatus')
@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    {!! trans('titles.icon.tours') !!} {{ __('titles.data') }}
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
                            {!! __('titles.showingAll', ['name' => __('titles.tours')]) !!} ({{ $tours->count() }})
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
                        @include('partials.search-form', ['route' => 'user.tours.index'])
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
                                    <th>{!! trans('forms.labels.icon.title') !!}</th>
                                    <th>{!! trans('forms.labels.icon.price') !!}</th>
                                    <th>{!! trans('forms.labels.icon.start_date') !!}</th>
                                    <th>{!! trans('forms.labels.icon.end_date') !!}</th>
                                    <th>{!! trans('forms.labels.icon.people') !!}</th>
                                    <th><a href="{{ route('user.bookings.pending') }}">{!! trans('forms.labels.pending_bookings') !!}</a></th>
                                    <th>{!! trans('forms.labels.icon.status') !!}</th>
                                    <th>{!! trans('forms.labels.icon.actions') !!}</th>
                                </tr>
                            </thead>
                            <tbody id="users_table">
                                @forelse ($tours as $tour)
                                    <tr>
                                        <td>{{ $tour->title }}</td>
                                        <td class=""><span
                                                class="col-md-8 ms-auto fw-bold">{{ formatPrice($tour->price) }}</span></td>
                                        <td class="">{{ $tour->start_date }}</td>
                                        <td class="">{{ $tour->end_date }}</td>
                                        <td class="text-center"><span
                                                class="badge badge-info w-50 m-auto">{{ $tour->max_seats - $tour->remaining_seats }}/{{ $tour->max_seats }}</span>
                                        </td>
                                        <td class="text-center"><span
                                                class="badge badge-warning w-50 m-auto">{{ $tour->pending_seats_count }}</span>
                                        </td>
                                        <td>{!! __('messages.' . $tour->status->value) !!}</td>


                                        <td class="d-flex">
                                            {{-- Button for show user --}}
                                            <a class="btn btn-success btn-inline-block flex-fill me-1"
                                                href="{{ route('user.tours.show', $tour->id) }}" data-toggle="tooltip"
                                                title="Show">
                                                {!! trans('buttons.show') !!}
                                            </a>

                                            @if ($tour->status != TourStatus::Full)
                                                {{-- Button for chat guide --}}
                                                @if (auth()->user()->canChat($tour))
                                                    <a class="btn btn-info btn-inline-block flex-fill me-1"
                                                        href="{{ route('user.tours.chat', $tour->id) }}"
                                                        data-toggle="tooltip" title="Chat">
                                                        {!! trans('buttons.chat') !!}
                                                    </a>
                                                @endif
                                                {{-- Button for edit user --}}
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
                                                        'data-title' => __('modals.ConfirmDeleteTitle', ['name' => __('titles.models.tour')]),
                                                        'data-message' => trans('modals.ConfirmDeleteMessage', ['name' => $tour->title]),
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                @endpermission

                                                @role('user')
                                                    {{-- Button for booking tour --}}
                                                    {!! Form::button(trans('buttons.booking'), [
                                                        'class' => 'btn btn-primary flex-fill',
                                                        'type' => 'button',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#bookingTour',
                                                        'data-title' => __('modals.bookingTour'),
                                                        'data-action' => route('user.booking.store'),
                                                        'data-tour_id' => $tour->id,
                                                        'data-max_seats' => $tour->max_seats,
                                                        'data-remaining_seats' => $tour->remaining_seats,
                                                    ]) !!}
                                                @endrole
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-info font-weight-bold">
                                            <span>{!! __('messages.no_data_found', ['name' => __('titles.tour')]) !!}</span>
                                        </td>
                                    </tr>
                                @endforelse
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
    @include('modals.modal-booking')
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
@endsection
