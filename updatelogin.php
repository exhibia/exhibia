<?php
 header("Access-Control-Allow-Origin: *");
session_start();
$_SESSION['user_level'] = 0;

	include("config/connect.php");

	db_query("update login_logout set logout_time=NOW() where load_time='".$_SESSION["ipid"]."'");
echo(db_error());
?>
