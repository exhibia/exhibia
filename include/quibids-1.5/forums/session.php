<?
	include("../config/config.inc.php");
	if($_SESSION["userid"]=="")
	{
		header("location: ../login.php");
		exit;
	}
?>