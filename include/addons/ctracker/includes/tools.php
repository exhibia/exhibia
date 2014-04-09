<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.de			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################

if (!defined('CTXTRA'))
	die ("Hacking attempt...");


// allow_url_fopen
if (ini_get('allow_url_fopen') == 1) {
    $temp_allow_url_fopen = '= <span style="color:#008000; font-weight:bold">On</span>';
} else {
    $temp_allow_url_fopen = '= <span style="color:#FF0000; font-weight:bold">Off</span>';
}
// safe_mode
if (ini_get('safe_mode') == 1) {
    $temp_safe_mode = '= <span style="color:#008000; font-weight:bold">On</span>';
} else {
    $temp_safe_mode = '= <span style="color:#FF0000; font-weight:bold">Off</span>';
}


// PHP Version
$temp_phpversion 			= phpversion();

// SQL Version
//$temp_sqlversion			= '';

// Serverinfos
if (!isset($_SERVER['SERVER_SIGNATURE'])) {
	$temp_server_signature = '';	
} else {
	$temp_server_signature = $_SERVER['SERVER_SIGNATURE'];
}

$temp_server_software 		= $_SERVER['SERVER_SOFTWARE'];
$temp_server_addr 			= $_SERVER['SERVER_ADDR'];
$temp_server_os				= PHP_OS;
$temp_http_accept_language 	= $_SERVER['HTTP_ACCEPT_LANGUAGE'];
$temp_server_document_root	= $_SERVER['DOCUMENT_ROOT'];
$temp_sqlversion 			= db_get_client_info();



$temp = file("templates/tools.html");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--allow_url_fopen--", "$temp_allow_url_fopen", $temp[$i]);
	$temp[$i] = ereg_replace("!--safe_mode--", "$temp_safe_mode", $temp[$i]);
	$temp[$i] = ereg_replace("!--phpversion--", "$temp_phpversion", $temp[$i]);
	$temp[$i] = ereg_replace("!--sqlversion--", "$temp_sqlversion", $temp[$i]);
	$temp[$i] = ereg_replace("!--server_os--", "$temp_server_os", $temp[$i]);
	$temp[$i] = ereg_replace("!--server_signature--", "$temp_server_signature", $temp[$i]);
	$temp[$i] = ereg_replace("!--server_software--", "$temp_server_software", $temp[$i]);
	$temp[$i] = ereg_replace("!--server_addr--", "$temp_server_addr", $temp[$i]);
	$temp[$i] = ereg_replace("!--http_accept_language--", "$temp_http_accept_language", $temp[$i]);
	$temp[$i] = ereg_replace("!--server_document_root--", "$temp_server_document_root", $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_credits1--", $txt_tools[1], $temp[$i]);
	$site .= $temp[$i];
}


?>