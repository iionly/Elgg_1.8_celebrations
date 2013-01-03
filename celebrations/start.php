<?php

/**
 * Elgg Celebrations Plugin
 *
 * @package Celebrations
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Fernando Graells - ferg
 * @copyright Fernando Graells 2009
 *
 * for Elgg 1.8 by iionly
 * @copyright iionly 2012
 * iionly@gmx.de
 */

function celebrations_init() {
    global $CONFIG;

    elgg_register_library('celebrations_lib', elgg_get_plugins_path() . 'celebrations/models/lib.php');
    elgg_load_library('celebrations_lib');

    if (elgg_get_plugin_setting("ViewReminder", "celebrations") == 'yes') {
        elgg_register_event_handler('login', 'user', 'show_next_celebrations');
    }

    if (get_input('filterid')) {
        $filterid = get_input('filterid');
    } else {
        $filterid = 0;
    }

    elgg_register_plugin_hook_handler('profile:fields', 'profile', 'celebrations_profile_fields_plugin_handler');

    elgg_register_menu_item('site', array('name' => elgg_echo('celebrations:shorttitle'), 'text' => elgg_echo('celebrations:shorttitle'), 'href' => $CONFIG->wwwroot . "mod/celebrations"));

    // Extend system CSS
    elgg_extend_view('css/elgg', 'celebrations/css');

    elgg_extend_view('celebrations/list_celebrations', 'celebrations/javascript');


    // Register a page handler, so we can have nice URLs
    elgg_register_page_handler('celebrations','celebrations_page_handler');

    register_translations($CONFIG->pluginspath . "celebrations/languages/");

    //add widgets
    elgg_register_widget_type('today_celebrations',elgg_echo("today_celebrations:title"),elgg_echo("today_celebrations:description"));
    elgg_register_widget_type('next_celebrations',elgg_echo("next_celebrations:title"),elgg_echo("next_celebrations:description"));

    //add index widgets for Widget Manager plugin
    elgg_register_widget_type('index_today_celebrations', elgg_echo('today_celebrations:title'), elgg_echo('today_celebrations:description'), "index");
    elgg_register_widget_type('index_next_celebrations', elgg_echo('next_celebrations:title'), elgg_echo('next_celebrations:description'), "index");

    elgg_register_action('celebrations/settings/save', elgg_get_plugins_path() . "celebrations/actions/celebrations/settings.php", 'admin');

    if (elgg_is_active_plugin('profile_manager')) {
        $profile_options = array(
                        "show_on_register" => "no",
                        "mandatory" => "no",
                        "user_editable" => "yes",
                        "output_as_tags" => "no",
                        "admin_only" => "no",
                        "count_for_completeness" => "yes"
                );
        add_custom_field_type("custom_profile_field_types", "day_anniversary", "day_anniversary", $profile_options);
        add_custom_field_type("custom_profile_field_types", "yearly", "day_anniversary", $profile_options);
    }
}

function celebrations_page_handler($page) {
    global $CONFIG;

    include($CONFIG->pluginspath . "celebrations/index.php");

    return true;
}

function show_next_celebrations() {

    global $CONFIG;

    $ViewReminder = elgg_get_plugin_setting("ViewReminder","celebrations");
    if(!$ViewReminder) {
        $ViewReminder = "no";
    }

    if ($ViewReminder = "yes") {
        $nextdaysCelebrations = elgg_get_plugin_setting("nextdaysCelebrations","celebrations");
        if(!$nextdaysCelebrations) {
            $nextdaysCelebrations = 7;
        }

        $celebrations = user_celebrations($nextdaysCelebrations, 'next', 0);

        //draw celebrations
        if (!empty($celebrations)) {
            foreach($celebrations as $key => $val) {
                if ($val['rest'] == 0) {
                    $days = elgg_echo('next_celebrations:today');
                } elseif ($val['rest'] == 1) {
                    $days = elgg_echo('next_celebrations:dayleft');
                } else {
                    $days = elgg_echo('next_celebrations:in').' '.$val['rest'].' '.elgg_echo('next_celebrations:daysleft');
                }

                system_message(sprintf($days.elgg_echo('next_celebrations:celebrate').$val['fullname'].elgg_echo('next_celebrations:genitive').elgg_echo('today_celebrations:'.$val['type']).'.'));
            }
        }
    }

    return true;
}

function celebrations_profile_fields_plugin_handler($hook, $type, $return_value, $params) {

    // add celebrations fields to the core profile
    if((elgg_get_plugin_setting("lastname_field","celebrations") == 'yes') && (!$return_value['lastname'])) {
        $return_value['lastname'] = 'text';
    }
    if((elgg_get_plugin_setting("secondlastname_field","celebrations") == 'yes') && (!$return_value['secondlastname'])) {
        $return_value['secondlastname'] = 'text';
    }
    if ((elgg_get_plugin_setting("celebrations_birthdate_field","celebrations") == 'yes') && (!$return_value['celebrations_birthdate'])) {
        $return_value['celebrations_birthdate'] = 'day_anniversary';
    }
    if ((elgg_get_plugin_setting("celebrations_dieday_field","celebrations") == 'yes') && (!$return_value['celebrations_dieday'])) {
        $return_value['celebrations_dieday'] = 'day_anniversary';
    }
    if ((elgg_get_plugin_setting("celebrations_feastdate_field","celebrations") == 'yes') && (!$return_value['celebrations_feastdate'])) {
        $return_value['celebrations_feastdate'] = 'yearly';
    }
    if ((elgg_get_plugin_setting("celebrations_weddingdate_field","celebrations") == 'yes') && (!$return_value['celebrations_weddingdate'])) {
        $return_value['celebrations_weddingdate'] = 'day_anniversary';
    }

    elgg_set_config('profile_celebrations_prefix', 'celebrations_');

    return $return_value;
}

elgg_register_event_handler('init', 'system', 'celebrations_init');
