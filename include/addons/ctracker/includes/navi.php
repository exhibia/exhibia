<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.de			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################

if (!isset($_REQUEST['hack']) AND !isset($_REQUEST['ipfilter']) AND !isset($_REQUEST['spamfilter']) AND !isset($_REQUEST['settings']) AND !isset($_REQUEST['help']) AND !isset($_REQUEST['credits']) AND !isset($_REQUEST['tools']) AND !isset($_REQUEST['moreworm'])) {
		$navi_home = 'style="border-right:1px solid #999999; background-color:#E7E7E7; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:50px';
	} else {
		$navi_home = 'onmouseover="cOnNavi(this);" onmouseout="cOutNavi(this);" style="background-color:#c2e7d8; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:50px';}
if ((isset($_REQUEST['hack']) AND $_REQUEST['hack'] == "true") OR (isset($_REQUEST['moreworm']) AND $_REQUEST['moreworm'] == "true"))  {
		$navi_hack = 'style="border-left:1px solid #999999; border-right:1px solid #999999; background-color:#E7E7E7; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:100px';
	} else {
		$navi_hack = 'onmouseover="cOnNavi(this);" onmouseout="cOutNavi(this);" style="background-color:#c2e7d8; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:100px';}
if (isset($_REQUEST['ipfilter']) AND $_REQUEST['ipfilter'] == "true") {
		$navi_ipfilter = 'style="border-left:1px solid #999999; border-right:1px solid #999999; background-color:#E7E7E7; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:60px';
	} else {
		$navi_ipfilter = 'onmouseover="cOnNavi(this);" onmouseout="cOutNavi(this);" style="background-color:#c2e7d8; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:60px';}
if (isset($_REQUEST['spamfilter']) AND $_REQUEST['spamfilter'] == "true") {
		$navi_spamfilter = 'style="border-left:1px solid #999999; border-right:1px solid #999999; background-color:#E7E7E7; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:80px';
	} else {
		$navi_spamfilter = 'onmouseover="cOnNavi(this);" onmouseout="cOutNavi(this);" style="background-color:#c2e7d8; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:80px';}
if (isset($_REQUEST['settings']) AND $_REQUEST['settings'] == "true") {
		$navi_einstellungen = 'style="border-left:1px solid #999999; border-right:1px solid #999999; background-color:#E7E7E7; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:90px';
	} else {
		$navi_einstellungen = 'onmouseover="cOnNavi(this);" onmouseout="cOutNavi(this);" style="background-color:#c2e7d8; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:90px';}
if (isset($_REQUEST['tools']) AND $_REQUEST['tools'] == "true") {
		$navi_tools = 'style="border-left:1px solid #999999; border-right:1px solid #999999; background-color:#E7E7E7; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:80px';
	} else {
		$navi_tools = 'onmouseover="cOnNavi(this);" onmouseout="cOutNavi(this);" style="background-color:#c2e7d8; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:80px';}
if (isset($_REQUEST['help']) AND $_REQUEST['help'] == "true") {
		$navi_hilfe = 'style="border-left:1px solid #999999; border-right:1px solid #999999; background-color:#E7E7E7; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:40px';
	} else {
		$navi_hilfe = 'onmouseover="cOnNavi(this);" onmouseout="cOutNavi(this);" style="background-color:#c2e7d8; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:40px';}
if (isset($_REQUEST['credits']) AND $_REQUEST['credits'] == "true") {
		$navi_credits = 'style="border-left:1px solid #999999; border-right:1px solid #999999; background-color:#E7E7E7; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:40px';
	} else {
		$navi_credits = 'onmouseover="cOnNavi(this);" onmouseout="cOutNavi(this);" style="background-color:#c2e7d8; cursor:pointer; vertical-align:middle; text-align:center; color:#8000FF; line-height:20px; width:40px';}

$temp = file($ct_sourcedir."/templates/navi.html");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--navi_home--", $navi_home, $temp[$i]);
	$temp[$i] = ereg_replace("!--navi_hack--", $navi_hack, $temp[$i]);
	$temp[$i] = ereg_replace("!--navi_ipfilter--", $navi_ipfilter, $temp[$i]);
	$temp[$i] = ereg_replace("!--navi_spamfilter--", $navi_spamfilter, $temp[$i]);
	$temp[$i] = ereg_replace("!--navi_einstellungen--", $navi_einstellungen, $temp[$i]);
	$temp[$i] = ereg_replace("!--navi_tools--", $navi_tools, $temp[$i]);
	$temp[$i] = ereg_replace("!--navi_hilfe--", $navi_hilfe, $temp[$i]);
	$temp[$i] = ereg_replace("!--navi_credits--", $navi_credits, $temp[$i]);
	
	$temp[$i] = ereg_replace("!--txt_navi1--", $txt_navi[1], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_navi2--", $txt_navi[2], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_navi3--", $txt_navi[3], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_navi4--", $txt_navi[4], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_navi5--", $txt_navi[5], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_navi6--", $txt_navi[6], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_navi7--", $txt_navi[7], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_navi8--", $txt_navi[8], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_navi9--", $txt_navi[9], $temp[$i]);
	
	$site .= $temp[$i];
}
	
?>