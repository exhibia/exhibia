<?php
header("Access-Control-Allow-Origin: *");
//header("Accept: text/html, text/javascript, text/json");
//header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS"); 
//header("Access-Control-Allow-Headers: text/json"); 
	    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
	    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	    header("Cache-Control: post-check=0, pre-check=0", false);
	    header("Pragma: no-cache");
	    
ini_set('display_errors', 1);
if(!empty($_REQUEST['loser'])){
    $_REQUEST['username'] = $_REQUEST['loser'];
}else if(!empty($_REQUEST['winner'])){
    $_REQUEST['username'] = $_REQUEST['winner'];
}

	    
require("../../../../config/config.inc.php");
db_connect($DBSERVER,$USERNAME, $PASSWORD, $DATABASENAME);
db_select_db($DATABASENAME);

require("$BASE_DIR/include/addons/games-server/functions.php");
$data = array();




@db_query("alter table in_game add column last_move varchar(200);");

		
function get_game_cost($game, $gameID, $BASE_DIR, $check = 'false', $data){
global $BASE_DIR;
  require("$BASE_DIR/config/config.inc.php");
  db_connect($DBSERVER,$USERNAME, $PASSWORD,$DATABASENAME);
  db_select_db($DATABASENAME);
   
  $qry = "select distinct username, domain from in_game where gameID = '$gameID'";
  $data = array();
  $data['debug'] = $qry;
  
  $sql = db_query($qry);
  
  while($row = db_fetch_array($sql)){
 
    $domain = str_replace("www.", "", $row['domain']);
  
    $api_token = db_fetch_array(db_query("select * from api_credentials where remote_server = '$domain'"));
   
    
    include("$BASE_DIR/include/addons/games-server/api/connect4.config.inc.php");
    
    
    $url = "http://" . $domain . "/include/addons/games-client/take_bids.php?username=" . $row['username'] . "&game=" . $row['room'] . "&take_bids=true&";
   
    if($check == 'true'){ 
      $url .= "check=true";
    }
      $url .= "&gameID=$gameID&take_from=$connect4[take_from]&take=$connect4[take]&api_token=$api_token[api_token]";

      $data['url'] = $url;
 
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

	
	if(!empty($response)){
	
	    $response_data = json_decode($response, true);
	    if($response_data['error'] == 'Not Enough Bids' | $response_data['error'] == 'Not Enough Free Bids'){
		db_query("delete from in_game where gameID = '$gameID' and username = '$row[username]'");
		db_query("delete from lobby_messages where alert_type = 'invitation' and username = '$row[username]' and message like '%$row[room]%'");
		
		
		$data['game'] = 'you do not have enough ' . ucwords(str_replace("_", " ", $connect4['take_from']));
		  
		echo $_REQUEST['callback'] . "(" . json_encode($data) . ")";
		exit;	    
	    
	    }else{
	    
		return true;
	    
	    
	    }
	
	
	}
	
	
    }


}


db_connect($DBSERVER,$USERNAME, $PASSWORD);
db_select_db($DATABASENAME);	  
	  

$data['did_we_go'] = 'yes';

$game = db_fetch_object(db_query("select * from in_game where gameID = '$_REQUEST[gameID]' and username = '$_REQUEST[username]' order by id asc limit 1"));


$data['room'] = $game->room;
$data['debug'] = "select * from in_game where gameID = \'$_REQUEST[gameID]\' and username = \'$_REQUEST[username]\' order by id asc limit 1";
$data['chips']['black'] = array();
$data['chips']['red'] = array();
		
		

	   if(!empty($_REQUEST['winner']) | !empty($_REQUEST['loser'])){
		$data['game'] = 'game over';
		header('Content-Type: application/json');
		
		if(!empty($_REQUEST['winner'])){
		
		
		
		 
		   if(db_num_rows(db_query("select * from in_game where username = '$_REQUEST[winner]' and gameID = '$_REQUEST[gameID]' and last_move = 'won'")) == 0 ){
		    db_query("insert into in_game(id, domain, username, time, room, last_move, gameID) values(null, '" . str_replace("www.", "", $_REQUEST['domain']) . "', '$_REQUEST[winner]', NOW(), '" . addslashes($_REQUEST['room']) . "', 'won', '$_REQUEST[gameID]');");
		   }
		   
		}
		else
		if(!empty($_REQUEST['loser'])){
		
		
		
		
		  if(db_num_rows(db_query("select * from in_game where username = '$_REQUEST[loser]' and gameID = '$_REQUEST[gameID]' and last_move = 'lost'")) == 0 ){
		    db_query("insert into in_game(id, domain, username, time, room, last_move, gameID) values(null, '" . str_replace("www.", "", $_REQUEST['domain']) . "', '$_REQUEST[loser]', NOW(), '" . addslashes($_REQUEST['room']) . "', 'lost', '$_REQUEST[gameID]');");
		  }
		
		}
		 
		if(db_num_rows(db_query("select * from in_game where gameID = '$_REQUEST[gameID]' and last_move = 'won' or last_move = 'lost'")) >0){
		
		//$data['game'] = 'game over';
		
		    $winner = db_fetch_object(db_query("select * from in_game where gameID = '$_REQUEST[gameID]' and last_move = 'won'"));
		
		
		    $data['winner'] = $winner->username;
		    $data['chips'] = array();
		    
			 
			 if(empty($_REQUEST['winner'])){
				 
				    $data['payout_request'] = 'true';
					
				   $sql = db_query("select * from in_game where gameID = '$_REQUEST[gameID]' and username = '$_REQUEST[loser]' and last_move = 'lost' order by id desc limit 1");
				    
				      while($row = db_fetch_array($sql)){
					//	 print_r($row);
				          
					$bids = do_game_cost($game, $_REQUEST['gameID'], $BASE_DIR, $row['username'], $row['domain']);
					game_result($row, 'lost', $BASE_DIR);
					
					   
				    
				       db_query("delete from in_game where username = '$row[username]' and domain = '" . str_replace("www.", "", $row['domain']) . "' and gameID = '$row[gameID]'");
				       db_query("delete from lobby_messages where username = '$row[username]' and domain = '" . str_replace("www.", "", $row['domain']) . "'");
						      
				      }
				}else{      
				    $sql = db_query("select * from in_game where gameID = '$_REQUEST[gameID]' and username = '". $winner->username . "' and last_move != 'lost' order by id desc limit 1");
				    
				    
				    while($row = db_fetch_array($sql)){
			
					payout_request($row, $winner->username, $_REQUEST['opponent'], $BASE_DIR, $_REQUEST['gameID'], $data);
					
					
					$bids = do_game_cost($game, $_REQUEST['gameID'], $BASE_DIR, $winner->username, $_REQUEST['domain']);
					game_result($row, 'won', $BASE_DIR);
					
					db_query("insert into in_game values(null, '$_REQUEST[domain]', '$_REQUEST[username]', '$_REQUEST[room]', NOW(), '$_REQUEST[gameID]', 'won'");
     
					      db_query("delete from in_game where username = '$row[username]' and domain = '" . str_replace("www.", "", $_REQUEST['domain']) . "' and gameID = '$row[gameID]'");
					      db_query("delete from lobby_messages where username = '$row[username]' and domain = '" . str_replace("www.", "", $row['domain']) . "'");
					
				    }     
					
					$data['winner'] = $winner->username;
						
			      }
			 
			 
			   
			    
		   
		  //  die();
		
		
		}
			  $data['url'] = $bids['url'];
			  $data['final_bids'] = $bids['final_bids'];
			  $data['free_bids'] = $bids['free_bids'];
		
		 echo $_REQUEST['callback'] . "(" . json_encode($data) . ")";
		 exit;
		
	  }else{

		if(db_num_rows(db_query("select * from in_game where (last_move like 'Accepted%' or last_move like 'Invited%') and gameID='$_REQUEST[gameID]'")) == $_REQUEST['min_players']){
	
		    /*  $fp = fopen("$BASE_DIR/include/addons/games/log.txt", "a");
			fwrite($fp, 'Accept invite '. "\n");
			fclose($fp); */
			    $begin = get_game_cost($_REQUEST['game'], $_REQUEST['gameID'], $BASE_DIR, 'true', $data);
		    
	  
		      
		   
	  
		//    db_query("delete from from in_game where gameID = '$_REQUEST[gameID]' and username = '$_REQUEST[username]' and alert_type = 'invitation'");
		    
		}
	    $data['game'] = 'running';
		
		if(!empty($_REQUEST['move'])){
		      
					      
			 db_query("insert into in_game(id, domain, username, time, room, last_move, gameID) values(null, '" . str_replace("www.", "", $_REQUEST['domain']) . "', '$_REQUEST[username]', NOW(), '" . addslashes($game->room) . "', '$_REQUEST[move]', '$_REQUEST[gameID]');");
						  
						  
			  $new_user = db_fetch_object(db_query("select * from in_game where gameID = '$_REQUEST[gameID]' and username != '$_REQUEST[username]' order by id asc limit 1"));
			  
			  $data['whos_turn'] = $new_user->username;

		      }
		      $row = db_fetch_object(db_query("select * from in_game where username != '$_REQUEST[username]' and gameID = '$_REQUEST[gameID]' order by id asc limit 1"));


					    $data = array(
							  "id" => $_REQUEST['gameID'],
							  "opponent" => $row->username,
							
						      );
						      
					      
			      $last_move = db_fetch_object(db_query("select * from in_game where last_move != '' and last_move != '' and last_move != 'won' and last_move != 'lost' and gameID = '$_REQUEST[gameID]' order by id desc limit 1")); 
			    
			      
			      $data['last_move'] = $last_move->last_move;
			      
			      
			      $whos_turn = db_fetch_object(db_query("select * from in_game where gameID = '$_REQUEST[gameID]' and username != '$_REQUEST[username]' order by id desc limit 1"));
			   
			      if(empty($data['whos_turn'])){
			      
			      if($last_move->username == $_REQUEST['username'] ){
			      
				 
				  
				
				
				  $data['whos_turn'] = $whos_turn->username;
			      
			      }else{
			   
				  $data['whos_turn'] = $_REQUEST['username'];
			      
			      }
			      }
			
				$data['players'] = db_num_rows(db_query("select distinct(username) from in_game where gameID='$_REQUEST[gameID]'"));
				
		//	
			      if($data['players'] >= $_REQUEST['min_players']){
				$data['game'] = 'true'; 
				
				
			      }
			      
			    $data['chips'] = array();
			    $data['chips']['black'] = array();
			    $data['chips']['red'] = array();
			    
			    $sql = db_query("select distinct(last_move), username from in_game where gameID = '$_REQUEST[gameID]' and (last_move != '' and last_move != 'won' and last_move != 'lost') and (last_move not like 'Accepted%' and last_move not like 'Invited%') order by last_move desc");
			    
			  
			    
			    while($row = db_fetch_array($sql)){
				  if($row['username'] == $_REQUEST['username']){
				    $data['chips']['red'][] = $row['last_move'];
				  }else{
				    $data['chips']['black'][] = $row['last_move'];
				  
				  }
			    
			    }
			    
			    if($begin == true){
			    
			    $data['game'] = 'start';
			    }
			     $sql = db_query("select distinct(last_move), username from in_game where gameID = '$_REQUEST[gameID]' and (last_move != '' and last_move != 'won' and last_move != 'lost') and (last_move not like 'Accepted%' and last_move not like 'Invited%') order by last_move desc");
			    
			    
			    while($row = db_fetch_array($sql)){
				  if($row['username'] == $_REQUEST['username']){
				  
				    $data['chips']['red'][] = $row['last_move'];
				  }else{
				    $data['chips']['black'][] = $row['last_move'];
				  
				  }
			    
			    }  
		   echo $_REQUEST['callback'] . "(" . json_encode($data) . ")";
		    exit;
		}