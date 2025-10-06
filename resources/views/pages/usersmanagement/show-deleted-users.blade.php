@extends('layouts.backend.master')

@section('title')
    {!! trans('usersmanagement.show-deleted-users') !!}
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <style type="text/css" media="screen">
        .users-table {
            border: 0;
        }

        .users-table tr td:first-child {
            padding-left: 15px;
        }

        .users-table tr td:last-child {
            padding-right: 15px;
        }

        .users-table.table-responsive,
        .users-table.table-responsive table {
            margin-bottom: .15em;
        }
    </style>
@endsection

@section('content')

        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 mb-0 text-gray-800 text-danger">
                        {!! trans('titles.icon_text.deleted_users') !!}
                    </h1>
                    <a href="{{ route('user.users.index') }}" class="btn btn-light">
                        {!! trans('buttons.back_to',['name'=>__('usersmanagement.users')]) !!}
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {!! trans('usersmanagement.show-deleted-users') !!}
                            </span>
                            {{-- <div class="float-right">
                                <a href="{{ route('user.users.index') }}" class="btn btn-light btn-sm float-right"
                                    data-toggle="tooltip" data-placement="left"
                                    title="{{ trans('tooltips.backTo', ['name' => __('titles.users')]) }}">
                                    {!! trans('buttons.back_to', ['name' => __('usersmanagement.users')]) !!}
                                </a>
                            </div> --}}
                        </div>
                    </div>

                    <div class="card-body">

                        @if (count($users) === 0)
                            <tr>
                                <p class="text-center margin-half">
                                    {!! trans('usersmanagement.no-records') !!}
                                </p>
                            </tr>
                        @else
                            <div class="table-responsive users-table">
                                <table class="table table-striped table-sm data-table">
                                    <caption id="user_count">
                                        {{ trans_choice('usersmanagement.users-table.caption', 1, ['userscount' => $users->count()]) }}
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th class="hidden-xxs">ID</th>
                                            <th>{!! trans('usersmanagement.users-table.name') !!}</th>
                                            <th class="hidden-xs hidden-sm">Email</th>
                                            <th class="hidden-xs hidden-sm hidden-md">{!! trans('usersmanagement.users-table.fname') !!}</th>
                                            <th class="hidden-xs hidden-sm hidden-md">{!! trans('usersmanagement.users-table.lname') !!}</th>
                                            <th class="hidden-xs hidden-sm">{!! trans('usersmanagement.users-table.role') !!}</th>
                                            <th class="hidden-xs">{!! trans('usersmanagement.labelDeletedAt') !!}</th>
                                            <th class="hidden-xs">{!! trans('usersmanagement.labelIpDeleted') !!}</th>
                                            <th>{!! trans('usersmanagement.users-table.actions') !!}</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="hidden-xxs">{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td class="hidden-xs hidden-sm"><a href="mailto:{{ $user->email }}"
                                                        title="email {{ $user->email }}">{{ $user->email }}</a></td>
                                                <td class="hidden-xs hidden-sm hidden-md">{{ $user->first_name }}</td>
                                                <td class="hidden-xs hidden-sm hidden-md">{{ $user->last_name }}</td>
                                                <td class="hidden-xs hidden-sm">
                                                    @foreach ($user->roles as $user_role)
                                                        @if ($user_role->name == 'User')
                                                            @php $labelClass = 'primary' @endphp
                                                        @elseif ($user_role->name == 'Admin')
                                                            @php $labelClass = 'warning' @endphp
                                                        @elseif ($user_role->name == 'Unverified')
                                                            @php $labelClass = 'danger' @endphp
                                                        @else
                                                            @php $labelClass = 'default' @endphp
                                                        @endif

                                                        <span
                                                            class="label label-{{ $labelClass }}">{{ $user_role->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td class="hidden-xs">{{ $user->deleted_at }}</td>
                                                <td class="hidden-xs">{{ $user->deleted_ip_address }}</td>
                                                <td>
                                                    {!! Form::model($user, [
                                                        'route' => ['user.deleted.update', $user->id],
                                                        'method' => 'PUT',
                                                        'data-toggle' => 'tooltip',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fa fa-refresh" aria-hidden="true"></i>', [
                                                        'class' => 'btn btn-success btn-block btn-sm',
                                                        'type' => 'submit',
                                                        'data-toggle' => 'tooltip',
                                                        'title' => __('tooltips.restore',['name' => __('usersmanagement.users')]),
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-info btn-block"
                                                        href="{{ route('user.deleted.show', $user->id) }}"
                                                        data-toggle="tooltip" title="{{ __('tooltips.show', ['name' => __('usersmanagement.user')]) }}">
                                                        <i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    {!! Form::model($user, [
                                                        'route' => ['user.deleted.destroy', $user->id],
                                                        'method' => 'DELETE',
                                                        'class' => 'inline',
                                                        'data-toggle' => 'tooltip',
                                                        'title' => __('tooltips.destroy', ['name' => __('usersmanagement.user')]),
                                                    ]) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button('<i class="fa fa-user-times" aria-hidden="true"></i>', [
                                                        'class' => 'btn btn-danger btn-sm inline',
                                                        'type' => 'button',
                                                        'style' => 'width: 100%;',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#confirmDelete',
                                                        'data-title' => __('modals.ConfirmDeleteTitle', ['name' => __('usersmanagement.user')]),
                                                        'data-message' => __('modals.ConfirmDeleteMessage', ['name' => __('usersmanagement.user')]),
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
   
    @include('modals.modal-delete')

@endsection

@section('scripts')
    @if (count($users) > 10)
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @include('scripts.tooltips')
@endsection
