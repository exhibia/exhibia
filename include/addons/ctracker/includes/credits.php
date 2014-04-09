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


$temp = file("templates/credits.html");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--txt_credits1--", $txt_credits[1], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_credits2--", $txt_credits[2], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_credits3--", $txt_credits[3], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_credits4--", $txt_credits[4], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_credits5--", $txt_credits[5], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_credits6--", $txt_credits[6], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_credits7--", $txt_credits[7], $temp[$i]);
	
	$site .= $temp[$i];
}

?>