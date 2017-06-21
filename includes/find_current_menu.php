<?php
  $selected_subject_id = null;
  $selected_page_id = null;
  if(isset($_GET["subject"])){
    $selected_subject_id = $_GET["subject"];
  } elseif (isset($_GET["page"])) {
    $selected_page_id = $_GET["page"];
  }
?>
