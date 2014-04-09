<?php

$game = server_images($_REQUEST, $games_server);

	

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $game[0]['url'] . "&userid=$_SESSION[userid]&room=$_REQUEST[game]&username=$_SESSION[username]&userid=$_SESSION[userid]&domain=" . str_replace("www.", "", "$_SERVER[SERVER_NAME]"));
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
	
if($httpCode == '404'){


echo "Game not found please contact " . $game[0]['email'];




}else{

echo $response;
}
echo curl_error($ch);