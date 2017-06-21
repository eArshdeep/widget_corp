<?php
  $selected_subject_id = null;
  $selected_page_id = null;
  $current_subject = null;
  $current_page = null;

  if(isset($_GET["subject"])){
    $selected_subject_id = $_GET["subject"];
    $current_subject = find_subject_by_id($selected_subject_id);
  } elseif (isset($_GET["page"])) {
    $selected_page_id = $_GET["page"];
    $current_page = find_page_by_id($selected_page_id);
  }
?>
