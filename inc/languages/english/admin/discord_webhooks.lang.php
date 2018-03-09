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
$l['discord_webhook_name'] = 'Discord Webhooks for MyBB';
$l['discord_webhook_description'] = 'Push info about new threads and posts to Discord using webhooks';
$l['discord_webhook_settinggroups_title'] = 'Discord Webhooks for MyBB';
$l['discord_webhook_settinggroups_description'] = 'Settings for Discord Webhooks.';
$l['discord_webhooks_enabled'] = 'Plugin enabled';
$l['discord_webhooks_enabled_description'] = 'Is plugin enabled';
$l['discord_webhooks_url'] = 'Discord Webhooks URL';
$l['discord_webhooks_url_description'] = 'Discord Webhooks endpoint URL generated on webhooks option\'s page in Discord client (something like: https://discordapp.com/api/webhooks/XXX/YYY)';
$l['discord_webhooks_usesocket'] = 'Use sockets';
$l['discord_webhooks_usesocket_description'] = 'Use sockets instead of cURL to send messages to Discord Webhook';
$l['discord_webhooks_forums'] = 'Enabled boards';
$l['discord_webhooks_forums_description'] = 'Boards from which threads and/or posts are sent';
$l['discord_webhooks_botname'] = 'Discord BOT name';
$l['discord_webhooks_botname_description'] = 'Enter BOT name you want to show. You can use:<br><strong>{username}</strong> - post author,<br><strong>{posttitle}</strong> - post title,<br><strong>{threadtitle}<strong> - thread title,<br><strong>{boardname}</strong> - board name,<br><strong>{url}</strong> post URL,<br><strong>{field_from_users_database}</strong> ANY field from users table,<br><strong>{fid<span style="color: #d60000">N</span>}</strong> any additional userfield where <strong style="color: #d60000">N</strong> is field ID,<br><strong>{@<span style="color: #d60000">Field Name</span>}</strong> any additional userfield where <strong style="color: #d60000">Field Name</strong> is a name of profile additional field';
$l['discord_webhooks_show'] = 'Information display method';
$l['discord_webhooks_show_description'] = 'Way to show an information about new thread or posts';
$l['discord_webhooks_show_n0'] = 'Only info message';
$l['discord_webhooks_show_n1'] = 'Info message with short rich text (author, title, content up to 100 chars)';
$l['discord_webhooks_show_n2'] = 'Info message with long rich text (author, title, content up to 1000 chars, avatar)';
$l['discord_webhooks_new_post_message'] = 'New post message';
$l['discord_webhooks_new_post_message_description'] = 'New post message content. You can use:<br><strong>{username}</strong> - post author,<br><strong>{posttitle}</strong> - post title,<br><strong>{threadtitle}<strong> - thread title,<br><strong>{boardname}</strong> - board name,<br><strong>{url}</strong> post URL,<br><strong>{field_from_users_database}</strong> ANY field from users table,<br><strong>{fid<span style="color: #d60000">N</span>}</strong> any additional userfield where <strong style="color: #d60000">N</strong> is field ID,<br><strong>{@<span style="color: #d60000">Field Name</span>}</strong> any additional userfield where <strong style="color: #d60000">Field Name</strong> is a name of profile additional field';
$l['discord_webhooks_new_post_message_value'] = '@{username} wrote a new post *{posttitle}* - {url} on *{boardname}* board';
$l['discord_webhooks_new_post_color'] = 'New post label color';
$l['discord_webhooks_new_post_color_description'] = 'You have to use RGB color HEX value, e.g. #CC9977';
$l['discord_webhooks_new_thread_message'] = 'New thread message';
$l['discord_webhooks_new_thread_message_description'] = 'New thread message content. You can use:<br><strong>{username}</strong> - post author,<br><strong>{posttitle}</strong> - post title,<br><strong>{threadtitle}<strong> - thread title,<br><strong>{boardname}</strong> - board name,<br><strong>{url}</strong> post URL,<br><strong>{field_from_users_database}</strong> ANY field from users table,<br><strong>{fid<span style="color: #d60000">N</span>}</strong> any additional userfield where <strong style="color: #d60000">N</strong> is field ID,<br><strong>{@<span style="color: #d60000">Field Name</span>}</strong> any additional userfield where <strong style="color: #d60000">Field Name</strong> is a name of profile additional field';
$l['discord_webhooks_new_thread_message_value'] = '@{username} created a new thread *{threadtitle}* - {url} on *{boardname}* board';
$l['discord_webhooks_new_thread_color'] = 'New thread label color';
$l['discord_webhooks_new_thread_color_description'] = 'You have to use RGB color HEX value, e.g. #CC9977';

$l['discord_webhooks_ignored_forums'] = 'Ignored boards';
$l['discord_webhooks_ignored_forums_description'] = 'Boards from which threads and/or posts are ignored';
$l['discord_webhooks_ignored_usergroups'] = 'Ignored usergroups';
$l['discord_webhooks_ignored_usergroups_description'] = 'Usergroups which threads and/or posts are ignored';
$l['discord_webhooks_new_thread_enabled'] = 'Push information about new threads';
$l['discord_webhooks_new_thread_enabled_description'] = 'Do you want to show information about new threads?';
$l['discord_webhooks_new_post_enabled'] = 'Push information about new posts';
$l['discord_webhooks_new_thread_enabled_description'] = 'Do you want to show information about new posts?';
