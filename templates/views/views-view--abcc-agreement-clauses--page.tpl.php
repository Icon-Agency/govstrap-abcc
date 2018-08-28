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

$advice_category_options[0] = ['tid' => 'All', 'name' => 'All'];
$advice_category_options[1] = ['tid' => '141', 'name' => 'Compliant'];
$advice_category_options[2] = ['tid' => '161', 'name' => 'Compliant with implementation feedback'];
$advice_category_options[3] = ['tid' => '76', 'name' => 'Non-compliant'];

$params = drupal_get_query_parameters();
if ('All' == $params['field_advice_category_tid'] || !isset($params['field_advice_category_tid'])) {
  $advice_category_options[0]['class'] = 'active';
} elseif ('141' == $params['field_advice_category_tid']) {
  $advice_category_options[1]['class'] = 'active';
} elseif ('161' == $params['field_advice_category_tid']) {
  $advice_category_options[2]['class'] = 'active';
} elseif ('76' == $params['field_advice_category_tid']) {
  $advice_category_options[3]['class'] = 'active';
}
?>

<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($exposed): ?>

      <div class="row">
          <div class="col-lg-12 pb-5">
              <div class="filter mb-5">
                  <ul class="inline block-active-icon font-family3 bold text-uppercase small mb-5">
                    <?php foreach ($advice_category_options as $advice_category_option): ?>
                        <li class="<?php print $advice_category_option['class']; ?>">
                            <a href="?field_advice_category_tid=<?php print $advice_category_option['tid'] ?>"><?php print $advice_category_option['name']; ?></a>
                        </li>
                    <?php endforeach; ?>
                  </ul>

                  <div class="text-right search-options">
                      <form class="search-wrap" action=""
                            method="get" id="views-exposed-form-revoked-and-restricted-permits-page-2"
                            accept-charset="UTF-8">
                          <input type="text"
                                 placeholder="Search agreement clauses"
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

          <?php if ($header): ?>
              <div class="view-header">
                <?php print $header; ?>
              </div>
          <?php endif; ?>
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
          <div class="mt-5"><?php print $pager; ?></div>           
          <?php endif; ?>

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
