<?php
/**
 * @file
 * page.tpl.php - Returns the HTML for a single Drupal page.
 */
?>

<div class="page">
    <!-- page mobile header -->
    <?php include 'includes/page-header--mobile.tpl.php'; ?>
    <!-- /page mobile header -->
    <main class="mm-content">
        <!-- page header -->
        <?php include 'includes/page-header.tpl.php'; ?>
        <!-- /page header -->

        <!-- page banner -->
        <div class="banner main-banner banner-animate animate" id="main-banner">
            <div class="bg-img" style="background-image: url(/<?php print path_to_theme(); ?>/images/banners/banner-home.jpg)">
                <img class="mob-bg-img" src="/<?php print path_to_theme(); ?>/images/banners/banner-mobile.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="text">
                                <div class="accent">
                                    <h1><?php print $home_page_h1; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page banner -->

        <div>
          <?php if ($messages): ?>
              <div class="system-alert">
                <?php print $messages; ?>
              </div>
          <?php endif; ?>

            <!-- main page content -->
            <section id="main-content-section" role="main">
                <a id="main-content"></a>
              <?php if (!empty($tabs)): ?>
                <?php print render($tabs); ?>
              <?php endif; ?>
              <?php if (!empty($page['help'])): ?>
                <?php print render($page['help']); ?>
              <?php endif; ?>
              <?php if (!empty($action_links)): ?>
                  <ul class="action-links"><?php print render($action_links); ?></ul>
              <?php endif; ?>
                <div id="page-content">
                  <?php print render($page['content']); ?>
                </div>
            </section>
            <!-- /main page content -->

        </div>

        <!-- page footer -->
        <?php include 'includes/page-footer.tpl.php'; ?>

    </div>
</div>


<nav id="navigation" class="<?php print $container_class; ?>">
  <?php print render($page['navigation']); ?>
</nav><!-- /#navigation -->

<main>
  <div id="main" class="main-container <?php print $container_class; ?>">
    <?php if (!empty($page['highlighted'])): ?>
      <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
    <?php endif; ?>
    <div id="content" class="row">
      <?php if (!empty($page['sidebar_first'])): ?>
        <aside class="col-sm-3" role="complementary">
          <?php print render($page['sidebar_first']); ?>
        </aside>  <!-- /#sidebar-first -->
      <?php endif; ?>
      <?php if (!empty($page['sidebar_second'])): ?>
        <aside class="col-sm-3" role="complementary">
          <?php print render($page['sidebar_second']); ?>
        </aside>  <!-- /#sidebar-second -->
      <?php endif; ?>
    </div>
  </div>
</main>


