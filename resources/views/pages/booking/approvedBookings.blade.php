@extends('layouts.backend.master')
@section('title')
    {{ __('titles.approved_bookings') }}
@endsection
@use('App\Enums\BookingStatus')
@use('App\Enums\TourStatus')

@section('content')
    <x-container model="bookings" :titleHeader="trans('titles.approved_bookings')" :count="$bookings->count()">
        <x-slot:head>
            <th>{!! trans('forms.labels.icon.id') !!}</th>
            <th>{!! trans('forms.labels.icon.tour') !!}</th>
            <th>{!! trans('forms.labels.icon.guide') !!}</th>
            <th>{!! trans('forms.labels.icon.tourist') !!}</th>
            <th>{!! trans('forms.labels.icon.price') !!}</th>
            <th>{!! trans('forms.labels.icon.seats') !!}</th>
            <th>{!! trans('forms.labels.icon.actions') !!}</th>
        </x-slot:head>
        <x-slot:body>
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
                    <td class="d-flex">
                        @role('admin|guide')
                            @if ($list->status == BookingStatus::PENDING && $list->tour->guide_id == auth()->user()->id)
                                <x-confirm-button :url="route('user.booking.approve', $list->id)" :buttonName="__('buttons.approve')" :tooltip="__('tooltips.approve')" :modalTitle="__('modals.approveTitle')"
                                    :modalMessage="__('modals.approveMessage')" modalClass="success" method="PUT" :first="$loop->first" />

                                <x-confirm-button :url="route('user.booking.reject', $list->id)" :buttonName="__('buttons.reject')" :tooltip="__('tooltips.reject')" :modalTitle="__('modals.rejectTitle')"
                                    :modalMessage="__('modals.rejectMessage')" modalClass="danger" method="PUT" formTrigger="confirmRejecteedModal"
                                    :first="$loop->first" />
                            @else
                                <span class="flex-fill w-100 text-center">--------------</span>
                            @endif
                        @endrole


                        @role('user')
                            @if ($list->tour->status == TourStatus::Completed)
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
                        {!! __('messages.no_data_found') !!}</td>

                </tr>
            @endforelse
        </x-slot:body>

        <x-slot:foot>
            {{ $bookings->links() }}
        </x-slot:foot>
    </x-container>

@endsection
