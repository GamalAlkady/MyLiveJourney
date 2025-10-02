@extends('layouts.backend.master')

@section('title')
    {!!trans('usersmanagement.showing-user-deleted')!!} {{ $user->name }}
@endsection

@php
    $levelAmount = 'Level:';
    if ($user->level() >= 2) {
        $levelAmount = 'Levels:';
    }
@endphp

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-user-slash text-danger mr-2"></i>
                        {!! trans('usersmanagement.usersDeletedPanelTitle') !!}
                    </h1>
                    <a href="{{ route('admin.users.deleted') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {!! trans('usersmanagement.usersBackDelBtn') !!}
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4">
                <div class="card shadow mb-4">
                    <div class="card-header bg-danger py-3">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-user mr-1"></i>
                            User Information
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="@if ($user->profile && $user->profile->avatar_status == 1) {{ $user->profile->avatar }} @else {{ Gravatar::get($user->email) }} @endif"
                                 alt="{{ $user->name }}" class="rounded-circle img-fluid" style="max-width: 150px;">
                        </div>
                        <h4 class="text-center mb-3">{{ $user->name }}</h4>
                        <hr>
                        <div class="mb-3">
                            <strong class="text-gray-600">Full Name:</strong>
                            <p class="mb-0">{{ $user->first_name }} {{ $user->last_name }}</p>
                        </div>
                        <div class="mb-3">
                            <strong class="text-gray-600">Email:</strong>
                            <p class="mb-0">{{ $user->email }}</p>
                        </div>
                        <div class="mb-3">
                            <strong class="text-gray-600">Status:</strong>
                            @if ($user->activated == 1)
                                <span class="badge badge-success">{{ trans('usersmanagement.activated') }}</span>
                            @else
                                <span class="badge badge-danger">{{ trans('usersmanagement.notActivated') }}</span>
                            @endif
                        </div>
                        @if ($user->profile)
                            <div class="d-grid gap-2 mt-4">
                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">
                                        {!! trans('buttons.restore_user') !!}
                                    </button>
                                </form>
                                <button type="button" class="btn btn-danger d-inline" data-toggle="modal" data-target="#confirmDelete" title="{{ trans('usersmanagement.tooltips.permanentlyDelete') }}">
                                    <i class="fas fa-user-times mr-2"></i> {!! trans('usersmanagement.deleteUser') !!}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card shadow mb-4">
                    <div class="card-header bg-danger py-3">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-info-circle mr-1"></i>
                            User Details
                        </h6>
                    </div>
                    <div class="card-body">
                        @if ($user->deleted_at)
                            <div class="alert alert-warning mb-4" role="alert">
                                <h5 class="alert-heading"><i class="fas fa-exclamation-triangle mr-2"></i>Deleted At</h5>
                                <p class="mb-0">{{ $user->deleted_at }}</p>
                            </div>
                        @endif

                        @if ($user->deleted_ip_address)
                            <div class="alert alert-warning mb-4" role="alert">
                                <h5 class="alert-heading"><i class="fas fa-network-wired mr-2"></i>Deleted IP Address</h5>
                                <p class="mb-0">{{ $user->deleted_ip_address }}</p>
                            </div>
                        @endif

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5 class="text-gray-600">
                                        <i class="fas fa-user-tag mr-2"></i>Username
                                    </h5>
                                    <p class="mb-0">{{ $user->name }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5 class="text-gray-600">
                                        <i class="fas fa-envelope mr-2"></i>Email
                                    </h5>
                                    <p class="mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5 class="text-gray-600">
                                        <i class="fas fa-user mr-2"></i>First Name
                                    </h5>
                                    <p class="mb-0">{{ $user->first_name }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5 class="text-gray-600">
                                        <i class="fas fa-user mr-2"></i>Last Name
                                    </h5>
                                    <p class="mb-0">{{ $user->last_name }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5 class="text-gray-600">
                                        <i class="fas fa-user-shield mr-2"></i>Roles
                                    </h5>
                                    <div class="d-flex flex-wrap">
                                        @foreach ($user->roles as $user_role)
                                            @if ($user_role->name == 'User')
                                                @php $badgeClass = 'primary' @endphp
                                            @elseif ($user_role->name == 'Admin')
                                                @php $badgeClass = 'warning' @endphp
                                            @elseif ($user_role->name == 'Unverified')
                                                @php $badgeClass = 'danger' @endphp
                                            @else
                                                @php $badgeClass = 'default' @endphp
                                            @endif
                                            <span class="badge badge-{{$badgeClass}} mr-2 mb-2">{{ $user_role->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5 class="text-gray-600">
                                        <i class="fas fa-layer-group mr-2"></i>Access Level {{ $levelAmount }}
                                    </h5>
                                    <div class="d-flex flex-wrap">
                                        @if($user->level() >= 5)
                                            <span class="badge badge-primary mr-2 mb-2">5</span>
                                        @endif

                                        @if($user->level() >= 4)
                                            <span class="badge badge-info mr-2 mb-2">4</span>
                                        @endif

                                        @if($user->level() >= 3)
                                            <span class="badge badge-success mr-2 mb-2">3</span>
                                        @endif

                                        @if($user->level() >= 2)
                                            <span class="badge badge-warning mr-2 mb-2">2</span>
                                        @endif

                                        @if($user->level() >= 1)
                                            <span class="badge badge-secondary mr-2 mb-2">1</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="mb-3">
                                    <h5 class="text-gray-600">
                                        <i class="fas fa-key mr-2"></i>Permissions
                                    </h5>
                                    <div class="d-flex flex-wrap">
                                        @if($user->canViewUsers())
                                            <span class="badge badge-primary mr-2 mb-2">
                                                <i class="fas fa-eye mr-1"></i>{{ trans('permsandroles.permissionView') }}
                                            </span>
                                        @endif

                                        @if($user->canCreateUsers())
                                            <span class="badge badge-info mr-2 mb-2">
                                                <i class="fas fa-plus mr-1"></i>{{ trans('permsandroles.permissionCreate') }}
                                            </span>
                                        @endif

                                        @if($user->canEditUsers())
                                            <span class="badge badge-warning mr-2 mb-2">
                                                <i class="fas fa-edit mr-1"></i>{{ trans('permsandroles.permissionEdit') }}
                                            </span>
                                        @endif

                                        @if($user->canDeleteUsers())
                                            <span class="badge badge-danger mr-2 mb-2">
                                                <i class="fas fa-trash-alt mr-1"></i>{{ trans('permsandroles.permissionDelete') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5 class="text-gray-600">
                                        <i class="fas fa-calendar-plus mr-2"></i>Created At
                                    </h5>
                                    <p class="mb-0">{{ $user->created_at }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5 class="text-gray-600">
                                        <i class="fas fa-calendar-alt mr-2"></i>Updated At
                                    </h5>
                                    <p class="mb-0">{{ $user->updated_at }}</p>
                                </div>
                            </div>
                        </div>

                        <h5 class="text-gray-600 mb-3">
                            <i class="fas fa-network-wired mr-2"></i>IP Addresses
                        </h5>

                        @if ($user->signup_ip_address)
                            <div class="mb-3">
                                <h6 class="text-gray-600">Signup IP:</h6>
                                <code class="d-block bg-light p-2 rounded">{{ $user->signup_ip_address }}</code>
                            </div>
                        @endif

                        @if ($user->signup_confirmation_ip_address)
                            <div class="mb-3">
                                <h6 class="text-gray-600">Confirmation IP:</h6>
                                <code class="d-block bg-light p-2 rounded">{{ $user->signup_confirmation_ip_address }}</code>
                            </div>
                        @endif

                        @if ($user->signup_sm_ip_address)
                            <div class="mb-3">
                                <h6 class="text-gray-600">Social Media IP:</h6>
                                <code class="d-block bg-light p-2 rounded">{{ $user->signup_sm_ip_address }}</code>
                            </div>
                        @endif

                        @if ($user->admin_ip_address)
                            <div class="mb-3">
                                <h6 class="text-gray-600">Admin IP:</h6>
                                <code class="d-block bg-light p-2 rounded">{{ $user->admin_ip_address }}</code>
                            </div>
                        @endif

                        @if ($user->updated_ip_address)
                            <div class="mb-3">
                                <h6 class="text-gray-600">Update IP:</h6>
                                <code class="d-block bg-light p-2 rounded">{{ $user->updated_ip_address }}</code>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')
@endsection

@section('scripts')
    @include('scripts.delete-modal-script')
    @include('scripts.tooltips')
@endsection
