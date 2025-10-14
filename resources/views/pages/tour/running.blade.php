@extends('layouts.backend.master')
@section('title')
    {{ __('titles.running_tours') }}
@endsection
@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    {!! trans('titles.icon_text.running_tours') !!} {{ __('titles.data') }}
                </h1>
                {{-- <a href="{{ route('user.users.index') }}" class="btn btn-light">
                    {!! trans('buttons.back_to', ['name' => __('usersmanagement.users')]) !!}
                </a> --}}
            </div>
        </div>
    </div>

    <div class="containr">

        <div class="row justify-content-center">
            <div class="col-md-12">

                {{-- @include('partials.successMessage') --}}

                <div class="card  mx-4">
                    <div class="card-header  bg-dar">
                        <h3 class="card-title float-left p-0 m-0">
                            <strong>{{ __('titles.showingAll', ['name' => __('titles.running_tours')]) }}
                                ({{ $tours->count() }})</strong></h3>
                    </div>
                    <!-- card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTableId" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>{!! trans('forms.labels.icon.title') !!}</th>
                                        <th>{!! trans('forms.labels.icon.price') !!}</th>
                                    <th>{!! trans('forms.labels.icon.start_date') !!}</th>
                                    <th>{!! trans('forms.labels.icon.end_date') !!}</th>
                                        <th>{!! trans('forms.labels.icon.guide') !!}</th>
                                        {{-- <th>{!! trans('forms.labels.icon.tourist') !!}</th> --}}
                                        {{-- <th>{!! trans('forms.labels.icon.tourist_contact') !!}</th> --}}
                                        <th>{!! trans('forms.labels.icon.actions') !!}</th>
                                    </tr>
                                </thead>
                                <tbody>
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

                                                <button type="submit"
                                                data-target='#confirmModal'
                                                data-toggle='modal'
                                                data-title="{{__('modals.completeTitle')}}"
                                                data-message="{{__('modals.completeMessage')}}"
                                                    class="btn btn-success btn-sm w-100 @disabled(auth()->user()->id == $list->guide_id)" data-toggle="tooltip" title="{{ trans('buttons.complete') }}">{!! trans('buttons.complete') !!}</button>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-danger font-weight-bold">
                                                {!! __('messages.no_data_found', ['name' => __('titles.running_tours')]) !!}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="completeTourModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="" id="completeTourForm" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">Are you sure to make this tour complete?</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">No, Go
                                                Back</button>
                                            <button type="submit" class="btn btn-success">Yes, Complete</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->
    @include('modals.confirm-modal',
    ['btnSubmitText'=>__('buttons.complete'),
    'modalClass'=>'success'])
@endsection

@section('scripts')
    <script>
        function handleTourComplete(id) {
            var form = document.getElementById('completeTourForm')
            form.action = 'package/complete/' + id
            $('#completeTourModal').modal('show')
        }
    </script>
@endsection
