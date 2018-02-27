Discord Webhook for MyBB
========================

This plugin allows you to send information about new threads and new posts to your Discord channel using Webhooks.

Instalation:
============

* Copy all folders and files from *inc* folder into MyBB *inc* directory.
* In your forum's ACP Panel go to plugins section and install Discord Webhooks for MyBB plugin
* Go to your Discord channels settings page to grnerate Webhook URL endpoint
* Copy generated URL to clipboard
* In your forum'S ACP config section (plugin settings) select "Discord Webhooks for MyBB" and paste webhooks url into "Discord Webhooks URL" field
* In this section you also need to specify which forum threads and posts are being sent to the Discord Webhook

After you save these settings, you should see new threads and posts from selected forums on your Discord channel

Multiple instances of this plugin:
=================================
You can install multiple instances of this plugin, but it needs some changes from your side. At first you have to specify the suffix - it's a name you will use to differ your another plugin from the first one. It should contain only alphanumeric and underscore characters. Let it be *instance_1* for example. You need to:
* download multiinstance plugin file from https://raw.githubusercontent.com/ryczypior/discord-webhook-for-mybb/master/multiinstance/discord_webhooks%7Bsuffix%7D.php
* change its filename replacing the {suffix} part by your suffix (in this example it will be discord_webhooksinstance_1.php)
* edit this file and replace every {suffix} part to your suffix (in this example every {suffix} part will be replaced by instance_1, so the first method will be renamed to discord_webhooksinstance_1_info()
```php
if (!defined("IN_MYBB")) {
    die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}
define("IN_DISCORDWEBHOOKS", true);

$plugins->add_hook('datahandler_post_insert_thread_end', array('DiscordWebhook', 'newThreadinstance_1'));
$plugins->add_hook('datahandler_post_insert_post_end', array('DiscordWebhook', 'newPostinstance_1'));

require('discord_webhooks/DiscordWebhook.php');

function discord_webhooksinstance_1_info() {
    global $lang;
    //print_r($mybb->settings['discord_webhooks_forums']);
    //exit;
    $lang->load('discord_webhooks');
    return array(
        "name" => $lang->discord_webhook_name . ('instance_1' != '' ? ' (Suffix: instance_1)' : ''),
        "description" => $lang->discord_webhook_description . ('instance_1' != '' ? ' (Suffix: instance_1)' : ''),
        "website" => "https://github.com/ryczypior/discord-webhook-for-mybb",
        "author" => "Ryczypiór",
        "authorsite" => "https://www.github.com/ryczypior",
        "version" => "1.1",
        "compatibility" => "18*",
        "guid" => "",
        "language_file" => "discord_webhooks",
        "language_prefix" => "discord_webhooks_",
        "codename" => "discord_wehooks_for_mybb"
    );
}

function discord_webhooksinstance_1_install() {
    global $mybb, $db, $lang;
    $lang->load('discord_webhooks');

    $gid = $db->insert_query('settinggroups', array(
        'name' => 'discord_webhooksinstance_1',
        'title' => $db->escape_string($lang->discord_webhook_settinggroups_title) . ('instance_1' != '' ? ' (Suffix: instance_1)' : ''),
        'description' => $db->escape_string($lang->discord_webhook_settinggroups_description) . ('instance_1' != '' ? ' (Suffix: instance_1)' : ''),
            ));
    $position = 1;
    $cfg = array(
//...
} 
```
* save changes and copy this file to your inc/plugins directory
* That's all, you have another instance of the Discord Plugin :D

Requirements:
=============

* MyBB 1.8+
* curl - for HTTP requests to Discord
* Multibyte String (mb_* string) for multibyte string manipulation

GitHub: https://github.com/ryczypior/discord-webhook-for-mybb
