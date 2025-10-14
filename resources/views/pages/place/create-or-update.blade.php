@extends('layouts.backend.master')

@section('title')
    @php
        $isEdit = isset($place);
    @endphp

    {{ trans_choice('titles.create', $place->id ?? 0, ['name' => __('titles.place')]) }}
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-map-plus text-primary mr-2"></i>
                        {{ trans_choice('titles.create', $place->id ?? 0, ['name' => __('titles.place')]) }}
                    </h1>
                    <a href="{{ route('user.places.index') }}" class="btn btn-primary">
                        {{-- <i class="fas fa-arrow-left mr-2"></i> --}}
                        {!! __('buttons.back_to', ['name' => __('titles.places')]) !!}
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-9">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary py-3">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-plus-circle mr-1"></i>
                            {{ __('titles.details') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        {{-- @include('partials.errors') --}}

                        <form action="{{ $isEdit ? route('user.places.update', $place->id) : route('user.places.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($isEdit)
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div
                                    class="col-md-12 form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                    <label for="name" class="col-md-12 control-label">{!! trans('forms.labels.icon.name') !!}</label>
                                    {{-- {!! Form::label('name', trans('forms.name'), array('class' => 'col-md-12 control-label')); !!} --}}
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            {!! Form::text('name', old('name', $isEdit ? $place->name : ''), [
                                                'id' => 'name',
                                                'class' => 'form-control',
                                                'placeholder' => trans('forms.enter_name', ['name' => 'Place']),
                                            ]) !!}
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div
                                    class="col-md-6 form-group has-feedback row {{ $errors->has('district_id') ? ' has-error ' : '' }}">
                                    <label for="district" class="col-md-12 control-label">{!! trans('forms.placeholders.choose_district') !!}</label>
                                    <div class="col-md-12 mb-4">

                                        <div class="input-group">
                                            <select class="custom-select form-control" name="district_id" id="district"
                                                required>
                                                <option value="">
                                                    {{ __('forms.placeholders.select', ['type' => __('titles.models.district')]) }}
                                                </option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}"
                                                        {{ old('district_id', $isEdit ? $place->district_id : '') == $district->id ? 'selected' : '' }}>
                                                        {{ $district->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('district_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('district_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div
                                    class="col-md-6 form-group has-feedback row {{ $errors->has('placetype_id') ? ' has-error ' : '' }}">
                                    <label for="type" class="col-md-12 control-label">
                                        {!! trans('forms.placeholders.choose_placetype') !!}
                                    </label>

                                    <div class="col-md-12 mb-4">

                                        <div class="input-group">
                                            <select class="custom-select form-control" name="placetype_id" id="placetype"
                                                required>
                                                <option value="">
                                                    {{ __('forms.placeholders.select', ['type' => __('titles.models.placetype')]) }}
                                                </option>
                                                @foreach ($placetypes as $placetype)
                                                    <option value="{{ $placetype->id }}"
                                                        {{ old('placetype_id', $isEdit ? $place->placetype_id : '') == $placetype->id ? 'selected' : '' }}>
                                                        {{ $placetype->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('placetype_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('placetype_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>




                                <div
                                    class="col-md-12 form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                                    <label for="description" class="col-md-12 control-label">
                                        {!! trans('forms.labels.icon.description') !!}
                                    </label>
                                    <div class="col-md-12 mb-4">
                                        <div class="input-group">
                                            <textarea name="description" id="description" class="form-control" rows="5">{{ old('description', $isEdit ? $place->description : '') }}</textarea>
                                        </div>
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div
                                    class="col-md-12 form-group has-feedback row {{ $errors->has('image') ? ' has-error ' : '' }}">
                                    <label for="image" class="col-md-12 control-label">
                                        {!! trans('forms.labels.icon.image') !!}
                                    </label>
                                    <div class="col-md-12 mb-4">
                                        <div class="input-group">
                                            <input type="file" id="file" class="custom-file-input"
                                                onchange="loadPreview(this);" name="image">
                                            <label class="custom-file-label"
                                                for="file">{{ trans('forms.placeholders.choose_image') }}</label>
                                        </div>
                                        @if ($errors->has('image'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    <div class="mt-3">
                                        <img id="preview_img"
                                            src="{{ $isEdit ? asset('storage/place/' . $place->image) : '' }}"
                                            class="img-thumbnail rounded shadow-sm"
                                            style="max-height: 200px; {{ $isEdit ? '' : 'display: none;' }}">
                                    </div>
                                </div>

                                <div class="form-group w-100 text-right d-flex justify-content-around">
                                    <button type="submit" class="btn btn-success">
                                        {!! trans('buttons.save') !!}
                                    </button>
                                    <a href="{{ route('user.places.index') }}" class="btn btn-danger d-inline-block">
                                        {!! trans('buttons.cancel') !!}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary py-3">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-info-circle mr-1"></i>
                            Tips
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="pl-3">
                            <li class="mb-2">Fill in all required fields</li>
                            <li class="mb-2">Upload a high-quality image</li>
                            <li class="mb-2">Write a detailed description</li>
                            <li class="mb-2">Select appropriate district and type</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/trix.js') }}"></script>
    <script>
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

@section('css')
    <link href="{{ asset('css/trix.css') }}" rel="stylesheet">
    <style>
        .trix-container {
            border: 1px solid #ced4da;
            border-radius: 0.35rem;
            padding: 0.5rem;
        }

        .trix-content {
            min-height: 150px;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        .custom-file-input:focus~.custom-file-label {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        .custom-file-label::after {
            content: "Browse";
        }
    </style>
@endsection
