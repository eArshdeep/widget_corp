<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
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
    <div class="row">
        <!-- NAV SECTION -->
        <section class="col s12 m2">
          <?php include '../includes/layout/nav.php'; ?>
        </section>

      <!-- MAIN SECTION -->
      <section class="col s12 m10">
        <div class="container">
          <div class="divider"></div>
          <h2>Create New Subject</h2>
          <form action="create_subject.php" method="post">
            <!-- Input: menu name -->
            <div class="input-field">
              <input placeholder="Menu name" id="menu_name" name="menu_name" type="text" <?php repopulate_name("repop_menu_name"); ?>>
              <label for="menu_name">Menu Name</label>
            </div>
            <!-- Input: Position -->
            <div class="input-field">
              <select name="position">
                <option value="" disabled <?php if(!isset($_SESSION["repop_position"])){echo "selected"; $_SESSION["repop_position"]=null;} ?> >Select Position</option>
                  <?php
                  $subject_set = find_all_subjects();
                  $subject_count = mysqli_num_rows($subject_set);
                  for($count=1; $count <=$subject_count+1; $count++){
                    $output = "<option ";
                    if(isset($_SESSION["repop_position"]) && $_SESSION["repop_position"] === $count){
                      $output .= "selected ";
                      $_SESSION["repop_position"] = null;
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
              <input name="visible" type="radio" id="visible_true" value="1"/>
              <label for="visible_true">Visible</label>
              <span class="side-margin-adder">or</span>
              <input name="visible" type="radio" id="visible_hidden" value="0"/>
              <label for="visible_hidden">Hidden</label>
            <!-- Submit Button -->
            <button style="display:block;" class="btn waves-effect waves-light margin-adder" type="submit" name="submit" value="true">Create</button>
          </form>
          <a href="manage_content.php" class="orange-text">&#8592; Cancel</a>

          <section>
            <?php
              $errors = grab_errors();
              echo_errors($errors);
            ?>
          </section>
        </div>
      </section>
    </div>
  </main>

  <?php include '../includes/layout/footer.php'; include '../includes/layout/meta_body.php';?>
  <script type="text/javascript">
    $(document).ready(function() {
      // initialize html select forms
      $('select').material_select();
      <?php toast_message(); ?>
    });
  </script>

  <?php
    // release db resources and handles
    mysqli_close($db);
    mysqli_free_result($subject_set);
  ?>
</body>
</html>
