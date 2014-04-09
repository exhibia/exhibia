<?php

define('_INVITER_CONFIG_FILE','');

global $_OZCORE_CONFIG;
$_OZCORE_CONFIG = array(

	//Enable debug mode if true
	'debug' => FALSE,

	//Enable GZip compression if true
	'gzip' => TRUE,

	//Enable HTTP 1.1 features where supported if true
	'http1_1' => FALSE,

	//
	'housekeep_captcha' => FALSE,

	'im_as_email' => FALSE,

	'email_as_name' => TRUE,


	'myspace.filter' => 'all',
	
	//Gmail: Use 'all' or 'mycontacts'
	'gmail.filter' => 'all',
	
	'gmail.secure' => FALSE,
	
	//Path to private key file (for secure AuthSub authentication)
	'gmail.ssl_private_key' => NULL,
	


	//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! REMOVE ME
	//'curl_proxy' => 'http://127.0.0.1:8888',

	
	'x'=>''
);

/*ZL_NOENCRYPT*/