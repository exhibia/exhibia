<?php
include_once 'data/inviterentry.php';

$inviterentry=  InviterEntryFactory::getInviterEntry();

$openinviter_settings = array(
    'username' => $inviterentry->getUsername(),
    'private_key' => $inviterentry->getApikey(),
    'cookie_path' => $openinviter_cookiepath,
    'message_body' => $inviterentry->getBody(),
    'message_subject' => $inviterentry->getSubject(),
    'transport' => "curl",
    'local_debug' => "on_error",
    'remote_debug' => "",
    'hosted' => "",
    'proxies' => array(),
    'stats' => "1",
    'plugins_cache_time' => "1800",
    'plugins_cache_file' => "oi_plugins.php",
    'update_files' => "1",
    'stats_user' => "",
    'stats_password' => ""
);
?>