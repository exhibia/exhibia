<?php
include "base.php";
include "date.php";
if(!empty($_GET)) {
	// make sure convo is active
	$active = db_query("SELECT * FROM sessions WHERE userID = '".$_GET['userID']."' ");
	$check = db_fetch_array($active);
	$timeStamp = date('g:i a');
	$updated = time();
	if($check['status'] == "open") {
	db_query("INSERT INTO transcript 
	(name,message,user,convoID,time,class) 
	VALUES 
	('".$_GET['name']."','".$_GET['message']."','".$_GET['userID']."','".$_GET['convoID']."','".$timeStamp."','user') 
	");
	db_query("UPDATE sessions SET
	updated = '".$updated."'
	WHERE userID = '".$_GET['userID']."'
	");
	} else {
	db_query("INSERT INTO transcript
        (name,message,user,convoID,time,class)
        VALUES
        ('".$_GET['name']."','This session has expired.','".$_GET['userID']."','".$_GET['convoID']."','".$timeStamp."','notice')
        ");
        db_query("UPDATE sessions SET
        updated = '".$updated."'
        WHERE userID = '".$_GET['userID']."'
        ");

	}
}


?>
