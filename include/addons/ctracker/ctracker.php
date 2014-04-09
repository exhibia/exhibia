<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.de			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################
define('CTXTRA', 1);
@set_magic_quotes_runtime(0);
include( "common.php" );
include( "includes/others.php" );

if (file_exists($ct_log_ctxtras)) {
	include($ct_log_ctxtras);
} else {
	$version_number		= true;
	$revision_number	= true;
	$updatetime_iplist  = time() - 86401;
}

include( "languages/".$ct_lang."/functions.php");
include( "includes/functions.inc.php" );


################################################################
// Footer unterstützungen
	// phpBB2
	$ctxtra_footer = footer();
	define( "CTXTRA_PHPBB2", $ctxtra_footer);
	define( "CTXTRA_FOOTER", $ctxtra_footer);


if(!file_exists("update.php")) {
################################################################
// IP-Liste wird alle 24 Stunden automatisch aktualisiert
	if(empty($updatetime_iplist) OR !isset($updatetime_iplist)) {$updatetime_iplist = 0;} 
	$updatetime_ip = time() - $updatetime_iplist;
	if ($updatetime_ip >= 86400) {
		// Online IP-Liste auf Verfügbarkeit prüfen
		if (url_ok_or_not($online_iplist)) {
			// md5chk für IP - Onlineliste
			$chkmd5_iplist			= $online_iplist;
			$chkmd5return_iplist	= @md5_file($chkmd5_iplist);

			// IP Liste updaten
			if(empty($updatemd5_iplist) OR !isset($updatemd5_iplist)) {$updatemd5_iplist = $chkmd5return_iplist;}
			if ($updatemd5_iplist != $chkmd5return_iplist) {
				$update_iplist_dummy = true;
				ct_log_ctxtras();
				unset($update_iplist_dummy);
				if ($ct_auto_iplist == "yes") {auto_ip_list();}
			}
		}
	}

################################################################
// SPAM-Liste wird alle 24 Stunden automatisch aktualisiert
	if(!isset($updatetime_spamlist)) {$updatetime_spamlist = 0;} 
	$updatetime_spam = time() - $updatetime_spamlist;
	if ($updatetime_spam >= 86400) {
		// Online SPAM-Liste auf Verfügbarkeit prüfen
		if (url_ok_or_not($online_spamlist)) {
			// md5chk für SPAN - Onlineliste
			$chkmd5_spamlist		= $online_spamlist;
			$chkmd5return_spamlist	= @md5_file($chkmd5_spamlist);
		
			// SPAM-Liste updaten
			if(!isset($updatemd5_spamlist)) {$updatemd5_spamlist = $chkmd5return_spamlist;}
			if ($updatemd5_spamlist != $chkmd5return_spamlist) {
				$update_spamlist_dummy = true;
				ct_log_ctxtras();
				unset($update_spamlist_dummy);
				if ($ct_auto_spamlist == "yes") {auto_spam_list();}
			}
		}
	}
}


################################################################
// Wormprotector laden
	
	//Debug an/aus
	$debug_wormprotector = 0;
	
	$wormprotector		= wormprotector();	
	
	if($debug_wormprotector == 1) {
		$worm_cracktrack	= $_SERVER['QUERY_STRING'];	
	} else {
		#$worm_cracktrack = "sring";
		$worm_cracktrack	= $_SERVER['QUERY_STRING'];	
	}
			
	while (rawurldecode($worm_cracktrack) != $worm_cracktrack)
	$worm_cracktrack		= rawurldecode($worm_cracktrack);
	$worm_cracktrack_dummy	= strtolower($worm_cracktrack);
	$worm_cracktrack		= $worm_cracktrack_dummy;

	// whiteliste durchlaufen
	@include($ct_whitelistes);
	if (isset($whitelist_wormprotector)) {
		$i=0; $white_signaturen = '';
		while ($i<count($whitelist_wormprotector)) {
			if (!empty($whitelist_wormprotector[$i])) {
				$white_signaturen[] .= urldecode($whitelist_wormprotector[$i]);
			}
			$i++;				
		}
	} else {
		$white_signaturen = array();
	}	
	
	// query bei bedarf durch whitelist entwerten
	$worm_cracktrack_dummy		= str_replace($white_signaturen, 'entwertet_durch_whitelist', $worm_cracktrack_dummy);
	
	// blacklist durchlaufen
	$checkworm					= str_replace($wormprotector, 'geblockt_durch_blacklist', $worm_cracktrack_dummy);

	if($debug_wormprotector == 1) {
		die("<b>DEBUGMODUS:</b><br /><br /><u>originaler QUERY_STING</u><br />".$worm_cracktrack."<br /><br /><u>nach dem der Wormprotector drüber ist:</u><br />". $checkworm);
	}


################################################################
// Botprotector laden
	$botprotector	= botprotector();
	$bot_cracktrack	= addslashes(@$_SERVER['HTTP_USER_AGENT']);
	/* DEBUG */
	#$bot_cracktrack	= "ctxtra_botprotector_dummy";
	$checkbot		= str_replace($botprotector, '*', $bot_cracktrack);

	
################################################################
// Ipprotector laden
	$ipprotector	= ipprotector();
	$ip_cracktrack	= @$_SERVER['REMOTE_ADDR'];
	$checkip		= str_replace($ipprotector, '*', $ip_cracktrack);


//==================================================================
$cremotead	= addslashes(@$_SERVER['REMOTE_ADDR']);
$cuseragent	= addslashes(@$_SERVER['HTTP_USER_AGENT']);
$crefferer 	= addslashes($ip_cracktrack);
$ccookie	= urldecode(@$_SERVER['HTTP_COOKIE']);
$cprotocol	= addslashes($_SERVER['SERVER_PROTOCOL']);
$cmethod	= addslashes(@$_SERVER['REQUEST_METHOD']);
$curi		= addslashes(@$_SERVER['REQUEST_URI']);

$zeilen		= @array_reverse(file($ct_log_file));
if (count($zeilen)>0) {
	$zeilen_clean	= chop($zeilen[0]);
	if(!empty($zeilen_clean)) {
		$explode		= explode("!!", $zeilen_clean);
		$alt = $explode[0]."!!".$explode[4]."!!".$explode[5]."!!".$explode[3];
	}
} else {
	if(!empty($zeilen_clean)) {
		$alt = "explode[0]!!explode[4]!!explode[5]!!explode[3]---DUMMY";
	}
}
$neu = date('YmdH',time()).'!!'.$cremotead.'!!'.$cuseragent.'!!'.$worm_cracktrack;
//==================================================================


################################################################
// Wenn Bad-IP identifiziert
if ($checkip != $ip_cracktrack) {
	// Bad-IP loggen
	log_bad_ip();

################################################################
// Wenn keine Bad-IP identifiziert, sondern Wurm
} elseif ($checkworm != $worm_cracktrack_dummy) {
	// Wurm loggen
	log_wurm();

################################################################
// Wenn BOT identifiziert
} elseif ($checkbot != $bot_cracktrack) {
	// BOT loggen
	log_bot();

} elseif (eregi("ctxtra_dummy", $worm_cracktrack)) {
	die("CTXtra v".$version_number.".".$revision_number." is running.");
}

?>
