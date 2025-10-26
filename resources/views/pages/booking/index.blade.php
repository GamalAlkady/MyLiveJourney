@extends('layouts.backend.master')
@section('title')
    {{ __('titles.pending_bookings') }}
@endsection
@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    {!! trans('titles.icon.pending_bookings') !!}
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

            @use('App\Enums\BookingStatus')

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-left p-0 m-0"><strong>{!! trans('titles.pending_bookings') !!}
                            ({{ $bookings->count() }})</strong></h3>
                </div>
                <!-- card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTableId" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{!! trans('forms.labels.icon.id') !!}</th>
                                    <th>{!! trans('forms.labels.icon.tour') !!}</th>
                                    <th>{!! trans('forms.labels.icon.guide') !!}</th>
                                    <th>{!! trans('forms.labels.icon.tourist') !!}</th>
                                    <th>{!! trans('forms.labels.icon.price') !!}</th>
                                    <th>{!! trans('forms.labels.icon.seats') !!}</th>
                                    <th>{!! trans('forms.labels.icon.status') !!}</th>
                                    <th>{!! trans('forms.labels.icon.actions') !!}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $list)
                                    <tr>
                                        <td>
                                            {{ $list->id }}
                                        </td>
                                        <td>{{ $list->tour->title }}</td>
                                        <td>
                                            @isset($list->guide->name)
                                                {{ $list->guide->name }}
                                            @else
                                                His info is deleted by Admin
                                            @endisset

                                        </td>
                                        <td>{{ $list->tourist->name }}</td>
                                        <td>{{ formatPrice($list->total_price) }}</td>
                                        <td>{{ $list->seats }}</td>
                                        <td>{!! __('messages.' . $list->status->value) !!}</td>
                                        <td class="d-flex">
                                            @role('admin|guide')
                                                @if ($list->status == BookingStatus::APPROVED && $list->tour->guide_id == auth()->user()->id)
                                                    {!! Form::open([
                                                        'url' => route('user.booking.approve', $list->id),
                                                        'class' => 'd-inline-block flex-fill me-1',
                                                        'data-toggle' => 'tooltip',
                                                        'title' => __('tooltips.approve'),
                                                    ]) !!}
                                                    {!! Form::hidden('_method', 'PUT') !!}
                                                    {!! Form::button(trans('buttons.approve'), [
                                                        'class' => 'btn btn-success btn-sm w-100',
                                                        'type' => 'button',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#approveRequestModal',
                                                        'data-title' => __('modals.approveTitle'),
                                                        'data-message' => trans('modals.approveMessage'),
                                                    ]) !!}
                                                    {!! Form::close() !!}

                                                    {!! Form::open([
                                                        'url' => route('user.booking.reject', $list->id),
                                                        'class' => 'd-inline-block flex-fill',
                                                        'data-toggle' => 'tooltip',
                                                        'title' => 'Delete',
                                                    ]) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button(trans('buttons.reject'), [
                                                        'class' => 'btn btn-danger btn-sm w-100',
                                                        'type' => 'button',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#confirmRejecteedModal',
                                                        'data-title' => __('modals.rejectTitle'),
                                                        'data-message' => trans('modals.rejectMessage'),
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                @else
                                                    <span class="flex-fill w-100 text-center">--------------</span>
                                                @endif
                                            @endrole


                                            @role('user')
                                                @if ($list->status != BookingStatus::APPROVED)
                                                    {!! Form::button(trans('buttons.edit'), [
                                                        'class' => 'btn btn-primary flex-fill me-1' . ($list->status->value == 'pending' ? '' : ' disabled'),
                                                        'type' => 'button',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#bookingTour',
                                                        'data-title' => __('modals.editBooking'),
                                                        'data-action' => route('user.booking.store'),
                                                        'data-id' => $list->id,
                                                        'data-tour_id' => $list->tour_id,
                                                        'data-seats' => $list->seats,
                                                        'data-remaining_seats' => $list->tour->remaining_seats,
                                                    ]) !!}

                                                    {!! Form::open([
                                                        'url' => route('user.booking.destroy', $list->id),
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
                                                        'data-title' => __('modals.ConfirmDeleteTitle', ['name' => __('titles.models.booking')]),
                                                        'data-message' => trans('modals.ConfirmDeleteMessage', ['name' => $list->id]),
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                @else
                                                    <span class="flex-fill w-100 text-center">--------------</span>
                                                @endif
                                            @endrole
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-info font-weight-bold">
                                            {!! __('messages.no_data_found', ['name' => __('titles.pending_tours')]) !!}</td>

                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>


                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    {{-- @include('modals.modal-booking-approve') --}}
    @include('modals.modal-booking')
    {{-- @include('modals.modal-delete') --}}

    @include('modals.confirm-modal', [
        // 'formTrigger' => 'confirmDelete',
        'modalClass' => 'danger',
        'actionBtnIcon' => 'fa-times',
    ])

    @includeWhen(auth()->user()->hasRole('guide|admin'), 'modals.confirm-modal', [
        'formTrigger' => 'approveRequestModal',
        'modalClass' => 'success',
        'actionBtnIcon' => 'fa-check',
        'btnSubmitText' => 'Approve',
    ])
@endsection

{{-- @section('scripts')
    @include('laravelblocker::scripts.confirm-modal', ['formTrigger' => '#confirmDelete'])

@endsection --}}
