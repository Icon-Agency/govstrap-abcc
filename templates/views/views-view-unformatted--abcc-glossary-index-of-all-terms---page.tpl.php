<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
<div class="row">
    <div class="col-lg-1">
        <h3 class="font-family2 bold xl-large" id="section-<?php print strtolower($title); ?>"><?php print strtoupper($title); ?></h3>
    </div>
    <div class="col-lg-11">
        <div id="accordion" role="tablist" class="accordion no-background-color icon-right no-body-pad secion-border-top">
          <?php foreach ($rows as $id => $row): ?>
            <?php print $row; ?>
          <?php endforeach; ?>
        </div>
    </div>
</div>
<hr class="my-5">
<?php endif; ?>

