<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>

<?php
  $context = array(
    "show_link_to_login" => true
  );
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Widget Corp</title>
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>

<?php include '../includes/layout/header.php'; ?>

<main>
  <div class="container">
    <?php include '../includes/layout/public_nav.php'; ?>
  </div>
</main>

<?php include '../includes/layout/footer.php';?>
<?php include '../includes/layout/meta_body.php'; ?>

<script>
	$(document).ready(function() {
		// initialize materialize mobile navigation
		$(".button-collapse").sideNav();
	});
</script>

</body>
</html>
