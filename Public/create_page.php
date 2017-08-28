<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/validation.php'; ?>

<?php enforce_login(); ?>

<?php
  if(isset($_POST["submit"])){
    // handle values
    $menu_name = $_POST["menu_name"];
    $position = (int) $_POST["position"];
    $subject_id = (int) $_POST["subject_id"];
    if(isset($_POST["visible"])){
      $visible = (int) $_POST["visible"];
    }
    $content = $_POST["content"];

    // validate form values
    $required_fields = array("menu_name", "position", "visible", "subject_id", "content");
    validate_presences($required_fields);

    $fields_with_length_limit = array("menu_name" => 30);
    validate_max_lengths($fields_with_length_limit);

    if(!empty($errors)){
      // put form validation errors in session
      $_SESSION["errors"] = $errors;

      // put values entered by user into session to repopulate form
      if(has_presence($menu_name)){
        $_SESSION["repop_menu_name"] = $menu_name;
      }

      if(has_presence($position) && $position !== 0){
        $_SESSION["repop_position"] = $position;
      }

      if(has_presence($visible)){
        $_SESSION["repop_visible"] = $visible;
      }

      if(has_presence($content)){
        $_SESSION["repop_content"] = $content;
      }

      // redirect user to add page form
      redirect_to("new_page.php?subject={$subject_id}");
    }

    // escape
    $menu_name = mysqli_real_escape_string($db, $menu_name);
    $content = mysqli_real_escape_string($db, $content);
    
    // build query
    $query = "INSERT INTO pages ( menu_name, subject_id, position, visible, content) VALUES ( '{$menu_name}', {$subject_id}, {$position}, {$visible}, '{$content}');";
    $result = mysqli_query($db, $query);

    if($result){
      // if creation is successful
      $_SESSION["message"] = "Page was added successfully. Cheers :)";
      $inserted_row_id = mysqli_insert_id($db);
      adjust_position_for_page_addition($position, $inserted_row_id, $subject_id);
      redirect_to("manage_content.php?subject={$subject_id}");
    } else {
      // if creation is NOT successful
      $_SESSION["message"] = "Unable to add page. Bonkers!";
      redirect_to("manage_content.php?subject={$subject_id}");
    }

  } else {
    // if trying to access this page via a url, and not a post request, redirect to homepage
    redirect_to("admin.php");
  }
?>

<?php
  if(isset($db)){mysqli_close($db);}
  if(isset($result)){mysqli_free_result($result);}
?>
