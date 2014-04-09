<?php
include("../config/config.inc.php");

$ch = curl_init();
if($_REQUEST['type'] == 'templates'){
if(empty($_REQUEST['just_list'])){

    $url = $license_server . "/licenseadminpanel/templates/index.php";
    }else{
    
    $url = $license_server . "/licenseadminpanel/templates/index.php?just_list=true";
    
    }

}else{
    if(empty($_GET['url'])){
	$url = str_replace("www.", "", $download_server) . "/TUTORIALS/index.php?page=$_REQUEST[page]&element=$_REQUEST[element]";
    }else{
	$url = str_replace("www.", "", urldecode($_REQUEST['url']));
    }
}


	curl_setopt($ch, CURLOPT_URL,"$url");
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
	
	
if(empty($_REQUEST['url'])){
if($httpCode == 404) {

 echo '{"message":"ok","title":"Penny Auction Soft Tutorials", "text":"This Feature Is Currently Under Development<br /> We ask your help to complete this addon by telling us which ipunts you would like more info about"}';


}else{
      if(!empty($response) ){ 

      echo $response;
	  }else{
	      
		
		echo '{"message":"ok","title":"Penny Auction Soft Tutorials", "text":"This Feature Is Currently Under Development But Does Not Require Any Updates"}';
		
	  }
      }
      
 }else{
 

      echo $response;
 
 }
?>