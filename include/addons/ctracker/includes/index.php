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

echo $site;

if(!isset($_SESSION['session_time'])) {$_SESSION['session_time'] = time();}
@ini_set("session.gc_maxlifetime", $_SESSION['session_time']);
$sessiontime = ini_get("session.gc_maxlifetime");
$_SESSION['login_time2'] = $_SESSION['login_time'] + $sessiontime;

// installations infos aktualisieren
ct_log_ctxtras();
include($ct_log_ctxtras);


if (url_ok_or_not($ct_remote_partner)) {
	$temp_remote_partner = socketorfile_fgets($ct_remote_partner);
} else {
	$temp_remote_partner = $txt_index[1].' [ <a href="'.$ct_partner_werden.'" target="_blank">'.$txt_index[2].'</a> ].';
}
		
###################################################################
$info_speichern = "";
// IP-Liste Speichern
if (isset($_POST['submit_iplist'])) {
	include('languages/'.$ct_lang.'/ipfilter.php');	
	$fp_log = @fopen($ct_log_ips, "w+");
	@fwrite($fp_log, rtrim($_POST['iplist'])."\n");
	@fclose($fp_log); 
	double_entry();
	$info_speichern = '<span style="color:#008000; font-weight:bold">'.$txt_ipfilter[12].'</span>';
	$_SESSION['count_new_ips']	= online_iplist();
}

// Neue Offline IPs hinzufügen
if (isset($_POST['submit_iplist_add'])) {
	include('languages/'.$ct_lang.'/ipfilter.php');	
	$fp_ips = @fopen($ct_log_ips, "a+");
	$new_ips = explode("\n", trim($_POST['iplist_add']));
	
	// Lese text datei in Array und lösche leere zeilen
	$ip_zeilen[]="";
	if (file_exists($ct_log_ips)) {
		while (!feof($fp_ips)) {
			$zeile = trim(fgets($fp_ips,4096));
			if (!empty($zeile)) {
				$ip_zeilen[] = $zeile;
			}
		}
	}
	// Überprüfe ob neue IP schon vorhanden
	$i=0; 
	while($i<count($new_ips)) {
		$new_ips[$i] = trim($new_ips[$i]);
		if (!in_array($new_ips[$i], $ip_zeilen)) {
			@fwrite($fp_ips, $new_ips[$i]."\n");
		}
		$i++;
	}

	@fclose($fp_ips); 
	double_entry();
	$info_speichern = '<span style="color:#008000; font-weight:bold">'.$txt_ipfilter[13].'</span>';
	$_SESSION['count_new_ips']	= online_iplist();
}
###################################################################

$info_speichern = "";
// SPAM-Liste Speichern
if (isset($_POST['submit_spamlist'])) {
	include('languages/'.$ct_lang.'/spamfilter.php');	
	$fp_log = @fopen($ct_spamlist, "w+");
	@fwrite($fp_log, rtrim($_POST['spamlist'])."\n");
	@fclose($fp_log); 
	double_entry();
	$info_speichern = '<span style="color:#008000; font-weight:bold">'.$txt_spamfilter[23].'</span>';
}

// Neue Offline Spamwords hinzufügen
if (isset($_POST['submit_spamlist_add'])) {
	include('languages/'.$ct_lang.'/spamfilter.php');
	$fp_spamwords = @fopen($ct_spamlist, "a+");
	$new_spamwords = explode("\n", trim($_POST['spamlist_add']));
	
	// Lese text datei in Array und lösche leere zeilen
	$spamword_zeilen[]="";
	if (file_exists($ct_spamlist)) {
		while (!feof($fp_spamwords)) {
			$zeile = trim(fgets($fp_spamwords,4096));
			if (!empty($zeile)) {
				$spamword_zeilen[] = $zeile;
			}
		}
	}
	// Überprüfe ob neues Spamword schon vorhanden
	$i=0; 
	while($i<count($new_spamwords)) {
		$new_spamwords[$i] = trim($new_spamwords[$i]);
		if (!in_array($new_spamwords[$i], $spamword_zeilen)) {
			@fwrite($fp_spamwords, $new_spamwords[$i]."\n");
		}
		$i++;
	}

	@fclose($fp_spamwords); 
	double_entry();
	$info_speichern = '<span style="color:#008000; font-weight:bold">'.$txt_spamfilter[24].'</span>';
	$_SESSION['count_new_spamwords'] = online_spamlist();
}
###################################################################

if (isset($_GET['ipfilter']) AND $_GET['ipfilter'] == "true") {
	if ($ct_auto_iplist == "yes") {auto_ip_list();}
	$_SESSION['count_new_ips'] = online_iplist();
} elseif (isset($_GET['spamfilter']) AND $_GET['spamfilter'] == "true") {
	if ($ct_auto_spamlist == "yes") {auto_spam_list();}
	$_SESSION['count_new_spamwords'] = online_spamlist();
}
			


###################################################################
// TEMPLATES LADEN - ANFANG
###################################################################

// Template Header laden
include_once('includes/header.php');

// Kopf laden
$temp = file("templates/index_start.html");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--temp_remote_partner--", $temp_remote_partner, $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_index2--", $txt_index[2], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_index3--", $txt_index[3], $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_paypal--", $ct_paypal, $temp[$i]);

	$site .= $temp[$i];
}

// Navi laden
include_once('languages/'.$ct_lang.'/navi.php');
include_once('includes/navi.php');

// Erros laden
include_once('languages/'.$ct_lang.'/errors.php');
include_once('includes/errors.php');

// Wormprotector laden				
if (isset($_GET['hack']) AND $_GET['hack'] == "true") {
	include_once('languages/'.$ct_lang.'/wormprotector.php');
	include_once('includes/wormprotector.php');

// Hilfe laden
} elseif (isset($_GET['help']) AND $_GET['help'] == "true") {
	include_once('languages/'.$ct_lang.'/help.php');
	include_once('includes/help.php');

// Credits laden
} elseif (isset($_GET['credits']) AND $_GET['credits'] == "true") {
	include_once('languages/'.$ct_lang.'/credits.php');
	include_once('includes/credits.php');

// IP-Filter laden
} elseif (isset($_GET['ipfilter']) AND $_GET['ipfilter'] == "true") {
	include_once('languages/'.$ct_lang.'/ipfilter.php');
	include_once('includes/ipfilter.php');

// Spamfilter laden
} elseif (isset($_GET['spamfilter']) AND $_GET['spamfilter'] == "true") {
	include_once('languages/'.$ct_lang.'/spamfilter.php');
	include_once('includes/spamfilter.php');

// Einstellungen laden
} elseif (isset($_GET['settings']) AND $_GET['settings'] == "true") {
	$info_einstellungen=""; $no_ct_log_file=""; $no_ct_log_ips=""; $no_ct_log_countips="";
	$input_pssword = '<input type="password" name="db_pass" value="'.$ct_db_pass.'" size="70" />';
	include_once('languages/'.$ct_lang.'/settings.php');
	include_once('includes/settings.php');

// Tools laden
} elseif (isset($_GET['tools']) AND $_GET['tools'] == "true") {
	include_once('languages/'.$ct_lang.'/tools.php');
	include_once('includes/tools.php');

// Home laden
} elseif (isset($_GET['home']) AND $_GET['home'] == "true") {
	include_once('languages/'.$ct_lang.'/home.php');
	include_once('includes/home.php');
}

// Footer laden
$temp = file("templates/index_end.html");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--temp_remote_partner--", $temp_remote_partner, $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_index2--", $txt_index[2], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_index3--", $txt_index[3], $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_paypal--", $ct_paypal, $temp[$i]);

	$site .= $temp[$i];
}

###################################################################
// TEMPLATES LADEN - ENDE
###################################################################


?>