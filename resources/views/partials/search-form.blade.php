<div class="row">
    <div class="col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-5 offset-lg-7 col-xl-4 offset-xl-8">
        {!! Form::open(['route' => "$route", 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'id' => 'search_form']) !!}
            {!! csrf_field() !!}
            <div class="input-group mb-3">
                {!! Form::text('search', NULL, ['id' => 'search', 'class' => 'form-control', 'placeholder' => trans('messages.search'), 'aria-label' => trans('messages.search'), 'required' => false]) !!}
                <div class="input-group-append">
                    <a href="#" class="input-group-addon btn btn-warning clear-search" id="clear_search" data-toggle="tooltip" title="{{ trans('tooltips.clearSearch') }}" style="display:none;">
                        <i class="fa fa-fw fa-times" aria-hidden="true"></i>
                        <span class="sr-only">
                            {!! trans('tooltips.clearSearch') !!}
                        </span>
                    </a>
                    <a href="#" class="input-group-addon btn btn-secondary" id="search_trigger" data-toggle="tooltip" data-placement="bottom" title="{{ trans('tooltips.submitSearch',['name'=>__('titles.tours')]) }}" >
                        <i class="fa fa-search fa-fw" aria-hidden="true"></i>
                        <span class="sr-only">
                            {!!  trans('tooltips.submitSearch',['name'=>__('titles.tours')]) !!}
                        </span>
                    </a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
