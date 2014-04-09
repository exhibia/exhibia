<?php
//@api
function oz_set_config($key,$value) {
	global $_OZCORE_CONFIG;
	if (!isset($_OZCORE_CONFIG)) $_OZCORE_CONFIG=array();
	$_OZCORE_CONFIG[$key]=$value;
}
//@api
function oz_get_config($key,$default=NULL) {
	global $_OZCORE_CONFIG;
	if (!isset($_OZCORE_CONFIG)) return $default;
	return isset($_OZCORE_CONFIG[$key]) ? $_OZCORE_CONFIG[$key] : $default;
}
//@api
function oz_defined_config($key) {
	global $_OZCORE_CONFIG;
	if (!isset($_OZCORE_CONFIG)) return false;
	return isset($_OZCORE_CONFIG[$key]) && $_OZCORE_CONFIG[$key]!=='' && $_OZCORE_CONFIG[$key]!==NULL;
}


include(dirname(__FILE__)."/abiconfig.php");

if (defined('_INVITER_DEBUG')) oz_set_config('debug',_INVITER_DEBUG==1);
if (defined('_INVITER_GZIP')) oz_set_config('gzip',_INVITER_GZIP==1);
if (defined('_INVITER_HTTP1_1')) oz_set_config('http1_1',_INVITER_HTTP1_1==TRUE);
if (defined('_INVITER_PROXY')) oz_set_config('curl_proxy',_INVITER_PROXY);
if (defined('_INVITER_PROXYPORT')) oz_set_config('curl_proxyport',_INVITER_PROXYPORT);
if (defined('_INVITER_PROXYTYPE')) oz_set_config('curl_proxytype',_INVITER_PROXYTYPE);
if (defined('_INVITER_HOUSEKEEP_CACHE')) oz_set_config('housekeep_captcha',_INVITER_HOUSEKEEP_CACHE==1);
if (defined('_INVITER_CAPTCHA_FILE_PATH')) oz_set_config('captcha_file_path',_INVITER_CAPTCHA_FILE_PATH);
if (defined('_INVITER_CAPTCHA_URI_PATH')) oz_set_config('captcha_uri_path',_INVITER_CAPTCHA_URI_PATH);
if (defined('_INVITER_IM_AS_EMAIL')) oz_set_config('im_as_email',_INVITER_IM_AS_EMAIL==TRUE);
if (defined('_INVITER_EMAIL_AS_NAME')) oz_set_config('email_as_name',_INVITER_EMAIL_AS_NAME==TRUE);


include(dirname(__FILE__)."/lib/oz_main.php");