@extends('layouts.backend.master')
@section('title')
    {{ __('titles.districts') }}
@endsection


@section('css')
    @if (config('usersmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
    @endif
@endsection

@section('content')

    <x-container model="districts" :count="$districts->count()">
        @permission('create.districts')
            <x-slot:actionHeader>
                <button type="button" id="submitFormNew" class="btn btn-success btn-md float-right c-white"
                    data-target="#submitForm" data-modalClass="modal-success" data-toggle="modal"
                    data-title="{{ trans('titles.create', ['name' => __('titles.district')]) }}"
                    data-action="{{ route('user.districts.store') }}">{!! __('buttons.add') !!}</button>
            </x-slot:actionHeader>
        @endpermission

        <x-slot:head>
            <th>{!! trans('forms.labels.icon.name') !!}</th>
            <th>{!! trans('forms.labels.icon.place_count') !!}</th>
            <th>{!! trans('forms.labels.icon.created') !!}</th>
            @permission('delete.districts|update.districts')
                <th>{!! trans('forms.labels.icon.actions') !!}</th>
            @endpermission
            </tr>
        </x-slot:head>

        <x-slot:body>
            @forelse ($districts as $key => $district)
                <tr>
                    <td>{{ $district->name }}</td>
                    <td>{{ $district->places->count() }}</td>
                    <td>{{ $district->created_at }}</td>
                    {{-- <td>{{ $district->created_at->toFormattedDateString() }}</td> --}}
                    @permission('delete.districts|update.districts')
                        <td class="d-flex justify-content-between align-items-center">
                            {{-- <a href="{{ route('user.districts.edit', $district->id) }}"
                                                        class="btn btn-info"><i class="fa fa-edit"></i></a> --}}

                            @permission('update.districts')
                                <button type="button" id="submitFormNew"
                                    class="btn btn-success d-inline-block c-white flex-fill me-1" data-value="{{ $district->name }}"
                                    data-target="#submitForm" data-modalClass="modal-success" data-toggle="modal"
                                    data-title="{{ trans('titles.edit', ['name' => __('titles.district')]) }}"
                                    data-action="{{ route('user.districts.update', $district->id) }}"><i
                                        class="fa fa-edit"></i></button>
                            @endpermission

                            @permission('delete.districts')
                                <x-delete-button :url="route('user.districts.destroy', $district->id)" :itemName="$district->name" />
                            @endpermission
                        </td>
                    @endpermission
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-info font-weight-bold">
                        {!! __('messages.no_data_found', ['name' => __('titles.district')]) !!}</td>
                </tr>
            @endforelse

        </x-slot:body>
        <x-slot:foot>
            {{ $districts->links() }}
        </x-slot:foot>
    </x-container>


    {{-- @include('modals.modal-delete') --}}
    @include('modals.modal-submit')
@endsection

@push('scripts')
    @if (count($districts) > config('usersmanagement.datatablesJsStartCount') &&
            config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.submit-modal-script')

    @if (config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endpush
