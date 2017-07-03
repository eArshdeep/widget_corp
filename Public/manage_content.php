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

            if(isset($current_subject)){
              // title
              $output = "<h2>Subject Overview</h2>";
              // menu name              
              $output .= "<p class='menu_name'>Menu Name: </p>";
              $output .= "<p class='inline'> {$current_subject["menu_name"]} </p>";
              // position
              $output .= "<p><span class='bold'>Position:</span> {$current_subject["position"]}<p>";
              // visibility
              $output .= "<p><span class='bold'>Status:</span> {$shown}<p>";
              // edit button
              $output .= "<br>"; // break after menu name echo
              $output .= "<a href='edit_subject.php?subject={$current_subject["id"]}' class='margin-adder waves-effect waves-light btn'>";
              $output .= "<i class='material-icons right'>mode_edit</i>";
              $output .= "Edit Subject</a>";
              // echo and unset
              echo $output;
              unset($output);
            }
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
    });
  </script>

</body>
</html>
