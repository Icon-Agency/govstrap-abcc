<?php

/**
 * @file
 * This template handles the layout of the views exposed filter form.
 *
 * Variables available:
 * - $widgets: An array of exposed form widgets. Each widget contains:
 * - $widget->label: The visible label to print. May be optional.
 * - $widget->operator: The operator for the widget. May be optional.
 * - $widget->widget: The widget itself.
 * - $sort_by: The select box to sort the view using an exposed form.
 * - $sort_order: The select box with the ASC, DESC options to define order.
 *   May be optional.
 * - $items_per_page: The select box with the available items per page. May be
 *   optional.
 * - $offset: A textfield to define the offset of the view. May be optional.
 * - $reset_button: A button to reset the exposed filter applied. May be
 *   optional.
 * - $button: The submit button for the form.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($q)): ?>
  <?php
  // This ensures that, if clean URLs are off, the 'q' is added first so that
  // it shows up first in the URL.
  print $q;
  ?>
<?php endif; ?>

<?php
$params = drupal_get_query_parameters();
?>
<div class="abcc-views-exposed-form">
  <?php if (!empty($widgets['filter-field_advice_category_tid'])):
    $widget = $widgets['filter-field_advice_category_tid'];
    ?>
      <div id="<?php print $widget->id; ?>-wrapper"
           class="inline block-active-icon font-family3 bold small text-uppercase views-exposed-widget views-widget-<?php print $widget->id; ?>">
          <div class="views-widget">
            <?php print $widget->widget; ?>
          </div>
      </div>
  <?php endif; ?>

  <?php if (!empty($widgets['filter-combine'])): ?>
      <div class="text-right search-options">
        <?php if (!empty($items_per_page)): ?>
            <div class="views-exposed-widget views-widget-per-page select">
                <span class="font-family3 bold small" style="position: absolute; left: -3rem;">SHOW </span>
                <?php print $items_per_page; ?>
                <div class="select__arrow"></div>
            </div>
        <?php endif; ?>
          <div class="search-wrap">
              <input type="text" id="edit-title" name="title"
                     placeholder="Search agreement clauses"
                     value="<?php print empty($params['title']) ? '' : $params['title']; ?>"
                     size="30" maxlength="128"
                     class="form-text"/>
              <button>
                  <i class="far fa-search"></i>
                  <span class="sr-only">Search</span>
              </button>
          </div>
      </div>
  <?php endif; ?>

  <?php if (!empty($sort_by)): ?>
      <div class="views-exposed-widget views-widget-sort-by">
        <?php print $sort_by; ?>
      </div>
      <div class="views-exposed-widget views-widget-sort-order">
        <?php print $sort_order; ?>
      </div>
  <?php endif; ?>
  <?php if (!empty($offset)): ?>
      <div class="views-exposed-widget views-widget-offset">
        <?php print $offset; ?>
      </div>
  <?php endif; ?>
    <div class="views-exposed-widget views-submit-button">
      <?php print $button; ?>
    </div>
  <?php if (!empty($reset_button)): ?>
      <div class="views-exposed-widget views-reset-button">
        <?php print $reset_button; ?>
      </div>
  <?php endif; ?>
</div>