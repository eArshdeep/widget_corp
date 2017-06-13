<!-- Import database connection and universal functions -->
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage</title>
  <!-- Import meta for head -->
  <?php include '../includes/layout/meata_head.php'; ?>
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
      <section class="col s12 m4">
        <ul class="subjects">

          <?php while ($subject = mysqli_fetch_assoc($subject_set)) { ?>

            <?php /*grab all pages for current subject*/ $page_set = find_pages_for_subject($subject["id"]); ?>

            <li>
              <a href="manage_content.php?subject=<?php echo urlencode($subject['id']); ?>">
              <?php echo $subject["menu_name"]; ?></a>

              <ul class="pages">
                <?php while ($page = mysqli_fetch_assoc($page_set)) { ?>

                  <li><a href="manage_content.php?page=<?php echo urlencode($page['id']); ?>"><?php echo $page["menu_name"]; ?></a></li>

                <?php } // close page_set while loop ?>
              </ul>
            </li>

          <?php } // close subject_set while loop ?>

        </ul>
      </section>

      <!-- MAIN SECTION -->
      <section class="col s12 m8">
        <div class="container">
          <h2>Manage Content</h2>
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
