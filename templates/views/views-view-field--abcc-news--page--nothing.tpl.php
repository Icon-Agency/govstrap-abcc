<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
?>
<?php
$category = 'Media release';
$dom = new DOMDocument('1.0', 'utf-8');
$dom->loadHTML($output);
$finder = new DomXPath($dom);
$classname='category';
$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
if ($nodes) {
  $category = $nodes[0]->nodeValue;
}
$card_class = _get_card_theme($category);

?>
<div class="item card <?php print $card_class; ?> py-5 fade-in-up animated">
  <?php print $output; ?>
</div>