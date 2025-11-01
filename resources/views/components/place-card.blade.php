@php
    $widthClass = match ($size) {
        'small' => 'col-md-3',
        'large' => 'col-md-6',
        'full' => 'col-12',
        default => 'col-md-4',
    };
@endphp

<div class="row">
    @forelse ($places as $place)
        {{-- @dd($place) --}}
        <div {{ $attributes->merge(['class' => 'col-sm-12 col-md-4']) }}>
            <div class="place-card">
                <a href="{{ route('place.details', $place->id) }}" class="place-image">
                    <img src="{{ asset('storage/place/' . $place->image) }}" alt="{{ $place->name }}">
                </a>
                <div class="place-details">
                    <a href="{{ route('place.details', $place->id) }}">
                        <h2 class="place-name">{{ $place->name }}</h2>
                    </a>
                    <p class="place-info">
                        <i class="fa fa-map-marker"></i> {{ $place->district->name }}
                    </p>
                    <p class="place-info">
                        <i class="fa fa-tag"></i> {{ $place->placetype->name }}
                    </p>
                    {{-- <a href="{{ route('place.details', $place->id) }}" class="details-btn">
                        {!! trans('buttons.more_details') !!}
                    </a> --}}
                </div>

            </div>
        </div>
    @empty
        @include('partials.empty')
        {{-- <div class="col-12">
            <div class="no-places">
                <h2><i class="fa fa-info-circle"></i> لم يتم العثور على أماكن. يرجى إضافة بعض الأماكن.</h2>
            </div>
        </div> --}}
    @endforelse
</div>
