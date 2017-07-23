<?php require_once '../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Widget Corp</title>
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>
  <?php generate_header(); ?>

  <main>
    <div class="container">
      <div class="row">
        <div class="col s12 m6 offset-m3">
          <div class="card">
            <div class="card-image">
              <img src="./images/under_construction.jpg">
            </div>
            <div class="card-content">
              <h2>Site Under Construction!</h2>
              <p>The talented engineers over at Widget Corp are still happily designing me! Be up for business in a few!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include '../includes/layout/footer.php'; include '../includes/layout/meta_body.php';?>
  <script type="text/javascript">
    $( document ).ready(function(){
      // initialize side nav
      $(".button-collapse").sideNav();
    })
  </script>
</body>
</html>
