<?php
 
ini_set('display_errors', 1);
include("../../../../config/config.inc.php");
include (realpath(dirname(__FILE__))  . "/config.php");
include ( realpath(dirname(__FILE__))  . "/functions.php");

function attachfile($file, $type = "application/octetstream")  {
    if(!($fd = fopen($file, "r"))) {
      $this->errstr = "Error opening $file for reading.";
      return 0;
    }
    $_buf = fread($fd, filesize($file));
    fclose($fd);

    $fname = $file;
    for($x = strlen($file); $x > 0; $x--)
      if($file[$x] == "/")
        $fname = substr($file, $x, strlen($file) - $x);

    // Convert to base64 becuase mail attachments are not binary safe.
    $_buf = chunk_split(base64_encode($_buf));

    $this->attachments[$file] = "\n--" . $this->boundary . "\n";
    $this->attachments[$file] .= "Content-Type: $type; name=\"$fname\"\n";
    $this->attachments[$file] .= "Content-Transfer-Encoding: base64\n";
    $this->attachments[$file] .= "Content-Disposition: attachment; " .
                                     "filename=\"$fname\"\n\n";
    $this->attachments[$file] .= $_buf;

    return 1;
  }
  
  
function SendHTMLMail2($to, $subject, $mailcontent, $from) {
    $array = explode("@", $from, 2);
    $SERVER_NAME = $array[1];
    $username = $array[0];



# Setup mime boundary
$mime_boundary = 'Multipart_Boundary_x'.md5(time()).'x';

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\r\n";
$headers .= "Content-Transfer-Encoding: 7bit\r\n";
$replyto .= "reply-to: $username@$SERVER_NAME";

$body = "This is a multi-part message in mime format.\n\n";

# Add in plain text version
$body.= "--$mime_boundary\n";
$body.= "Content-Type: text/plain; charset=\"charset=us-ascii\"\n";
$body.= "Content-Transfer-Encoding: 7bit\n\n";
$body.= strip_tags($mailcontent);
$body.= "\n\n";

# Add in HTML version
$body.= "--$mime_boundary\n";
$body.= "Content-Type: text/html; charset=\"UTF-8\"\n";
$body.= "Content-Transfer-Encoding: 7bit\n\n";
$body.= $mailcontent;
$body.= "\n";

# Attachments would go here
# But this whole email thing should be turned into a class to more logically handle attachments, 
# this function is fine for just dealing with html and text content.

if(count($_FILES['file']) > 0){

      foreach($_FILES['file']['tmp_name'] as $key => $value){
	  $data = file_get_contents($_FILES['file']['tmp_name'][$key]);
	    $attachment = chunk_split(base64_encode($data));
	    
	    $body .= "--$mime_boundary--\n";
	    $header .= "Content-Type: application/octetstream; name=\"" . $_FILES['file']['name'][$key] . "\"\n";
	    $header .= "Content-Transfer-Encoding: base64\n";
	    $header .= "Content-Disposition: attachment\n";
	    $body .= $attachment;
	    
	    
      }

}
# End email
$body.= "--$mime_boundary--\n"; # <-- Notice trailing --, required to close email body for mime's

# Finish off headers
$headers .= "From: $username@$SERVER_NAME\r\n";
$headers .= "X-Sender-IP: $_SERVER[SERVER_ADDR]\r\n";
$headers .= 'Date: '.date('n/d/Y g:i A')."\r\n";
$replyto .= "reply-to: $username@$SERVER_NAME";
# Mail it out
$mail = mail($to, $subject, $body, $headers);
if($mail){
echo "Email Sent";
}else{
echo "Email Faailed";
}
   
    
    
}
db_connect($DBHOST, $USERNAME, $PASSWORD);
db_select_db($DATABASENAME);
$admin_email = db_fetch_array(db_query("select * from sitesetting where name = 'adminemail' order by id desc limit 1"));
$adminemailadd = $admin_email[2];
$E_Mail = $admin_email[2];
/*
 * send.php
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



// Start the session
session_start();

// Determine the language strings to use
if (!isset($_SESSION['Language'])) $_SESSION['Language'] = $Language;
require_once ("lang/" . $_SESSION['Language'] . ".php");

$Mailbox = "\{". $_SERVER['SERVER_NAME'] . ":$mailOptions}$SENTFolder/$Username";

if (isset($_REQUEST['to']))
    $to = stripslashes ($_REQUEST['to']);
    else $to = "";
if (isset($_REQUEST['subject']))
    $subject = stripslashes ($_REQUEST['subject']);
    else $subject = "";
if (isset($_REQUEST['body']))
    $body = stripslashes ($_REQUEST['body']);
    else $body = "";

$action = $_POST['action'];



if ($action == "send") {

    SendHTMLMail2($to, $subject, $body, $adminemailadd);
} else{
    if (session_is_registered ('Signature'))
	$body = "\r\n\r\n" . $_SESSION['Signature'];
    if ($action) {
	if (session_is_registered ('Subject'))
	    $subject = $_SESSION['Subject']; else $subject = "";
	$body .= "\r\n". $MISC_Quote . "\r\n";
	
	switch ($action) {
	case "reply":
	    $subject = "Re: " . $subject;
	   
	    break;
	case "forward":
	    if (session_is_registered ('From')) $body .= "From: " . $_SESSION['From'] . "\r\n";
	    if (session_is_registered ('Time')) $body .= "Date: " . $_SESSION['Time'] . "\r\n";
	    if ($subject != "") $body .= "Subject: $subject\r\n";
	    $to = "";
	    $subject = "Fwd: " . $subject;
	  
	    break;
	}
	if (session_is_registered ('MessageText'))
	    $body .= "\r\n" . $_SESSION['MessageText'];
	else $body .= "";
    }
    
    


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $DEFCharset; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $SITE_URL;?>/include/addons/emailer/admin/styles/main.css">
<title><?php echo $TITLE_System . " : " . $TITLE_Compose;?></title>

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

var item_id = 1;

function createNewRow()
{
    div = document.createElement ("div");
    input = document.createElement("input")
    button = document.createElement("input")

    input.setAttribute("type", "file");
    input.setAttribute("class", "file");
    input.setAttribute("id", "item["+item_id + "]");
    input.setAttribute("name", "file["+item_id + "]");
    input.setAttribute("size", "60");
    input.style.padding = "4px";

    button.setAttribute("type", "button");
    button.setAttribute("class", "button");
    button.setAttribute("value", " - ");
    button.setAttribute("onclick", "return del_item(" + item_id + ");");
    button.onclick = Function("return del_item(" + item_id + ");");
    button.style.marginLeft = "2px";
    button.style.padding = "2px";
    button.style.width = "30px";

    div.setAttribute("id", "row"+item_id);
    div.appendChild(input);
    div.appendChild(button);

    item_id++;
    return div;
}

function add_item() 
{
    list = document.getElementById("attach_list");
    if (list != null)
	    list.insertBefore (createNewRow(), list.lastChild);
    return false;
}

function del_item(n)
{
    list = document.getElementById("attach_list");
    row = document.getElementById("row" + n);
    if ((row != null) && (list != null))
	   list.removeChild(row);
    return false;
}

//-->
</script>
</head>

<body class="send">
<form action="<?php echo $SITE_URL;?>/include/addons/emailer/admin/send.php" method="post" enctype="multipart/form-data" name="sendform" id="sendform" onSubmit="return checkEmailStr(this.to.value)">
<table cellspacing="0" cellpadding="0" border="0" width="100%" height="100%">
<tr><td><table class="header" cellspacing="2" cellpadding="0" border="0" width="100%">

<?php if (isset($Error)) { ?>
<tr align="left"><td colspan=3><?php echo "<b>$HEAD_Error</b>&nbsp;&nbsp;$Error"; ?><hr size="1"></td></tr>
<?php } ?>

<tr><td nowrap="nowrap"><strong>&nbsp;<?php echo $HEAD_From; ?>:&nbsp;</strong></td>
<td class="value" colspan="2" width="100%" valign="middle"><input class="text" type="text" name="from" size="60" value="<?php echo  $adminemailadd . "&nbsp;&lt;" . $adminemailadd . "&gt;"; ?>" readonly="readonly"></td></tr>

<tr><td nowrap="nowrap"><strong>&nbsp;<?php echo $HEAD_To;?>:&nbsp;</strong>
<a href="addressbook.php" target="List"><img src="<?php echo $SITE_URL;?>/include/addons/emailer/admin/images/addressbook.png" width="16" height="16" border="0" vspace="0" align="top"></a></td>
<td class="value" colspan="2" width="100%" valign="middle"><input class="text" type="text" name="to" id="to" size="60" value="<?php echohtml ($to);?>"></td></tr>

<tr><td nowrap="nowrap"><strong>&nbsp;<?php echo $HEAD_Subject;?>:&nbsp;</strong></td>
<td class="value" colspan="2"><input class="text" type="text" name="subject" id="subject" value="<?php echohtml ($subject);?>" size="60"></td></tr>

<tr><td valign="top" nowrap="nowrap" style="padding-top: 4px">
<strong>&nbsp;<?php echo $HEAD_Attachment;?>:&nbsp;</strong></td>
<td width="100%" valign="middle">
<input type="hidden" name="action" value="send">

<div id="attach_list">
<div id="row0"><input type="file" class="file[0]" name="file[0]" id="item0" size="60"><input type="button" class="button" value=" + " onclick="return add_item();"></div>
</div>

</td>
</tr>
<tr>
<td colspan="4" align="right" valign="top">
<input type="submit" class="submit" value="<?php echo $BUTTON_Send;?>" title="<?php echo $STATBAR_Send;?>"></td></tr>
<tr>
<td colspan="4" align="left" valign="top">
<textarea name="body" id="body" wrap="physical" cols="70" rows="8" style="border:1px solid inset;width: 600px; height: 300px;"><?php echo stripcslashes ($body);?></textarea>


</table></td></tr>
<tr><td height="100%">


</td></tr>
</table></form>
</body></html>
<?php } ?>