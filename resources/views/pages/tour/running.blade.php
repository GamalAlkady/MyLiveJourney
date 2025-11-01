@extends('layouts.backend.master')
@section('title')
    {{ __('titles.running_tours') }}
@endsection
@section('content')
    <x-container model="tours" :titleHeader="trans('titles.running_tours')" :count="$tours->count()" :addThe="true">
        <x-slot:actionHeader></x-slot:actionHeader>
        <x-slot:head>
            <th>{!! trans('forms.labels.icon.title') !!}</th>
            <th>{!! trans('forms.labels.icon.price') !!}</th>
            <th>{!! trans('forms.labels.icon.start_date') !!}</th>
            <th>{!! trans('forms.labels.icon.end_date') !!}</th>
            <th>{!! trans('forms.labels.icon.guide') !!}</th>
            {{-- <th>{!! trans('forms.labels.icon.tourist') !!}</th> --}}
            {{-- <th>{!! trans('forms.labels.icon.tourist_contact') !!}</th> --}}
            <th>{!! trans('forms.labels.icon.actions') !!}</th>
        </x-slot:head>

        <x-slot:body>
            @forelse ($tours as $list)
                <tr>
                    <td>{{ $list->title }}</td>
                    <td>{{ $list->price }}</td>
                    <td>{{ $list->start_date }}</td>
                    <td>{{ $list->end_date }}</td>
                    <td>
                        @isset($list->guide->name)
                            {{ $list->guide->name }}
                        @else
                            His info is deleted by Admin
                        @endisset

                    </td>
                    {{-- <td>{{ $list->tourist->name }}</td> --}}
                    {{-- <td>{{ $list->tourist->contact }}</td> --}}
                    <td>

                        <form action="{{ route('user.tour.complete', $list->id) }}" method="post">
                            @csrf
                            <button type="button" data-target='#confirmModal' data-toggle='modal'
                                data-title="{{ __('modals.completeTitle') }}"
                                data-message="{{ __('modals.completeMessage') }}"
                                class="btn btn-success btn-sm w-100 @disabled(auth()->user()->id != $list->guide_id)" data-toggle="tooltip"
                                title="{{ trans('buttons.complete') }}">{!! trans('buttons.complete') !!}</button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-danger font-weight-bold">
                        {!! __('messages.no_data_found') !!}
                    </td>
                </tr>
            @endforelse
        </x-slot:body>

        <x-slot:foot>
        </x-slot:foot>
    </x-container>
    
    @include('modals.confirm-modal', [
        'btnSubmitText' => __('buttons.complete'),
        'modalClass' => 'success',
    ])
@endsection
