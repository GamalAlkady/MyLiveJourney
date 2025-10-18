@extends('layouts.backend.master')
@section('title')
    {{ __('titles.approvedBookings') }}
@endsection
@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    {!! trans('titles.icon.approvedBookings') !!}
                </h1>
                {{-- <a href="{{ route('user.users.index') }}" class="btn btn-light">
                    {!! trans('buttons.back_to', ['name' => __('usersmanagement.users')]) !!}
                </a> --}}
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            {{-- @include('partials.successMessage') --}}

            @use('App\Enums\BookingStatus')

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-left p-0 m-0"><strong>{!! trans('titles.approvedBookings') !!}
                            ({{ $bookings->count() }})</strong></h3>
                </div>
                <!-- card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTableId" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{!! trans('forms.labels.icon.id') !!}</th>
                                    <th>{!! trans('forms.labels.icon.tour') !!}</th>
                                    <th>{!! trans('forms.labels.icon.guide') !!}</th>
                                    <th>{!! trans('forms.labels.icon.tourist') !!}</th>
                                    <th>{!! trans('forms.labels.icon.price') !!}</th>
                                    <th>{!! trans('forms.labels.icon.seats') !!}</th>
                                    <th>{!! trans('forms.labels.icon.status') !!}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $list)
                                    <tr>
                                        <td>
                                            {{ $list->id }}
                                        </td>
                                        <td>{{ $list->tour->title }}</td>
                                        <td>
                                            @isset($list->guide->name)
                                                {{ $list->guide->name }}
                                            @else
                                                His info is deleted by Admin
                                            @endisset

                                        </td>
                                        <td>{{ $list->tourist->name }}</td>
                                        <td>{{ formatPrice($list->total_price) }}</td>
                                        <td>{{ $list->seats }}</td>
                                        <td>{!! __('messages.' . $list->status->value) !!}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-info font-weight-bold">
                                            {!! __('messages.no_data_found', ['name' => __('titles.pending_tours')]) !!}</td>

                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>


                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
