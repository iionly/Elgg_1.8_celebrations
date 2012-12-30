<?php
/**
 * Celebrations 1.8.0 - Admin settings
 *
 * @package Celebrations
 * @author Fernando Graells
 * @copyright Fernando Graells 2009
 * @link
 *
 * Elgg 1.8 version by iionly (iionly@gmx.de)
 *
 */

$plugin = elgg_get_plugin_from_id('celebrations');

if (!(elgg_get_plugin_setting('replaceage'))) {
    elgg_set_plugin_setting('replaceage', 'no');
}
if (!(elgg_get_plugin_setting('ViewReminder'))) {
    elgg_set_plugin_setting('ViewReminder', 'no');
}
if (!(elgg_get_plugin_setting('nextdaysCelebrations'))) {
    elgg_set_plugin_setting('nextdaysCelebrations', '7');
}
if (!(elgg_get_plugin_setting('date_type'))) {
    elgg_set_plugin_setting('date_type', 1);
}
if (!(elgg_get_plugin_setting('lastname_field'))) {
    elgg_set_plugin_setting('lastname_field', 'no');
}
if (!(elgg_get_plugin_setting('secondlastname_field'))) {
    elgg_set_plugin_setting('secondlastname_field', 'no');
}
if (!(elgg_get_plugin_setting('celebrations_birthdate_field'))) {
    elgg_set_plugin_setting('celebrations_birthdate_field', 'yes');
}
if (!(elgg_get_plugin_setting('celebrations_dieday_field'))) {
    elgg_set_plugin_setting('celebrations_dieday_field', 'no');
}
if (!(elgg_get_plugin_setting('celebrations_feastdate_field'))) {
    elgg_set_plugin_setting('celebrations_feastdate_field', 'no');
}
if (!(elgg_get_plugin_setting('celebrations_weddingdate_field'))) {
    elgg_set_plugin_setting('celebrations_weddingdate_field', 'no');
}

$form = '<label>' . elgg_echo("celebrations:replaceage") . '</label>';
$form .= elgg_view('input/dropdown', array(
                    'name' => 'params[replaceage]',
                    'options_values' => array('no' => elgg_echo('option:no'), 'yes' => elgg_echo('option:yes')),
                    'value' => $plugin->replaceage
    ));

$form .= '<br><br><label>' . elgg_echo("celebrations:viewreminder") . '</label>';
$form .= elgg_view('input/dropdown', array(
                    'name' => 'params[ViewReminder]',
                    'options_values' => array('yes' => elgg_echo('option:yes'), 'no' => elgg_echo('option:no')),
                    'value' => $plugin->ViewReminder
    ));

$form .= '<br><br><label>' . elgg_echo("celebrations:numberdays") . '</label>';
$form .= elgg_view('input/text', array(
                    'name' => 'params[nextdaysCelebrations]',
                    'value' => $plugin->nextdaysCelebrations
    ));

$form .= '<br><br><label>' . elgg_echo("celebrations:date_type") . '</label>';
$form .= elgg_view('input/dropdown', array(
                    'name' => 'params[date_type]',
                    'options_values' => array('1' => 'd/m/Y', '2' => 'm/d/Y'),
                    'value' => $plugin->date_type
    ));

$form .= '<br><br><br>' . elgg_echo("celebrations:fieldsused");

$form .= '<br><br><label>' . elgg_echo("profile:lastname") . '</label> ';
$form .= elgg_view('input/dropdown', array(
                    'name' => 'params[lastname_field]',
                    'options_values' => array('yes' => elgg_echo('option:yes'), 'no' => elgg_echo('option:no')),
                    'value' => $plugin->lastname_field
    ));

$form .= '<br><br><label>' . elgg_echo("profile:secondlastname") . '</label> ';
$form .= elgg_view('input/dropdown', array(
                    'name' => 'params[secondlastname_field]',
                    'options_values' => array('yes' => elgg_echo('option:yes'), 'no' => elgg_echo('option:no')),
                    'value' => $plugin->secondlastname_field
    ));

$form .= '<br><br><label>' . elgg_echo("profile:celebrations_birthdate") . '</label> ';
$form .= elgg_view('input/dropdown', array(
                    'name' => 'params[celebrations_birthdate_field]',
                    'options_values' => array('yes' => elgg_echo('option:yes'), 'no' => elgg_echo('option:no')),
                    'value' => $plugin->celebrations_birthdate_field
    ));

$form .= '<br><br><label>' . elgg_echo("profile:celebrations_dieday") . '</label> ';
$form .= elgg_view('input/dropdown', array(
                    'name' => 'params[celebrations_dieday_field]',
                    'options_values' => array('yes' => elgg_echo('option:yes'), 'no' => elgg_echo('option:no')),
                    'value' => $plugin->celebrations_dieday_field
    ));

$form .= '<br><br><label>' . elgg_echo("profile:celebrations_feastdate") . '</label> ';
$form .= elgg_view('input/dropdown', array(
                    'name' => 'params[celebrations_feastdate_field]',
                    'options_values' => array('yes' => elgg_echo('option:yes'), 'no' => elgg_echo('option:no')),
                    'value' => $plugin->celebrations_feastdate_field
    ));

$form .= '<br><br><label>' . elgg_echo("profile:celebrations_weddingdate") . '</label> ';
$form .= elgg_view('input/dropdown', array(
                    'name' => 'params[celebrations_weddingdate_field]',
                    'options_values' => array('yes' => elgg_echo('option:yes'), 'no' => elgg_echo('option:no')),
                    'value' => $plugin->celebrations_weddingdate_field
    ));
$form .= '<br><br>';

echo elgg_view('input/form', array('id' => 'celebrations-settings-form', 'class' => 'elgg-form-settings', 'body' => $form));