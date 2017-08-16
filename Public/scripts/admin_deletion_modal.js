// function to be run on input change to verify if values match for deletion confirmation
// runs by event handler
function verifyDeleteConfirmation() {
  if( $(this).val().toLowerCase() == $("#value_username").text().toLowerCase() ) {
    $(".waves-red").removeClass("disabled");
  } else {
    $(".waves-red").addClass("disabled");
  }
}

// populates dynamic values to an empty modal
// runs onclick
function initiateModal(element){
  // handle values from data attribute of paramater element
  var admin_id = $(element).data("admin_id");
  var username = $(element).data("username");
  username = username.toUpperCase();
  // update values on modal with appropriate data
  $(value_admin_id).val(admin_id);
  $(value_username).text(username);
  // clear confirmation input by defualt
  $('#confirm_username').val(null);
  // if submit button is not disabled upon initiation, disable it
  // this is to counter previous successful entries
  if( !$(".waves-red").hasClass("disabled") ) $(".waves-red").addClass("disabled");
  
}
