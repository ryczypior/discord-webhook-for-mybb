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
class DiscordWebhook {

    protected $endpointURL = null;

    protected function __construct($mybb, $fid) {
        if (!$mybb->settings['discord_webhooks_enabled'] || empty($mybb->settings['discord_webhooks_forums'])) {
            throw new Exception('Plugin is not enabled');
        }
        $fids = explode(',', $mybb->settings['discord_webhooks_forums']);
        if (!in_array($fid, $fids) && $mybb->settings['discord_webhooks_forums'] != -1) {
            throw new Exception('Board is not enabled');
        }
        if (strpos($mybb->settings['discord_webhooks_url'], 'https://discordapp.com/api/webhooks/') === false) {
            throw new Exception('Invalid Discord Webhook URL');
        }
        $this->endpointURL = $mybb->settings['discord_webhooks_url'];
    }

    protected function send($username, $message, $avatar = null, $embeds = null, $tts = false) {
        $push = json_encode(array(
            'username' => $username,
            'avatar_url' => $avatar,
            'content' => $message,
            'embeds' => $embeds,
            'tts' => $tts,
        ));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->endpointURL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $push);
        $result = curl_exec($ch);
        // Check for errors and display the error message
        if ($errno = curl_errno($ch)) {
            $error_message = curl_strerror($errno);
            throw new \Exception("cURL error ({$errno}):\n {$error_message}");
        }
        $json_result = json_decode($result, true);
        if (($httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE)) != 204) {
            throw new \Exception($httpcode . ':' . $result);
        }
        curl_close($ch);
        return $this;
    }

    protected function getFullUrl($uri) {
        $proto = 'http://';
        if ($_SERVER["https"] == "on" || $_SERVER["https"] == 1 || $_SERVER['SERVER_PORT'] == 443) {
            $proto = 'https://';
        }
        $ret = $proto . $_SERVER['HTTP_HOST'] . $uri;
        return $ret;
    }

    static public function newThreadPost($entry) {
        global $mybb, $db, $lang;
        $lang->load('discord_webhooks');
        require_once MYBB_ROOT . "inc/class_parser.php";
        try {
            if ($entry->return_values['visible'] == 1) {
                $discordWebhook = new self($mybb, $entry->data['fid']);
                $url = '';
                $replace = [
                    'username' => $entry->post_insert_data['username'],
                    'posttitle' => $entry->post_insert_data['subject'],
                    'threadtitle' => $entry->post_insert_data['subject'],
                    'boardname' => '',
                    'url' => '',
                ];
                if (!empty($entry->thread_insert_data)) {
                    $replace['url'] = $discordWebhook->getFullUrl('/showthread.php?tid=' . $entry->post_insert_data['tid']);
                    $message = $mybb->settings['discord_webhooks_new_thread_message'];
                    if (empty($message)) {
                        $message = $lang->discord_webhooks_new_thread_message_value;
                    }
                } else {
                    $replace['url'] = $discordWebhook->getFullUrl('/showthread.php?tid=' . $entry->post_insert_data['tid'] . '&pid=' . $entry->return_values['pid'] . '#pid' . $entry->return_values['pid']);
                    $message = $mybb->settings['discord_webhooks_new_post_message'];
                    if (empty($message)) {
                        $message = $lang->discord_webhooks_new_post_message_value;
                    }
                }
                if ($entry->post_insert_data['fid'] > 0) {
                    $query = $db->simple_select("forums", "name", "fid='{$entry->post_insert_data['fid']}'");
                    $replace['boardname'] = $db->fetch_field($query, "name");
                }
                $replace['threadtitle'] = $entry->post_insert_data['subject'];
                $replace['posttitle'] = $entry->post_insert_data['subject'];
                foreach ($replace as $from => $to) {
                    $message = str_replace('{'.$from.'}', $to, $message);
                }
                $message = preg_replace(['/\[.+?\]/is', '/\\\n/is', '/\\\r/is'], ['', "\n", "\r"], $message);
                
                $embeds = null;
                if (!empty($mybb->settings['discord_webhooks_show'])) {
                    $thumbnail = null;
                    $msg = preg_replace(['/\[.+?\]/is', '/\\\n/is', '/\\\r/is'], ['', "\n", "\r"], $entry->post_insert_data['message']);
                    $limit = 1000;
                    if($mybb->settings['discord_webhooks_show'] == 1){
                        $limit = 100;
                    } else {
                        $query = $db->simple_select("users", "avatar", "uid='{$entry->post_insert_data['uid']}'");
                        $avatar = $db->fetch_field($query, "avatar");
                        if (!empty($avatar)) {
                            $thumbnail = array(
                                'url' => $discordWebhook->getFullUrl($avatar),
                            );
                        }
                    }
                    if(mb_strlen($msg, 'UTF-8') > $limit){
                        $msg = mb_strcut($msg, 0, $limit, 'UTF-8').'...';
                    }
                    $embeds = array(
                        array(
                            'type' => "rich",
                            'title' => $title,
                            'description' => $msg,
                            'url' => $url,
                            'author' => array(
                                'name' => $entry->post_insert_data['username'],
                                'url' => $discordWebhook->getFullUrl('/member.php?action=profile&uid=' . $entry->post_insert_data['uid']),
                                'icon_url' => ''
                            ),
                            'thumbnail' => $thumbnail,
                        ),
                    );
                }
                $discordWebhook->send($mybb->settings['discord_webhooks_botname'], $message, null, $embeds);
            }
        } catch (Exception $ex) {
            
        }
        return true;
    }

}
