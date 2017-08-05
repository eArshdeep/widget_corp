<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/validation.php'; ?>

<?php

  if(isset($_POST["submit"])){

    // HANDLE VALUES
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];


    // VALIDATE VALUES
    $required_fields = array("first_name", "last_name", "email", "username", "password", "confirm_password");
    validate_presences($required_fields);

    // validate password's minimum length
    if ( strlen($password) > 0 ) {
      $fields_min_length_validate = array("password" => 8);
      validate_min_lengths($fields_min_length_validate);
    }

    // validate password match
    if($password != $confirm_password && ( strlen($password) >= 8 || strlen($confirm_password) >= 8 )  ){
      $errors["password"] = "Passwords do not match";
    }

    $fields_max_length_validate = array("first_name" => 35, "last_name" => 35, "email" => 254, "username" => 50, "password" => 60);
    validate_max_lengths($fields_max_length_validate);

    if(!empty($errors)){

      // STORE ENTERED FORM VALUES IN SESSION FOR REPOPULATION
      $_SESSION["errors"] = $errors;

      if(has_presence($first_name)){
        $_SESSION["repop_first_name"] = $first_name;
      }

      if(has_presence($last_name)){
        $_SESSION["repop_last_name"] = $last_name;
      }

      if(has_presence($email)){
        $_SESSION["repop_email"] = $email;
      }

      if(has_presence($username)){
        $_SESSION["repop_username"] = $username;
      }

      // RETURN USER TO FORM
      redirect_to("new_admin.php");

    }

    // ESCAPE
    $first_name = mysqli_real_escape_string($db, $first_name);
    $last_name = mysqli_real_escape_string($db, $last_name);
    $email = mysqli_real_escape_string($db, $email);
    $username = mysqli_real_escape_string($db, $username);
    $password = mysqli_real_escape_string($db, $password);

    // QUERY
    $query = "INSERT INTO admins ( first_name, last_name, email, username, hashed_password) VALUES ( '{$first_name}', '{$last_name}', '{$email}', '{$username}', '{$password}');";
    $result = mysqli_query($db, $query);

    // HANDLE RESULT
    if($result){
      // IF CREATION SUCCESSFUL
      $_SESSION["message"] = "Administrator added successfully. Cheers :)";
      redirect_to("manage_admins.php");
    }
    else {
      // IF CREATION not SUCCESSFUL
      $_SESSION["message"] = "Unable to add administrator successfully. Bonkers!";
      redirect_to("new_admin.php");
    }

  } else {

    // NO POST, REDIRECT
    redirect_to("new_admin.php");

  }

?>
