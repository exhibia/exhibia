<?php


/*
 * list.php
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


// Determine the language strings to use
if (!isset($_SESSION['Language'])) $_SESSION['Language'] = $Language;
require_once ( realpath(dirname(__FILE__))  . "/lang/" . $_SESSION['Language'] . ".php");





$Folder = $_SERVER['QUERY_STRING'];
if (!$Folder) $Folder = 'inbox';
$_SESSION['Folder'] = $Folder;

if ($Folder == 'sent') {
    $Mailbox = "$SENTFolder/$Username";
    $Title = $ICON_Sent;
} else {
    $Mailbox = "INBOX";
    $Title = $ICON_Inbox;
} 


$Mailbox = "{". $_SERVER['SERVER_NAME'] . ":$mailOptions}INBOX";
$imap = imap_open($Mailbox, $Username, $Password);


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="refresh" content="<?php echo "$RefreshList; url='list.php?$Folder'";?>">
<meta http-equiv="content-type" content="text/html; charset=<?php echo $DEFCharset; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $SITE_URL;?>include/addons/emailer/admin/styles/main.css">
<title><?php echo $TITLE_System . " : " . $Title;?></title>

<script language="JavaScript" type="text/javascript">
<!--//

window.top.document.title="<?php echo $TITLE_System . " : " . $Title; ?>";

function replace(str, original, replacement) {
    var result = "";

    while(str.indexOf(original) != -1) {
	if (str.indexOf(original) > 0) result = result + str.substring(0, str.indexOf(original)) + replacement;
	else result = result + replacement;
	str = str.substring(str.indexOf(original) + original.length, str.length);
    }

    return result + str;
}

function self_print(str, width_pct) {
    var font_width = 6;
    var right_offset = 250;
    var str_chars = Math.ceil((document.body.clientWidth - right_offset) *
	width_pct / (100 * font_width));

    if (str.length > str_chars)
	str = str.substring(0, str_chars) + "...";

    str = replace(str, '<', '&lt;');
    str = replace(str, '>', '&gt;');

    document.write(str);
}

function check_boxes (form, check) {
    for (var c = 0; c < form.elements.length; c++)
	if (form.elements[c].type == 'checkbox')
            form.elements[c].checked = check;
}

function is_checked(form) {
    var check = false;

    for (var c = 0; c < form.elements.length; c++)
	if (form.elements[c].type == 'checkbox')
            check |= form.elements[c].checked;

    return check;
}

function on_submit(form) {

    if (form && is_checked(form)) {
	if (confirm('<?php echo $MISC_AskDelete; ?>'))
	    return_true;
    } else alert('<?php echo $MISC_Select; ?>');

    return false;
}

//-->
</script>
</head>

<body class="mlist" onResize="window.location=this.location.href;">
<form name="select" id="select" action="<?php echo $SITE_URL;?>include/addons/emailer/admin/delete.php" method="post" onsubmit="return on_submit(this)">
<table width="100%" cellspacing="0" cellpadding="0" class="mlist">

<!--Header s-->
<tr>
    <th width="20" valign="middle" class="toolbar">
    <input type="image" class="image" src="<?php echo $SITE_URL;?>include/addons/emailer/admin/images/delete.png" width="16" height="16" alt="Delete" title="Delete"></th>
    <th colspan="4" class="toolbar"><h2><?php echo $Title; ?></h2></th>
</tr><tr>
    <th width="20" valign="middle" style="text-align: center;"><input type="checkbox" class="checkbox" name="check" onClick="check_boxes(this.form, this.checked)"></th>
    <th width="15" valign="middle"><img src="<?php echo $SITE_URL;?>include/addons/emailer/admin/images/attachment.png" width="15" height="15" alt="@" border="0" hspace="0" vspace="0"></th>
    <th><?php if ($Folder == 'sent') echo $HEAD_To; else echo $HEAD_From;?></th>
    <th><?php echo $HEAD_Subject;?></th>
    <th width="200"><?php if ($Folder == 'sent') echo $HEAD_Sent; else echo $HEAD_Recieved;?></th>
</tr>
<!--Header e-->

<?php
$mnum = imap_num_msg($imap);

if ($mnum) {
    for ($i = $mnum; $i > 0; $i--) {
	$hdr = imap_fetchheader($imap, $i, FT_INTERNAL);
	$headers = imap_rfc822_parse_headers($hdr);
	if (eregi('charset=[\"\']?([-a-z0-9\._]+)?', $hdr, $regs))
	    $charset = trim($regs[1]); else $charset = false;
	if ($Folder == 'sent') {
	    if (ereg('(MISSING-HOST-NAME|UNKNOWN)', $headers->to[0]->host))
		 $address = $headers->to[0]->mailbox;
	    else $address = header_decode($headers->toaddress, $charset);
	}   else $address = header_decode($headers->fromaddress, $charset);
	$subject = header_decode($headers->subject, $charset);
    if (!$address) $address = "&nbsp;";
    if (!$subject) $subject = "&nbsp;";
?><tr>
    <td valign="middle" width="1%" style="text-align: center;"><input type="checkbox" class="checkbox" name="<?php echo $i;?>" value="msgnum"></td>
    <td valign="middle" width="1%"><?php if (num_attach ($imap, $i)) { ?><a href="<?php echo $SITE_URL;?>/include/addons/emailer/admin/message.php?msg=<?php echo $i;?>" target="Message"><img src="<?php echo $SITE_URL;?>include/addons/emailer/admin/images/attachment.png" width="14" height="14" alt="@" border="0" hspace="0" vspace="0"></a><?php } else echo "&nbsp;"; ?></td>
    <td nowrap="nowrap" width="24%"><a href="<?php echo $SITE_URL;?>include/addons/emailer/admin/message.php?msg=<?php echo $i;?>" target="Message"><script>self_print('<?php echo addcslashes ($address, "()\'\"");?>', 25)</script></a></td>
    <td nowrap="nowrap" width="50%"><a href="<?php echo $SITE_URL;?>include/addons/emailer/admin/message.php?msg=<?php echo $i;?>" target="Message"><script>self_print('<?php echo addcslashes ($subject, "()\'\"");?>', 55)</script></a></td>
    <td nowrap="nowrap" width="24%"><a href="<?php echo $SITE_URL;?>include/addons/emailer/admin/message.php?msg=<?php echo $i;?>" target="Message"><?php echo $headers->date;?></a></td>
</tr>
<?php }} else { ?><tr><td colspan="5" nowrap><?php echo $MISC_NoMessage;?></td></tr>
<?php } imap_close($imap); ?>

</table></form>
</body></html>

