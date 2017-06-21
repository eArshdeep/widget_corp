<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Widget Corp</title>
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>
  <?php include '../includes/layout/header.php'; ?>

  <main>
    <div class="row">
        <!-- NAV SECTION -->
        <section class="col s12 m2">
          <?php include '../includes/layout/nav.php'; ?>
        </section>

      <!-- MAIN SECTION -->
      <section class="col s12 m10">
        <div class="container">
          <h2>Create New Subject</h2>
        </div>
      </section>
    </div>
  </main>

  <?php include '../includes/layout/footer.php'; include '../includes/layout/meta_body.php';?>
</body>
</html>
