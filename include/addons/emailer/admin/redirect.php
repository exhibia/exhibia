<?php 
/*
 * redirect.php
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
 
ini_set('display_errors', 1);
include("../../../../config/config.inc.php");
include (realpath(dirname(__FILE__))  . "/config.php");
include ( realpath(dirname(__FILE__))  . "/functions.php");

// Start the session
session_start();

// Determine the language strings to use
if (!isset($_SESSION['Language'])) $_SESSION['Language'] = $Language;
require_once ("lang/" . $_SESSION['Language'] . ".php");

// Make sure that the required variables has been set
if (!session_is_registered('Username') or
    !session_is_registered('Password') or
    !session_is_registered('MsgNum'))
    echo_error ($ERROR_SessionErr, $ERROR_NoSession);

$Username = $_SESSION['Username'];
$Password = $_SESSION['Password'];
$DisName  = $_SESSION['DisName'];
$EMail    = $_SESSION['EMail'];
$MsgNum   = $_SESSION['MsgNum'];
$Subject  = $_SESSION['Subject'];
$Folder   = $_SESSION['Folder'];
$Time     = $_SESSION['Time'];

if ($Folder == 'sent')
     $address = "$DisName <$EMail>";
else $address = trim($_SESSION['From']);

if ($_POST['action'] == "send") {
    set_time_limit (0);

    if ($Folder == 'sent')
	 $Mailbox = "\{". $_SERVER['SERVER_NAME'] . ":$mailOptions}$SENTFolder/$Username";
    else $Mailbox = "\{". $_SERVER['SERVER_NAME'] . ":$mailOptions}INBOX";

    $imap = imap_open ($Mailbox, $Username, $Password);
    $header = imap_fetchheader ($imap, $MsgNum, 0);

    if (!preg_match ("'Return-Path:\s+<([^>]*)>'is", $from)) $from = $EMail;
    $to = stripslashes($_POST['to']);
    $Subject = header_encode($Subject, $DEFCharset);

    $header = preg_replace ("'(To|CC|Received|Message-Id|Date):[^\n]+\n'i", '', $header);
    $body = imap_body ($imap, $MsgNum);

    if (mail($to, $Subject, $body, trim($header), "-f$from"))
	 echo_info ($MISC_Sent);
    else echo_info ($ERROR_Send);
}

$ha_pos = strpos($address, '<'); // find <
$hz_pos = strpos($address, '>'); // find >
$space_pos = strpos($address, ' '); // find ' '
if ($address && ($space_pos != false)) {
if (($ha_pos != false) && ($hz_pos != false)) {
    $email = trim(substr($address, $ha_pos+1, $hz_pos-$ha_pos-1));
    $name = preg_replace('[\\\"]', '', substr($address, 0, $ha_pos-1));
    $email = urlencode(htmlspecialchars($email));
    $name = urlencode(htmlspecialchars($name));
}} else {
    $email = urlencode(htmlspecialchars(trim($address)));
    $name = '';
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $DEFCharset; ?>">
<link rel="stylesheet" type="text/css" href="styles/main.css">
<title>Message</title>

<script language="JavaScript" type="text/javascript">
<!--//

window.top.document.title="<?php echo $TITLE_System . " : " . $TITLE_Compose;?>";

function checkEmail (emailStr) {
    var eMail = null;
    if (emailStr.length == 0) {
	alert("<?php echo $MISC_NoEmail; ?>");
	return false;
    }
    var emailPat = /^\s*([^\s]+\s+)*([<@>\w&_\.+-]+)\s*$/;
    var matchParts = emailStr.match(emailPat);
    if (matchParts == null) {
	alert("<?php echo $ERROR_EmailChars; ?>\n"+emailStr);
	return false;
    } else eMail = matchParts[2];
    emailPat=/^(.+)@(.+)$/;
    if (eMail.match(emailPat)) {
	emailPat = /^\<(.+)\>$/;
	matchParts = eMail.match(emailPat);
	if (matchParts) eMail = matchParts[1];
	var emailFilter = /^(\w[\w&_\.-]+)@(\w[\w_-]+\.)*\w{2,6}$/;
	if (emailFilter.test(eMail) != true) {
	    alert("<?php echo $ERROR_EmailStruct; ?>\n"+eMail);
	    return false;
	}
    }
    return true;
}

function checkEmailStr (emailStr) {
    var emailArr = emailStr.split(",");
    for (var i = 0; i < emailArr.length; i++)
	if (!checkEmail (emailArr[i])) return false;
    return true;
}

//-->

</script>
</head>

<body class="panel">
<form action="redirect.php" name="sendform" id="sendform" method="post" target="Message" onSubmit="return checkEmailStr(this.to.value)">
<input type="hidden" name="action" value="send">
<table class="header" width="100%" cellspacing="2" cellpadding="0" border="0">

<?php if ($address) { ?><tr><td class="name"><strong>&nbsp;<?php echo $HEAD_From;?>:&nbsp;</strong></td>
<td colspan="2" class="value" width="100%" valign="middle"><a target="List" href="addressbook.php?name=<?php echo $name."&email=".$email."&action=edit";?>" title="<?php echo $BUTTON_ContactAdd;?>"><?php echohtml ($address);?></a></td></tr><?php } ?>

<?php if ($Subject) { ?><tr><td class="name"><strong>&nbsp;<?php echo $HEAD_Subject;?>:&nbsp;</strong></td>
<td colspan="2" class="value" width="100%" valign="middle"><?php echo $Subject; ?></td></tr><?php } ?>

<?php if ($Time) { ?><tr><td class="name"><strong>&nbsp;<?php if ($Folder == 'sent') echo $HEAD_Sent; else echo $HEAD_Recieved;?>:&nbsp;</strong></td>
<td colspan="2" class="value" width="100%" valign="middle"><?php echo $Time; ?></td></tr><?php } ?>

<tr><td class="name"><strong>&nbsp;<?php echo $HEAD_To;?>:&nbsp;</strong><a href="addressbook.php" target="List"><img src="images/addressbook.png" width="16" height="16" border="0" vspace="0" align="top"></a></td>
<td class="value" width="100%" valign="middle"><input class="text" type="text" name="to" size="60"></td>
<td><input class="submit" type="submit" value="<?php echo $BUTTON_Send;?>" title="<?php echo $STATBAR_Send;?>"></td></tr>

</table></form>
</body></html>
