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

require_once('discord_webhooks/DiscordWebhook.php');

function discord_webhooks_info() {
    global $lang;
    //print_r($mybb->settings['discord_webhooks_forums']);
    //exit;
    $lang->load('discord_webhooks');
    return array(
        "name" => $lang->discord_webhook_name,
        "description" => $lang->discord_webhook_description,
        "website" => "https://github.com/ryczypior/discord-webhook-for-mybb",
        "author" => "Ryczypiór",
        "authorsite" => "https://www.github.com/ryczypior",
        "version" => "1.0",
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
    $position = 1;
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
            'name' => 'discord_webhooks_forums',
            'title' => $db->escape_string($lang->discord_webhooks_forums),
            'description' => $db->escape_string($lang->discord_webhooks_forums_description),
            'optionscode' => 'forumselect',
            'isdefault' => 1,
            'value' => -1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
        array(
            'name' => 'discord_webhooks_ignored_forums',
            'title' => $db->escape_string($lang->discord_webhooks_ignored_forums),
            'description' => $db->escape_string($lang->discord_webhooks_ignored_forums_description),
            'optionscode' => 'forumselect',
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
            'name' => 'discord_webhooks_show',
            'title' => $db->escape_string($lang->discord_webhooks_show),
            'description' => $db->escape_string($lang->discord_webhooks_show_description),
            'optionscode' => sprintf('select\n0=%s\n1=%s\n2=%s', $db->escape_string($lang->discord_webhooks_show_n0), $db->escape_string($lang->discord_webhooks_show_n1), $db->escape_string($lang->discord_webhooks_show_n2)),
            'value' => '2',
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
            'name' => 'discord_webhooks_new_thread_message',
            'title' => $db->escape_string($lang->discord_webhooks_new_thread_message),
            'description' => $db->escape_string($lang->discord_webhooks_new_thread_message_description),
            'optionscode' => 'textarea',
            'value' => $db->escape_string($lang->discord_webhooks_new_thread_message_value),
            'isdefault' => 1,
            'disporder' =>$position++,
            'gid' => $gid,
        ),
    );
    foreach ($cfg as $settings) {
        $db->insert_query("settings", $settings);
    }
    rebuild_settings();
}

function discord_webhooks_activate() {
    global $db;
    $db->update_query("settings", array('value' => 1), "name='discord_webhooks_enabled'");
}

function discord_webhooks_deactivate() {
    global $db;
    $db->update_query("settings", array('value' => 0), "name='discord_webhooks_enabled'");
}

function discord_webhooks_is_installed() {
    global $mybb;
    return $mybb->settings['discord_webhooks_url'] !== null;
}

function discord_webhooks_uninstall() {
    global $db;

    $settingGroupId = $db->fetch_field(
            $db->simple_select('settinggroups', 'gid', "name='discord_webhooks'"), 'gid'
    );

    $db->delete_query('settinggroups', 'gid=' . (int) $settingGroupId);
    $db->delete_query('settings', 'gid=' . (int) $settingGroupId);

    rebuild_settings();
}
