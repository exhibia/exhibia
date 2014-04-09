<?php 
session_start();
define('CTXTRA', 1);
include_once( "../common.php" );
include_once( "../includes/others.php" );
include_once( $ct_log_ctxtras );
include_once( "../languages/".$ct_lang."/more.php");
include_once( "../languages/".$ct_lang."/index.php");
include_once( "../includes/functions.inc.php" );

if (url_ok_or_not($ct_remote_partner)) {
	$temp_remote_partner = socketorfile_fgets($ct_remote_partner);
} else {
	$temp_remote_partner = $txt_index[1].' [ <a href="'.$ct_partner_werden.'" target="_blank">'.$txt_index[2].'</a> ].';
}

###################################################################
// TEMPLATES LADEN - ANFANG
###################################################################

// Template Header laden
include_once('../includes/header.php');

// Kopf laden
$temp = file("../templates/index_start.html");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--temp_remote_partner--", $temp_remote_partner, $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_index2--", $txt_index[2], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_index3--", $txt_index[3], $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_paypal--", $ct_paypal, $temp[$i]);

	$site .= $temp[$i];
}

// Navi laden
include_once('../languages/'.$ct_lang.'/navi.php');
include_once('../includes/navi.php');


// More laden
$temp = file("../templates/more.html");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--txt_more2--", $txt_more[2], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_more3--", $txt_more[3], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_more4--", $txt_more[4], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_more5--", $txt_more[5], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_more8--", $txt_more[8], $temp[$i]);
	
	$temp[$i] = ereg_replace("!--http_host--", $_SERVER['HTTP_HOST'], $temp[$i]);
	$temp[$i] = ereg_replace("!--id--", $_GET['id'], $temp[$i]);
	$temp[$i] = ereg_replace("!--dmY_explode_time--", date("d.m.Y",$_SESSION['explode_time_'.$_GET['id']]), $temp[$i]);
	$temp[$i] = ereg_replace("!--Hms_explode_time--", date("H:m:s",$_SESSION['explode_time_'.$_GET['id']]), $temp[$i]);
	$temp[$i] = ereg_replace("!--H_explode_time--", date("H",$_SESSION['explode_time_'.$_GET['id']]), $temp[$i]);
	$temp[$i] = ereg_replace("!--explode_angriffe--", $_SESSION['explode_angriffe_'.$_GET['id']], $temp[$i]);
	$temp[$i] = ereg_replace("!--explode_angriff--", $_SESSION['explode_angriff_'.$_GET['id']], $temp[$i]);
	$temp[$i] = ereg_replace("!--explode_remoteadr--", $_SESSION['explode_remoteadr_'.$_GET['id']], $temp[$i]);
	$temp[$i] = ereg_replace("!--explode_refferer--", $_SESSION['explode_refferer_'.$_GET['id']], $temp[$i]);
	$temp[$i] = ereg_replace("!--explode_useragent--", $_SESSION['explode_useragent_'.$_GET['id']], $temp[$i]);
	$temp[$i] = ereg_replace("!--explode_type--", $_SESSION['explode_type_'.$_GET['id']], $temp[$i]);
	$temp[$i] = ereg_replace("!--explode_cookie--", $_SESSION['explode_cookie_'.$_GET['id']], $temp[$i]);
	$temp[$i] = ereg_replace("!--explode_protocol--", $_SESSION['explode_protocol_'.$_GET['id']], $temp[$i]);
	$temp[$i] = ereg_replace("!--explode_method--", $_SESSION['explode_method_'.$_GET['id']], $temp[$i]);
	$temp[$i] = ereg_replace("!--explode_uri--", $_SESSION['explode_uri_'.$_GET['id']], $temp[$i]);

	$site .= $temp[$i];
}

// Footer laden
$temp = file("../templates/index_end.html");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--temp_remote_partner--", $temp_remote_partner, $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_index2--", $txt_index[2], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_index3--", $txt_index[3], $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_paypal--", $ct_paypal, $temp[$i]);

	$site .= $temp[$i];
}

	// Template footer.php laden
	include_once('../includes/footer.php');


// Template global bearbeiten
#################################################
	$versions_info = versions_info();
	include('../includes/config.inc.php');
	$site = ereg_replace("!--versions_info--", "$versions_info", $site);	
	$site = ereg_replace("!--version_number--", "$version_number", $site);
	$site = ereg_replace("!--revision_number--", "$revision_number", $site);
	$site = ereg_replace("!--ctxtra_url--", "$ctxtra_url", $site);
	$site = ereg_replace("!--ct_block_space--", "$ct_block_space", $site);
	$site = ereg_replace("!--ct_imagedir--", "$ct_imagedir", $site);
	$site = ereg_replace("!--ct_borddir--", "$ct_borddir", $site);

###################################################################
// TEMPLATES LADEN - ENDE
###################################################################

// Seite anzeigen
#################################################
echo $site;

