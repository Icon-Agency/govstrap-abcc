<?php

/**
 * @file
 * function.inc
 *
 * Theme helper functions
 */
function _abcc_get_active_page_theme() {
  $current_path = current_path();
  $current_path_alias = drupal_lookup_path('alias', $current_path);

  if($current_path_alias) {
    $current_path = $current_path_alias;
  }

  if (drupal_match_path($current_path, theme_get_setting('page_theme_government'))) {
    return 'theme-government';
  }
  if (drupal_match_path($current_path, theme_get_setting('page_theme_rights'))) {
    return 'theme-rights';
  }
  if (drupal_match_path($current_path, theme_get_setting('page_theme_worker'))) {
    return 'theme-worker';
  }
  if (drupal_match_path($current_path, theme_get_setting('page_theme_abcc'))) {
    return 'theme-abcc';
  }
  return 'theme-abcc';
}

/**
 * Implements callback_filter_process().
 * Taxonomy autolink filter process callback.
 */
function _taxonomy_autolink_add_links ($text) {

  // Get vocabularies
  $vocabs = theme_get_setting('taxonomy_autolink_vocabs');
  if (!$vocabs) {
    return $text;
  }
  // Get terms. We don't want to use Drupal's entity_load function so we can
  // load multiple vocabs in one query and be a lot more efficient.
  $result = db_query("SELECT tid, name, LOWER(name) AS name_lower FROM {taxonomy_term_data} WHERE vid IN (:vids)", array(':vids' => $vocabs));
  $terms = $result->fetchAllAssoc('name');

  // Process text.
  if (count($terms) > 0) {
    $configs = array(
      'mode' =>  theme_get_setting('taxonomy_autolink_mode') ? theme_get_setting('taxonomy_autolink_mode') : 0,
      'limit' => theme_get_setting('taxonomy_autolink_limit') ? theme_get_setting('taxonomy_autolink_limit') : 1,
      'case' => theme_get_setting('taxonomy_autolink_case_sensitivity')? theme_get_setting('taxonomy_autolink_case_sensitivity') : 0,
    );
    return _taxonomy_autolink_links($text, $terms, $configs);
  }
  else {
    // Return default text.
    return $text;
  }
}

/**
 * Parse content.
 * @param $text
 * @param $terms
 * @param $type
 * @param $configs
 * @return mixed
 */
function _taxonomy_autolink_links($text, $terms, $configs = array()) {
  // Read configs.
  $limit = $configs['limit'];
  // Start processing.
  foreach ($terms as $term_name => $term) {

    $rule = _taxonomy_autolink_links_rule($term_name, $configs);
    $text = preg_replace_callback($rule, function ($match) use ($term) {
      if (!empty($match[0])) {
        // Load synonyms
        $result = db_query("SELECT field_synonyms_value FROM {field_data_field_synonyms} WHERE entity_id = $term->tid");
        $synonyms = $result->fetchAllAssoc('field_synonyms_value');
        $synonyms_string = '';
        foreach ($synonyms as $synonym) {
          $synonyms_string .= ' '.$synonym->field_synonyms_value;
        }
        return _taxonomy_autolink_link_create ($term->tid, $match[0], $synonyms_string);
      }
    }, $text, $limit);
  }

  return $text;
}

/**
 * @param $word
 * @param array $configs
 * @return string
 */
function _taxonomy_autolink_links_rule($needle, $configs = array()) {
  $case = isset($configs['case']) ? $configs['case'] : 0;
  $mode = isset($configs['mode']) ? $configs['mode'] : 0;
  $rule = '';
  // @todo Allow user to define this number.
  if (strlen($needle) > 150) {
    $needle = substr($needle, 0, strpos(wordwrap($needle, 150), "\n"));
  }
  // Quote regular expression characters.
  $needle = preg_quote($needle, '/');
  switch ($mode) {
    case 0:
      $rule = '/(?<=\s|^|<li>)' . $needle . '(?=\s|$|\<|<\/li>)/';
      break;
    case 1:
      $rule = '/(?<=\s|^|<li>)\b(' . $needle . '[ieds]*)\b(?=\s|$|\<|<\/li>)/';
      break;
  }
  // If case not sensitive, set to lowercase.
  if ($case === 0) {
    $rule .= 'i';
  }
  return $rule;
}

/**
 * Render taxonomy autolink term link.
 * @param $variables
 * @return string
 */
function _taxonomy_autolink_link_create ($tid, $text, $synonyms) {
  $term = taxonomy_term_load($tid);
  $term = $term->name;
  // We want to point the link to the glossary auto-search page
  $url = 'glossary/content/'.$text.$synonyms.'/'.$tid.'/'.$term;
  return l(check_plain($text), $url, array(
    'html' => TRUE,
    'attributes' => array(
      'class' => array('term-link'),
      'title' => $text,
    ),
  ));
}


/**
 * Theme function to render social buttons.
 */
function _social_share_buttons() {
  global $base_url;

  $path = drupal_get_path('module', 'socbutt');

  $current_url = $base_url . '/' . request_path();

  // Preparing default sharing data.
  $share_data = array(
    'title' => drupal_get_title(),
    'url' => $current_url,
  );

  // URL encode so the strings can be used inside URLs;
  foreach ($share_data as $key => $data) {
    $share_data[$key] = rawurlencode($data);
  }

  $title   = $share_data['title'];
  $url     = $share_data['url'];
  $link_classes = array('body-color', 'theme-color-hover', 'no-decoration', 'large mr-3');

  // Prepare render array.
  $render_array = array(
    '#prefix' => '<div class="share-links">',
    '#suffix' => '</div>',
  );

  // Link for email.
  $link = "mailto:?subject=$title&body=Read on the ABCC website: $url";
  $text = '<span class="fas fa-envelope"></span><span class="sr-only">'. t('Email').'</span>';
  $render_array['email'] = array(
    '#markup' => l($text, $link, array(
      'html' => TRUE,
      'attributes' => array(
        'class' => $link_classes,
      )
    )),
  );

  // Social share group
  /*
  $link = "#";
  $text = '<span class="fas fa-share"></span><span class="sr-only">' . t('Social media').'</span>';
  $render_array['socials'] = array(
    '#markup' => l($text, $link, array(
      'html' => TRUE,
      'attributes' => array(
        'target' => '_blank',
        'class' => $link_classes,
      )
    )),
  );
  */

  // Facebook share.
  $link = "https://www.facebook.com/sharer/sharer.php?u=$url";
  $text = '<span class="fab fa-facebook"></span><span class="sr-only">' . t('Facebook').'</span>';
  $render_array['facebook'] = array(
    '#prefix' => '<span class="share-links-social">',
    '#markup' => l($text, $link, array(
      'html' => TRUE,
      'attributes' => array(
        'target' => '_blank',
        'class' => $link_classes,
      )
    )),
  );

  // Twitter share.
  $twitter_msg = $title . ' -'; // Twitter adds the $url after this automatically.
  $link = "https://twitter.com/intent/tweet?text=$twitter_msg&url=$url";
  $text = '<span class="fab fa-twitter"></span><span class="sr-only">' . t('Twitter').'</span>';
  $render_array['twitter'] = array(
    '#markup' => l($text, $link, array(
      'html' => TRUE,
      'attributes' => array(
        'target' => '_blank',
        'class' => $link_classes,
      )
    )),
  );

  // Google Plus share:
  /* Who cares about Google Plus???
  $link = "https://plus.google.com/share?url=$url";
  $text = '<span class="fab fa-google-plus-square"></span><span class="sr-only">'. t('Google Plus').'</span>';
  $render_array['gplus'] = array(
    '#markup' => l($text, $link, array(
      'html' => TRUE,
      'attributes' => array(
        'target' => '_blank',
        'class' => $link_classes,
      )
    )),
  );
  */

  // LinkedIn share.
  $link = "https://www.linkedin.com/shareArticle?mini=true&url=$url&title=$title&summary=$body&source=$url";
  $text = '<span class="fab fa-linkedin"></span><span class="sr-only">' . t('LinkedIn').'</span>';
  $render_array['linkedin'] = array(
    '#suffix' => "</span>",
    '#markup' => l($text, $link, array(
      'html' => TRUE,
      'attributes' => array(
        'target' => '_blank',
        'class' => $link_classes,
      )
    )),
  );

  // Render.
  return $render_array;
}

function _get_card_theme ($category) {
  $category = trim(strtolower($category));
  switch($category) {
    default:
    case 'media release':
      $card_class = 'card-abcc';
      break;
    case 'e-alert':
      $card_class = 'card-rights';
      break;
    case 'statement':
    case 'transcript':
      $card_class = 'card-government';
      break;
    case 'media backgrounder':
      $card_class = 'card-worker';
      break;
  }
  return $card_class;
}

function array_cmp($a, $b) {
  return $a['tid'] - $b['tid'];
}


/**
 * Helper internal function to extract array keys of tree's direct actual
 * children from menu tree render array
 *
 * @param array $tree
 *   Menu tree render array from menu tree build.
 *
 * @return array current tree's direct children's array keys
 */
function _govstrap_menu_tree_get_tree_children($tree) {
  $result = [];
  $children = element_children($tree);
  if (!empty($children)) {
    foreach ($children as $key) {
      if (isset($tree[$key]['#below'])) {
        $result[] = $key;
      }
    }
  }
  return $result;
}

/**
 * Helper that generates a machine name using a provided human readable name.
 *
 * @param string $human_name
 *   Human readable name.
 *
 * @return string
 *   Machine name cleaned-up of any special chars.
 */
function _human_to_machine($human_readable) {
  return strtolower(preg_replace([
    '/[^a-zA-Z0-9]+/',
    '/-+/',
    '/^-+/',
    '/-+$/',
  ], ['_', '_', '', ''], $human_readable));
}

/**
 * Helper that finds current page's active parent in the menu
 */
function _get_active_page_parent() {
  $active_trail = menu_get_active_trail();
  if ($active_trail) {
    end($active_trail);
    $parent = prev($active_trail);
    if ($parent['link_path']) {
      return $parent;
    }
  }
  return NULL;
}

/**
 * Helper that finds current page's active parent in the menu
 */
function _get_active_page_root() {
  $active_trail = menu_get_active_trail();
  if ($active_trail[1]) {
    return $active_trail[1];
  }
  return NULL;
}

function get_main_nav_sub_menu_tree($menu_tree, $item_name, $active_page_root) {
  $new_sub_menu_tree =  govstrap_menu_tree_no_root($menu_tree[$item_name]['tree']);
  govstrap_menu_get_max_level_sub_tree($new_sub_menu_tree, 0);
  $sub_menu_tree['markup'] = render($new_sub_menu_tree);
  $sub_menu_tree['active_class'] = '';
  if ($active_page_root['link_title'] == $menu_tree[$item_name]['title']) {
    $sub_menu_tree['active_class'] = 'active';
  }
  return $sub_menu_tree;
}