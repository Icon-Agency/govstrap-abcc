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
    print 'id="'.$css_id.'"';
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

    <div class="banner single-image-left banner-animate bg-dark-blue text-white industry-update" id="industry-update">
        <div class="bg-img" style="background-image: url(/<?php print path_to_theme(); ?>/images/banner2-man.png)">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 offset-xl-4 col-lg-9 offset-lg-3 py-5">
                        <div class="text">
                            <div class="accent color-green">
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