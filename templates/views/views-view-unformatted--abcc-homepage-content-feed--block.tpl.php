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
        <a href="https://www.eventbrite.com/e/security-of-payment-information-session-for-construction-contractors-tickets-50381811354" target="_blank" class="no-icon card img-card h-100 fade-in-up animated">
            <img src="/<?php print path_to_theme(); ?>/images/sp-sub_contractor.jpg"
                 alt="sub-contractor campaign promo image">
            <span class="sr-only">Subcontractors deserve to be paid on time. Register for the free NSW info session</span>
        </a>
    </div>
  <?php foreach ($rows as $id => $row): ?>
    <?php print $row; ?>
  <?php endforeach; ?>
    <div class="col-lg-8">
        <a href="/app" class="card img-card h-100 fade-in-up animated">
            <img src="/<?php print path_to_theme(); ?>/images/sp-need-to-know.png"
                 alt=" Get the ABCC app promo image">
            <span class="sr-only">Need to know your rights on site. Get the app</span>
        </a>
    </div>
</div>
