<!-- Import database connection and universal functions -->
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
          <?php
            if(isset($current_subject)){
              echo "<h2>Edit Subject</h1>";
              echo "<p class='menu_name'>Menu Name: </p>";
              echo $current_subject["menu_name"];
            }
            elseif (isset($current_page)){
              echo "<h2>Edit Page</h1>";
              echo "<p class='menu_name'>Page Name: </p>";
              echo $current_page["menu_name"];
            }
            else {
              echo "<p>Please select a page or subject to modify.</p>";
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
