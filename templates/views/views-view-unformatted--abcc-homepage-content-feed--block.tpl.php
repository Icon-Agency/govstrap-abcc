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
    <div class="col-lg-8">
        <a href="#" class="card img-card h-100 fade-in-up animated">
            <img src="/<?php print path_to_theme(); ?>/images/sp-need-to-know.png"
                 alt=" Get the ABCC app promo image">
            <span class="sr-only">Need to know your rights on site. Get the app</span>
        </a>
    </div>
  <?php foreach ($rows as $id => $row): ?>
    <?php print $row; ?>
  <?php endforeach; ?>
    <div class="col-lg-8">
        <a href="#" class="card img-card h-100 fade-in-up animated">
            <img src="/<?php print path_to_theme(); ?>/images/sp-subscribe.png"
                 alt="Subscribe for e-alerts promo image">
            <span class="sr-only">Subscribe for e-alerts &amp; industry updates - Subscribe now</span>
        </a>
    </div>
</div>
