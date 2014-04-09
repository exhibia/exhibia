<?php
ini_set('display_errors', 1);
include("../../../../config/config.inc.php");


db_select_db($DATABASENAME);
db_query("CREATE TABLE IF NOT EXISTS userdata( UID BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, Username CHAR (50) NOT NULL, DisplayName CHAR (50), Signature CHAR (255), PRIMARY KEY(UID), UNIQUE(UID,Username), INDEX(UID))");
db_query("CREATE TABLE IF NOT EXISTS addressbook( EID BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, UID BIGINT UNSIGNED NOT NULL, Display CHAR (50), E_Mail CHAR (100) NOT NULL, Info CHAR (255), PRIMARY KEY(EID), UNIQUE(EID), INDEX(EID,UID,Display,E_Mail))");



echo db_error();

/*
 * interface.php
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

// Start a new session and register the new variables
session_start();

session_register('Username');
session_register('Password');
session_register('UID');
session_register('EMail');
session_register('DisName');
session_register('Signature');
session_register('Folder');
session_register('Language');
if (isset($_POST['language']))
    $_SESSION['Language'] = $_POST['language'];
else $_SESSION['Language'] = $Language;

// Include required functons and configuration

include (realpath(dirname(__FILE__))  . "/config.php");
include ( realpath(dirname(__FILE__))  . "/functions.php");
include (realpath(dirname(__FILE__))  . "/drivers/" . $SQLDriver . ".php");

// Set Language
setcookie('language', $_SESSION['Language'], time()+432000, "/", "\.$SMTPDomain");
//require_once ("lang/" . $_SESSION['Language'] . ".php");


$Mailbox = "\{$IMAPHostname:$IMAPPort".$IMAPFlags."}INBOX";




$imap = imap_open("{". $_SERVER['SERVER_NAME'] . ":143/imap/novalidate-cert}INBOX", $Username, $Password);

// If POP connection wasn't made
//if (!$imap) echo_error ($ERROR_AtLogin, $ERROR_Auth);

// Connect to the SQL server
$SQLHandle = db_connect( $DBSERVER, $SQLUsername, $SQLPassword);
db_select_db($DATABASENAME);
// If no handle was returned then you couldn't connect to the server.
//if (!$SQLHandle) echo_error ($ERROR_SQLErr, $ERROR_SQLConnect);

// Retrieve the use's information from the database
$query = db_query("SELECT Username FROM userdata WHERE (Username = '" . $EMail . "')");

// If no results come up, then the user needs to be added to the database.
if (db_num_rows ($query) == 0) {

    $result = db_query("INSERT INTO userdata (Username, DisplayName) VALUES ('" . $EMail . "','" . $EMail . "')");


}

$query = db_query("SELECT * FROM userdata WHERE (Username = '" . $EMail . "')");

$my_id = db_fetch_array(db_query("select * from userdata where Username = '$EMail'"));


// Now retrieve the new data.

$num_users = db_num_rows(db_query("select * from $DATABASENAME.registration"));
$num_contacts = db_num_rows(db_query("select * from addressbook where UID = '$my_id[UID]'"));


if($num_users > $num_contacts){
db_select_db("$DATABASENAME");

	$user_sql = db_query("select * from $DATABASENAME.registration order by id desc");
	
	
	    while($user_row = db_fetch_array($user_sql)){
	    
	    @db_query("alter table addressbook add column pa_username text not null");
	    
		if(db_num_rows(db_query("select * from addressbook where UID = '$my_id[UID]' AND E_Mail = '$user_row[email]'")) == 0){
		$data = json_encode($user_row);
		
		 db_query("insert into addressbook values(null, $my_id[0], '" . addslashes($user_row['username']) . "', '" . addslashes($user_row['email']) . "', '" . addslashes($data) . "', '$user_row[firstname] $user_row[lastname]');");
		
		
		}
	    
	    }


}

$query = db_query("SELECT * FROM userdata WHERE (Username = '" . $EMail . "')");
// Store the User ID in the session
$Uid = db_get_data_by_name ($query, 0, "UID");
$DisName = db_get_data_by_name ($query, 0, "DisplayName");
$Signature = db_get_data_by_name ($query, 0, "Signature");

$_SESSION['UID'] = $Uid;
$_SESSION['DisName'] = $DisName;
$_SESSION['Signature'] = $Signature;
$mnum = imap_num_msg($imap);
	
$FrameBorder = 1;
if (stristr ($_SERVER['HTTP_USER_AGENT'], "msie"))
    $FrameBorder = 0;

?>
<script language="JavaScript" type="text/javascript">
<!--//

function SetbgColor(b_color) {
    if ((top.document != null) && (top.document.bgColor != null)){
	temp_str = top.document.bgColor;
	if (temp_str.toLowerCase() != b_color.toLowerCase()) top.document.bgColor = b_color;
    }
}
SetbgColor("#fff");

//-->
</script>
<style>
.scb{
display:none;
}
</style>
<div style="position:absolute;left:10px;">
    <iframe src="<?php echo $SITE_URL;?>/include/addons/emailer/admin/folders.php" name="Contents" id="Contents" scrolling="No" marginwidth="0" marginheight="0" style="height:auto;min-height:650px;float:left;width:60px;border:1px solid gray;border-radius:6px 0 0 6px;"></iframe>
        <iframe src="<?php echo $SITE_URL;?>/include/addons/emailer/admin/list.php?inbox" name="List" id="List" scrolling="Yes" marginwidth="0" marginheight="0" style="height:auto;min-height:650px;float:left;width:590px;border:1px solid gray;"></iframe>
        <iframe src="<?php echo $SITE_URL;?>/include/addons/emailer/admin/message.php<?php if ($mnum) echo "?msg=$mnum"; ?>" name="Message" id="Message" scrolling="No" marginwidth="0" marginheight="0" style="border-radius:0 6px 6px 0;border:1px solid gray;width:600px;height:auto;min-height:650px;float:right;"></iframe>
  
</div>

<?php imap_close ($imap);

db_select_db($DATABASENAME);
?>
