<?php /*
  This module expects that whereever this module is used, that 'functions.php' and 'db_connection.php' are also included
*/ ?>

<?php include '../includes/find_current_menu.php'; ?>
<?php $subject_set = find_all_subjects(); ?>

<ul class="subjects">

    <?php while ($subject = mysqli_fetch_assoc($subject_set)) { ?>

      <?php /*grab all pages for current subject*/ $page_set = find_pages_for_subject($subject["id"]); ?>

      <li <?php if($subject["id"]===$current_subject["id"]){echo "class='selected'";} ?>>
        <a href="manage_content.php?subject=<?php echo urlencode($subject['id']); ?>">
        <?php echo $subject["menu_name"]; ?></a>

        <ul class="pages">
          <?php while ($page = mysqli_fetch_assoc($page_set)) { ?>

            <li class="make_list <?php if($page["id"]===$current_page["id"]){echo "selected";} ?>"><a href="manage_content.php?page=<?php echo urlencode($page['id']); ?>"><?php echo $page["menu_name"]; ?></a></li>

          <?php } // close page_set while loop ?>
        </ul>
      </li>

    <?php } // close subject_set while loop ?>

  </ul>
