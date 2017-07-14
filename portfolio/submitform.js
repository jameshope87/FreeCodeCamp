$(function() {
  
  //Get the form
  var form = $('#ajax-contact');
  
  //Find the message div
  var formMessages = $('#form-messages');
  
	// Set up an event listener for the contact form.
  $(form).submit(function(e) {
    //stop the browser from submitting the form
    e.preventDefault();
    
    //serialise the form data
    var formData = $(form).serialize();
    
    //Submit the form using AJAX
    $.ajax({
      type: 'POST',
      url: $(form).attr('action'),
      data: formData
    })
    .done(function(response) {
      //Make suse the formmessages div has the success class
      $(formMessages).css('display','');
      $(formMessages).removeClass('error');
      $(formMessages).addClass('success');
      
      //Set the message text
      $(formMessages).text(response);
      
      //clear the form data
      $('#name').val('');
      $('#email').val('');
      $('#message').val('');
      $('.success').delay(5000).fadeOut(400)
    })
    .fail(function(data) {
      //Make suse the formmessages div has the success class
      $(formMessages).removeClass('success');
      $(formMessages).addClass('error');
      
      //Set the message text
      if (data.responseText !== '') {
        $(formMessages).text(data.responseText);
      } else {
        $(formMessages).text('Oops! An error occured and your message could not be sent.');
      }
    });
    

  });
  
});