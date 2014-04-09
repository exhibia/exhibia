<?php
session_start();
ob_start();
include "includes/base.php";
function logout($user)
{
	db_query("UPDATE users SET available = 'no' WHERE username = '".$user."' ");
       	$_SESSION = array(); //destroy all of the session variables
        session_destroy();
	header('Location: login.php');
}
logout($_SESSION['username']);
ob_flush();
?>
