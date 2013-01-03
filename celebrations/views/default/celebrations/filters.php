<?php
/**
 * Filters in Celebrations lists
 *
 * @package Celebrations plugin
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Fernando Graells
 * @copyright Fernando Graells 2009
 * @link
 *
 * for Elgg 1.8 by iionly
 * @copyright iionly 2012
 * iionly@gmx.de
 */
?>

<div>
<h3><?php echo elgg_echo('celebrations:filterby'); ?></h3>

<?php

    $user_guid = $vars['user_guid'];
    if (!$user_guid) {
        $user_guid = elgg_get_logged_in_user_entity()->guid;
    }
    $mygroups = get_users_membership($user_guid);

    $filter = $vars['filterid'];
    if (!$filter) {
        $filter = 0;
    }
    $name = $vars['name'];
    if (!$name) {
        $name = 'input_filterid';
    }

    $filteroptions = array();
    $filteroptions = array('0' => elgg_echo('celebrations:option_all'), '-1' => elgg_echo('celebrations:option_friends'));
    if (!empty($mygroups)) {
        foreach ($mygroups as $mygroup) {
            $mygroup_guid = $mygroup['guid'];
            $filteroptions[$mygroup_guid] = $mygroup['name'];
        }
    }
    echo elgg_view('input/dropdown',array('name' => $name, 'options_values' => $filteroptions, 'value' => $vars['filterid'], 'js' => $vars['js']));

?>

</div>
