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
          <a href="admin.php" class="back-to-dashboard-link">&laquo Dashboard</a>
          <?php include '../includes/layout/nav.php'; ?>
          <a href="new_subject.php">+ Add a new Subject</a>
        </section>

      <!-- MAIN SECTION -->
      <section class="col s12 m10">
        <div class="container">
          <?php
            // SUBJECT OVERVIEW
            if(isset($current_subject)) { /* close php tags for raw html */ ?>

              <!-- title -->
              <h2>Subject Overview</h2>
              <!-- menu name -->
              <p class='bold'>Menu Name:
                <span class="normal"><?php echo htmlentities($current_subject["menu_name"]); ?></span>
              </p>
              <!-- position -->
              <p> <span class='bold'>Position:</span> <?php echo $current_subject["position"]; ?> <p>
              <!-- visibility -->
              <p> <span class='bold'>Status:</span> <?php echo $current_subject["visible"] == 1 ? "Shown" : "Hidden"; ?> <p>
              <!-- break after subject properties section -->
              <br>
              <!-- edit button -->
              <a href="edit_subject.php?subject=<?php echo urlencode($current_subject["id"]); ?>" class="waves-effect waves-light btn">
                <i class='material-icons left'>mode_edit</i> Edit </a>
              <!-- delete button -->
              <a class="waves-effect waves-light btn" href="#delete_modal">
                <i class='material-icons left'>delete</i> Delete </a>
              <?php /*Include structure for deletion modal*/ include '../includes/layout/delete_modal.php'; ?>

              <?php /* Show subject's child pages if any*/ include '../includes/layout/subject_child_pages.php'; ?>

          <?php  } /* end of if(isset($current_subject)) */
            elseif (isset($current_page)){ /* end php tags for raw html */ ?>
              <?php
                // get parent subject
                $parent_subject = find_subject_by_id($current_page["subject_id"]);
              ?>
              <!-- Page Overview -->
              <!-- Title -->
              <h2>Page Overview</h2>

              <!-- Menu Name -->
              <p class="bold">Page Name:
                <span class="normal"><?php echo htmlentities($current_page["menu_name"]); ?></span>
              </p>

              <!-- Subject Name -->
              <p class="bold">Parent Subject:
                <a href="manage_content.php?subject=<?php echo urlencode($parent_subject["id"]); ?>" class="normal link_underline"><?php echo htmlentities($parent_subject["menu_name"]); ?></a>
              </p>

              <!-- position -->
              <p> <span class='bold'>Page Position:</span> <?php echo $current_page["position"]; ?> <p>

              <!-- visibility -->
              <p> <span class='bold'>Status:</span> <?php echo $current_page["visible"] == 1 ? "Shown" : "Hidden"; ?> <p>

              <!-- Content -->
              <div class="input-field margin-large-adder">
                <textarea disabled id="content" class="materialize-textarea"> <?php echo htmlentities($current_page["content"]); ?> </textarea>
                <label for="content">Content</label>
              </div>

              <!-- Links for delete and edit-->
              <!-- edit button -->
              <a href="edit_page.php?subject=<?php echo urlencode($current_page["id"]); ?>" class="waves-effect waves-light btn">
                <i class='material-icons left'>mode_edit</i> Edit </a>

              <!-- delete button -->
              <a class="waves-effect waves-light btn" href="#delete_modal">
                <i class='material-icons left'>delete</i> Delete </a>

              <?php /*Include structure for deletion modal*/ include '../includes/layout/delete_modal.php'; ?>

          <?php } // END elseif (isset($current_page))
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
