<!-- title -->
<h2>Subject Overview</h2>

<!-- menu name -->
<p class='bold'>Menu Name:
  <span class="normal"><?php echo htmlentities($current_subject["menu_name"]); ?></span>
</p>

<!-- position -->
<p> <span class='bold'>Position:</span> <?php echo $current_subject["position"]; ?> <p>

<!-- visibility -->
<p>
  <span class='bold'>Status:</span> <?php echo $current_subject["visible"] == 1 ? "Shown" : "Hidden"; ?>
<p>

<!-- break after subject properties section -->
<br>

<!-- edit button -->
<a href="edit_subject.php?subject=<?php echo urlencode($current_subject["id"]); ?>" class="subject_overview_buttons waves-effect waves-light btn">
  <i class='material-icons left'>mode_edit</i> Edit
</a>

<!-- delete button -->
<a class="subject_overview_buttons waves-effect waves-light btn" href="#delete_modal">
  <i class='material-icons left'>delete</i> Delete
</a>

<!-- new page button -->
<a href="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>" class="subject_overview_buttons waves-effect waves-light btn"> &plus; Add Page </a>

<?php /*Include structure for deletion modal*/ include '../includes/layout/delete_modal.php'; ?>
<?php /* Show subject's child pages if any*/ include '../includes/layout/subject_child_pages.php'; ?>
