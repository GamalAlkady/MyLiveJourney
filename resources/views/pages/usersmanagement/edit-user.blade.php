@extends('layouts.backend.master')

@section('title')
    {!! trans('usersmanagement.editing-user', ['name' => $user->name]) !!}
@endsection

@section('css')
    <style type="text/css">
        .btn-save,
        .pw-change-container {
            display: none;
        }
        .form-control:focus,
        .custom-select:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0, 0, 0, .125);
        }

        .btn-change-pw {
            transition: all 0.3s ease;
        }

        .btn-change-pw:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: .25rem;
            font-size: 80%;
            color: #dc3545;
        }

        .was-validated .form-control:invalid~.invalid-feedback,
        .form-control.is-invalid~.invalid-feedback {
            display: block;
        }
    </style>
@endsection

@section('content')

    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    {!! trans('buttons.edit_name',['name' => $user->name]) !!}
                </h1>
              <div>  <a href="{{ route('user.users.index') }}" class="btn btn-light btn-sm px-3 py-2 rounded hover-effect me-2">
                    {!! trans('buttons.back_to', ['name' => __('usersmanagement.users')]) !!}
                </a>

                <a href="{{ route('user.users.show',$user->id) }}" class="btn btn-light btn-sm px-3 py-2 rounded hover-effect me-2">
                    {!! trans('buttons.back_to1', ['name' => __('usersmanagement.user')]) !!}
                </a></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-success rounded-circle p-2 me-3">
                                <i class="fas fa-user-edit text-white fs-5"></i>
                            </div>
                            <h4 class="mx-2 mb-0 text-gray-800 font-weight-bold">{!! trans('usersmanagement.editing-user', ['name' => $user->name]) !!}</h4>
                        </div>

                    </div>
                </div>

                <div class="card-body p-4">


                    <form class="needs-validation" role="form" method="POST"
                        action="{{ route('user.users.update', $user->id) }}" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group mb-3 {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="name" class="form-label text-gray-700 font-medium">
                                        {{-- <i class="fas fa-user me-2 text-primary"></i> --}}
                                        {!! trans('labels.icon_text.username') !!}
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg" id="name"
                                            name="name" value="{{ old('name', $user->name) }}"
                                            placeholder="{!! trans('labels.username') !!}" required>
                                        <span class="input-group-text bg-ligh">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3 {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="email" class="form-label text-gray-700 font-medium">
                                        {{-- <i class="fas fa-envelope me-2 text-primary"></i> --}}
                                        {!! trans('labels.icon_text.email') !!}
                                    </label>
                                    <div class="input-group">
                                        <input type="email" class="form-control form-control-lg" id="email"
                                            name="email" value="{{ old('email', $user->email) }}"
                                            placeholder="{!! trans('labels.email') !!}" required>
                                        <span class="input-group-text bg-ligh">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group mb-3 {{ $errors->has('first_name') ? 'has-error' : '' }}">
                                    <label for="first_name" class="form-label text-gray-700 font-medium">
                                        <i class="fas fa-id-card me-2 text-primary"></i>
                                        {!! trans('forms.create_user_label_firstname') !!}
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg" id="first_name"
                                            name="first_name" value="{{ old('first_name', $user->first_name) }}"
                                            placeholder="{!! trans('forms.create_user_ph_firstname') !!}" required>
                                        <span class="input-group-text bg-ligh">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('first_name'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('first_name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3 {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                    <label for="last_name" class="form-label text-gray-700 font-medium">
                                        <i class="fas fa-user-tag me-2 text-primary"></i>
                                        {!! trans('forms.create_user_label_lastname') !!}
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg" id="last_name"
                                            name="last_name" value="{{ old('last_name', $user->last_name) }}"
                                            placeholder="{!! trans('forms.create_user_ph_lastname') !!}" required>
                                        <span class="input-group-text bg-ligh">
                                            <i class="fas fa-user-tag"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('last_name'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('last_name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="form-group mb-3 {{ $errors->has('role') ? 'has-error' : '' }}">
                                    <label for="role" class="form-label text-gray-700 font-medium">
                                        <i class="fas fa-shield-alt me-2 text-primary"></i>
                                        {!! trans('forms.create_user_label_role') !!}
                                    </label>
                                    <div class="input-group">
                                        <select class="custom-select form-control form-control-lg" name="role"
                                            id="role" required>
                                            <option value="">{!! trans('forms.create_user_ph_role') !!}</option>
                                            @if ($roles)
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ old('role', $currentRole->id) == $role->id ? 'selected="selected"' : '' }}>
                                                        {{ $role->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="input-group-text bg-ligh">
                                            <i class="fas fa-shield-alt"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('role'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('role') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="border-bottom mb-4"></div>

                        <div class="pw-change-container">
                            <h5 class="mb-4 text-gray-700 font-medium">
                                <i class="fas fa-key text-primary me-2"></i>
                                {!! trans('forms.change-pw') !!}
                            </h5>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="form-group mb-3 {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label for="password" class="form-label text-gray-700 font-medium">
                                            <i class="fas fa-lock me-2 text-primary"></i>
                                            {!! trans('forms.create_user_label_password') !!}
                                        </label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-lg" id="password"
                                                name="password" placeholder="{!! trans('forms.create_user_ph_password') !!}">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </div>
                                        @if ($errors->has('password'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <div
                                        class="form-group mb-3 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                        <label for="password_confirmation" class="form-label text-gray-700 font-medium">
                                            <i class="fas fa-lock me-2 text-primary"></i>
                                            {!! trans('forms.create_user_label_pw_confirmation') !!}
                                        </label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-lg"
                                                id="password_confirmation" name="password_confirmation"
                                                placeholder="{!! trans('forms.create_user_ph_pw_confirmation') !!}">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </div>
                                        @if ($errors->has('password_confirmation'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('password_confirmation') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6 mb-2">
                                <a href="#" class="btn btn-outline-secondary btn-block btn-change-pw mt-3"
                                    title="{{ trans('forms.change-pw') }}">
                                    <i class="fas fa-lock me-2"></i>
                                    {!! trans('forms.change-pw') !!}
                                </a>
                            </div>
                            <div class="col-12 col-sm-6">
                                <button type="button" class="btn btn-success btn-block mt-3 mb-2 btn-save"
                                    data-toggle="modal" data-target="#confirmSave" data-title="{!! trans('modals.edit_user__modal_text_confirm_title') !!}"
                                    data-message="{!! trans('modals.edit_user__modal_text_confirm_message') !!}">
                                    {!! trans('buttons.save') !!}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @include('modals.modal-save')
    @include('modals.modal-delete')

@endsection

@section('scripts')
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @include('scripts.check-changed')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // تغيير نمط الأزرار عند التمرير
            const buttons = document.querySelectorAll('.hover-effect');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
@endsection
