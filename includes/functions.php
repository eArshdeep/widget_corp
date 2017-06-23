<?php

  function redirect_to($new_location){
    header("Location: " . $new_location);
    exit;
  }

  function confirm_query($result){
    if(!$result){
      die("Atempt to make database query has failed.");
    }
  }

  function find_all_subjects(){
    global $db;
    $query = "SELECT * FROM subjects ORDER BY position ASC;";
    $query = mysqli_real_escape_string($db, $query);
    $subject_set = mysqli_query($db, $query);
    confirm_query($subject_set);
    return $subject_set;
  }

  function find_pages_for_subject($subject_id){
    global $db;
    $query = "SELECT * FROM pages WHERE subject_id = {$subject_id} ORDER BY position ASC;";
    $query = mysqli_real_escape_string($db, $query);
    $page_set = mysqli_query($db, $query);
    confirm_query($page_set);
    return $page_set;
  }

  function find_subject_by_id($subject_id){
    global $db;
    $subject_id = mysqli_real_escape_string($db, $subject_id);
    $query = "SELECT * FROM subjects WHERE id = {$subject_id} LIMIT 1";
    $subject = mysqli_query($db, $query);
    confirm_query($subject);
    if($subject = mysqli_fetch_assoc($subject)){
      return $subject;
    } else {return null;}
  }

  function find_page_by_id($page_id){
    global $db;
    $page_id = mysqli_real_escape_string($db, $page_id);
    $query = "SELECT * FROM pages WHERE id = {$page_id} LIMIT 1";
    $page = mysqli_query($db, $query);
    confirm_query($page);
    if($page = mysqli_fetch_assoc($page)){
      return $page;
    } else {return null;}
  }

?>
