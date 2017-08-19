<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>

<?php $admin_set = gather_admins(); ?>

<?php if ( mysqli_num_rows($admin_set) == 0 ) { ?>

  <p class="flow-text">
    No administrators to show. Click on the new administrator button in the bottom right corner of the screen to add a new administrator.
  </p>

<?php } ?>

<?php while ($admin = mysqli_fetch_assoc($admin_set) ){ ?>

  <div class="col s12 m4">

    <div class="card blue-grey darken-1">

      <div class="card-content white-text">

        <span class="card-title">
          <?php echo htmlentities( $admin["first_name"] . " " . $admin["last_name"] ); ?>
        </span>

        <p>Email:
          <?php echo htmlentities( $admin["email"] ); ?>
        </p>

      </div>

      <div class="card-action">

        <form action="edit_admin.php" method="post" class="inline_block">
          <input type="hidden" name="admin_id" value="<?php echo $admin["id"]; ?>">
          <input type="submit" name="submit" value="edit" class="card_action_link">
        </form>

        <a
          class="waves-effect waves-light modal-trigger"
          href="#delete_modal"
          data-admin_id="<?php echo htmlentities($admin["id"]); ?>"
          data-username="<?php echo htmlentities($admin["username"]); ?>"
          onclick="initiateModal(this)">
          Remove
        </a>

        <form action="reset_password.php" method="post" class="inline_block">
          <input type="hidden" name="admin_id" value="<?php echo $admin["id"]; ?>">
          <input type="submit" name="submit" value="reset" class="card_action_link">
        </form>

      </div>

    </div>

  </div>


<?php /* END while ($admin = mysqli_fetch_assoc($admin_set) ) */ } ?>

<?php mysqli_free_result($admin_set); ?>
