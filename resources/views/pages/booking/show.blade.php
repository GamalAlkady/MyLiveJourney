@extends('layouts.backend.master')
@section('title')
    {{ __('titles.booking_details') }}
@endsection
@use('App\Enums\BookingStatus')
@use('App\Enums\TourStatus')

@section('content')
    <div class="container px-3 px-md-4">
        <x-header>
            <x-slot:title>
                <div class="d-flex align-items-center">
                    <div class="icon icon-shape bg-white text-primary rounded-circle shadow p-3 me-3">
                        {!! icon('booking', 'fa-2x') !!}
                    </div>
                    <div>
                        <h2 class="mb-0">{{ trans_choice('titles.details', 1, ['name' => __('titles.booking')]) }}</h2>
                        <p class="mb-0 opacity-75">{{ __('forms.labels.id') }}: #{{ $booking->id }}</p>
                    </div>
                </div>
            </x-slot:title>
            <x-slot:link class="btn-light" href="{{ URL::previous() }}">
                {!! __('buttons.back') !!}
            </x-slot:link>
        </x-header>


        <div class="card">
            <div class="card-body">
                <!-- Main Content -->
                <div class="row g-4">
                    <!-- Tour Information Card -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    {!! icon('tour') !!}
                                    {{ trans_choice('titles.information', 1, ['name' => __('titles.tour')]) }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon icon-sm text-info me-2">
                                            {!! icon('name') !!}
                                        </div>
                                        <small class="text-muted">{{ __('forms.labels.title') }}</small>
                                    </div>
                                    <h6 class="ms-4">{{ $booking->tour->title }}</h6>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon icon-sm text-info me-2">
                                            {!! icon('duration') !!}
                                        </div>
                                        <small class="text-muted">{{ __('forms.labels.end_time') }}</small>
                                    </div>
                                    <h6 class="ms-4">{{ $booking->tour->human_date }}</h6>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon icon-sm text-info me-2">
                                            <i class="fas fa-map-pin"></i>
                                        </div>
                                        <small class="text-muted">{{ __('titles.places') }}</small>
                                    </div>
                                    <h6 class="ms-4">
                                        @foreach ($booking->tour->places as $place)
                                            <span class="badge bg-info me-2">{{ $place->name }}</span>
                                        @endforeach
                                    </h6>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon icon-sm text-info me-2">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <small class="text-muted">{{ __('forms.labels.description') }}</small>
                                    </div>
                                    <p class="ms-4 text-muted">{!! Str::limit($booking->tour->description, 100) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Information Card -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i
                                        class="fas fa-map-marked-alt me-2"></i>{{ trans_choice('titles.information', 1, ['name' => __('titles.booking')]) }}
                                </h5>
                            </div>

                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon icon-sm text-success me-2">
                                            <i class="fas fa-hashtag"></i>
                                        </div>
                                        <small class="text-muted">{{ __('forms.labels.id') }}</small>
                                    </div>
                                    <h6 class="ms-4">#{{ $booking->id }}</h6>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon icon-sm text-success me-2">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <small class="text-muted">{{ __('forms.labels.people') }}</small>
                                    </div>
                                    <h6 class="ms-4">{{ $booking->seats }}</h6>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon icon-sm text-success me-2">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </div>
                                        <small class="text-muted">{{ __('forms.labels.price') }}</small>
                                    </div>
                                    <h6 class="ms-4">{{ formatPrice($booking->total_price) }}</h6>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon icon-sm text-success me-2">
                                            <i class="fas fa-flag"></i>
                                        </div>
                                        <small class="text-muted">{{ __('forms.labels.status') }}</small>
                                    </div>
                                    <div class="ms-4">
                                        {!! __('status.' . $booking->status->value) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Tourist Information Card -->
                    @if ($booking->user_id == auth()->id() || auth()->user()->hasRole('admin|guide'))
                        <div class="col-lg-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fas fa-map-marked-alt me-2"></i>
                                        {{ trans_choice('titles.information', 1, ['name' => __('titles.tourist')]) }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        @if ($booking->tourist->profile && $booking->tourist->profile->avatar_status == 1)
                                            <img src="{{ $booking->tourist->profile->avatar }}"
                                                alt="{{ $booking->tourist->name }}" class="user-avatar-nav">
                                        @else
                                            <div class="user-avatar-nav me-2 mr-0"></div>
                                        @endif
                                        <div>
                                            <h5 class="mb-1">{{ $booking->tourist->name }}</h5>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="icon icon-sm text-warning me-2">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <small class="text-muted">{{ __('forms.labels.email') }}</small>
                                        </div>
                                        <h6 class="ms-4">{{ $booking->tourist->email }}</h6>
                                    </div>

                                    {{-- <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon icon-sm text-warning me-2">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <small class="text-muted">{{ __('forms.labels.phone') }}</small>
                                    </div>
                                    <h6 class="ms-4">{{ $booking->tourist->phone ?? __('messages.not_available') }}</h6>
                                </div> --}}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Guide Information Card -->

                    @if (auth()->id() == $booking->tour->guide_id)
                        <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-white border-0 pt-4 pb-3">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow p-2 me-2">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                    <h5 class="mb-0">
                                        {{ trans_choice('titles.information', 1, ['name' => __('titles.guide')]) }}</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    @if ($booking->guide->profile && $booking->guide->profile->avatar_status == 1)
                                        <img src="{{ $booking->guide->profile->avatar }}"
                                            alt="{{ $booking->guide->name }}" class="user-avatar-nav">
                                    @else
                                        <div class="user-avatar-nav me-2 mr-0"></div>
                                    @endif
                                    {{-- <div class="avatar avatar-xl rounded-circle bg-gradient-info text-white me-3">
                                        <i class="fas fa-user fa-2x"></i>
                                    </div> --}}
                                    <div>
                                        <h5 class="mb-1">
                                            @isset($booking->guide->name)
                                                {{ $booking->guide->name }}
                                            @else
                                                {{ __('messages.not_assigned') }}
                                            @endisset
                                        </h5>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon icon-sm text-info me-2">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <small class="text-muted">{{ __('forms.labels.email') }}</small>
                                    </div>
                                    <h6 class="ms-4">
                                        @isset($booking->guide->email)
                                            {{ $booking->guide->email }}
                                        @else
                                            {{ __('messages.not_assigned') }}
                                        @endisset
                                    </h6>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endif
                    
                </div>

                <!-- Actions Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-around flex-wrap">

                                    @role('admin|guide')
                                        @if ($booking->status == BookingStatus::APPROVED && $booking->tour->guide_id == auth()->user()->id)
                                            <div>
                                                <x-confirm-button :url="route('user.booking.approve', $booking->id)" :buttonName="__('buttons.approve')" :tooltip="__('tooltips.approve_booking')"
                                                    :modalTitle="__('modals.approveTitle') . ' ' . $booking->id" :modalMessage="__('modals.approveMessage')" modalClass="success" method="PUT" />
                                            </div>

                                            <div>
                                                <x-confirm-button :url="route('user.booking.reject', $booking->id)" :buttonName="__('buttons.reject')" :tooltip="__('tooltips.reject_booking')"
                                                    :modalTitle="__('modals.rejectTitle') . ' ' . $booking->id" :modalMessage="__('modals.rejectMessage')" modalClass="danger" method="PUT"
                                                    formTrigger="confirmRejecteedModal" />
                                            </div>
                                        @endif
                                    @endrole

                                    @role('user')
                                        @if ($booking->status == BookingStatus::PENDING)
                                            <div>
                                                <x-booking-button :tour_id="$booking->tour_id" :seats="$booking->seats" :remaining_seats="$booking->tour->remaining_seats"
                                                    data-id="{{ $booking->id }}" />
                                            </div>
                                            <div>
                                                <x-delete-button btnText="delete" :url="route('user.booking.destroy', $booking->id)" :itemName="__('titles.booking')"
                                                    :itemId="$booking->id" />
                                            </div>
                                        @elseif ($booking->status == BookingStatus::DISAPPROVED or $booking->tour->status == TourStatus::Completed)
                                            <div>
                                                <x-delete-button btnText="delete" :url="route('user.booking.destroy', $booking->id)" :itemName="__('titles.booking')"
                                                    :itemId="$booking->id" />
                                            </div>
                                        @endif
                                    @endrole
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @includeWhen(auth()->user()->hasRole('guide|admin'), 'modals.confirm-modal', [
        'formTrigger' => 'approveRequestModal',
        'modalClass' => 'success',
        'actionBtnIcon' => 'fa-check',
        'btnSubmitText' => 'Approve',
    ])

    @includeWhen(auth()->user()->hasRole('guide|admin'), 'modals.confirm-modal', [
        'formTrigger' => 'confirmRejecteedModal',
        'modalClass' => 'danger',
        'actionBtnIcon' => 'fa-times',
        'btnSubmitText' => 'Reject',
    ]) --}}
@endsection
