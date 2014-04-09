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

no_write_log();
	
// Wenn logfiles nicht existieren - meldung ausgeben!
if (isset($no_write_order_log)) {
	echo $no_ct_log_countips;
	echo $no_ct_log_file;
	echo $no_ct_log_countips;
}

include('includes/config.inc.php');

/* v1.5.06
// CTXtra URL:
if (!url_ok_or_not($fp_borddir)) {
	$color_ct_borddir = 'style="background-color:#ff0000; color:#ffffff"';
} else {$color_ct_borddir="";}


#echo $_SERVER['DOCUMENT_ROOT'].'/'.$ct_filedir;

//CTXtra Verzeichnis:
if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$ct_filedir)) {
	$color_filedir = 'style="background-color:#ff0000; color:#ffffff"';
} else {$color_filedir="";}
*/


$fp_borddir = $ct_borddir."/ctracker.php";
$fp_filedir = "http://".$_SERVER['HTTP_HOST'].$ct_dir."/ctracker.php";

if (!url_ok_or_not($fp_borddir)) {
	$color_ct_borddir = 'style="background-color:#ff0000; color:#ffffff"';
} else {$color_ct_borddir=""; $isset_borddir="";}

if (!url_ok_or_not($fp_filedir)) {
	$color_filedir = 'style="background-color:#ff0000; color:#ffffff"';
} else {$color_ct_filedir=""; $isset_filedir="";}



// Sprache wählen:
$handle=opendir($ct_sourcedir."/languages/");
$temp_lang_options[0] = '';
while ($language_dir = readdir ($handle)) { 
	if ($ct_lang == $language_dir) {$select_lang = 'selected="selected"';} else {$select_lang = '';}
    if ($language_dir != "." && $language_dir != "..") {
		$temp_lang_options[0] .= '<option value="'.$language_dir.'" '.$select_lang.'>'.$language_dir.'</option>';
    }
}
closedir($handle); 


// Htaccess - Schutz:
if(!isset($ct_htaccess_error)) {$ct_htaccess_error = 'yes';}
if ($ct_htaccess == "yes") {$select_htaccess1 = 'selected="selected"';} else {$select_htaccess1 = '';}
if ($ct_htaccess != "yes") {$select_htaccess2 = 'selected="selected"';} else {$select_htaccess2 = '';}
if ($ct_htaccess_error == "yes") {$select_htaccess_error = 'checked="checked"';} else {$select_htaccess_error = '';}


// E-Mail Benachrichtigung bei Angriff:							
if ($ct_atack_email == "yes") {$select_atack_email1 = 'checked="checked"';} else {$select_atack_email1 = '';}
if ($ct_atack_email == "no") {$select_atack_email2 = 'checked="checked"';} else {$select_atack_email2 = '';}


// Meine Domain mitteilen:
if ($ct_ref_loggen == "yes") {$select_ref_loggen1 = 'checked="checked"';} else {$select_ref_loggen1 = '';}
if ($ct_ref_loggen == "no") {$select_ref_loggen2 = 'checked="checked"';} else {$select_ref_loggen2 = '';}


// autom. aktualisieren der IP-Liste:
if ($ct_auto_iplist == "yes") {$select_auto_iplist1 = 'checked="checked"';} else {$select_auto_iplist1 = '';}
if ($ct_auto_iplist == "no") {$select_auto_iplist2 = 'checked="checked"';} else {$select_auto_iplist2 = '';}


// autom. aktualisieren der SPAM-Liste:
if ($ct_auto_spamlist == "yes") {$select_auto_spamlist1 = 'checked="checked"';} else {$select_auto_spamlist1 = '';}
if ($ct_auto_spamlist == "no") {$select_auto_spamlist2 = 'checked="checked"';} else {$select_auto_spamlist2 = '';}


// BBCode in SPAM-Anzeige zulassen:
if ($ct_bbc_spam == "yes") {$select_bbc_spam1 = 'checked="checked"';} else {$select_bbc_spam1 = '';}
if ($ct_bbc_spam == "no") {$select_bbc_spam2 = 'checked="checked"';} else {$select_bbc_spam2 = '';}


// Einstellungen - SPAMFILTER
if (!isset($ct_spamprotector1)) {$ct_spamprotector1="no";}
if (!isset($ct_spamprotector)) {$ct_spamprotector="phpkit_1.6.1";}

if ($ct_spamprotector1 == "no") {$select_spamprotector1 = 'checked="checked"';} else {$select_spamprotector1 = '';}
if ($ct_spamprotector1 == "foren") {$select_spamprotector2 = 'checked="checked"';} else {$select_spamprotector2 = '';}
if ($ct_spamprotector1 == "other") {$select_spamprotector3 = 'checked="checked"';} else {$select_spamprotector3 = '';}

if ($ct_spamprotector == "phpkit_1.6.1") {$select_forum1 = 'selected="selected"';} else {$select_forum1 = '';}
if ($ct_spamprotector == "smf_1.1.2") {$select_forum2 = 'selected="selected"';} else {$select_forum2 = '';}
if ($ct_spamprotector == "phpbb2") {$select_forum3 = 'selected="selected"';} else {$select_forum3 = '';}
if ($ct_spamprotector == "dzcp14xx") {$select_forum4 = 'selected="selected"';} else {$select_forum4 = '';}
if ($ct_spamprotector == "phpfusion_6") {$select_forum5 = 'selected="selected"';} else {$select_forum5 = '';}
							
// Bei erkanntem Spam, IP sperren:
if ($ct_iploggen_spam == "yes") {$select_iploggen_spam1 = 'checked="checked"';} else {$select_iploggen_spam1 = '';}
if ($ct_iploggen_spam == "no") {$select_iploggen_spam2 = 'checked="checked"';} else {$select_iploggen_spam2 = '';}


// Einstellungen - COPYRIGHT / FOOTER
$temp_allfooter[0] = '';

/*
if (isset($_REQUEST['allfooter'])) {
	$temp_allfooter[0] .= '
	<tr>
		<td colspan="2" style="vertical-align:top; text-align:center; line-height:30px; font-weight:bold">!--txt_settings36--</td>
	</tr>
	<tr><td colspan="2" style="line-height:25px"><hr style="width:100%; height:1px; color:#999999" /></td></tr>';
}
*/


// alle Footer anzeigen
include('includes/others.php');
include($footer_list);
$ct_footer[0] = "";	$i=1;

while($i<count($ct_footer)) {
	if ($ct_footer_theme == $i) {$select_footer_theme[$i] = 'checked="checked"';} else {$select_footer_theme[$i] = '';}

	if (isset($_REQUEST['allfooter'])) {
		$temp_allfooter[0] .= '											
		<tr>
			<td style="text-align:left; width:20px"><input type="radio" name="footer_theme" '.$select_footer_theme[$i].' value="'.$i.'" /></td>
			<td style="text-align:center">'.$ct_footer[$i].'</td>
		</tr>
		<tr><td colspan="2" style="line-height:25px"><hr style="width:100%; height:1px; color:#999999" /></td></tr>';
	} elseif ($ct_footer_theme == $i) {
		$temp_allfooter[0] .= '
		<tr>
			<td colspan="2" style="vertical-align:top; text-align:center; line-height:30px; font-weight:bold">'.$txt_settings[41].'</td>
		</tr>
		<tr><td colspan="2" style="line-height:25px"><hr style="width:100%; height:1px; color:#999999" /></td></tr>
		<tr>
			<td style="text-align:center"><input type="hidden" name="footer_theme" '.$select_footer_theme[$i].' value="'.$i.'" />'.$ct_footer[$i].'</td>
		</tr>
		<tr><td colspan="2"><hr style="width:100%; height:1px; color:#999999" /></td></tr>
		<tr><td colspan="2" style="line-height:25px; text-align:center">[ <a href="index.php?settings=true&allfooter#footer">'.$txt_settings[42].'</a> ]</td></tr>';
	}
	$i++;
	
	
}




$temp = file("templates/settings.html");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--txt_settings1--", $txt_settings[1], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings2--", $txt_settings[2], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings3--", $txt_settings[3], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings4--", $txt_settings[4], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings5--", $txt_settings[5], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings6--", $txt_settings[6], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings7--", $txt_settings[7], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings8--", $txt_settings[8], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings9--", $txt_settings[9], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings10--", $txt_settings[10], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings11--", $txt_settings[11], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings12--", $txt_settings[12], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings13--", $txt_settings[13], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings14--", $txt_settings[14], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings15--", $txt_settings[15], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings16--", $txt_settings[16], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings17--", $txt_settings[17], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings18--", $txt_settings[18], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings19--", $txt_settings[19], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings20--", $txt_settings[20], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings27--", $txt_settings[27], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings28--", $txt_settings[28], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings29--", $txt_settings[29], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings30--", $txt_settings[30], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings31--", $txt_settings[31], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings32--", $txt_settings[32], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings33--", $txt_settings[33], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings34--", $txt_settings[34], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings35--", $txt_settings[35], $temp[$i]);		
	$temp[$i] = ereg_replace("!--txt_settings36--", $txt_settings[36], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings37--", $txt_settings[37], $temp[$i]);		
	$temp[$i] = ereg_replace("!--txt_settings38--", $txt_settings[38], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings39--", $txt_settings[39], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings40--", $txt_settings[40], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings43--", $txt_settings[43], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings44--", $txt_settings[44], $temp[$i]);			
	$temp[$i] = ereg_replace("!--txt_settings45--", $txt_settings[45], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings46--", $txt_settings[46], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_settings47--", $txt_settings[47], $temp[$i]);

	
	
	$temp[$i] = ereg_replace("!--info_einstellungen--", "$info_einstellungen", $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_db_user--", "$ct_db_user", $temp[$i]);
	$temp[$i] = ereg_replace("!--input_pssword--", $input_pssword, $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_email--", "$ct_email", $temp[$i]);
	$temp[$i] = ereg_replace("!--color_ct_borddir--", "$color_ct_borddir", $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_borddir--", "$ct_borddir", $temp[$i]);
	$temp[$i] = ereg_replace("!--color_filedir--", "$color_filedir", $temp[$i]);	
	$temp[$i] = ereg_replace("!--ct_filedir--", "$ct_filedir", $temp[$i]);	
	$temp[$i] = ereg_replace("!--lang_options--", $temp_lang_options[0], $temp[$i]);
	$temp[$i] = ereg_replace("!--select_htaccess_error--", "$select_htaccess_error", $temp[$i]);	
	$temp[$i] = ereg_replace("!--select_atack_email1--", "$select_atack_email1", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_atack_email2--", "$select_atack_email2", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_ref_loggen1--", "$select_ref_loggen1", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_ref_loggen2--", "$select_ref_loggen2", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_auto_iplist1--", "$select_auto_iplist1", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_auto_iplist2--", "$select_auto_iplist2", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_auto_spamlist1--", "$select_auto_spamlist1", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_auto_spamlist2--", "$select_auto_spamlist2", $temp[$i]);	
	$temp[$i] = ereg_replace("!--select_bbc_spam1--", "$select_bbc_spam1", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_bbc_spam2--", "$select_bbc_spam2", $temp[$i]);	
	$temp[$i] = ereg_replace("!--select_spamprotector1--", "$select_spamprotector1", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_spamprotector2--", "$select_spamprotector2", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_spamprotector3--", "$select_spamprotector3", $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_spam_protector_submit_other_print--", "$ct_spam_protector_submit_other_print", $temp[$i]);
	$temp[$i] = ereg_replace("!--ct_spam_protector_content_other_print--", "$ct_spam_protector_content_other_print", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_iploggen_spam1--", "$select_iploggen_spam1", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_iploggen_spam2--", "$select_iploggen_spam2", $temp[$i]);
	$temp[$i] = ereg_replace("!--allfooter--", $temp_allfooter[0], $temp[$i]);
	$temp[$i] = ereg_replace("!--select_forum1--", "$select_forum1", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_forum2--", "$select_forum2", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_forum3--", "$select_forum3", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_forum4--", "$select_forum4", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_forum5--", "$select_forum5", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_htaccess1--", "$select_htaccess1", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_htaccess2--", "$select_htaccess2", $temp[$i]);





	$site .= $temp[$i];
}

?>