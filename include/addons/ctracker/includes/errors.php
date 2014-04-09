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

// config.php nicht beschreibbar
if (!is_writeable($ct_config)) {no_write_config();}


#-- wenn update.php nicht gelöscht ist  ------------------------
if ( file_exists("update.php") ) {

	$temp = file("templates/errors/1.html");
	for($i=0;$i<count($temp);$i++){
		$temp[$i] = ereg_replace("!--txt_errors1--", $txt_errors[1], $temp[$i]);
		$temp[$i] = ereg_replace("!--txt_errors2--", $txt_errors[2], $temp[$i]);
	
		$site .= $temp[$i];
	}
} 

#-- wenn ct_whitelists.txt nicht beschreibbar ist  ------------------------
function ct_whitelists(){
	
	global $txt_errors, $ct_block_space;

	$temp = file("templates/errors/2.html");
	for($i=0;$i<count($temp);$i++){
		$temp[$i] = ereg_replace("!--txt_errors1--", $txt_errors[1], $temp[$i]);
		$temp[$i] = ereg_replace("!--txt_errors15--", $txt_errors[15], $temp[$i]);
	
		$site .= $temp[$i];
	}
	
} 

#-- Updatehinweis --------------------------------------------------
if ( $version_number.".".$revision_number < $server_version) {

	if (url_ok_or_not($update_info)) {
		$temp_update_info = socketorfile_fgets($update_info);
	}
		
	$temp = file("templates/errors/3.html");
	for($i=0;$i<count($temp);$i++){
		$temp[$i] = ereg_replace("!--txt_errors3--", $txt_errors[3], $temp[$i]);
		$temp[$i] = ereg_replace("!--temp_update_info--", $temp_update_info, $temp[$i]);
	
		$site .= $temp[$i];
	}
}    

#-- /admin/ nicht beschreibbar -------------------------------------
if (fileperms("admin/") != 16895) {
	
	$temp = file("templates/errors/4.html");
	for($i=0;$i<count($temp);$i++){
		$temp[$i] = ereg_replace("!--txt_errors1--", $txt_errors[1], $temp[$i]);
		$temp[$i] = ereg_replace("!--txt_errors4--", $txt_errors[4], $temp[$i]);
	
		$site .= $temp[$i];
	}
	
} else {
	if (!file_exists($htaccess_admin) AND $ct_htaccess_error == "yes") {
		
		$temp = file("templates/errors/5.html");
		for($i=0;$i<count($temp);$i++){
			$temp[$i] = ereg_replace("!--txt_errors1--", $txt_errors[1], $temp[$i]);
			$temp[$i] = ereg_replace("!--txt_errors5--", $txt_errors[5], $temp[$i]);
		
			$site .= $temp[$i];
		}
		
	}
}

#-- /includes/ nicht beschreibbar -------------------------------------
if (fileperms("includes/") != 16895) {
	
	$temp = file("templates/errors/6.html");
	for($i=0;$i<count($temp);$i++){
		$temp[$i] = ereg_replace("!--txt_errors1--", $txt_errors[1], $temp[$i]);
		$temp[$i] = ereg_replace("!--txt_errors6--", $txt_errors[6], $temp[$i]);
	
		$site .= $temp[$i];
	}
	
} else {
	if (!file_exists($htaccess_includes) AND $ct_htaccess_error == "yes") {
		
		$temp = file("templates/errors/7.html");
		for($i=0;$i<count($temp);$i++){
			$temp[$i] = ereg_replace("!--txt_errors1--", $txt_errors[1], $temp[$i]);
			$temp[$i] = ereg_replace("!--txt_errors7--", $txt_errors[7], $temp[$i]);
		
			$site .= $temp[$i];
		}

	}
}

#-- Ordenr Log nicht beschreibbar -----------------------------------
if (fileperms("log/") != 16895) {
	
	$temp = file("templates/errors/8.html");
	for($i=0;$i<count($temp);$i++){
		$temp[$i] = ereg_replace("!--txt_errors1--", $txt_errors[1], $temp[$i]);
		$temp[$i] = ereg_replace("!--txt_errors8--", $txt_errors[8], $temp[$i]);
	
		$site .= $temp[$i];
	}
	
} else {
// Wenn Ordner Log beschreibbar, prüfe folgendes:

	#-- Logfiles nicht beschreibbar -------------------------------------
	if (!file_exists($htaccess_log) AND $ct_htaccess_error == "yes") {
		
		$temp = file("templates/errors/9.html");
		for($i=0;$i<count($temp);$i++){
			$temp[$i] = ereg_replace("!--txt_errors1--", $txt_errors[1], $temp[$i]);
			$temp[$i] = ereg_replace("!--txt_errors9--", $txt_errors[9], $temp[$i]);
		
			$site .= $temp[$i];
		}
		
	}


############################################################
// wenn CTXtra nicht installiert
if (!file_exists('log/ct_log_ctxtras.txt')) {

	#-- Neue Online IPs ------------------------------------------------
		$info_speichern = "";
		// IP-Liste Speichern
		if (isset($_POST['submit_iplist'])) {
			$fp_log = @fopen($ct_log_ips, "w+");
			@fwrite($fp_log, rtrim($_POST['iplist'])."\n");
			@fclose($fp_log); 
			double_entry();
			$info_speichern = '<span style="color:#008000; font-weight:bold">'.$txt_errors[10].'</span>';
		}
		
		// Neue Offline IPs hinzufügen
		if (isset($_POST['submit_iplist_add'])) {
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
			$info_speichern = '<span style="color:#008000; font-weight:bold">'.$txt_errors[11].'</span>';
		}
		
	#-- Neue Online Spamwords ------------------------------------------------
		// SPAM-Liste Speichern
		if (isset($_POST['submit_spamlist'])) {
			$fp_log = @fopen($ct_spamlist, "w+");
			@fwrite($fp_log, rtrim($_POST['spamlist'])."\n");
			@fclose($fp_log); 
			double_entry();
			$info_speichern = '<span style="color:#008000; font-weight:bold">'.$txt_errors[10].'</span>';
		}
		
		// Neue Offline Spamwords hinzufügen
		if (isset($_POST['submit_spamlist_add'])) {
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
			$info_speichern = '<span style="color:#008000; font-weight:bold">'.$txt_errors[11].'</span>';
		}
}


if (isset($_SESSION['count_new_ips']) AND $_SESSION['count_new_ips'] > 0) {
	
	$temp = file("templates/errors/11.html");
	for($i=0;$i<count($temp);$i++){
		$temp[$i] = ereg_replace("!--txt_errors1--", $txt_errors[1], $temp[$i]);
		$temp[$i] = ereg_replace("!--txt_errors12--", $txt_errors[12], $temp[$i]);
	
		$site .= $temp[$i];
	}
}

if (isset($_SESSION['count_new_spamwords']) AND $_SESSION['count_new_spamwords'] > 0 AND $ct_spamprotector1 != "no") {

	$temp = file("templates/errors/10.html");
	for($i=0;$i<count($temp);$i++){
		$temp[$i] = ereg_replace("!--txt_errors1--", $txt_errors[1], $temp[$i]);
		$temp[$i] = ereg_replace("!--txt_errors13--", $txt_errors[13], $temp[$i]);
	
		$site .= $temp[$i];
	}
	
}

############################################################
}
?>