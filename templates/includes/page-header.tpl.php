<?php
/**
 * @file
 * page-header.tpl.php - Returns the HTML of the page header
 */
?>

<header class="header bg-white">
    <div class="container">
        <?php if (!empty($page['header'])): ?>
          <div class="row">
            <?php print render($page['header']); ?>
          </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="top">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="/" aria-label="homepage">
                                <img src="/<?php print path_to_theme(); ?>/images/abcc-logo.svg" class="abcc-logo" alt="Australian Government Australian Building and Construction Commission"/>
                            </a>
                        </div>
                        <div class="col-md-8 text-right search-cluster">
                          <?php print $search_box; ?>
                            <div class="translate">
                                <div class="translate-indicator bounce" aria-hidden="true">
                                    <i class="fas fa-chevron-up"></i>
                                </div>
                                <img src="/<?php print path_to_theme(); ?>/images/google-translate-logo.png" />
                                Translate
                            </div>
                            <img src="/<?php print path_to_theme(); ?>/images/logo.svg" class="logo" alt="Australian Building and Construction Commission" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="collapse navbar-collapse justify-content" id="navbarNavDropdown">
                            <ul class="navbar-nav large-font">
                                <li class="nav-item <?php if (drupal_is_front_page()) { print 'active'; } ?>">
                                    <a class="nav-link" href="/">
                                        <i class="fal fa-home"></i>
                                        <span class="sr-only">Home</span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown mega">
                                    <a class="nav-link dropdown-toggle" href="#" id="rights" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Your rights & responsibilities
                                    </a>
                                    <div class="dropdown-menu theme-rights" aria-labelledby="rights">
                                        <div class="inner">
                                            <div class="container py-5">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h2 class="mb-3"><?php print $main_menu_tree['rights_and_responsibilities']['title']; ?></h2>
                                                        <p class="h5 font-family1 regular mb-4">For all building industry participants.</p>
                                                        <a href="#" class="text-body bold">
                                                            <i class="fal fa-arrow-circle-right fa-2x"></i>
                                                            <?php print $main_menu_tree['rights_and_responsibilities']['title']; ?>
                                                        </a>
                                                    </div>
                                                    <!-- /.col-md-4  -->
                                                    <div class="col-md-4">
                                                        <div class="main-menu-fragment">
                                                          <?php
                                                            print drupal_render($main_menu_tree['rights_and_responsibilities']['tree']);
                                                          ?>
                                                        </div>
                                                    </div>
                                                    <!-- /.col-md-4  -->
                                                    <div class="col-md-4">
                                                        <span class="theme-colour text-uppercase font-family3 bold block">Popular</span>
                                                        <a href="#" class="block text-body">No permit list</a>
                                                        <a href="#" class="block text-body">Strike pay</a>

                                                        <span class="theme-colour text-uppercase font-family3 bold block mt-3">Related</span>
                                                        <a href="#" class="block text-body">Fact Sheets</a>
                                                        <a href="#" class="block text-body">Strike pay</a>
                                                    </div>
                                                    <!-- /.col-md-4  -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown mega">
                                    <a class="nav-link dropdown-toggle" href="#" id="Code" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Building Code
                                    </a>
                                    <div class="dropdown-menu theme-rights" aria-labelledby="code">
                                        <div class="inner">
                                            <div class="container py-5">
                                                <div class="menu-row">
                                                  <?php print drupal_render(govstrap_menu_tree_get_rid_of_root($main_menu_tree['building_code']['tree'])); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="resources" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php print $main_menu_tree['resources']['title']; ?>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="resources">
                                        <?php
                                        $new_sub_menu_tree =  govstrap_menu_tree_get_rid_of_root($main_menu_tree['resources']['tree']);
                                        govstrap_menu_get_max_level_sub_tree($new_sub_menu_tree, 0);
                                        print drupal_render($new_sub_menu_tree);
                                        ?>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Legal cases</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="#"><?php print $main_menu_tree['news_and_media']['title']; ?></a>
                                    <div class="dropdown-menu" aria-labelledby="resources">
                                      <?php print drupal_render($main_menu_tree['news_and_media']['tree']); ?>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="resources" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <?php print $main_menu_tree['about']['title']; ?>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="<?php print $main_menu_tree['about']['title']; ?>">
                                      <?php
                                      $new_sub_menu_tree =  govstrap_menu_tree_get_rid_of_root($main_menu_tree['about']['tree']);
                                      govstrap_menu_get_max_level_sub_tree($new_sub_menu_tree, 0);
                                      print drupal_render($new_sub_menu_tree);
                                      ?>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
