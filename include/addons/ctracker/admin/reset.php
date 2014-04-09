<?php

define('CTXTRA', 1);
include_once( "../common.php" );
include_once( "../includes/others.php" );
include_once($ct_log_ctxtras);
include_once( "../includes/functions.inc.php" );
include_once( "../languages/".$ct_lang."/reset.php");
include_once( "../languages/".$ct_lang."/footer.php");

// Deine IP
####################################
#$myip = "0.0.0.0";
// OR
$myip = $_SERVER['REMOTE_ADDR'];
####################################


if(url_ok_or_not($ctxtra_url)) {
	$usonline = '<script language="text/javascript" src="'.$ctxtra_url.'remote/remote/usonline.php"></script>';
} else {
	$usonline = '';
}

if (isset($_POST['reset'])) {
	acp_resetip($myip);
	$temp_reset = '
	<tr>
		<td style="line-height:25px; width:100%" colspan="2" align="center">
		'.$txt_reset[2].'<br/>'.$txt_reset[3].'<br /><a href="'.$ct_borddir.'/index.php">'.$txt_reset[6].'</a>
		</td>
	</tr>';
} else {
	$temp_reset = '
	<tr>
		<td style="text-align:center; width:100%" colspan="2">
			<br />
			'.$txt_reset[4].'<br />
			<br />
			'.$txt_reset[5].'&nbsp;<span style="font-weight:bold">'.$myip.'</span>
		</td>
	</tr>
	<tr>
		<td width="100%" colspan="2">
			<hr noshade="noshade" style="color:#999999;" size="1px" />
		</td>
	</tr>
	<tr>
		<td colspan="2"  style="text-align:center;">
			<input type="submit" name="reset" value="&nbsp;Reset&nbsp;" />
		</td>
	</tr>';

}


$temp = file("../templates/reset.html");

for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--txt_reset1--", $txt_reset[1], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_reset2--", $txt_reset[2], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_reset3--", $txt_reset[3], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_reset4--", $txt_reset[4], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_reset5--", $txt_reset[5], $temp[$i]);

	$temp[$i] = ereg_replace("!--versionsinfo_reset--", $txt_footer[1], $temp[$i]);
	$temp[$i] = ereg_replace("!--ctxtra_url--", "$ctxtra_url", $temp[$i]);
	$temp[$i] = ereg_replace("!--version_number--", "$version_number", $temp[$i]);
	$temp[$i] = ereg_replace("!--revision_number--", "$revision_number", $temp[$i]);
	$temp[$i] = ereg_replace("!--server_php_self--", $_server['php_self'], $temp[$i]);
	$temp[$i] = ereg_replace("!--reset--", "$temp_reset", $temp[$i]);
	$temp[$i] = ereg_replace("!--usonline--", "$usonline", $temp[$i]);
	
	$site .= $temp[$i];
}

echo $site;

?>