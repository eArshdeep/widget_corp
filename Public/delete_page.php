<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>

<?php enforce_login(); ?>

<?php

  // if no form post was submitted, redirect to homepage
  if(!isset($_POST["submit"])) {
    redirect_to("admin.php");
  }

  // get current page
  $current_page = find_page_by_id($_POST["page_id"]);

  // redirect if page not found in database
  if(!isset($current_page)){
    $_SESSION["message"] = "Sorry, couldn\'t find the page in my records. Unable to delete :( ";
    redirect_to("manage_content.php");
  }

  // delete page
  $query = "DELETE FROM pages WHERE id = {$current_page["id"]} LIMIT 1";
  $result = mysqli_query($db, $query);
  $subject_query_rows_affected = mysqli_affected_rows($db);

  if($result && mysqli_affected_rows($db) == 1) {
    // query was sucessful and one record was deleted
    $_SESSION["message"] = "Page was deleted!";
    adjust_position_for_page_deletion($current_page["position"], $current_page["subject_id"], $current_page["id"]);
    redirect_to("manage_content.php?subject={$current_page["subject_id"]}");
  } else {
    // query failed
    $_SESSION["message"] = "Unable to delete page, BONKERS!";
    redirect_to("manage_content.php?subject={$current_page["subject_id"]}");
  }

?>
