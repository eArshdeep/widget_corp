<!-- PAGE OVERVIEW -->
<?php
  // get parent subject
  $parent_subject = find_subject_by_id($current_page["subject_id"]);
?>
<!-- Title -->
<h2>Page Overview</h2>

<!-- Menu Name -->
<p class="bold">Page Name:
  <span class="normal"><?php echo htmlentities($current_page["menu_name"]); ?></span>
</p>

<!-- Subject Name -->
<p class="bold">Parent Subject:
  <a href="manage_content.php?subject=<?php echo urlencode($parent_subject["id"]); ?>" class="normal link_underline"><?php echo htmlentities($parent_subject["menu_name"]); ?></a>
</p>

<!-- position -->
<p> <span class='bold'>Page Position:</span> <?php echo $current_page["position"]; ?> <p>

<!-- visibility -->
<p> <span class='bold'>Status:</span> <?php echo $current_page["visible"] == 1 ? "Shown" : "Hidden"; ?> <p>

<!-- Content -->
<div class="input-field margin-top-large-adder">
  <textarea disabled id="content" class="truncate materialize-textarea"> <?php echo htmlentities($current_page["content"]); ?> </textarea>
  <label for="content">Content</label>
</div>

<!-- Links for delete and edit-->
<!-- edit button -->
<a href="edit_page.php?page=<?php echo urlencode($current_page["id"]); ?>" class="waves-effect waves-light btn">
  <i class='material-icons left'>mode_edit</i> Edit </a>

<!-- delete button -->
<a class="waves-effect waves-light btn" href="#delete_modal">
  <i class='material-icons left'>delete</i> Delete </a>

<?php /*Include structure for deletion modal*/ include '../includes/layout/delete_modal.php'; ?>
