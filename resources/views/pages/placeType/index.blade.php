@extends('layouts.backend.master')
@section('title')
    {{ __('titles.placetypes') }}
@endsection
@section('css')
    @if (config('usersmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
    @endif
@endsection

@section('content')

    <x-container model="placetypes" :count="$types->count()" :addThe="false">
        <x-slot:actionHeader>
            @permission('create.placetypes')
                <button type="button" id="submitFormNew" class="btn btn-success btn-md float-right c-white"
                    data-target="#submitForm" data-modalClass="modal-success" data-toggle="modal"
                    data-title="{{ trans('titles.create', ['name' => __('titles.placetype')]) }}"
                    data-action="{{ route('user.placetypes.store') }}">{!! __('buttons.add') !!}</button>
            @endpermission
        </x-slot:actionHeader>
        <x-slot:head>
            <th>{!! __('forms.labels.icon.name') !!}</th>
            <th>{!! __('forms.labels.icon.place_count') !!}</th>
            <th>{!! __('forms.labels.icon.created') !!}</th>
            @permission('update.placetypes|delete.placetypes')
                <th>{!! __('forms.labels.icon.actions') !!}</th>
            @endpermission
        </x-slot:head>

        <x-slot:body>
            @forelse ($types as $key => $type)
                <tr>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->places->count() }}</td>
                    <td>{{ $type->created_at->toFormattedDateString() }}</td>

                    @permission('update.placetypes|delete.placetypes')
                        <td class="d-flex">
                            @permission('update.placetypes')
                                <button type="button" id="btnUpdate" class="btn btn-success d-inline-block c-white flex-fill me-1"
                                    data-value="{{ $type->name }}" data-target="#submitForm" data-modalClass="modal-success"
                                    data-toggle="modal" data-title="{{ trans('titles.edit', ['name' => __('titles.placetype')]) }}"
                                    data-action="{{ route('user.placetypes.update', $type->id) }}">
                                    <i class="fa fa-edit"></i></button>
                            @endpermission

                            @permission('delete.placetypes')
                                <x-delete-button :url="route('user.placetypes.destroy', $type->id)" :itemName="$type->name" />
                            @endpermission
                        </td>
                    @endpermission

                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-info font-weight-bold">
                        {!! __('messages.no_data_found', ['name' => __('titles.placetypes')]) !!}
                    </td>
                </tr>
            @endforelse
        </x-slot:body>

        <x-slot:foot>
            {{ $types->links() }}
        </x-slot:foot>
    </x-container>


    {{-- @include('modals.modal-delete') --}}
    @include('modals.modal-submit')

@endsection

@push('scripts')
    @if (count($types) > config('usersmanagement.datatablesJsStartCount') && config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.submit-modal-script')
    @if (config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endpush
