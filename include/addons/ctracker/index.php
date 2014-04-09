<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.de			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################
include_once("ctracker.php");

if (!defined('CTXTRA'))
	die ("Hacking attempt...");

session_start();


include('includes/config.inc.php');

// Wenn update gefunden
################################################
	// wenn update.php gefunden und bereits ausgeführt
	if(file_exists("update.php") AND isset($_GET['update_ready'])) {
		$datei = array('update.php');
	
		$i=0;
		while($i<count($datei)) {
			$datei_del = $ftp_ordner."/".$datei[$i];
			@ftp_delete($connection,$datei_del);
			$i++;
		}
	// wenn update.php gefunden und noch nicht ausgeführt
	} elseif(file_exists("update.php")) {
	 	header('Location: update.php');
		exit;
	}


// Login/Logout
################################################
	// login
	if (isset($_REQUEST['login'])) {
		if (ct_check_login())
	    {
	    	sess_login();		// Login Session
			ct_log_ctxtras();	// installations infos
			no_write_log();     // prüfe ob logfiles existieren wenn nicht lege sie an
			header("Location: index.php?home=true");
	    }
	}
		
	// Wenn "Logout" geklickt dann logout
	if (isset($_GET['logout']) AND $_GET['logout'] == "true") {
		sess_del();
		$logout = true;
	// Wenn Session abgelaufen dann logout
	} elseif(isset($_SESSION['login_time2']) AND time() > $_SESSION['login_time2']) {
		sess_del();
		$session_break = true;
	} else {
		$_SESSION['login_time'] = time();
	}

include_once( "languages/".$ct_lang."/login.php");

// Login fehlgeschlagen 3 Versuche
if (!isset($_SESSION['login_okay']) AND isset($_POST['login'])) {
	include($ct_log_ctxtras);
	ct_log_ctxtras();
	include($ct_log_ctxtras);
	
	if ($false_login <= 1) {$versuche = $txt_login[2];}
	if ($false_login == 2) {$versuche = $txt_login[3];}
	if ($false_login >= 3) {$versuche = $txt_login[4];}
	
	$temp = file("templates/errors/login/1.html");
	$temp_falselogin = '';
	for($i=0;$i<count($temp);$i++){
		$temp[$i] = ereg_replace("!--versuche--", $versuche, $temp[$i]);
		$temp_falselogin .= $temp[$i];
	}

// Zugang gesperrt
} elseif (isset($false_login) AND $false_login >= 3) {
	$temp = file("templates/errors/login/2.html");
	$temp_falselogin = '';
	for($i=0;$i<count($temp);$i++){
		$temp[$i] = ereg_replace("!--txt_login5--", $txt_login[5], $temp[$i]);
		$temp_falselogin .= $temp[$i];
	}
	
} else {
	$versuche = '';
	$temp_falselogin = '';
}

// Serverversion - Version die CTXtra.de zum download bereit stellt
$server_version = serverversions_info();

// Onlinelisten in SESSION ablegen
################################################
	if(!isset($_SESSION['online_ips'])) {$_SESSION['online_ips'] = online_ips();}
	if(!isset($_SESSION['online_spamwords'])) {$_SESSION['online_spamwords'] = online_spamwords();}


// Einstellungen speichern/ändern
################################################
	if ((isset($_POST['submit_config']) OR isset($_POST['submit_install'])) AND $_GET['settings'] == "true") {include('includes/save_settings.php');}


// Pfad und Email checken
// wenn nicht koreckt lade Template "install.php"
################################################
	include('common.php');
	$fp_borddir = $ct_borddir."/ctracker.php";
	$fp_filedir = "http://".$_SERVER['HTTP_HOST'].$ct_dir."/ctracker.php";
	#$fp_borddir = $ct_borddir."/ctracker.php";
	#$fp_filedir = "http://".$_SERVER['HTTP_HOST'].$ct_filedir."/ctracker.php";
	
	if (!url_ok_or_not($fp_borddir)) {
		$color_ct_borddir = 'style="background-color:#ff0000; color:#ffffff"';
		$isset_borddir = "FALSE";
		$info_einstellungen = info_einstellungen();
	} else {$color_ct_borddir=""; $isset_borddir="";}
	
	if (!url_ok_or_not($fp_filedir)) {
		$color_filedir = 'style="background-color:#ff0000; color:#ffffff"';
		$isset_filedir = "FALSE";
		$info_einstellungen = info_einstellungen();
	} else {$color_filedir=""; $isset_filedir="";}

	if ($ct_email == "deine@email.de" OR empty($ct_email)) {
		$color_email = 'style="background-color:#ff0000; color:#ffffff"';
		$info_einstellungen = info_einstellungen();
		$isset_email = "FALSE";
	} else {$color_email="";}

	if ($ct_db_pass == "password_dummy" OR empty($ct_db_pass)) {
		$input_password = '<input style="color:#ff0000" type="password" name="db_pass" value="password_dummy" size="70" />';
		$isset_password = "FALSE";
	} else {$input_password = '<input type="password" name="db_pass" value="'.$ct_db_pass.'" size="70" />';} 
		

// Templates laden
################################################
	
	// wenn CTXtra nicht installiert
	if (($ct_db_user == "Admin" AND empty($ct_db_pass)) OR ($ct_db_user == "Admin" AND $ct_db_pass == 'smfctracker_dummy') OR $isset_borddir == "FALSE" OR $isset_filedir == "FALSE" OR $isset_email == "FALSE" OR $isset_password == "FALSE") {
		// lade Template install.php
		include('common.php');
		include_once('languages/'.$ct_lang.'/install.php');
		include_once('includes/install.php');
	// wenn CTXtra installiet
	} else {

		// wenn eingeloggt aber REQUEST == leer dann gehe zur home
		if (isset($_SESSION['login_okay']) AND empty($_GET)) {
			header("Location: index.php?home=true");

		// wenn eingeloggt, lade Template index.php
		} elseif (isset($_SESSION['login_okay'])) {
			include_once('languages/'.$ct_lang.'/index.php');
			include_once('includes/index.php');			

		// wenn nicht eingeloggt und REQUEST == leer dann gehe zum login
		} elseif (!isset($_SESSION['login_okay']) AND empty($_GET) AND !isset($_POST['login'])) {
			header("Location: index.php?login=true");

		// lade Template login.php
		} elseif (isset($_REQUEST['login']) AND $_REQUEST['login'] == "true") {
			include_once('languages/'.$ct_lang.'/login.php');
			include_once('includes/login.php');

		// wenn ausgeloggt, lade Template login.php - gib Meldung "erfolgreich ausgeloggt"
		} else {
			include_once('languages/'.$ct_lang.'/login.php');
			include_once('includes/login.php');			
		}
	}
	
	// Template footer.php laden
	include_once('includes/footer.php');

// Template global bearbeiten
#################################################
	$versions_info = versions_info();
	include('includes/config.inc.php');
	$site = ereg_replace("!--versions_info--", "$versions_info", $site);	
	$site = ereg_replace("!--version_number--", "$version_number", $site);
	$site = ereg_replace("!--revision_number--", "$revision_number", $site);
	$site = ereg_replace("!--ctxtra_url--", "$ctxtra_url", $site);
	$site = ereg_replace("!--ct_block_space--", "$ct_block_space", $site);
	$site = ereg_replace("!--ct_imagedir--", "$ct_imagedir", $site);
	$site = ereg_replace("!--ct_borddir--", "$ct_borddir", $site);


// Seite anzeigen
#################################################
echo $site;
?>
