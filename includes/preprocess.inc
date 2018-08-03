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
  $ie_script_s = array(
    '#browsers' => array('IE' => 'lt IE 9', '!IE' => FALSE),
    '#tag' => 'script',
    '#attributes' => array(
      'type' => "text/javascript",
      'src' => './' . $variables['path_to_govstrap'] . '/js/modernizr.js',

    ),
  );
  drupal_add_html_head($ie_script_s, "govstrapmodernizr");

  // IE8 support of HTML5 elements and media queries.
  $ie_script_r = array(
    '#browsers' => array('IE' => 'lt IE 9', '!IE' => FALSE),
    '#tag' => 'script',
    '#attributes' => array(
      'type' => "text/javascript",
      'src' => './' . $variables['path_to_govstrap'] . '/js/respond.js',
    ),
  );
  drupal_add_html_head($ie_script_r, "govstraprespond");

  if (theme_get_setting('fontawesome_enabled') && theme_get_setting('fontawesome_css_cdn')) {
    // Add fontawesome CDN file.
    $fontawesome = 'https://use.fontawesome.com/releases/' . theme_get_setting('fontawesome_css_cdn') . '/js/all.js';
    drupal_add_js($fontawesome, array('type' => 'external', 'defer' => TRUE));
  }

  // Accessibility settings.
  $variables['skip_link_anchor'] = check_plain(theme_get_setting('govstrap_skip_link_anchor'));
  $variables['skip_link_text'] = check_plain(theme_get_setting('govstrap_skip_link_text'));

  // Attributes for html element.
  $variables['html_attributes_array'] = array(
    'lang' => $variables['language']->language,
    'dir' => $variables['language']->dir,
  );

  // Return early, so the maintenance page does not call any of the code below.
  if ($hook != 'html') {
    return;
  }

  // Serialize RDF Namespaces into an RDFa 1.1 prefix attribute.
  if ($variables['rdf_namespaces']) {
    $prefixes = array();
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
  if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = 'col-sm-6';
  }
  elseif (!empty($variables['page']['sidebar_first']) || !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = 'col-sm-9';
  }
  else {
    $variables['content_column_class'] = 'col-sm-12';
  }

  // Get the main navigation menu tree limit to $main_menu_max_depth
  $main_menu_max_depth = 3;
  $main_menu_tree = menu_build_tree('menu-site-main-menu', array('max_depth' => $main_menu_max_depth));
  foreach($main_menu_tree as $link_item) {
    if($link_item['link']['link_title']) {
      $link_item_name = _human_to_machine($link_item['link']['link_title']);
      $variables['main_menu_tree'][$link_item_name]['tree'] = menu_tree_output(array($link_item_name => $link_item));
      $variables['main_menu_tree'][$link_item_name]['title'] = $link_item['link']['link_title'];
    }
  }
 dpm($variables['main_menu_tree']);
}

function govstrap_menu_link__menu_site_main_menu($variables) {
  $element     = $variables['element'];
  $description = !empty($element['#localized_options']['attributes']['title']) ? $element['#localized_options']['attributes']['title'] : '';

  $sub_menu = '';
  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }

  if ($description !== '') {
    // Extract extra classes
    _govstrap_menu_extract_extra_classes($element, $description);

    // Extract special title
    if (!($output = _govstrap_menu_extract_special_title($description))) {
      $output = l($element['#title'], $element['#href'], $element['#localized_options']) . $description;
    }
  }
  else {
    $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  }

  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

function govstrap_menu_tree__menu_site_main_menu($variables) {
  //dpm($variables);

  return '<ul class="menu">' . $variables['tree'] . '</ul>';
}

/**
 * Implements hook_preprocess_node().
 */
function govstrap_preprocess_node(&$variables, $hook) {
  // Add a theme hook suggestion for type and view mode.
  $variables['theme_hook_suggestions'][] = 'node__' . $variables['type'] . '__' . $variables['view_mode'];
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

function _govstrap_menu_extract_extra_classes(&$element, &$description) {
  if ($description === '') {
    return;
  }

  $matching_pattern = _govstrap_menu_get_short_code_pattern('extra-classes');

  if ($matches = _govstrap_menu_search_n_replace($matching_pattern, $description)) {
    $classes = explode(' ', $matches[1]);
    if (!empty($classes)) {
      if (!isset($element['#attributes'])) {
        $element['#attributes']['class'] = $classes;
      }
      else {
        if (empty($element['#attributes']['class'])) {
          $element['#attributes']['class'] = $classes;
        }
        elseif (!is_array($element['#attributes']['class'])) {
          $classes[]                       = $element['#attributes']['class'];
          $element['#attributes']['class'] = $classes;
        }
        else {
          $element['#attributes']['class'] = array_merge($element['#attributes']['class'], $classes);
        }
      }
    }
  }
}

function _govstrap_menu_extract_special_title(&$description) {
  $output           = FALSE;
  $matching_pattern = _govstrap_menu_get_short_code_pattern('special-title');

  if ($matches = _govstrap_menu_search_n_replace($matching_pattern, $description)) {
    $output = $matches[1] . $description;
  }
  return $output;
}

function _govstrap_menu_get_short_code_pattern($matching_phrase) {
  $matching_phrase = preg_quote($matching_phrase);
  return "/\[$matching_phrase\]((.|\n)+?)\[\/$matching_phrase\]/";
}

function _govstrap_menu_search_n_replace($matching_pattern, &$content) {
  $matches = [];
  if (preg_match($matching_pattern, $content, $matches)) {
    $content = preg_replace($matching_pattern, '', $content);
  }
  else {
    $matches = FALSE;
  }
  return $matches;
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
  return strtolower(preg_replace(array(
    '/[^a-zA-Z0-9]+/',
    '/-+/',
    '/^-+/',
    '/-+$/',
  ), array('_', '_', '', ''), $human_readable));
}