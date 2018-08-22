<?php

/**
 * @file
 * preprocess.inc
 */

/**
 * Implements hook_preprocess_html().
 * Override or insert variables into the html template.
 *
 * @param $variables
 * @param $hook
 */
function govstrap_preprocess_html(&$variables, $hook) {

  // Set common variables.
  $variables['base_path'] = base_path();
  $variables['path_to_govstrap'] = drupal_get_path('theme', 'govstrap');

  // Send X-UA-Compatible HTTP header to force IE to use the most recent
  // rendering engine or use Chrome's frame rendering engine if available.
  if (is_null(drupal_get_http_header('X-UA-Compatible'))) {
    drupal_add_http_header('X-UA-Compatible', 'IE=edge');
  }

  // IE8 support of HTML5 elements and media queries .
  $ie_script_s = [
    '#browsers' => ['IE' => 'lt IE 9', '!IE' => FALSE],
    '#tag' => 'script',
    '#attributes' => [
      'type' => "text/javascript",
      'src' => './' . $variables['path_to_govstrap'] . '/js/modernizr.js',

    ],
  ];
  drupal_add_html_head($ie_script_s, "govstrapmodernizr");

  // IE8 support of HTML5 elements and media queries.
  $ie_script_r = [
    '#browsers' => ['IE' => 'lt IE 9', '!IE' => FALSE],
    '#tag' => 'script',
    '#attributes' => [
      'type' => "text/javascript",
      'src' => './' . $variables['path_to_govstrap'] . '/js/respond.js',
    ],
  ];
  drupal_add_html_head($ie_script_r, "govstraprespond");

  if (theme_get_setting('fontawesome_enabled') && theme_get_setting('fontawesome_css_cdn')) {
    // Add fontawesome CDN file.
    $fontawesome = 'https://use.fontawesome.com/releases/' . theme_get_setting('fontawesome_css_cdn') . '/js/all.js';
    drupal_add_js($fontawesome, ['type' => 'external', 'defer' => TRUE]);
  }

  // Accessibility settings.
  $variables['skip_link_anchor'] = check_plain(theme_get_setting('govstrap_skip_link_anchor'));
  $variables['skip_link_text'] = check_plain(theme_get_setting('govstrap_skip_link_text'));

  // Attributes for html element.
  $variables['html_attributes_array'] = [
    'lang' => $variables['language']->language,
    'dir' => $variables['language']->dir,
  ];

  // Return early, so the maintenance page does not call any of the code below.
  if ($hook != 'html') {
    return;
  }

  // Serialize RDF Namespaces into an RDFa 1.1 prefix attribute.
  if ($variables['rdf_namespaces']) {
    $prefixes = [];
    foreach (explode("\n  ", ltrim($variables['rdf_namespaces'])) as $namespace) {
      // Remove xlmns: and ending quote and fix prefix formatting.
      $prefixes[] = str_replace('="', ': ', substr($namespace, 6, -1));
    }
    $variables['rdf_namespaces'] = ' prefix="' . implode(' ', $prefixes) . '"';
  }

  // Add active page theme class to <body> if available.
  $variables['classes_array'][] = _abcc_get_active_page_theme();
}

/**
 * Implements hook_preprocess_page().
 *
 * @param $variables
 *
 * @see page.tpl.php
 */
function govstrap_preprocess_page(&$variables) {

  // Add pathToTheme to Drupal.settings in JS.
  drupal_add_js('jQuery.extend(Drupal.settings, { "pathToTheme": "' . path_to_theme() . '" });', 'inline');

  // Theme suggestions.
  $header = drupal_get_http_header("status");
  if ($header === "404 Not Found") {
    $variables['theme_hook_suggestions'][] = 'page__404';
  }
  if ($header === "403 Forbidden") {
    $variables['theme_hook_suggestions'][] = 'page__403';
  }

  // Set page container columns.
  $variables['container_class'] = 'container';

  // Calculate container columns with sidebar.
  if (!empty($variables['page']['sidebar_right'])) {
    $variables['content_column_class'] = 'col-lg-8';
  }
  else {
    $variables['content_column_class'] = 'col-lg-12 pl-2 pr-2';
  }

  // Get the main navigation menu tree limit to $main_menu_max_depth

  $main_menu_max_depth = 2;
  $main_menu_tree = menu_build_tree('menu-site-main-menu', ['max_depth' => $main_menu_max_depth]);
  foreach ($main_menu_tree as $link_item) {
    if ($link_item['link']['link_title']) {
      $link_item_name = _human_to_machine($link_item['link']['link_title']);
      $link_item_path = drupal_get_path_alias($link_item['link']['link_path']);
      $variables['main_menu_tree'][$link_item_name]['tree'] = menu_tree_output([$link_item_name => $link_item]);
      $variables['main_menu_tree'][$link_item_name]['title'] = $link_item['link']['link_title'];
      $variables['main_menu_tree'][$link_item_name]['path'] = $link_item_path;
    }
  }

  $variables['active_page_parent'] = _get_active_page_parent();

  // Set title and breadcrumbs on dynamically generated glossary pages
  if (in_array('page__glossary__content', $variables['theme_hook_suggestions'])) {
    $arguments = arg();
    if ($arguments[4]) {
      drupal_set_title($arguments[4]);
    }
  }

}

/**
 * Implements more specific callback to theme_menu_link().
 */
function govstrap_menu_link__menu_site_main_menu($variables) {
  $element = $variables['element'];
  $description = !empty($element['#localized_options']['attributes']['title']) ? $element['#localized_options']['attributes']['title'] : '';

  $sub_menu = '';
  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }

  if (!isset($output)) {
    $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  }

  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Implements more specific callback to theme_menu_tree().
 */
function govstrap_menu_tree__menu_site_main_menu($variables) {
  return '<ul class="menu">' . $variables['tree'] . '</ul>';
}

/**
 * Implements hook_preprocess_node().
 */
function govstrap_preprocess_node(&$variables, $hook) {
  // Add a theme hook suggestion for type and view mode.
  $variables['theme_hook_suggestions'][] = 'node__' . $variables['type'] . '__' . $variables['view_mode'];
  // Link taxonomy terms appearing in the body section
  $variables['content']['body'][0]['#markup'] = _taxonomy_autolink_add_links($variables['content']['body'][0]['#markup']);
}

/**
 * Implements hook_preprocess_block().
 */
function govstrap_preprocess_block(&$variables, $hook) {
  // Use a template with no wrapper for the page's main content.
  if ($variables['block_html_id'] == 'block-system-main') {
    $variables['theme_hook_suggestions'][] = 'block__no_wrapper';
  }

  $variables['title_attributes_array']['class'][] = 'block-title';

  // Block template per bean type.
  if ($variables['block']->module === 'bean') {
    $beans = $variables['elements']['bean'];
    $bean_keys = element_children($beans);
    $bean = $beans[reset($bean_keys)];
    // Add template suggestions for bean types.
    $variables['theme_hook_suggestions'][] = 'block__bean__' . $bean['#bundle'];
  }
}

/*************************Helper Functions****************************/

/**
 * Helper function to truncate the menu render tree to specific level
 *
 * @param array &$tree
 *   Menu tree render array from menu tree build.
 *
 * @param int $max_level
 *   Maximum level to keep. 0 - only keep current level, 1 - keep 1 level down,
 *   2 - ....
 *
 */
function govstrap_menu_get_max_level_sub_tree(&$tree, $max_level) {

  if (empty($tree)) {
    return;
  }

  $max_level = (int) $max_level;

  if ($max_level < 0) {
    return;
  }

  $children = _govstrap_menu_tree_get_tree_children($tree);

  if (empty($children)) {
    return;
  }

  if ($max_level === 0) {
    foreach ($children as $child_key) {
      unset($tree[$child_key]['#below']);
    }
    return;
  }
  else {
    foreach ($children as $child_key) {
      govstrap_menu_get_max_level_sub_tree($tree[$child_key]['#below'], ($max_level - 1));
    }
  }
}

/**
 * Helper function to only keep the current level of menu render tree
 *
 * @param array $tree
 *   Menu tree render array from menu tree build.
 *
 * @return array new tree. If any errors happen, the original tree will be
 *   returned
 */
function govstrap_menu_tree_no_root($tree) {
  $root_keys = _govstrap_menu_tree_get_tree_children($tree);

  if (empty($root_keys)) {
    return $tree;
  }

  $result = [];

  foreach ($root_keys as $child_key) {
    $result = array_merge($result, $tree[$child_key]['#below']);
  }

  return $result;
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
      return '<a href="'.$parent['link_path'].'"><i class="fal fa-arrow-left"></i>Back to ' . $parent['link_title'] . '</a>';
    }
  }
  return NULL;
}