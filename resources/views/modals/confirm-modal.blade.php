@php
    if (!isset($actionBtnIcon)) {
        $actionBtnIcon = null;
    } else {
        $actionBtnIcon = $actionBtnIcon . ' fa-fw';
    }
    if (!isset($modalClass)) {
        $modalClass = null;
    }
    if (!isset($btnSubmitText)) {
        $btnSubmitText = trans('laravelblocker::laravelblocker.modals.btnConfirm');
    }
    if(!isset($formTrigger)) {
        $formTrigger = 'confirmModal';
    }
@endphp
<div class="modal fade modal-{{$modalClass}}" id="{{$formTrigger}}" role="dialog" aria-labelledby="{{$formTrigger}}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header {{$modalClass}}">
                <h5 class="modal-title">
                    Confirm
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure?
                </p>
            </div>
            <div class="modal-footer d-flex justify-content-around">
                {!! Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> ' . trans('laravelblocker::laravelblocker.modals.btnCancel'), array('class' => 'btn btn-outline pull-left btn-light', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
                {!! Form::button('<i class="fa ' . $actionBtnIcon . '" aria-hidden="true"></i> ' . $btnSubmitText, array('class' => 'btn btn-' . $modalClass . '', 'type' => 'button', 'id' => 'confirm' )) !!}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $(function() {
        // Confirm Form Submit Modal
        $('#{{$formTrigger}}').on('show.bs.modal', function (e) {
            var message = $(e.relatedTarget).attr('data-message');
            var title = $(e.relatedTarget).attr('data-title');
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-body p').text(message);
            $(this).find('.modal-title').text(title);
            $(this).find('.modal-footer #confirm').data('form', form);
        });
        $('#{{$formTrigger}}').find('.modal-footer #confirm').on('click', function(){
            $(this).data('form').submit();
        });
    });
</script>

@endpush
