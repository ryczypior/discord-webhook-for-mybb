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
require_once __DIR__ . '/curl_checker.php';
if (!class_exists('DiscordWebhook')) {

    class DiscordWebhook {

        protected $endpointURL = null;
        protected $mybb = null;
        protected $suffix = '';

        protected function __construct($mybb, $suffix = '', $webhookurl = null) {
            $this->mybb = $mybb;
            $this->suffix = $suffix;
            if (empty($webhookurl)) {
                $webhookurl = $mybb->settings['discord_webhooks' . $suffix . '_url'];
            }
            if (preg_match('/^\s*https?:\/\/(ptb\.)?discordapp\.com\/api\/webhooks\//i', $webhookurl) == 0) {
                throw new Exception('Invalid Discord Webhook URL');
            }
            $this->endpointURL = $webhookurl;
        }

        private static function log($msg) {
            $logfile = __DIR__ . '/../../../uploads/discord_webhooks.' . date('Y-m-d') . '.log';
            $ret = false;
            if (($f = fopen($logfile, 'a+')) !== false) {
                fwrite($f, date('Y-m-d H:i:s').' '.$msg."\n");
                fclose($f);
                $ret = true;
            }
            return $ret;
        }

        private function sendCURL($message, $webhook) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $webhook);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
            $result = curl_exec($ch);
            // Check for errors and display the error message
            self::log('cURL - webhook: '.$webhook.' ; json: '.$message);
            if ($errno = curl_errno($ch)) {
                $error_message = curl_strerror($errno);
                self::log("cURL error ({$errno}): {$error_message}");
                throw new \Exception("cURL error ({$errno}): {$error_message}");
            }
            $json_result = json_decode($result, true);
            if (($httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE)) != 204) {
                self::log("cURL error ({$httpcode}): {$httpcode}");
                throw new \Exception($httpcode . ':' . $result);
            }
            curl_close($ch);
            self::log("cURL - sent OK - $result");
            return $result;
        }

        private function sendSocket($message, $webhook) {
            $parsed = parse_url($webhook);
            $result = '';
            self::log('SOCKETS - webhook: '.$webhook.' ; json: '.$message);
            if ($f = fsockopen((($parsed['scheme'] == 'https') ? 'ssl://' : '') . $parsed['host'], (($parsed['scheme'] == 'https') ? 443 : 80), $errno, $errmsg, 30)) {
                $out = "POST " . $parsed['path'] . " HTTP/1.0\r\n";
                $out .= "Host: " . $parsed['host'] . "\r\n";
                $out .= "Content-Type: application/json\r\n";
                $out .= "Content-Length: " . strlen($message) . "\r\n\r\n";
                $out .= $message;
                fwrite($f, $out);
                while (!feof($f)) {
                    $result .= fread($f, 4096);
                }
                fclose($f);
                self::log("SOCKETS result: - $result");
            } else {
                self::log("SOCKETS - something goes wrong");
            }
            return $result;
        }

        protected function send($username, $message, $avatar = null, $embeds = null, $tts = false) {
            $push = json_encode(array(
                'username' => $username,
                'avatar_url' => $avatar,
                'content' => $message,
                'embeds' => $embeds,
                'tts' => $tts,
            ), JSON_NUMERIC_CHECK);
            if ($this->mybb->settings['discord_webhooks' . $this->suffix . '_usesocket'] || defined('DISCORD_WEBHOOK_FORCE_SOCKETS')) {
                self::log('Sending message using sockets');
                $this->sendSocket($push, $this->endpointURL);
            } else {
                self::log('Sending message using cURL');
                $this->sendCURL($push, $this->endpointURL);
            }
            return $this;
        }

        protected function getFullUrl($uri) {
            /* $proto = 'http://';
              if ($_SERVER["https"] == "on" || $_SERVER["https"] == 1 || $_SERVER['SERVER_PORT'] == 443) {
              $proto = 'https://';
              }
              $ret = $proto . $_SERVER['HTTP_HOST'] . $uri;
             * 
             */
            $ret = $this->mybb->settings['bburl'] . "/" . str_replace('&amp;', '&', $uri);
            return $ret;
        }

        protected function rn($msg) {
            return preg_replace(array('/\\\n/is', '/\\\r/is'), array("\n", "\r"), $msg);
        }

        protected function escapeMarkdown($msg) {
            $from = array(
                '*',
                '-',
                '_',
                '`',
            );
            $to = array(
                '\\*',
                '\\-',
                '\\_',
                '\\`',
            );
            return str_replace($from, $to, $msg);
        }

        protected function bbCodeToMarkdown($msg) {
            $from = array(
                '|\[b\](.+?)\[/b]|is',
                '|\[i\](.+?)\[/i]|is',
                '|\[u\](.+?)\[/u]|is',
                '|\[s\](.+?)\[/s]|is',
                '|\[code\](.+?)\[/code]|is',
                '|\[php\](.+?)\[/php]|is',
                '|\[url=\"?(.+?)\"?\](.+?)\[/url]|is',
                '|\[([^\]]+?)(=[^\]]+?)?\](.+?)\[/\1\]|is',
            );
            $to = array(
                '**$1**',
                '*$1*',
                '__$1__',
                '--$1--',
                '```$1```',
                "```php\n$1```",
                '[$2]($1)',
                '',
            );
            return preg_replace($from, $to, $msg);
        }

        protected function formatMessage($msg) {
            $ret = $this->rn($msg);
            $ret = $this->escapeMarkdown($ret);
            $ret = $this->bbCodeToMarkdown($ret);
            return $ret;
        }

        protected function getAvatarUrlUpload($avatar) {
            $avatar = preg_replace('/^\.\//', '', $avatar);
            $ret = $this->getFullUrl($avatar);
            return $ret;
        }

        protected function getAvatarUrlDefault($avatar) {
            return $avatar;
        }

        protected function getColorIntFromHex($color) {
            $color = trim(str_replace('#', '', $color));
            return hexdec($color);
        }

        protected function getReplaceTable($uid) {
            global $mybb, $db, $lang;
            $replace = [];
            $query = $db->simple_select("userfields", "*", "ufid='{$uid}'");
            $result = $db->fetch_array($query);
            if (!empty($result)) {
                foreach ($result as $k => $v) {
                    if (preg_match('/^fid.+/', $k)) {
                        $replace[$k] = $v;
                    }
                }
            }
            $query = $db->simple_select("profilefields", "fid, name");
            while ($result = $db->fetch_array($query)) {
                $replace['@' . $result['name']] = $replace['fid' . $result['fid']];
            }
            return $replace;
        }

        static public function newThread($entry, $suffix = '') {
            global $mybb, $db;
            self::log('newThread fired');
            if ($mybb->settings['discord_webhooks' . $suffix . '_new_thread_enabled'] && $mybb->settings['discord_webhooks' . $suffix . '_enabled']) {
                self::log('newThread enabled');
                $color = $mybb->settings['discord_webhooks' . $suffix . '_new_thread_color'];
                if (empty($color)) {
                    $color = '#aaaaaa';
                }
                $webhookurl = null;
                try {
                    if ($entry->return_values['visible'] == 1) {
                        self::log('newThread visible');
                        $fids = explode(',', $mybb->settings['discord_webhooks' . $suffix . '_forums']);
                        $ignoredfids = explode(',', $mybb->settings['discord_webhooks' . $suffix . '_ignored_forums']);
                        if ((!in_array($entry->data['fid'], $fids) && $mybb->settings['discord_webhooks' . $suffix . '_forums'] != -1) || (in_array($entry->data['fid'], $ignoredfids)) || empty($mybb->settings['discord_webhooks' . $suffix . '_forums']) || $mybb->settings['discord_webhooks' . $suffix . '_ignored_forums'] == -1) {
                            self::log('newThread board is not enabled, ID: '.$entry->data['fid']);
                            throw new Exception('Board is not enabled');
                        }
                        $is_member = is_member($mybb->settings['discord_webhooks' . $suffix . '_ignored_usergroups']);
                        if (!empty($is_member)) {
                            self::log('newThread user belongs to disabled usergroup');
                            throw new Exception('User belongs to disabled usergroup');
                        }
                        $discordWebhook = new self($mybb, $suffix, $mybb->settings['discord_webhooks' . $suffix . '_new_thread_url']);
                        $botname = $mybb->settings['discord_webhooks' . $suffix . '_botname'];
                        if (!empty($mybb->settings['discord_webhooks' . $suffix . '_new_thread_botname'])) {
                            $botname = $mybb->settings['discord_webhooks' . $suffix . '_new_thread_botname'];
                        }
                        $url = '';
                        $replace = [];
                        $user = null;
                        if (!empty($entry->post_insert_data['uid'])) {
                            $query = $db->simple_select("users", "*", "uid='{$entry->post_insert_data['uid']}'");
                            $replace = $user = $db->fetch_array($query);
                        }
                        $replace = array_merge($replace, $discordWebhook->getReplaceTable($entry->post_insert_data['uid']), [
                            'username' => $entry->post_insert_data['username'],
                            'posttitle' => $entry->post_insert_data['subject'],
                            'threadtitle' => $entry->post_insert_data['subject'],
                            'boardname' => '',
                            'url' => $discordWebhook->getFullUrl(get_thread_link($entry->return_values['tid'])),
                        ]);
                        $message = $mybb->settings['discord_webhooks' . $suffix . '_new_thread_message'];
                        $thread = array();
                        if ($entry->return_values['tid'] > 0) {
                            $query = $db->simple_select("threads", "*", "tid='{$entry->return_values['tid']}'");
                            $thread = $db->fetch_array($query);
                        }
                        if ($thread['fid'] > 0) {
                            $query = $db->simple_select("forums", "name", "fid='{$thread['fid']}'");
                            $replace['boardname'] = $db->fetch_field($query, "name");
                        }
                        $prefixes = array_map('trim', explode(',', trim($mybb->settings['discord_webhooks' . $suffix . '_new_thread_prefix'])));
                        if (!empty($prefixes) && !empty($prefixes[0])) {
                            if ($thread['prefix'] > 0) {
                                $query = $db->simple_select("threadprefixes", "prefix", "pid='{$thread['prefix']}'");
                                $prefix = $db->fetch_field($query, "prefix");
                                if (!in_array($prefix, $prefixes)) {
                                    self::log('newThread prefix '.$prefix.' not in '.implode(', ', $prefixes));
                                    return false;
                                }
                            } else {
                                self::log('newThread no thread prefix');
                                return false;
                            }
                        }
                        $replace['threadtitle'] = str_replace(['{', '}'], ['\\{', '\\}'], $entry->thread_insert_data['subject']);
                        $replace['posttitle'] = str_replace(['{', '}'], ['\\{', '\\}'], $entry->post_insert_data['subject']);
                        foreach ($replace as $from => $to) {
                            $message = str_replace('{' . $from . '}', $to, $message);
                            $botname = str_replace('{' . $from . '}', $to, $botname);
                        }
                        $message = str_replace(['\\{', '\\}'], ['{', '}'], $message);
                        $message = $discordWebhook->rn($message);
                        $embeds = null;
                        $botavatar = null;
                        $avatar = '';
                        if (!empty($user)) {
                            $author['url'] = $discordWebhook->getFullUrl('member.php?action=profile&uid=' . $entry->post_insert_data['uid']);
                            $avatar = $user['avatar'];
                            $avatartype = $user['avatartype'];
                            if (!empty($avatar)) {
                                if ($avatartype === 'upload') {
                                    $avatar = $discordWebhook->getAvatarUrlUpload($avatar);
                                } else {
                                    $avatar = $discordWebhook->getAvatarUrlDefault($avatar);
                                }
                            } else {
                                $avatar = '';
                            }
                        }
                        if (!empty($avatar) && $mybb->settings['discord_webhooks' . $suffix . '_new_thread_show_avatar']) {
                            $botavatar = $avatar;
                        }
                        if (in_array($mybb->settings['discord_webhooks' . $suffix . '_show'], array(1, 2, 3))) {
                            $thumbnail = null;
                            $title = $entry->post_insert_data['subject'];
                            $url = $replace['url'];
                            $msg = $discordWebhook->formatMessage($entry->post_insert_data['message']);
                            if ($mybb->settings['discord_webhooks' . $suffix . '_show'] == 2) {
                                $msg = $message . "\n\n" . $msg;
                                $message = null;
                            } elseif ($mybb->settings['discord_webhooks' . $suffix . '_show'] == 3) {
                                $message = null;
                            }
                            $author = array(
                                'name' => $entry->post_insert_data['username'],
                                'icon_url' => $avatar
                            );
                            $limit = (int)$mybb->settings['discord_webhooks' . $suffix . '_new_thread_chars_limit'];
                            if ($limit > 2000) {
                                $limit = 2000;
                            }
                            if ($limit <= 0) {
                                $msg = null;
                            }
                            if (!empty($avatar)) {
                                $thumbnail = array(
                                    'url' => $avatar,
                                );
                            }
                            if ($msg !== null && mb_strlen($msg, 'UTF-8') > $limit) {
                                $msg = mb_strcut($msg, 0, $limit - 3, 'UTF-8') . '...';
                            }
                            $color = $discordWebhook->getColorIntFromHex($color);
                            $eArray = array(
                                'type' => "rich",
                                'title' => $title,
                                'url' => $url,
                                'color' => $color,
                                'author' => $author,
                                'thumbnail' => $thumbnail,
                            );
                            if ($msg !== null) {
                                $eArray['description'] = $msg;
                            }
                            if (!$mybb->settings['discord_webhooks' . $suffix . '_new_thread_show_thumbnail']) {
                                unset($eArray['thumbnail']);
                            }
                            if (!$mybb->settings['discord_webhooks' . $suffix . '_new_thread_show_title']) {
                                unset($eArray['title']);
                            }
                            if (!$mybb->settings['discord_webhooks' . $suffix . '_new_thread_show_author']) {
                                unset($eArray['author']);
                            }
                            $embeds = array(
                                $eArray
                            );
                        } else if (in_array($mybb->settings['discord_webhooks' . $suffix . '_show'], array(4))) {
                            $color = $discordWebhook->getColorIntFromHex($color);
                            $embeds = array(
                                array(
                                    'type' => "rich",
                                    'description' => $message,
                                    'color' => $color,
                                ),
                            );
                            $message = null;
                        }
                        self::log('newThread sending message');
                        $discordWebhook->send($botname, $message, $botavatar, $embeds);
                    }
                } catch (Exception $ex) {
                    self::log('newThread Exception: '.$ex->getMessage().' '.$ex->getTraceAsString());
                }
            }
            self::log('newThread ends');
        }

        static public function newPost($entry, $suffix = '') {
            global $mybb, $db;
            self::log('newPost fired');
            if ($mybb->settings['discord_webhooks' . $suffix . '_new_post_enabled']) {
                $color = $mybb->settings['discord_webhooks' . $suffix . '_new_post_color'];
                if (empty($color)) {
                    $color = '#ffffff';
                }
                try {
                    if ($entry->return_values['visible'] == 1) {
                        self::log('newPost visible');
                        $fids = explode(',', $mybb->settings['discord_webhooks' . $suffix . '_forums']);
                        $ignoredfids = explode(',', $mybb->settings['discord_webhooks' . $suffix . '_ignored_forums']);
                        if ((!in_array($entry->data['fid'], $fids) && $mybb->settings['discord_webhooks' . $suffix . '_forums'] != -1) || (in_array($entry->data['fid'], $ignoredfids)) || empty($mybb->settings['discord_webhooks' . $suffix . '_forums']) || $mybb->settings['discord_webhooks' . $suffix . '_ignored_forums'] == -1) {
                            self::log('newPost board is not enabled, ID: '.$entry->data['fid']);
                            //throw new Exception('Board is not enabled');
                            return false;
                        }
                        $is_member = is_member($mybb->settings['discord_webhooks' . $suffix . '_ignored_usergroups']);
                        if (!empty($is_member)) {
                            self::log('newPost user belongs to disabled usergroup');
                            //throw new Exception('User belongs to disabled usergroup');
                            return false;
                        }
                        $discordWebhook = new self($mybb, $suffix, $mybb->settings['discord_webhooks' . $suffix . '_new_post_url']);
                        $botname = $mybb->settings['discord_webhooks' . $suffix . '_botname'];
                        if (!empty($mybb->settings['discord_webhooks' . $suffix . '_new_post_botname'])) {
                            $botname = $mybb->settings['discord_webhooks' . $suffix . '_new_post_botname'];
                        }
                        $url = '';
                        $replace = [];
                        $user = null;
                        $post = array();
                        if (!empty($entry->return_values['pid'])) {
                            $query = $db->simple_select("posts", "*", "pid='{$entry->return_values['pid']}'");
                            $post = $user = $db->fetch_array($query);
                        }
                        $prefixes = array_map('trim', explode(',', trim($mybb->settings['discord_webhooks' . $suffix . '_new_thread_prefix'])));
                        if (!empty($prefixes) && !empty($prefixes[0])) {
                            if ($post['tid'] > 0) {
                                $query = $db->simple_select("threads", "prefix", "tid='{$post['tid']}'");
                                $prefixid = $db->fetch_field($query, "prefix");
                                if ($prefixid > 0) {
                                    $query = $db->simple_select("threadprefixes", "prefix", "pid='{$prefixid}'");
                                    $prefix = $db->fetch_field($query, "prefix");
                                    if (!in_array($prefix, $prefixes)) {
                                        self::log('newPost prefix '.$prefix.' not in '.implode(', ', $prefixes));
                                        return false;
                                    }
                                } else {
                                    self::log('newPost no thread prefix');
                                    return false;
                                }
                            } else {
                                self::log('newPost could not determine thread ID');
                                return false;
                            }
                        }
                        if (!empty($post['uid'])) {
                            $query = $db->simple_select("users", "*", "uid='{$post['uid']}'");
                            $replace = $user = $db->fetch_array($query);
                        }
                        $replace = array_merge($replace, $discordWebhook->getReplaceTable($post['uid']), [
                            'username' => (!empty($user) ? $user['username'] : $entry->post_insert_data['username']),
                            'posttitle' => $post['subject'],
                            'threadtitle' => $entry->post_insert_data['subject'],
                            'boardname' => '',
                            'url' => $discordWebhook->getFullUrl(get_post_link($post['pid'], $post['tid']) . '#pid' . $post['pid']),
                        ]);
                        $message = $mybb->settings['discord_webhooks' . $suffix . '_new_post_message'];
                        if ($post['fid'] > 0) {
                            $query = $db->simple_select("forums", "name", "fid='{$post['fid']}'");
                            $replace['boardname'] = $db->fetch_field($query, "name");
                        }
                        if ($post['tid'] > 0) {
                            $query = $db->simple_select("threads", "subject", "tid='{$post['tid']}'");
                            $replace['threadtitle'] = $db->fetch_field($query, "subject");
                        }
                        $replace['threadtitle'] = str_replace(['{', '}'], ['\\{', '\\}'], $replace['threadtitle']);
                        $replace['posttitle'] = str_replace(['{', '}'], ['\\{', '\\}'], $replace['posttitle']);
                        foreach ($replace as $from => $to) {
                            $message = str_replace('{' . $from . '}', $to, $message);
                            $botname = str_replace('{' . $from . '}', $to, $botname);
                        }
                        $message = str_replace(['\\{', '\\}'], ['{', '}'], $message);
                        $message = $discordWebhook->rn($message);
                        $botavatar = null;
                        $avatar = '';
                        if (!empty($user)) {
                            $author['url'] = $discordWebhook->getFullUrl('member.php?action=profile&uid=' . $entry->post_insert_data['uid']);
                            $avatar = $user['avatar'];
                            $avatartype = $user['avatartype'];
                            if (!empty($avatar)) {
                                if ($avatartype === 'upload') {
                                    $avatar = $discordWebhook->getAvatarUrlUpload($avatar);
                                } else {
                                    $avatar = $discordWebhook->getAvatarUrlDefault($avatar);
                                }
                            } else {
                                $avatar = '';
                            }
                        }
                        if (!empty($avatar) && $mybb->settings['discord_webhooks' . $suffix . '_new_post_show_avatar']) {
                            $botavatar = $avatar;
                        }
                        $embeds = null;
                        if (in_array($mybb->settings['discord_webhooks' . $suffix . '_new_post_show'], array(1, 2, 3))) {
                            $thumbnail = null;
                            $title = $entry->post_insert_data['subject'];
                            $url = $replace['url'];
                            $msg = $discordWebhook->formatMessage($entry->post_insert_data['message']);
                            if ($mybb->settings['discord_webhooks' . $suffix . '_new_post_show'] == 2) {
                                $msg = $message . "\n\n" . $msg;
                                $message = null;
                            } elseif ($mybb->settings['discord_webhooks' . $suffix . '_new_post_show'] == 3) {
                                $message = null;
                            }
                            $author = array(
                                'name' => $entry->post_insert_data['username'],
                                'icon_url' => $avatar
                            );
                            $limit = (int)$mybb->settings['discord_webhooks' . $suffix . '_new_post_chars_limit'];
                            if ($limit > 2000) {
                                $limit = 2000;
                            }
                            if ($limit <= 0) {
                                $msg = null;
                            }
                            if (!empty($avatar)) {
                                $thumbnail = array(
                                    'url' => $avatar,
                                );
                            }
                            if ($msg !== null && mb_strlen($msg, 'UTF-8') > $limit) {
                                $msg = mb_strcut($msg, 0, $limit, 'UTF-8') . '...';
                            }
                            $color = $discordWebhook->getColorIntFromHex($color);
                            $eArray = array(
                                'type' => "rich",
                                'title' => $title,
                                'url' => $url,
                                'color' => $color,
                                'author' => $author,
                                'thumbnail' => $thumbnail,
                            );
                            if ($msg !== null) {
                                $eArray['description'] = $msg;
                            }
                            if (!$mybb->settings['discord_webhooks' . $suffix . '_new_post_show_thumbnail']) {
                                unset($eArray['thumbnail']);
                            }
                            if (!$mybb->settings['discord_webhooks' . $suffix . '_new_post_show_title']) {
                                unset($eArray['title']);
                            }
                            if (!$mybb->settings['discord_webhooks' . $suffix . '_new_post_show_author']) {
                                unset($eArray['author']);
                            }
                            $embeds = array(
                                $eArray
                            );
                        } else if (in_array($mybb->settings['discord_webhooks' . $suffix . '_new_post_show'], array(4))) {
                            $color = $discordWebhook->getColorIntFromHex($color);
                            $embeds = array(
                                array(
                                    'type' => "rich",
                                    'description' => $message,
                                    'color' => $color,
                                ),
                            );
                            $message = null;
                        }
                        self::log('newPost sending message');
                        $discordWebhook->send($botname, $message, $botavatar, $embeds);
                    }
                } catch (Exception $ex) {
                    self::log('newPost exception: '.$ex->getMessage().' '.$ex->getTraceAsString());
                }
            }
            self::log('newPost ends');
        }

        static protected function dateReplace($m) {
            return strftime($m[1]);
        }

        static public function newRegistration($suffix = '') {
            global $mybb, $db, $user_info;
            $entry = $user_info;
            if ($mybb->settings['discord_webhooks' . $suffix . '_new_registration_enabled']) {
                $color = $mybb->settings['discord_webhooks' . $suffix . '_new_registration_color'];
                if (empty($color)) {
                    $color = '#ffffff';
                }
                try {
                    $discordWebhook = new self($mybb, $suffix, $mybb->settings['discord_webhooks' . $suffix . '_new_registration_url']);
                    $botname = $mybb->settings['discord_webhooks' . $suffix . '_botname'];
                    if (!empty($mybb->settings['discord_webhooks' . $suffix . '_new_registration_botname'])) {
                        $botname = $mybb->settings['discord_webhooks' . $suffix . '_new_registration_botname'];
                    }
                    $replace = $entry;
                    $user = null;
                    $post = array();
                    if (!empty($entry['uid'])) {
                        $query = $db->simple_select("users", "*", "uid='{$entry['uid']}'");
                        $post = $user = $db->fetch_array($query);
                        $replace = array_merge($replace, $user);
                    }
                    $replace = array_merge($replace, $discordWebhook->getReplaceTable($post['uid']), [
                        'username' => (!empty($user) ? $user['username'] : $entry['username']),
                    ]);
                    $message = $mybb->settings['discord_webhooks' . $suffix . '_new_registration_message'];
                    foreach ($replace as $from => $to) {
                        $message = str_replace('{' . $from . '}', $to, $message);
                        $botname = str_replace('{' . $from . '}', $to, $botname);
                    }
                    $message = preg_replace_callback('/{date (.+?)}/is', 'self::dateReplace', $message);
                    $botname = preg_replace_callback('/{date (.+?)}/is', 'self::dateReplace', $botname);
                    $embeds = null;
                    if (in_array($mybb->settings['discord_webhooks' . $suffix . '_new_registration_show_style'], array(1))) {
                        $msg = $message;
                        $message = null;
                        $color = $discordWebhook->getColorIntFromHex($color);
                        $eArray = array(
                            'type' => "rich",
                            'description' => $msg,
                            'color' => $color,
                        );
                        $embeds = array(
                            $eArray
                        );
                    }
                    $discordWebhook->send($botname, $message, null, $embeds);
                } catch (Exception $ex) {

                }
            }
        }

        static public function __callStatic($name, $arguments) {
            $reflection = new ReflectionClass('DiscordWebhook');
            $staticMethods = $reflection->getMethods(ReflectionMethod::IS_STATIC | ReflectionMethod::IS_PUBLIC);
            foreach ($staticMethods as $method) {
                $staticMethod = $method->getName();
                if (preg_match('/^' . preg_quote($staticMethod, '/') . '(.*)$/', $name, $o) > 0) {
                    self::$staticMethod($arguments[0], $o[1]);
                    break;
                }
            }
        }

    }

}