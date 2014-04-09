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

include_once( $ct_sourcedir."/languages/".$ct_lang."/header.php");

if (isset($_GET['download'])) {
	$file	= $ct_sourcedir."/log/".$_GET['download'];
	$size	= filesize($file);
	header("Content-Type: application/text");
	header("Content-Type: text/xml");
	header("Content-Length: ".$size);
	header("Content-Disposition: attachment; filename=".$_GET['download']);
	readfile($file);	
}


if ($update_version_number > $version_number) {
	$version_number = $update_version_number;
}

if ($update_revision > $revision_number) {
	$revision_number = $update_revision;
}

if(url_ok_or_not($ctxtra_url)) {
	$usonline = '<script language="text/javascript" src="'.$ctxtra_url.'remote/usonline.php"></script>';
} else {
	$usonline = '';
}


if ((isset($_GET['hack']) AND $_GET['hack'] == "true") OR (isset($_GET['moreworm']) AND $_GET['moreworm'] == "true")) {
	$seitenname = $txt_header[2];
} elseif (isset($_GET['ipfilter']) AND $_GET['ipfilter'] == "true") {
	$seitenname = $txt_header[3];
} elseif (isset($_GET['spamfilter']) AND $_GET['spamfilter'] == "true") {
	$seitenname = $txt_header[4];
} elseif (isset($_GET['settings']) AND $_GET['settings'] == "true") {
	$seitenname = $txt_header[5];
} elseif (isset($_GET['help']) AND $_GET['help'] == "true") {
	$seitenname = $txt_header[6];
} elseif (isset($_GET['credits']) AND $_GET['credits'] == "true") {
	$seitenname = $txt_header[7];
} elseif (isset($_GET['login']) AND $_GET['login'] == "true") {
	$seitenname = $txt_header[8];
} elseif (isset($_GET['logout']) AND $_GET['logout'] == "true") {
	$seitenname = $txt_header[9];
} elseif (isset($_GET['tools']) AND $_GET['tools'] == "true") {
	$seitenname = $txt_header[10];
} elseif (isset($_GET['home']) AND $_GET['home'] == "true") {
	$seitenname = $txt_header[1];
} else {
	$seitenname = "<< none title >>";
}

$temp = file($ct_sourcedir."/templates/header.html");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--usonline--", $usonline, $temp[$i]);
	$temp[$i] = ereg_replace("!--seitenname--", $seitenname, $temp[$i]);
	
	$site .= $temp[$i];
}

?>