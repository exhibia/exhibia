<?php

ini_set('display_errors', 1);

// Include google API settings
include "$BASE_DIR/include/addons/google/google_verification.php";

// Now include the Google API client library for PHP(https://code.google.com/p/google-api-php-client/downloads/list)
include_once $BASE_DIR . '/include/addons/google/src/Google_Client.php';
include_once $BASE_DIR . '/include/addons/google/src/contrib/Google_Oauth2Service.php';


$googleClient = new Google_Client();
$googleClient->setApplicationName('Exhibia');
$googleClient->setClientId($clientID);
$googleClient->setClientSecret($clientSecret);
$googleClient->setRedirectUri($redirectURL);
$googleClient->setDeveloperKey($apiKey);

$google_oauthV2 = new Google_Oauth2Service($googleClient);
// Action if code is sent
if (isset($_GET['code'])) 
{ 

    try{
	  $googleClient->authenticate($_GET['code']);
	  $_SESSION['token'] = $googleClient->getAccessToken();
	
    }catch(Google_AuthException $e){ }
}
// Action if token is sent
if (isset($_SESSION['token'])) 
{ 
		$googleClient->setAccessToken($_SESSION['token']);
}
if ($googleClient->getAccessToken()) 
{


	  $userInfo 				= $google_oauthV2->userinfo->get();

	  $picture = $userInfo['picture'];
	  $email = $userInfo['email'];
	  $firstname = $userInfo['given_name'];
	  $lastname = $userInfo['family_name'];
	  $gender = $userInfo['gender'];
	
	  $url = "https://www.googleapis.com/plus/v1/people/$userInfo[id]?key=$apiKey";
	
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_URL, $url);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	  
	  $response = json_decode(curl_exec($ch), true);
	 
	  if(db_num_rows(db_query("select * from registration where google = '$email' or email = '$email'")) >= 1){
	
	  $user = db_fetch_array(db_query("select * from registration where google = '$email' or email = '$email'"));
	  $_SESSION['userid'] = $user['id'];
	  $_SESSION['username'] = $user['username'];
	  $_SESSION['email'] = $user['email'];
	    ?>
	    <script>
	    window.location.href = 'myaccount.php';
	    </script>
	    <?php
	    exit;
	  }else{
	  
	  $login_url = $googleClient->createAuthUrl();
	  
	  }
	 

}else 
{
	//Generate Login URL
	$login_url = $googleClient->createAuthUrl();

}	  
if(isset($login_url) & empty($_GET['code'])) //user is not logged in, show login button
{

?>
	 <a href="<?php echo $login_url;?>"><img src="images/google.png" border="0" alt="" id="google_button"></a>
<?php
} 


?>

