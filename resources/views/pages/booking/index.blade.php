@extends('layouts.backend.master')
@section('title')
    {{ __('titles.pending_bookings') }}
@endsection
@use('App\Enums\BookingStatus')
@use('App\Enums\TourStatus')

@section('content')
    <x-container model="bookings" :count="$bookings->count()">

        <x-slot:head>
            <th>{!! trans('forms.labels.icon.id') !!}</th>
            <th>{!! trans('forms.labels.icon.tour') !!}</th>
            <th>{!! trans('forms.labels.icon.guide') !!}</th>
            <th>{!! trans('forms.labels.icon.tourist') !!}</th>
            <th>{!! trans('forms.labels.icon.price') !!}</th>
            <th>{!! trans('forms.labels.icon.seats') !!}</th>
            <th>{!! trans('forms.labels.icon.status') !!}</th>
            <th>{!! trans('forms.labels.icon.actions') !!}</th>
        </x-slot:head>

        <x-slot:body>
            @forelse ($bookings as $list)
                <tr>
                    <td>
                        <a href="{{ route('user.bookings.show', $list->id) }}"
                            class="text-primary text-decoration-none fw-bold">
                            #{{ $list->id }}
                        </a>
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
                    <td>{!! __('status.' . $list->status->value) !!}</td>
                    <td class="d-flex">
                        @role('admin|guide')
                            @if ($list->status == BookingStatus::PENDING && $list->tour->guide_id == auth()->user()->id)
                                <x-confirm-button :url="route('user.booking.approve', $list->id)" :buttonName="__('buttons.approve')" 
                                    :tooltip="__('tooltips.approve_booking')" :modalTitle="__('modals.approveTitle') .' '. $list->id"
                                    :modalMessage="__('modals.approveMessage')" modalClass="success" method="PUT"  />

                                <x-confirm-button :url="route('user.booking.reject', $list->id)" :buttonName="__('buttons.reject')" 
                                    :tooltip="__('tooltips.reject_booking')" :modalTitle="__('modals.rejectTitle') .' '. $list->id"
                                    :modalMessage="__('modals.rejectMessage')" modalClass="danger" method="PUT" formTrigger="confirmRejecteedModal"/>

                            @else
                                <span class="flex-fill w-100 text-center">--------------</span>
                            @endif
                        @endrole


                        @role('user')
                            @if ($list->status == BookingStatus::PENDING)
                                <x-booking-button :tour_id="$list->tour_id" :seats="$list->seats" :remaining_seats="$list->tour->remaining_seats"
                                    data-id="{{ $list->id }}" class="me-2" />
                            @elseif ($list->status == BookingStatus::DISAPPROVED or $list->tour->status == TourStatus::Completed)
                                <x-delete-button :url="route('user.booking.destroy', $list->id)" :itemName="__('titles.booking')" :itemId="$list->id" />
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
        </x-slot:body>

        <x-slot:foot>
            {{ $bookings->links() }}
        </x-slot:foot>
    </x-container>

    {{-- @include('modals.modal-booking-approve') --}}
    {{-- @include('modals.modal-booking') --}}
    {{-- @include('modals.modal-delete') --}}

    {{-- @include('modals.confirm-modal', [
        // 'formTrigger' => 'confirmDelete',
        'modalClass' => 'danger',
        'actionBtnIcon' => 'fa-times', --}}
    {{-- ]) --}}

    {{-- @includeWhen(auth()->user()->hasRole('guide|admin'), 'modals.confirm-modal', [
        'formTrigger' => 'approveRequestModal',
        'modalClass' => 'success',
        'actionBtnIcon' => 'fa-check',
        'btnSubmitText' => 'Approve',
    ]) --}}
@endsection

{{-- @section('scripts')
    @include('laravelblocker::scripts.confirm-modal', ['formTrigger' => '#confirmDelete'])

@endsection --}}
