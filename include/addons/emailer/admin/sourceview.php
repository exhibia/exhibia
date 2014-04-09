<?php
/*
 * sourceview.php
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

require_once ("config.php");
require_once ("functions.php");

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
$MsgNum = $_SESSION['MsgNum'];
$Folder = $_SESSION['Folder'];

if ($Folder == 'sent')
    $Mailbox = "\{$IMAPHostname:$IMAPPort".$IMAPFlags."}$SENTFolder/$Username";
else $Mailbox = "\{$IMAPHostname:$IMAPPort".$IMAPFlags."}INBOX";

$imap = imap_open ($Mailbox, $Username, $Password);
$headers = imap_headerinfo ($imap, $MsgNum);
$title = $headers->subject . ".msg";

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $DEFCharset; ?>">
<link rel="stylesheet" type="text/css" href="styles/main.css">
<title><?php echo $title; ?></title></head>

<body class="message">
<a href="msgbody.php?msg=<?php echo $MsgNum; ?>"><?php echo $MISC_BackToMsg; ?></a><hr size="1">
<?php print (nl2br (htmlspecialchars (trim (imap_fetchheader ($imap, $MsgNum, 0))))); ?>

<hr size="1"><a href="msgbody.php?msg=<?php echo $MsgNum; ?>"><?php echo $MISC_BackToMsg; ?></a>
</body></html>

<?php imap_close ($imap); ?>
