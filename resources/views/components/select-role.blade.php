 <div {{ $attributes->class(['col-md-12'=>!$attributes->has('class')]) }}>
     <div class="form-group mb-3 {{ $errors->has('role') ? 'has-error' : '' }}">
         <label for="role" class="form-label text-gray-700 font-medium">
             {{-- <i class="fas fa-shield-alt me-2"></i> --}}
             {!! trans('forms.labels.icon.role') !!}
         </label>
         <div class="input-group">
             <select class="custom-select form-control form-control-lg" name="role" id="role" required>
                 <option value="">{!! trans('forms.placeholders.enter_role') !!}</option>
                 @if ($roles)
                     @foreach ($roles as $role)
                         <option value="{{ $role->id }}" @selected($role->id == old('role',$value))>
                             {{ $role->name }}
                            </option>
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
