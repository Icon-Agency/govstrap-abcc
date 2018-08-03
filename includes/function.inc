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