<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
?>

<?php

$no_permit_type_options[0] = ['type' => 'All', 'name' => 'All'];
$no_permit_type_options[1] = ['type' => 'no_permit', 'name' => 'No permit'];
$no_permit_type_options[2] = ['type' => 'with_conditions', 'name' => 'Permit with conditions'];

$params = drupal_get_query_parameters();
if ('All' == $params['field_no_permit_type_value'] || !isset($params['field_no_permit_type_value'])) {
  $no_permit_type_options[0]['class'] = 'active';
} elseif ('no_permit' == $params['field_no_permit_type_value']) {
  $no_permit_type_options[1]['class'] = 'active';
} elseif ('with_conditions' == $params['field_no_permit_type_value']) {
  $no_permit_type_options[2]['class'] = 'active';
}
?>

<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($exposed): ?>

    <?php if ($header): ?>
      <div class="row">
        <?php print $header; ?>
      </div>
    <?php endif; ?>

      <div class="row">
          <div class="col-lg-12 pb-5">
              <div class="filter mb-5">
                  <ul class="inline block-active-icon font-family3 bold text-uppercase small mb-5">
                    <?php foreach ($no_permit_type_options as $no_permit_type_option): ?>
                        <li class="<?php print $no_permit_type_option['class']; ?>">
                            <a href="?field_no_permit_type_value=<?php print $no_permit_type_option['type'] ?>"><?php print $no_permit_type_option['name']; ?></a>
                        </li>
                    <?php endforeach; ?>
                  </ul>

                  <div class="text-right search-options">
                      <form class="search-wrap" action=""
                            method="get" id="views-exposed-form-revoked-and-restricted-permits-page-2"
                            accept-charset="UTF-8">
                          <input type="text"
                                 placeholder="Search name"
                                 id="edit-search-title"
                                 name="title" value=""
                                 size="30" maxlength="128"
                                 class="form-text ctools-auto-submit-processed">
                          <button>
                              <i class="far fa-search"></i>
                              <span class="sr-only">Search</span>
                          </button>
                      </form>
                  </div>
              </div>
          </div>
      </div>

  <?php endif; ?>

  <?php if ($attachment_before): ?>
      <div class="attachment attachment-before">
        <?php print $attachment_before; ?>
      </div>
  <?php endif; ?>

    <div class="row">
        <div class="col-lg-8">
          <?php if ($rows): ?>
              <div class="view-content container">
                <?php print $rows; ?>
              </div>
          <?php elseif ($empty): ?>
              <div class="view-empty">
                <?php print $empty; ?>
              </div>
          <?php endif; ?>
          <?php if ($more): ?>
            <?php print $more; ?>
          <?php endif; ?>
          <?php if ($pager): ?>
            <?php print $pager; ?>
          <?php endif; ?>
        </div>

        <div class="col-lg-3 offset-lg-1">
          <?php if ($exposed): ?>
              <div class="view-filters">
                <h3 class="text-uppercase h5 font-family3 theme-color safe small bold">filters</h3>
                <?php print $exposed; ?>
              </div>
          <?php endif; ?>
        </div>
    </div>

  <?php if ($attachment_after): ?>
      <div class="attachment attachment-after">
        <?php print $attachment_after; ?>
      </div>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
      <div class="feed-icon">
        <?php print $feed_icon; ?>
      </div>
  <?php endif; ?>

</div><?php /* class view */ ?>
