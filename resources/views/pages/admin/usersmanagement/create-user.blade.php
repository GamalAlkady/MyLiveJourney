@extends('layouts.backend.master')

@section('title')
    {!! trans('usersmanagement.create-new-user') !!}
@endsection

@section('css')
    <style>
        .hover-effect {
            transition: all 0.3s ease;
        }

        .hover-effect:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')

    <div class="col-xl-12 col-lg-12">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary rounded-circle p-2 me-3">
                            <i class="fas fa-user-plus text-white fs-5"></i>
                        </div>
                        <h4 class="mx-2 text-gray font-weight-bold">{!! trans('usersmanagement.create-new-user') !!}</h4>
                    </div>
                    <div>
                        <a href="{{ route('admin.users.index') }}"
                            class="btn btn-outline-light btn-sm px-3 py-2 rounded hover-effect">
                            <span class="d-none d-md-inline">{!! trans('buttons.back_to',['name'=>'users']) !!}</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">


                <form class="needs-validation" role="form" method="POST" action="{{ route('admin.users.store') }}"
                    novalidate>
                    @csrf

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group mb-3 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name" class="form-label text-gray-700 font-medium">
                                    <i class="fas fa-user me-2 text-primary"></i>
                                    {!! trans('forms.create_user_label_username') !!}
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" id="name" name="name"
                                        placeholder="{!! trans('forms.create_user_ph_username') !!}" value="{{ old('name') }}" required>
                                    <span class="input-group-text bg-light">
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
                                    <i class="fas fa-envelope me-2 text-primary"></i>
                                    {!! trans('forms.create_user_label_email') !!}
                                </label>
                                <div class="input-group">
                                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                                        placeholder="{!! trans('forms.create_user_ph_email') !!}" value="{{ old('email') }}" required>
                                    <span class="input-group-text bg-light">
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
                                        name="first_name" placeholder="{!! trans('forms.create_user_ph_firstname') !!}"
                                        value="{{ old('first_name') }}" required>
                                    <span class="input-group-text bg-light">
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
                                    <i class="fas fa-id-card me-2 text-primary"></i>
                                    {!! trans('forms.create_user_label_lastname') !!}
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" id="last_name"
                                        name="last_name" placeholder="{!! trans('forms.create_user_ph_lastname') !!}"
                                        value="{{ old('last_name') }}" required>
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-id-card"></i>
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
                        <div class="col-md-6">
                            <div class="form-group mb-3 {{ $errors->has('role') ? 'has-error' : '' }}">
                                <label for="role" class="form-label text-gray-700 font-medium">
                                    <i class="fas fa-user-tag me-2 text-primary"></i>
                                    {!! trans('forms.create_user_label_role') !!}
                                </label>
                                <div class="input-group">
                                    <select class="custom-select form-control" id="role" name="role" required>
                                        <option value="">{!! trans('forms.create_user_ph_role') !!}</option>
                                        @if ($roles)
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ old('role') == $role->id ? 'selected' : '' }}>{{ $role->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-user-tag"></i>
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

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group mb-3 {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password" class="form-label text-gray-700 font-medium">
                                    <i class="fas fa-lock me-2 text-primary"></i>
                                    {!! trans('forms.create_user_label_password') !!}
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-lg" id="password"
                                        name="password" placeholder="{!! trans('forms.create_user_ph_password') !!}" required>
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

                        <div class="col-md-6">
                            <div class="form-group mb-3 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <label for="password_confirmation" class="form-label text-gray-700 font-medium">
                                    <i class="fas fa-lock me-2 text-primary"></i>
                                    {!! trans('forms.create_user_label_pw_confirmation') !!}
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="password_confirmation" name="password_confirmation"
                                        placeholder="{!! trans('forms.create_user_ph_pw_confirmation') !!}" required>
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

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-lg shadow-sm hover-effect">
                            <i class="fas fa-save me-2"></i>
                            {!! trans('forms.create_user_button_text') !!}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        // Add custom JavaScript for form validation if needed
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection
