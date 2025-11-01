<div class="modal fade" id="submitForm" role="dialog" aria-labelledby="submitFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('modals.form_modal_submit_title') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="name"> {{__('forms.labels.name')}} </label>
                        <input type="text" class="form-control" placeholder="{{ __('forms.placeholders.enter_name') }}" id="name"
                            name="name" >
                    </div>



                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('modals.form_modal_default_btn_cancel') }}</button>

                    <button type="submit" class="btn btn-success"
                        id="submit">{{ trans('modals.confirm_modal_button_save_text') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


