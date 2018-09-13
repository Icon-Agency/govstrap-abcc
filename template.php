<?php

/**
 * @file
 * template.php
 */

// Auto-rebuild the theme registry during theme development.
if (theme_get_setting('govstrap_rebuild_registry') && !defined('MAINTENANCE_MODE')) {
  // Rebuild .info data.
  system_rebuild_theme_data();
  // Rebuild theme registry.
  drupal_theme_rebuild();
}

/**
 * Implements HOOK_theme().
 */
function govstrap_theme(&$existing, $type, $theme, $path) {
  include_once './' . drupal_get_path('theme', 'govstrap') . '/includes/registry.inc';

  return _govstrap_theme($existing, $type, $theme, $path);
}

/**
 * Clear any previously set element_info() static cache.
 *
 * If element_info() was invoked before the theme was fully initialized, this
 * can cause the theme's alter hook to not be invoked.
 *
 * @see https://www.drupal.org/node/2351731
 */
drupal_static_reset('element_info');

/**
 * Include helper functions.
 */
include_once './' . drupal_get_path('theme', 'govstrap') . '/includes/function.inc';

/**
 * Include hook_preprocess_*() hooks.
 */
include_once './' . drupal_get_path('theme', 'govstrap') . '/includes/preprocess.inc';

/**
 * Include hook_process_*() hooks.
 */
include_once './' . drupal_get_path('theme', 'govstrap') . '/includes/process.inc';

/**
 * Include hook_*_alter() hooks.
 */
include_once './' . drupal_get_path('theme', 'govstrap') . '/includes/alter.inc';

/**
 * Include normal theme overwrite.
 */
include_once './' . drupal_get_path('theme', 'govstrap') . '/includes/theme.inc';

// NEWSLETTER SIGNUP FORM (Subcribe to Campaign Monitor)
if (strlen(@$_POST['form_id'])) {
  if (@$_POST['form_id'] == 'webform_client_form_' . theme_get_setting('abcc_newsletter_signup_form')) {
    $cmstate = trim($_POST["submitted"]["state"]);
    $cmemail = trim($_POST["submitted"]["email"]);
    if (preg_match("/^[a-zA-Z0-9\.\_\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/", $cmemail)) {
      $cm_api_key = theme_get_setting('abcc_newsletter_cm_api_key');
      $cm_list_id = theme_get_setting('abcc_newsletter_cm_api_list_id');

      if (strlen($cm_api_key) && strlen($cm_list_id)) {

        // Add subscriber using Campaignmonitor's API
        require_once 'lib/campaignmonitor/csrest_subscribers.php';

        $auth = array(
          'api_key' => $cm_api_key,
        );
        $wrap = new CS_REST_Subscribers($cm_list_id, $auth);
        $result = $wrap->add(array(
          'EmailAddress' => $cmemail,
          'CustomFields' => array(
            array(
              'Key' => 'State',
              'Value' => $cmstate
            ),
          ),
        ));

        if ($result->was_successful()) {
          drupal_set_message('You have successfully signed up for our newsletter', $type = 'status');
          $_SESSION['newsletter_signup_action'] = 'success';
        } else {
          drupal_set_message($result->response->Message, $type = 'error');
        }
      }
    }
  }
}
