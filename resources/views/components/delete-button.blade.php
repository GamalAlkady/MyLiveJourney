{!! Form::open([
    'url' => $url,
    'class' => 'd-inline-block flex-fill me-1',
    'data-toggle' => 'tooltip',
    'title' => trans('titles.delete', ['name' => __($itemName)]),
]) !!}
{!! Form::hidden('_method', 'DELETE') !!}
{!! Form::button(trans("buttons.$btnText"), [
    'class' => 'btn btn-danger d-inline-block w-100',
    'type' => 'button',
    'data-toggle' => 'modal',
    'data-target' => '#confirmDelete',
    'data-title' => trans('modals.ConfirmDeleteTitle', ['name' => __($itemName)]),
    'data-message' => trans('modals.ConfirmDeleteMessage', ['name' => $itemId??$itemName]),
]) !!}
{!! Form::close() !!}

@pushOnce('modals')
      @include('modals.confirm-modal', [
        'formTrigger' => 'confirmDelete',
        'modalClass' => 'danger',
        // 'actionBtnIcon' => '',
        'btnSubmitText' => trans('buttons.delete'),
    ])
@endPushOnce
  

