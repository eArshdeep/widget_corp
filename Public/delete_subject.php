<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>

<?php enforce_login(); ?>

<?php

  // if no form post was submitted, redirect to homepage
  if(!isset($_POST["submit"])) {
    redirect_to("admin.php");
  }

  // get current subject
  $current_subject = find_subject_by_id($_POST["subject_id"]);

  // redirect if subject not found in database
  if(!isset($current_subject)){
    $_SESSION["message"] = "Sorry, couldn\'t find the subject in my records. Unable to delete :( ";
    redirect_to("manage_content.php");
  }

  // delete subject
  $subject_query = "DELETE FROM subjects WHERE id = {$current_subject["id"]} LIMIT 1";
  $subject_result = mysqli_query($db, $subject_query);
  $subject_query_rows_affected = mysqli_affected_rows($db);

  // delete subject's pages
  $page_query = "DELETE FROM pages WHERE subject_id = {$current_subject["id"]}";
  $page_result = mysqli_query($db, $page_query);

  if($subject_result && $subject_query_rows_affected == 1 && $page_result) {
    // query was sucessful and one record was deleted
    $_SESSION["message"] = "Subject was deleted!";
    adjust_position_for_subject_deletion($current_subject["position"]);
    redirect_to("manage_content.php");
  } else {
    // query failed
    $_SESSION["message"] = "Unable to delete subject, BONKERS!";
    redirect_to("manage_content.php");
  }

?>
