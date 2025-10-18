<div class="col-md-4 mb-4">
    <div class="card h-100">
        <div class="tour-places-images">
            @foreach ($tour->places as $place)
                <div class="place-thumbnail">
                    <img src="{{ asset('storage/place/' . $place->image) }}" alt="{{ $place->name }}" class="place-img"
                        data-toggle="tooltip" title="{{ $place->name }}">
                </div>
            @endforeach
        </div>

        {{-- <img src="{{ asset('storage/tourImage/' . $tour->tour_image) }}" class="card-img-top" --}} {{--
            alt="{{ $tour->name }}"> --}}
        <div class="card-body">
            <h5 class="card-title">{{ $tour->name }}</h5>
            <p class="card-text">
                <div>
                    {!! icon('mony', 'text-info') !!} <strong>{{ trans('forms.labels.price') }}</strong>
                {{ $tour->price }}
                </div>
                <div>
                    {!! icon('users', 'text-info') !!} <strong>{{ trans('forms.labels.people') }}</strong>
                {{ $tour->max_seats - $tour->remaining_seats }}/{{ $tour->max_seats }}
                </div>
              
                <div>
                    {!! icon('date', 'text-info') !!} <strong>{{ trans('forms.labels.pending_bookings') }}</strong>
                {{ $tour->pending_seats_count }}
                </div>
            </p>
        </div>
        <div class="card-footer bg-white border-0">
            <div class="d-flex justify-content-between">
                <a href="{{ route('tour.details', $tour->id) }}"
                    class="btn btn-outline-info">{{ trans('messages.details') }}</a>
                @auth
                    @role('user')
                         {!! Form::button(trans('buttons.book_now'), [
                            'class' => 'btn btn-outline-primary',
                            'type' => 'button',
                            'data-toggle' => 'modal',
                            'data-target' => '#bookingTour',
                            'data-title' => __('modals.bookingTour'),
                            'data-action'=>route('user.booking.store'),
                            'data-tour_id'=>$tour->id,
                            'data-max_seats'=>$tour->max_seats,
                            'data-remaining_seats'=>$tour->remaining_seats
                        ]) !!}
                    {{-- <a href="{{ route('tour.booking', $tour->id) }}" class="btn btn-outline-primary">
                        {!! trans('buttons.book_now') !!}</a> --}}
                    @endrole
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">{!! trans('buttons.book_now') !!}</a>
                @endguest
            </div>
        </div>
    </div>
</div>

    @include('modals.modal-booking')
