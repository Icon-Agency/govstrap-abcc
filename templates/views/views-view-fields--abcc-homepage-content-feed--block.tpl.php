<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT
 *   output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field.
 *   Do not use var_export to dump this object, as it can't handle the
 *   recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to
 *   use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>

<?php

$link_to_content = NULL;
if ($fields['view_node']) {
  $link_to_content = new SimpleXMLElement($fields['view_node']->content);
  $link_to_content = $link_to_content['href'];
  $link_title = strip_tags($fields['title']->content);
}


$card_type = strip_tags($fields['field_category']->content);
if (strpos(strtolower($card_type), 'alert') > 0) {
  $card_theme = 'card-rights';
}
elseif (strpos(strtolower($card_type), 'release') > 0) {
  $card_theme = 'card-abcc';
}
else {
  $card_theme = 'card-worker';
}

?>

<?php if (!empty($link_to_content)): ?>
    <div class="col-lg-4">
        <a href="<?php print $link_to_content; ?>"
           title="<?php print $link_title; ?>"
           class="card h-100 fade-in-up animated <?php print $card_theme; ?>">
          <?php foreach ($fields as $id => $field): ?>
            <?php if ($id != 'view_node'): ?>
              <?php if (!empty($field->separator)): ?>
                <?php print $field->separator; ?>
              <?php endif; ?>

              <?php print $field->wrapper_prefix; ?>
              <?php print $field->label_html; ?>
              <?php print $field->content; ?>
              <?php print $field->wrapper_suffix; ?>
            <?php endif; ?>
          <?php endforeach; ?>
        </a>
    </div>
<?php endif; ?>
