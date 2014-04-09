<?php


ini_set('display_errors', 1);
include("../../../../config/config.inc.php");

db_connect($DBHOST, $USERNAME, $PASSWORD);
db_select_db($DATABASENAME);
/*
 * delete.php
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
     $Mailbox = "\{". $_SERVER['SERVER_NAME'] . ":$mailOptions}$SENTFolder/$Username";
else $Mailbox = "\{". $_SERVER['SERVER_NAME'] . ":$mailOptions}INBOX";

$imap = imap_open($Mailbox, $Username, $Password);

$messages = array_keys($_POST);
foreach ($messages as $msg) {
    if ($_POST[$msg] == "msgnum")
	imap_delete($imap, intval($msg), 0);
}

imap_expunge($imap);
imap_close($imap, CL_EXPUNGE);

header("Location:list.php?$Folder\n\n"); ?>
