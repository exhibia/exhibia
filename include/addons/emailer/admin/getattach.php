<?php
/*
 * getattach.php
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

// Start the session
session_start();

// Make sure that the required variables has been set
if (!session_is_registered('Username') or
    !session_is_registered('Password'))
    echo_error ($ERROR_SessionErr, $ERROR_NoSession);

$Username = $_SESSION['Username'];
$Password = $_SESSION['Password'];
$Folder = $_SESSION['Folder'];

if ($Folder == 'sent')
    $Mailbox = "\{". $_SERVER['SERVER_NAME'] . ":143/imap/novalidate-cert}".$IMAPFlags."}$SENTFolder/$Username";
else $Mailbox = "\{". $_SERVER['SERVER_NAME'] . ":143/imap/novalidate-cert}".$IMAPFlags."}INBOX";

$imap = imap_open ($Mailbox, $Username, $Password);
$filename = urldecode ($_GET['file']);
$mime = $_GET['mime'];

$attach = imap_fetchbody($imap, $_GET['msg'], $_GET['part']); 

if ($_GET['enc'] == ENCBASE64) {
    $file = imap_base64($attach);
} else if ($_GET['enc'] == ENCQUOTEDPRINTABLE) {
    $file = imap_qprint($attach);
} else if ($_GET['enc'] == ENCOTHER) {
    $file = uudecode($attach);
} else {
    $file = $attach;
}

$size = strlen($file);

header("Content-Type: $mime; name=\"$filename\"");
header("Content-Length: $size");
header("Cache-control: private");
header("Content-Disposition: inline; filename=\"$filename\"");
header("Content-Transfer-Encoding: binary");

echo $file;

imap_close($imap); ?>
