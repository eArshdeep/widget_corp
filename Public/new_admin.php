<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/functions.php'; ?>

<?php enforce_login(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>New Administrator</title>
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>
  <?php include '../includes/layout/header.php'; ?>
  <?php $errors = grab_errors(); ?>

  <main>
    <div class="container">
      <a href="manage_admins.php" class="orange-text inline_block margin-top-adder"> &#8592; Cancel </a>
      <h2>New Administrator</h2>

      <section>

        <!-- FORM -->
        <form action="create_admin.php" method="post">

          <div class="row">
            <!-- FIRST NAME -->
            <div class="input-field col s6">
              <input id="first_name" type="text" class="validate" name="first_name" <?php repopulate_text_field("repop_first_name"); ?> >
              <label for="first_name" <?php highlight_label($errors, "first_name") ?> >First Name</label>
            </div>
            <!-- LAST NAME -->
            <div class="input-field col s6">
              <input id="last_name" type="text" class="validate" name="last_name" <?php repopulate_text_field("repop_last_name"); ?> >
              <label for="last_name" <?php highlight_label($errors, "last_name") ?> >Last Name</label>
            </div>
          </div>

          <!-- EMAIL -->
          <div class="input-field">
            <input id="email" type="email" class="validate" name="email" <?php repopulate_text_field("repop_email"); ?> >
            <label for="email" <?php highlight_label($errors, "email") ?> >Email</label>
          </div>

          <!-- USERNAME -->
          <div class="input-field">
            <input id="username" type="text" class="validate" name="username" <?php repopulate_text_field("repop_username"); ?> >
            <label for="username" <?php highlight_label($errors, "username") ?> >Username</label>
          </div>

          <!-- PASSWORD -->
          <div class="input-field">
            <input id="password" type="password" class="validate" name="password">
            <label for="password" <?php highlight_label($errors, "password") ?> >Password</label>
            <p class="brown-text text-lighten-2">Password should be atleast 8 or more characters.</p>
          </div>

          <!-- PASSWORD CONFIRMATION -->
          <div class="input-field">
            <input id="confirm_password" type="password" name="confirm_password">
            <label for="confirm_password"
              <?php highlight_label($errors, "confirm_password") ?>
              data-error="Passwords do not match!" data-success="Password Match" > Confirm Password
            </label>
          </div>

          <div>
            <p id="status"></p>
          </div>

          <!-- Submit Button -->
          <button class="btn waves-effect waves-light margin-top-large-adder" type="submit" name="submit">Create</button>

        </form>

      </section>

      <section>
        <?php echo_errors($errors); ?>
      </section>

    </div>
  </main>

  <?php include '../includes/layout/footer.php'; ?>
  <?php include '../includes/layout/meta_body.php'; ?>
  <script type="text/javascript" src="scripts/passwordConfirmationValidation.js"></script>

  <script type="text/javascript">

    $(document).ready(function () {
      $("#password").keyup(checkPasswordMatch);
      $("#confirm_password").keyup(checkPasswordMatch);
      <?php toast_message(); ?>
    });

  </script>

</body>
</html>
