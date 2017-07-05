<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/validation.php'; ?>

<?php
	include '../includes/find_current_menu.php';
	// return user to manage_content.php with error if subject is not found in db
	// this can either be becuase the subject id is invalid or simply does not exist in db
	if(!isset($current_subject)){
		redirect_to("manage_content.php");
	}
?>

<?php
  if(isset($_POST["submit"])){

    // validate form values
    $required_fields = array("menu_name", "position", "visible");
    validate_presences($required_fields);

    $fields_with_length_limit = array("menu_name" => 30);
    validate_max_lengths($fields_with_length_limit);

    if(empty($errors)){
      // If no validation errors... Perform Update

			// handle values
			$id = (int) $current_subject["id"];
			$menu_name = $_POST["menu_name"];
			$position = (int) $_POST["position"];
			$visible = (int) $_POST["visible"];

			// escape
	    $menu_name = mysqli_real_escape_string($db, $menu_name);

			// build query
			$query = "UPDATE subjects SET menu_name = '{$menu_name}', position = {$position}, visible = {$visible} WHERE id = {$id} LIMIT 1;";
			$result = mysqli_query($db, $query);

			if($result && mysqli_affected_rows($db) == 1){
				// if update is successful
				$_SESSION["message"] = "Subject updated successfully. Cheers :)";
				redirect_to("manage_content.php?subject={$id}");
			} else {
				// if update is NOT successful
				$_SESSION["message"] = "Unable to update subject correctly. Bonkers!";
			}
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Widget Corp</title>
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>
  <?php generate_header(); ?>

  <main>
    <div class="row">
        <!-- NAV SECTION -->
        <section class="col s12 m2">
          <?php include '../includes/layout/nav.php'; ?>
        </section>

      <!-- MAIN SECTION -->
      <section class="col s12 m10">
        <div class="container">
        	<!-- Menu name -->
        	<h2> Edit Subject: <span class="normal"><?php echo $current_subject["menu_name"]; ?></span> </h2>
        	<!-- Form -->
        	<form action="edit_subject.php?subject=<?php echo $current_subject["id"]; ?>" method="post">
        		<!-- Input: Menu name -->
        		<div class="input-field">
              		<input placeholder="Menu name" id="menu_name" name="menu_name" type="text" value="<?php echo $current_subject["menu_name"]; ?>">
              		<label for="menu_name">Menu Name</label>
            	</div>

            	<!-- Input: Position -->
	            <div class="input-field">
	              <select name="position">
	                <option value="" disabled>Select Position</option>
	                  <?php
		                  $subject_set = find_all_subjects();
		                  $subject_count = mysqli_num_rows($subject_set);
		                  for($count=1; $count <= $subject_count; $count++){
		                    $output = "<option ";
		                    if($current_subject["position"]==$count){
		                    	$output .= "selected ";
		                    }
		                    $output .= "value=\"{$count}\">";
		                    $output .= $count;
		                    $output .= "</option>";
		                    echo $output;
		                    unset($output);
		                  }
	                  ?>
	              </select>
	              <label>Position</label>
	            </div>

	            <!-- Input: Visibility -->
           		 <p>Visibility</p>
              	<input name="visible" type="radio" id="visible_true" value="1" <?php if($current_subject["visible"]==1){echo "checked";} ?> />
              	<label for="visible_true">Visible</label>
              	<span class="side-margin-adder">or</span>
             	<input name="visible" type="radio" id="visible_hidden" value="0" <?php if($current_subject["visible"]==0){echo "checked";} ?> />
              	<label for="visible_hidden">Hidden</label>

            	<!-- Submit Button -->
            	<button class="block btn waves-effect waves-light margin-adder" type="submit" name="submit" value="true">Submit</button>

        	</form>

        	<!-- Cancel button -->
        	<a href="manage_content.php?subject=<?php echo $current_subject["id"]; ?>" class="orange-text">&#8592; Cancel</a>

					<section>
						<?php echo_errors($errors); ?>
					</section>

        </div>
      </section>

    </div>
  </main>

  <?php include '../includes/layout/footer.php'; ?>
	<?php include '../includes/layout/meta_body.php'; ?>
  <script type="text/javascript">
	 	$(document).ready(function() {
	    	$('select').material_select();
				<?php toast_message(); ?>
	  });
	</script>

</body>
</html>
