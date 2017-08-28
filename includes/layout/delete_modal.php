<?php
  // get needed values
  // get type (e.g. page or subject)
  // and handle of current value weather page or subject assoc array for easy handle
  if(isset($current_subject)){
    $type = "Subject";
    $current = $current_subject;
  } elseif (isset($current_page)){
    $type = "Page";
    $current = $current_page;
  }
?>

<!-- Modal Structure for Deletion of Subject or Page-->
<div id="delete_modal" class="modal">
  <div class="modal-content container">
    <!-- Title -->
    <h4>Delete <?php echo $type; ?>?</h4>
    <!-- Body -->
    <p>Are you sure you want to delete the current <?php echo strtolower($type); ?>?</p>
    <!-- Conditional code, bits of warning relating to subjects are only shown if and when deleting a subject -->
    <p>There is no way to undo this action<?php echo $type == "Subject" ? ", and any subjects deleted that still have any pages will also be deleted." : "."; ?>
    </p>
    <p>If you wish to proceed, please type the name of the <?php echo strtolower($type); ?> below to confirm.</p>
    <div class="divider"></div>
    <!-- Name to enter -->
    <p class="hamburger_border bold inline_block"> <?php echo htmlentities($current["menu_name"]); ?> </p>
    <!-- Form for delete confirmation -->
    <form action="<?php if($type==="Subject"){echo "delete_subject.php";} elseif ($type==="Page"){echo "delete_page.php";} ?>" id="confirmation_form" method="post">
      <div class="input-field">
        <!-- Input field for menu name confirmation -->
        <input placeholder="<?php echo htmlentities($current["menu_name"]); ?>" id="confirm_menu_name" type="text">
        <label for="menu_name"><?php echo $type; ?> Name</label>
      </div>
      <!-- Hidden POST value for id of subject or page to delete -->
      <input type="hidden" name="<?php echo strtolower($type) . "_id"; ?>" value="<?php echo $current["id"]; ?>">
    </form>
  </div>
  <div class="modal-footer">
    <a class="modal-action modal-close waves-effect waves-green btn-flat">Nevermind</a>
    <input form="confirmation_form" name="submit" value="Delete" type="submit" class="disabled modal-action modal-close waves-effect waves-red btn-flat">
  </div>
</div>

<?php
  // function for outputing javascript and jquery for validating delete modal form, typing in and confirming menu name for the subject you wish to delete will allow you to click delete to delete
  function modal_confirm_delete($menu_name){
    $output = "var target_menu_name = \"{$menu_name}\";";
    $output .= "$(\"#confirm_menu_name\").on(\"change paste keyup\", function() {";
    $output .= "if($(this).val().toLowerCase()==target_menu_name.toLowerCase()) {";
    $output .= "$(\".waves-red\").removeClass(\"disabled\");";
    $output .= "} else {";
    $output .= "$(\".waves-red\").addClass(\"disabled\");";
    $output .= "}";
    $output .= "});";
    echo $output;
  }
?>

<?php
  // clean up variables
  unset($type);
  unset($current);
?>
