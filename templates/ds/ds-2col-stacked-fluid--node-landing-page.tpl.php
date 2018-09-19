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

<?php if (isset($title_suffix['contextual_links'])): ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

<?php if($header): ?>
    <div class="bg-white pt-5 pb-4">
        <<?php print $header_wrapper ?> class="group-header<?php print $header_classes; ?>">
            <?php print $header; ?>
        </<?php print $header_wrapper ?>>
    </div>
<?php endif; ?>

<?php if ($left || $right): ?>
    <div class="container pt-5">
        <div class="row signposts pb-3">
              <?php if ($left): ?>
                <div class="col-lg-6">
                    <<?php print $left_wrapper ?> class="group-left<?php print $left_classes; ?>">
                    <?php print $left; ?>
                  </<?php print $left_wrapper ?>>
                </div>
              <?php endif; ?>
              <?php if ($right): ?>
                <div class="col-lg-6">
                   <<?php print $right_wrapper ?> class="group-right<?php print $right_classes; ?>">
                      <?php print $right; ?>
                   </<?php print $right_wrapper ?>>
                </div>
              <?php endif; ?>
      </div> <!-- /.row -->
    </div> <!-- /.container -->
<?php endif; ?>

<<?php print $footer_wrapper ?>>
<?php print $footer; ?>
</<?php print $footer_wrapper ?>>


<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
