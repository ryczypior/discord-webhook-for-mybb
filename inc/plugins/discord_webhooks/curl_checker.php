<?php
if (!function_exists('curl_init')) {
    function curl_init(){ return null; }
    if(!defined('DISCORD_WEBHOOK_FORCE_SOCKETS')){
        define('DISCORD_WEBHOOK_FORCE_SOCKETS', 1);
    }
}
if (!function_exists('curl_setopt')) {
    function curl_setopt($resource, $option, $value){}
    if(!defined('DISCORD_WEBHOOK_FORCE_SOCKETS')){
        define('DISCORD_WEBHOOK_FORCE_SOCKETS', 1);
    }
}
if (!function_exists('curl_exec')) {
    function curl_exec($resource){ return ''; }
    if(!defined('DISCORD_WEBHOOK_FORCE_SOCKETS')){
        define('DISCORD_WEBHOOK_FORCE_SOCKETS', 1);
    }
}
if (!function_exists('curl_errno')) {
    function curl_errno($resource){ return 0; }
    if(!defined('DISCORD_WEBHOOK_FORCE_SOCKETS')){
        define('DISCORD_WEBHOOK_FORCE_SOCKETS', 1);
    }
}
if (!function_exists('curl_getinfo')) {
    function curl_getinfo($resource, $option){ return 0; }
    if(!defined('DISCORD_WEBHOOK_FORCE_SOCKETS')){
        define('DISCORD_WEBHOOK_FORCE_SOCKETS', 1);
    }
}
if (!function_exists('curl_errno')) {
    function curl_close($resource){ return 0; }
    if(!defined('DISCORD_WEBHOOK_FORCE_SOCKETS')){
        define('DISCORD_WEBHOOK_FORCE_SOCKETS', 1);
    }
}
if(!defined('CURLOPT_URL')){
    define('CURLOPT_URL', 10002);
}
if(!defined('CURLOPT_POST')){
    define('CURLOPT_POST', 47);
}
if(!defined('CURLOPT_HTTPHEADER')){
    define('CURLOPT_HTTPHEADER', 10023);
}
if(!defined('CURLOPT_RETURNTRANSFER')){
    define('CURLOPT_RETURNTRANSFER', 19913);
}
if(!defined('CURLOPT_SSL_VERIFYHOST')){
    define('CURLOPT_SSL_VERIFYHOST', 81);
}
if(!defined('CURLOPT_SSL_VERIFYPEER')){
    define('CURLOPT_SSL_VERIFYPEER', 64);
}
if(!defined('CURLOPT_POSTFIELDS')){
    define('CURLOPT_POSTFIELDS', 10015);
}
if(!defined('CURLINFO_HTTP_CODE')){
    define('CURLINFO_HTTP_CODE', 2097154);
}
