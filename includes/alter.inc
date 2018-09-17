<?php

/**
 * @file
 * alter.inc
 */

/**
 * Implements hook_css_alter().
 */
function govstrap_css_alter(&$css) {
  // Exclude css
  if (!empty($excludes)) {
    $css = array_diff_key($css, drupal_map_assoc($excludes));
  }
}

/**
 * Implements hook_js_alter().
 */
function govstrap_js_alter(&$js) {
  $theme_path = drupal_get_path('theme', 'govstrap');

  // Ensure jQuery Once is always loaded.
  // @see https://drupal.org/node/2149561
  if (empty($js['misc/jquery.once.js'])) {
    $jquery_once = drupal_get_library('system', 'jquery.once');
    $js['misc/jquery.once.js'] = $jquery_once['js']['misc/jquery.once.js'];
    $js['misc/jquery.once.js'] += drupal_js_defaults('misc/jquery.once.js');
  }

  // Replace jQuery with higher version.
  if (theme_get_setting('jquery_replace_enabled')) {
    // jQuery update.
    $node_admin_paths = array(
      'node/*/edit',
      'node/add',
      'node/add/*',
      'panels/*',
      'ctools/*'
    );
    $replace_jquery = TRUE;
    if (path_is_admin(current_path())) {
      $replace_jquery = FALSE;
    }
    else {
      foreach ($node_admin_paths as $node_admin_path) {
        if (drupal_match_path(current_path(), $node_admin_path)) {
          $replace_jquery = FALSE;
        }
      }
    }
    // Swap out jQuery to use an updated version of the library.
    if ($replace_jquery) {
      $js['misc/jquery.js']['data'] = $theme_path . '/js/jquery.min.js';
      // Relace version.
      $js['misc/jquery.js']['version'] = '3.3.1';
    }
  }

  // Exclude js
  if (!empty($excludes)) {
    $js = array_diff_key($js, drupal_map_assoc($excludes));
  }
}

/**
 * Implements hook_js_callback_filter_xss_alter().
 */
function govstrap_js_callback_filter_xss_alter(array &$allowed_tags = array()) {
  $allowed_tags[] = 'button';
}

/**
 * Search block form alter.
 */
function govstrap_form_alter(&$form, &$form_state, $form_id) {

  if ($form_id == 'webform_client_form_'.theme_get_setting('abcc_newsletter_signup_form')) {
    $form['#submit'][0] = 'govstrap_industry_update_subscribe_submit';
  }

  if ($form_id == 'search_block_form') {
    // Update search keys filed attributes.
    $form['search_block_form']['#attributes']['title'] = 'Search';
    $form['search_block_form']['#attributes']['class'][] = 'form-control';
    $form['search_block_form']['#attributes']['placeholder'] = t('Find what you\'re looking for...');
    $form['search_block_form']['#attributes']['autocomplete'] = 'off';
    // Update submit button style.
    $form['actions']['submit']['#value'] = decode_entities('');
    $form['actions']['submit']['#attributes']['aria-label'] = 'Search';
    $form['#submit'][0] = 'govstrap_search_block_form_submit';
  }

  if ($form_id == 'search_api_page_search_form') {
    $form['form']['keys_7']['#title_display'] = 'none';
    $form['form']['keys_7']['#attributes']['class'][] = 'form-control';
    $form['form']['keys_7']['#attributes']['placeholder'] = t('Find what you\'re looking for...');
    $form['form']['submit_7']['#value'] = decode_entities('') . ' Search';
  }
}

function govstrap_search_block_form_submit($form, &$form_state) {
  $keys = $form_state['values']['search_block_form'];
  if (empty($keys)) {
    form_set_error('keys', t('Please enter some keywords.'));
  } else {
    $form_state['redirect'] = array('/search/'.$keys);
  }
}

function govstrap_industry_update_subscribe_submit($form, &$form_state) {

  $cmstate = $form_state["values"]["submitted"]["state"];
  $cmemail = $form_state["values"]["submitted"]["email"];

  $cm_api_key = theme_get_setting('abcc_newsletter_cm_api_key');
  $cm_list_id = theme_get_setting('abcc_newsletter_cm_api_list_id');

  if (strlen($cm_api_key) && strlen($cm_list_id)) {

    // Add subscriber using Campaignmonitor's API
    require_once path_to_theme().'/lib/campaignmonitor/csrest_subscribers.php';

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