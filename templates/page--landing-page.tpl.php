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
        <div class="banner slim-line bg-dark-blue text-white theme-color-gradient-after">
            <div class="bg-img"
                 style="background-size: contain; background-position-x: 100%; background-image: url(/<?php print path_to_theme(); ?>/images/banners/ABCC-Banner-0<?php print rand(1, 8);?>.png)">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-9 py-md-5 py-sm-0">
                          <?php if (!empty($breadcrumb)): ?>
                              <nav aria-label="breadcrumb" class="breadcrumbs">
                                <?php print $breadcrumb; ?>
                              </nav>
                          <?php endif ?>
                            <div class="text">
                                <div class="accent text-white">
                                  <?php print render($title_prefix); ?>
                                    <h1 class="mb3"><?php print $title; ?></h1>
                                  <?php print render($node_content['field_subtitle']); ?>
                                  <?php print render($title_suffix); ?>
                                </div>
                            </div>

                            <div class="btn-wrap hidden-sm-down">
                              <?php if ($active_page_parent): ?>
                                  <a href="/<?php print $active_page_parent['link_path']; ?>"><i
                                              class="fal fa-arrow-left"></i>Back
                                      to <?php print $active_page_parent['link_title']; ?>
                                  </a>
                              <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page banner -->

      <?php if (!empty($page['highlighted'])): ?>
          <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>
      <?php if ($messages): ?>
          <div class="system-alert">
            <?php print $messages; ?>
          </div>
      <?php endif; ?>
        <!-- main page content -->
        <section id="main-content-section" role="main">
            <a id="main-content"></a>

            <?php if(user_is_logged_in()): ?>
            <div class="bg-white">
                <div class="container pt-3">
                    <div class="row">
                        <div class="col-lg-12">


                          <?php if (!empty($tabs)): ?>
                            <?php print render($tabs); ?>
                          <?php endif; ?>
                          <?php if (!empty($page['help'])): ?>
                            <?php print render($page['help']); ?>
                          <?php endif; ?>
                          <?php if (!empty($action_links)): ?>
                              <ul class="action-links"><?php print render($action_links); ?></ul>
                          <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div id="page-content">
              <?php print render($page['content']); ?>
              <?php if (!empty($page['pre_footer'])): ?>
                  <div class="container pb-5">
                      <div class="row">
                          <div class="col-lg-12">
                            <?php print render($page['pre_footer']); ?>
                          </div>
                      </div>
                  </div>
              <?php endif; ?>
              <?php if (!empty($page['wizard'])): ?>
                <?php print render($page['wizard']); ?>
              <?php endif;?>
            </div>
        </section>
        <!-- /main page content -->

        <!-- page footer -->
      <?php include 'includes/page-footer.tpl.php'; ?>

    </div>
</div>

<!-- page mobile menu -->
<?php include 'includes/page-menu--mobile.tpl.php'; ?>
