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
$params = drupal_get_query_parameters();
$content_type_options = array();
$content_type_options[] = ['option' => 'All', 'name' => 'All'];
$content_type_options[] = ['option' => 'article', 'name' => 'News'];
$content_type_options[] = ['option' => 'publication', 'name' => 'Publication'];
$content_type_options[] = ['option' => 'newsletter', 'name' => 'Newsletter'];
if (strtolower($params['type']) == 'all') {
  $content_type_options[0]['class'] = 'active';
}
?>

<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <?php if ($header): ?>
      <div class="view-header">
        <?php print $header; ?>
      </div>
  <?php endif; ?>

  <?php if ($exposed): ?>

      <div class="row">
          <div class="col-lg-12 pb-5">
              <div class="filter mb-5">
                  <ul class="inline block-active-icon font-family3 bold text-uppercase small mb-5">
                    <?php foreach ($content_type_options as $content_type_option): ?>
                        <?php
                            if ($params['type']) {
                              if (strtolower($params['type']) == $content_type_option['option']) {
                                $content_type_option['class'] = 'active';
                              }
                            } else {
                              if ($content_type_option['option'] == 'All') {
                                $content_type_option['class'] = 'active';
                              }
                            }
                        ?>
                        <li class="<?php print $content_type_option['class']; ?>">
                            <a href="?type=<?php print $content_type_option['option'] ?>"><?php print $content_type_option['name']; ?></a>
                        </li>
                    <?php endforeach; ?>
                  </ul>
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
            <div class="glossary">
              <?php if ($rows): ?>
                  <div class="view-content">
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
        </div>

        <div class="col-lg-3 offset-lg-1">
          <?php print views_embed_view('abcc_glossary_term_page_and_block_', 'block'); ?>
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
