(function () {
  "use strict";

  let forms = document.querySelectorAll('.php-email-form');

  forms.forEach( function(e) {
    e.addEventListener('submit', function(event) {
      event.preventDefault();
      let thisForm = this;
      let action = thisForm.getAttribute('action');
      
      if( ! action ) {
        displayError(thisForm, 'The form action property is not set!');
        return;
      }
      thisForm.querySelector('.loading').classList.add('d-block');
      thisForm.querySelector('.error-message').classList.remove('d-block');
      thisForm.querySelector('.sent-message').classList.remove('d-block');

      let formData = new FormData( thisForm );
      php_email_form_submit(thisForm, action, formData);

    });
  });

  function php_email_form_submit(thisForm, action, formData) {
    fetch(action, {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(response.statusText); // Throws error for non-200 responses
      }
      return response.json(); // Parse JSON response
    })
    .then(data => {
      thisForm.querySelector('.loading').classList.remove('d-block');
      if (data.message === "OK") {
        Swal.fire({
            title: "Message Sent",
            text: "Your message has been sent. Thank you!",
            icon: "success"
        });
        thisForm.reset(); 
      } else {
        Swal.fire({
            title: "Error",
            text: "Form submission failed. No error message returned from: " + action,
            icon: "error"
        });
      }
    })
    .catch(error => {
      Swal.fire({
          title: "Error",
          text: error.message,
          icon: "error"
      });
    });
}

})();
