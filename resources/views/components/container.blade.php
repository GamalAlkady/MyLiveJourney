@props(['titleHeader' => null, 'model', 'actionHeader', 'count' => null, 'addThe' => false])
<div class="tours-header">
    <div class="d-flex align-items-center justify-content-between">
        <div class="flex-fill">
            <h1 class=" fw-bold mb-2">
                {!! icon($model) !!}
                {{ trans_choice('titles.manage', $addThe, ['name' => $titleHeader ?? __('titles.' . $model)]) }}
            </h1>
        </div>
        <div class="text-md-end  mt-md-0">
            @if (empty($actionHeader) && !empty($model))
                @permission("create.$model")
                    <a href="{{ route('user.' . $model . '.create') }}" class="btn btn-success">
                        {!! __('buttons.add') !!}
                    </a>
                @endpermission
            @else
                {{ $actionHeader }}
            @endif
        </div>
    </div>
</div>


<div class="table-container">
    <div class="table-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3 class="mb-0 fs-4">
                    <i class="fas fa-list me-2"></i>
                    {{ trans_choice('messages.data', $addThe, ['name' => $tableHeader ?? ($titleHeader ?? __("titles.$model"))]) }}
                    @isset($count)
                        ({{ $count }})
                    @endisset
                </h3>
            </div>
            @if (config('usersmanagement.enableSearchUsers'))
                <div class="col-md-6">
                    @include('partials.search-form', ['route' => "user.$model.index"])
                </div>
            @endif
            {{-- <div class="col-md-6 text-md-end">
                    <span class="badge bg-secondary">
                        {{ trans_choice('pagination.caption', 1, ['count' => $tours->count(), 'name' => __('titles.tour')]) }}
                    </span>
                </div> --}}
        </div>
    </div>

    <div class="p-3">
        <div class="table-responsive">
            <table class="table table-hover data-table">
                <thead>
                    <tr>
                        {{ $head }}
                    </tr>
                </thead>
                <tbody>
                    {{ $body }}
                </tbody>
                @if (config('usersmanagement.enableSearchUsers'))
                    <tbody id="search_results"></tbody>
                @endif
            </table>

            @if (config('usersmanagement.enablePagination'))
                <div class="pagination-wrapper">
                    {{ $foot }}
                </div>
            @endif
        </div>
    </div>
</div>
