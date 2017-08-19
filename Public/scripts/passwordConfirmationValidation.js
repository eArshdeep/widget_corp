function checkPasswordMatch() {

  // handle both passwords
  var password = $("#password").val();
  var confirm_password = $("#confirm_password").val();

  // check for match and notify user
  if ( password != confirm_password ) {
    $("#confirm_password").removeClass("valid").addClass("invalid");
  }
  else if ( password == confirm_password && ( password.length > 0 && confirm_password.length > 0)) {
    $("#confirm_password").removeClass("invalid").addClass("valid");
  }

}

function advancedCheckPassword(){

  /*
  * this is an advanced form of password validation
  *
  * it is for a form where the submit button is only clickable
  * if and when the form has passed validation
  * this ensures that a form cannot even be submited unless
  * it already passes validation
  *
  * password must be atleast 8 characters
  */

  // handle both passwords
  var password = $("#password").val();
  var confirm_password = $("#confirm_password").val();

  // check for match and notify user
  // * password too short
  if ( password.length < 8 && confirm_password.length < 8 ) {
      $("#reset-submission").addClass("disabled");
      $("#status").html("Password too short!");
  }
  // * either password long enough but do not match
  else if ( (password.length > 7 || confirm_password.length > 7) && password != confirm_password ) {
    $("#confirm_password").removeClass("valid").addClass("invalid");
    $("#reset-submission").addClass("disabled");
    $("#status").html(null);
  }
  // * all validation passed
  else if ( password == confirm_password && ( password.length > 7 && confirm_password.length > 7) ) {
    $("#confirm_password").removeClass("invalid").addClass("valid");
    $("#reset-submission").removeClass("disabled");
    $("#status").html(null);
  }

}
