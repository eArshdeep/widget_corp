<?php require_once '../includes/functions.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Administrators</title>
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>
  <?php generate_header(); ?>

  <main>
    <div class="container">
      <section class="section">
        <div class="row">
          <h2>Manage Administrators</h2>

          <div class="col s12 m4">
            <div class="card blue-grey darken-1">
              <div class="card-content white-text">
                <span class="card-title">Bob Sway</span>
                <p>Email: bsway@wcorp.com</p>
              </div>
              <div class="card-action">
                <a href="#">Edit</a>
                <a href="#">Delete</a>
              </div>
            </div>
          </div>

          <div class="col s12 m4">
            <div class="card blue-grey darken-1">
              <div class="card-content white-text">
                <span class="card-title">Jamie Manner</span>
                <p>Email: jmann@wcorp.com</p>
              </div>
              <div class="card-action">
                <a href="#">Edit</a>
                <a href="#">Delete</a>
              </div>
            </div>
          </div>

        </div>
      </section>
    </div>
  </main>

  <div class="fixed-action-btn">
    <a class="btn-floating btn-large orange" href="new_admin.php">
      <i class="large material-icons">mode_edit</i>
    </a>
  </div>

  <?php include '../includes/layout/footer.php'; ?>
  <?php include '../includes/layout/meta_body.php'; ?>

</body>
</html>
