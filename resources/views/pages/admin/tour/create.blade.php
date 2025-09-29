@extends('layouts.backend.master')
@php
    $isEdit = isset($tour);
@endphp
@section('title')
    {{ __('messages.add_new_tour') }} | {{ config('app.name') }}
@endsection

@section('css')
    <link href="{{ asset('css/trix.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chosen.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card mt-5">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div class="bg-primary rounded-circle p-3 me-3">
                        <i class="fas fa-map-marked-alt text-white fs-4"></i>
                    </div>
                    <h3 class="mb-0">{{ __('messages.add_new_tour') }}</h3>
                </div>
            </div>
            @include('partials.form-status')
            <div class="card-body p-4">
                <form action="{{$isEdit ? route('admin.tour.update', $tour->id) : route('admin.tour.store') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf
                    @if ($isEdit)
                        @method('PUT')
                    @endif
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group mb-3 has-error {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name" class="form-label text-gray-700 font-medium">
                                    {!! trans('forms.name') !!}
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="{!! trans('forms.enter_name', ['name' => 'Tour']) !!}" value="{{ old('name',$isEdit ? $tour->name : '') }}" required>

                                </div>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3 {{ $errors->has('price') ? 'has-error' : '' }}">
                                <label for="price" class="form-label text-gray-700 font-medium">
                                    {!! trans('forms.price') !!}
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" value="{{ old('price', $isEdit ? $tour->price : '') }}"
                                        placeholder="{{ trans('forms.enter_price') }}" id="price" name="price"
                                        required>
                                </div>
                                @if ($errors->has('price'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('price') }}
                                    </div>
                                @endif
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="people" class="form-label text-gray-700 font-medium">
                                    {!! trans('forms.people') !!}
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" value="{{ old('people', $isEdit ? $tour->people : '') }}"
                                        placeholder="{{ trans('forms.enter_people') }}" id="people" name="people"
                                        required>
                                </div>
                                @if ($errors->has('people'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('people') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Date --}}
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="date" class="form-label text-gray-700 font-medium">
                                    {!! trans('forms.date') !!}
                                </label>
                                <div class="input-group">
                                    <input type="date" value="{{ old('date', $isEdit ? $tour->date : date('Y-m-d')) }}" class="form-control"
                                        placeholder="{{ trans('forms.enter_date') }}" id="date" name="date"
                                        required>
                                </div>
                                @if ($errors->has('date'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('date') }}
                                    </div>
                                @endif
                            </div>
                        </div>


                        {{-- Number of Days --}}
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="day" class="form-label text-gray-700 font-medium">
                                    {!! trans('forms.days') !!}
                                </label>
                                <div class="input-group">
                                    <input type="number" min="1" value="{{ old('day',$isEdit ? $tour->day : 1) }}" class="form-control"
                                        placeholder="{{ trans('forms.enter_day') }}" id="day" name="day"
                                        required>
                                </div>
                                @if ($errors->has('day'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('day') }}
                                    </div>
                                @endif
                            </div>
                        </div>


                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="places" class="form-label text-gray-700 font-medium">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                {{ __('forms.choose_places') }}
                            </label>
                            <select class="form-control select-tags" data-placeholder="{{ __('forms.choose_places') }}"
                                name="places[]" multiple required>
                                @php
                                // get id places
                                $idPlaces = $isEdit ? $tour->places()->pluck('places.id')->toArray() : [];
                                @endphp

                                @foreach ($places as $place)
                                    <option value="{{ $place->id }}" {{ in_array($place->id, $idPlaces) ? 'selected' : '' }}>
                                        {{ $place->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="description" class="form-label text-gray-700 font-medium">
                                {{-- <i class="fas fa-file-alt me-2 text-primary"></i> --}}
                                {!! __('forms.description') !!}
                            </label>
                            <input id="description" type="hidden" name="description" value="{{ old('description', $isEdit ? $tour->description : '') }}"
                                required>
                            <trix-editor input="description"></trix-editor>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>
                    </div>



                    <div class="col-md-12">
                        <div class="form-group has-feedback row {{ $errors->has('image') ? ' has-error ' : '' }}">
                            <label for="image" class="col-md-12 control-label">
                                {!! trans('forms.image') !!}
                            </label>
                            <div class="col-md-12 mb-4">
                                <div class="input-group">
                                    <input type="file" id="file" class="custom-file-input"
                                        onchange="loadPreview(this);" name="image">
                                    <label class="custom-file-label"
                                        for="file">{{ trans('forms.choose_image') }}</label>
                                </div>
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="mt-3">
                                <img id="preview_img"
                                    src="{{ $isEdit ? asset('storage/tourImage/' . $tour->image) : '' }}"
                                    class="img-thumbnail rounded shadow-sm"
                                    style="max-height: 200px; {{ $isEdit ? '' : 'display: none;' }}">
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success">
                                {!! trans('buttons.save') !!}
                            </button>
                            <a href="{{ route('admin.tour.index') }}" class="btn btn-danger">
                                {!! trans('buttons.cancel') !!}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/trix.js') }}"></script>
    <script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select-tags').chosen();
        });

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

        // Update custom file input label
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val();
            $(this).next('.custom-file-label').html(fileName);
        });

        function loadPreview(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(id)
                        .attr('src', e.target.result)
                        .css('display', 'block');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
