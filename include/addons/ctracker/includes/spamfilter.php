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

// Spam löschen
spam_loeschen();


if ($ct_bbc_spam == "yes") {$select_bbc_spam = '<a href="index.php?settings=true" style="color:#008000;"><b>'.$txt_spamfilter[1].'</b></a>';
} elseif ($ct_bbc_spam == "no") {$select_bbc_spam = '<a href="index.php?settings=true" style="color:#ff0000;"><b>'.$txt_spamfilter[2].'</b></a>';}


if ($ct_auto_spamlist == "yes") {$select_auto_spamlist = '<span style="color:#008000;">'.$txt_spamfilter[3].'</span>';
} elseif ($ct_auto_spamlist == "no") {$select_auto_spamlist = '<span style="color:#bb0000;">'.$txt_spamfilter[4].'</span>';}


if (file_exists($ct_spamlist)) {$loggedspam = @fopen($ct_spamlist ,"r");}

$temp_count_spamwords = count_spamwords();

$temp_loggedspam[0] = '';
if (isset($loggedspam)) {
	while (!feof($loggedspam)) {
		$temp_loggedspam[0] .= fgets($loggedspam,4096);
	}
} else {
	$temp_loggedspam = '';
}

$session_online_spamwords = $_SESSION['online_spamwords'];

include('includes/others.php');

if (url_ok_or_not($online_spamlist)) {
	$online_spamlist_str = socketorfile_fgets($online_spamlist);
	$textarea_font_color="";
	
    preg_match_all('/<spamwords>(.*?)<\/spamwords>/si', $online_spamlist_str, $spamwords);
    $chop = "";
	foreach ($spamwords[0] as $messung){
        preg_match('/<spamword>(.*?)<\/spamword>/si', $messung, $ip);
        $chop .= $ip[1]."\n";
    }
} else {
	$chop		 			= $txt_spamfilter[15];
	$textarea_font_color 	= 'style="color:#bb0000; font-weight:bold; font-family:verdana,arial;"';
}


$temp_chop = chop($chop);

if ($online_spamlist) {
	$temp_online_spamlist = '<br />  <input type="submit" name="submit_spamlist_add" value="'.$txt_spamfilter[16].'" /> ';
} else {
	$temp_online_spamlist = '';
}

$temp_count_loged_spam = count_loged_spam();

if (isset($_REQUEST['more']) &&  $_REQUEST['more'] == "true") {$div_overflow = "visible"; $div_height="";} else {$div_overflow = "auto"; $div_height="height:200px;";}


$zeilen = @array_reverse(file($ct_log_spam));
$temp_count_spam_list[0] = '';
$i=0;
while ($i < count($zeilen)) {
	$ct_log		= trim($zeilen[$i]);
	$ct_log		= str_replace( "\n", "<br />", $ct_log );
	$explode	= explode("||ctxtra_spam_dummy||", $ct_log); 
	
	if ((isset($_REQUEST['more']) &&  $_REQUEST['more'] == "true") && (isset($_REQUEST['id']) &&  $i == $_REQUEST['id'])) {
		$link_more = '<a href="index.php?spamfilter=true">'.$txt_spamfilter[18].'</a>';
	} else {
		$link_more = '<a href="index.php?spamfilter=true&more=true&id='.$i.'#'.$i.'">'.$txt_spamfilter[19].'</a>';
	}

	$spam_content = stripslashes($explode[10]);
	
	if ($ct_bbc_spam == "yes") {
		$spam_content = bbc_html_encodet($spam_content);
	}							

	$temp_count_spam_list[0] .= '
    <tr>          
      	<td style="text-align:middel; vertical-align:middle;">
			<span style="font-size:10px; color:#000000; font-family:verdana,arial">
				<a name="'.$i.'"></a> <input type="checkbox" name="zeile['.$i.']"  value="'.$i.'" /> '.date("d.m.Y", $explode[1]).' um '.date("H:i:s", $explode[1]).' Spamword: <b>'.$explode[0].'</b> [ '.$link_more.' ]';
				if ((isset($_REQUEST['more']) &&  $_REQUEST['more'] == "true") && (isset($_REQUEST['id']) &&  $i == $_REQUEST['id'])) {
					$temp_count_spam_list[0] .= '
					<br /><br />
					<table cellspacing="0" cellpadding="5px" style="width:100%; height:20px; background-color:#FFFFFF; border-top:2px solid #008000; border-left:2px solid #008000; border-bottom:0px solid #008000; border-right:2px solid #008000;">
						<tr>
							<td style="text-align:left;">
								<span style="color:#ff0000;"><b>'.$txt_spamfilter[25].'</b> '.$txt_spamfilter[26].'
							</td>
						</tr>
					</table>
					<table cellspacing="0" cellpadding="5px" style="width:100%; height:50px; background-color:#FFFFFF; border:2px solid #008000;">
						<tr>
							<td style="text-align:left;">
							    <div style="width: 100%; overflow:auto; scrollbar-base-color:#E7E7E7; text-align:left;">
							    '.$spam_content.'
								<!-- <table cellspacing="0" cellpadding="5px" width="100%"><tr><td>'.$spam_content.'</td></tr></table> //-->
								</div>
							</td>
						</tr>
					</table>
					<br />
					';
				}
				$temp_count_spam_list[0] .= '
				<hr noshade="noshade" style="color:#999999" size="1px">
        	</span>
	  	</td>
    </tr>';
	$i++;								
}

			
if (count($zeilen) != 0){
	$temp_count_zeilen_button = '
	<br />
	<input type="submit" name="submit_del_spamword" value="'.$txt_spamfilter[21].'" /> <input type="submit" name="submit_del_all_spamwords" value="'.$txt_spamfilter[22].'" />';
} else {
	$temp_count_zeilen_button = '';
}

if (count($zeilen) == 0) {
	$temp_download_logfile = '[ <a href="index.php?spamfilter=true&download='.basename($ct_log_spam).'">'.$txt_spamfilter[27].'</a> ]';
} else {
	$temp_download_logfile = '';
}

$temp = file("templates/spamfilter.html");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--txt_spamfilter5--", $txt_spamfilter[5], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_spamfilter6--", $txt_spamfilter[6], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_spamfilter7--", $txt_spamfilter[7], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_spamfilter8--", $txt_spamfilter[8], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_spamfilter9--", $txt_spamfilter[9], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_spamfilter10--", $txt_spamfilter[10], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_spamfilter11--", $txt_spamfilter[11], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_spamfilter12--", $txt_spamfilter[12], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_spamfilter13--", $txt_spamfilter[13], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_spamfilter14--", $txt_spamfilter[14], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_spamfilter17--", $txt_spamfilter[17], $temp[$i]);
	
	$temp[$i] = ereg_replace("!--select_auto_spamlist--", "$select_auto_spamlist", $temp[$i]);
	$temp[$i] = ereg_replace("!--count_spamwords--", "$temp_count_spamwords", $temp[$i]);
	$temp[$i] = ereg_replace("!--loggedspam--", $temp_loggedspam[0], $temp[$i]);
	$temp[$i] = ereg_replace("!--session_online_spamwords--", "$session_online_spamwords", $temp[$i]);
	$temp[$i] = ereg_replace("!--textarea_font_color--", "$textarea_font_color", $temp[$i]);
	$temp[$i] = ereg_replace("!--chop--", "$temp_chop", $temp[$i]);	
	$temp[$i] = ereg_replace("!--online_spamlist--", "$temp_online_spamlist", $temp[$i]);	
	$temp[$i] = ereg_replace("!--info_speichern--", "$info_speichern", $temp[$i]);
	$temp[$i] = ereg_replace("!--count_loged_spam--", "$temp_count_loged_spam", $temp[$i]);
	$temp[$i] = ereg_replace("!--select_bbc_spam--", "$select_bbc_spam", $temp[$i]);
	$temp[$i] = ereg_replace("!--count_zeilen_button--", "$temp_count_zeilen_button", $temp[$i]);
	$temp[$i] = ereg_replace("!--div_overflow--", "$div_overflow", $temp[$i]);
	$temp[$i] = ereg_replace("!--count_spam_list--", $temp_count_spam_list[0], $temp[$i]);
	$temp[$i] = ereg_replace("!--download_logfile--", $temp_download_logfile, $temp[$i]);

	$site .= $temp[$i];
}

?>