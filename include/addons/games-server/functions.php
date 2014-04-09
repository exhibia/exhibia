<?php
if(!$DBSERVER){
  require("../../../config/config.inc.php");
}
  db_connect($DBSERVER,$USERNAME, $PASSWORD);
  db_select_db($DATABASENAME);
  
@db_query("CREATE TABLE IF NOT EXISTS `game_results` (
  `id` bigint(20) NOT NULL auto_increment,

  `domain` varchar(200) default NULL,
  `username` varchar(200) NOT NULL,
  `room` varchar(255) default NULL,
  `game` varchar(255) default NULL,
  `result` varchar(255) default null,
  `gameID` varchar(255) default null,
  `moves` varchar(500) default null,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");
@db_query("CREATE TABLE IF NOT EXISTS `game_payouts` (
  `id` bigint(20) NOT NULL auto_increment,

  `domain` varchar(200) default NULL,
  `username` varchar(200) NOT NULL,
  `room` varchar(255) default NULL,
  `game` varchar(255) default NULL,
  `result` varchar(255) default null,
  `gameID` varchar(255) default null,

  `time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");

@db_query("CREATE TABLE IF NOT EXISTS `api_credentials` (
  `id` bigint(20) NOT NULL auto_increment,

  `domain` varchar(200) default NULL,
  `remote_server` varchar(200) default null,
  `api_token` varchar(200) default null,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");


function game_result($array, $result, $BASE_DIR){
    include("$BASE_DIR/config/config.inc.php");
    db_connect($DBSERVER,$USERNAME, $PASSWORD);
    db_select_db($DATABASENAME);
    if(db_num_rows(db_query("select * from game_results where gameID = '$array[gameID]' and username = '$array[username]' and domain = '" . str_replace("www.", "", $array['domain']) . "'")) == 0){
   
	$moves = '';
	$sql = db_query("select * from in_game  where gameID = '$array[gameID]' and username = '$array[username]' and domain = '" . str_replace("www.", "", $array['domain']) . "' and last_move != '' and last_move != 'win' and last_move != 'lost' and last_move != 'game over'");
	while($row = db_fetch_array($sql)){
	
	    $moves .= $row['last_move'] . '|';
	
	}
   
       db_query("insert into game_results(id, domain, username, room, game, result, gameID, moves, time) values(null, '" . str_replace("www.", "", $array['domain']) . "', '$array[username]', '$array[room]', '$array[game]', '$result', '$array[gameID]', '$moves', NOW());");
     
        
        
     $fp = fopen("$BASE_DIR/include/addons/games-server/log.txt", "a");
     fwrite($fp, "delete from in_game where username = '$array[username]' and domain = '" . str_replace("www.", "", $array['domain']) . "' and gameID = '$array[gameID]'");
     fclose($fp);
     
	db_query("delete from in_game where username = '$array[username]' and domain = '" . str_replace("www.", "", $array['domain']) . "' and gameID = '$array[gameID]'");
    
	db_query("delete from connections where domain = '" . str_replace("www.", "", $array['domain']) . "' and inviter = '$array[username]' or joined = '$array[username]'");
    }


}
function do_game_cost($game, $gameID, $BASE_DIR, $username, $data_in, $domain){

  require("$BASE_DIR/config/config.inc.php");
  $db = db_connect($DBSERVER,$USERNAME, $PASSWORD);
  db_select_db($DATABASENAME, $db);
 
  $domain = str_replace("www.", "", $domain);
  $fp = fopen("$BASE_DIR/include/addons/games-server/log.txt", "w+");
  $qry = "select * from in_game where gameID = '$gameID' and username = '$username' order by id desc limit 1";
  fwrite($fp, $qry);
 	
	   
  $sql = db_query($qry);
  
  $row = db_fetch_array($sql);
  

  
    $api_token = db_fetch_array(db_query("select * from api_credentials where remote_server = '" . str_replace("www.", "", $row['domain']) . "'"));
   
    
    include("$BASE_DIR/include/addons/games-server/api/connect4.config.inc.php");
    
    
    $url = "http://" . str_replace("www.", "", $row['domain']) . "/include/addons/games-client/take_bids.php?username=" . $row['username'] . "&game=" . $row['room'] . "&take_bids=true&";
    
    $url .= "&gameID=$gameID&take_from=$connect4[take_from]&take=$connect4[take]&api_token=$api_token[api_token]";
	
	fwrite($fp, $url);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url );
	curl_setopt($ch, CURLOPT_VERBOSE, 1);

	//turning off the server and peer verification(TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURL_HTTP_VERSION_1_1, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,POSTVARSCOMPLETE);


	$response_data = array();
	$response = curl_exec($ch);

	fwrite($fp, $response);
	Fclose($fp);
	//echo curl_error($ch);
	//if(!empty($response)){
	$response_data = json_decode($response, true);
	
	//echo json_encode($response_data);
	  db_query("delete from in_game where gameID = '$gameID' and username = '$row[username]'");
	  db_query("delete from lobby_messages where (recipient = '$row[username]' or sender = '$row[username]') and sender != '$ow[domain]'");
	//  db_query("delete from lobby_messages where alert_type = 'invitation' and username = '$row[username]' and message like '%$row[room]%'");
	 // echo json_encode($response_data);
	
	// die();
	  $response_data['url'] = $url;
	  return $response_data;
	
	
     // }

  
  
}

function payout_request($array, $winner, $loser, $BASE_DIR, $gameID, $data){
include("$BASE_DIR/config/config.inc.php");
    	   $fp = fopen("$BASE_DIR/include/addons/games-server/log.txt", "a");
	   fwrite($fp, 'payout_request' . "\n");
	   fclose($fp);
	   
	   
    //take bids from loser(s) and reward winner(s)
  
  db_connect($DBSERVER,$USERNAME, $PASSWORD, $DATABASENAME);
  db_select_db($DATABASENAME);
  $domain = str_replace("www.", "", $array['domain']);
  include("$BASE_DIR/include/addons/games-server/api/connect4.config.inc.php");


  $sql = db_query("select * from in_game where gameID = '$gameID' and last_move = 'won'");
  
  
  
    $api_token = db_fetch_array(db_query("select * from api_credentials where remote_server = '" . str_replace("www.", "", $array['domain']) . "' or remote_server = '$array[domain]'"));
   
    $url = "http://" . str_replace("www.", "", $array['domain']) . "/include/addons/games-client/take_bids.php?username=" . $array['username'] . "&game=" . $array['room'] . "&take_bids=false&gameID=$gameID&reward_with=$connect4[reward_with]&reward=$connect4[reward]&api_token=$api_token[api_token]";
    
    
    
	   $fp = fopen("$BASE_DIR/include/addons/games-server/log.txt", "a");
	   fwrite($fp, $url . "\n");
	   fclose($fp);

 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url );
	curl_setopt($ch, CURLOPT_VERBOSE, 1);

	//turning off the server and peer verification(TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURL_HTTP_VERSION_1_1, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,POSTVARSCOMPLETE);


	
	$response = curl_exec($ch);
	array_push($data, json_decode($response, true));
	
	
	return $data;


}
