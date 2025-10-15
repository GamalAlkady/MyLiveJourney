<div class="col-md-4 mb-4" style="width: 18rem;">
    <div class="card shadow border-1 " style="width: 100%; background-color: #eee">
        {{-- <div class="row align-items-center"> --}}
        {{-- <div class="col-md-4"> --}}
        <img src="{{ asset('storage/place/' . $place->image) }}" class="card-img-top"
            alt="{{ $place->name }} " style="border-radius: 5%">
        {{-- </div> --}}

        <div class="card-body">
            <h3 class="card-title">{{ $place->name }}</h3>
            <p class="card-text">{{ $place->district->name }} | {{ $place->placetype->name }}</p>
            <a href="{{ route('place.details', $place->id) }}" class="btn btn-outline-primary">التفاصيل</a>
        </div>
        {{-- </div> --}}
    </div>
</div>