@extends('layouts.backend.master')

@section('title')
    {{ trans('usersmanagement.showing-user', ['name' => $user->name]) }}
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    {!! trans('titles.icon.user') !!} {{ __('titles.details') }}
                </h1>
                <a href="{{ route('user.users.index') }}" class="btn btn-light btn-sm px-3 py-2 rounded hover-effect me-2">
                    {!! trans('buttons.back_to', ['name' => __('usersmanagement.users')]) !!}
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header">
                    <h5 class="mb-0 float-left">
                        <i class="fa fa-user-circle mr-2"></i>
                        {{ $user->name }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3 text-center">
                            <img src="@if ($user->profile && $user->profile->avatar_status == 1) {{ $user->profile->avatar }} @else {{ Gravatar::get($user->email) }} @endif"
                                alt="{{ $user->name }}" class="rounded-circle border shadow"
                                style="width: 120px; height: 120px; object-fit: cover;">
                            <div class="mt-2">
                                @foreach ($user->roles as $user_role)
                                    @php
                                        $badgeClass = 'secondary';
                                        if ($user_role->name == 'User') {
                                            $badgeClass = 'primary';
                                        } elseif ($user_role->name == 'Admin') {
                                            $badgeClass = 'warning';
                                        } elseif ($user_role->name == 'Guide') {
                                            $badgeClass = 'info';
                                        }
                                    @endphp
                                    <span class="badge badge-{{ $badgeClass }} mx-1">{{ $user_role->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-9">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th><i class="fa fa-id-card mr-1"></i> {{ trans('usersmanagement.labelUserName') }}
                                        </th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-envelope mr-1"></i> {{ trans('usersmanagement.labelEmail') }}
                                        </th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-user mr-1"></i> {{ trans('usersmanagement.labelFirstName') }}
                                        </th>
                                        <td>{{ $user->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-user mr-1"></i> {{ trans('usersmanagement.labelLastName') }}
                                        </th>
                                        <td>{{ $user->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-check-circle mr-1"></i>
                                            {{ trans('usersmanagement.labelStatus') }}</th>
                                        <td>
                                            @if ($user->activated == 1)
                                                <span
                                                    class="badge badge-success">{{ trans('usersmanagement.activated') }}</span>
                                            @else
                                                <span
                                                    class="badge badge-danger">{{ trans('usersmanagement.notActivated') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-signal mr-1"></i>
                                            {{ trans('usersmanagement.labelAccessLevel') }}</th>
                                        <td>
                                            @for ($i = 1; $i <= $user->level(); $i++)
                                                <span class="badge badge-info mx-1">{{ $i }}</span>
                                            @endfor
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-calendar-plus mr-1"></i>
                                            {{ trans('usersmanagement.labelCreatedAt') }}</th>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-calendar-check mr-1"></i>
                                            {{ trans('usersmanagement.labelUpdatedAt') }}</th>
                                        <td>{{ $user->updated_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header  font-weight-bold">
                                    <i class="fa fa-key mr-1"></i> {{ trans('usersmanagement.labelPermissions') }}
                                </div>
                                <div class="card-body">
                                    @foreach ($user->getPermissions() as $permission)
                                        @if (Str::contains($permission->name, 'View'))
                                            <span class="badge badge-primary mx-1">{{ $permission->name }}</span>
                                        @endif
                                        @if (Str::contains($permission->name, 'Create'))
                                            <span class="badge badge-info mx-1">{{ $permission->name }}</span>
                                        @endif
                                        @if (Str::contains($permission->name, 'Update'))
                                            <span class="badge badge-warning mx-1">{{ $permission->name }}</span>
                                        @endif
                                        @if (Str::contains($permission->name, 'Delete'))
                                            <span class="badge badge-danger mx-1">{{ $permission->name }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header font-weight-bold">
                                    <i class="fa fa-info-circle mr-1"></i> {{ trans('usersmanagement.labelOtherInfo') }}
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        @if ($user->signup_ip_address)
                                            <li><i class="fa fa-globe mr-1"></i>
                                                <strong>{{ trans('usersmanagement.labelIpEmail') }}:</strong>
                                                <code>{{ $user->signup_ip_address }}</code>
                                            </li>
                                        @endif
                                        @if ($user->signup_confirmation_ip_address)
                                            <li><i class="fa fa-check mr-1"></i>
                                                <strong>{{ trans('usersmanagement.labelIpConfirm') }}:</strong>
                                                <code>{{ $user->signup_confirmation_ip_address }}</code>
                                            </li>
                                        @endif
                                        @if ($user->signup_sm_ip_address)
                                            <li><i class="fa fa-share-alt mr-1"></i>
                                                <strong>{{ trans('usersmanagement.labelIpSocial') }}:</strong>
                                                <code>{{ $user->signup_sm_ip_address }}</code>
                                            </li>
                                        @endif
                                        @if ($user->admin_ip_address)
                                            <li><i class="fa fa-user-shield mr-1"></i>
                                                <strong>{{ trans('usersmanagement.labelIpAdmin') }}:</strong>
                                                <code>{{ $user->admin_ip_address }}</code>
                                            </li>
                                        @endif
                                        @if ($user->updated_ip_address)
                                            <li><i class="fa fa-sync mr-1"></i>
                                                <strong>{{ trans('usersmanagement.labelIpUpdate') }}:</strong>
                                                <code>{{ $user->updated_ip_address }}</code>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around mt-3">
                        <a href="{{ route('user.users.edit', $user->id) }}" class="btn btn-info mx-1">
                            {!! trans('buttons.edit_user') !!}
                        </a>
                        {!! Form::open(['url' => route('user.users.destroy', $user->id), 'class' => 'd-inline']) !!}
                        {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::button('<i class="fa fa-trash"></i> ' . trans('usersmanagement.deleteUser'), [
                            'class' => 'btn btn-danger',
                            'type' => 'button',
                            'data-toggle' => 'modal',
                            'data-target' => '#confirmDelete',
                            'data-title' => __('modals.ConfirmDeleteTitle', ['name' => __('titles.user')]),
                            'data-message' => __('modals.ConfirmDeleteMessage', ['name' => $user->name]),
                        ]) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modals.modal-delete')
@endsection

@push('scripts')
    @include('scripts.delete-modal-script')
    @if (config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endpush
