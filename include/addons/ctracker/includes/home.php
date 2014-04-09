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

include($ct_log_ctxtras);
/*
$minus_ein_tag = time() - 86400;
if(date("d.m.y",(int)$last_login2) == date("d.m.y")) {$tag = "<b>".$txt_home[2]."</b>";
} elseif (date("d.m.y",(int)$last_login2) >= date("d.m.y", $minus_ein_tag)) {$tag = "<b>".$txt_home[3]."</b>";
} else {$tag = ' <b>'.date("d.m.y", (int)$last_login2).'</b>';}

if($last_login2 != 0 OR !empty($last_login2)) {$last_login = $txt_home[4].' '.$tag.' '.$txt_home[5].' <b>'.date("H:i", $last_login2).'</b> '.$txt_home[6].'.';} else {$last_login = "";}
*/
$td_width = 400 - $ct_block_space;

if (url_ok_or_not($ct_remote_news)) {
	$temp_remote_news = socketorfile_fgets($ct_remote_news);
} else {$temp_remote_news = "<b>News down... </b><br /><br />To continue in few minutes.";}

$temp_count_attacks 	= count_attacks();
$temp_count_blocked_ips = count_blocked_ips();
$temp_count_loged_spam 	= count_loged_spam();
$temp_count_ips 		= count_ips();
$temp_count_spamwords 	= count_spamwords();

$temp = file("templates/home.html");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--txt_home1--", $txt_home[1], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_home7--", $txt_home[7], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_home8--", $txt_home[8], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_home9--", $txt_home[9], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_home10--", $txt_home[10], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_home11--", $txt_home[11], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_home12--", $txt_home[12], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_home13--", $txt_home[13], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_home14--", $txt_home[14], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_home15--", $txt_home[15], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_home16--", $txt_home[16], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_home17--", $txt_home[17], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_home18--", $txt_home[18], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_home19--", $txt_home[19], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_home20--", $txt_home[20], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_home21--", $txt_home[21], $temp[$i]);
	
	$temp[$i] = ereg_replace("!--session_benutzername--", $_SESSION['benutzername'], $temp[$i]);
	$temp[$i] = ereg_replace("!--last_login--", "$last_login", $temp[$i]);
	$temp[$i] = ereg_replace("!--td_width--", "$td_width", $temp[$i]);
	$temp[$i] = ereg_replace("!--remote_news--", "$temp_remote_news", $temp[$i]);	
	$temp[$i] = ereg_replace("!--count_attacks--", "$temp_count_attacks", $temp[$i]);
	$temp[$i] = ereg_replace("!--count_blocked_ips--", "$temp_count_blocked_ips", $temp[$i]);
	$temp[$i] = ereg_replace("!--count_loged_spam--", "$temp_count_loged_spam", $temp[$i]);
	$temp[$i] = ereg_replace("!--count_ips--", "$temp_count_ips", $temp[$i]);
	$temp[$i] = ereg_replace("!--count_spamwords--", "$temp_count_spamwords", $temp[$i]);

	$site .= $temp[$i];
}
?>