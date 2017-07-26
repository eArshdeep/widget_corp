<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/validation.php'; ?>

<?php
	include '../includes/find_current_menu.php';
	// return user to manage_content.php with error if page is not found in db
	// this can either be becuase the page id is invalid or simply does not exist in db
	if(!isset($current_page)){
		redirect_to("manage_content.php");
	}
?>

<?php
  if(isset($_POST["submit"])){
		// handle values
		$id = (int) $current_page["id"];
		$menu_name = $_POST["menu_name"];
    $content = $_POST["content"];
		$position = (int) $_POST["position"];
    $subject_id = (int) $_POST["subject"];
		$visible = (int) $_POST["visible"];

		// escape
		$menu_name = mysqli_real_escape_string($db, $menu_name);
    $content = mysqli_real_escape_string($db, $content);

    // validate form values
    $required_fields = array("menu_name", "position", "visible", "content", "subject");
    validate_presences($required_fields);

    $fields_with_length_limit = array("menu_name" => 30);
    validate_max_lengths($fields_with_length_limit);

    if(empty($errors)){
	    // If no validation errors... Perform Update
			$query = "UPDATE pages SET menu_name = '{$menu_name}', position = {$position}, visible = {$visible}, content = '{$content}', subject_id = {$subject_id} WHERE id = {$id} LIMIT 1;";
			$result = mysqli_query($db, $query);

			if($result && mysqli_affected_rows($db) == 1){
				// if update is successful
				$_SESSION["message"] = "Page was updated successfully. Cheers :)";
				redirect_to("manage_content.php?page={$id}");
				}
			elseif($result && mysqli_affected_rows($db) == 0){
				// query was successful but no rows affected
				$_SESSION["message"] = "No changes were made, values were found to be identical =)";
				redirect_to("manage_content.php?page={$id}");
				}
			else {
				// if update is NOT successful
				$_SESSION["message"] = "Unable to edit page correctly. Bonkers!";
				}
			}
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Page</title>
  <?php include '../includes/layout/meta_head.php'; ?>
</head>
<body>
  <?php generate_header($display_content_nav=true); ?>

  <main>
    <div class="row">
        <!-- NAV SECTION -->
        <section class="col s12 m2">
          <?php include '../includes/layout/nav.php'; ?>
        </section>

      <!-- MAIN SECTION -->
      <section class="col s12 m10">
        <div class="container">
        	<!-- Title for page edit -->
        	<h2> Edit Page: <span class="light-weight"><?php echo htmlentities($current_page["menu_name"]); ?></span> </h2>
        	<!-- Form -->
        	<form action="edit_page.php?page=<?php echo $current_page["id"]; ?>" method="post">
        		<!-- Input: Menu name -->
        		<div class="input-field">
          		<input placeholder="Page name" id="menu_name" name="menu_name" type="text" value="<?php if(isset($menu_name)){echo htmlentities($menu_name);} else {echo htmlentities($current_page["menu_name"]);} ?>">
          		<label for="menu_name" <?php if(isset($errors["menu_name"])){echo "class='red-text'";} ?> >Page Name</label>
            </div>

            <!-- Input: Position -->
            <div class="input-field">
              <select name="position">
                <option value="" disabled>Select Position</option>
                  <?php
                    $page_set = find_pages_for_subject($current_page["subject_id"]);
                    $page_count = mysqli_num_rows($page_set);
                    for($count=1; $count <= $page_count; $count++){
                      $output = "<option ";
                      if (isset($position) && $position == $count) {
                        $output .= "selected ";
                      } elseif (!isset($position) && $current_page["position"] == $count) {
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
              <label>Page Position</label>
            </div>

            <!-- Input: Parent Subject -->
            <div class="input-field">
              <select name="subject">
                <option value="" disabled>Select Parent Subject</option>
                  <?php
                    $subject_set = find_all_subjects();
                    while ($this_subject = mysqli_fetch_assoc($subject_set)) {
                      $output = "<option ";
                      $output .= "value=";
                      $output .= "\"{$this_subject["id"]}\"";
                      if(isset($subject_id) && $subject_id == $this_subject["id"]){
                        $output .= " selected";
                      }
                      elseif (!isset($subject_id) && $current_page["subject_id"] == $this_subject["id"]){
                        $output .= " selected";
                      }
                      $output .= ">";
                      $output .= $this_subject["menu_name"];
                      $output .= "</option>";
                      echo $output;
                      unset($output);
                    }
                  ?>
              </select>
              <label>Parent Subject</label>
            </div>

	            <!-- Input: Visibility -->
							<!-- Title -->
           		<p>Visibility</p>
							<!-- Radio -->
							<input name="visible" type="radio" id="visible_true" value="1"
								<?php if(isset($visible) && $visible == 1){ echo "checked"; } elseif(!isset($visible) && $current_page["visible"]==1){echo "checked";} ?> />
							<!-- Label -->
							<label for="visible_true">Visible</label>
							<!-- Span -->
							<span class="side-margin-adder">or</span>
							<!-- Radio -->
							<input name="visible" type="radio" id="visible_hidden" value="0"
								<?php if(isset($visible) && $visible == 0){ echo "checked"; } elseif(!isset($visible) && $current_page["visible"]==0){echo "checked";} ?> />
							<!-- Label -->
							<label for="visible_hidden">Hidden</label>

              <!-- Content -->
              <div class="input-field margin-top-large-adder">
                <textarea name="content" id="content" class="materialize-textarea"><?php
                  if(isset($content)) { echo htmlentities($content); }
                  else { echo htmlentities($current_page["content"]); }
                ?></textarea>
                <label for="content">Page Content</label>
              </div>

            	<!-- Submit Button -->
            	<button class="block btn waves-effect waves-light margin-top-adder" type="submit" name="submit" value="true">Submit</button>

        	</form>

        	<!-- Cancel button -->
        	<a href="manage_content.php?page=<?php echo urlencode($current_page["id"]); ?>" class="orange-text">&#8592; Cancel</a>

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
				// mainly used for errors (such as validation) where error message is stored in session and toasted to indicate to user of failure
				<?php toast_message(); ?>
				$('#content').trigger('autoresize');
				$(".button-collapse").sideNav();
	  });
	</script>

</body>
</html>
