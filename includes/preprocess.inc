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

  $node = menu_get_object();
  if ($node->type) {
    $variables['theme_hook_suggestions'][] = 'html__' . $node->type;
  }

  // Set common variables.
  $variables['base_path']        = base_path();
  $variables['path_to_govstrap'] = drupal_get_path('theme', 'govstrap');

  // Send X-UA-Compatible HTTP header to force IE to use the most recent
  // rendering engine or use Chrome's frame rendering engine if available.
  if (is_null(drupal_get_http_header('X-UA-Compatible'))) {
    drupal_add_http_header('X-UA-Compatible', 'IE=edge');
  }

  // IE8 support of HTML5 elements and media queries .
  $ie_script_s = [
    '#browsers'   => ['IE' => 'lt IE 9', '!IE' => FALSE],
    '#tag'        => 'script',
    '#attributes' => [
      'type' => "text/javascript",
      'src'  => './' . $variables['path_to_govstrap'] . '/js/modernizr.js',

    ],
  ];
  drupal_add_html_head($ie_script_s, "govstrapmodernizr");

  // IE8 support of HTML5 elements and media queries.
  $ie_script_r = [
    '#browsers'   => ['IE' => 'lt IE 9', '!IE' => FALSE],
    '#tag'        => 'script',
    '#attributes' => [
      'type' => "text/javascript",
      'src'  => './' . $variables['path_to_govstrap'] . '/js/respond.js',
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
  $variables['skip_link_text']   = check_plain(theme_get_setting('govstrap_skip_link_text'));

  // Attributes for html element.
  $variables['html_attributes_array'] = [
    'lang' => $variables['language']->language,
    'dir'  => $variables['language']->dir,
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

  // Add wizard class to the body tag
  if ($variables['page']['wizard']['bean_eligibility-wizard'] || $variables['page']['wizard']['bean_sub-contractor-wizard']) {
    $variables['classes_array'][] = 'has-wizard-button';
  }

}

/**
 * Implements hook_preprocess_page().
 *
 * @param $variables
 *
 * @see page.tpl.php
 */
function govstrap_preprocess_page(&$variables) {

  if (arg(0) == 'node') {
    $variables['node_content'] =& $variables['page']['content']['system_main']['nodes'][arg(1)];
  }

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
  if (isset($variables['node']->type)) {
    $variables['theme_hook_suggestions'][] = 'page__' . $variables['node']->type;
    $variables['theme_hook_suggestions'][] = 'page__' . $variables['node']->type . '__' . arg(1);
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
  $main_menu_tree      = menu_build_tree('menu-site-main-menu', ['max_depth' => $main_menu_max_depth]);
  foreach ($main_menu_tree as $link_item) {
    if ($link_item['link']['link_title']) {
      $link_item_name                                        = _human_to_machine($link_item['link']['link_title']);
      $link_item_path                                        = drupal_get_path_alias($link_item['link']['link_path']);
      $variables['main_menu_tree'][$link_item_name]['tree']  = menu_tree_output([$link_item_name => $link_item]);
      $variables['main_menu_tree'][$link_item_name]['title'] = $link_item['link']['link_title'];
      $variables['main_menu_tree'][$link_item_name]['path']  = $link_item_path;
    }
  }

  $variables['active_page_parent'] = _get_active_page_parent();

  $variables['active_page_root'] = _get_active_page_root();

  // Set title and breadcrumbs on dynamically generated glossary pages
  if (in_array('page__glossary__content', $variables['theme_hook_suggestions'])) {
    $arguments = arg();
    if ($arguments[3] && $loaded_glossary_term = taxonomy_term_load($arguments[3])) {
      $variables['title'] = $loaded_glossary_term->name;
    }
  }
}

/**
 * Implements hook_preprocess_node().
 */
function govstrap_preprocess_node(&$variables, $hook) {

  // Add a theme hook suggestion for type and view mode.
  $variables['theme_hook_suggestions'][] = 'node__' . $variables['type'] . '__' . $variables['view_mode'];

  $current_path       = current_path();
  $current_path_alias = drupal_lookup_path('alias', $current_path);

  if ($current_path_alias) {
    $current_path = $current_path_alias;
  }

  if (!drupal_match_path($current_path, theme_get_setting('path_excluded_auto_linking'))) {
    // Link taxonomy terms appearing in the body section
    $variables['content']['body'][0]['#markup'] = _taxonomy_autolink_add_links($variables['content']['body'][0]['#markup']);
  }

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
    $beans     = $variables['elements']['bean'];
    $bean_keys = element_children($beans);
    $bean      = $beans[reset($bean_keys)];
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

function govstrap_preprocess_views_view(&$vars) {
  $function_name = '_' . __FUNCTION__ . '__' . $vars['view']->name . '__' . $vars['view']->current_display;
  if (function_exists($function_name)) {
    $function_name($vars);
  }
  else {
    $function_name = __FUNCTION__ . '__' . $vars['view']->name;
    if (function_exists($function_name)) {
      $function_name($vars);
    }
  }
}

function _govstrap_preprocess_views_view__abcc_glossary_index_of_all_terms___page(&$vars) {
  _govstrap_views_add_alphas($vars, 'name_1');
}

function _govstrap_views_add_alphas(&$vars, $alpha_field_id) {

  if (!isset($vars['view'])) {
    return FALSE;
  }
  else {
    $view = $vars['view'];
  }

  $alphas             = drupal_map_assoc(range('a', 'z'), function ($element) {
    return ['value' => $element, 'has_item' => FALSE];
  });
  $display_all_alphas = TRUE;

  if (!empty($view->style_plugin->rendered_fields)) {
    foreach ($view->style_plugin->rendered_fields as $rendered_field) {
      if (!isset($rendered_field[$alpha_field_id])) {
        continue;
      }

      if ($display_all_alphas){
        $display_all_alphas = FALSE;
      }

      $current_result_key = drupal_strtolower($rendered_field[$alpha_field_id]);

      if (isset($alphas[$current_result_key])) {
        if ($alphas[$current_result_key]['has_item']){
          continue;
        }else{
          $alphas[$current_result_key]['has_item'] = TRUE;
        }
      }else{
        $alphas = [$current_result_key => ['value' => $current_result_key, 'has_item' => TRUE,]] + $alphas;
      }
    }
  }

  $vars['alphas'] = $alphas;
  $vars['display_all_alphas'] = $display_all_alphas;
}