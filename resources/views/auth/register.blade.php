@extends('layouts.frontend.master')


@section('content')
    <div class="container py-5" style="margin-top: 50px;">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
                    <div class="card-header bg-gradient-primary py-4">
                        <h1 class="text-center font-weight-light my-2">{{ __('titles.signup') }}</h1>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                {{-- UserName --}}
                                <x-input class="col-md-6" name="name" label="{!! trans('forms.labels.icon.username') !!}"
                                    placeholder="{!! trans('forms.placeholders.enter_username') !!}" :icon="icon('user', 'user-icon')" :required="true" />

                                {{-- Email --}}
                                <x-input class="col-md-6" type="email" name="email" :label="trans('forms.labels.icon.email')" :placeholder="trans('forms.placeholders.enter_email')"
                                    :icon="icon('email', 'envelope-icon')" :required="true" />

                                {{-- First Name --}}
                                <x-input class="col-md-6" name="first_name" label="{!! trans('forms.labels.icon.first_name') !!}"
                                    placeholder="{!! trans('forms.placeholders.enter_first_name') !!}" :icon="icon('id', 'user-icon')" :required="true" />

                                {{-- Last Name --}}
                                <x-input class="col-md-6" name="last_name" label="{!! trans('forms.labels.icon.last_name') !!}"
                                    placeholder="{!! trans('forms.placeholders.enter_last_name') !!}" :icon="icon('id', 'user-icon')" :required="true" />

                                {{-- Role --}}
                                <x-select-role />

                                {{-- Password --}}
                                <x-input class="col-md-6" name="password" label="{!! trans('forms.labels.icon.password') !!}"
                                    placeholder="{!! trans('forms.placeholders.enter_password') !!}" :icon="icon('password', 'lock-icon')" :required="true"
                                    type="password" />

                                {{-- Confirm Password --}}
                                <x-input class="col-md-6" name="password_confirmation" label="{!! trans('forms.labels.icon.confirm_password') !!}"
                                    placeholder="{!! trans('forms.placeholders.enter_confirm_password') !!}" :icon="icon('password', 'lock-icon')" :required="true"
                                    type="password" />

                                @if (config('settings.reCaptchStatus'))
                                    <div class="form-group mb-3">
                                        <div class="g-recaptcha" data-sitekey="{{ config('settings.reCaptchSite') }}">
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-12 d-flex justify-content-between">
                                    <div class="d-grid gap-2 mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            {{ __('auth.register') }}
                                        </button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="mb-0">{{ __('auth.already_have_acc') }}
                                            <a href="{{ route('login') }}" class="text-primary">{{ __('auth.login') }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if (config('settings.reCaptchStatus'))
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif
@endpush
