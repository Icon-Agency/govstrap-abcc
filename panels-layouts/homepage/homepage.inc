<?php

/**
 * @file
 * Implementation for the two column bricked layout
 */

// Plugin definition
$plugin = array(
  'title' => t('ABCC homepage'),
  'category' => t('Custom'),
  'icon' => 'homepage.png',
  'theme' => 'panels_homepage',
  'regions' => array(
    'row-1-col-1' => t('Row 1 Col 1'),
    'row-1-col-2' => t('Row 1 Col 2'),
    'row-2' => t('Row 2 full width with grey background'),
    'row-3' => t('Row 3 Industry update (Generated in code)'),
    'row-4-col-1' => t('Row 4 Col 1 (CTA heading)'),
    'row-4-col-2' => t('Row 4 Col 2 (CTA content)'),
  ),
);
