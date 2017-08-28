<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>

<?php enforce_login(); ?>

<?php

  // if no form post was submitted, redirect to homepage
  if(!isset($_POST["submit"])) {
    redirect_to("admin.php");
  }

  // get admin
  $admin = grab_admin_by_id($_POST["admin_id"]);

  // redirect if admin not found in database
  if(!isset($admin)){
    $_SESSION["message"] = "Sorry, that administrator is not in my records. Removal aborted :( ";
    redirect_to("manage_admins.php");
  }

  // delete admin
  $query = "DELETE FROM admins WHERE id = {$admin["id"]} LIMIT 1";
  $result = mysqli_query($db, $query);

  if($result && mysqli_affected_rows($db) == 1) {
    // query was sucessful and one record was deleted
    $_SESSION["message"] = "Administrator removed!";
    redirect_to("manage_admins.php");
  } else {
    // query failed
    $_SESSION["message"] = "Unable to remove administrator, BONKERS!";
    redirect_to("manage_admins.php");
  }

?>