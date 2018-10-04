<?php
// Book IDs of all annual report books
$ar_bids = array(3966, 2491, 1380, 1145, 739, 447, 429);
foreach ($ar_bids as $ar_bid) {
  $result = db_query("SELECT nid FROM {book} WHERE bid = $ar_bid");
  $nids = $result->fetchAllAssoc('nid');
  $nid_to_convert = array();
  foreach($nids as $nid) {
    $nid_to_convert[] = $nid->nid;
  }
  // We don't want to touch the top book "cover" pages
  $nid_to_convert = array_diff($nid_to_convert, $ar_bids);
  foreach($nid_to_convert as $nid) {
    $node = node_load($nid);
    $node->type = 'annual_report';
    node_save($node);
    print '<p>Converted node: <strong>'.$nid.'</strong></p>';
  }
}
?>