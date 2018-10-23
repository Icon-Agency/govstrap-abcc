<?php
/**
 * @file
 * Template for a 2 column panel layout.
 *
 * This template provides a two column panel display layout, with
 * each column roughly equal in width. It is 5 rows high; the top
 * middle and bottom rows contain 1 column, while the second
 * and fourth rows contain 2 columns.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['top']: Content in the top row.
 *   - $content['left_above']: Content in the left column in row 2.
 *   - $content['right_above']: Content in the right column in row 2.
 *   - $content['middle']: Content in the middle row.
 *   - $content['left_below']: Content in the left column in row 4.
 *   - $content['right_below']: Content in the right column in row 4.
 *   - $content['right']: Content in the right column.
 *   - $content['bottom']: Content in the bottom row.
 */
?>
<div class="panel-display clearfix" <?php if (!empty($css_id)) {
  print 'id="' . $css_id . '"';
} ?>>

    <div class="bg-white">
        <div class="quick-links py-5 fade-in-up animated">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                      <?php print $content['row-1-col-1']; ?>
                    </div>
                    <div class="col-lg-7 border-left">
                      <?php print $content['row-1-col-2']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="signposts pt-5 pb-3">
        <div class="container">
          <?php print $content['row-2']; ?>
        </div>
    </div>

    <div class="banner single-image-left banner-animate bg-dark-blue text-white industry-update"
         id="industry-update">
        <div class="bg-img"
             style="background-image: url(/<?php print path_to_theme(); ?>/images/banner2-man.png)">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 offset-xl-4 col-lg-9 offset-lg-3 py-5">
                        <div class="text">
                            <div class="accent color-green">
                              <?php
                              $book_industry_updat_bid = variable_get('book_industry_update_bid', 32091);
                              $book_industry_updat_menu_tree = menu_tree_all_data('book-toc-' . $book_industry_updat_bid);

                              $latest_update = array();
                              foreach($book_industry_updat_menu_tree["50000 Industry updates 11451"]["below"] as $industry_update) {
                                $link_path = $industry_update['link']['link_path'];
                                //$node_id = str_replace('node/', '', $link_path);
                                $node = menu_get_item($link_path);
                                $node_sticky = $node['page_arguments'][0]->sticky;
                                $node_promoted = $node['page_arguments'][0]->promote;
                                if ($node_sticky && $node_promoted) {
                                  $latest_update = $industry_update;
                                  break;
                                }
                              }

                              $book_latest_industry_update = $latest_update["below"];
                              if ($book_industry_updat_menu_tree) {
                                $book_latest_industry_update = array_shift(array_slice($book_latest_industry_update, 0, 1));
                                $latest_industry_updates['links'] = $book_latest_industry_update['below'];
                                $latest_industry_update['title'] = trim(str_replace(array('Industry Update', 'Industry update'), '', $latest_update["link"]["link_title"]));
                              }
                              ?>
                              <?php if ($book_latest_industry_update): ?>
                                  <span class="font-family3 text-uppercase small"><strong
                                          class="text-green">Issue - </strong> <a class="text-white" href="/<?php print drupal_get_path_alias($latest_update["link"]["link_path"]); ?>"><?php print $latest_industry_update['title']; ?></a></span>
                                <a href="/<?php print drupal_get_path_alias($latest_update["link"]["link_path"]); ?>">
                                    <h2 class="h1 text-green mb-4">Industry update
                                      <i class="fal fa-arrow-circle-right fa-xs ml-1"></i>
                                    </h2>
                                </a>
                                  <ul class="list-unstyled fixed-number-list font-family3 color-white large">
                                    <?php
                                    $chapter_index = 0;
                                    $chapter_prefix = '0';
                                    if (count($book_latest_industry_update['below']) >= 10) {
                                      $chapter_prefix = '';
                                    }
                                    foreach ($latest_update['below'] as $book_latest_industry_update_chapter): ?>
                                      <?php $chapter_index++; ?>
                                        <li class="mb-1"><span
                                                    class="icon text-green"><?php print $chapter_prefix . $chapter_index; ?>
                                                .</span>
                                          <?php print l($book_latest_industry_update_chapter["link"]["title"], $book_latest_industry_update_chapter["link"]["link_path"]); ?>
                                        </li>
                                    <?php endforeach; ?>
                                  </ul>
                              <?php endif; ?>
                              <?php print $content['row-3']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="abcc-cta fade-in-up container py-5 animated">
        <div class="accent">
            <div class="row">
                <div class="col-xl-4 col-lg-5">
                  <?php print $content['row-4-col-1']; ?>
                </div>
                <div class="col-xl-8 col-lg-7">
                  <?php print $content['row-4-col-2']; ?>
                </div>
            </div>
        </div>
    </div>

</div>