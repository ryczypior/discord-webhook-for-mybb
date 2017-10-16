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

Requirements:
=============

* MyBB 1.8+
* curl - for HTTP requests to Discord
* Multibyte String (mb_* string) for multibyte string manipulation

GitHub: https://github.com/ryczypior/discord-webhook-for-mybb
