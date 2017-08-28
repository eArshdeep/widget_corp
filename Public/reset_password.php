<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/functions.php'; ?>

<?php

if(!isset($_POST["submit"]))
  redirect_to("admin.php");

?>

<?php enforce_login(); ?>

<!DOCTYPE html>

<html lang="en">

<head>

  <title>Reset Password</title>
  <?php include '../includes/layout/meta_head.php'; ?>

</head>

<body>

<?php include '../includes/layout/header.php'; ?>

<main>
  <div class="container">

    <a href="manage_admins.php" class="orange-text inline_block margin-top-adder"> &#8592; Cancel </a>

    <h2>Reset Password</h2>

    <form action="update_password.php" method="post">

        <p>Type your new password below. Password should be atleast 8 or more characters.</p>

        <!-- PASSWORD -->
      <div class="input-field">
        <input id="password" type="password" class="" name="password">
        <label for="password">Password</label>
      </div>

        <p>Confirm your new password:</p>

      <!-- PASSWORD CONFIRMATION -->
      <div class="input-field">
        <input id="confirm_password" type="password" name="confirm_password">
        <label for="confirm_password"
          data-error="Passwords do not match!" data-success="Password Match" > Confirm Password
        </label>
      </div>

      <div>
        <p id="status" class="red-text"></p>
      </div>

      <input type="hidden" name="id" value="<?= htmlentities($_POST["admin_id"]); ?>">

      <!-- Submit Button -->
      <button class="disabled btn waves-effect waves-light margin-top-large-adder" type="submit" name="submit" id="reset-submission">Reset</button>

    </form>

  </div>
</main>

<?php include '../includes/layout/footer.php';?>
<?php include '../includes/layout/meta_body.php'; ?>
<script type="text/javascript" src="scripts/passwordConfirmationValidation.js"></script>

<script type="text/javascript">

	$(document).ready(function () {
	  $("#password").keyup(advancedCheckPassword);
	  $("#confirm_password").keyup(advancedCheckPassword);
	});

</script>

</body>
</html>
