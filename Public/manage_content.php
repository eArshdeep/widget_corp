<!-- Import database connection and universal functions -->
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>

<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?>

<?php
  // gets and sets values for what subject or page to edit in edit section
  $selected_subject_id = null;
  $selected_page_id = null;
  if(isset($_GET["subject"])){
    $selected_subject_id = $_GET["subject"];
  } elseif (isset($_GET["page"])) {
    $selected_page_id = $_GET["page"];
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage</title>
  <!-- Import meta for head -->
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>

  <?php
    // Make db call to get all visbile subjects
    $subject_set = find_all_subjects();
  ?>

  <!-- Import header and top nav -->
  <?php include '../includes/layout/header.php'; ?>

  <main>
    <div class="row">
      <!-- NAV SECTION -->
      <?php include '../includes/layout/nav.php'; ?>

      <!-- MAIN SECTION -->
      <section class="col s12 m8">
        <div class="container">
          <h2>
            <?php
              if(isset($selected_subject_id)){echo "Edit Subject"; }
              elseif(isset($selected_page_id)){echo "Edit Page"; }
              else{echo "Please select a page or subject to edit";}
            ?>
          </h2>

          <?php
            if(isset($selected_subject_id)){
              $subject = find_subject_by_id($selected_subject_id);
              echo "<p class='menu_name'>Menu Name: </p>";
              echo $subject["menu_name"];
            }
          ?>

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
