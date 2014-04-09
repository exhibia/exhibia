<?php 
/*
 * settings.php
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
require_once ("drivers/" . $SQLDriver . ".php");

// Start the session
session_start();

// Determine the language strings to use
if (!isset($_SESSION['Language'])) $_SESSION['Language'] = $Language;
require_once ("lang/" . $_SESSION['Language'] . ".php");

// Make sure that the required variables has been set
if (!session_is_registered ('DisName') or
    !session_is_registered ('UID'))
    echo_error ($ERROR_SessionErr, $ERROR_NoSession);

$Uid = $_SESSION['UID'];

if ($_POST ['action']) {
    $_SESSION['DisName'] = $_POST ['name'];
    $_SESSION['Signature'] = $_POST ['sign'];

    // Connect to the SQL server
    $SQLHandle = db_connect($SQLHostname, $SQLDatabase, $SQLUsername, $SQLPassword);
    if (!$SQLHandle) echo_error ($ERROR_SQLErr, $ERROR_SQLConnect);

    $results = db_query ($SQLHandle, "UPDATE userdata SET DisplayName='" . $_POST ['name'] . "', Signature='" . addcslashes (stripcslashes ($_POST ['sign']), "\0..\37!@\177..\377") . "' WHERE (UID='" . $Uid . "')");
    if (!$results) echo_error ($ERROR_SQLErr, $ERROR_SQLUpdate);

    echo_info ($MISC_Settings);
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $DEFCharset; ?>">
<link rel="stylesheet" type="text/css" href="styles/main.css">
<title><?php echo $TITLE_System . " : " . $TITLE_Settings; ?></title>

<script language="JavaScript" type="text/javascript">
<!--//

window.top.document.title="<?php echo $TITLE_System . " : " . $TITLE_Settings;?>";

//-->
</script>
</head>

<body class="panel">
<form action="settings.php" method="post">
<table class="header" width="100%" border="0" cellspacing="2" cellpadding="0">
    <tr><td nowrap="nowrap"><strong><?php echo $HEAD_DisName; ?>:&nbsp;&nbsp;</strong></td>
    <td class="value" width="100%">
    <input type="hidden" name="action" value="save">
    <input type="text" class="text" name="name" value="<?php echo $_SESSION['DisName']; ?>" maxlength="50">
    </td></tr>
    <tr><td colspan="2"><strong><?php echo $HEAD_Signature; ?>:</strong></td></tr>
    <tr><td colspan="2">
	<textarea class="info" name="sign" cols="60" rows="5"><?php echohtml ($_SESSION['Signature']); ?></textarea>
    </td></tr>
    <tr><td colspan="2"><input type="submit" class="submit" value="<?php echo $BUTTON_SettingsSave; ?>"></td></tr>
</form></table>
</body></html>
