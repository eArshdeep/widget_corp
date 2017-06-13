<?php

  function confirm_query($result){
    if(!$result){
      die("Atempt to make database query has failed.");
    }
  }

  function find_all_subjects(){
    global $db;
    $query = "SELECT * FROM subjects WHERE visible = 1 ORDER BY position ASC;";
    $subject_set = mysqli_query($db, $query);
    confirm_query($subject_set);
    return $subject_set;
  }

  function find_pages_for_subject($subject_id){
    global $db;
    $query = "SELECT * FROM pages WHERE visible = 1 AND subject_id = {$subject_id} ORDER BY position ASC;";
    $page_set = mysqli_query($db, $query);
    confirm_query($page_set);
    return $page_set;
  }

?>
