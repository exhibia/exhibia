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

$temp = file("templates/help.html");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--txt_help1--", $txt_help[1], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help2--", $txt_help[2], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help3--", $txt_help[3], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help4--", $txt_help[4], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help5--", $txt_help[5], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help6--", $txt_help[6], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help7--", $txt_help[7], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help8--", $txt_help[8], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help9--", $txt_help[9], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help10--", $txt_help[10], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help11--", $txt_help[11], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help12--", $txt_help[12], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help13--", $txt_help[13], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help14--", $txt_help[14], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help15--", $txt_help[15], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help16--", $txt_help[16], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help17--", $txt_help[17], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help18--", $txt_help[18], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help19--", $txt_help[19], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_help20--", $txt_help[20], $temp[$i]);

	
	$temp[$i] = ereg_replace("!--ct_filedir--", "$ct_filedir", $temp[$i]);
	$temp[$i] = ereg_replace("!--server_document_root--", $_SERVER['DOCUMENT_ROOT'], $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_db_user--", $ct_db_user, $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_db_pass_crypt--", crypt($ct_db_pass,CRYPT_STD_DES), $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_db_pass--", "$ct_db_pass", $temp[$i]);
	
	$site .= $temp[$i];
}

?>