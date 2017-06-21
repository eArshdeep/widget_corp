<!-- Import database connection and universal functions -->
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage</title>
  <!-- Import meta for head -->
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>

  <!-- Import header and top nav -->
  <?php include '../includes/layout/header.php'; ?>

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
          <h2>
            <!-- Output "Edit Page" or "Edit Subject" -->
            <?php
              if(isset($selected_subject_id)){echo "Edit Subject"; }
              elseif(isset($selected_page_id)){echo "Edit Page"; }
              else{echo "Please select a page or subject to edit";}
            ?>
          </h2>

          <!-- If Subject is set, prepare manage section -->
          <?php
            if(isset($selected_subject_id)){
              $subject = find_subject_by_id($selected_subject_id);
              echo "<p class='menu_name'>Menu Name: </p>";
              echo $subject["menu_name"];
            }
          ?>

          <!-- If Page is set, prepare manage section  -->
          <?php
            if(isset($selected_page_id)){
              $page = find_page_by_id($selected_page_id);
              echo "<p class='menu_name'>Page Name: </p>";
              echo $page["menu_name"];
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

</body>
</html>
