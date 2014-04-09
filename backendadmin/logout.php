<?php
	session_start();
	session_destroy();
	echo "<script language='javascript'>window.parent.location.replace('index.php');</script>";
	exit;
?>