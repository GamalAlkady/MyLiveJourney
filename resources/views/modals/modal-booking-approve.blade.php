  <div class="modal fade" id="approveRequestModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <form action="" id="approveRequestForm" method="POST">
              @csrf
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Approve Booking Request</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="text-center">Are you sure to approve this booking request?</div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">No, Go
                          Back</button>
                      <button type="submit" class="btn btn-success">Yes, Approve</button>
                  </div>
              </div>
          </form>
      </div>
  </div>

  @push('scripts')
      <script type="text/javascript">
          $(document).ready(function() {
              var modalId = $('#bookingTour');

              modalId.on('show.bs.modal', function(e) {
                  // console.log('sss');

                  var modalClass = $(e.relatedTarget).attr('data-modalClass') || '';
                  var inputValue = $(e.relatedTarget).attr('data-value');
                  var maxSeats = $(e.relatedTarget).attr('data-max_seats');
                  var action = $(e.relatedTarget).attr('data-action');
                  var title = $(e.relatedTarget).attr('data-title');
                  // console.log(form);

                  var self = $(this);

                  self.alterClass('modal-*', modalClass)
                  self.find('.modal-title').text(title);
                  self.find('form').attr('action', action);
                  self.find('form input[name="seats"]').attr('max', maxSeats);
                  if (inputValue) {
                      self.find('form input[name="seats"]').val(inputValue);
                      self.find('form').append("<input type='hidden' name='_method' value='PUT'>");
                  }

                  $('#tour_id').val($(e.relatedTarget).attr('data-tour_id'));


                  $('#seats').on('focus', function() {
                      $(this).select();
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
