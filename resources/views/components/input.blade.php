  <div {{ $attributes->class(['col-md-12'=>!$attributes->has('class')]) }}>
      <div class="form-group mb-3 {{ $errors->has($name) ? 'has-error' : '' }}">
          <label for="{{ $name }}" class="form-label text-gray-700 font-medium">
              {{-- <i class="fas fa-user me-2"></i> --}}
              {!! $label !!}
          </label>
          <div class="input-group">
              <input type="{{ $type }}" class="form-control form-control-lg" id="{{ $name }}" name="{{ $name }}"
                  value="{{ old("$name",$value) }}" placeholder="{{ $placeholder }}" @required($required) {{ $autofocus() }}>
              <span class="input-group-text bg-ligh">
                 {!! $icon !!}
              </span>
          </div>
          @if ($errors->has($name))
              <div class="invalid-feedback d-block">
                  {{ $errors->first($name) }}
              </div>
          @endif
      </div>
  </div>
