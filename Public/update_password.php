<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>

<?php

if(isset($_POST["submit"])) {

  // handle values
  $id = $_POST["id"];
  $password = $_POST["password"];

  /* GRAB ADMIN */
  $admin = grab_admin_by_id($id);

  /* REDIRECT if admin NOT found */
  if(!$admin){
    $_SESSION['message'] = "I\'m sorry, but I couldn\'t find that administrator in my records. Please try again :(";
    redirect_to('manage_admins.php');
  }

  // escape
  $password = encrypt_password($password);

  // query
  $query = "UPDATE admins SET hashed_password = '{$password}' WHERE id = {$id} LIMIT 1";
  $result = mysqli_query($db, $query);

  // verify result
  if ($result && mysqli_affected_rows($db) == 1) {
    $_SESSION["message"] = "Password reset. Cheers!";
    redirect_to("manage_admins.php");
  }
  elseif ($result && mysqli_affected_rows($db) == 0) {
    $_SESSION["message"] = "Unable to change password -_-";
    redirect_to("manage_admins.php");
  }
  else {
    $_SESSION["message"] = "Unable to process request. Password remains the same. Bonkers, try again!";
    redirect_to("manage_admins.php");
  }

} else {
  redirect_to("admin.php");
}

?>
