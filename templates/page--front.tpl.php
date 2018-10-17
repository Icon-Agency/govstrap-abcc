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
    <div class="mm-content">
        <!-- page header -->
        <?php include 'includes/page-header.tpl.php'; ?>
        <!-- /page header -->

        <!-- page banner -->
        <div class="banner main-banner banner-animate animate" id="main-banner">
            <div class="bg-img" style="background-image: url(/<?php print path_to_theme(); ?>/images/banners/banner-home.jpg)">
                <img class="mob-bg-img" src="/<?php print path_to_theme(); ?>/images/banners/banner-mobile.jpg" alt="main banner image showing a construction worker wearing a hard hat and a high vis vest">
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
    </div>

        <!-- page footer -->
        <?php include 'includes/page-footer.tpl.php'; ?>

</div>

<!-- page mobile menu -->
<?php include 'includes/page-menu--mobile.tpl.php'; ?>
