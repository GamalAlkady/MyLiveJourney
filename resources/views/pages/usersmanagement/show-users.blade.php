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

        /* .dropdown-menu-right {
            left: 0;
            right: auto;
        } */
    </style>
@endsection
@use('App\Models\Role')

@section('content')
    <x-container model="users">
        <x-slot:actionHeader>
            @permission('create.users')
                <div class="btn-group pull-right btn-group-xs">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                        <span class="sr-only">
                            {!! trans('usersmanagement.users-menu-alt') !!}
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-{{ (app('laravellocalization')->getCurrentLocaleDirection()=='rtl'?'left':'right') }}">
                        <a class="dropdown-item" href="{{ route('user.users.create') }}">
                            {{-- <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i> --}}
                            {!! trans('buttons.add') !!}
                        </a>
                        <a class="dropdown-item" href="{{ route('user.deleted') }}">
                            <i class="fa fa-fw fa-group" aria-hidden="true"></i>
                            {!! trans('usersmanagement.show-deleted-users') !!}
                        </a>
                    </div>
                </div>
            @endpermission
        </x-slot:actionHeader>
        <x-slot:head>
            <th>{!! trans('usersmanagement.users-table.id') !!}</th>
            <th>{!! trans('usersmanagement.users-table.name') !!}</th>
            <th class="hidden-xs">{!! trans('usersmanagement.users-table.email') !!}</th>
            <th class="hidden-xs">{!! trans('usersmanagement.users-table.fname') !!}</th>
            <th class="hidden-xs">{!! trans('usersmanagement.users-table.lname') !!}</th>
            <th>
                <select name="role" class="form-conrol" id="role">
                    <option value="all">{{ __('titles.all') }}</option>
                    @php $roles = Role::withoutAdmin()->get() @endphp
                    @foreach ($roles as $role)
                        <option value="{{ $role->slug }}" @selected($role->slug == request()->get('type'))>
                            {!! __("titles.$role->slug".'s') !!}</option>
                    @endforeach
                </select>
            </th>
            <th>{!! trans('usersmanagement.users-table.actions') !!}</th>
        </x-slot:head>

        <x-slot:body>
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
                            <span class="badge badge-{{ $badgeClass }}">{{ $user_role->name }}</span>
                        @endforeach
                    </td>
                    <td class="d-flex">

                        {{-- Button for show user --}}
                        <a class="btn btn-success btn-inline-block flex-fill me-1"
                            href="{{ route('user.users.show', $user->id) }}" data-toggle="tooltip" title="Show">
                            {!! trans('buttons.icon.show') !!}
                        </a>

                        @permission('delete.users')
                            {{-- Button for delete user --}}
                            <x-delete-button :url="route('user.users.destroy',$user->id)" :itemName="$user->name"/>
                            {{-- {!! Form::open([
                                'url' => 'admin/users/' . $user->id,
                                'class' => 'd-inline-block flex-fill me-1',
                                'data-toggle' => 'tooltip',
                                'title' => 'Delete',
                            ]) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::button(trans('buttons.delete'), [
                                'class' => 'btn btn-danger w-100',
                                'type' => 'button',
                                'data-toggle' => 'modal',
                                'data-target' => '#confirmDelete',
                                'data-title' => __('modals.ConfirmDeleteTitle', ['name' => __('titles.user')]),
                                'data-message' => __('modals.ConfirmDeleteMessage', ['name' => $user->name]),
                            ]) !!}
                            {!! Form::close() !!} --}}
                        @endpermission



                        @permission('update.users')
                            {{-- Button for edit user --}}
                            <a class="btn btn-info btn-inline-block flex-fill me-1"
                                href="{{ route('user.users.edit', $user->id) }}" data-toggle="tooltip" title="Edit">
                                {!! trans('buttons.icon.edit') !!}
                            </a>



                            <form class="d-inline-block flex-fill" action="{{ route('user.activeUser', $user->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                @if ($user->activated == 1)
                                    <button type="submit" class="btn btn-warning btn-inline-block w-100" data-toggle="tooltip"
                                        title="{{ trans('buttons.deactivate') }}" name="deactivate">
                                        {!! trans('buttons.deactivate') !!}
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-primary btn-inline-block w-100" data-toggle="tooltip"
                                        title="Activate" name="activate">
                                        {!! trans('buttons.activate') !!}
                                    </button>
                                @endif
                            </form>
                        @endpermission


                    </td>
                </tr>
            @endforeach
        </x-slot:body>

        <x-slot:foot>
            {{ $users->links() }}
        </x-slot:foot>
    </x-container>




    {{-- @include('modals.modal-delete') --}}
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
        {{-- @include('scripts.search-users') --}}
    @endif

    <script>
        $(document).ready(function() {
            $('#role').on('change', function(e) {
                window.location.href = "{{ route('user.users.index') }}?type=" + e.target.value;
            });
        });
    </script>
@endsection
