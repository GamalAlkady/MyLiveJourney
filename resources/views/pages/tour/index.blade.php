@extends('layouts.backend.master')

@section('title')
    {{ __('titles.tours') }}
@endsection

@section('css')
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
@endsection
@use('App\Enums\TourStatus')
@section('content')

    <x-container model="tours" :count="$tours->count()">
        <x-slot:head>
            <th scope="col">{{ __('forms.labels.title') }}</th>
            <th scope="col">{{ __('forms.labels.price') }}</th>
            <th scope="col">{{ __('forms.labels.start_date') }}</th>
            <th scope="col">{{ __('forms.labels.end_date') }}</th>
            <th scope="col" class="text-center">{{ __('forms.labels.people') }}</th>
            <th scope="col" class="text-center">
                <a href="{{ route('user.bookings.pending') }}" class="text-decoration-none">
                    {{ __('forms.labels.pending_bookings') }}
                </a>
            </th>
            <th scope="col">{{ __('forms.labels.status') }}</th>
            <th scope="col" class="text-center">{{ __('forms.labels.actions') }}</th>
        </x-slot:head>

        <x-slot:body>
            @forelse ($tours as $tour)
                <tr>
                    <td class="fw-bold"><a href="{{ route('user.tours.show', $tour->id) }}">{{ $tour->title }}</a></td>
                    <td>
                        <span class="fs-4 text-info">
                            {{ formatPrice($tour->price) }}
                        </span>
                    </td>
                    <td>{{ $tour->start_date }}</td>
                    <td>{{ $tour->end_date }}</td>
                    <td class="text-center">
                        <div class="tour-seats">
                            <div class="progress" style="height: 10px;">
                                <?php
                                $percentage = (($tour->max_seats - $tour->remaining_seats) / $tour->max_seats) * 100;
                                $progressClass = $percentage >= 80 ? 'bg-danger' : ($percentage >= 50 ? 'bg-warning' : 'bg-success');
                                ?>
                                <div class="progress-bar {{ $progressClass }}" role="progressbar"
                                    style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <small class="text-muted">
                                {{ $tour->max_seats - $tour->remaining_seats }}/{{ $tour->max_seats }}
                            </small>
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="badge badge-warning">
                            {{ $tour->pending_seats_count }}
                        </span>
                    </td>
                    <td>
                        {!! __('status.' . $tour->status->value) !!}
                    </td>
                    <td>
                        <div class="action-buttons d-flex flex-wrap justify-content-center">

                            @if ($tour->status != TourStatus::Full)
                                @if (auth()->user()->canChat($tour))
                                    <a href="{{ route('user.tours.chat', $tour->id) }}"
                                        class="btn btn-sm btn-info flex-fill me-1" data-toggle="tooltip" title="Chat">
                                        <i class="fas fa-comments"></i>
                                    </a>
                                @endif

                                @if (auth()->id() == $tour->guide_id)
                                    <a href="{{ route('user.tours.edit', $tour->id) }}"
                                        class="btn btn-sm btn-primary flex-fill me-1" data-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <x-delete-button :url="route('user.tours.destroy', $tour->id)" :itemName="$tour->title" />
                                @elseif(auth()->user()->hasRole('user'))
                                    {{-- @role('user') --}}
                                    <x-booking-button :tour_id="$tour->id" :remaining_seats="$tour->remaining_seats" />
                                @else
                                    <span>---------</span>
                                    {{-- @endrole --}}
                                    {{-- @unless ()
                                    @endunless --}}
                                @endif
                            @else
                                <span>---------</span>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-5">
                        <div class="no-data-found">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">
                                {!! __('messages.no_data_found', ['name' => __('titles.tours')]) !!}</h4>
                            @permission('create.tours')
                                <a href="{{ route('user.tours.create') }}" class="btn btn-primary mt-3">
                                    {!! __('buttons.add') !!}
                                </a>
                            @endpermission
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-slot:body>

        <x-slot:foot>
            {{ $tours->links() }}
        </x-slot:foot>
    </x-container>

    <!-- نافذة الحوار لحذف الحزمة -->
    {{-- @include('modals.modal-delete') --}}
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
