<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.de			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################

session_start();
define('CTXTRA', 1);
include_once( "../common.php" );
include_once( "../includes/others.php" );
include_once( $ct_log_ctxtras );
include_once( "../languages/".$ct_lang."/more.php");

echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>'.$txt_more[1].'</title>
<style type="text/css">
	body, table, td {
	 font-family: Verdana, Tahoma, Arial;
	 font-size:11px;
	 color: #000000
	}
	a {color: #8000FF; text-decoration: none;}
	a:hover {color: #AAAAAA;text-decoration: underline;}
	a:active {color: #8000FF;text-decoration: none;}
</style>
<body>
<center><h2>'.$txt_more[2].' '.$_SERVER['HTTP_HOST'].'</h2>
<table width="100%" style="border:1px solid #000000">
	<tr><td style="text-align:right"><b>'.$txt_more[3].'</b></td><td width="5px">&nbsp;</td><td style="text-align:left">'.$txt_more[4].' '.date("d.m.Y",$_SESSION['explode_time_'.$_GET['id']]).' - '.date("H:m:s",$_SESSION['explode_time_'.$_GET['id']]).'</td></tr>
	<tr><td style="text-align:right"><b>'.$txt_more[5].' '.date("H",$_SESSION['explode_time_'.$_GET['id']]).'</b></td><td width="5px">&nbsp;</td><td style="text-align:left">'.$_SESSION['explode_angriffe_'.$_GET['id']].'</td></tr>
	<tr><td style="text-align:right"><b>QUERY_STRING:</b></td><td width="5px">&nbsp;</td><td style="text-align:left">'.$_SESSION['explode_angriff_'.$_GET['id']].'</td></tr>
	<tr><td style="text-align:right"><b>REMOTE_ADDR:</b></td><td width="5px">&nbsp;</td><td style="text-align:left">'.$_SESSION['explode_remoteadr_'.$_GET['id']].'</td></tr>
	<tr><td style="text-align:right"><b>WHOIS_REMOTE_ADDR:</b></td><td width="5px">&nbsp;</td><td style="text-align:left"><a href="http://whois.domaintools.com/'.$_SESSION['explode_refferer_'.$_GET['id']].'">http://whois.domaintools.com/'.$_SESSION['explode_refferer_'.$_GET['id']].'</a></td></tr>
	<tr><td style="text-align:right"><b>HTTP_USER_AGENT:</b></td><td width="5px">&nbsp;</td><td style="text-align:left">'.$_SESSION['explode_useragent_'.$_GET['id']].'</td></tr>
	<tr><td style="text-align:right"><b>HTTP_REFERER:</b></td><td width="5px">&nbsp;</td><td style="text-align:left">'.$_SESSION['explode_refferer_'.$_GET['id']].'</td></tr>
	<tr><td style="text-align:right"><b>CONTENT_TYPE:</b></td><td width="5px">&nbsp;</td><td style="text-align:left">'.$_SESSION['explode_type_'.$_GET['id']].'</td></tr>
	<tr><td style="text-align:right"><b>HTTP_COOKIE:</b></td><td width="5px">&nbsp;</td><td style="text-align:left">'.$_SESSION['explode_cookie_'.$_GET['id']].'</td></tr>
	<tr><td style="text-align:right"><b>SERVER_PROTOCOL:</b></td><td width="5px">&nbsp;</td><td style="text-align:left">'.$_SESSION['explode_protocol_'.$_GET['id']].'</td></tr>
	<tr><td style="text-align:right"><b>REQUEST_METHOD:</b></td><td width="5px">&nbsp;</td><td style="text-align:left">'.$_SESSION['explode_method_'.$_GET['id']].'</td></tr>
	<tr><td style="text-align:right"><b>REQUEST_URI:</b></td><td width="5px">&nbsp;</td><td style="text-align:left">'.$_SESSION['explode_uri_'.$_GET['id']].'</td></tr>
	<tr><td style="text-align:right"><b>FULL_REQUEST_URI:</b></td><td width="5px">&nbsp;</td><td style="text-align:left">http://'.$_SERVER['HTTP_HOST'].''.$_SESSION['explode_uri_'.$_GET['id']].'</td></tr>
</table>
<br />
'.$txt_more[6].' v'.$version_number.'.'.$revision_number.' (<a href='.$ctxtra_url.'>www.ctxtra.de</a>) | <a href="javascript:self.print()" class="druck">'.$txt_more[7].'</a>
</center>
<body>
</html>
';
?>