<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/functions.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Administrators</title>
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>
  <?php generate_header(); ?>

  <main>
    <div class="container">
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

  <script type="text/javascript">

    $(document).ready(function () {
      <?php toast_message(); ?>
      $('.modal').modal();
      var username;
    });

    var target_menu_name = $("#value_username").text();

    function populateModalValues(element){
      // handle values from data attribute of paramater element
      var admin_id = $(element).data("admin_id");
      username = $(element).data("username");
      username = username.toUpperCase();
      // update values on modal with appropriate data
      $(value_admin_id).val(admin_id);
      $(value_username).text(username);
    }


    $("#confirm_username").on("change paste keyup", function() {
      if( $(this).val().toLowerCase() == username.toLowerCase() ) {
        $(".waves-red").removeClass("disabled");
        console.log("Enabled");
      } else {
        $(".waves-red").addClass("disabled");
        console.log("Disabled");
      }
    });

  </script>

  <?php mysqli_close($db); ?>

</body>
</html>
