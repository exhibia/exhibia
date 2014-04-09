<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.de			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################

if ($ct_auto_iplist == "yes") {$select_auto_iplist = '<span style="color:#008000;">'.$txt_ipfilter[1].'</span>';
} elseif ($ct_auto_iplist == "no") {$select_auto_iplist = '<span style="color:#bb0000;">'.$txt_ipfilter[2].'</span>';}

$count_ips = count_ips();

if (file_exists($ct_log_ips)) {
	$loggedips = @fopen($ct_log_ips ,"r");
}

if (isset($loggedips)) {
	$temp_loggedips[0] = '';
	while (!feof($loggedips)) {
		$temp_loggedips[0] .= fgets($loggedips,4096);
	}
} else {
	$temp_loggedips[0] = '';
}

$session_online_ips = $_SESSION['online_ips'];

include('includes/others.php');
if (url_ok_or_not($online_iplist)) {
	$online_iplist_str = socketorfile_fgets($online_iplist);
	$textarea_font_color="";

    preg_match_all('/<word>(.*?)<\/word>/si', $online_iplist_str, $ipwords);
    $chop = "";
	foreach ($ipwords[0] as $messung){
        preg_match('/<ip>(.*?)<\/ip>/si', $messung, $ip);
        $chop .= $ip[1]."\n";
    }
} else {
	$chop					= $txt_ipfilter[10];
	$textarea_font_color 	= 'style="color:#bb0000; font-size:11px; font-weight:bold; font-family:verdana,arial; "';
}				


$temp_chop = chop($chop);

if (url_ok_or_not($online_iplist)) {
	$temp_online_iplist = '<br />  <input type="submit" name="submit_iplist_add" value="'.$txt_ipfilter[11].'" />  ';
} else {
	$temp_online_iplist = '';
}

$temp = file("templates/ipfilter.html");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--txt_ipfilter3--", $txt_ipfilter[3], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_ipfilter4--", $txt_ipfilter[4], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_ipfilter5--", $txt_ipfilter[5], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_ipfilter6--", $txt_ipfilter[6], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_ipfilter7--", $txt_ipfilter[7], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_ipfilter8--", $txt_ipfilter[8], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_ipfilter9--", $txt_ipfilter[9], $temp[$i]);
	
	$temp[$i] = ereg_replace("!--select_auto_iplist--", "$select_auto_iplist", $temp[$i]);
	$temp[$i] = ereg_replace("!--count_ips--", "$count_ips", $temp[$i]);
	$temp[$i] = ereg_replace("!--loggedips--", $temp_loggedips[0], $temp[$i]);
	$temp[$i] = ereg_replace("!--info_speichern--", "$info_speichern", $temp[$i]);
	$temp[$i] = ereg_replace("!--session_online_ips--", "$session_online_ips", $temp[$i]);
	$temp[$i] = ereg_replace("!--textarea_font_color--", "$textarea_font_color", $temp[$i]);
	$temp[$i] = ereg_replace("!--chop--", "$temp_chop", $temp[$i]);	
	$temp[$i] = ereg_replace("!--online_iplist--", "$temp_online_iplist", $temp[$i]);	
	
	$site .= $temp[$i];
}

?>