<?php
/*
 * folders.php
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

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $DEFCharset; ?>">
<link rel="stylesheet" type="text/css" href="styles/main.css">
<title>Folder List</title>

<script language="JavaScript" type="text/javascript">
<!--//

function is_checked(form) {
    var check = false;

    for (var c = 0; c < form.elements.length; c++)
      if (form.elements[c].type == 'checkbox')
            check |= form.elements[c].checked;

    return check;
}
function SubmitDelete() {
    var form = window.top.frames['List'].document.forms.select;

    if (window.top.List.location.href.indexOf ('list.php') <= 0) {
	 alert('<?php echo $MISC_Select; ?>');
	 return true;
    } else if (form && is_checked(form)) {
	if (confirm('<?php echo $MISC_AskDelete; ?>')) {
	    form.submit();
	}
    } else alert('<?php echo $MISC_Select; ?>');

    return false;
}

//-->
</script>
</head>

<body class="folders">
<p align="center"><a href="send.php" target="Message"><img src="images/folders/compose.png" width="32" height="32" alt="Compose" title="<?php echo $STATBAR_ComposeMessage;?>" border="0"><br><?php echo $ICON_Compose;?></a></p>
<p align="center"><a href="list.php?inbox" target="List"><img src="images/folders/inbox.png" width="32" height="32" alt="Inbox" title="<?php echo $STATBAR_Inbox;?>" border="0"><br><?php echo $ICON_Inbox;?></a></p>
<p align="center"><a href="list.php?sent" target="List"><img src="images/folders/sent.png" width="32" height="32" alt="Sent" title="<?php echo $STATBAR_Sent;?>" border="0"><br><?php echo $ICON_Sent;?></a></p>

<form action="list.php" target="List" method="post" onSubmit="return SubmitDelete();">
<p align="center"><input type="image" src="images/folders/delete.png" width="32" height="32" alt="Delete" title="<?php echo $STATBAR_DeleteMessage;?>" border="0"><br><?php echo $ICON_Delete;?></p>
</form>

<p align="center"><a href="addressbook.php" target="List"><img src="images/folders/contacts.png" width="32" height="32" title="<?php echo $STATBAR_AddressBook;?>" alt="Addresses" border="0"><br><?php echo $ICON_Addresses;?></a></p>
<p align="center"><a href="settings.php" target="Message"><img src="images/folders/settings.png" width="32" height="32" alt="Settings" title="<?php echo $STATBAR_Settings;?>" border="0"><br><?php echo $ICON_Settings;?></a></p>
<p align="center"><a href="help.php" target="Message"><img src="images/folders/contents.png" width="32" height="32" alt="Help" title="<?php echo $STATBAR_About;?>" border="0"><br><?php echo $ICON_Help;?></a></p>
</body></html>
