<?php include '../includes/find_current_menu.php'; ?>
<?php $subject_set = find_all_subjects(); ?>

<!-- Mobile Navigation Hamburger -->
<a href="#" data-activates="content_mobile_nav" class="button-collapse hide-on-med-and-up">
  <i class="material-icons">menu</i>
</a>

<!-- Desktop Subject and Page Navigation -->
<ul class="side-nav fixed hide-on-med-and-down desktop-nav-position">
  <?php /* Iterate through subject set */ while ($subject = mysqli_fetch_assoc($subject_set)) {?>
  <?php /* Get page set for current subject*/ $page_set = find_pages_for_subject($subject["id"]); ?>

  <!-- List item for each subject -->
  <li>
    <!-- Subject Name -->
    <a href="manage_content.php?subject=<?php echo urlencode($subject['id']); ?>" >
      <?php echo htmlentities($subject["menu_name"]); ?>
    </a>
    <!-- Unordered List for Subject's Pages -->
    <ul>
      <?php while ($page = mysqli_fetch_assoc($page_set)) { ?>
        <li>
          <a href="manage_content.php?page=<?php echo urlencode($page['id']); ?>">
            <?php echo htmlentities($page["menu_name"]); ?>
          </a>
        </li>
        <?php } // close page_set while loop ?>
    </ul> <!-- End Unordered List for pages -->
  </li> <!-- End List item for subjects -->
  <?php } // close subject_set while loop ?>
</ul>  <!-- End Unordered list for subjects-->

<?php
// reset mysql data pointer
mysqli_data_seek($subject_set, 0);
?>

<!-- Mobile Subject and Page Navigation -->
<ul class="side-nav" id="content_mobile_nav">
  <?php /* Iterate through subject set */ while ($subject = mysqli_fetch_assoc($subject_set)) {?>
  <?php /* Get page set for current subject*/ $page_set = find_pages_for_subject($subject["id"]); ?>
  <!-- List item for each subject -->
  <li>
    <!-- Subject Name -->
    <a href="manage_content.php?subject=<?php echo urlencode($subject['id']); ?>" >
      <?php echo htmlentities($subject["menu_name"]); ?>
    </a>

    <ul>
      <?php while ($page = mysqli_fetch_assoc($page_set)) { ?>
        <li>
          <a href="manage_content.php?page=<?php echo urlencode($page['id']); ?>">
            <?php echo htmlentities($page["menu_name"]); ?>
          </a>
        </li>
        <?php } // close page_set while loop ?>
    </ul>
  </li>
  <?php } // close subject_set while loop ?>
</ul>
