<?php

ini_set('display_errors', 1);
include("../../../../config/config.inc.php");

db_connect($DBHOST, $USERNAME, $PASSWORD);
db_select_db($DATABASENAME);


db_query("CREATE TABLE IF NOT EXISTS userdata( UID BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, Username CHAR (50) NOT NULL, DisplayName CHAR (50), Signature CHAR (255), PRIMARY KEY(UID), UNIQUE(UID,Username), INDEX(UID))");
db_query("CREATE TABLE IF NOT EXISTS addressbook( EID BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, UID BIGINT UNSIGNED NOT NULL, Display CHAR (50), E_Mail CHAR (100) NOT NULL, Info CHAR (255), PRIMARY KEY(EID), UNIQUE(EID), INDEX(EID,UID,Display,E_Mail))");



$admin_email = db_fetch_array(db_query("select * from sitesetting where name = 'adminemail' order by id desc limit 1"));
$adminemailadd = $admin_email[2];
$E_Mail = $admin_email[2];




$my_id = db_fetch_array(db_query("select * from userdata where Username = '$E_Mail'"));


// Now retrieve the new data.

$num_users = db_num_rows(db_query("select * from $DATABASENAME.registration"));
$num_contacts = db_num_rows(db_query("select * from addressbook where UID = '$my_id[UID]'"));


if($num_users > $num_contacts){


	$user_sql = db_query("select * from $DATABASENAME.registration order by id desc");
	
	
	    while($user_row = db_fetch_array($user_sql)){
	   
	    @db_query("alter table addressbook add column pa_username text not null");
	    
		if(db_num_rows(db_query("select * from addressbook where UID = '$my_id[UID]' AND E_Mail = '$user_row[email]'")) == 0){
		
		
		$data = json_encode($user_row);
		
		 db_query("insert into addressbook values(null, $my_id[0], '" . addslashes($user_row['username']) . "', '" . addslashes($user_row['email']) . "', '', '$user_row[firstname] $user_row[lastname]');");
		
		
		}
	    
	    }


}
echo db_error();
/*
 * addressbook.php
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

// Include required functons and configuration

include (realpath(dirname(__FILE__))  . "/config.php");
include ( realpath(dirname(__FILE__))  . "/functions.php");
include (realpath(dirname(__FILE__))  . "/drivers/" . $SQLDriver . ".php");

// Start the session
session_start();

// Determine the language strings to use
if (!isset($_SESSION['Language'])) $_SESSION['Language'] = $Language;
require_once (realpath(dirname(__FILE__))  . "/lang/" . $_SESSION['Language'] . ".php");





// Connect to the SQL server
$SQLHandle = db_connect($SQLDatabase, $SQLUsername, $SQLPassword);
db_select_db($DATABASENAME);



// Did we connect?


// What is the action
switch ($_REQUEST['action']) {

// Edit the entry
// ---------------------------------------------------------------------------
case 'edit':

    if ($_POST['eid']) {

    // Load existing data if an Entry ID is present
   $results = db_fetch_array(db_query("SELECT * FROM addressbook WHERE (EID=" . $_POST['eid'] . ")"));
   

    // Store it in variables
    $name = $results["Display"];
    $email = $results["E_Mail"];
    $info = $results["Info"];

    } else {
	$name = $_GET['name'];
        $email = $_GET['email'];
	$info = $_GET['info'];
    }
	
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $DEFCharset; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $SITE_URL;?>include/addons/emailer/admin/styles/main.css">
<title><?php echo $TITLE_System . " : " . $TITLE_Addresses;?></title>
</head>

<body class="panel">
<form action="<?php echo $SITE_URL;?>include/addons/emailer/admin/addressbook.php" method="post">
<table class="header" width="100%" cellpadding="0" cellspacing="2">
<tr>
    <td align="left" nowrap="nowrap"><strong><?php echo $HEAD_Name; ?>:&nbsp;</strong></td>
    <td class="value" width="100%"><input type="text" class="text" name="name" value="<?php echo $name; ?>" size="50" maxlength="50" style="width : 100%;"></td>
</tr><tr>
    <td align="left" nowrap="nowrap"><strong><?php echo $HEAD_EMail; ?>:&nbsp;</strong></td>
    <td class="value" width="100%"><input type="text" class="text" name="email" value="<?php echo $email; ?>" size="50" maxlength="100" style="width : 100%;"></td>
</tr><tr>
    <td colspan="2" align="left" nowrap="nowrap"><strong><?php echo $HEAD_Info; ?>:&nbsp;</strong></td>
</tr><tr>
    <td colspan="2"><textarea class="info" name="info" rows="4" cols="50" style="width: 100%;"><?php echo stripcslashes ($info); ?></textarea></td>
</tr><tr>
    <td align="left" colspan="2">
    <table cellpadding="0" cellspacing="0"><td>
    <input type="hidden" name="action" value="save">
    <input type="hidden" name="eid" value="<?php echo $_POST['eid']; ?>">
    <input type="submit" class="submit" value="<?php echo $BUTTON_ContactSave; ?>">
    </td></form><form action="<?php echo $SITE_URL;?>include/addons/emailer/admin/addressbook.php"><td>
    <input type="submit" class="submit" value="<?php echo $BUTTON_Cancel; ?>">
    </form></td></table>
    </td>
</tr>
</table>
</body></html>
<?php exit ();

// Save or update the entry
// ---------------------------------------------------------------------------
case 'save':

    // If a EntryID is present then update the entry, otherwise add it
    if ($_POST['eid']) {
	$results = db_query("UPDATE addressbook SET Display='" . $_POST['name'] . "',  E_Mail='" . $_POST['email'] . "',  Info='" . $_POST['info'] . "' WHERE EID='" . $_POST['eid'] . "'");
	
    } else { 
	$results = db_query("INSERT INTO addressbook (UID, Display, E_Mail, Info) VALUES ('" . $Uid . "', '" . $_POST['name'] . "', '" . $_POST['email'] . "', '" . $_POST['info'] . "')");

    }

    break;

// Delete the entry
// ---------------------------------------------------------------------------
case 'delete':

    $results = db_query( "DELETE FROM addressbook where EID='" . $_POST['eid'] . "'");
   

    break;
}
	
// Show the address book
// ---------------------------------------------------------------------------

// Retrieve the data
db_select_db($DATABASENAME . "_email_prefs");

$my_id = db_fetch_array(db_query("select * from userdata where Username = '$adminemailadd'"));

$Uid = $my_id['UID'];






?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $DEFCharset; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $SITE_URL;?>include/addons/emailer/admin/styles/main.css">
<title><?php echo $TITLE_System . " : " . $TITLE_Addresses;?></title>

<script language="JavaScript" type="text/javascript">
<!--//

window.top.document.title="<?php echo $TITLE_System . " : " . $TITLE_Addresses;?>";

function SetEMail (Email) {
    if (window.top.Message.document.forms.sendform) {
	window.top.Message.document.forms.sendform.to.value = Email;
	return false;
    } else if (window.top.Message.Headers.document.forms.sendform) {
	window.top.Message.Headers.document.forms.sendform.to.value = Email;
	return false;
    }
    return true;
}

function SetStat(statstr) {
    window.status = statstr;
    return true;
}

//-->
</script>
</head>

<body class="panel">
<table width="100%" cellspacing="0" cellpadding="2" class="address">
<tr><th colspan="3" align="center" valign="middle">
    <h2><?php echo $TITLE_Addresses; ?></h2>
</th></tr>
<tr><td align="left" colspan="3">
    <table cellspacing="0" cellpadding="0">
    <td align="left" style="border : 0;">
	<form action="<?php echo $SITE_URL;?>include/addons/emailer/admin/addressbook.php" method="post">
	<input type="hidden" name="action" value="edit">
	<input type="submit" class="submit" value="<?php echo $BUTTON_ContactAdd; ?>" title="<?php echo $STATBAR_AddAddress;?>">
	</form>
    </td>
    </table>
</td></tr>
<tr>
    <td align="left">&nbsp;Username&nbsp;</td>
    <td align="left" width="20%">&nbsp;<?php echo $HEAD_EMail; ?>&nbsp;</td>
   
    <td align="left">&nbsp;<?php echo $HEAD_Actions; ?>&nbsp;</td>
</tr><?php

// Get the number of rows return
// 


if (!$_GET['pgno']) {
    $PageNo = 1;
} else {
    $PageNo = $_GET['pgno'];
}
$resel = "SELECT * FROM addressbook WHERE UID=" . $Uid;
$results = db_query($resel);


    
    $total = db_num_rows($results);
    $totalnumrows = $total;
    $totalpages = ceil($total / 15);

    if ($totalpages >= 1) {
        $startrow = 15 * ($PageNo - 1);
        $qrysel= $resel . " LIMIT $startrow,15";
        $ressel = db_query($qrysel);
        $total = db_num_rows($ressel);
        
    }
$results = db_query($qrysel);
while($c_row = db_fetch_array($results)){


    $name = $c_row["Display"];
    $email = $c_row["E_Mail"];
    $infoi = $c_row["Info"];
  
    $Eid = $c_row["EID"];
			
    // If the info and name entry are empty then use a non-breaking space
  
    
?><tr>
    <td class="entry" nowrap="nowrap">&nbsp;<?php echo $name; ?>&nbsp;</td>
    <td class="entry">&nbsp;<?php echo $email; ?>&nbsp;</td>
      <td class="entry" align="right" valign="top">
	<table class="actions" border="0" cellspacing="0" cellpadding="0">
	<tr><td style="border : 0;" nowrap="nowrap">
	<form action="<?php echo $SITE_URL;?>include/addons/emailer/admin/send.php" target="Message" method="post" name="SendTo" id="SendTo" onSubmit="return SetEMail ('<?php echo "$name <$email>";?>');">
	<input type="submit" class="submit" value="<?php echo $BUTTON_SendTo; ?>" title="<?php echo $STATBAR_SendTo; ?>">
	<input type="hidden" name="to" value="<?php echo "$name <$email>";?>">
	</form></td><td style="border : 0;" nowrap="nowrap">
	<form action="<?php echo $SITE_URL;?>include/addons/emailer/admin/addressbook.php" method="post">
	<input type="hidden" name="action" value="edit">
	<input type="hidden" name="eid" value="<?php echo $Eid; ?>">
	<input type="submit" class="submit" value="<?php echo $BUTTON_Edit; ?>" title="<?php echo $STATBAR_EditAddress; ?>">
	</form></td><td style="border : 0;" nowrap="nowrap">
	<form action="<?php echo $SITE_URL;?>include/addons/emailer/admin/addressbook.php" method="post" onSubmit="return confirm('<?php echo $MISC_Contact_AskDelete; ?>')">
	<input type="hidden" name="action" value="delete">
	<input type="hidden" name="eid" value="<?php echo $Eid; ?>">
	<input type="submit" class="submit" value="<?php echo $BUTTON_Delete; ?>" title="<?php echo $STATBAR_DeleteAddress; ?>">
	</form></td></tr>
	</table>
    </td>
</tr><?php } 

?>

<?php if ($total) { ?>
                                                        <!--[if !IE]>start pagination<![endif]-->
                                                        <div class="pagination">
                                                            <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpages; ?></span>
                                                                        <ul class="pag_list" style="list-style-type:none;">
<?php
                                                                    if ($PageNo > 1) {
                                                                        $PrevPageNo = $PageNo - 1;
?>
                                                                        <li style="display:inline;"><a href="addressbook.php?<?php echo $urldata; ?>&pgno=<?php echo $PrevPageNo; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
<?php } ?>

<?php
                                                                    $pageFrom = $PageNo - 3 < 1 ? 1 : $PageNo - 3;
                                                                    $pageTo = $PageNo + 3 > $totalpages ? $totalpages : $PageNo + 3;
                                                                    for ($i = $pageFrom; $i <= $pageTo; $i++) {
?>
                                                            <?php if ($i == $PageNo) {
 ?>
                                                                            <li style="display:inline;"><a href="addressbook.php?<?php echo $urldata; ?>&pgno=<?php echo $i; ?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                            <?php } else {
 ?>
                                                                            <li style="display:inline;"><a href="addressbook.php?<?php echo $urldata; ?>&pgno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                                            <?php
                                                                        }
                                                                    }
                                                            ?>
                                                            <?php
                                                                    if ($PageNo < $totalpages) {
                                                                        $NextPageNo = $PageNo + 1;
                                                            ?>
                                                                        <li style="display:inline;"><a href="addressbook.php?<?php echo $urldata; ?>&pgno=<?php echo $NextPageNo; ?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
<?php } ?>
                                                                </ul>

                                                            </div>
                                                            <!--[if !IE]>end pagination<![endif]-->
<?php } ?>

                                                         
                                                            <?php

echo db_error(); ?>

<tr>
    <td width="100%" colspan="2" align="right">&nbsp;<?php echo $MISC_Entries . ":"; ?>&nbsp;</td>
    <td align="left">&nbsp;<?php echo db_num_rows($results);?>&nbsp;</td>
</tr>
</table>
</body></html>
