<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>

<?php enforce_login(); ?>
 
<?php 
$first_name = find_admin_first_name($_SESSION["admin_id"]);
$first_name = $first_name["first_name"]; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Administrator</title>
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>
  <?php include '../includes/layout/header.php'; ?>

  <main>
    <div class="container">
      <section class="section">

        <h2>Administrator Dashboard</h2>

        <div class="row">

          <div class="col s12 m4">
            <div class="card blue-grey darken-1">
              <div class="card-content white-text">
                <span class="card-title">Welcome, <?= htmlentities($first_name); ?></span>
                <p>This is your dashboard. Here you can manage content on your website or edit permissions for other admins that you have created.</p>
              </div>
              <div class="card-action">
                <a href="#">Account Settings</a>
                <a href="logout.php">Log Out</a>
              </div>
            </div>
          </div>

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
                <a href="manage_admins.php">Manage Administrators</a>
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

  <script>
    $(document).ready(function () {
      <?php toast_message(); ?>
    });
  </script>

</body>
</html>
