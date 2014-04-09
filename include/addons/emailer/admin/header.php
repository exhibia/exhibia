<?php

ini_set('display_errors', 1);
include("../../../../config/config.inc.php");

db_connect($DBHOST, $USERNAME, $PASSWORD);
db_select_db($DATABASENAME);
/*
 * header.php
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
require_once (realpath(dirname(__FILE__))  . "/lang/" . $_SESSION['Language'] . ".php");

// Make sure that the required variables has been set
if (!session_is_registered ('MsgNum') or
    !session_is_registered ('Folder')) exit();

$mnum = $_SESSION['MsgNum'];
$Folder = $_SESSION['Folder'];

if ($Folder == 'sent')
    $address = trim($_SESSION['To']);
else $address = trim($_SESSION['From']);

$ha_pos = strpos($address, '<'); // find <
$hz_pos = strpos($address, '>'); // find >
$space_pos = strpos($address, ' '); // find ' '

if ($address && ($space_pos != false)) {
    if (($ha_pos != false) && ($hz_pos != false)) {
	$email = trim(substr($address, $ha_pos+1, $hz_pos-$ha_pos-1));
	$name = preg_replace('[\\\"]', '', substr($address, 0, $ha_pos-1));
	$email = urlencode(htmlspecialchars($email));
	$name = urlencode(htmlspecialchars($name));
    }
} else {
    $email=urlencode(htmlspecialchars(trim($address)));
    $name='';
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $DEFCharset; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $SITE_URL;?>include/addons/emailer/admin/styles/main.css">
<title>Message</title>
</head>

<body>
<table width="100%" cellspacing="2" cellpadding="0" border="0" class="header">

<?php if ($Folder == 'sent' && session_is_registered ('To')) { ?>
<tr><td nowrap="nowrap"><strong>&nbsp;<?php echo $HEAD_To; ?>:&nbsp;</strong></td>
<td class="value" width="100%" valign="middle" nowrap="nowrap"><a target="List" href="<?php echo $SITE_URL;?>include/addons/emailer/admin/addressbook.php?name=<?php echo $name."&email=".$email."&action=edit"; ?>" title="<?php echo $BUTTON_ContactAdd;?>"><?php echohtml ($address);?></a></td>
</tr><?php } ?>

<?php if ($Folder == 'inbox' && session_is_registered ('From')) { ?>
<tr><td nowrap="nowrap"><strong>&nbsp;<?php echo $HEAD_From;?>:&nbsp;</strong></td>
<td class="value" width="100%" valign="middle" nowrap="nowrap"><a target="List" href="<?php echo $SITE_URL;?>include/addons/emailer/admin/addressbook.php?name=<?php echo $name."&email=".$email."&action=edit"; ?>" title="<?php echo $BUTTON_ContactAdd;?>"><?php echohtml ($address);?></a></td>
</tr><?php } ?>

<?php if (session_is_registered ('Subject')) { ?>
<tr><td nowrap="nowrap"><strong>&nbsp;<?php echo $HEAD_Subject;?>:&nbsp;</strong></td>
<td class="value" width="100%" valign="middle" nowrap="nowrap"><?php echo $_SESSION['Subject'];?></td>
</tr><?php } ?>

<?php if (session_is_registered ('Time')) { ?>
<tr><td nowrap="nowrap"><strong>&nbsp;<?php if ($Folder == 'sent') echo $HEAD_Sent; else echo $HEAD_Recieved;?>:&nbsp;</strong></td>
<td class="value" width="100%" valign="middle" nowrap="nowrap"><?php echo $_SESSION['Time'];?></td>
</tr><?php } ?>

<tr><td colspan="2">
    <form action="<?php echo $SITE_URL;?>include/addons/emailer/admin/send.php" method="post" target="Message">
    <table border="0" cellspacing="0" cellpadding="0">
    <tr>
	<td align="left" valign="middle">
	    <input type="hidden" name="action" value="reply">
	    <input type="hidden" name="to" value="<?php echohtml ($_SESSION['From']);?>">
	    <input type="submit" class="submit" value="<?php echo $BUTTON_Reply;?>" title="<?php echo $STATBAR_Reply;?>">
	</td></form>
	<form action="<?php echo $SITE_URL;?>include/addons/emailer/admin/send.php" method="post" target="Message">
	<td align="left" valign="middle">
	    <input type="hidden" name="action" value="forward">
	    <input type="submit" class="submit" value="<?php echo $BUTTON_Forward;?>" title="<?php echo $STATBAR_Forward;?>">
	</td></form>
	<form action="<?php echo $SITE_URL;?>include/addons/emailer/admin/redirect.php" method="post">
	<td align="left" valign="middle">
	    <input type="submit" class="submit" value="<?php echo $BUTTON_Redirect;?>" title="<?php echo $STATBAR_Redirect;?>">
	</td></form>
	<form action="<?php echo $SITE_URL;?>include/addons/emailer/admin/sourceview.php" method="post" target="Msgbody">
	<td align="left" valign="middle">
	    <input type="submit" class="submit" value="<?php echo $BUTTON_Headers;?>" title="<?php echo $STATBAR_Headers;?>">
	</td></form>
	<?php if ($_SESSION['IsAttach']) {?>
	<form action="<?php echo $SITE_URL;?>include/addons/emailer/admin/viewattach.php" method="post" target="Msgbody"><td align="left" valign="middle">
	    <input type="hidden" name="msg" value="<?php echo $mnum;?>">
	    <input type="submit" class="submit" value="<?php echo $BUTTON_Attachments;?>" title="<?php echo $STATBAR_Attachments;?>">
	</td>
	<?php } ?>
    </tr>
    </table>
    </form>
</td></tr>
</table>

</body></html>
