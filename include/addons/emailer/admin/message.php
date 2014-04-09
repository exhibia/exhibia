<?php
ini_set('display_errors', 1);
include("../../../../config/config.inc.php");

/*
 * message.php
 *
 * Description:	 W3MAIL - A PHP IMAP mail reader.
 * Developed by: Alexander Djourik <sasha@iszf.irk.ru>
 *		 Anton Gorbunov <anton@iszf.irk.ru>
 *		 Pavel Zhilin <pzh@iszf.irk.ru>
 *
 * Copyright (c) 2002,2003,2004,2005 Alexander Djourik. All rights reserved.
 *
 * Initially based on code from 6XMailer - A PHP POP3 mail reader,
 * Copyright 2001 6XGate Systems, Inc. All rights reserved.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License.
 *
 * Please see the file LICENSE in this directory for full copyright
 * information.
 *
 */

include (realpath(dirname(__FILE__))  . "/config.php");
include ( realpath(dirname(__FILE__))  . "/functions.php");
include (realpath(dirname(__FILE__))  . "/drivers/" . $SQLDriver . ".php");

// Start the session
session_start();

// Determine the language strings to use
if (!isset($_SESSION['Language'])) $_SESSION['Language'] = $Language;
require_once ("lang/" . $_SESSION['Language'] . ".php");
$user_info = explode("@", $adminemailadd);



if ($Folder == 'sent') {
    $Mailbox = "\{". $_SERVER['SERVER_NAME'] . ":$mailOptions}$SENTFolder/$Username";
    $Title = $ICON_Sent;
} else {
    $Mailbox = "\{". $_SERVER['SERVER_NAME'] . ":$mailOptions}INBOX";
    $Title = $ICON_Inbox;
}



if ($Folder == 'sent') {

$imap = imap_open("{". $_SERVER['SERVER_NAME'] . ":$mailOptions}$SENTFolder/$Username", $Username, $Password);
}else{

$imap = imap_open("{". $_SERVER['SERVER_NAME'] . ":$mailOptions}INBOX", $Username, $Password);

}
$msgcount = imap_num_msg ($imap);

if (!$msgcount) {
  //  header ("Location:help.php\n\n");
    exit(0);
}


$HeaderSize = 0;

$mnum = $_GET['msg'];
if ($mnum > $msgcount) $mnum = $msgcount;
$_SESSION['MsgNum'] = $mnum;

$hdr = imap_fetchheader($imap, $mnum, FT_INTERNAL);
$headers = imap_rfc822_parse_headers($hdr);



list ($mtext, $plain_charset) = get_part ($imap, $mnum, "text/plain");
if (!$plain_charset) $plain_charset = $charset;
$mtext = text_convert($mtext, $plain_charset);

list ($htext, $html_charset) = get_part ($imap, $mnum, "text/html");
if (!$html_charset) $html_charset = ($charset)? $charset : $plain_charset;
$htext = text_convert($htext, $html_charset);

if (!$charset) $charset = ($plain_charset)? $plain_charset :  $html_charset;

if (num_attach($imap, $mnum))
    $_SESSION['IsAttach'] = true;
else $_SESSION['IsAttach'] = false;


    $_SESSION['From'] = header_decode($headers->fromaddress, $charset);

	if(empty($_SESSION['From'])){
	$_SESSION['From'] = $headers->toaddress;

	}
$_SESSION['To'] = $headers->toaddress;

if ($headers->fromaddress || $headers->toaddress)
    $HeaderSize += $LineSize;
if ($headers->subject) {
    $_SESSION['Subject'] = header_decode($headers->subject, $charset);
    $HeaderSize += $LineSize;
} else session_unregister('Subject');

if ($headers->date) {
    $_SESSION['Time'] = $headers->date;
    $HeaderSize += $LineSize;
} else session_unregister('Time');

if ($mtext && preg_match ("'<html[^>]*>'is", $mtext)) {
    if (!$htext) $htext = $mtext;
    $mtext = html2text ($mtext);
}
if ($htext && !preg_match ("'<html[^>]*>'is", $htext)) {
    if (!$mtext) $mtext = $htext;
    $htext = text2html ($htext);
}

if ($mtext) {
    if (preg_match ("'<(body|a\s+href)[^>]*>'is", $mtext)) {
	if (!$htext) $htext = "<html><head><title>Message Text</title>".
	    "<link href=\"$SITE_URL" . "include/addons/emailer/admin/styles/main.css\" rel=\"stylesheet\" type=\"text/css\"></head>".
	    "<body class=\"message\">" . $mtext. "</body></html>";
	$mtext = $mtext;
    }
   $message = $mtext;
} else if ($htext) {
    $message = $htext;
} else session_unregister('MessageText');

if ($htext) {
    $message = $htext;
} else if ($mtext) {
    $message = "<html><head><title>Message Text</title>".
	"<link href=\"$SITE_URL" . "include/addons/emailer/admin/main.css\" rel=\"stylesheet\" type=\"text/css\"></head>".
	"<body class=\"message\"><pre>" . $mtext .
	"</pre></body></html>";
} else {
    $message = "<html><head><title>Empty Message</title></head><body></body></html>";
}
$_SESSION['MessageText'] = str_replace("<br/>", "", str_replace("<br />", "\n", str_replace( "%lt;br /&gt;", "\n", $message)));
imap_close($imap);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $DEFCharset; ?>">
<title><?php echo $TITLE_System . " : " . $Title;?></title>

<script language="JavaScript" type="text/javascript">
<!--//

window.top.document.title="<?php echo $TITLE_System . " : " . $Title;?>";

//-->
</script>
</head>
<?php
//print_r($headers);
?>
<frameset rows="<?php echo ($HeaderSize + $ActionsSize);?>,*" framespacing="0" frameborder="0">
    <frame src="<?php echo $SITE_URL;?>include/addons/emailer/admin/header.php" name="Headers" id="headers" frameborder="0" scrolling="No" noresize marginwidth="0" marginheight="0">
    <frame src="<?php echo $SITE_URL;?>include/addons/emailer/admin/msgbody.php" name="Msgbody" id="msgbody" frameborder="0" scrolling="Yes" noresize marginwidth="0" marginheight="0">
</frameset>
</html>
