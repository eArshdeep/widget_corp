<?php include '../includes/find_current_menu.php'; ?>
<?php $subject_set = find_all_subjects($context_public = false); ?>

<!-- Desktop Subject and Page Navigation -->
<ul class="side-nav fixed show-on-medium-and-up desktop-nav-position">

  <!-- Back to dashboard link -->
  <li>
    <a href="admin.php">
      <i class="material-icons">arrow_back</i> Dashboard
    </a>
  </li>

  <!-- Log out -->
  <li>
    <a href="logout.php">
      <i class="material-icons">exit_to_app</i> Log Out
    </a>
  </li>

  <div class="divider"></div>

  <?php /* Iterate through subject set */ while ($subject = mysqli_fetch_assoc($subject_set)) {?>
  <?php /* Get page set for current subject*/ $page_set = find_pages_for_subject($subject["id"], $context_public = false); ?>

  <!-- List item for each subject -->
  <li>
    <!-- Subject Name -->
    <a <?php if($subject["id"]===$current_subject["id"]) echo "class=\"orange lighten-4\""; ?> href="manage_content.php?subject=<?php echo urlencode($subject['id']); ?>" >
      <?php echo htmlentities($subject["menu_name"]) . ": " . htmlentities($subject["position"]); ?>
    </a>
    <!-- Unordered List for Subject's Pages -->
    <ul>
      <?php while ($page = mysqli_fetch_assoc($page_set)) { ?>
        <li>
          <a <?php if($page["id"]===$current_page["id"]) echo "class=\"orange lighten-4\""; ?> href="manage_content.php?page=<?php echo urlencode($page['id']); ?>">
            <?php echo htmlentities($page["menu_name"]) . ": " . htmlentities($page["position"]); ?>
          </a>
        </li>
        <?php } // close page_set while loop ?>
    </ul> <!-- End Unordered List for pages -->
  </li> <!-- End List item for subjects -->
  <?php } // close subject_set while loop ?>

  <?php
    // New Subject Button, only shows on ~/manage_content.php page
    if (basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']) == "manage_content.php") { ?>
      <!-- New Subject Button -->
      <li>
        <a href="new_subject.php">
          + Add a new Subject
        </a>
      </li>
  <?php } ?>

</ul>  <!-- End Unordered list for subjects-->

<?php
// reset mysql data pointer
mysqli_data_seek($subject_set, 0);
?>

<!-- Mobile Subject and Page Navigation -->
<ul class="side-nav" id="content_mobile_nav">

  <!-- Back to dashboard link -->
  <li>
    <a href="admin.php">
      <i class="material-icons">arrow_back</i> Dashboard
    </a>
  </li>

  <!-- Log out -->
  <li>
    <a href="logout.php">
      <i class="material-icons">exit_to_app</i> Log Out
    </a>
  </li>

  <div class="divider"></div>

  <?php /* Iterate through subject set */ while ($subject = mysqli_fetch_assoc($subject_set)) {?>
  <?php /* Get page set for current subject*/ $page_set = find_pages_for_subject($subject["id"]); ?>
  <!-- List item for each subject -->
  <li>
    <!-- Subject Name -->
    <a <?php if($subject["id"]===$current_subject["id"]) echo "class=\"orange lighten-4\""; ?> href="manage_content.php?subject=<?php echo urlencode($subject['id']); ?>" >
      <?php echo htmlentities($subject["menu_name"]); ?>
    </a>

    <ul>
      <?php while ($page = mysqli_fetch_assoc($page_set)) { ?>
        <li>
          <a <?php if($page["id"]===$current_page["id"]) echo "class=\"orange lighten-4\""; ?> href="manage_content.php?page=<?php echo urlencode($page['id']); ?>">
            <?php echo htmlentities($page["menu_name"]); ?>
          </a>
        </li>
        <?php } // close page_set while loop ?>
    </ul>
  </li>
  <?php } // close subject_set while loop ?>

  <?php
    // New Subject Button, only shows on ~/manage_content.php page
    if (basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']) == "manage_content.php") { ?>
      <!-- New Subject Button -->
      <li>
        <a href="new_subject.php">
          + Add a new Subject
        </a>
      </li>
  <?php } ?>

</ul>
