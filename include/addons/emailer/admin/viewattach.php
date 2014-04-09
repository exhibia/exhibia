<?php
/*
 * viewattach.php
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
    !session_is_registered('Password'))
    echo_error ($ERROR_SessionErr, $ERROR_NoSession);

$Username = $_SESSION['Username'];
$Password = $_SESSION['Password'];
$Folder = $_SESSION['Folder'];

if ($Folder == 'sent')
    $Mailbox = "\{$IMAPHostname:$IMAPPort".$IMAPFlags."}$SENTFolder/$Username";
else $Mailbox = "\{$IMAPHostname:$IMAPPort".$IMAPFlags."}INBOX";

$imap = imap_open ($Mailbox, $Username, $Password);
$mnum = $_POST['msg'];
$headers = imap_headerinfo ($imap, $mnum);
$text = imap_body ($imap, $mnum);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $DEFCharset; ?>">
<link rel="stylesheet" type="text/css" href="styles/main.css"><title>Attachments</title></head>

<body class="message">
<a href="msgbody.php"><?php echo $MISC_BackToMsg; ?></a><hr size="1">
<?php echo_part_data($imap, $mnum); ?>

<hr size="1"><a href="msgbody.php"><?php echo $MISC_BackToMsg; ?></a>
</body></html>

<?php imap_close ($imap); ?>
