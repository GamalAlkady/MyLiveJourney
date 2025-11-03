<div class="col-12 mb-5">
    <div class="alert alert-info text-center p-2">
        @if (request()->routeIs('district.wise.place'))
            <h2><i class="fa fa-info-circle"></i>
                {{ __('alerts.no_item_in_district', ['type' => __('titles.places')]) }}
            </h2>
        @elseif (request()->routeIs('placetype.wise.place'))
            <h2><i class="fa fa-info-circle"></i> {{ __('alerts.no_item_in_type', ['type' => __('titles.places')]) }}
            </h2>
        @elseif (request()->routeIs('places'))
            <h2><i class="fa fa-info-circle"></i> {{ __('alerts.no_items_found', ['type' => __('titles.places')]) }}</h2>
        @elseif (request()->routeIs('tours'))
            <h2><i class="fa fa-info-circle"></i> {{ __('alerts.no_items_found', ['type' => __('titles.tours')]) }}</h2>
        @else
            <h2><i class="fa fa-info-circle"></i> {{ __('alerts.no_results_found') }}</h2>
        @endif
    </div>
</div>