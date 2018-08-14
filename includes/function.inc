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
  if (drupal_match_path($current_path_alias, theme_get_setting('page_theme_government'))) {
    return 'theme-government';
  }
  if (drupal_match_path($current_path_alias, theme_get_setting('page_theme_rights'))) {
    return 'theme-rights';
  }
  if (drupal_match_path($current_path_alias, theme_get_setting('page_theme_government'))) {
    return 'theme-government';
  }
  if (drupal_match_path($current_path_alias, theme_get_setting('page_theme_abcc'))) {
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
  // Get terms.
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
        return _taxonomy_autolink_link_create ($term->tid, $match[0]);
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
function _taxonomy_autolink_link_create ($tid, $text) {
  // Return a friendly url path if available.
  $url = drupal_lookup_path('alias', 'taxonomy/term/' . $tid, $lang_code = LANGUAGE_NONE);
  if (empty($url)) {
    $url = 'taxonomy/term/' . $tid;
  }
  return l(check_plain($text), $url, array(
    'html' => TRUE,
    'attributes' => array(
      'class' => array('term-link'),
      'title' => $text,
    ),
  ));
}