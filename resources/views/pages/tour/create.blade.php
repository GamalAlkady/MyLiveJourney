@extends('layouts.backend.master')
@php
    $isEdit = isset($tour);
@endphp
@section('title')
{{ trans_choice('titles.create',$tour->id??0,['name'=>__('titles.tour')]) }}
@endsection

@section('css')
    <link href="{{ asset('css/trix.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chosen.min.css') }}" rel="stylesheet">
@endsection

{{-- Edit this desing   --}}
@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">
                    {{-- <i class="fas fa-map-plus text-primary mr-2"></i> --}}
                    {!! $isEdit
                        ? __('buttons.edit_name', ['name' => $tour->name])
                        : __('buttons.create_new', ['name' => __('titles.tour')]) !!}
                </h1>
                <a href="{{ route('user.tours.index') }}" class="btn btn-light">
                    {{-- <i class="fas fa-arrow-left mr-2"></i> --}}
                    {!! __('buttons.back_to', ['name' => __('titles.tours')]) !!}
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="card-title d-flex align-items-center">
                            <div class="bg-primary rounded-circle p-2 me-3">
                                <i class="fas fa-map-marked-alt text-white fs-4"></i>
                            </div>
                            <h3 class="mb-0">{{ __('titles.tour') . ' ' . __('forms.form') }}</h3>
                        </div>

                    </div>
                </div>
                {{-- @include('partials.form-status') --}}
                <div class="card-body p-4">
                    <form action="{{ $isEdit ? route('user.tours.update', $tour->id) : route('user.tours.store') }}"
                        method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @if ($isEdit)
                            @method('PUT')
                        @endif
                        {{-- @if --}}
                        {{-- <input type="hidden" name="id" value="{{ $tour->id??'' }}"> --}}

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group mb-3 has-error {{ $errors->has('title') ? 'has-error' : '' }}">
                                    <label for="title" class="form-label text-gray-700 font-medium">
                                        {!! trans('forms.labels.icon.title') !!}
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="title" name="title" aria-label="title"
                                            placeholder="{!! trans('forms.placeholders.enter_title') !!}"
                                            value="{{ old('title', $isEdit ? $tour->title : '') }}" required>

                                    </div>
                                    @if ($errors->has('title'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3 {{ $errors->has('price') ? 'has-error' : '' }}">
                                    <label for="price" class="form-label text-gray-700 font-medium">
                                        {!! trans('forms.labels.icon.price') !!}
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control"
                                            value="{{ old('price', $isEdit ? $tour->price : '') }}"
                                            placeholder="{{ trans('forms.placeholders.enter_price') }}" id="price"
                                            name="price" required>
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
                                    <label for="max_seats" class="form-label text-gray-700 font-medium">
                                        {!! trans('forms.labels.icon.max_seats') !!}
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control"
                                            value="{{ old('max_seats', $isEdit ? $tour->max_seats : '') }}"
                                            placeholder="{{ trans('forms.placeholders.enter_max_seats') }}" id="max_seats"
                                            name="max_seats">
                                    </div>
                                    @if ($errors->has('max_seats'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('max_seats') }}
                                        </div>
                                    @endif
                                </div>
                            </div>


                            {{-- Date --}}
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="start_date" class="form-label text-gray-700 font-medium">
                                        {!! trans('forms.labels.icon.start_date') !!}
                                    </label>
                                    <div class="input-group">
                                        <input type="datetime-local"
                                            value="{{ old('start_date', $isEdit ? $tour->start_date : Now()) }}"
                                            class="form-control"
                                            placeholder="{{ trans('forms.placeholders.enter_start_date') }}"
                                            id="start_date" name="start_date" required>
                                    </div>
                                    @if ($errors->has('start_date'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('start_date') }}
                                        </div>
                                    @endif
                                </div>
                            </div>


                            {{-- Number of Days --}}
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="end_date" class="form-label text-gray-700 font-medium">
                                        {!! trans('forms.labels.icon.end_date') !!}
                                    </label>
                                    <div class="input-group">
                                        <input type="datetime-local"
                                            value="{{ old('end_date', $isEdit ? $tour->end_date : 1) }}"
                                            class="form-control"
                                            placeholder="{{ trans('forms.placeholders.enter_end_date') }}" id="end_date"
                                            name="end_date" required>
                                    </div>
                                    @if ($errors->has('end_date'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('end_date') }}
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="places[]" class="form-label text-gray-700 font-medium">
                                        {!! __('forms.labels.icon.choose_places') !!}
                                    </label>
                                    <select class="form-control select-tags" id="places[]"
                                        data-placeholder="{{ __('forms.placeholders.choose_places') }}" name="places[]"
                                        multiple required>
                                        @php
                                            // get id places
                                            $idPlaces = $isEdit ? $tour->places()->pluck('places.id')->toArray() : [];
                                        @endphp

                                        @foreach ($places as $place)
                                            <option value="{{ $place->id }}"
                                                {{ in_array($place->id, $idPlaces) ? 'selected' : '' }}>
                                                {{ $place->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('places.*'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('places.*') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="description" class="form-label text-gray-700 font-medium">
                                        {{-- <i class="fas fa-file-alt me-2 text-primary"></i> --}}
                                        {!! __('forms.labels.icon.description') !!}
                                    </label>
                                    <input id="description" type="hidden" name="description"
                                        value="{{ old('description', $isEdit ? $tour->description : '') }}" required>
                                    <trix-editor input="description"></trix-editor>

                                    @if ($errors->has('description'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                </div>
                            </div>


                        </div>
                        <div class="form-group">
                            <div class="btn-group d-flex justify-content-around">
                                <a href="{{ route('user.tours.index') }}" class="btn btn-danger hover-effect">
                                    {!! trans('buttons.cancel') !!}
                                </a>

                                <button type="submit" class="btn btn-success hover-effect">
                                    {!! trans('buttons.save') !!}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/trix.js') }}"></script>
    <script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
    <script>
        // Add custom JavaScript for form validation if needed
        (function() {
            'use strict';
            $('.select-tags').chosen().change(function(e) {
                $('.chosen-container').removeClass('is-invalid');
            });

            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        // يبحث عن select المطلوب والمخفي من Chosen
                        form.querySelectorAll('select.select-tags[required]').forEach(function(
                            select) {
                            var chosen = select.nextElementSibling; // .chosen-container
                            if (!select.checkValidity()) {
                                chosen.classList.add('is-invalid');
                            } else {
                                chosen.classList.remove('is-invalid');
                            }
                        });
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
