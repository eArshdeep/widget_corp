<!DOCTYPE html>
<html lang="en">
<head>
  <title>Administrators</title>
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>
  <?php include '../includes/layout/header.php'; ?>

  <main>
    <div class="row">
      <!-- NAV SECTION -->
      <section class="col s12 m4">

      </section>

      <!-- MAIN SECTION -->
      <section class="col s12 m8">
        <div class="container">
          <h2>Administrator Menu</h2>
          <p>Welcome to the administrator area.</p>

          <ul>
            <li><a href="manage_content.php">Manage Website Content</a></li>
            <li><a href="manage_admins.php">Manage Administrators</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
      </section>

    </div>
  </main>

  <?php include '../includes/layout/footer.php'; include '../includes/layout/meta_body.php';?>
</body>
</html>
