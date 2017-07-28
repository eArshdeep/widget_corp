<?php require_once '../includes/functions.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Administrators</title>
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>
  <?php generate_header(); ?>

  <main>
    <div class="container">
      <section class="section">

        <h2>Administrator Menu</h2>

        <div class="row">

          <div class="col s12 m4">
            <div class="card blue-grey darken-1">
              <div class="card-content white-text">
                <span class="card-title">Manage Content</span>
                <p>View, modify, update or delete content across the site.</p>
              </div>
              <div class="card-action">
                <a href="manage_content.php">Manage Content</a>
              </div>
            </div>
          </div>

          <div class="col s12 m4">
            <div class="card blue-grey darken-1">
              <div class="card-content white-text">
                <span class="card-title">Manage Administrators</span>
                <p>Manage site admins from creating new admins to removing legacy moderators.</p>
              </div>
              <div class="card-action">
                <a href="#">Manage Administrators</a>
              </div>
            </div>
          </div>

          <div class="col s12 m4">
            <div class="card blue-grey darken-1">
              <div class="card-content">
                <span class="card-title"><a class="white-text bold" href="#">Log Out</a></span>
              </div>
            </div>
          </div>

        </div>
      </section>
    </div>
  </main>

  <?php include '../includes/layout/footer.php'; ?>
  <?php include '../includes/layout/meta_body.php'; ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>

  <script>
  $('.card-title').matchHeight({ byRow:false });
  $('.card-content').matchHeight({ byRow:false });
  $('.card-action').matchHeight({ byRow:false });
  </script>

</body>
</html>
