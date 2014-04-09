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

include_once('languages/'.$ct_lang.'/login.php');

// Logout wenn Logout
if (isset($logout) AND isset($_SESSION)) {
	$temp = file("templates/errors/login/3.html");
	$temp_logout = '';
	for($i=0;$i<count($temp);$i++){
		$temp[$i] = ereg_replace("!--txt_login6--", $txt_login[6], $temp[$i]);
		$temp_logout .= $temp[$i];
	}
	
// Logout wenn Session abgelaufen
} elseif (isset($session_break) AND !isset($_SESSION)) {
	$temp = file("templates/errors/login/4.html");
	$temp_logout = '';
	for($i=0;$i<count($temp);$i++){
		$temp[$i] = ereg_replace("!--txt_login7--", $txt_login[7], $temp[$i]);
		$temp_logout .= $temp[$i];
	}
	
} else {
	$temp_logout = '';
}

// Template Header laden
include_once('includes/header.php');

// Template Login laden
$temp = file("templates/login.html");
include( "languages/".$ct_lang."/footer.php");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--logout--", $temp_logout, $temp[$i]);
	$temp[$i] = ereg_replace("!--falselogin--", $temp_falselogin, $temp[$i]);
	$temp[$i] = ereg_replace("!--versuche--", $versuche, $temp[$i]);
	$temp[$i] = ereg_replace("!--versionsinfo_login--", $txt_footer[1], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_login1--", $txt_login[1], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_login8--", $txt_login[8], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_login9--", $txt_login[9], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_login10--", $txt_login[10], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_login11--", $txt_login[11], $temp[$i]);

	$site .= $temp[$i];
}

?>