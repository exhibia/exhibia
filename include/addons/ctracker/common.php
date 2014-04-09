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

include('includes/config.inc.php');
if(isset($_POST['ct_borddir'])) {$ct_borddir = $_POST['ct_borddir'];}



### NO EDIT! #########################################


	// create path for windows or unix
	#####################################################################
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {$is_windows = true;}

	if (isset($is_windows)) {$ct_dir = str_replace('\common.php', '', __FILE__);
	} else {$ct_dir  = str_replace('/common.php', '', __FILE__);}
	
	if (isset($is_windows)) {$_SERVER["DOCUMENT_ROOT"] = str_replace("/", '\\', $_SERVER["DOCUMENT_ROOT"]);}

	$ct_dir  = str_replace($_SERVER["DOCUMENT_ROOT"], '',$ct_dir);

	if ($ct_dir{0} != '\\' AND $ct_dir{0} != '/') { // substr()
		if (isset($is_windows)) {
			$ct_dir = '\\'.$ct_dir;
		} else {
			$ct_dir = '/'.$ct_dir;
		}
	}
	
	if (isset($is_windows)) {$ct_dir = str_replace("\\", '/', $ct_dir);}

	$ct_borddir		= "http://".$_SERVER['HTTP_HOST'].$ct_dir;
	$ct_imagedir	= $ct_borddir . '/images/';
	#####################################################################

if (isset($is_windows)) {$ct_filedir = str_replace("/", '\\', $ct_dir);}


#echo $ct_dir.'<br />';
#echo $ct_filedir.'<br />';
#echo 'C:\xampp\htdocs\http\CTXtra_v1.5.07\ctracker<br />';	
#echo $_SERVER['DOCUMENT_ROOT'];


$ct_sourcedir	= dirname(__FILE__);
$site			= '';
######################################################



?>