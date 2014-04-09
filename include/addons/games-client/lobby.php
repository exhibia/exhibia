<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$games_server . "/game_settings.php?room=$_REQUEST[game]&game=$_REQUEST[game]&template=" . $template . "&domain=" . str_replace("www.", "", $_SERVER['SERVER_NAME']) . "&userid=" . $user->id . "&max_players=$game[max_players]&min_players=$game[min_players]&username=" . $user->username . "&key=test&userid=$_SESSION[userid]&remote_server=" . urlencode("http://" . $_SERVER['SERVER_NAME'] . "/$connector"));
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
	


$game = json_decode($response, true);

curl_close($ch);

$user = db_fetch_object(db_query("select * from registration where id = $_SESSION[userid]"));

        $ch = curl_init();
       
        curl_setopt($ch, CURLOPT_URL,$games_server . "/get_lobby.php?room=$_REQUEST[game]&game=$_REQUEST[game]&template=" . $template . "&domain=" . str_replace("www.", "", $_SERVER['SERVER_NAME']) . "&userid=" . $user->id . "&max_players=" . $game[0][$_REQUEST['game']]['max_players'] . "&min_players=" . $game[0][$_REQUEST['game']]['min_players'] . "&username=" . $user->username . "&key=test&userid=$_SESSION[userid]&remote_server=" . urlencode("http://" . $_SERVER['SERVER_NAME'] . "/$connector"));
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


//echo "Game not found please contact " . $game->email;




}else{

echo $response;
}
