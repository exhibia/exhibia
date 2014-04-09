<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.org			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################

if (!defined('CTXTRA'))
	die ("Hacking attempt...");

############################################################################################################
// Email verschlüsseln
function ct_admin_email() {
	global $ct_email;
	$encoded = "";
	for ($i=0; $i < strlen($ct_email); $i++) {
		$encoded .= '&#'.ord(substr($ct_email,$i)).';'; 
	}
	return $encoded;
}

function ct_encode_email($ct_email) {
	$encoded = "";
	for ($i=0; $i < strlen($ct_email); $i++) {
		$encoded .= '&#'.ord(substr($ct_email,$i)).';'; 
	}
	return $encoded;
}


############################################################################################################
// Serverversion - Version die ctxtra.org zum download bereit stellt
function serverversions_info() {
	
	global $update_file;

	if (url_ok_or_not($update_file)) {
		$server_version = @file_get_contents($update_file);
	} else {$server_version = 0;}
	return $server_version;
}


############################################################################################################
// Versionsinfo
function versions_info() {
	
	global $version_number, $revision_number, $ctxtra_url, $ct_lang, $ct_sourcedir, $ct_imagedir;
	include( $ct_sourcedir."/languages/".$ct_lang."/footer.php");
	
	$versions_info = '

		<table style="width:800px; height:10px;" cellspacing="2px" cellpadding="0px">
			<tr>
				<td style="text-align:right; line-heigh:10px; color:#999999; font-size:10px; font-family:verdana, arial">
					'.$txt_footer[1].'
				</td>
			</tr>
		</table>';	
	
	return $versions_info;
}


############################################################################################################
// Admin IP löschen (reseten)

function acp_resetip($myip) {

	global $ct_log_ips;

	// IP aus filer entfernen (IP nicht mehr sperren)
	$fp_ips = fopen($ct_log_ips, "a+");
	
	// Lese text datei in Array und lösche leere zeilen
	$ip_zeilen[]="";
	if (file_exists($ct_log_ips)) {
		while (!feof($fp_ips)) {
			$zeile = trim(fgets($fp_ips,4096));
			if (!empty($zeile) AND $zeile != $myip) {
				$ip_zeilen[] = $zeile;
			}
		}
	}
	@fclose($fp_ips); 
		
	// Überprüfe ob neue IP schon vorhanden
	$fp_ips = fopen($ct_log_ips, "w");
	$i=0; 
	while($i<count($ip_zeilen)) {
		fwrite($fp_ips, $ip_zeilen[$i]."\n");
		$i++;
	}
	@fclose($fp_ips); 

	double_entry();

}


############################################################################################################
// CTXtra auf Online-Verfügbarkeit prüfen

function url_ok_or_not($url) { 

	global $ct_sourcedir;

	$url = trim($url);
	if (!preg_match("=://=", $url)) {$url = "http://$url";}
	
	$url = parse_url($url);
	$debug = $url;
	
	
	if (!isset($url["port"])) {$url["port"] = 80;}

	if ($fp = @fsockopen($url["host"], $url["port"], $errno, $errstr, 5)) {
		if($url["host"] == "ctxtra.org" OR $url["host"] == "www.ctxtra.org") {
			$debug .= " - OK";
			return true;
		} else {
			if(file_exists($ct_sourcedir."/".basename($url["path"]))) {
				$debug .= " - ".$ct_sourcedir."/".basename($url["path"])." - OK";
				return true;
			} else {
				$debug .= "NO";
				return false;
			}
		}
	} else {
		// Bei ausgeschaltenen fsockopen wird eine richtige Verbindung simuliert
		return true;
		$debug .= "NO";
	}

	print_r($debug);
	
	return true;
}

############################################################################################################
// Alternative zu fopen() mit fsockopen() - wird durch socketorfile_fgets() aufgerufen
function fsockopen_fgets($url) {
	$parse_url = @parse_url($url);

	// Host ermitteln, ungültigen Aufruf abfangen
	if (empty($parse_url['host'])) {
		return null;
	}

	$host = $parse_url['host'];

	// Pfadangabe ermitteln
	$documentpath = empty($parse_url['path']) ? '/' : $documentpath = $parse_url['path'];

	// Parameter ermitteln
	if (!empty($parse_url['query']))
		$documentpath .= '?'.$parse_url['query'];

	// Port ermitteln
	$port = empty($parse_url['port']) ? 80 : $port = $parse_url['port'];

	// Socket öffnen
	$fp = @fsockopen ($host, $port, $errno, $errstr, 4);

	if (!$fp) {
		return null;
	}
	
	// Request senden
	@fputs ($fp, "GET {$documentpath} HTTP/1.0\r\nHost: {$host}\r\n\r\n");
	socket_set_timeout($fp, 4);
	stream_set_timeout($fp, 4);

	// Header auslesen
	$header = '';
	do {
		$line = chop(fgets($fp));
		$header .= $line."\n";
	} while (!empty($line) and !feof($fp));
	
	// Daten auslesen
	$result[0] = '';
	while (!feof($fp)) {
		$result[0] .= fgets($fp);
	}

	// Socket schliessen
	fclose($fp);
	
	// Header auswerten
	preg_match('~^HTTP/1\.\d (?P<status>\d+)~', $header, $matches);
	if(!isset($matches['status'])) {
		return false;
	} else {
		$status = $matches['status'];		
		if ($status == 200) { // OK
			return $result[0];
	  	} else {
			return false;
		}
	}

}  


############################################################################################################
// Überprüfen ob fsockopen() oder wenn Verfügbar file() genutzt werden soll.
function socketorfile_fgets($url) {
	if (ini_get('allow_url_fopen') == 1) {
		$content = @file_get_contents($url);
		if(strpos($http_response_header[0], "200")) {

		$parse_url = @parse_url($url);
		$host = $parse_url['host'];
		
		$content = str_replace('<head>', '<head><base href="'.$host.'/" />', $content);
#		echo "DEBUG: allow_url_fopen ON = file() => fgets<br /><br />";		
		return $content;

		}
	} else {
#		echo "DEBUG: allow_url_fopen OFF = fsockopen() => fgets<br /><br />";
		return fsockopen_fgets($url);
	}
}


############################################################################################################
// Nur für Onlinelisten (remote).
function socketorfile_fgets_for_lists($url) {
		return fsockopen_fgets($url);
}

############################################################################################################
// Login
function ct_check_login()
{
	global $ct_db_pass, $ct_db_user, $false_login;
	
	if (empty($_POST['benutzername']) and empty($_POST['password'])) {
    	return false;
	} elseif (($_POST['benutzername'] == $ct_db_user) and ($_POST['password'] == $ct_db_pass) AND $false_login <= 2) {
	    return true;
	} else {
	    return false;
	}
}


############################################################################################################
// Login Session
function sess_login() {
	$_SESSION['benutzername']		= $_REQUEST['benutzername'];
	$_SESSION['login_okay']			= true;
	$_SESSION['session_time']		= $_REQUEST['session_time'] * 60;
	$_SESSION['login_time']			= time();
	$_SESSION['last_login_time']	= time();

	// zählen neuer IPs in onlineliste
	if (online_iplist() >= 1) {$_SESSION['count_new_ips'] = online_iplist();}

	// zählen neuer SPAMWORDSs in onlineliste
	if (online_spamlist() >= 1) {$_SESSION['count_new_spamwords'] = online_spamlist();}

	$_SESSION['online_ips']	= online_ips();
	$_SESSION['online_spamwords'] = online_spamwords();
	
	return true;
}

############################################################################################################
// Session beenden
function sess_del() {
	$_SESSION = array();
	session_unset();
	unset($_SESSION);
	session_destroy();
	return true;
}


############################################################################################################
// Refs loggen
function ref_loggen() {
	global $ct_ref_loggen, $version_number, $revision_number, $count_all_logs;

	if ($ct_ref_loggen == "yes") {
		$ref = 'http://www.ctxtra.org/remote/refs.php?ref='.base64_encode($_SERVER['HTTP_HOST']).'&url='.base64_encode($_SERVER['PHP_SELF']).'&blocked='.base64_encode(count_all_logs()).'&ver='.base64_encode($version_number.'.'.$revision_number).'&iscoded';
	} else {
		$ref = 'http://www.ctxtra.org/remote/refs.php?no_ref='.base64_encode($_SERVER['HTTP_HOST']).'&url='.base64_encode($_SERVER['PHP_SELF']).'&blocked='.base64_encode(count_all_logs()).'&ver='.base64_encode($version_number.'.'.$revision_number).'&iscoded';			
	}
	
	if ($fp = @fsockopen('ctxtra.org', 80, $errno, $error, 2)){
		@fputs($fp, "GET $ref HTTP/1.0\n"); 
		@fputs($fp, "HOST: www.ctxtra.org\r\n");
		@fputs($fp, "Connection: close\n\n");
		@fclose($fp);
	}
}


############################################################################################################
// abgleich der online IP-Liste mit offline IP-Liste
function online_iplist() {
	global $online_iplist, $ct_log_ips;
	
	if (url_ok_or_not($online_iplist)) {
		$online_iplist_str = socketorfile_fgets_for_lists($online_iplist);
	    preg_match_all('/<word>(.*?)<\/word>/si', $online_iplist_str, $ipwords);
	    $new_ips="";
		foreach ($ipwords[0] as $messung){
	        preg_match('/<ip>(.*?)<\/ip>/si', $messung, $ip);
	        $new_ips[] .= $ip[1];
	    }
		
		if (file_exists($ct_log_ips)) {
			$ip_zeilen = file($ct_log_ips);
		} else {$ip_zeilen[]="";}
		$i=0; $ip_zeilen_new[]="";
		while($i<count($ip_zeilen)) {
			$ip_zeilen[$i] = chop($ip_zeilen[$i]);
			$ip_zeilen_new[] = $ip_zeilen[$i];
			$i++;
		}		
		$ip_zeilen = $ip_zeilen_new;
		unset($ip_zeilen_new);
				
		$i=0; $count_new_ips=0;
		if (isset($new_ips) AND !empty($new_ips)) {
			while($i<count($new_ips)) {
				$new_ips[$i] = chop($new_ips[$i]);
				if (!in_array($new_ips[$i], $ip_zeilen, TRUE)) {
					$count_new_ips++;
				}
				$i++;
			}
		} else {
			$count_new_ips = "0";	
		}
		return $count_new_ips;
	}
}


############################################################################################################
// abgleich der online Spam-Liste mit offline Spam-Liste
function online_spamlist() {
	global $online_spamlist, $ct_spamlist;
	$online_spamlist_str = socketorfile_fgets_for_lists($online_spamlist);
    preg_match_all('/<spamwords>(.*?)<\/spamwords>/si', $online_spamlist_str, $spamword);
    $new_spamwords="";
	foreach ($spamword[0] as $messung){
        preg_match('/<spamword>(.*?)<\/spamword>/si', $messung, $spamword);
        $new_spamwords[] .= $spamword[1];
    }
	
	if (file_exists($ct_spamlist)) {
		$spamword_zeilen = file($ct_spamlist);
	} else {$spamword_zeilen[]="";}
	$i=0; $spamword_zeilen_new[]="";
	while($i<count($spamword_zeilen)) {
		$spamword_zeilen[$i] = chop($spamword_zeilen[$i]);
		$spamword_zeilen_new[] = $spamword_zeilen[$i];
		$i++;
	}		
	$spamword_zeilen = $spamword_zeilen_new;
	unset($spamword_zeilen_new);
			
	$i=0; $count_new_spamwords=0;
	if (isset($new_spamwords) AND !empty($new_spamwords)) {
		while($i<count($new_spamwords)) {
			$new_spamwords[$i] = chop($new_spamwords[$i]);
			if (!in_array($new_spamwords[$i], $spamword_zeilen, TRUE)) {
				$count_new_spamwords++;
			}
			$i++;
		}
	} else {
		$count_new_spamwords = "0";	
	}
	return $count_new_spamwords;
}


############################################################################################################
// Lösche doppelte IPs
function double_entry() {
	global $ct_log_ips;
	if (file_exists($ct_log_ips)) {
		$ip_zeilen = file($ct_log_ips);
		if (count($ip_zeilen) != 0) {
			$i=0; $new_ips[]="";
			while($i<count($ip_zeilen)) {
				$ip_zeilen[$i] = trim($ip_zeilen[$i]);
				if (!empty($ip_zeilen[$i])) {
					$new_ips[] .= $ip_zeilen[$i];
				}
				$i++;
			}
			$new_ips = array_unique($new_ips);
	
			$fp_log = fopen($ct_log_ips, "w+");
			$i=0;
			while($i<count($new_ips)) {
				@fwrite($fp_log, $new_ips[$i]."\n");
				$i++;
			}
			@fclose($fp_log); 
		}
	}
}


############################################################################################################
// config.php nicht beschreibbar
function no_write_config() {
	global $ct_filedir, $ct_block_space, $txt_errors;
	echo '
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


############################################################################################################
// BBCode Parser
function bbc_html_encodet($string)
{
	$old_string=""; 
    while($old_string != $string)
    {
        $old_string = $string;
        $string = preg_replace_callback('{\[(\w+)((=)(.+)|())\]((.|\n)*)\[/\1\]}U', 'bbcode_callback', $string);
    }

    return $string;
}


function bbcode_callback($matches)
{
    $tag = trim($matches[1]);
    $inner_string = $matches[6];
    $argument = $matches[4];
    
    switch($tag)
    {
        case 'B':
		case 'b':
        case 'I':        
        case 'i':
        case 'U':
        case 'u':
            $replacement = '<'.$tag.'>'.$inner_string.'</'.$tag.'>';
            break;

        case 'CODE':
        case 'code':
            $replacement =  '<b>Code:</b><pre style="font-size:12px;width:450px;overflow:auto;">' . $inner_string . '</pre></div>';
            break;

        case 'COLOR':
        case 'color':
            $color = preg_match("[^[0-9a-fA-F]{3,6}$]", $argument) ? '#' . $argument : $argument;

            $replacement =  '<span style="color:' . $color . '">' . $inner_string . '</span>';
            break;

        case 'EMAIL':
        case 'email':
            $address = $argument ? $argument : $inner_string;
            $replacement =  '<a href="mailto:' . $address . '">' . $inner_string . '</a>';
            break;

        case 'IMG':
        case 'img':
            $replacement =  '<img src="' . $inner_string . '" />';
            break;

        case 'SIZE':
        case 'size':
            if (is_numeric($argument) && $argument > 5 && $argument < 64)
            {
                $replacement =  '<span style="font-size:' . $argument . 'px;">' . $inner_string . '</span>';
            }
            break;

        case 'QUOTE':
        case 'quote':
            $replacement =  '<b>Quote:</b><hr />' . $inner_string . '<hr />';
            break;

        case 'URL':
        case 'url':
            $url = $argument ? $argument : $inner_string;
            $replacement =  '<a href="' . $url . '" target="_blank">' . $inner_string . '</a>';
            break;

        default:    // unknown tag => reconstruct and return original expression
            $replacement = '[' . $tag . ']' . $inner_string . '[/' . $tag .']';
            break;
    }

	return $replacement;
}


############################################################################################################
// config.php anlegen/erstellen
function config_anlegen() {

	global $ct_config;	
	
	if ($_POST['htaccess'] == "yes") {$_POST['htaccess_error'] = "yes";}
	
	if (empty($_POST['spam_protector_submit_other'])) {$spam_protector_submit_other="''";} else {$spam_protector_submit_other = $_POST['spam_protector_submit_other'];}
	if (empty($_POST['spam_protector_content_other'])) {$spam_protector_content_other="''";} else {$spam_protector_content_other = $_POST['spam_protector_content_other'];}
	
	$fp_config = @fopen($ct_config, "w+");
		@flock  ( $fp_config , 2 ); 
			@fwrite($fp_config, "<?php\n");
			
			@fwrite($fp_config, "\nif (!defined('CTXTRA'))\n");
			@fwrite($fp_config, "		die ('Hacking attempt...');\n");
							
			@fwrite($fp_config, "\n/* general configuration */\n");
			@fwrite($fp_config, "\$ct_db_user							= '".$_POST['db_user']."';\n");
			@fwrite($fp_config, "\$ct_db_pass							= '".$_POST['db_pass']."';\n");
			@fwrite($fp_config, "\$ct_email								= '".$_POST['email']."';\n");
			@fwrite($fp_config, "\$ct_atack_email						= '".$_POST['atack_email']."';\n");
			@fwrite($fp_config, "\$ct_lang								= '".$_POST['language']."';\n");
			@fwrite($fp_config, "\$ct_htaccess							= '".$_POST['htaccess']."';\n");
			@fwrite($fp_config, "\$ct_htaccess_error					= '".$_POST['htaccess_error']."';\n");
			@fwrite($fp_config, "\$ct_ref_loggen						= '".$_POST['ref_loggen']."';\n");
			@fwrite($fp_config, "\$ct_auto_iplist						= '".$_POST['auto_iplist']."';\n");
			@fwrite($fp_config, "\$ct_auto_spamlist						= '".$_POST['auto_spamlist']."';\n");
			@fwrite($fp_config, "\$ct_bbc_spam							= '".$_POST['bbc_spam']."';\n");
			@fwrite($fp_config, "\$ct_iploggen_spam						= '".$_POST['iploggen_spam']."';\n");
			@fwrite($fp_config, "\$ct_spamprotector1					= '".$_POST['spamfilter']."';\n");
			@fwrite($fp_config, "\$ct_spamprotector						= '".$_POST['forum']."';\n");
			@fwrite($fp_config, "\$ct_spam_protector_submit_other		= @".stripslashes($spam_protector_submit_other).";\n");
			@fwrite($fp_config, "\$ct_spam_protector_content_other		= @".stripslashes($spam_protector_content_other).";\n");
			@fwrite($fp_config, "\$ct_spam_protector_submit_other_print	= '".$_POST['spam_protector_submit_other']."';\n");
			@fwrite($fp_config, "\$ct_spam_protector_content_other_print= '".$_POST['spam_protector_content_other']."';\n");

			@fwrite($fp_config, "\n/* path configuration */\n");
			@fwrite($fp_config, "\$ct_borddir	= '".$_POST['ct_borddir']."';\n");
			@fwrite($fp_config, "\$ct_filedir 	= '".$_POST['filedir']."';\n");
			
			@fwrite($fp_config, "\n/* module width in pixel */\n");
			@fwrite($fp_config, "\$ct_block_space = ".$_POST['block_space'].";\n");
			
			@fwrite($fp_config, "\n/* Footer Theme */\n");
			@fwrite($fp_config, "\$ct_footer_theme = ".$_POST['footer_theme'].";\n");
			
			@fwrite($fp_config, "\n?>");
		@flock  ( $fp_config , 3 ); 
	@fclose($fp_config);
}


############################################################################################################
// Spam löschen
function spam_loeschen(){
	
	global $ct_log_spam;
	
	if (isset($_POST['submit_del_spamword'])) {
		$zeilen_del = array_reverse(file($ct_log_spam));
		$array_del = $_POST['zeile'];
		for ($i=0;$i< sizeof($array_del);++$i) {
			unset($zeilen_del[current($array_del)]);
			next($array_del);
		}

		$fp_log = fopen($ct_log_spam, "w");
		$zeilen_del = array_reverse($zeilen_del);
		$i=0;
		while($i<count($zeilen_del)) {
			$zeilen_del[$i] = trim($zeilen_del[$i]);
			if (!empty($zeilen_del[$i])) {
				@fwrite($fp_log, $zeilen_del[$i]."\n");
			}
			$i++;
		}
		@fclose($fp_log); 
	}
	if (isset($_POST['submit_del_all_spamwords'])) {
		$fp_log = fopen($ct_log_spam, "w");
		@fclose($fp_log); 
	}
}


############################################################################################################
// Angriff löschen
function angriff_loeschen() {
	
	global $ct_log_file, $ct_log_ips;
	
	if (isset($_POST['zeile']) AND isset($_POST['submit_del'])) {
		// markierte löschen aber ips im filter belassen
		if (isset($_POST['submit_del_log']) AND $_POST['submit_del'] == "del_log") {
			$zeilen_del = array_reverse(file($ct_log_file));
			$array_del = $_POST['zeile'];
			for ($i=0;$i< sizeof($array_del);++$i) {
				unset($zeilen_del[current($array_del)]);
				next($array_del);
			}
	
			$fp_log = @fopen($ct_log_file, "w");
			$zeilen_del = array_reverse($zeilen_del);
			$i=0;
			while($i<count($zeilen_del)) {
				$zeilen_del[$i] = trim($zeilen_del[$i]);
				if (!empty($zeilen_del[$i])) {
					@fwrite($fp_log, $zeilen_del[$i]."\n");
				}
				$i++;
			}
			@fclose($fp_log); 
		}
	}


	if (isset($_POST['zeile']) AND isset($_POST['submit_del'])) {
		// markierte löschen und ips aus filter entfernen
		if (isset($_POST['submit_del_log']) AND $_POST['submit_del'] == "del_log_ip") {
	
			// Lese IP-Liste in Array und lösche leere Zeilen
			$fp_ips	= @fopen($ct_log_ips, "a+");
			if (file_exists($ct_log_ips)) {
				while (!feof($fp_ips)) {
					$zeile = trim(fgets($fp_ips,4096));
					if (!empty($zeile)) {
						$ip_zeilen[] = $zeile;
					}				
				}
			}
			@fclose($fp_ips); 
	
			
			// Lösche IPs aus Array
			$array_ip	= $_POST['ip'];
			$array_del	= $_POST['zeile'];
			$i=1;
			while($i<count($array_del)) {
				$ip_del = $array_ip[current($array_del)]; // IP
					$ip_key = array_search($ip_del, $ip_zeilen);
					unset($ip_zeilen[$ip_key]);
				next($array_del);
				$i++;
			}		

			// schreibe IP-Liste neu
			$fp_ips = @fopen($ct_log_ips, "w");
			$i=1;
			if (!isset($ip_zeilen)) {$ip_zeilen = "";}
			while($i<count($ip_zeilen)) {
				$chop = trim($ip_zeilen[$i]);
				if(!empty($chop)) {
					@fwrite($fp_ips, $ip_zeilen[$i]."\n");
				}
				$i++;
				
			}
			@fclose($fp_ips);
			
			// Lösche doppelte einträge aus IP-Liste
			double_entry();
					
			// Lösche Logeintrag aus Log-Datei
			$zeilen_del = array_reverse(file($ct_log_file));
			$array_del	= $_POST['zeile'];
			for ($i=0;$i< sizeof($array_del);++$i) {
				unset($zeilen_del[current($array_del)]);
				next($array_del);
			}		
	
			$fp_log = @fopen($ct_log_file, "w");
			$zeilen_del = array_reverse($zeilen_del);
			$i=0;
			while($i<count($zeilen_del)) {
				$zeilen_del[$i] = trim($zeilen_del[$i]);
				if (!empty($zeilen_del[$i])) {
					@fwrite($fp_log, $zeilen_del[$i]."\n");
				}
				$i++;
			}
			@fclose($fp_log); 
		}
	}
	
	if (isset($_POST['zeile']) AND isset($_POST['submit_del'])) {
		// alle löschen aber ips im filter belassen	
		if (isset($_POST['submit_del_log']) AND $_POST['submit_del'] == "del_all") {
			$fp_log = @fopen($ct_log_file, "w");
			@fclose($fp_log); 
		}

		// alle löschen und auch IPs aus IP-Filter löschen
		if (isset($_POST['submit_del_log']) AND $_POST['submit_del'] == "del_all_ip") {
	
			$array_del	= $_POST['zeile'];
			$array_ip	= $_POST['ip'];
	
			// Lese IP-Liste in Array und lösche leere Zeilen
			$fp_ips	= @fopen($ct_log_ips, "a+");
			if (file_exists($ct_log_ips)) {
				while (!feof($fp_ips)) {
					$zeile = trim(fgets($fp_ips,4096));
					if (!empty($zeile)) {
						$ip_zeilen[] = $zeile;
					}				
				}
			}
			@fclose($fp_ips); 
	
			// Lösche IPs aus Array
			for ($i=0;$i< sizeof($array_del);++$i) {
				$ip_del = $array_ip[current($array_del)]; // IP
					$ip_key = array_search($ip_del, $ip_zeilen);
					unset($ip_zeilen[$ip_key]);
				next($array_del);
			}		
	
			// schreibe IP-Liste neu
			$fp_ips = @fopen($ct_log_ips, "w");
			$i=0; 
			while($i<count($ip_zeilen)) {
				@fwrite($fp_ips, $ip_zeilen[$i]."\n");
				$i++;
			}
			@fclose($fp_ips); 
			
			// Lösche alle Logeinträge aus Log-Datei
			$fp_log = @fopen($ct_log_file, "w");
			@fclose($fp_log); 
		}
			
	}
}


############################################################################################################
// Fehlermeldung nach speichern der Einstellungen
function info_einstellungen() {

	global $txt_functions;

	$info_einstellungen = '
	<table style="width:800px; background-color:#ff0000; border-left:1px solid #999999; border:right:1px solid #999999">
		<tr>
			<td width="8px">&nbsp;</td>
			<td style="text-align:left">
				<span style="font-size:12px; font-weight:bold; color:#ffffff">'.$txt_functions[3].'</span>
			</td>
		</tr>
	</table>';
	return $info_einstellungen;	
}


############################################################################################################
// IP-Liste wird automatisch aktualisiert
function auto_ip_list() {
	
	global $ct_log_ips, $online_iplist;
	
	if (url_ok_or_not($online_iplist)) {
		$online_iplist = socketorfile_fgets_for_lists($online_iplist);
		
		$fp_ips = fopen($ct_log_ips, "a+");
		
	    preg_match_all('/<word>(.*?)<\/word>/si', $online_iplist, $ipwords);
	    $chop[] = "";
		foreach ($ipwords[0] as $messung){
	        preg_match('/<ip>(.*?)<\/ip>/si', $messung, $ip);
	        $chop[] .= $ip[1]."\n";
	    }
	
	    $new_ips = $chop;
	    	
		// Lese text datei in Array und lösche leere zeilen
		$ip_zeilen[]="";
		if (file_exists($ct_log_ips)) {
			while (!feof($fp_ips)) {
				$zeile = chop(fgets($fp_ips,4096));
				if (!empty($zeile)) {
					$ip_zeilen[] = $zeile;
				}
			}
		}
		
		// Überprüfe ob neue IP schon vorhanden
		$i=0;
		while($i<count($new_ips)) {
			$new_ips[$i] = chop($new_ips[$i]);
			if (!in_array($new_ips[$i], $ip_zeilen)) {
				fwrite($fp_ips, $new_ips[$i]."\n");
			}
			$i++;
		}
		@fclose($fp_ips);
	}
}


############################################################################################################
// SPAM-Liste wird automatisch aktualisiert
function auto_spam_list() {
	
	global $ct_spamlist, $online_spamlist;
	
	if (url_ok_or_not($online_spamlist)) {
		$online_spamlist = socketorfile_fgets_for_lists($online_spamlist);
		
		$fp_spamwords = @fopen($ct_spamlist, "a+");
		
	    preg_match_all('/<spamwords>(.*?)<\/spamwords>/si', $online_spamlist, $spamwords);
	    $chop[] = "";
		foreach ($spamwords[0] as $messung){
	        preg_match('/<spamword>(.*?)<\/spamword>/si', $messung, $spamword);
	        $chop[] .= $spamword[1]."\n";
	    }
	
	    $new_spamwords = $chop;
	    	
		// Lese text datei in Array und lösche leere zeilen
		$spamword_zeilen[]="";
		if (file_exists($ct_spamlist)) {
			while (!feof($fp_spamwords)) {
				$zeile = chop(fgets($fp_spamwords,4096));
				if (!empty($zeile)) {
					$spamword_zeilen[] = $zeile;
				}
			}
		}
		// Überprüfe ob neue IP schon vorhanden
		$i=0;
		while($i<count($new_spamwords)) {
			$new_spamwords[$i] = chop($new_spamwords[$i]);
			if (!in_array($new_spamwords[$i], $spamword_zeilen)) {
				@fwrite($fp_spamwords, $new_spamwords[$i]."\n");
			}
			$i++;
		}
		@fclose($fp_spamwords);
	}
}


############################################################################################################
// installations infos
function ct_log_ctxtras() {

	global $ct_log_ctxtras, $ct_install_time, $version_number, $revision_number, $updatetime_iplist, $updatetime_spamlist;
	global $update_iplist_dummy, $update_spamlist_dummy, $chkmd5return_iplist, $chkmd5return_spamlist;
	global $last_login1, $last_login2, $false_login, $update_version_number, $update_revision;

		if (@file_exists($ct_log_ctxtras)) {
			
			if (empty($updatetime_iplist) OR isset($update_iplist_dummy)) {$updatetime_iplist = time();}
			if (empty($updatetime_spamlist) OR isset($update_spamlist_dummy)) {$updatetime_spamlist = time();}

			if (empty($updatemd5_iplist) OR isset($update_iplist_dummy)) {$updatemd5_iplist = $chkmd5return_iplist;}
			if (empty($updatemd5_spamlist) OR isset($update_spamlist_dummy)) {$updatemd5_spamlist = $chkmd5return_spamlist;}

			if (empty($ct_install_time)) {$ct_install_time = time();}
			if ($version_number == "1" OR empty($version_number)) {$version_number = $update_version_number;}
			if ($revision_number == "1" OR empty($revision_number)) {$revision_number = $update_revision;}

			if((int) PHP_VERSION === 5) {
				$ct_install_time = (int)$ct_install_time;
			}


			$fp_log_ctxtras = @fopen($ct_log_ctxtras, "w+");
				@flock  ( $fp_log_ctxtras , 2 ); 
					@fwrite($fp_log_ctxtras, "<?php\n");
					
					@fwrite($fp_log_ctxtras, "\$ct_install_time	= '".$ct_install_time."';\n");
					@fwrite($fp_log_ctxtras, "\$ct_install_all_attacks	= '".count_all_logs()."';\n");					

					@fwrite($fp_log_ctxtras, "\$version_number	= '".$version_number."';\n");
					@fwrite($fp_log_ctxtras, "\$revision_number	= '".$revision_number."';\n");					

					@fwrite($fp_log_ctxtras, "\$updatetime_iplist = '".$updatetime_iplist."';\n");
					@fwrite($fp_log_ctxtras, "\$updatetime_spamlist = '".$updatetime_spamlist."';\n");
					
					@fwrite($fp_log_ctxtras, "\$updatemd5_iplist = '".$updatemd5_iplist."';\n");
					@fwrite($fp_log_ctxtras, "\$updatemd5_spamlist = '".$updatemd5_spamlist."';\n");

					if (isset($_POST['login'])) {
						if(!isset($_SESSION['last_login_time'])) {$_SESSION['last_login_time'] = $last_login2;}
						@fwrite($fp_log_ctxtras, "\$last_login2 = '".$last_login1."';\n");	
						@fwrite($fp_log_ctxtras, "\$last_login1 = '".$_SESSION['last_login_time']."';\n");
					} else {
						@fwrite($fp_log_ctxtras, "\$last_login2 = '".$last_login2."';\n");
						@fwrite($fp_log_ctxtras, "\$last_login1 = '".$last_login1."';\n");
					}
					
					if (!isset($_SESSION['login_okay']) && isset($_POST['login'])) {
						$false_login = $false_login + 1;
						@fwrite($fp_log_ctxtras, "\$false_login = '".$false_login."';\n");
					} else {
						@fwrite($fp_log_ctxtras, "\$false_login = '0';\n");
					}
					
					@fwrite($fp_log_ctxtras, "?>");
				@flock  ( $fp_log_ctxtras , 3 ); 
			@fclose($fp_log_ctxtras);
		} else {
			$fp_log_ctxtras = @fopen($ct_log_ctxtras, "w+");
				@flock  ( $fp_log_ctxtras , 2 ); 
					@fwrite($fp_log_ctxtras, "<?php\n");
					
					@fwrite($fp_log_ctxtras, "\$ct_install_time			= '".time()."';\n");
					@fwrite($fp_log_ctxtras, "\$ct_install_all_attacks	= '".count_all_logs()."';\n");
				
					@fwrite($fp_log_ctxtras, "\$version_number	= '".$update_version_number."';\n");
					@fwrite($fp_log_ctxtras, "\$revision_number	= '".$update_revision."';\n");
	
					@fwrite($fp_log_ctxtras, "\$updatetime_iplist = '".time()."';\n");
					@fwrite($fp_log_ctxtras, "\$updatetime_spamlist = '".time()."';\n");
				
					@fwrite($fp_log_ctxtras, "\$updatemd5_iplist = '0';\n");
					@fwrite($fp_log_ctxtras, "\$updatemd5_spamlist = '0';\n");

					@fwrite($fp_log_ctxtras, "\$last_login1 = '".time()."';\n");
					@fwrite($fp_log_ctxtras, "\$last_login2 = '0';\n");	
				
					@fwrite($fp_log_ctxtras, "\$false_login = '0';\n");
				
					@fwrite($fp_log_ctxtras, "?>");
				@flock  ( $fp_log_ctxtras , 3 ); 
			@fclose($fp_log_ctxtras);
		}
}

############################################################################################################
// Logfiles anlegen
function no_write_log() {
	
	global $ct_log_ips, $ct_bots, $ct_log_file, $ct_log_countips, $ct_log_bots, $ct_spamlist, $ct_log_spam, $ct_log_ctxtras, $ct_whitelistes;
	global $ct_sourcedir, $ct_ftp_server, $ct_ftp_user, $ct_ftp_pass, $ct_ftp_ordner;

	if (   !file_exists($ct_log_ips) 
		OR !file_exists($ct_log_file)
		OR !file_exists($ct_bots)
		OR !file_exists($ct_log_countips)
		OR !file_exists($ct_spamlist)
		OR !file_exists($ct_log_spam)
		OR !file_exists($ct_log_ctxtras)
		OR !file_exists($ct_log_bots) 
		OR !file_exists($ct_whitelistes)) {
			
		// FTP connection	
	    #$connection = @ftp_connect($ct_ftp_server);  
	
		// login to ftp server 
		#@ftp_login($connection, $ct_ftp_user, $ct_ftp_pass);
#		if (!ftp_login($connection, $ftp_user, $ftp_pass)) die('Error logging into '.$ftp_server.'.');	

		$fopen_ct_log_ips = fopen($ct_log_ips, "a");
		$fopen_ct_bots = fopen($ct_bots, "a");
	 	$fopen_ct_log_file = fopen($ct_log_file, "a");
	 	$fopen_ct_log_countips = fopen($ct_log_countips, "a");
	 	$fopen_ct_log_bots = fopen($ct_log_bots, "a");
	 	$fopen_ct_spamlist = fopen($ct_spamlist, "a");
	 	$fopen_ct_log_spam = fopen($ct_log_spam, "a");
	 	$fopen_ct_log_ctxtras = fopen($ct_log_ctxtras, "a");
	 	$fopen_ct_whitelistes = fopen($ct_whitelistes, "a");

		fclose($fopen_ct_log_ips);
		fclose($fopen_ct_bots);
		fclose($fopen_ct_log_file);
		fclose($fopen_ct_log_countips);
		fclose($fopen_ct_log_bots);
		fclose($fopen_ct_spamlist);
		fclose($fopen_ct_log_spam);
		fclose($fopen_ct_log_ctxtras);
		fclose($fopen_ct_whitelistes);

		chmod ($ct_log_ips, 0666);   
		chmod ($ct_bots, 0666);
		chmod ($ct_log_file, 0666);
		chmod ($ct_log_countips, 0666);
		chmod ($ct_log_bots, 0666);
		chmod ($ct_spamlist, 0666);
		chmod ($ct_log_spam, 0666);
		chmod ($ct_log_ctxtras, 0666);
		chmod ($ct_whitelistes, 0666);
	} 
		
}


############################################################################################################
// Lies alle Spamwords in ein Array
function spamwords() {
	global $ct_spamlist;
	$fp_spamlist = fopen($ct_spamlist, "a+");
	if (file_exists($ct_spamlist)) {
		while (!feof($fp_spamlist)) {
			$zeile = chop(fgets($fp_spamlist,4096));
			if (!empty($zeile)) {
				$array_spam[] = $zeile;
			}
		}
	}
	return $array_spam;
}

############################################################################################################
// Botprotector laden
function botprotector() {
	
	global $ct_bots;
	
	$botprotector	= @file($ct_bots);
	$i=0; $botprotector_new="";
	while ($i<count($botprotector)) {
		$botprotector[$i]	= trim($botprotector[$i]);
		$botprotector_new[] .= $botprotector[$i];
		$i++;				
	}
	return $botprotector_new;
}


############################################################################################################
// Ipprotector laden
function ipprotector() {
	
	global $ct_log_ips;
	
	$ipprotector	= @file($ct_log_ips);
	$i=0; $ipprotector_new="";
	while ($i<count($ipprotector)) {
		$ipprotector[$i]	= trim($ipprotector[$i]);
		$ipprotector_new[] .= $ipprotector[$i];
		$i++;				
	}
	return $ipprotector_new;
}


############################################################################################################
// zähle online IP's 
function online_ips() {
	global $online_iplist;
	
	if (url_ok_or_not($online_iplist)) {
		$online_iplist = socketorfile_fgets_for_lists($online_iplist);
		
	    preg_match_all('/<word>(.*?)<\/word>/si', $online_iplist, $ipwords);
	    $new_ips="";
		foreach ($ipwords[0] as $messung){
	        preg_match('/<ip>(.*?)<\/ip>/si', $messung, $ip);
	        $new_ips[] .= $ip[1];
	    }
	    $new_ips = count($new_ips);
	}
	
	if (!isset($new_ips)) {$new_ips = "0";}
	return $new_ips;
}


############################################################################################################
// zähle online Spamwords 
function online_spamwords() {
	global $online_spamlist;
	
	if (url_ok_or_not($online_spamlist)) {
		$online_spamlist = socketorfile_fgets_for_lists($online_spamlist);
		
	    preg_match_all('/<spamwords>(.*?)<\/spamwords>/si', $online_spamlist, $spamwords);
	    $new_spamwords="";
		foreach ($spamwords[0] as $messung){
	        preg_match('/<spamword>(.*?)<\/spamword>/si', $messung, $spamword);
	        $new_spamwords[] .= $spamword[1];
	    }
	    $new_spamwords = count($new_spamwords);
	}
	
	if (!isset($new_spamwords)) {$new_spamwords = "0";}
	
	return $new_spamwords;
}


############################################################################################################
// zähle geblockte angriffe
function count_attacks() {
	global $ct_log_file;
	$zeilen = @file($ct_log_file);
	if (file_exists($ct_log_file)) {
		$i=0; $count_attacks=0;
		while($i<count($zeilen)){
			$zeilen_clean = chop($zeilen[$i]);
			if(!empty($zeilen_clean)) {
				$explode = explode("!!", $zeilen[$i]);
				$count_attacks = $count_attacks + $explode[2];
			}
			$i++;
		}
	} else {$count_attacks=0;}
	return $count_attacks;
}


############################################################################################################
// zähle durch IP-Filter geblockte zurgiffe
function count_blocked_ips() {
	global $ct_log_countips;
	$zeilen	= @file($ct_log_countips);
	if (count($zeilen) > 0) {
		$zeilen = $zeilen[0];
	} else {$zeilen = 0;}
	return $zeilen;
}


############################################################################################################
// zähle geblockte IP
function count_ips() {
	global $ct_log_ips;
	$fp_ips = @fopen($ct_log_ips, "r");
	if (file_exists($ct_log_ips)) {
		$i=0;
		while (!feof($fp_ips)) {
			$zeile = trim(fgets($fp_ips,4096));
			if (!empty($zeile)) {
				$count_ips = $i + 1;
				$i++;
			}
		}
	}
	@fclose($fp_ips);
	
	if (isset($count_ips)) {
		$count_ips = $count_ips;
	} else {$count_ips = 0;}
	return $count_ips;
}


############################################################################################################
// zähle Spamwords
function count_spamwords() {
	global $ct_spamlist;

	$zeilen	= @file($ct_spamlist);
	$i		= 0;
	
	$new_zeilen = array();
	while($i<count($zeilen)) {
		$chop_zeilen = chop($zeilen[$i]);
		if (!empty($chop_zeilen)){
			$new_zeilen[] .= $chop_zeilen;
		}
		$i++;
	}
	
	return count($new_zeilen);
}


############################################################################################################
// zähle geblockten SPAM
function count_loged_spam() {
	global $ct_log_spam;

	$zeilen	= @file($ct_log_spam);
	$i		= 0;
	
	$new_zeilen = array();
	while($i<count($zeilen)) {
		$chop_zeilen = chop($zeilen[$i]);
		if (!empty($chop_zeilen)){
			$new_zeilen[] .= $chop_zeilen;
		}
		$i++;
	}
	
	return count($new_zeilen);
}


############################################################################################################
// zähle geblockte BOT's (ergibbt sich unteranderem aus online-listen)
function count_bots() {

	global $ct_bots, $ct_spamlist;

	$zeilen		= @file($ct_bots);
	$zeilen2	= @file($ct_spamlist);
	$i			= 0;
	
	$new_zeilen = array();
	while($i<count($zeilen)) {
		$chop_zeilen = chop($zeilen[$i]);
		if (!empty($chop_zeilen)){
			$new_zeilen[] .= $chop_zeilen;
		}
		$i++;
	}
	
	$new_zeilen2 = array();
	while($i<count($zeilen2)) {
		$chop_zeilen2 = chop($zeilen2[$i]);
		if (!empty($chop_zeilen2)){
			$new_zeilen2[] .= $chop_zeilen2;
		}
		$i++;
	}
	
	$all = count($new_zeilen) + count($new_zeilen2);
	return $all;
}


############################################################################################################
// zähle geblockte BOT zugriffe
function count_blocked_bots() {
	global $ct_log_bots, $ct_log_spam;
	
	$zeilen		= @file($ct_log_bots);
	$zeilen2	= @file($ct_log_spam);
	$i			= 0;

	$new_zeilen = array();
	while($i<count($zeilen)) {
		$chop_zeilen = chop($zeilen[$i]);
		if (!empty($chop_zeilen)){
			$new_zeilen[] .= $chop_zeilen;
		}
		$i++;
	}

	$new_zeilen2 = array();
	while($i<count($zeilen2)) {
		$chop_zeilen2 = chop($zeilen2[$i]);
		if (!empty($chop_zeilen2)){
			$new_zeilen2[] .= $chop_zeilen2;
		}
		$i++;
	}
	
	$all = count($new_zeilen) + count($new_zeilen2);
	return $all;
}


############################################################################################################
// zähle alle angriffe
function count_all_logs() {
	$count_all_logs = count_blocked_ips() + count_attacks() + count_blocked_bots();
	return $count_all_logs;
}


############################################################################################################
// Foooter/Copyright
function footer() {
	global $ct_imagedir, $version_number, $revision_number, $ct_footer_theme, $ctxtra_url, $footer_list;
	
	include($footer_list);
	$ct_footer[0] = "";	$i=1;
	while($i<count($ct_footer)) {
		if ($ct_footer_theme == $i) {
			$footer = $ct_footer[$i].ref_loggen();
		}
		$i++;
	}
   	return $footer;
}


############################################################################################################
// WORM PROTECTOR

function wormprotector(){
	include('wormprotector.txt');
	return $wormprotector;
}

############################################################################################################
############################################################################################################
// SPAM loggen
function ct_spam_protector(){
	global $ct_spamprotector, $ct_spamprotector1, $ct_imagedir, $ct_email, $ct_spam_protector_submit_other, $ct_spam_protector_content_other, $ct_iploggen_spam;
	global $ct_log_spam, $cremotead, $cuseragent, $crefferer ,$ctype, $ccookie, $cprotocol, $cmethod, $curi;
	global $txt_functions;

	if ($ct_spamprotector1 != "no") {
		$array_spam = spamwords();
		
		##################################################################

		// PHPKit 1.6.1
		if ($ct_spamprotector == "phpkit_1.6.1") {
			$ct_spam_protector_submit	= true;
			$ct_spam_protector_content	= $_POST['content'];
		}
	
		// SMF 1.1.2
		if ($ct_spamprotector == "smf_1.1.2") {
			if (!isset($_REQUEST['msg'])) {$ct_spam_protector_submit	= true;}
			$ct_spam_protector_content	= $_POST['message'];
		}
		
		// phpBB2 
		if ($ct_spamprotector == "phpbb2") {
			global $HTTP_POST_VARS;
			$ct_spam_protector_submit	= true;
			$ct_spam_protector_content	= $HTTP_POST_VARS['message'];
		}
		
		// DZCP 1.4.x.x
		if ($ct_spamprotector == "dzcp14xx") {
			$ct_spam_protector_submit	= true;
			$ct_spam_protector_content	= $_POST['eintrag'];
		}

		// PHP Fusion 6
		if ($ct_spamprotector == "phpfusion_6") {
			$ct_spam_protector_submit	= true;
			$ct_spam_protector_content	= $_POST['message'];
		}

		// Other Scripts
		if ($ct_spamprotector1 == "other") {
			$ct_spam_protector_submit	= true;
			$ct_spam_protector_content	= $ct_spam_protector_content_other;
		}
		##################################################################
	
		if (isset($ct_spam_protector_submit)) {
			$i=0;
			while($i<count($array_spam)) {
				if (eregi($array_spam[$i], $ct_spam_protector_content)) {
								
					// Spam loggen
					$ct_spam_protector_content = htmlentities($ct_spam_protector_content);
					$ct_spam_protector_content = str_replace( "\r\n", "<br />", $ct_spam_protector_content);
					$ct_spam_protector_content = str_replace( "<script>", "<__KILL_BY_CTXTRA__script>", $ct_spam_protector_content);
				
					$fp_ct_log	= fopen($ct_log_spam, "a");
					$ct_log		= $array_spam[$i].'||ctxtra_spam_dummy||'.time().'||ctxtra_spam_dummy||'.$cremotead.'||ctxtra_spam_dummy||'.$cuseragent.'||ctxtra_spam_dummy||'.$crefferer.'||ctxtra_spam_dummy||'.$ctype.'||ctxtra_spam_dummy||'.$ccookie.'||ctxtra_spam_dummy||'.$cprotocol.'||ctxtra_spam_dummy||'.$cmethod.'||ctxtra_spam_dummy||'.$curi.'||ctxtra_spam_dummy||'.$ct_spam_protector_content;
					fputs($fp_ct_log, $ct_log."\r\n", 4096);
					fclose($fp_ct_log);

					// IP sperren wenn in Einstellungen aktiviert
					if ($ct_iploggen_spam == "yes") {sperre_ip();}
					
				    die( '<title>CTXtra - '.$txt_functions[4].'</title>
							<center>
				  		    <table style="width:800px; height:200px; border:1px solid #999999; background-color:#E7E7E7" cellspacing="0" cellpadding="0">
							  <tr>
							    <td valign="middle" align="left">
					              <table width="98%">
					                <tr><td style="line-height:25px">&nbsp;</td></tr>
					                <tr>          
					                  <td style="text-align:center; height:100px; width:150px; vertical-align:middle;">
										<img src="'.$ct_imagedir.'achtung.jpg" alt=""/>
									  </td>
					                  <td style="text-align:middel; height:100px; vertical-align:middle;">
					                	<span style="font-size:15px; color:#ff0000; font-family:verdana,arial">
					                		<h3>'.$txt_functions[4].'</h3>
					                	</span><span style="font-size:15px; color:#000000; font-family:verdana,arial">
											'.$txt_functions[5].'<br />
		    			            		'.$txt_functions[6].' <a href="mailto:'.ct_admin_email().'">'.ct_admin_email().'</a> '.$txt_functions[7].'<b />
										</span>
										<br />
									  </td>
					                </tr>
					                <tr><td style="line-height:15px">&nbsp;</td></tr>
					              </table>
					            </td>
					          </tr>
					        </table>
						  '.versions_info().'
				  		  </center>');
				}
				$i++;
			}
		}
	}
}

############################################################################################################
// Angriff loggen
function angriff_loggen() {
	global $neu, $alt, $checkworm, $worm_cracktrack_dummy, $explode, $ct_log_file, $wormprotector;
	global $worm_cracktrack, $cremotead, $cuseragent, $crefferer, $ctype, $ccookie, $cprotocol, $cmethod, $curi;

	// Signatur aus $worm_cracktrack_dummy filtern
	$worm_cracktrack	= rawurlencode($worm_cracktrack);
	$i=0;
	while($i<count($wormprotector)) {
		$wormprotector2 = rawurlencode($wormprotector[$i]);
		
		if (eregi($wormprotector2, $worm_cracktrack)) {
			$worm_signatur = $wormprotector[$i];
		    break;
		}
		$i++;
	}


	// Wenn angriff in selber stunde mehrmals dann erhöhe counter
	if (($neu == $alt) && ($checkworm != $worm_cracktrack_dummy)) {
	  if (!isset($explode[2])) {$explode_2 = 0;} else {$explode_2 = $explode[2] + 1;}
	  $ersetzen	= $explode[0]."!!".$explode[1]."!!".$explode_2."!!".$explode[3]."!!".$explode[4]."!!".$explode[5]."!!".$explode[6]."!!".$explode[7]."!!".$explode[8]."!!".$explode[9]."!!".$explode[10]."!!".$explode[11]."!!".$worm_signatur."\r\n";
	  $zeilen	= file($ct_log_file);
	    
	  $neues_array	= array_splice($zeilen, -1, 1, array($ersetzen));
	  $fp_ct_log	= @fopen($ct_log_file, "w");
	  $i=0;
	  while($i<count($zeilen)){
	    fputs($fp_ct_log, $zeilen[$i], 4096);
		$i++;
	  }
	  fclose($fp_ct_log);
	// Wenn angriff noch nicht in dieser stunde dann logge als neuen angriff
	} elseif (($neu != $alt) && ($checkworm != $worm_cracktrack_dummy)) {
	  $ct_log		= date('YmdH',time()).'!!'.time().'!!1!!'.$worm_cracktrack.'!!'.$cremotead.'!!'.$cuseragent.'!!'.$crefferer.'!!'.$ctype.'!!'.$ccookie.'!!'.$cprotocol.'!!'.$cmethod.'!!'.$curi."!!".$worm_signatur;
	  $fp_ct_log	= fopen($ct_log_file, "a");
	  fputs($fp_ct_log, $ct_log."\r\n", 4096);
	  fclose($fp_ct_log);
	}
}


############################################################################################################
// Bad-IP loggen
function log_bad_ip() {
	
	global $ct_log_countips, $ct_imagedir, $txt_functions;
	global $cremotead, $cuseragent, $crefferer, $ccookie, $cprotocol, $cmethod, $curi;
	
	// erhöhe ip counter wenn kein angriff aber ip gesperrt
	$zeilen = '';
	$zeilen	= file($ct_log_countips);
	$geblocke_ip_angriffe = $zeilen[0];
	$geblocke_ip_angriffe = $geblocke_ip_angriffe + 1;;
	$fp_ct_log	= fopen($ct_log_countips, "w+");
	fputs($fp_ct_log, $geblocke_ip_angriffe, 4096);
	fclose($fp_ct_log);

	angriff_loggen();

    die( '<title>CTXtra - '.$txt_functions[12].'</title>
			<center>
  		    <table style="width:800px; border:1px solid #999999; background-color:#E7E7E7" cellspacing="0" cellpadding="0">
			  <tr>
			    <td valign="middle" align="left">
	              <table width="98%" cellspacing="0" cellpadding="0">
	                <tr><td style="line-height:25px">&nbsp;</td></tr>
	                <tr>          
	                  <td style="text-align:center; height:100px; width:150px; vertical-align:middle;">
						<img src="'.$ct_imagedir.'achtung.jpg" alt=""/>
					  </td>
	                  <td style="text-align:middel; height:100px; vertical-align:middle;">
	                	<span style="font-size:15px; color:#ff0000; font-family:verdana,arial">
	                		<h3>'.$txt_functions[8].'</h3>
	                	</span><span style="font-size:15px; color:#000000; font-family:verdana,arial">
	                		'.$txt_functions[9].'<br />
		            		'.$txt_functions[6].' <a href="mailto:'.ct_admin_email().'">'.ct_admin_email().'</a> '.$txt_functions[7].'<b />
						</span>
						<br />
					  </td>
	                </tr>
	                <tr><td style="line-height:15px">&nbsp;</td></tr>
	              </table>
	            </td>
	          </tr>
	        </table>
			'.versions_info().'
			</center>');
}


############################################################################################################
// sperre IP
function sperre_ip(){
	
	global $ct_log_ips, $ip_cracktrack;
	
	$ip_zeilen = file($ct_log_ips);
	$fp_log = fopen($ct_log_ips	, "w");
	$i=0; $ips="";
	while($i<count($ip_zeilen)) {
		$ip_zeilen[$i] = trim($ip_zeilen[$i]);
		if (!empty($ip_zeilen[$i])) {
			$ips .= $ip_zeilen[$i]."\n";
		}
		$i++;
	}
	$ips = $ips.$ip_cracktrack;
	fwrite($fp_log, $ips);
	fclose($fp_log);
}


############################################################################################################
// Wurm loggen
function log_wurm() {
	
	global $ct_atack_email, $ct_email, $ct_db_user, $ct_imagedir, $txt_functions;
	
	angriff_loggen();
	sperre_ip();
			
	// Email an Admin
	if ($ct_atack_email == "yes") {
		$mailtext  = $txt_functions[10]."\n\n";
		$mailtext .= $txt_functions[11]."\n";

		/* zusätzliche Header */
		$headers = "From: ".$_SERVER['HTTP_HOST']." <".$ct_email.">\r\n";
		
		/* Verschicken der Mail */
		mail($ct_email, $txt_functions[12], $mailtext, $headers);

	}

	die( '<title>CTXtra - '.$txt_functions[12].'</title>
			<center>
		    <table style="width:800px; height:200px; border:1px solid #999999; background-color:#E7E7E7" cellspacing="0" cellpadding="0">
			  <tr>
			    <td valign="middle" align="left">
	              <table width="98%">
	                <tr><td style="line-height:25px">&nbsp;</td></tr>
	                <tr>          
	                  <td style="text-align:center; height:100px; width:150px; vertical-align:middle;">
						<img src="'.$ct_imagedir.'achtung.jpg" alt=""/>
					  </td>
	                  <td style="text-align:middel; height:100px; vertical-align:middle;">
	                	<span style="font-size:15px; color:#ff0000; font-weight:bold; font-family:verdana,arial">
							'.$txt_functions[13].'<br />
	                		'.$txt_functions[14].'
						</span>
					  </td>
	                </tr>
	                <tr><td style="line-height:15px">&nbsp;</td></tr>
	              </table>
	            </td>
	          </tr>
	        </table>
			'.versions_info().'
		  	</center>');
}

############################################################################################################
// BOT loggen
function log_bot() {	
	
	global $ct_log_bots, $ct_imagedir, $txt_functions;
	global $cremotead, $bot_cracktrack, $crefferer, $ctype, $ccookie, $cprotocol, $cmethod, $curi;
	
	sperre_ip();
	
	$fp_ct_log	= fopen($ct_log_bots, "a");
	$ct_log		= date('YmdH',time()).'!!'.time().'!!'.$cremotead.'!!'.$bot_cracktrack.'!!'.$crefferer.'!!'.$ctype.'!!'.$ccookie.'!!'.$cprotocol.'!!'.$cmethod.'!!'.$curi;
	fputs($fp_ct_log, $ct_log."\r\n", 4096);
	fclose($fp_ct_log);
	
    die( '<title>CTXtra - '.$txt_functions[15].'</title>
			<center>
  		    <table style="width:800px; height:200px; border:1px solid #999999; background-color:#E7E7E7" cellspacing="0" cellpadding="0">
			  <tr>
			    <td valign="middle" align="left">
	              <table width="98%">
	                <tr><td style="line-height:25px">&nbsp;</td></tr>
	                <tr>          
	                  <td style="text-align:center; height:100px; width:150px; vertical-align:middle;">
						<img src="'.$ct_imagedir.'achtung.jpg" alt=""/>
					  </td>
	                  <td style="text-align:middel; height:100px; vertical-align:middle;">
	                	<span style="font-size:15px; color:#ff0000; font-family:verdana,arial">
	                		<h3>'.$txt_functions[15].'</h3>
	                	</span><span style="font-size:15px; color:#000000; font-family:verdana,arial">
							'.$txt_functions[16].'<br />
				       		'.$txt_functions[6].' <a href="mailto:'.ct_admin_email().'">'.ct_admin_email().'</a> '.$txt_functions[7].'<b />
						</span>
						<br />
					  </td>
	                </tr>
	                <tr><td style="line-height:15px">&nbsp;</td></tr>
	              </table>
	            </td>
	          </tr>
	        </table>
			'.versions_info().'
			</center>');
}

?>