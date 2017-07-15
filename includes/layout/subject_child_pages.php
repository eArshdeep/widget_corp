<?php // show subject's child pages if any
  $page_set = find_pages_for_subject($current_subject["id"]);

  if(mysqli_num_rows($page_set) > 0){
    // border
    echo "<div class=\"divider\" > </div>";
    // title
    echo "<h3>Pages</h3>";
    // unordered list
    echo "<ul>";
    // loop through mysqli result
    while ($page = mysqli_fetch_assoc($page_set)){
/* Close PHP tags for raw HTML */ ?>

<li class="make_list">
  <a href="manage_content.php?page=<?php echo $page["id"]; ?>">
    <?php echo $page["menu_name"]; ?>
  </a>
</li>

<?php
  } // end while ($page = mysqli_fetch_assoc($page_set))
  echo "</ul>";
  } /* end if(mysqli_num_rows($page_set) > 0) */
?>
