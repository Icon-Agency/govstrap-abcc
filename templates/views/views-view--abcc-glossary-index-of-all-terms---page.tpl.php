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
                <?php if (isset($alphas) && isset($display_all_alphas)): ?>
                    <ul class="inline glossary-list font-family3 bold text-uppercase mb-5">
                      <?php foreach ($alphas as $alpha => $alpha_value): ?>
                      <?php if($display_all_alphas || $alpha_value['has_item']):?>
                          <li>
                              <a href="#section-<?php print $alpha_value['value']; ?>"><?php print $alpha_value['value']; ?></a>
                          </li>
                          <?php else:?>
                              <li class="has-no-items">
                                  <p><?php print $alpha_value['value']; ?></p>
                              </li>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                  <div class="text-right search-options">
                      <form class="search-wrap" action=""
                            method="get" id="views-exposed-form-glossary-page"
                            accept-charset="UTF-8">
                          <input type="text"
                                 placeholder="Search glossary"
                                 id="edit-search-search"
                                 name="search" value=""
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
        <div class="col-lg-12 mb-5">
          <?php if ($rows): ?>
              <div class="view-content">
                <?php print $rows; ?>
              </div>
          <?php elseif ($empty): ?>
              <div class="view-empty">
                <?php print $empty; ?>
              </div>
          <?php endif; ?>
        </div>
    </div>

  <?php if ($pager): ?>
    <?php print $pager; ?>
  <?php endif; ?>

  <?php if ($attachment_after): ?>
      <div class="attachment attachment-after">
        <?php print $attachment_after; ?>
      </div>
  <?php endif; ?>

  <?php if ($more): ?>
    <?php print $more; ?>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
      <div class="feed-icon">
        <?php print $feed_icon; ?>
      </div>
  <?php endif; ?>

</div><?php /* class view */ ?>
