<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <?php print $title; ?>
<?php endif; ?>

<div id="accordion" role="tablist" class="accordion no-background-color icon-right no-body-pad secion-border-top">
  <?php foreach ($rows as $id => $row): ?>
    <?php print $row; ?>
  <?php endforeach; ?>
</div>