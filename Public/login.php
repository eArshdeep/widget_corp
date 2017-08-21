<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/validation.php'; ?>

<?php

if( isset($_POST["submit"]) ) {

	// validate 
	$required_fields = array("username", "password");
	validate_presences($required_fields);

	// handle values
	$username = $_POST["username"];
	$password = $_POST["password"];

	if(empty($errors)) {

		// attempt login
		$found_admin = attempt_login($username, $password);

		if ($found_admin) {
			// success
			// mark user as logged in
			$_SESSION["admin_id"] = $found_admin["id"];
			$_SESSION["username"] = $found_admin["username"];
			redirect_to("admin.php");
		}
		else {
			// fail
			$_SESSION["message"] = "Wrong username or password, please try again!";
		}
	}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>

<?php generate_header(); ?>

<main>
  <div class="container">

  	<div class="row margin-top-large-adder">
        <div class="col s12 m8 offset-m2">

          <div class="card z-depth-5">

            <div class="card-content">

              <center>
              	<h2>Login</h2>
              </center>

              <form action="login.php" method="post">
              	
			        <div class="input-field">
			          <input placeholder="Username" id="username" type="text" class="validate" name="username" value="<?php if(isset($username)){echo htmlentities($username);} ?>">
			          <label for="username" <?php highlight_label($errors, "username"); ?>>Username</label>
			        </div>

			        <div class="input-field">
			          <input id="password" type="password" class="validate" name="password">
			          <label for="password" <?php highlight_label($errors, "password"); ?>>Password</label>
			        </div>

			        <div class="row">
			        	<button class="col s12 btn orange waves-effect waves-light margin-top-large-adder" type="submit" name="submit">Login</button>
			        </div>

              </form>

            </div>

          </div>
        </div>
     </div>

     <div class="section">
     	<div class="row">
     		<div class="col s12 m8 offset-m2">
     			<?php echo_errors($errors); ?>
     		</div>
     	</div>
     </div>

  </div>
</main>

<?php include '../includes/layout/footer.php';?>
<?php include '../includes/layout/meta_body.php'; ?>

<script type="text/javascript">
	$(document).ready(function(){
		<?php toast_message(); ?>
	});
</script>

</body>
</html>
