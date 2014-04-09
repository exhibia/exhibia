<?php


	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL,"http://pennyauctionsoftdemo.com/LANGUAGEPACKS/index.php?lang=$_REQUEST[lang]");
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

if($httpCode == 404) {

 echo '{"message":"ok","title":"Penny Auction Soft Tutorials", "text":"This Feature Is Currently Under Development"}';


}else{
if(!empty($response)){

echo $response;
}else{


echo '{"message":"ok","title":"Penny Auction Soft Tutorials", "text":"This Feature Is Currently Under Development But Does Not Require Any Updates"}';

}
}
?>