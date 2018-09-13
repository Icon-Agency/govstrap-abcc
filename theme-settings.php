<?php

/**
 * @file
 * theme-settings.php
 */

/**
 * Include theme common function.
 */
include_once './' . drupal_get_path('theme', 'govstrap') . '/includes/common.inc';

/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * @param $form
 * @param $form_state
 * @param null $form_id
 */
function govstrap_form_system_theme_settings_alter(&$form, $form_state, $form_id = NULL) {
  // @see https://drupal.org/node/943212
  $theme = !empty($form_state['build_info']['args'][0]) ? $form_state['build_info']['args'][0] : FALSE;
  if (isset($form_id) || $theme === FALSE || !in_array('govstrap', _govstrap_get_base_themes($theme, TRUE))) {
    return;
  }

  // Horizontal tabs container
  $form['group_tabs'] = array(
    '#weight' => -99,
    '#type' => 'vertical_tabs',
    '#attached' => array(
      'library' => array(
        array(
          'field_group',
          'horizontal-tabs',
          'vertical-tabs',
        ),
      ),
    ),
  );

  // Default tab.
  $form['group_tab_default'] = array(
    '#type' => 'fieldset',
    '#title' => t('Theme settings'),
    '#group' => 'group_tabs',
  );

  // Set default tab.
  foreach ($form as $k => $v) {
    if ($k == 'group_tabs') {
      continue;
    }
    if ($k !== 'group_tab_default') {
      $form['group_tab_default'][$k] = $form[$k];
      $form['group_tab_default'][$k]['#group'] = 'group_tab_default';
      unset($form[$k]);
    }
  }

  $form['group_tab_default']['home_page_h1'] = array(
    '#type' => 'textfield',
    '#title' => t('Homepage heading 1'),
    '#description' => t('The heading text appearing on the homepage over the banner image. Please only enter <strong>plain text</strong>.'),
    '#default_value' => theme_get_setting('home_page_h1'),
    '#maxlength' => 255,
  );

  // jQuery replace settings.
  $form['jquery'] = array(
    '#type' => 'fieldset',
    '#title' => t('jQuery'),
    '#description' => t("jQuery settings."),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'group_tabs',
  );

  $form['jquery']['jquery_replace_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Replace jQuery'),
    '#default_value' => theme_get_setting('jquery_replace_enabled'),
  );

  // Taxonomy autolink settings
  // Page theme settings.
  $form['taxonomy_autolink'] = array(
    '#type' => 'fieldset',
    '#title' => t('Taxonomy autolink'),
    '#description' => t("Automatically link taxonomy terms appearing in content to their taxonomy pages."),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'group_tabs',
  );
  $form['taxonomy_autolink']['taxonomy_autolink_vocabs'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Vocabularies that can be auto-linked'),
    '#options' => taxonomy_allvocabs(),
    '#default_value' => theme_get_setting('taxonomy_autolink_vocabs'),
  );
  $form['taxonomy_autolink']['taxonomy_autolink_limit'] = array(
    '#type' => 'textfield',
    '#title' => t('Maximum links per term'),
    '#description' => t('If not specified, only the first occurrence will be linked.'),
    '#size' => 5,
    '#maxlength' => 4,
    '#default_value' => theme_get_setting('taxonomy_autolink_limit'),
    '#element_validate' => array('element_validate_integer_positive'),
  );
  $form['taxonomy_autolink']['taxonomy_autolink_mode'] = array(
    '#type' => 'checkbox',
    '#title' => t('Simple plural/singular variation support'),
    '#default_value' => theme_get_setting('taxonomy_autolink_mode'),
  );
  $form['taxonomy_autolink']['taxonomy_autolink_case_sensitivity'] = array(
    '#type' => 'checkbox',
    '#title' => t('Case sensitive'),
    '#default_value' => theme_get_setting('taxonomy_autolink_case_sensitivity'),
  );
  $form['taxonomy_autolink']['path_excluded_auto_linking'] = array(
    '#type' => 'textarea',
    '#title' => t('Paths that are excluded from auto-linking'),
    '#default_value' => theme_get_setting('path_excluded_auto_linking'),
  );
  
  // Page theme settings.
  $form['page_theme'] = array(
    '#type' => 'fieldset',
    '#title' => t('Page theme'),
    '#description' => t("Enter Drupal paths for which a desired page theme should be applied."),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'group_tabs',
  );
  $form['page_theme']['page_theme_government'] = array(
    '#type' => 'textarea',
    '#title' => t('Theme Government'),
    '#description' => t('<span style="font-size: 1.1em; font-weight: 700; color: #25a1db;">	&#9824; Blue accent colour</span>'),
    '#default_value' => theme_get_setting('page_theme_government'),
  );
  $form['page_theme']['page_theme_rights'] = array(
    '#type' => 'textarea',
    '#title' => t('Theme Rights'),
    '#description' => t('<span style="font-size: 1.1em; font-weight: 700; color: #9b3a95;">	&#9827; Purple accent colour</span>'),
    '#default_value' => theme_get_setting('page_theme_rights'),
  );
  $form['page_theme']['page_theme_worker'] = array(
    '#type' => 'textarea',
    '#title' => t('Theme Worker'),
    '#description' => t('<span style="font-size: 1.1em; font-weight: 700; color: #e15047;">	&#9829; Red accent colour</span>'),
    '#default_value' => theme_get_setting('page_theme_worker'),
  );
  $form['page_theme']['page_theme_abcc'] = array(
    '#type' => 'textarea',
    '#title' => t('Theme ABCC'),
    '#description' => t('<span style="font-size: 1.1em; font-weight: 700; color: #17b791;">	&#9830; Green accent colour. This is also the default theme.</span>'),
    '#default_value' => theme_get_setting('page_theme_abcc'),
  );

  // Fontawesome settings.
  $form['fontawesome'] = array(
    '#type' => 'fieldset',
    '#title' => t('Font Awesome'),
    '#description' => t("Font Awesome settings."),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'group_tabs',
  );

  $form['fontawesome']['fontawesome_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Font Awesome'),
    '#default_value' => theme_get_setting('fontawesome_enabled'),
  );

  $form['fontawesome']['fontawesome_cdn'] = array(
    '#type' => 'fieldset',
    '#title' => t('Font Awesome CDN'),
    '#group' => 'fontawesome',
    '#states' => array(
      'invisible' => array(
        // If the checkbox is not enabled, show the container.
        'input[name="fontawesome_enabled"]' => array('checked' => FALSE),
      ),
    ),
  );

  $form['fontawesome']['fontawesome_cdn']['fontawesome_css_cdn'] = array(
    '#type' => 'select',
    '#title' => t('Font Awesome CDN Complete CSS version'),
    '#options' => drupal_map_assoc(array(
      'v5.0.2',
    )),
    '#default_value' => theme_get_setting('fontawesome_css_cdn'),
    '#empty_option' => t('Disabled'),
    '#empty_value' => NULL,
  );

  $webforms = db_query("SELECT nid, title FROM {node} WHERE type = 'webform' ORDER BY title");
  if ($webforms) {
    $options = array();
    foreach ($webforms as $webform) { $options[$webform->nid] = $webform->title; }
    $form['abcc_forms'] = array(
      '#type' => 'fieldset',
      '#title' => t('Newsletter Sign Up Forms'),
      '#weight' => -2 // Place this to top of options page.
    );
    $form['abcc_forms']['abcc_newsletter_signup_form'] = array(
      '#type' => 'select',
      '#title' => t('Newsletter Form'),
      '#options' => $options,
      '#default_value' => theme_get_setting('abcc_newsletter_signup_form')
    );

    $place_holder_text_api_key = 'Please provide API key';
    if (theme_get_setting('abcc_newsletter_cm_api_key')) {
      $place_holder_text_api_key = 'API key has been provided and is hidden for your security';
    }

    $form['abcc_forms']['abcc_newsletter_cm_api_key'] = array(
      '#type' => 'password',
      '#title' => 'Campaign Monitor API key',
      '#size' => 60,
      '#default_value' => theme_get_setting('abcc_newsletter_cm_api_key'),
      '#attributes' =>array('placeholder' => t($place_holder_text_api_key)),
    );

    $place_holder_text_list_id = 'Please provide list ID';
    if (theme_get_setting('abcc_newsletter_cm_api_list_id')) {
      $place_holder_text_list_id = 'List ID has been provided and is hidden for your security';
    }

    $form['abcc_forms']['abcc_newsletter_cm_api_list_id'] = array(
      '#type' => 'password',
      '#title' => 'Campaign Monitor API subscriber list ID',
      '#size' => 60,
      '#default_value' => theme_get_setting('abcc_newsletter_cm_api_list_id'),
      '#attributes' =>array('placeholder' => t($place_holder_text_list_id)),
    );
  }

  // Accessibility and support settings.
  $form['support'] = array(
    '#type' => 'fieldset',
    '#title' => t('Accessibility and support'),
    '#description' => t("Accessibility and support settings."),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'group_tabs',
  );

  $form['support']['govstrap_skip_link_anchor'] = array(
    '#type' => 'textfield',
    '#title' => t('Anchor ID for the “skip link”'),
    '#default_value' => theme_get_setting('govstrap_skip_link_anchor'),
    '#field_prefix' => '#',
    '#description' => t('Specify the HTML ID of the element that the accessible-but-hidden “skip link” should link to. Note: that element should have the <code>tabindex="-1"</code> attribute to prevent an accessibility bug in webkit browsers. (<a href="!link">Read more about skip links</a>.)', array('!link' => 'https://drupal.org/node/467976')),
  );

  $form['support']['govstrap_skip_link_text'] = array(
    '#type' => 'textfield',
    '#title' => t('Text for the “skip link”'),
    '#default_value' => theme_get_setting('govstrap_skip_link_text'),
    '#description' => t('For example: <em>Jump to navigation</em>, <em>Skip to content</em>'),
  );

  // Development settings.
  $form['development'] = array(
    '#type' => 'fieldset',
    '#title' => t('Development'),
    '#description' => t("Development settings."),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'group_tabs',
  );

  $form['development']['govstrap_rebuild_registry'] = array(
    '#type' => 'checkbox',
    '#title' => t('Rebuild theme registry on every page.'),
    '#default_value' => theme_get_setting('govstrap_rebuild_registry'),
    '#description' => t('During theme development, it can be very useful to continuously <a href="!link">rebuild the theme registry</a>. WARNING: this is a huge performance penalty and must be turned off on production websites.', array('!link' => 'https://drupal.org/node/173880#theme-registry')),
  );
}
