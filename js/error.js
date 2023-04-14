$(document).ready(function() {
    // Form validation
    $('#addUserForm').submit(function(e) {
      e.preventDefault();
  
      var form = $(this);
      var url = form.attr('action');
      var type = form.attr('method');
      var data = form.serialize();
  
      $.ajax({
        url: url,
        type: type,
        data: data,
        dataType: 'json',
        success: function(response) {
          if (response.success == true) {
            location.reload();
          } else {
            $('#addCollectorModal').modal('show');
            // Show errors
            $.each(response.errors, function(key, value) {
              var input = $('#' + key);
              input.addClass('is-invalid');
              input.parent().find('.error').text(value);
            });
          }
        }
      });
    });
  
    // Reset form on modal close
    $('#addCollectorModal').on('hidden.bs.modal', function() {
      $(this).find('form').trigger('reset');
      $(this).find('input, select').removeClass('is-invalid');
      $(this).find('.error').text('');
    });
  });
  