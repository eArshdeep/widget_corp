function verifyDelete() {
  if( $(this).val().toLowerCase() == $("#value_username").text().toLowerCase() ) {
    $(".waves-red").removeClass("disabled");
    console.log("Enabled");
  } else {
    $(".waves-red").addClass("disabled");
    console.log("Disabled");
  }
}

function populateModalValues(element){
  // handle values from data attribute of paramater element
  var admin_id = $(element).data("admin_id");
  var username = $(element).data("username");
  username = username.toUpperCase();
  // update values on modal with appropriate data
  $(value_admin_id).val(admin_id);
  $(value_username).text(username);
}
