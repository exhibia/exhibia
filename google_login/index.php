<?php
session_start();

// Include google API settings
include "google_verification.php";

// Now include the Google API client library for PHP(https://code.google.com/p/google-api-php-client/downloads/list)
require_once 'src/Google_Client.php';
require_once 'src/contrib/Google_Oauth2Service.php';


$googleClient = new Google_Client();
$googleClient->setApplicationName('Your APP Name');
$googleClient->setClientId($clientID);
$googleClient->setClientSecret($clientSecret);
$googleClient->setRedirectUri($redirectURL);
$googleClient->setDeveloperKey($apiKey);

$google_oauthV2 = new Google_Oauth2Service($googleClient);

if (isset($_REQUEST['logout'])) 
{
  unset($_SESSION['token']);
  $googleClient->revokeToken();
  header('Location: ' . $redirectURL);
}


// Action if code is sent
if (isset($_GET['code'])) 
{ 
	$googleClient->authenticate($_GET['code']);
	$_SESSION['token'] = $googleClient->getAccessToken();
	header('Location: ' . $redirectURL);
	return;
}

// Action if token is sent
if (isset($_SESSION['token'])) 
{ 
		$googleClient->setAccessToken($_SESSION['token']);
}


if ($googleClient->getAccessToken()) 
{
	  // Extract the user details and store them in an array
	  $data 				= $google_oauthV2->userinfo->get();
	  
	  $user_id 				= $data['id'];
	 
	  $user_name 			= $data['name'];
	 
	  $email 				= $data['email'];
	 
	  $profile_url 			= $data['link'];
	 
	  $profile_image_url 	= $data['picture'];

	  $_SESSION['token'] 	= $googleClient->getAccessToken();
}
else 
{
	//Generate Login URL
	$login_url = $googleClient->createAuthUrl();

}



echo '<html><head>';
echo '<title>Login with Google</title>';
echo '</head>';
echo '<body>';
if(isset($login_url)) //user is not logged in, show login button
{
	echo '<a class="login" href="'.$login_url.'"><img src="index.jpg" /></a>';

} 
else // login successful, so prints user information[can be extended to store in DB(easy part)]
{

	// DB code goes here
	// check if user already exists or not using mysql select query
	// insert if new user is there
	foreach($data as $key=>$value){
		echo "$key is $value<br /><br />";
	}
	echo '<br /><a class="logout" href="?logout=1">Logout</a>'; 
}

echo '</body></html>';
?>

