<nav>

     <div class="nav-wrapper orange">

      <h1 class="margin-top-zero">
        <a href="index.php" class="brand-logo center">
          Widget Corporation
        </a>
      </h1>

      <?php /* Should we display the hamburger icon for content navigation? */ ?>
      <?php if( isset($context["display_content_nav"]) && $context["display_content_nav"] === true): ?>

        <!-- Content Navigation Hamburger -->

        <a href="#" data-activates="content_mobile_nav" class="button-collapse show-on-small">
          <i class="material-icons">menu</i>
        </a>

      <?php endif ?>

      <?php /* Should we display a login link if you are on the homepage and not logged in */ ?>
      <?php if( isset($context["script"]) && $context["script"] === "index" && !logged_in() ): ?>

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

      <?php /* Should we display the admin menu on the header if you are logged in? */ ?>
      <?php if ( logged_in() ) : ?>

        <!-- Logged in menu -->

        <!-- hamburger -->
        <?php /*  Do not echo mobile nav or hamburger for admin menu if the content nav already exists. This is to deter conflicts with two navigations being displayed when logged in on pages with content navigation. */ ?>

        <?php if ( !isset($context["display_content_nav"]) ): ?>

          <a href="#" data-activates="nav-mobile" class="button-collapse show-on-small">
            <i class="material-icons">menu</i>
          </a>

        <?php endif ?>

        <!-- desktop navigation -->
        <ul class="right hide-on-med-and-down">

          <?php /* Should we display a link to the admin dashboard if you are logged in and on the homepage? */ ?>
          <?php if ( isset($context["script"]) && $context["script"] == "index" ) : ?>
            <li>
              <a href="admin.php" class="side-padding-buffer">Dashboard</a>
            </li>
          <?php endif ?>

          <li>
            <a href="logout.php" class="side-padding-buffer">Logout</a>
          </li>

        </ul>

        <!-- mobile navigation -->
        <?php /*  Do not echo mobile nav or hamburger for admin menu if the content nav already exists. This is to deter conflicts with two navigations being displayed when logged in on pages with content navigation. */ ?>

        <?php if ( !isset($context["display_content_nav"]) ): ?>
          <ul id="nav-mobile" class="side-nav">

            <?php /* Should we display a link to the admin dashboard if you are logged in and on the homepage? */ ?>
            <?php if ( isset($context["script"]) && $context["script"] == "index" ) : ?>
              <li>
                <a href="admin.php" class="side-padding-buffer">Dashboard</a>
              </li>
            <?php endif ?>

            <li>
              <a href="logout.php">Logout</a>
            </li>

          </ul>
        <?php endif ?>

      <?php endif ?>

     </div>

  </nav>