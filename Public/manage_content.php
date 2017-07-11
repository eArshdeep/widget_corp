<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php include '../includes/find_current_menu.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage</title>
  <!-- Import meta for head -->
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>

  <!-- Import header and top nav -->
  <?php generate_header(); ?>

  <main>
    <div class="row">
        <!-- NAV SECTION -->
        <section class="col s12 m2">
          <?php include '../includes/layout/nav.php'; ?>
          <a href="new_subject.php">+ Add a new Subject</a>
        </section>

      <!-- MAIN SECTION -->
      <section class="col s12 m10">
        <div class="container">
          <?php

            // get verbal value for visiblity
            if($current_subject["visible"]==1){
              $shown = "Shown";
            } elseif($current_subject["visible"]==0){
              $shown = "Hidden";
            }

            if(isset($current_subject)) { // close php tags to use html inside if condition  ?>
              <!-- title -->
              <h2>Subject Overview</h2>
              <!-- menu name -->
              <p class='menu_name'>Menu Name: </p>
              <p class='inline'> <?php echo $current_subject["menu_name"]; ?> </p>
              <!-- position -->
              <p> <span class='bold'>Position:</span> <?php echo $current_subject["position"]; ?> <p>
              <!-- visibility -->
              <p> <span class='bold'>Status:</span> <?php echo $shown; ?> <p>
              <!-- break after subject properties section -->
              <br>
              <!-- edit button -->
              <a href="edit_subject.php?subject=<?php echo $current_subject["id"]; ?>" class="waves-effect waves-light btn">
                <i class='material-icons left'>mode_edit</i> Edit </a>
              <!-- delete button -->
              <a class="waves-effect waves-light btn" href="#delete_modal">
                <i class='material-icons left'>delete</i> Delete </a>
              <?php /*Include structure for deletion modal*/ include '../includes/layout/delete_modal.php'; ?>

            <?php } // open up php tag and close if condition for the rest of the php code after html has been output
            elseif (isset($current_page)){
              echo "<h2>Page Overview</h1>";
              echo "<p class='menu_name'>Page Name: </p>";
              echo $current_page["menu_name"];
            }
            else {
              echo "<p>Please select a page or subject to manage or modify.</p>";
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
    });
    <?php
      // get js and jquery code for validating delete modal form, matching entered menu name to the menu name user is trying to delete
      if(isset($current_subject)){modal_confirm_delete($current_subject["menu_name"]);}
      elseif (isset($current_page)) {modal_confirm_delete($current_page["menu_name"]);}
    ?>
  </script>

</body>
</html>
