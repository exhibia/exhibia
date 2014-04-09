<?php
include_once($BASE_DIR . "/include/addons/facebook/data/facebook.php");

      define('YOUR_APP_ID', '129299757101755');
      define('APP_SECRET', '6b2f92a905b24bbc762c20c37c7cd7df');
    
      $facebook = new Facebook(array(
	'appId'  => YOUR_APP_ID,
	'secret' => APP_SECRET,
      ));
      $userId = $facebook->getUser();

      if ($userId) {
	  $userInfo = $facebook->api('/' . $userId);
	  $birthday = explode("/", $userInfo['birthday']);
	  $location = explode(", ", $userInfo['location']['name']);
	  $firstname= $userInfo['first_name'];
	  $lastname = $userInfo['last_name']; 
	  $email = $userInfo['email'];
	  $picture = "//graph.facebook.com/" . $userInfo['id'] . "/picture";
      }