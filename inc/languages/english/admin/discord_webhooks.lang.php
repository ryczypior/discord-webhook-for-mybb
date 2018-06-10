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
$l['discord_webhooks_url'] = 'General Discord Webhooks URL';
$l['discord_webhooks_url_description'] = 'Discord Webhooks endpoint URL generated on webhooks option\'s page in Discord client (something like: https://discordapp.com/api/webhooks/XXX/YYY)';
$l['discord_webhooks_usesocket'] = 'Use sockets';
$l['discord_webhooks_usesocket_description'] = 'Use sockets instead of cURL to send messages to Discord Webhook';

$l['discord_webhooks_forums'] = 'Enabled boards';
$l['discord_webhooks_forums_description'] = 'Boards from which threads and/or posts are sent';
$l['discord_webhooks_botname'] = 'Default Discord BOT name';
$l['discord_webhooks_botname_description'] = 'Enter default BOT name you want to show. You can use additional parameters:<br><strong>{username}</strong> - username,<br><strong>{field_from_users_database}</strong> ANY field from users table,<br><strong>{fid<span style="color: #d60000">N</span>}</strong> any additional userfield where <strong style="color: #d60000">N</strong> is field ID,<br><strong>{@<span style="color: #d60000">Field Name</span>}</strong> any additional userfield where <strong style="color: #d60000">Field Name</strong> is a name of profile additional field';
$l['discord_webhooks_ignored_forums'] = 'Ignored boards';
$l['discord_webhooks_ignored_forums_description'] = 'Boards from which threads and/or posts are ignored';
$l['discord_webhooks_ignored_usergroups'] = 'Ignored usergroups';
$l['discord_webhooks_ignored_usergroups_description'] = 'Usergroups which threads and/or posts are ignored';

$l['discord_webhooks_new_registration_enabled'] = 'Push information about new users registration';
$l['discord_webhooks_new_registration_enabled_description'] = 'Do you want to show information about new user has registered?';
$l['discord_webhooks_new_registration_message'] = 'New registration message';
$l['discord_webhooks_new_registration_message_description'] = 'New user registration message content. You can use:<br><strong>{uid}</strong> - ID of the registered account,<br><strong>{username}</strong> - registered username,<br><strong>{date FORMAT}</strong> - registration date, you can set format as <em>strftime</em> format, please see: <a href="http://php.net/manual/en/function.strftime.php" target="_blank">http://php.net/manual/en/function.strftime.php</a>';
$l['discord_webhooks_new_registration_message_value'] = 'A new user - **{username}** - has registered an account on **{date %Y-%m-%d %H:%M:%S}**';
$l['discord_webhooks_new_registration_show_style'] = 'Show message as';
$l['discord_webhooks_new_registration_show_style_description'] = 'Select display method';
$l['discord_webhooks_new_registration_show_style_n0'] = 'Info message';
$l['discord_webhooks_new_registration_show_style_n1'] = 'Info message as a rich text';
$l['discord_webhooks_new_registration_color'] = 'New registration message label color';
$l['discord_webhooks_new_registration_color_description'] = '<strong>It works only with the <em>Info message as a rich text</em> display method!!!</strong> You have to use RGB color HEX value, e.g. #CC9977';
$l['discord_webhooks_new_registration_url'] = 'Discord Webhooks URL for registration messages';
$l['discord_webhooks_new_registration_url_description'] = 'Discord Webhooks endpoint URL only for new registration messages. If empty, general Discord Webhook URL will be used';
$l['discord_webhooks_new_registration_botname'] = 'Discord BOT name for new registration';
$l['discord_webhooks_new_registration_botname_description'] = 'Enter BOT name you want to show. You can use additional parameters:<br><strong>{username}</strong> - username,<br><strong>{field_from_users_database}</strong> ANY field from users table,<br><strong>{fid<span style="color: #d60000">N</span>}</strong> any additional userfield where <strong style="color: #d60000">N</strong> is field ID,<br><strong>{@<span style="color: #d60000">Field Name</span>}</strong> any additional userfield where <strong style="color: #d60000">Field Name</strong> is a name of profile additional field';

$l['discord_webhooks_new_thread_enabled'] = 'Push information about new threads';
$l['discord_webhooks_new_thread_enabled_description'] = 'Do you want to show information about new threads?';
$l['discord_webhooks_new_thread_message'] = 'New thread message';
$l['discord_webhooks_new_thread_message_description'] = 'New thread message content. You can use:<br><strong>{username}</strong> - post author,<br><strong>{posttitle}</strong> - post title,<br><strong>{threadtitle}<strong> - thread title,<br><strong>{boardname}</strong> - board name,<br><strong>{url}</strong> post URL,<br><strong>{field_from_users_database}</strong> ANY field from users table,<br><strong>{fid<span style="color: #d60000">N</span>}</strong> any additional userfield where <strong style="color: #d60000">N</strong> is field ID,<br><strong>{@<span style="color: #d60000">Field Name</span>}</strong> any additional userfield where <strong style="color: #d60000">Field Name</strong> is a name of profile additional field';
$l['discord_webhooks_new_thread_message_value'] = '@{username} created a new thread *{threadtitle}* - {url} on *{boardname}* board';
$l['discord_webhooks_new_thread_color'] = 'New thread label color';
$l['discord_webhooks_new_thread_color_description'] = 'You have to use RGB color HEX value, e.g. #CC9977';
$l['discord_webhooks_show'] = 'Information display method';
$l['discord_webhooks_show_description'] = 'Way to show an information about new thread';
$l['discord_webhooks_show_n0'] = 'Only info message';
$l['discord_webhooks_show_n1'] = 'Info message with rich text (author, title, content up to number of characters set in Max rich message characters)';
$l['discord_webhooks_show_n2'] = 'Rich text (info message will be prepended to text) (author, title, content up to number of characters set in Max rich message characters)';
$l['discord_webhooks_show_n3'] = 'Rich text (without an info message) (author, title, content up to number of characters set in Max rich message characters)';
$l['discord_webhooks_show_n4'] = 'Only info message as a rich text';
$l['discord_webhooks_new_thread_chars_limit'] = 'Threads - Rich text characters limit';
$l['discord_webhooks_new_thread_chars_limit_description'] = 'Only for rich text message. If set to 0 or below, it will send the data (avatar, title, etc) without the description. Please notice that, discord message limit is 2000 characters! It is recommended to set a number below this value';
$l['discord_webhooks_new_thread_url'] = 'Discord Webhooks URL for new threads';
$l['discord_webhooks_new_thread_url_description'] = 'Discord Webhooks endpoint URL only for new threads. If empty, general Discord Webhook URL will be used';
$l['discord_webhooks_new_thread_botname'] = 'Discord BOT name for new threads';
$l['discord_webhooks_new_thread_botname_description'] = 'Enter BOT name you want to show. If this field will not be filled in, default BOT name will be used. You can use additional parameters:<br><strong>{username}</strong> - post author,<br><strong>{posttitle}</strong> - post title,<br><strong>{threadtitle}<strong> - thread title,<br><strong>{boardname}</strong> - board name,<br><strong>{url}</strong> post URL,<br><strong>{field_from_users_database}</strong> ANY field from users table,<br><strong>{fid<span style="color: #d60000">N</span>}</strong> any additional userfield where <strong style="color: #d60000">N</strong> is field ID,<br><strong>{@<span style="color: #d60000">Field Name</span>}</strong> any additional userfield where <strong style="color: #d60000">Field Name</strong> is a name of profile additional field';
$l['discord_webhooks_new_thread_prefix'] = 'Push messages to Discord only for threads/posts with these prefixes';
$l['discord_webhooks_new_thread_prefix_description'] = 'Leave empty for any prefix (including none). Provide comma separated prefixes names to limit threads and posts messages which has one of these prefixes';
$l['discord_webhooks_new_thread_show_avatar'] = 'Threads - Show user\'s avatar as bot avatar';
$l['discord_webhooks_new_thread_show_avatar_description'] = 'Do you want to show user\'s avatar (if available) as bot avatar?';
$l['discord_webhooks_new_thread_show_title'] = 'Threads - Rich Text - Show title';
$l['discord_webhooks_new_thread_show_title_description'] = 'Do you want to show thread title in Rich Text messages?';
$l['discord_webhooks_new_thread_show_thumbnail'] = 'Threads - Rich Text - Show user\'s avatars as thumbnails';
$l['discord_webhooks_new_thread_show_thumbnail_description'] = 'Do you want to show user\'s avatar as thumbnail picture (if available) in Rich Text messages?';
$l['discord_webhooks_new_thread_show_author'] = 'Threads - Rich Text - Show author\'s section';
$l['discord_webhooks_new_thread_show_author_description'] = 'Do you want to show user\'s information in author\'s section in Rich Text messages?';

$l['discord_webhooks_new_post_enabled'] = 'Push information about new posts';
$l['discord_webhooks_new_post_enabled_description'] = 'Do you want to show information about new posts?';
$l['discord_webhooks_new_post_message'] = 'New post message';
$l['discord_webhooks_new_post_message_description'] = 'New post message content. You can use:<br><strong>{username}</strong> - post author,<br><strong>{posttitle}</strong> - post title,<br><strong>{threadtitle}<strong> - thread title,<br><strong>{boardname}</strong> - board name,<br><strong>{url}</strong> post URL,<br><strong>{field_from_users_database}</strong> ANY field from users table,<br><strong>{fid<span style="color: #d60000">N</span>}</strong> any additional userfield where <strong style="color: #d60000">N</strong> is field ID,<br><strong>{@<span style="color: #d60000">Field Name</span>}</strong> any additional userfield where <strong style="color: #d60000">Field Name</strong> is a name of profile additional field';
$l['discord_webhooks_new_post_message_value'] = '@{username} wrote a new post *{posttitle}* - {url} on *{boardname}* board';
$l['discord_webhooks_new_post_show'] = 'Information display method';
$l['discord_webhooks_new_post_show_description'] = 'Way to show an information about new post';
$l['discord_webhooks_new_post_color'] = 'New post label color';
$l['discord_webhooks_new_post_color_description'] = 'You have to use RGB color HEX value, e.g. #CC9977';
$l['discord_webhooks_new_post_chars_limit'] = 'Posts - Rich text characters limit';
$l['discord_webhooks_new_post_chars_limit_description'] = 'Only for rich text message. If set to 0 or below, it will send the data (avatar, title, etc) without the description. Please notice that, discord message limit is 2000 characters! It is recommended to set a number below this value';
$l['discord_webhooks_new_post_url'] = 'Discord Webhooks URL for new posts';
$l['discord_webhooks_new_post_url_description'] = 'Discord Webhooks endpoint URL only for new post messages. If empty, general Discord Webhook URL will be used';
$l['discord_webhooks_new_post_botname'] = 'Discord BOT name for new posts';
$l['discord_webhooks_new_post_botname_description'] = 'Enter BOT name you want to show. If this field will not be filled in, default BOT name will be used. You can use additional parameters:<br><strong>{username}</strong> - post author,<br><strong>{posttitle}</strong> - post title,<br><strong>{threadtitle}<strong> - thread title,<br><strong>{boardname}</strong> - board name,<br><strong>{url}</strong> post URL,<br><strong>{field_from_users_database}</strong> ANY field from users table,<br><strong>{fid<span style="color: #d60000">N</span>}</strong> any additional userfield where <strong style="color: #d60000">N</strong> is field ID,<br><strong>{@<span style="color: #d60000">Field Name</span>}</strong> any additional userfield where <strong style="color: #d60000">Field Name</strong> is a name of profile additional field';
$l['discord_webhooks_new_post_show_avatar'] = 'Posts - Show user\'s avatar as bot avatar';
$l['discord_webhooks_new_post_show_avatar_description'] = 'Do you want to show user\'s avatar (if available) as bot avatar?';
$l['discord_webhooks_new_post_show_title'] = 'Posts - Rich Text - Show title';
$l['discord_webhooks_new_post_show_title_description'] = 'Do you want to show post title in Rich Text messages?';
$l['discord_webhooks_new_post_show_thumbnail'] = 'Posts - Rich Text - Show user\'s avatars as thumbnails';
$l['discord_webhooks_new_post_show_thumbnail_description'] = 'Do you want to show user\'s avatar as thumbnail picture (if available) in Rich Text messages?';
$l['discord_webhooks_new_post_show_author'] = 'Posts - Rich Text - Show author\'s section';
$l['discord_webhooks_new_post_show_author_description'] = 'Do you want to show user\'s information in author\'s section in Rich Text messages?';
