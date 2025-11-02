@props(['btnTextColor' => '', 'disabled' => false])


<form action="{{ $url }}" {{ $attributes->class(['d-inline-block flex-fill me-1']) }} data-toggle="tooltip"
    title="{{ $tooltip }}" method="POST">
    @csrf
    {!! Form::hidden('_method', $method) !!}
    {!! Form::button($buttonName, [
        'class' => "btn btn-$modalClass btn-sm w-100 $btnTextColor" . ($disabled ? ' disabled' : ''),
        'type' => 'button',
        'data-toggle' => 'modal',
        'data-target' => '#' . $formTrigger,
        'data-title' => $modalTitle,
        'data-message' => $modalMessage,
    ]) !!}
</form>

@once($formTrigger)
    @push('modals')
        @include('modals.confirm-modal', [
            'formTrigger' => $formTrigger,
            'modalClass' => $modalClass,
            'actionBtnIcon' => $actionBtnIcon,
            'btnSubmitText' => $buttonName, //default
        ])
    @endpush
@endonce

{{-- @endPushOnce --}}
