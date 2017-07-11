<?php
  $current_subject = null;
  $current_page = null;

  if(isset($_GET["subject"])){
    $current_subject = find_subject_by_id($_GET["subject"]);
  } elseif (isset($_GET["page"])) {
    $current_page = find_page_by_id($_GET["page"]);
  }
?>
