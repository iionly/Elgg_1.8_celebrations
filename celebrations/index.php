<?php

global $CONFIG;
// Start engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

gatekeeper();

elgg_set_context("celebrations");

if (get_input('filterid')){
    $filterid = get_input('filterid');
} else {
    $filterid = 0;
}
if (get_input('month')){
    $month = get_input('month');
} else {
    $month = date("n");
    forward($CONFIG->wwwroot . "mod/celebrations/index.php?month=".$month."&filterid=".$filterid);
}

$user_guid = elgg_get_logged_in_user_entity()->guid;
$js = "onChange=\"MM_jumpMenu('parent',this)\"";
$divbox = '<div class="elgg-module elgg-module-aside"><div class="elgg-head"><h3>'.elgg_echo('celebrations:filterby').'</h3></div>';

$title = elgg_view_title(elgg_echo('celebrations:title').' '.elgg_echo('next_celebrations:in').' '.elgg_echo("month:{$month}"));

// Format page
$area2 = $title . elgg_view('celebrations/list_celebrations', array('filterid' => $filterid));
$area3 = elgg_view('celebrations/sidebar') . $divbox . elgg_view('input/dropdown', array('name' => 'input_filterid', 'options_values'=>filterlist($user_guid), 'value'=>$filterid, 'js'=>$js)) . '</div>';
$body = elgg_view('page/layouts/one_sidebar', array('content' => $area2, 'sidebar' => $area3));

// Draw it
echo elgg_view_page(elgg_echo('celebrations:title'), $body);
