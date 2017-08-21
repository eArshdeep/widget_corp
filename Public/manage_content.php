<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php include '../includes/find_current_menu.php'; ?>

<?php enforce_login(); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage</title>
  <!-- Import meta for head -->
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>

  <!-- Import header and top nav -->
  <?php generate_header($display_content_nav=true); ?>

  <main>
    <div class="row">
        <!-- NAV SECTION -->
        <section class="col s12 m2">
          <?php include '../includes/layout/nav.php'; ?>
        </section>

      <!-- MAIN SECTION -->
      <section class="col s12 m10">
        <div class="container">
          <?php
            if(isset($current_subject)) {
              include '../includes/layout/subject_overview.php';
            }
            elseif (isset($current_page)){
              include '../includes/layout/page_overview.php';
            }
            else {
              echo "<p>Please select a page or subject to manage or modify. <span class=\"hide-on-med-and-up\">Swipe right to view the navigation.</span></p>";
            }
          ?>
        </div>
      </section>
    </div>
  </main>

  <?php
    // release db resources and handles
    mysqli_close($db);
    mysqli_free_result($subject_set);
    mysqli_free_result($page_set);
  ?>

  <!-- Import footer and meta -->
  <?php include '../includes/layout/footer.php'; ?>
  <?php include '../includes/layout/meta_body.php'; ?>

  <script type="text/javascript">
    $(document).ready(function() {
      <?php toast_message(); ?>
      // initialize materialize modal
      $('.modal').modal();
      // initialize materialize side navbar hamburger for mobile
      $(".button-collapse").sideNav();
    });
    <?php
      // get js and jquery code for validating delete modal form, matching entered menu name to the menu name user is trying to delete
      if(isset($current_subject)){modal_confirm_delete($current_subject["menu_name"]);}
      elseif (isset($current_page)) {modal_confirm_delete($current_page["menu_name"]);}
    ?>
  </script>

</body>
</html>
