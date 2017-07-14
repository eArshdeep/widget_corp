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

  function generate_header($display_admin_link=false){
    $output = '<nav>';
    $output .= '<div class="nav-wrapper orange">';
       $output .= '<h1 class="margin-remover">';
         $output .= '<a href="index.php" class="brand-logo center">Widget Corporation</a>';
       $output .= '</h1>';
       if($display_admin_link===true){
         // hamburger icon
         $output .= '<a href="#" data-activates="admin_nav" class="button-collapse"><i class="material-icons">menu</i></a>';
         // nav
         $output .= '<ul class="left hide-on-med-and-down">';
           $output .= '<a href="admin.php">Administrator Area</a>';
         $output .= '</ul>';
         // mobile nav
         $output .= '<ul class="side-nav" id="admin_nav">';
          $output .= '<li><a href="admin.php">Administrator Area</a>';
         $output .= '</ul>';
       }
     $output .= '</div>';
    $output .= '</nav>';
    echo $output;
  }

  function echo_errors($errors=array()){
    $output = null;

    if(!empty($errors)){
      $output = "<p class='margin-adder'>Please fix the following:</p>";
      $output .= "<ul>";
      foreach ($errors as $field => $error) {
        $error = htmlentities($error);
        $output .= "<li class='make_list'> {$error} </li>";
      }
      $output .= "</ul>";
    }

    echo $output;
  }

  function repopulate_menu_name($name){
    if( isset($_SESSION[$name]) ) {
      $menu_name = htmlentities($_SESSION[$name]);
      echo "value='{$menu_name}'";
      $_SESSION[$name] = null;
    }
  }

  function repopulate_visibility($current_value){
    if (isset($_SESSION["repop_visible"]) && $_SESSION["repop_visible"] === $current_value) {
      echo "checked";
      $_SESSION["repop_visible"] = null;
    }
  }

?>
