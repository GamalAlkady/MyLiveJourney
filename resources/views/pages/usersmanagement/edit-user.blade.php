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

    <x-header :title="trans('usersmanagement.editUser')" />


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
                            <div class="col-12">
                                <div class="form-group mb-3 {{ $errors->has('role') ? 'has-error' : '' }}">
                                    <label for="role" class="form-label text-gray-700 font-medium">
                                        {{-- <i class="fas fa-shield-alt me-2"></i> --}}
                                        {!! trans('forms.labels.icon.role') !!}
                                    </label>
                                    <div class="input-group">
                                        <select class="custom-select form-control form-control-lg" name="role"
                                            id="role" required>
                                            <option value="">{!! trans('forms.placeholders.enter_role') !!}</option>
                                            @if ($roles)
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        @selected(old('role', $currentRole->id) == $role->id)>
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
      


                <div class="row">

                    <div class="col-12 col-sm-6">
                        <button type="button" class="btn btn-success btn-block mt-3 mb-2 btn-save" data-toggle="modal"
                            data-target="#confirmSave" data-title="{!! trans('modals.edit_user__modal_text_confirm_title') !!}"
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
