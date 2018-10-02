<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
    <h3><?php print $title; ?></h3>
<?php endif; ?>
<div class="row">
  <?php $block = module_invoke('bean', 'block_view', 'first-featured-content-feed'); ?>
  <?php if ($block): ?>
      <div class="col-lg-8">
        <?php print render($block['content']); ?>
      </div>
  <?php endif; ?>
  <?php foreach ($rows as $id => $row): ?>
    <?php print $row; ?>
  <?php endforeach; ?>
  <?php $block = module_invoke('bean', 'block_view', 'last-featured-content-feed'); ?>
  <?php if ($block): ?>
      <div class="col-lg-8">
        <?php print render($block['content']); ?>
      </div>
  <?php endif; ?>
</div>
