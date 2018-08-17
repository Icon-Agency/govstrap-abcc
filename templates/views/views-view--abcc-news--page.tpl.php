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
$vocabulary = taxonomy_vocabulary_machine_name_load('category');
$terms = entity_load('taxonomy_term', FALSE, array('vid' => $vocabulary->vid));
$news_type_options = array();
$news_type_options[] = array ('tid' => 'All', 'name' => 'All');
foreach ($terms as $term) {
  $option_class = '';
  if ($params['field_category']) {
    if ($term->tid == $params['field_category']) {
      $option_class = 'active';
    }
    $news_type_options[] = array ('tid' => $term->tid, 'name' => $term->name, 'class' => $option_class);
  } else {
    $news_type_options[0]['class'] = 'active';
    $news_type_options[] = array ('tid' => $term->tid, 'name' => $term->name, 'class' => $option_class);
  }
}
if ('All' == $params['field_category']) {
  $news_type_options[0]['class'] = 'active';
}

usort($news_type_options,"arrcmp");

function arrcmp($a, $b) {
  return $a['tid'] - $b['tid'];
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
                      <?php foreach ($news_type_options as $news_type_option): ?>
                          <li class="<?php print $news_type_option['class'];?>">
                              <a href="?field_category=<?php print $news_type_option['tid']?>"><?php print $news_type_option['name'];?></a>
                          </li>
                      <?php endforeach; ?>
                  </ul>

                  <div class="text-right search-options">
                      <form class="search-wrap" action="/news-and-media" method="get" id="views-exposed-form-abcc-news-page" accept-charset="UTF-8">
                          <input type="text" placeholder="Search News &amp; Media" id="edit-search-api-views-fulltext" name="search_api_views_fulltext" value="" size="30" maxlength="128" class="form-text ctools-auto-submit-processed">
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
            <div class="news">
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
            <div class="row">
                <div class="col-lg-12 col-sm-6">
                    <a href="#" class="block mb-5">
                        <img src="/<?php print path_to_theme(); ?>/images/sp-subscribe-mini.jpg" class="img-fluid">
                    </a>
                </div>
                <div class="col-lg-12 col-sm-6">
                  <?php if ($footer): ?>
                      <div class="view-footer">
                        <?php print $footer; ?>
                      </div>
                  <?php endif; ?>
                </div>
            </div>
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
