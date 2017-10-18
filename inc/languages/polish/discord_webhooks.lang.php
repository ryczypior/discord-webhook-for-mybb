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
$l['discord_webhook_name'] = 'Discord Webhooks dla forum MyBB';
$l['discord_webhook_description'] = 'Wysyła informacje o nowych wątkach i postach używsając Discord Webhooks';
$l['discord_webhook_settinggroups_title'] = 'Discord Webhooks dla MyBB';
$l['discord_webhook_settinggroups_description'] = 'Ustawienia wtyczki Discord Webhooks.';
$l['discord_webhooks_enabled'] = 'Wtyczka aktywna';
$l['discord_webhooks_enabled_description'] = 'Czy wtyczka jest włączona?';
$l['discord_webhooks_url'] = 'URL do Discord Webhooks';
$l['discord_webhooks_url_description'] = 'Adres URL końcówki Discord Webhooks utworzonej na stronie opcji generowanie Webhooks w kliencie Discord (URL podobny do: https://discordapp.com/api/webhooks/XXX/YYY)';
$l['discord_webhooks_forums'] = 'Dostępne tablice';
$l['discord_webhooks_forums_description'] = 'Tablice, z których informacje o nowych wątkach/postach są wysyłane';
$l['discord_webhooks_botname'] = 'Nazwa BOTa Discord';
$l['discord_webhooks_botname_description'] = 'Podaj nazwę BOTa, która ma być wyświetlana przy wiadomości';
$l['discord_webhooks_show'] = 'Sposób wyświetlania informacji';
$l['discord_webhooks_show_description'] = 'Wybierz sposób wyświetlania informacji';
$l['discord_webhooks_show_n0'] = 'Tylko wiadomość z informacją';
$l['discord_webhooks_show_n1'] = 'Wiadomość z informacją wraz z krótką wersją zawartości (autor, tytuł, wiadomość do 100 znaków)';
$l['discord_webhooks_show_n2'] = 'Wiadomość z informacją wraz z rozszerzoną wersją zawartości (autor, tytuł, wiadomość do 1000 znaków, awatar)';
$l['discord_webhooks_new_post_message'] = 'Wiadomość o nowym poście';
$l['discord_webhooks_new_post_message_description'] = 'Zawartość wiadomości o nowym poście. Możesz użyć:<br><strong>{username}</strong> - nazwa autora posta,<br><strong>{title}</strong> - tytuł posta,<br><strong>{threadtitle}<strong> - tytuł wątku,<br><strong>{boardname}</strong> - nazwa działu,<br><strong>{url}</strong> adres URL posta';
$l['discord_webhooks_new_post_message_value'] = '@{username} napisał(-a) nowy post *{posttitle}* - {url} w dziale *{boardname}*';
$l['discord_webhooks_new_thread_message'] = 'Wiadomość o nowym wątku';
$l['discord_webhooks_new_thread_message_description'] = 'Zawartość wiadomości o nowym wątku. Możesz użyć:<br><strong>{username}</strong> - nazwa autora wątku,<br><strong>{title}</strong> - tytuł wątku,<br><strong>{boardname}</strong> - nazwa działu,<br><strong>{url}</strong> adres URL wątku';
$l['discord_webhooks_new_thread_message_value'] = '@{username} utworzył(-a) nowy wątek *{threadtitle}* - {url} w dziale *{boardname}*';

$l['discord_webhooks_ignored_forums'] = 'Ignorowane działy';
$l['discord_webhooks_ignored_forums_description'] = 'Działy, z których wątki i posty mają być ignorowane';
$l['discord_webhooks_new_thread_enabled'] = 'Wysyłaj informacje o nowych wątkach';
$l['discord_webhooks_new_thread_enabled_description'] = 'Czy wysyłać informacje o nowych wątkach?';
$l['discord_webhooks_new_post_enabled'] = 'Wysyłaj informacje o nowych postach';
$l['discord_webhooks_new_thread_enabled_description'] = 'Czy wysyłać informacje o nowych postach?';
