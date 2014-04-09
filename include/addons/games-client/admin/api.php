<?php
$game_server = 'http://pennyauctionsoftdemo.com/';
$str = '';
foreach($_REQUEST as $key => $value){

    if(!is_array($_REQUEST[$key])){
    
      $str .= "&$key=$value";
    
    }else{
    
      foreach($_REQUEST[$key] as $key2 => $value2){
      
	  if(!is_array($_REQUEST[$key][$key2])){
    
		$str .= "&$key[$key2]=$value2";
    
	      }else{
		  foreach($_REQUEST[$key][$key2] as $key3 => $value3){
		  
		    $str .= "&$key[$key2][$key3]=$value3";
		  
		  }
      
	  }
      
      }
  }
}
$domain = $_SERVER['SERVER_NAME'];
$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$game_server . "/connector.php?domain=$domain&admin=true&$str&_". time());
 
	//curl_setopt($ch, CURLOPT_URL,$game->url . "&key=test&userid=$_SESSION[userid]&remote_server=" . urlencode("http://" . $_SERVER['SERVER_NAME'] . "/$connector"));
	curl_setopt($ch, CURLOPT_VERBOSE, 1);

	//turning off the server and peer verification(TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURL_HTTP_VERSION_1_1, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,POSTVARSCOMPLETE);




	$response = curl_exec($ch);
	
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
	
	
	echo $response;