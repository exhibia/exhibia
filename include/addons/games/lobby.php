<?php
$game_server = 'http://pennyauctionsoftdemo.com/';

$user = db_fetch_object(db_query("select * from registration where id = $_SESSION[userid]"));
        $ch = curl_init();
        echo $game_server . "get_lobby.php?template=" . $template . "&domain=$_SERVER[SERVER_NAME]&userid=" . $user->id . "&username=" . $user->username . "&key=test&userid=$_SESSION[userid]&remote_server=" . urlencode("http://" . $_SERVER['SERVER_NAME'] . "/$connector"
	curl_setopt($ch, CURLOPT_URL,$game_server . "get_lobby.php?template=" . $template . "&domain=$_SERVER[SERVER_NAME]&userid=" . $user->id . "&username=" . $user->username . "&key=test&userid=$_SESSION[userid]&remote_server=" . urlencode("http://" . $_SERVER['SERVER_NAME'] . "/$connector"));
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
