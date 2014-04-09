<?php
include "base.php";
include "date.php";
if(!empty($_GET)) {
	$timeStamp = date('g:i a');	
	$query = db_query("SELECT * FROM sessions WHERE id = '".$_GET['convoID']."' ");
	$result = db_fetch_array($query);
	if(($result['status'] == "closed") && ($result['hide'] == "no")) {
		db_query("UPDATE sessions SET status = 'open', updated = '".$row['updated']."' WHERE id = '".$_GET['convoID']."' ");
	}
	if($result['hide'] == "no") {
	db_query("INSERT INTO transcript 
	(name,message,user,convoID,time,class) 
	VALUES 
	('".$_GET['name']."','".$_GET['message']."','".$_GET['userID']."','".$_GET['convoID']."','".$timeStamp."','admin') 
	");
	$answered = time();
	db_query("UPDATE sessions SET
	answered = '".$answered."'
	WHERE convoID = '".$_GET['convoID']."'
	");
	} else if($result['hide'] == "yes") {
	$_GET['message'] = "This session has expired";
	db_query("INSERT INTO transcript
        (name,message,convoID,class)
        VALUES
        ('System','".$_GET['message']."','".$_GET['convoID']."','notice')
        ");
	}
}


?>
