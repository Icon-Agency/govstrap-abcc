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
    <<?php print $header_wrapper ?>
    class="group-header<?php print $header_classes; ?>">
<?php if($header): ?>
<div class="bg-white pt-5"></div>
<?php else: ?>
    <div class="pt-5"></div>
<?php endif; ?>
  <?php print $header; ?>
</<?php print $header_wrapper ?>>

<?php if ($left && $right): ?>
    <div class="container">
        <div class="row">
            <div class="container">
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
      </div> <!-- /.container -->
    </div> <!-- /.bg-white -->
<?php endif; ?>

<<?php print $footer_wrapper ?>>
<?php print $footer; ?>
</<?php print $footer_wrapper ?>>


<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
