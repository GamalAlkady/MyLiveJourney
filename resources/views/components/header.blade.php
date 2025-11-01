@props(['title' => null, 'actionHeader', 'link'])
<div class="tours-header">
    <div class="d-flex align-items-center justify-content-between">
        <div class="flex-fill">
            <h1 class="display-5 fw-bold mb-2">
                {{ $title }}
            </h1>
        </div>
        <div class="text-md-end mt-3 mt-md-0">
            @if (!empty($link))
                <a {{ $link->attributes->class(['btn']) }}>
                    {{ $link }}
                </a>
                @else
                <a href="{{ URL::previous() }}" class="btn btn-light">
                    {!!__('buttons.back') !!}
                </a>
            @endif
            @if (!empty($actionHeader))
                {{ $actionHeader }}
            @endif
        </div>
    </div>
</div>
