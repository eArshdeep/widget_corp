<?php $subject_set = find_all_subjects(); ?>

<ul class="collapsible" data-collapsible="accordion"> <!-- Structure for main accordion -->
  <?php while ($subject = mysqli_fetch_assoc($subject_set)) { /* OPEN while loop for subject_set */ ?>
    <li>
      <div class="collapsible-header"> <i class="material-icons" > library_books </i> <?php echo htmlentities($subject["menu_name"]); ?> </div>
      <!-- Content section for subject accordian -->
      <div class="collapsible-body">
        <?php $page_set = find_pages_for_subject($subject["id"]); /* Get pages for current subject */
          // if current subject has no pages
          if (mysqli_num_rows($page_set) == 0) {
            echo "The current subject has no pages yet.";
          } else { /* execture else statment to output raw html for page_set accordian only if pages exist */ ?>
        <ul class="collapsible" data-collapsible="accordion"> <!-- Structure for page accordion -->
            <?php while ($page = mysqli_fetch_assoc($page_set)) { /* Iterate through page set */ ?>
            <li>
              <div class="collapsible-header"> <i class="material-icons"> subject </i> <?php echo htmlentities($page["menu_name"]); ?> </div>
              <div class="collapsible-body"> <?php echo htmlentities($page["content"]); ?> </div>
            </li>
          <?php } /* End iteration for page_set */ ?>
        </ul> <!-- End structure for page accordion -->
        <?php } /* end else statment for 'if (mysqli_num_rows($page_set) == 0)' */ ?>
      </div>
    </li>
  <?php } /* END while loop for subject_set */ ?>
</ul> <!-- End of structure for main accordion -->
