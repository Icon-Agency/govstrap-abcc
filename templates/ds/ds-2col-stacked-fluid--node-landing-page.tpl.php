<?php

/**
 * @file
 * Display Suite fluid 2 column stacked template.
 */

// Add sidebar classes so that we can apply the correct width in css.
if (($left && !$right) || ($right && !$left)) {
  $classes .= ' group-one-column';
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="signposts pb-3">

                <div class="row">
                    <div class="col-lg-12">
                      <?php if (isset($title_suffix['contextual_links'])): ?>
                        <?php print render($title_suffix['contextual_links']); ?>
                      <?php endif; ?>
                        <<?php print $header_wrapper ?>
                        class="group-header<?php print $header_classes; ?>">
                      <?php print $header; ?>
                    </<?php print $header_wrapper ?>>
                </div>
            </div>

            <div class="row">
              <?php if ($left): ?>
                <div class="col-lg-6">
                    <<?php print $left_wrapper ?>
                    class="group-left<?php print $left_classes; ?>">
                  <?php print $left; ?>
                </<?php print $left_wrapper ?>>
            </div>
          <?php endif; ?>


          <?php if ($right): ?>
            <div class="col-lg-6">
                <<?php print $right_wrapper ?>
                class="group-right<?php print $right_classes; ?>">
              <?php print $right; ?>
            </<?php print $right_wrapper ?>>
            </div>
          <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<<?php print $footer_wrapper ?> class="group-header<?php print $header_classes; ?>">
<?php print $footer; ?>
</<?php print $footer_wrapper ?>>


<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
