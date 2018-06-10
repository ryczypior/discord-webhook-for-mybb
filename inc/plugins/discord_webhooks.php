<?php
/**
 * The MIT License (MIT)
 * 
 * Copyright (c) 2017 Łukasz Kodzis (Ryczypiór)
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction, 
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, 
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, 
 * subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all copies or substantial 
 * portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, 
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE 
 * OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
if (!defined("IN_MYBB")) {
    die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}
define("IN_DISCORDWEBHOOKS", true);

$plugins->add_hook('datahandler_post_insert_thread_end', array('DiscordWebhook', 'newThread'));
$plugins->add_hook('datahandler_post_insert_post_end', array('DiscordWebhook', 'newPost'));
$plugins->add_hook('member_do_register_end', array('DiscordWebhook', 'newRegistration'));
$plugins->add_hook('admin_config_settings_begin', 'discord_webhooks_check_updated_settings');

require_once('discord_webhooks/DiscordWebhook.php');

function discord_webhooks_config($gid = null){
    global $db, $lang;
    $lang->load('discord_webhooks');
    $position = 1;
    $has_curl = function_exists('curl_init');
    $query = $db->simple_select('threadprefixes', "pid, prefix");
    while ($result = $db->fetch_array($query)) {
        $replace['@' . $result['name']] = $replace['fid' . $result['fid']];
    }
    $cfg = array(
        array(
            'name' => 'discord_webhooks_enabled',
            'title' => $db->escape_string($lang->discord_webhooks_enabled),
            'description' => $db->escape_string($lang->discord_webhooks_enabled_description),
            'optionscode' => 'yesno',
            'value' => '1',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_url',
            'title' => $db->escape_string($lang->discord_webhooks_url),
            'description' => $db->escape_string($lang->discord_webhooks_url_description),
            'optionscode' => 'text',
            'value' => 'https://',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_usesocket',
            'title' => $db->escape_string($lang->discord_webhooks_usesocket),
            'description' => $db->escape_string($lang->discord_webhooks_usesocket_description),
            'optionscode' => 'yesno',
            'value' => ($has_curl ? '0' : '1'),
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_botname',
            'title' => $db->escape_string($lang->discord_webhooks_botname),
            'description' => $db->escape_string($lang->discord_webhooks_botname_description),
            'optionscode' => 'text',
            'value' => 'MYBB Bot',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_registration_enabled',
            'title' => $db->escape_string($lang->discord_webhooks_new_registration_enabled),
            'description' => $db->escape_string($lang->discord_webhooks_new_registration_enabled_description),
            'optionscode' => 'yesno',
            'value' => '0',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_registration_url',
            'title' => $db->escape_string($lang->discord_webhooks_new_registration_url),
            'description' => $db->escape_string($lang->discord_webhooks_new_registration_url_description),
            'optionscode' => 'text',
            'value' => '',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_registration_botname',
            'title' => $db->escape_string($lang->discord_webhooks_new_registration_botname),
            'description' => $db->escape_string($lang->discord_webhooks_new_registration_botname_description),
            'optionscode' => 'text',
            'value' => '',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_registration_message',
            'title' => $db->escape_string($lang->discord_webhooks_new_registration_message),
            'description' => $db->escape_string($lang->discord_webhooks_new_registration_message_description),
            'optionscode' => 'textarea',
            'value' => $db->escape_string($lang->discord_webhooks_new_registration_message_value),
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_registration_show_style',
            'title' => $db->escape_string($lang->discord_webhooks_new_registration_show_style),
            'description' => $db->escape_string($lang->discord_webhooks_new_registration_show_style_description),
            'optionscode' => sprintf('select\n0=%s\n1=%s', $db->escape_string($lang->discord_webhooks_new_registration_show_style_n0), $db->escape_string($lang->discord_webhooks_new_registration_show_style_n1)),
            'value' => '1',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_registration_color',
            'title' => $db->escape_string($lang->discord_webhooks_new_registration_color),
            'description' => $db->escape_string($lang->discord_webhooks_new_registration_color_description),
            'optionscode' => 'text',
            'value' => '#D60000',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_forums',
            'title' => $db->escape_string($lang->discord_webhooks_forums),
            'description' => $db->escape_string($lang->discord_webhooks_forums_description),
            'optionscode' => 'forumselect',
            'isdefault' => 1,
            'value' => '-1',
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_ignored_forums',
            'title' => $db->escape_string($lang->discord_webhooks_ignored_forums),
            'description' => $db->escape_string($lang->discord_webhooks_ignored_forums_description),
            'optionscode' => 'forumselect',
            'isdefault' => 1,
            'value' => '',
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_ignored_usergroups',
            'title' => $db->escape_string($lang->discord_webhooks_ignored_usergroups),
            'description' => $db->escape_string($lang->discord_webhooks_ignored_usergroups_description),
            'optionscode' => 'groupselect',
            'isdefault' => 1,
            'value' => '',
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_thread_prefix',
            'title' => $db->escape_string($lang->discord_webhooks_new_thread_prefix),
            'description' => $db->escape_string($lang->discord_webhooks_new_thread_prefix_description),
            'optionscode' => "text",
            'value' => '',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_thread_enabled',
            'title' => $db->escape_string($lang->discord_webhooks_new_thread_enabled),
            'description' => $db->escape_string($lang->discord_webhooks_new_thread_enabled_description),
            'optionscode' => 'yesno',
            'value' => '1',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_thread_url',
            'title' => $db->escape_string($lang->discord_webhooks_new_thread_url),
            'description' => $db->escape_string($lang->discord_webhooks_new_thread_url_description),
            'optionscode' => 'text',
            'value' => '',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_thread_botname',
            'title' => $db->escape_string($lang->discord_webhooks_new_thread_botname),
            'description' => $db->escape_string($lang->discord_webhooks_new_thread_botname_description),
            'optionscode' => 'text',
            'value' => '',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_thread_message',
            'title' => $db->escape_string($lang->discord_webhooks_new_thread_message),
            'description' => $db->escape_string($lang->discord_webhooks_new_thread_message_description),
            'optionscode' => 'textarea',
            'value' => $db->escape_string($lang->discord_webhooks_new_thread_message_value),
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_show',
            'title' => $db->escape_string($lang->discord_webhooks_show),
            'description' => $db->escape_string($lang->discord_webhooks_show_description),
            'optionscode' => sprintf('select\n0=%s\n1=%s\n2=%s\n3=%s\n4=%s', $db->escape_string($lang->discord_webhooks_show_n0), $db->escape_string($lang->discord_webhooks_show_n1), $db->escape_string($lang->discord_webhooks_show_n2), $db->escape_string($lang->discord_webhooks_show_n3), $db->escape_string($lang->discord_webhooks_show_n4)),
            'value' => '2',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_thread_chars_limit',
            'title' => $db->escape_string($lang->discord_webhooks_new_thread_chars_limit),
            'description' => $db->escape_string($lang->discord_webhooks_new_thread_chars_limit_description),
            'optionscode' => 'text',
            'value' => 500,
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_thread_show_avatar',
            'title' => $db->escape_string($lang->discord_webhooks_new_thread_show_avatar),
            'description' => $db->escape_string($lang->discord_webhooks_new_thread_show_avatar_description),
            'optionscode' => 'yesno',
            'value' => '1',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_thread_show_title',
            'title' => $db->escape_string($lang->discord_webhooks_new_thread_show_title),
            'description' => $db->escape_string($lang->discord_webhooks_new_thread_show_title_description),
            'optionscode' => 'yesno',
            'value' => '1',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_thread_show_thumbnail',
            'title' => $db->escape_string($lang->discord_webhooks_new_thread_show_thumbnail),
            'description' => $db->escape_string($lang->discord_webhooks_new_thread_show_thumbnail_description),
            'optionscode' => 'yesno',
            'value' => '1',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_thread_show_author',
            'title' => $db->escape_string($lang->discord_webhooks_new_thread_show_author),
            'description' => $db->escape_string($lang->discord_webhooks_new_thread_show_author_description),
            'optionscode' => 'yesno',
            'value' => '1',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_thread_color',
            'title' => $db->escape_string($lang->discord_webhooks_new_thread_color),
            'description' => $db->escape_string($lang->discord_webhooks_new_thread_color_description),
            'optionscode' => 'text',
            'value' => '#AAAAAA',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_post_enabled',
            'title' => $db->escape_string($lang->discord_webhooks_new_post_enabled),
            'description' => $db->escape_string($lang->discord_webhooks_new_post_enabled_description),
            'optionscode' => 'yesno',
            'value' => '1',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_post_url',
            'title' => $db->escape_string($lang->discord_webhooks_new_post_url),
            'description' => $db->escape_string($lang->discord_webhooks_new_post_url_description),
            'optionscode' => 'text',
            'value' => '',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_post_show',
            'title' => $db->escape_string($lang->discord_webhooks_new_post_show),
            'description' => $db->escape_string($lang->discord_webhooks_new_post_show_description),
            'optionscode' => sprintf('select\n0=%s\n1=%s\n2=%s\n3=%s\n4=%s', $db->escape_string($lang->discord_webhooks_show_n0), $db->escape_string($lang->discord_webhooks_show_n1), $db->escape_string($lang->discord_webhooks_show_n2), $db->escape_string($lang->discord_webhooks_show_n3), $db->escape_string($lang->discord_webhooks_show_n4)),
            'value' => '2',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_post_botname',
            'title' => $db->escape_string($lang->discord_webhooks_new_post_botname),
            'description' => $db->escape_string($lang->discord_webhooks_new_post_botname_description),
            'optionscode' => 'text',
            'value' => '',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_post_chars_limit',
            'title' => $db->escape_string($lang->discord_webhooks_new_post_chars_limit),
            'description' => $db->escape_string($lang->discord_webhooks_new_post_chars_limit_description),
            'optionscode' => 'text',
            'value' => 500,
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_post_message',
            'title' => $db->escape_string($lang->discord_webhooks_new_post_message),
            'description' => $db->escape_string($lang->discord_webhooks_new_post_message_description),
            'optionscode' => 'textarea',
            'value' => $db->escape_string($lang->discord_webhooks_new_post_message_value),
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_post_show_avatar',
            'title' => $db->escape_string($lang->discord_webhooks_new_post_show_avatar),
            'description' => $db->escape_string($lang->discord_webhooks_new_post_show_avatar_description),
            'optionscode' => 'yesno',
            'value' => '1',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_post_show_title',
            'title' => $db->escape_string($lang->discord_webhooks_new_post_show_title),
            'description' => $db->escape_string($lang->discord_webhooks_new_post_show_title_description),
            'optionscode' => 'yesno',
            'value' => '1',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_post_show_thumbnail',
            'title' => $db->escape_string($lang->discord_webhooks_new_post_show_thumbnail),
            'description' => $db->escape_string($lang->discord_webhooks_new_post_show_thumbnail_description),
            'optionscode' => 'yesno',
            'value' => '1',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_post_show_author',
            'title' => $db->escape_string($lang->discord_webhooks_new_post_show_author),
            'description' => $db->escape_string($lang->discord_webhooks_new_post_show_author_description),
            'optionscode' => 'yesno',
            'value' => '1',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_new_post_color',
            'title' => $db->escape_string($lang->discord_webhooks_new_post_color),
            'description' => $db->escape_string($lang->discord_webhooks_new_post_color_description),
            'optionscode' => 'text',
            'value' => '#FFFFFF',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
    );
    return $cfg;
}

function discord_webhooks_check_updated_settings(){
    global $db, $mybb;
    /* Check if there is settings update */
    if(discord_webhooks_is_installed()){
        $qry = $db->simple_select('settinggroups', 'gid', "name='discord_webhooks'");
        $settingGroupId = $db->fetch_field(
            $qry, 'gid'
        );
        $update = false;
        $cfg = discord_webhooks_config($settingGroupId);
        foreach($cfg as $setting){
            if($mybb->settings[$setting['name']] === null){
                $update = true;
                break;
            }
        }
        if($update){
            foreach($cfg as $setting){
                if($mybb->settings[$setting['name']] === null){
                    $db->insert_query("settings", $setting);
                } else {
                    $db->update_query("settings", array(
                        'title' => $setting['title'],
                        'description' => $setting['description'],
                        'optionscode' => $setting['optionscode'],
                        'disporder' => $setting['disporder'],
                    ), "name='".$setting['name']."'");
                }
            }
            rebuild_settings();
        }
    }
    return true;
}

function discord_webhooks_info() {
    global $lang;
    $lang->load('discord_webhooks');
    return array(
        "name" => $lang->discord_webhook_name,
        "description" => $lang->discord_webhook_description,
        "website" => "https://github.com/ryczypior/discord-webhook-for-mybb",
        "author" => "Ryczypiór",
        "authorsite" => "https://www.github.com/ryczypior",
        "version" => "2.0",
        "compatibility" => "18*",
        "guid" => "",
        "language_file" => "discord_webhooks",
        "language_prefix" => "discord_webhooks_",
        "codename" => "discord_wehooks_for_mybb"
    );
}

function discord_webhooks_install() {
    global $mybb, $db, $lang;
    $lang->load('discord_webhooks');

    $gid = $db->insert_query('settinggroups', array(
        'name' => 'discord_webhooks',
        'title' => $db->escape_string($lang->discord_webhook_settinggroups_title),
        'description' => $db->escape_string($lang->discord_webhook_settinggroups_description),
            ));
    $cfg = discord_webhooks_config($gid);
    foreach ($cfg as $settings) {
        $db->insert_query("settings", $settings);
    }
    rebuild_settings();
}

function discord_webhooks_activate() {
    global $db;
    $db->update_query("settings", array('value' => 1), "name='discord_webhooks_enabled'");
    rebuild_settings();
}

function discord_webhooks_deactivate() {
    global $db;
    $db->update_query("settings", array('value' => 0), "name='discord_webhooks_enabled'");
    rebuild_settings();
}

function discord_webhooks_is_installed() {
    global $mybb;
    return $mybb->settings['discord_webhooks_url'] !== null;
}

function discord_webhooks_uninstall() {
    global $db;

    $qry = $db->simple_select('settinggroups', 'gid', "name='discord_webhooks'");
    $settingGroupId = $db->fetch_field(
        $qry, 'gid'
    );

    $db->delete_query('settinggroups', 'gid=' . (int) $settingGroupId);
    $db->delete_query('settings', 'gid=' . (int) $settingGroupId);

    rebuild_settings();
}
