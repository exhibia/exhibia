<?php
	include("connect.php");
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$query = "Delete from products where id='$id'";
		db_query($query) or die(db_error());
		header("Location:message.php?msg=55");
		exit;
	}
?>