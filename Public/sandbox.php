<?php
<h2>
  <!-- Output "Edit Page" or "Edit Subject" -->
  <?php
    if(isset($current_subject)){echo "Edit Subject"; }
    elseif(isset($current_page)){echo "Edit Page"; }
    else{echo "Please select a page or subject to edit";}
  ?>
</h2>

<!-- If Subject is set, prepare manage section -->
<?php
  if(isset($current_subject)){
    echo "<p class='menu_name'>Menu Name: </p>";
    echo $current_subject["menu_name"];
  }
?>

<!-- If Page is set, prepare manage section  -->
<?php
  if(isset($current_page)){
    $page = find_page_by_id($selected_page_id);
    echo "<p class='menu_name'>Page Name: </p>";
    echo $current_page["menu_name"];
  }
?>
?>
