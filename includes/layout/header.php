<nav>

     <div class="nav-wrapper orange">

      <h1 class="margin-top-zero">
        <a href="index.php" class="brand-logo center">
          Widget Corporation
        </a>
      </h1>

      <?php if( isset($context["display_content_nav"]) && $context["display_content_nav"] === true): ?>

        <a href="#" data-activates="content_mobile_nav" class="button-collapse show-on-small">
          <i class="material-icons">menu</i>
        </a>
      
      <?php endif ?>

      <?php if( isset($context["show_link_to_login"]) && $context["show_link_to_login"] === true && !logged_in() ): ?>
        
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



     </div>

  </nav>