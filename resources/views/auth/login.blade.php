@extends('layouts.frontend.master')

@section('content')
    <div class="container py-5" style="margin-top: 50px;">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
                    <div class="card-header bg-gradient-primary py-4">
                        <h1 class="text-center font-weight-light my-2">{{ __('auth.login') }}</h1>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row justify-content-center">
                                <x-input class="col-md-8" type="email" name="email" :placeholder="__('forms.placeholders.enter_email')" :icon="icon('email')"
                                    :autofocus="true" />

                                <x-input class="col-md-8" type="password" name="password" :placeholder="__('forms.placeholders.enter_password')"
                                    :icon="icon('password')" />
                            </div>


                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            {{ __('auth.remember_me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-column align-items-center">

                                <button type="submit" class="btn btn-primary">
                                    {{ __('auth.login') }}
                                </button>

                                <div class="">
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('auth.forgot') }}
                                    </a>
                                </div>

                            </div>

                            {{-- <p class="text-center mb-3">
                            Or Login with
                        </p>

                        @include('partials.socials-icons') --}}

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
