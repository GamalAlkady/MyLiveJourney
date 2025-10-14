<div class="modal fade" id="bookingTour" role="dialog" aria-labelledby="bookingTourLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('modals.form_modal_submit_title') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" class="needs-validation" novalidate>
                <div class="modal-body">
                    @csrf


                    {{-- <div class=""> --}}
                    <div class="form-group mb-3 has-feedback {{ $errors->has('tour_id') ? ' is-invalid ' : '' }}">
                        <label for="tour_id" class="control-label">{!! trans('forms.labels.icon.tour') !!}</label>
                        {{-- <div class="mb-4"> --}}

                        @use('App\Models\Tour')
                        {{-- <div class="input-group"> --}}
                        <select class="form-select form-control" name="tour_id" id="tour_id" required>
                            <option value="">{{ __('forms.placeholders.choose_tour') }}</option>
                            @php $tours = Tour::all(); @endphp
                            @foreach ($tours as $item)
                                <option value="{{ $item->id }}" @selected(old('tour_id') == $item->id)>
                                    {{ $item->title }}
                                </option>
                            @endforeach
                        </select>
                        {{-- </div> --}}
                        {{-- @if ($errors->has('tour_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tour_id') }}</strong>
                                </span>
                            @endif --}}
                        {{-- </div> --}}
                    </div>


                    <div class="form-group ">
                        <label for="seats" class="">{!! __('forms.labels.icon.seats') !!} <span
                                class="text-gray text-muted"></span> </label>
                        <input type="number" min="1" value='1' class="form-control "
                            placeholder="{{ __('forms.placeholders.seats') }}" id="seats" name="seats" required>
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

@push('scripts')
    <script type="text/javascript">
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        $(document).ready(function() {

            var modalId = $('#bookingTour');

            modalId.on('show.bs.modal', function(e) {
                // console.log('sss');

                var modalClass = $(e.relatedTarget).attr('data-modalClass') || '';
                var inputValue = $(e.relatedTarget).attr('data-value');
                var bookingId = $(e.relatedTarget).attr('data-id');
                var seats = $(e.relatedTarget).attr('data-seats');
                var remindingSeats = $(e.relatedTarget).attr('data-remaining_seats');
                var action = $(e.relatedTarget).attr('data-action');
                var title = $(e.relatedTarget).attr('data-title');
                // console.log(form);

                var self = $(this);

                self.alterClass('modal-*', modalClass)
                self.find('.modal-title').text(title);
                self.find('form').attr('action', action);
                self.find('form input[name="seats"]').attr('max', parseInt(remindingSeats));
                self.find('form label[for="seats"] span').html("{{ __('forms.labels.remindingSeats') }} " +
                    remindingSeats);
                if (bookingId) {
                    self.find('form input[name="seats"]').val(seats);
                    self.find('form select').addClass('disabled text-gray');
                    // self.find('form').append("<input type='hidden' name='_method' value='PUT'>");
                    self.find('form').append("<input type='hidden' name='id' value='" + bookingId + "'>");
                }

                $('#tour_id').val($(e.relatedTarget).attr('data-tour_id'));


                $('#seats').on('focus', function() {
                    $(this).select();
                });

                $('#seats').on('change', function() {
                    // console.log($(this).val(),remindingSeats);

                    if (parseInt($(this).val()) > parseInt(remindingSeats)) {
                        $(this).val(seats ?? remindingSeats);
                    }
                });
            });

            modalId.find('.modal-footer #submit').on('click', function() {
                // ajax code using jquery
                var form = modalId.find('form');
                var formData = form.serialize();
                var submitButton = $(this);
                submitButton.prop('disabled', true);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // You can add a success message here if needed
                        // Add success message to modal body before reloading
                        // alert('Error: ' + response.message);

                        modalId.find('.modal-body').html(
                            '<div class="alert alert-success" role="alert">' + response
                            .message + '</div>'
                        );
                        // Reload the page after a short delay to show the success message
                        setTimeout(function() {
                            modalId.modal('hide');
                            window.location.reload();
                        }, 1000);
                    },
                    error: function(xhr) {
                        // Handle error response
                        alert('Error: ' + xhr.responseText);
                    },
                    complete: function() {
                        submitButton.prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
