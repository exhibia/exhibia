<?php

      //Add User to room
      if(db_num_rows(db_query("select * from lobby where username = '$_REQUEST[username]' and domain = '$_REQUEST[domain]'")) == 0){

	  db_query("insert into lobby values(null, '$_REQUEST[domain]', '$_REQUEST[username]', '$_REQUEST[room]', NOW());");
	  
	  db_query("insert into lobby_messages values(null, '$_REQUEST[domain]', '$_REQUEST[username]', '$_REQUEST[domain]', 'Welcome to $_REQUEST[domain] Games', NOW(), 'Welcome');");

      }else{

	  db_query("update lobby set time = NOW(), room = '$_REQUEST[room]' where username = '$_REQUEST[username]' and domain = '$_REQUEST[domain]'");
      }
      //Add User to room
      
      
      
      
      
      
      
      
      
    
      
      	  if(!empty($_REQUEST['room']) & empty($_REQUEST['message']) & empty($_REQUEST['invite']) & 
		empty($_REQUEST['accept']) & empty($_REQUEST['check_bids'])){
	    

	       if($_REQUEST['min_players'] > 1 & $_REQUEST['max_players'] > 1){
	    
     
		
		    if($_REQUEST['room'] != 'lobby' & db_num_rows(db_query("select * from lobby_messages where recipient = '$_REQUEST[username]' and domain = '$_REQUEST[domain]' and sender = '$_REQUEST[domain]' and message = 'You have joined $_REQUEST[room]. Wait for someone to join you or invite a partner.' order by id desc limit 1")) == 0 ){
		    
			    db_query("insert into lobby_messages(id, domain, recipient, sender, message, time, alert_type)  values(null, '$_REQUEST[domain]', '$_REQUEST[username]', '$_REQUEST[domain]', 'You have joined $_REQUEST[room]. Wait for someone to join you or invite a partner.', NOW(), 'Standby');");
		      }				  
	

		      }else{ //single player game
		      
			    db_query("insert into lobby_messages(id, domain, recipient, sender, message, time, alert_type) values(null, '$_REQUEST[domain]', '$_REQUEST[username]', '$_REQUEST[domain]', 'You have joined $_REQUEST[game]. This is a single player game, you may begin now.', NOW(), 'Begin Single Player Game');");
		      
		      }
	     
	  }else{
	    $data = array();
		//message and invite
			  if(!empty($_REQUEST['accept']) | !empty($_REQUEST['check_bids'])){
			  $uniqueid = uniqid();
			  
			  //    if(db_num_rows(db_query("select * from in_game where domain = '$_REQUEST[domain]' and room = '$_REQUEST[room]' and username = '$_REQUEST[username]'")) == 0){
			      //inviter
				 
				    echo db_error();
				  
				 if(!empty($_REQUEST['accept'])){ 
					db_query("delete from lobby_messages where recipient='$_REQUEST[username]' and alert_type='invitation' and sender = '$_REQUEST[accept]'");
					
					db_query("insert into connections values(null, '". str_replace("www.", "", $_REQUEST['domain']) . "', '$_REQUEST[username]', '$_REQUEST[accept]', NOW());");
				  
				  
				  }
				  
				  
			
			
			      if(!empty($_REQUEST['gameID'])){
			      
			      
			      if(!empty($_REQUEST['accept'])){
				  db_query("delete from lobby_messages where (recipient='$_REQUEST[username]' or sender='$_REQUEST[username]') and (alert_type='accepted' or alert_type='invitation') and (sender = '$_REQUEST[accept]' or recipient='$_REQUEST[accept]')");
				    
				    if(db_num_rows(db_query("select * from in_game where last_move = 'Accepted from $_REQUEST[accept]' and gameID = '$_REQUEST[gameID]'")) == 0 ){
				    
					db_query("insert into in_game values(null, '$_REQUEST[domain]', '$_REQUEST[username]', '$_REQUEST[room]', NOW(), '$_REQUEST[gameID]', 'Accepted from $_REQUEST[accept]');");
				      
					  db_query("insert into lobby_messages(id, domain, recipient, sender, message, time, alert_type) values(null, '$_REQUEST[domain]', '$_REQUEST[accept]', '$_REQUEST[username]', 'Game will begin shortly', NOW(), 'accepted:$_REQUEST[username]');");
				    }
				 }
				  echo db_error();
				  $players =  db_num_rows(db_query("select * from in_game where gameID='$_REQUEST[gameID]'"));
				  
				 
				  
				  
				  $data = array(
						"id" => $_REQUEST['gameID'],
						"opponent" => $_REQUEST['opponent'],
						"whos_turn" => $_REQUEST['opponent'],
						"players" => $players
					    );
					    
				  
			     
			  
			     
			      
			      
				if(db_num_rows(db_query("select * from lobby_messages where alert_type = 'accepted' and sender = '$_REQUEST[username]' and recipient='$_REQUEST[accept]'")) == 0){
				
				
					   
					db_query("insert into lobby_messages(id, domain, recipient, sender, message, time, alert_type) values(null, '$_REQUEST[domain]', '$_REQUEST[accept]', '$_REQUEST[username]', 'Invitation accepted by $_REQUEST[username]<script type=\"text/javascript\">letsbegin(\'$_REQUEST[username]\', \'" . $_REQUEST['gameID'] . "\');</script>', NOW(), 'accepted');");
					
					db_query("insert into lobby_messages(id, domain, recipient, sender, message, time, alert_type) values(null, '$_REQUEST[domain]', '$_REQUEST[username]', '$_REQUEST[accept]', 'Invitation accepted by $_REQUEST[accept]<script type=\"text/javascript\">letsbegin(\'$_REQUEST[accept]\', \'" . $_REQUEST['gameID'] . "\');</script>', NOW(), 'accepted');");
					
					
				    
				  
					db_query("insert into lobby_messages(id, domain, recipient, sender, message, time, alert_type) values(null, '$_REQUEST[domain]', '$_REQUEST[accept]', '$_REQUEST[username]', 'Game will begin shortly', 'accepted:$_REQUEST[username]');");
					
					    $players = db_num_rows(db_query("select * from in_game where gameID='$_REQUEST[gameID]'"));;
					    $data = array(
							  "id" => $_REQUEST['gameID'],
							  "opponent" => $_REQUEST['opponent'],
							  "whos_turn" => $_REQUEST['username'],
							  "players" => $players
						      );
					    
				    }
				
			      
			      }
			      if($players >= $_REQUEST['min_players']){
				$data['game'] = 'true'; 
				
				if($players == $_REQUEST['max_players'] & db_num_rows(db_query("select * from in_game where (last_move like 'Invitation%' or last_move like 'Accepted%') and gameID = '$_REQUEST[gameID]'")) == $_REQUEST['max_players'] & db_num_rows(db_query("select * from in_game where (last_move != 'win' and last_move != 'lost') and gameID = '$_REQUEST[gameID]'"))){
				//charge bid account to get into the game
				    
				    
				    $sql = db_query("select * from in_game where gameID = '$_REQUEST[gameID]' where (last_move like 'Invitation%' or last_move like 'Accepted%') order by id desc limit 1");
				    
				    while($row = db_fetch_array($sql)){
					request_payout_data($row);
				    }
				
				
				
				}
			      
			      }
				
			     echo $_REQUEST['callback'] . "(" . json_encode($data) . ")";
			    exit;
			  }else
			  if(!empty($_REQUEST['invite'])){
				      $last = db_fetch_object(db_query("select * from lobby_messages where recipient = '$_REQUEST[invite]' order by id desc limit 1"));
				      
				      $uniqid = uniqid();
				      if(db_num_rows(db_query("select * from lobby_messages where recipient = '$_REQUEST[invite]' and sender = '$_REQUEST[username]' and alert_type = 'invitation'")) == 0){
				      
					db_query("insert into in_game values(null, '" .addslashes($_REQUEST['domain']) . "', '" . addslashes($_REQUEST['username']) . "', '" . addslashes($_REQUEST['room']) . "', NOW(), '" . $uniqid . "', 'Invited " . addslashes($_REQUEST['invite']) ."');");
				      
				       
					db_query("insert into lobby_messages(id, domain, recipient, sender, message, time, alert_type) values(null, '$_REQUEST[domain]', '$_REQUEST[invite]', '$_REQUEST[username]', '<span style=\"color:red;\">$_REQUEST[username] has invited you to room: $_REQUEST[room]. Click <a href=\"javascript:accept(\'$_REQUEST[username]\', \'" . $uniqid . "\');\">Here</a> to accept.</span>', NOW(), 'invitation');");
					
				    }
					
			      }else if(!empty($_REQUEST['message'])){

				    db_query("insert into lobby_messages(id, domain, recipient, sender, message, time, alert_type) values(null, '$_REQUEST[domain]', '$_REQUEST[recipient]', '$_REQUEST[username]', '" . addslashes($_REQUEST['message']) . "<script>alert_button(\'" . $last->id . "\');</script>', NOW(), 'invitation');");
			      }
		
	}