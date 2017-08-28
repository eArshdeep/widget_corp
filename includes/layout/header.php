<nav>

     <div class="nav-wrapper orange">

      <h1 class="margin-top-zero">
        <a href="index.php" class="brand-logo center">
          Widget Corporation
        </a>
      </h1>

      <?php if( isset($context["display_content_nav"]) && $context["display_content_nav"] === true): ?>

        <!-- Content Navigation Hamburger -->

        <a href="#" data-activates="content_mobile_nav" class="button-collapse show-on-small">
          <i class="material-icons">menu</i>
        </a>
      
      <?php endif ?>

      <?php if( isset($context["show_link_to_login"]) && $context["show_link_to_login"] === true && !logged_in() ): ?>

        <!-- Navigation for login link on homepage -->
        
        <!-- hamburger -->
        <a href="#" data-activates="nav-mobile" class="button-collapse show-on-small">
          <i class="material-icons">menu</i>
        </a>
        
        <!-- desktop navigation -->
        <ul class="right hide-on-med-and-down">
          <li>
            <a href="login.php" class="side-padding-buffer">Login</a>
          </li>
        </ul>

        <!-- mobile navigation -->
        <ul id="nav-mobile" class="side-nav">
          <li>
            <a href="login.php">Login</a>
          </li>
        </ul>
      
      <?php endif ?>

      <?php if ( logged_in() ) : ?>

        <!-- Logged in menu -->

        <!-- hamburger -->
        <a href="#" data-activates="nav-mobile" class="button-collapse show-on-small">
          <i class="material-icons">menu</i>
        </a>
        
        <!-- desktop navigation -->
        <ul class="right hide-on-med-and-down">

          <?php if ( isset($context["script"]) && $context["script"] == "index" ) : ?>
            <!-- Link to dashboard on homepage -->
            <li>
              <a href="admin.php" class="side-padding-buffer">Dashboard</a>
            </li>
          <?php endif ?>

          <li>
            <a href="logout.php" class="side-padding-buffer">Logout</a>
          </li>

        </ul>

        <!-- mobile navigation -->
        <ul id="nav-mobile" class="side-nav">

          <?php if ( isset($context["script"]) && $context["script"] == "index" ) : ?>
            <!-- Link to dashboard on homepage -->
            <li>
              <a href="admin.php" class="side-padding-buffer">Dashboard</a>
            </li>
          <?php endif ?>

          <li>
            <a href="logout.php">Logout</a>
          </li>

        </ul>

      <?php endif ?>

     </div>

  </nav>