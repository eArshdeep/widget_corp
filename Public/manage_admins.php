<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/functions.php'; ?>

<?php enforce_login(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Administrators</title>
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>
  <?php include '../includes/layout/header.php'; ?>

  <main>
    <div class="container">

      <!-- Back Button -->
      <button class="white btn waves-effect waves-light margin-top-adder">
        <a href="admin.php">
          <i class="material-icons left">arrow_back</i> Dashboard
        </a>
      </button>

      <section class="section">
        <h2>Manage Administrators</h2>
        <div class="row">
          <?php include '../includes/layout/admin_cards.php'; ?>
          <?php include '../includes/layout/admin_delete_modal.php'; ?>
        </div>
      </section>
    </div>
  </main>

  <div class="fixed-action-btn">
    <a class="btn-floating btn-large orange" href="new_admin.php">
      <i class="large material-icons">mode_edit</i>
    </a>
  </div>

  <?php include '../includes/layout/footer.php'; ?>
  <?php include '../includes/layout/meta_body.php'; ?>
  <script type="text/javascript" src="scripts/admin_deletion_modal.js"></script>

  <script type="text/javascript">

    $(document).ready(function () {
      <?php toast_message(); ?>
      $('.modal').modal();
      $(".button-collapse").sideNav();
    });

    $("#confirm_username").on("change paste keyup", verifyDeleteConfirmation);

  </script>

  <?php mysqli_close($db); ?>

</body>
</html>
