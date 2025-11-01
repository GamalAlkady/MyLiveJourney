@props(['tour_id' => null, 'seats' => 1, 'remaining_seats' => null])
<button {{ $attributes->class(['btn btn-sm btn-outline-primary']) }} data-toggle="modal" data-target="#bookingTour"
    data-action="{{ route('user.booking.store') }}" data-tour_id="{{ $tour_id }}" data-seats="{{ $seats }}"
    data-remaining_seats="{{ $remaining_seats }}">
    @if ($slot->isEmpty())
        {!!  iconText('booking_now',__('buttons.book_now')) !!}
    @else
        {{ $slot }}
    @endif
</button>

@pushonce('modals')
    @include('modals.modal-booking')
@endPushOnce
