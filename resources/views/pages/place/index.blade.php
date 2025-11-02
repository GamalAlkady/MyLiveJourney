@extends('layouts.backend.master')
@section('title')
    {{ __('titles.places') }}
@endsection

@section('css')
    @if (config('usersmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
    @endif
@endsection
@section('content')
    <x-container model="places" :count="$places->count()">
        <x-slot:head>
            <th>{!! trans('forms.labels.icon.name') !!}</th>
            <th>{!! trans('forms.labels.icon.added_by') !!}</th>
            <th>{!! trans('titles.icon.district') !!}</th>
            <th>{!! trans('titles.icon.placetype') !!}</th>
            <th class="hidden-sm hidden-xs">{!! trans('forms.labels.icon.image') !!}</th>
            <th width="15%">{!! trans('forms.labels.icon.actions') !!}</th>
        </x-slot:head>

        <x-slot:body>
            @forelse ($places as $key => $place)
                <tr>
                    <td>{{ $place->name }}</td>
                    <td>{{ $place->addedBy }}</td>
                    <td>{{ $place->district->name }}</td>
                    <td>{{ $place->placetype->name }}</td>
                    <td class="hidden-sm hidden-xs">
                        <img style="width:50px;height:50px;" class="img-fluid"
                            src="{{ asset('storage/place/' . $place->image) }}" alt="image">
                    </td>
                    <td class="d-flex">
                        {{-- Button for show user --}}

                        <a href="{{ route('user.places.show', $place->id) }}"
                            class="btn btn-success flex-fill me-1">{!! trans('buttons.icon.show') !!}</a>

                        @permission('update.places')
                            <a href="{{ route('user.places.edit', $place->id) }}"
                                class="btn btn-info flex-fill me-1">{!! trans('buttons.icon.edit') !!}</a>
                        @endpermission

                        {{-- Button for delete user --}}
                        @permission('delete.places')
                            {!! Form::open([
                                'url' => route('user.places.destroy', $place->id),
                                'class' => 'd-inline-block flex-fill',
                                'data-toggle' => 'tooltip',
                                'title' => 'Delete',
                            ]) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::button(trans('buttons.icon.delete'), [
                                'class' => 'btn btn-danger w-100',
                                'type' => 'button',
                                'data-toggle' => 'modal',
                                'data-target' => '#confirmDelete',
                                'data-title' => __('modals.ConfirmDeleteTitle', ['name' => __('titles.place')]),
                                'data-message' => trans('modals.ConfirmDeleteMessage', [
                                    'name' => '<strong class="text-danger">' . $place->name . '</strong>',
                                ]),
                            ]) !!}
                            {!! Form::close() !!}
                        @endpermission
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        <h2 class="text-info font-weight-bold">{!! __('messages.no_data_found', ['name' => __('titles.place')]) !!}</h2>
                    </td>
                </tr>
            @endforelse
        </x-slot:body>

        <x-slot:foot>
            {{ $places->links() }}
        </x-slot:foot>

    </x-container>

    @include('modals.modal-delete')
@endsection

@push('scripts')
    @if (count($places) > config('usersmanagement.datatablesJsStartCount') && config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @if (config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif

@endpush
