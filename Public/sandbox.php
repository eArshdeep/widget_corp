<!-- Mobile Navigation Hamburger -->
<a href="#" data-activates="mobile-demo" class="button-collapse hide-on-med-and-up"><i class="material-icons">menu</i></a>
<!-- Desktop Subject and Page Navigation -->
<ul style="width:200px; margin-top:65px;" class="side-nav fixed hide-on-med-and-down">
  <li>
    <a href="">Subject</a>
    <ul>
      <li><a href="">Page</a></li>
      <li><a href="">Page</a></li>
    </ul>
  </li>
  <li>
    <a href="">Subject</a>
    <ul>
      <li><a href="">Page</a></li>
      <li><a href="">Page</a></li>
    </ul>
  </li>
</ul>
<!-- Mobile Subject and Page Navigation -->
<ul class="side-nav" id="mobile-demo">
  <li>
    <a href="">Subject</a>
    <ul>
      <li><a href="">Page</a></li>
      <li><a href="">Page</a></li>
    </ul>
  </li>
  <li>
    <a href="">Subject</a>
    <ul>
      <li><a href="">Page</a></li>
      <li><a href="">Page</a></li>
    </ul>
  </li>
</ul>

<!-- //////////////////////////////////////////////////////////////////////////////////// -->

<ul class="subjects">

    <?php while ($subject = mysqli_fetch_assoc($subject_set)) { ?>

      <?php /*grab all pages for current subject*/ $page_set = find_pages_for_subject($subject["id"]); ?>

      <li <?php if($subject["id"]===$current_subject["id"]){echo "class='selected'";} ?>>
        <a href="manage_content.php?subject=<?php echo urlencode($subject['id']); ?>">
        <?php echo htmlentities($subject["menu_name"]); ?></a>

        <ul class="pages">
          <?php while ($page = mysqli_fetch_assoc($page_set)) { ?>

            <li class="make_list <?php if($page["id"]===$current_page["id"]){echo "selected";} ?>"><a href="manage_content.php?page=<?php echo urlencode($page['id']); ?>"><?php echo htmlentities($page["menu_name"]); ?></a></li>

          <?php } // close page_set while loop ?>
        </ul>
      </li>

    <?php } // close subject_set while loop ?>

</ul>
