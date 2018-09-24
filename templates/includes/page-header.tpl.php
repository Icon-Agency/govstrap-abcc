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
                            <a href="/" aria-label="homepage">
                                <img src="/<?php print path_to_theme(); ?>/images/logo.svg" class="logo" alt="Australian Building and Construction Commission" />
                            </a>
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
                              <?php
                              $main_nav_sub_menu_tree = get_main_nav_sub_menu_tree($main_menu_tree, 'your_rights_and_responsibilities', $active_page_root);
                              ?>
                                <li class="nav-item dropdown mega <?php print $main_nav_sub_menu_tree['active_class']; ?>">
                                    <a class="nav-link dropdown-toggle" href="/<?php print $main_menu_tree['your_rights_and_responsibilities']['path']; ?>" id="rights" aria-haspopup="true" aria-expanded="false">
                                        Your rights & responsibilities
                                    </a>
                                    <div class="dropdown-menu theme-rights" aria-labelledby="rights">
                                        <div class="inner">
                                            <div class="container py-5">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h2 class="mb-3"><?php print $main_menu_tree['your_rights_and_responsibilities']['title']; ?></h2>
                                                        <p class="h5 font-family1 regular mb-4">For all building industry participants.</p>
                                                        <a href="/<?php print $main_menu_tree['your_rights_and_responsibilities']['path']; ?>" class="text-body bold">
                                                            <i class="fal fa-arrow-circle-right fa-2x"></i>
                                                            <?php print $main_menu_tree['your_rights_and_responsibilities']['title']; ?>
                                                        </a>
                                                    </div>
                                                    <!-- /.col-md-4  -->
                                                    <div class="col-md-4">
                                                        <div class="main-menu-fragment" id="menu-rights-and-responsibilities">
                                                            <?php print $main_nav_sub_menu_tree['markup']; ?>
                                                        </div>
                                                    </div>
                                                    <!-- /.col-md-4  -->
                                                    <div class="col-md-4">
                                                        <span class="theme-colour text-uppercase font-family3 bold block">Popular</span>
                                                        <a href="/resources/right-entry-permit-lists" class="block text-body">Right of entry permit lists</a>

                                                        <span class="theme-colour text-uppercase font-family3 bold block mt-3">Related</span>
                                                        <a href="/resources/factsheets#fs-rights-responsibilities" class="block text-body">Fact Sheets</a>
                                                    </div>
                                                    <!-- /.col-md-4  -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                              <?php
                              $main_nav_sub_menu_tree = get_main_nav_sub_menu_tree($main_menu_tree, 'building_code', $active_page_root);
                              ?>
                              <?php if (!empty($page['mega_menu_item_building_code'])): ?>
                                    <li class="nav-item dropdown mega <?php print $main_nav_sub_menu_tree['active_class'];?>">
                                      <?php print render($page['mega_menu_item_building_code']); ?>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <ul class="navbar-nav">
                              <?php
                              $main_nav_sub_menu_tree = get_main_nav_sub_menu_tree($main_menu_tree, 'resources', $active_page_root);
                              ?>
                                <li class="nav-item dropdown <?php print $main_nav_sub_menu_tree['active_class']; ?>">
                                    <a class="nav-link dropdown-toggle" href="/<?php print $main_menu_tree['resources']['path']; ?>" id="resources" aria-haspopup="true" aria-expanded="false">
                                        <?php print $main_menu_tree['resources']['title']; ?>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="resources">
                                        <?php print $main_nav_sub_menu_tree['markup']; ?>
                                    </div>
                                </li>
                              <?php
                              $main_nav_sub_menu_tree = get_main_nav_sub_menu_tree($main_menu_tree, 'legal_cases', $active_page_root);
                              ?>
                                <li class="nav-item dropdown <?php print $main_nav_sub_menu_tree['active_class']; ?>">
                                    <a class="nav-link" href="/<?php print $main_menu_tree['legal_cases']['path']; ?>"><?php print $main_menu_tree['legal_cases']['title']; ?></a>
                                </li>
                              <?php
                              $main_nav_sub_menu_tree = get_main_nav_sub_menu_tree($main_menu_tree, 'news_and_media', $active_page_root);
                              ?>
                                <li class="nav-item dropdown <?php print $main_nav_sub_menu_tree['active_class']; ?>">
                                    <a class="nav-link" href="/<?php print $main_menu_tree['news_and_media']['path']; ?>"><?php print $main_menu_tree['news_and_media']['title']; ?></a>
                                </li>
                              <?php
                              $main_nav_sub_menu_tree = get_main_nav_sub_menu_tree($main_menu_tree, 'about', $active_page_root);
                              ?>
                                <li class="nav-item dropdown <?php print $main_nav_sub_menu_tree['active_class']; ?>">
                                    <a class="nav-link dropdown-toggle" href="/<?php print $main_menu_tree['about']['path']; ?>" id="resources" aria-haspopup="true" aria-expanded="false">
                                      <?php print $main_menu_tree['about']['title']; ?>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="<?php print $main_menu_tree['about']['title']; ?>">
                                      <?php print $main_nav_sub_menu_tree['markup']; ?>
                                    </div>
                                </li>
                              <?php
                              $main_nav_sub_menu_tree = get_main_nav_sub_menu_tree($main_menu_tree, 'contact', $active_page_root);
                              ?>
                                <li class="nav-item dropdown <?php print $main_nav_sub_menu_tree['active_class']; ?>">
                                    <a class="nav-link" href="/<?php print $main_menu_tree['contact']['path']; ?>"><?php print $main_menu_tree['contact']['title']; ?></a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
