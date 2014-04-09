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

if(isset($_POST['language'])) {
	$ct_lang = $_POST['language'];
	include('languages/'.$_POST['language'].'/install.php');
}

// Wenn update ausgeführt wurde
if(isset($_GET['update_ready'])) {
	if(isset($_POST['db_user'])) {$ct_db_user = $_POST['db_user'];}
	if(isset($_POST['db_pass'])) {$ct_db_pass = $_POST['db_pass'];}
	if(isset($_POST['email'])) {$ct_email = $_POST['email'];}
	if(isset($_POST['ct_borddir'])) {$ct_borddir = $_POST['ct_borddir'];}
	if(isset($_POST['filedir'])) {$ct_filedir = $_POST['filedir'];}
	if(isset($_POST['atack_email'])) {$ct_atack_email = $_POST['atack_email'];}
	if(isset($_POST['auto_iplist'])) {$ct_auto_iplist = $_POST['auto_iplist'];}
	if(isset($_POST['ftp_user'])) {$ct_ftp_user = $_POST['ftp_user'];}
	if(isset($_POST['ftp_pass'])) {$ct_ftp_pass = $_POST['ftp_pass'];}
	if(isset($_POST['ftp_server'])) {$ct_ftp_server = $_POST['ftp_server'];}
	if(isset($_POST['ftp_ordner'])) {$ct_ftp_ordner = $_POST['ftp_ordner'];}	
}

$fp_borddir = $ct_borddir."/ctracker.php";
$fp_filedir = "http://".$_SERVER['HTTP_HOST'].$ct_dir."/ctracker.php";

if (!url_ok_or_not($fp_borddir)) {
	$color_ct_borddir = 'style="background-color:#ff0000; color:#ffffff"';
	$isset_borddir = "FALSE";
	$info_einstellungen = info_einstellungen();
} else {$color_ct_borddir=""; $isset_borddir="";}

if (!url_ok_or_not($fp_filedir)) {
	$color_ct_filedir = 'style="background-color:#ff0000; color:#ffffff"';
	$isset_filedir = "FALSE";
	$info_einstellungen = info_einstellungen();
} else {$color_ct_filedir=""; $isset_filedir="";}

if ($ct_email == "deine@email.de" OR empty($ct_email)) {
	$color_email = 'style="background-color:#ff0000; color:#ffffff"';
	$info_einstellungen = info_einstellungen();
} else {$color_email="";}

// installations infos aktualisieren
ct_log_ctxtras();

// Template Header laden
include_once('includes/header.php');

include('languages/'.$ct_lang.'/errors.php');
			
// config.php nicht beschreibbar
$temp_nowrite_config = '';
if (!is_writable($ct_config)) {
	$temp_nowrite_config = '
	<table style="width:800px; border:1px solid #ff0000; background-color:#ff0000" cellspacing="0" cellpadding="0">
		<tr>
			<td width="10px">&nbsp;</td>
			<td style="text-align:left; line-height:20px; color:#ffffff"><b>'.$txt_errors[1].'</b></td>
		</tr>
	</table>
	<table width="800px" cellpadding="3" cellspacing="1" style="border:1px solid #ff0000; background-color:#E7E7E7">
		<tr>
			<td class="windowbg" valign="top" style="padding: 7px; text-align:center">
				<span style="font-size:12px; color:#ff0000">
					'.$txt_errors[14].'
				</span>
			</td>
		</tr>
	</table>
	<table style="width:800px; border:0px" cellspacing="0" cellpadding="0">
		<tr>
	    	<td style="line-height:'.$ct_block_space.'px">&nbsp;</td>
		</tr>
	</table>';
}			

#-- /admin/ nicht beschreibbar -------------------------------------
$temp_nowrite_admin = '';
if (!is_writable("admin/")) {
	$temp_nowrite_admin = '
	<table style="width:800px; border:1px solid #ff0000; background-color:#ff0000" cellspacing="0" cellpadding="0">
		<tr>
			<td width="10px">&nbsp;</td>
			<td style="text-align:left; line-height:20px; color:#ffffff"><b>'.$txt_errors[1].'</b></td>
		</tr>
	</table>
	<table width="800px" cellpadding="3" cellspacing="1" style="border:1px solid #ff0000; background-color:#E7E7E7">
		<tr>
			<td class="windowbg" valign="top" style="padding: 7px; text-align:center">
				<span style="font-size:12px; color:#ff0000">
					'.$txt_errors[4].'
				</span>
			</td>
		</tr>
	</table>
	<table style="width:800px; border:0px" cellspacing="0" cellpadding="0">
		<tr>
	    	<td style="line-height:'.$ct_block_space.'px">&nbsp;</td>
		</tr>
	</table>';
}

#-- /includes/ nicht beschreibbar -------------------------------------
$temp_nowrite_includes = '';
if (!is_writable("includes/")) {
	$temp_nowrite_includes = '
	<table style="width:800px; border:1px solid #ff0000; background-color:#ff0000" cellspacing="0" cellpadding="0">
		<tr>
			<td width="10px">&nbsp;</td>
			<td style="text-align:left; line-height:20px; color:#ffffff"><b>'.$txt_errors[1].'</b></td>
		</tr>
	</table>
	<table width="800px" cellpadding="3" cellspacing="1" style="border:1px solid #ff0000; background-color:#E7E7E7">
		<tr>
			<td class="windowbg" valign="top" style="padding: 7px; text-align:center">
				<span style="font-size:12px; color:#ff0000">
					'.$txt_errors[6].'
				</span>
			</td>
		</tr>
	</table>
	<table style="width:800px; border:0px" cellspacing="0" cellpadding="0">
		<tr>
	    	<td style="line-height:'.$ct_block_space.'px">&nbsp;</td>
		</tr>
	</table>';
}

#-- Ordenr Log nicht beschreibbar -----------------------------------
$temp_nowrite_log = '';
if (!is_writable("log/")) {
	$temp_nowrite_log = '
	<table style="width:800px; border:1px solid #ff0000; background-color:#ff0000" cellspacing="0" cellpadding="0">
		<tr>
			<td width="10px">&nbsp;</td>
			<td style="text-align:left; line-height:20px; color:#ffffff"><b>'.$txt_errors[1].'</b></td>
		</tr>
	</table>
	<table width="800px" cellpadding="3" cellspacing="1" style="border:1px solid #ff0000; background-color:#E7E7E7">
		<tr>
			<td class="windowbg" valign="top" style="padding: 7px; text-align:center">
				<span style="font-size:12px; color:#ff0000">
					'.$txt_errors[8].'
				</span>
			</td>
		</tr>
	</table>
	<table style="width:800px; border:0px" cellspacing="0" cellpadding="0">
		<tr>
	    	<td style="line-height:'.$ct_block_space.'px">&nbsp;</td>
		</tr>
	</table>';
}
			
if ($ct_db_pass == "password_dummy" OR empty($ct_db_pass)) {
	$input_password = '<input style="color:#ff0000" type="password" name="db_pass" value="password_dummy" size="70" />';
} else {$input_password = '<input type="password" name="db_pass" value="'.$ct_db_pass.'" size="70" />';} 
		


$handle=opendir("languages/");
$temp_lang_options[0] = '';
while ($language_dir = readdir ($handle)) { 
	if ($ct_lang == $language_dir) {$select_lang = 'selected="selected"';} else {$select_lang = '';}
    if ($language_dir != "." && $language_dir != "..") {
		$temp_lang_options[0] .= '<option value="'.$language_dir.'" '.$select_lang.'>'.$language_dir.'</option>';
    }
}
closedir($handle); 

if ($ct_atack_email == "yes") {$select_atack_email1 = 'checked="checked"';} else {$select_atack_email1 = '';}
if ($ct_atack_email == "no") {$select_atack_email2 = 'checked="checked"';} else {$select_atack_email2 = '';}

if ($ct_auto_iplist == "yes") {$select_auto_iplist1 = 'checked="checked"';} else {$select_auto_iplist1 = '';}
if ($ct_auto_iplist == "no") {$select_auto_iplist2 = 'checked="checked"';} else {$select_auto_iplist2 = '';}

if (!isset($ct_htaccess)) {$ct_htaccess = "yes";}
if ($ct_htaccess == "yes") {$select_htaccess1 = 'selected="selected"';} else {$select_htaccess1 = '';}
if ($ct_htaccess != "yes") {$select_htaccess2 = 'selected="selected"';} else {$select_htaccess2 = '';}

// Template Login laden
$temp = file("templates/install.html");
include( "languages/".$ct_lang."/footer.php");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--versionsinfo_login--", $txt_footer[1], $temp[$i]);
	$temp[$i] = ereg_replace("!--info_einstellungen--", $info_einstellungen, $temp[$i]);
	$temp[$i] = ereg_replace("!--lang_options--", $temp_lang_options[0], $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_db_user--", $ct_db_user, $temp[$i]);
	$temp[$i] = ereg_replace("!--input_password--", $input_password, $temp[$i]);
	$temp[$i] = ereg_replace("!--color_email--", $color_email, $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_email--", $ct_email, $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_borddir--", $ct_borddir, $temp[$i]);
	$temp[$i] = ereg_replace("!--color_filedir--", $color_ct_filedir, $temp[$i]);
	$temp[$i] = ereg_replace("!--color_borddir--", $color_ct_borddir, $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_filedir--", $ct_filedir, $temp[$i]);
	$temp[$i] = ereg_replace("!--select_atack_email1--", $select_atack_email1, $temp[$i]);
	$temp[$i] = ereg_replace("!--select_atack_email2--", $select_atack_email2, $temp[$i]);
	$temp[$i] = ereg_replace("!--select_auto_iplist1--", $select_auto_iplist1, $temp[$i]);
	$temp[$i] = ereg_replace("!--select_auto_iplist2--", $select_auto_iplist2, $temp[$i]);
	$temp[$i] = ereg_replace("!--select_htaccess1--", $select_htaccess1, $temp[$i]);
	$temp[$i] = ereg_replace("!--select_htaccess2--", $select_htaccess2, $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_lang--", $ct_lang, $temp[$i]);
	
	$temp[$i] = ereg_replace("!--nowrite_config--", $temp_nowrite_config, $temp[$i]);
	$temp[$i] = ereg_replace("!--nowrite_admin--", $temp_nowrite_admin, $temp[$i]);
	$temp[$i] = ereg_replace("!--nowrite_log--", $temp_nowrite_log, $temp[$i]);
	$temp[$i] = ereg_replace("!--nowrite_includes--", $temp_nowrite_includes, $temp[$i]);

	$temp[$i] = ereg_replace("!--txt_install1--", $txt_install[1], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install2--", $txt_install[2], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install3--", $txt_install[3], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install4--", $txt_install[4], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install5--", $txt_install[5], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install6--", $txt_install[6], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install7--", $txt_install[7], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install8--", $txt_install[8], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install9--", $txt_install[9], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install10--", $txt_install[10], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install11--", $txt_install[11], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install12--", $txt_install[12], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install13--", $txt_install[13], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install14--", $txt_install[14], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install15--", $txt_install[15], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install21--", $txt_install[21], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install22--", $txt_install[22], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install25--", $txt_install[25], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install26--", $txt_install[26], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install27--", $txt_install[27], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_install28--", $txt_install[28], $temp[$i]);
	
	$site .= $temp[$i];
}

?>