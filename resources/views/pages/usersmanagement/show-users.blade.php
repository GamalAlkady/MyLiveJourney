@extends('layouts.backend.master')
@section('title')
    {!! trans('usersmanagement.showing-all-users') !!}
@endsection

@section('css')
    @if (config('usersmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
    @endif
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
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    {!! trans('titles.icon_text.users') !!} {{ __('titles.data') }}
                </h1>
                {{-- <a href="{{ route('user.users.index') }}" class="btn btn-light">
                    {!! trans('buttons.back_to', ['name' => __('usersmanagement.users')]) !!}
                </a> --}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">

                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {!! trans('titles.showingAll', ['name' => __('usersmanagement.users') ]) !!}
                        </span>

                        <div class="btn-group pull-right btn-group-xs">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                <span class="sr-only">
                                    {!! trans('usersmanagement.users-menu-alt') !!}
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('user.users.create') }}">
                                    {{-- <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i> --}}
                                    {!! trans('buttons.create_user') !!}
                                </a>
                                <a class="dropdown-item" href="{{ route('user.deleted') }}">
                                    <i class="fa fa-fw fa-group" aria-hidden="true"></i>
                                    {!! trans('usersmanagement.show-deleted-users') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    @if (config('usersmanagement.enableSearchUsers'))
                        @include('partials.search-users-form')
                    @endif

                    <div class="table-responsive users-table">
                        <table class="table table-striped table-sm data-table">

                            <caption id="user_count">
                                {{ trans_choice('usersmanagement.users-table.caption', 1, ['userscount' => $users->count()]) }}
                            </caption>
                            <thead class="thead">
                                <tr>
                                    <th>{!! trans('usersmanagement.users-table.id') !!}</th>
                                    <th>{!! trans('usersmanagement.users-table.name') !!}</th>
                                    <th class="hidden-xs">{!! trans('usersmanagement.users-table.email') !!}</th>
                                    <th class="hidden-xs">{!! trans('usersmanagement.users-table.fname') !!}</th>
                                    <th class="hidden-xs">{!! trans('usersmanagement.users-table.lname') !!}</th>
                                    <th>{!! trans('usersmanagement.users-table.role') !!}</th>
                                    <th class="hidden-sm hidden-xs hidden-md">{!! trans('usersmanagement.users-table.created') !!}</th>
                                    <th class="hidden-sm hidden-xs hidden-md">{!! trans('usersmanagement.users-table.updated') !!}</th>
                                    <th>{!! trans('usersmanagement.users-table.actions') !!}</th>

                                </tr>
                            </thead>
                            <tbody id="users_table">
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td class="hidden-xs"><a href="mailto:{{ $user->email }}"
                                                title="email {{ $user->email }}">{{ $user->email }}</a></td>
                                        <td class="hidden-xs">{{ $user->first_name }}</td>
                                        <td class="hidden-xs">{{ $user->last_name }}</td>
                                        <td>
                                            @foreach ($user->roles as $user_role)
                                                @if ($user_role->name == 'Guide')
                                                    @php $badgeClass = 'primary' @endphp
                                                @else
                                                    @php $badgeClass = 'default' @endphp
                                                @endif
                                                <span
                                                    class="badge badge-{{ $badgeClass }}">{{ $user_role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td class="hidden-sm hidden-xs hidden-md">{{ $user->created_at }}</td>
                                        <td class="hidden-sm hidden-xs hidden-md">{{ $user->updated_at }}</td>
                                        <td>
                                            {{-- Button for delete user --}}
                                            {!! Form::open([
                                                'url' => 'admin/users/' . $user->id,
                                                'class' => 'd-inline-block',
                                                'data-toggle' => 'tooltip',
                                                'title' => 'Delete',
                                            ]) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('buttons.delete'), [
                                                'class' => 'btn btn-danger',
                                                'type' => 'button',
                                                'data-toggle' => 'modal',
                                                'data-target' => '#confirmDelete',
                                                'data-title' => 'Delete User',
                                                'data-message' => 'Are you sure you want to delete this user ?',
                                            ]) !!}
                                            {!! Form::close() !!}

                                            {{-- Button for show user --}}
                                            <a class="btn btn-success btn-inline-block"
                                                href="{{ route('user.users.show', $user->id) }}" data-toggle="tooltip"
                                                title="Show">
                                                {!! trans('buttons.show') !!}
                                            </a>

                                            {{-- Button for edit user --}}
                                            <a class="btn btn-info btn-inline-block"
                                                href="{{ route('user.users.edit', $user->id) }}" data-toggle="tooltip"
                                                title="Edit">
                                                {!! trans('buttons.edit') !!}
                                            </a>


                                            <form class="d-inline-block" action="{{ route('user.activeUser', $user->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                @if ($user->activated == 1)
                                                    <button type="submit" class="btn btn-warning btn-inline-block"
                                                        data-toggle="tooltip" title="Deactivate" name="deactivate">
                                                        {!! trans('buttons.deactivate') !!}
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-primary btn-inline-block"
                                                        data-toggle="tooltip" title="Activate" name="activate">
                                                        {!! trans('buttons.activate') !!}
                                                    </button>
                                                @endif
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody id="search_results"></tbody>
                            @if (config('usersmanagement.enableSearchUsers'))
                                <tbody id="search_results"></tbody>
                            @endif

                        </table>
                        @if (config('usersmanagement.enablePagination'))
                            {{ $users->links() }}
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('modals.modal-delete')
@endsection

@section('scripts')
    @if (count($users) > config('usersmanagement.datatablesJsStartCount') && config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if (config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if (config('usersmanagement.enableSearchUsers'))
        @include('scripts.search-users')
    @endif
@endsection
