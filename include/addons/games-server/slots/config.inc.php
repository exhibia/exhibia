<?php


//echo $remote_server;
if(empty($remote_server)){

 if(db_num_rows(db_query("select * from sitesetting where name like 'games:slots:%'")) == 0){
$fruits = array( 0 => 'cherry', 1 => 'seven', 2 => 'orange', 3 => 'grape', 4 => 'bar', 5 => 'lemon', 6 => 'bell', 7 => 'watermelon',
		8 => 'orange', 9 => 'grape', 10 => 'bar', 11 => 'lemon',  12 => 'bell', 13 => 'watermelon',
		14 => 'orange', 15 => 'grape', 16 => 'bar', 17 => 'lemon',  18 => 'bell', 19 => 'watermelon',
		);
		
		$payouts = array(
				  'cherry' => array(3 => 5, 2=> 3, 1 => 1),
				  'seven' => array(1 => 0, 3=> 2, 2 => 1),
				  'bell' => array(1 => 0, 2=> 0, 3 => 1),
				  'lemon' => array(1 => 0, 2=> 0, 3 => 1),
				  'bar' => array(1 => 0, 2=> 0, 3 => 1),
				  'grape' => array(1 => 0, 2=> 0, 3 => 1),
				  
				  
				  'orange' => array(1 => 0, 3 => 1, 2 => 0),
				  'watermelon' => array(1 => 0, 2=> 0, 3 => 1),
			      );

	foreach($fruits as $key => $fruit){
	
	    foreach($payouts[$fruit] as $repeats => $payout){
		db_query("insert into sitesetting (id, name, value) values(null, 'games:slots:$fruit', '$repeats:$payout');");
	echo db_error();
	    }
	}
			      
}

$fruits = array();
$payouts = array();
if(empty($admin_s)){
$slot_details = 'distinct(name)';
}else{
$slot_details = 'distinct(name)';
}
$sql_f = db_query("select $slot_details from sitesetting where name like 'games:slots:%'");
    $i = 0;
    while($row_f = db_fetch_array($sql_f)){
 
	$fruit_s = explode(":", $row_f['name']);
	$fruits[$i] = $fruit_s[2];
	
	   $sql_pay = db_query("select value from sitesetting where name = 'games:slots:" . $fruit_s[2] . "' order by value asc");
	    
	    while($row_pay = db_fetch_array($sql_pay)){
	
		$payout_value = explode(":", $row_pay['value']);
		$payouts[$fruit_s[2]][$payout_value[0]] = $payout_value[1];
	    
	   }
    $i++;
    }

}else{

//Game settings go here
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"http://" . $remote_server . "/api_connector.php?game=$_REQUEST[game]&settings=true&userid=$_REQUEST[userid]");
	curl_setopt($ch, CURLOPT_VERBOSE, 1);

	//turning off the server and peer verification(TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURL_HTTP_VERSION_1_1, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,POSTVARSCOMPLETE);




	$response_game = curl_exec($ch);
	
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

$fruits = array();
$payouts = array();
$settings = get_object_vars(json_decode($response_game));
foreach($settings as $key => $value){
    $fruits[$key] = $key;
    foreach($settings[$key] as $key2 => $value2){
	
	$payouts[$key][$key2] = $value2;
    
    }
}


}
