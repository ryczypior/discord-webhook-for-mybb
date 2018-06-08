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

$plugins->add_hook('datahandler_post_insert_thread_end', array('DiscordWebhook', 'newThread{suffix}'));
$plugins->add_hook('datahandler_post_insert_post_end', array('DiscordWebhook', 'newPost{suffix}'));

require('discord_webhooks/DiscordWebhook.php');

function discord_webhooks{suffix}_config($gid = null) {
    $position = 1;
    $has_curl = function_exists('curl_strerror');
    $cfg = array(
        array(
            'name' => 'discord_webhooks{suffix}_enabled',
            'title' => $db->escape_string($lang->discord_webhooks_enabled),
            'description' => $db->escape_string($lang->discord_webhooks_enabled_description),
            'optionscode' => 'yesno',
            'value' => '1',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks{suffix}_url',
            'title' => $db->escape_string($lang->discord_webhooks_url),
            'description' => $db->escape_string($lang->discord_webhooks_url_description),
            'optionscode' => 'text',
            'value' => 'https://',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks{suffix}_usesocket',
            'title' => $db->escape_string($lang->discord_webhooks_usesocket),
            'description' => $db->escape_string($lang->discord_webhooks_usesocket_description),
            'optionscode' => 'yesno',
            'value' => ($has_curl ? '0' : '1'),
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks{suffix}_new_thread_enabled',
            'title' => $db->escape_string($lang->discord_webhooks_new_thread_enabled),
            'description' => $db->escape_string($lang->discord_webhooks_new_thread_enabled_description),
            'optionscode' => 'yesno',
            'value' => '1',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks{suffix}_new_post_enabled',
            'title' => $db->escape_string($lang->discord_webhooks_new_post_enabled),
            'description' => $db->escape_string($lang->discord_webhooks_new_post_enabled_description),
            'optionscode' => 'yesno',
            'value' => '1',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks{suffix}_forums',
            'title' => $db->escape_string($lang->discord_webhooks_forums),
            'description' => $db->escape_string($lang->discord_webhooks_forums_description),
            'optionscode' => 'forumselect',
            'isdefault' => 1,
            'value' => '-1',
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks{suffix}_ignored_forums',
            'title' => $db->escape_string($lang->discord_webhooks_ignored_forums),
            'description' => $db->escape_string($lang->discord_webhooks_ignored_forums_description),
            'optionscode' => 'forumselect',
            'isdefault' => 1,
            'value' => '',
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks{suffix}_ignored_usergroups',
            'title' => $db->escape_string($lang->discord_webhooks_ignored_usergroups),
            'description' => $db->escape_string($lang->discord_webhooks_ignored_usergroups_description),
            'optionscode' => 'groupselect',
            'isdefault' => 1,
            'value' => '',
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks{suffix}_botname',
            'title' => $db->escape_string($lang->discord_webhooks_botname),
            'description' => $db->escape_string($lang->discord_webhooks_botname_description),
            'optionscode' => 'text',
            'value' => 'MYBB Bot',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks{suffix}_show',
            'title' => $db->escape_string($lang->discord_webhooks_show),
            'description' => $db->escape_string($lang->discord_webhooks_show_description),
            'optionscode' => sprintf('select\n0=%s\n1=%s\n2=%s', $db->escape_string($lang->discord_webhooks_show_n0), $db->escape_string($lang->discord_webhooks_show_n1), $db->escape_string($lang->discord_webhooks_show_n2)),
            'value' => '2',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks{suffix}_new_post_message',
            'title' => $db->escape_string($lang->discord_webhooks_new_post_message),
            'description' => $db->escape_string($lang->discord_webhooks_new_post_message_description),
            'optionscode' => 'textarea',
            'value' => $db->escape_string($lang->discord_webhooks_new_post_message_value),
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks{suffix}_new_post_color',
            'title' => $db->escape_string($lang->discord_webhooks_new_post_color),
            'description' => $db->escape_string($lang->discord_webhooks_new_post_color_description),
            'optionscode' => 'text',
            'value' => '#FFFFFF',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks{suffix}_new_thread_message',
            'title' => $db->escape_string($lang->discord_webhooks_new_thread_message),
            'description' => $db->escape_string($lang->discord_webhooks_new_thread_message_description),
            'optionscode' => 'textarea',
            'value' => $db->escape_string($lang->discord_webhooks_new_thread_message_value),
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks{suffix}_new_thread_color',
            'title' => $db->escape_string($lang->discord_webhooks_new_thread_color),
            'description' => $db->escape_string($lang->discord_webhooks_new_thread_color_description),
            'optionscode' => 'text',
            'value' => '#AAAAAA',
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
    );
    return $cfg;
}

function discord_webhooks{suffix}_info() {
    global $mybb, $lang;
    $lang->load('discord_webhooks');
    /* Check if there is settings update */
    if(discord_webhooks{suffix}_is_installed()){
        $settingGroupId = $db->fetch_field(
            $db->simple_select('settinggroups', 'gid', "name='discord_webhooks{suffix}'"), 'gid'
        );
        $update = false;
        $cfg = discord_webhooks{suffix}_config($settingGroupId);
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
    return array(
        "name" => $lang->discord_webhook_name . ('{suffix}' != '' ? ' (Suffix: {suffix})' : ''),
        "description" => $lang->discord_webhook_description . ('{suffix}' != '' ? ' (Suffix: {suffix})' : ''),
        "website" => "https://github.com/ryczypior/discord-webhook-for-mybb",
        "author" => "Ryczypiór",
        "authorsite" => "https://www.github.com/ryczypior",
        "version" => "1.12",
        "compatibility" => "18*",
        "guid" => "",
        "language_file" => "discord_webhooks",
        "language_prefix" => "discord_webhooks_",
        "codename" => "discord_wehooks_for_mybb"
    );
}

function discord_webhooks{suffix}_install() {
    global $mybb, $db, $lang;
    $lang->load('discord_webhooks');

    $gid = $db->insert_query('settinggroups', array(
        'name' => 'discord_webhooks{suffix}',
        'title' => $db->escape_string($lang->discord_webhook_settinggroups_title) . ('{suffix}' != '' ? ' (Suffix: {suffix})' : ''),
        'description' => $db->escape_string($lang->discord_webhook_settinggroups_description) . ('{suffix}' != '' ? ' (Suffix: {suffix})' : ''),
            ));
    $cfg = discord_webhooks{suffix}_config($gid);
    foreach ($cfg as $settings) {
        $db->insert_query("settings", $settings);
    }
    rebuild_settings();
}

function discord_webhooks{suffix}_activate() {
    global $db;
    $db->update_query("settings", array('value' => 1), "name='discord_webhooks{suffix}_enabled'");
}

function discord_webhooks{suffix}_deactivate() {
    global $db;
    $db->update_query("settings", array('value' => 0), "name='discord_webhooks{suffix}_enabled'");
}

function discord_webhooks{suffix}_is_installed() {
    global $mybb;
    return $mybb->settings['discord_webhooks{suffix}_url'] !== null;
}

function discord_webhooks{suffix}_uninstall() {
    global $db;

    $settingGroupId = $db->fetch_field(
            $db->simple_select('settinggroups', 'gid', "name='discord_webhooks{suffix}'"), 'gid'
    );

    $db->delete_query('settinggroups', 'gid=' . (int) $settingGroupId);
    $db->delete_query('settings', 'gid=' . (int) $settingGroupId);

    rebuild_settings();
}
