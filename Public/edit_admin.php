<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/validation.php'; ?>

<?php

if ( isset($_POST["submit"]) || isset($_POST["resubmit"]) ) {

  /* GRAB ADMIN */
  $admin = grab_admin_by_id($_POST["admin_id"]);

  /* REDIRECT if admin NOT found */
  if(!$admin){
    $_SESSION['message'] = "I\'m sorry, but I couldn\'t find that administrator in my records. Please try again :(";
    redirect_to('manage_admins.php');
  }
}

?>

<?php

if(isset($_POST["resubmit"])){
  /* HANDLE VALUES */
  $id = $_POST["admin_id"];
  $first_name = (isset($_POST["first_name"])) ? $_POST["first_name"] : null;
  $last_name = (isset($_POST["last_name"])) ? $_POST["last_name"] : null;
  $email = (isset($_POST["email"])) ? $_POST["email"] : null;
  $username = (isset($_POST["username"])) ? $_POST["username"] : null;
  $confirm_password = (isset($_POST["confirm_password"])) ? $_POST["confirm_password"] : null;

  // no password was entered
  if( strlen($confirm_password) == 0 ){
    $errors["confirm_password"] = "You need to confirm the password for this administrator to update their properties.";
  }
  // incorect password was entered
  elseif ( $confirm_password != $admin["hashed_password"] ) {
    $errors["confirm_password"] = "Incorrect password was entered.";
  }
  // correct password, continue validation and query
  elseif ( $confirm_password == $admin["hashed_password"] ) {

    /* Passwords are a match... continue validation */
    $required_fields = array("first_name", "last_name", "email", "username");
    validate_presences($required_fields);

    $fields_with_length_limit = array("first_name" => 30, "last_name" => 30, "email" => 30, "username" => 30);
    validate_max_lengths($fields_with_length_limit);

    if (empty($errors)) {

      // escape
      $first_name = mysqli_real_escape_string($db, $first_name);
      $last_name = mysqli_real_escape_string($db, $last_name);
      $email = mysqli_real_escape_string($db, $email);
      $username = mysqli_real_escape_string($db, $username);

      // query
      $query = "UPDATE admins SET first_name = '{$first_name}', last_name = '{$last_name}', email = '{$email}', username = '{$username}' WHERE id = {$id} LIMIT 1";
      $result = mysqli_query($db, $query);

       if ($result && mysqli_affected_rows($db) == 1) {
        $_SESSION["message"] = "Administrator was updated successfully. Cheers :)";
        redirect_to("manage_admins.php");
      }

      elseif ($result && mysqli_affected_rows($db) == 0) {
        $_SESSION["message"] = "Nothing to change, new values same as old values -_-";
        redirect_to("manage_admins.php");
      }
      
      else {
        $_SESSION["message"] = "Unable to process changes. Bonkers!";
        redirect_to("manage_admins.php");
      }

    }

  }

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

  <title>Edit Administrator</title>
  <?php include '../includes/layout/meta_head.php'; ?>

</head>

<body>

  <?php generate_header(); ?>

  <main class="container">

  	<a href="manage_admins.php" class="orange-text inline_block margin-top-adder"> &#8592; Cancel </a>

  	<h2>Edit Administrator:
	  	<span class="light-weight">
	  		<?php echo htmlentities($admin["username"]); ?>
	  	</span>
  	</h2>

  	<form action="edit_admin.php" method="post">

  		<div class="row">

	  		<!-- FIRST NAME -->
	        <div class="input-field col s6">

	          <input id="first_name" type="text" class="validate" name="first_name"
	          value="<?php echo (isset($first_name)) ? htmlentities($first_name) : htmlentities($admin["first_name"]); ?>" >
	          <label for="first_name" <?php highlight_label($errors, "first_name") ?> >First Name</label>

	        </div>

	        <!-- LAST NAME -->
	        <div class="input-field col s6">

	          <input id="last_name" type="text" class="validate" name="last_name"
	          value="<?php echo (isset($last_name)) ? htmlentities($last_name) : htmlentities($admin["last_name"]); ?>" >
	          <label for="last_name" <?php highlight_label($errors, "last_name") ?> >Last Name</label>

	        </div>

	      </div>

	      <!-- EMAIL -->
          <div class="input-field">

            <input id="email" type="email" class="validate" name="email"
            value="<?php echo (isset($email)) ? htmlentities($email) : htmlentities($admin["email"]); ?>" >
            <label for="email" <?php highlight_label($errors, "email") ?>>Email</label>

          </div>

          <!-- USERNAME -->
          <div class="input-field">

            <input id="username" type="text" class="validate" name="username"
            value="<?php echo (isset($username)) ? htmlentities($username) : htmlentities($admin["username"]); ?>" >
            <label for="username" <?php highlight_label($errors, "username") ?> >Username</label>

          </div>

          <!-- Submit Section -->
          <div class="section">

          	<div class="divider"></div>

          	<p>In order to update settings for this administrator, please enter <b>their</b> password below. If they no longer have access to their password, or the administrator is no longer with the organization, you can reset their password in the <a class="link_underline" href="manage_admins.php">manage administrators</a> section to retrieve control.</p>

          	<!-- PASSWORD CONFIRMATION -->
         	 <div class="input-field margin-top-large-adder">

            	<input id="confirm_password" type="password" name="confirm_password">

            	<label for="confirm_password" <?php highlight_label($errors, "confirm_password") ?> >
            		Confirm Password
            	</label>

          	</div>

          	<input type="hidden" name="admin_id" value="<?= $admin["id"] ?>">

          	<button class="btn orange waves-effect waves-light margin-top-large-adder" type="submit" name="resubmit">Update</button>

          </div>

      </div>

  	</form>

  	<div class="section">
  		<?php echo_errors($errors); ?>
  	</div>

  </main>

  <?php include '../includes/layout/footer.php'; ?>
  <?php include '../includes/layout/meta_body.php'; ?>

  <script type="text/javascript">
  	$(document).ready(function(){
  		<?php toast_message(); ?>
  	});
  </script>

</body>
</html>
