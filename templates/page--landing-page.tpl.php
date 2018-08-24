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
            <div class="bg-img" style="background-size: contain; background-position-x: 100%; background-image: url(/<?php print path_to_theme(); ?>/images/banners/banner-<?php print rand(1, 3);?>.png)">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-9 py-5">
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

                            <div class="btn-wrap">
                                <?php if ($active_page_parent): ?>
                                    <a href="/<?php print $active_page_parent['link_path'];?>"><i class="fal fa-arrow-left"></i>Back to <?php print $active_page_parent['link_title'];?></a>
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
                    <div class="container pt-5">
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
                    <div id="page-content">
                      <?php print render($page['content']); ?>
                    </div>
                </section>
                <!-- /main page content -->

        <!-- page footer -->
        <?php include 'includes/page-footer.tpl.php'; ?>

    </div>
</div>


<nav id="navigation" class="<?php print $container_class; ?>">
  <?php print render($page['navigation']); ?>
</nav><!-- /#navigation -->

<main>
  <div id="main" class="main-container <?php print $container_class; ?>">

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

<!-- page mobile menu -->
<?php include 'includes/page-menu--mobile.tpl.php'; ?>

