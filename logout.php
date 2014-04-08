<?php
	include("config/connect.php");
        	
	if($_SESSION["ipid"]!="")
	{
		$qryipupd = "update login_logout set logout_time=NOW() where load_time='".$_SESSION["ipid"]."'";
		db_query($qryipupd) or die(db_error());
	}
	$_SESSION["login_logout"] = $_SESSION["ipid"];
	unset($_SESSION['userid']);
	unset($_SESSION['username']);
	unset($_SESSION['ipid']);
	

	// Include google API settings
	require "include/addons/google/google_verification.php";

	// Now include the Google API client library for PHP(https://code.google.com/p/google-api-php-client/downloads/list)
	require_once 'include/addons/google/src/Google_Client.php';
	require_once 'include/addons/google/src/contrib/Google_Oauth2Service.php';

	$googleClient = new Google_Client();
	$googleClient->setApplicationName('Exhibia');
	$googleClient->setClientId($clientID);
	$googleClient->setClientSecret($clientSecret);
	$googleClient->setRedirectUri($redirectURL);
	$googleClient->setDeveloperKey($apiKey);

	$google_oauthV2 = new Google_Oauth2Service($googleClient);	
	
	
	unset($_SESSION['token']);
	$googleClient->revokeToken();
	
  
  
  
	echo "<script language='javascript'>window.parent.location.replace('index.php');</script>";
	exit;
?>