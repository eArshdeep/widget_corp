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
  <?php
    generate_header();
    $errors = grab_errors();
    // get the subject for which we are trying to add the page
    $parent_subject = find_subject_by_id($_GET["subject"]);
    // redirect if subject not found
    if(!isset($parent_subject)){
      $_SESSION["message"] = "Couldn\'t add a page for that subject, sorry.";
      redirect_to("manage_content.php");
    }
  ?>

  <main>
    <div class="row">
        <!-- NAV SECTION -->
        <section class="col s12 m2">
          <?php include '../includes/layout/nav.php'; ?>
        </section>

      <!-- MAIN SECTION -->
      <section class="col s12 m10">
        <div class="container">
          <div class="divider hide-on-large-only"></div>
          <!-- Title -->
          <h2>Add New Page for
            <span class="light-weight">
              <?php echo $parent_subject["menu_name"]; ?>
            </span>
          </h2>
          <!-- Form -->
          <form action="create_page.php" method="post">

            <!-- Input: menu name -->
            <div class="input-field">
              <input placeholder="Page Name" id="menu_name" name="menu_name" type="text" <?php repopulate_menu_name("repop_menu_name"); ?>>
              <label for="menu_name" <?php if(isset($errors["menu_name"])){echo "class='red-text'";} ?>>Page Name</label>
            </div>

            <!-- Input: Position -->
            <div class="input-field">
              <select name="position">
                <option value="" disabled <?php if(!isset($_SESSION["repop_position"])){echo "selected";} ?> >Select Position</option>
                  <?php
                  $page_set = find_pages_for_subject($parent_subject["id"]);
                  $page_count = mysqli_num_rows($page_set);
                  for($count=1; $count <=$page_count+1; $count++){
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
              <label <?php if(isset($errors["position"])){echo "class='red-text'";} ?>>Page Position</label>
            </div>

            <!-- Input: Visibility -->
            <p <?php if(isset($errors["visible"])){echo "class='red-text'";} ?>>Visibility</p>
            <input name="visible" type="radio" id="visible_true" value="1" <?php repopulate_visibility(1); ?> />
            <label for="visible_true">Visible</label>
            <span class="side-margin-adder">or</span>
            <input name="visible" type="radio" id="visible_hidden" value="0"<?php repopulate_visibility(0); ?> />
            <label for="visible_hidden">Hidden</label>

            <!-- Content -->
            <div class="input-field margin-top-large-adder">
              <textarea id="content" class="materialize-textarea" name="content"><?php
                if (isset($_SESSION["repop_content"])) {
                  echo htmlentities($_SESSION["repop_content"]);
                  $_SESSION["repop_content"]=null;
                } ?></textarea>
              <label for="content" <?php if(isset($errors["content"])){echo "class='red-text'";} ?> >Content</label>
            </div>

            <!-- Subject ID -->
            <input type="hidden" name="subject_id" value="<?php echo htmlentities($parent_subject["id"]); ?>" >

            <!-- Submit Button -->
            <button style="display:block;" class="btn waves-effect waves-light margin-top-adder" type="submit" name="submit" value="true">Create</button>

          </form>
          <a href="manage_content.php?subject=<?php echo urlencode($parent_subject["id"]); ?>" class="orange-text">&#8592; Cancel</a>

          <section>
            <?php echo_errors($errors); ?>
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
    mysqli_free_result($page_set);
  ?>
</body>
</html>
