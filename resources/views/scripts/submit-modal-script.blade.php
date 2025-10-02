<script type="text/javascript">
    $(document).ready(function() {
        var modalId = $('#submitForm');

        modalId.on('show.bs.modal', function(e) {
            var modalClass = $(e.relatedTarget).attr('data-modalClass') || '';
            var inputValue = $(e.relatedTarget).attr('data-value');
            var action = $(e.relatedTarget).attr('data-action');
            var title = $(e.relatedTarget).attr('data-title');
            var form = $(e.relatedTarget).closest('form');
            var self = $(this);

            self.alterClass('modal-*', modalClass)
            self.find('.modal-title').text(title);
            self.find('form').attr('action', action);
            if(inputValue) {
                self.find('form input[name="name"]').val(inputValue);
                self.find('form').append("<input type='hidden' name='_method' value='PUT'>");
            }

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
                    modalId.find('.modal-body').html(
                        '<div class="alert alert-success" role="alert">Form submitted successfully!</div>'
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
