<?php
$str = '';

foreach($_GET as $key => $value){
if($key != 'function'){
$str .= $key . '=' . $value. '&';
}
}

$ch = curl_init();
if($_REQUEST['function'] == 'checkupdates'){

$url = "http://www.pennyauctionsoftdemo.com/UPDATES/index.php?" . $str;


	curl_setopt($ch, CURLOPT_URL,"$url");
	curl_setopt($ch, CURLOPT_VERBOSE, 1);

	//turning off the server and peer verification(TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURL_HTTP_VERSION_1_1, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POST, 1);
//	curl_setopt($ch,CURLOPT_POSTFIELDS,POSTVARSCOMPLETE);




	$response = curl_exec($ch);
	
//	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


echo curl_error($ch);


}else{


$response = file_get_contents("http://www.pennyauctionsoftdemo.com/demo-designsuite/include/addons/$_REQUEST[addon]/changes.txt");
$response = str_replace("\n", "<br />", $response);

$response .= "<br /> OR <br /><a href=\"install.php?addon=$_REQUEST[addon]&wget=" . urlencode("http://www.pennyauctionsoftdemo.com/UPDATES/index.php?zip=yes&addon=$_REQUEST[addon]") . "\">Install It</a> EXPERIMENTAL";

}


echo $response;