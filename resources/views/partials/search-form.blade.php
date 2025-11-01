<div class="row">
    <div class="col-sm-8 offset-sm-4 col-md-12 offset-md-0 col-lg-12 offset-lg-0 col-xl-8 offset-xl-4">
        {!! Form::open([
            'route' => "$route",
            'method' => 'GET',
            'role' => 'form',
            'class' => 'needs-validation',
            'id' => 'search_form',
        ]) !!}
        {{-- {!! csrf_field() !!} --}}
        <div class="input-group mb-3">
            {{-- @dd(request()->get('search')) --}}
            {!! Form::text('search', request()->get('search'), [
                'id' => 'search',
                'class' => 'form-control',
                'placeholder' => trans('messages.search'),
                'aria-label' => trans('messages.search'),
                'required' => false,
            ]) !!}
            <div class="input-group-append">
                <button type="reset" class="input-group-addon btn btn-warning clear-search" id="clear_search"
                    data-toggle="tooltip" title="{{ trans('tooltips.clearSearch') }}"
                    @if (request()->get('search') == '') style="display:none;" @endif>
                    <i class="fa fa-fw fa-times" aria-hidden="true"></i>
                    <span class="sr-only">
                        {!! trans('tooltips.clearSearch') !!}
                    </span>
                </button>
                <button type="submit" class="input-group-addon btn btn-secondary" id="search_trigger"
                    data-toggle="tooltip" data-placement="bottom"
                    title="{{ trans('tooltips.submitSearch', ['name' => __('titles.tours')]) }}">
                    <i class="fa fa-search fa-fw" aria-hidden="true"></i>
                    <span class="sr-only">
                        {!! trans('tooltips.submitSearch', ['name' => __('titles.tours')]) !!}
                    </span>
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@push('scripts')
    <script>
        $(function() {
            // إظهار زر الإلغاء عند الكتابة
            let input = $('#search');
            let clearBtn = $('#clear_search');
            let searchBtn = $('#search_trigger');
            let form = $('#search_form');

            form.submit(function(e) {
                if(input.val()=='')
                    e.preventDefault()
            })

            input.keyup(function() {
                if ($(this).val() != '') {
                    clearBtn.show();

                } else {
                    clearBtn.hide();
                }
            });

            // زر الإلغاء
            clearBtn.click(function(e) {
                e.preventDefault();
                input.val('');
                window.location.href = "{{ route($route) }}";
            });
        });
    </script>
@endpush
