<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<span class="font-family3 text-uppercase bold theme-color safe">Related</span>
<h3 class="mb-3">News and cases</h3>
<div class="signposts">
    <div class="news-carousel">
        <?php foreach ($rows as $id => $row): ?>
            <?php print $row; ?>
        <?php endforeach; ?>
    </div>
</div>