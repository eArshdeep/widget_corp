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
