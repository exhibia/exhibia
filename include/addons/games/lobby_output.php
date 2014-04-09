<ul>
<?php

      $sql = db_query("select * from lobby_messages where (domain = '" . $_REQUEST['domain'] ."' or domain
      = 'www." . $_REQUEST['domain'] . "' or domain = '" . str_replace("www.", "", $_REQUEST['domain']) . "') and recipient = '" . $_REQUEST['username'] . "'");
      
      while($row = db_fetch_array($sql)){
      
	  echo "<li style=\"text-decoration:none;\" class=\"message\"><span id=\"message_$_row[id]\" style=\"text-decoration:none;\"> <ul style=\"text-decoration:none;\"> <li style=\"display:inline;font-weight:bold;\">$row[sender]</li> <li style=\"display:inline;\">$row[message]</li></ul></span> </li>";
	  
	  
	 
		      
      
      }
      
    $sql = db_query("select distinct recipient, id from lobby_messages where (domain = '" . $_REQUEST['domain']. "' or domain
      = 'www." . $_REQUEST['domain'] . "' or domain = '" . str_replace("www.", "", $_REQUEST['domain']) . "') and recipient != '" . $_REQUEST['username'] . "'");
   
 
	   
	    
	
	 
	    while($row = db_fetch_array($sql)){
	    
		if(!in_array($row['recipient'], $recipients) & !empty($row['recipient'])){
		    $recipients[] = $row['recipient'];
		    $game = db_fetch_object(db_query("select * from in_game where last_move = 'Accepted from " . addslashes($row['recipient']) . "' and domain = '" . $_REQUEST['domain'] . "' and username = '" .$_REQUEST['username'] . "' order by id desc limit"));
		//echo "select * from lobby_messages where recipient = '" . $row['recipient'] . "' and message like 'Invitation%' and sender = '" . $_REQUEST['username'] . "'";
		    if(db_num_rows(db_query("select * from in_game where username = '" . $row['recipient'] . "' and domain = '" . $_REQUEST['domain'] . "'")) == 0  ){
		    
			echo "<li style=\"text-decoration:none;\" class=\"message\" id=\"lobby_messages_" . $row['id'] . "\">
				<span id=\"message_" . $_row['id'] . "\" style=\"text-decoration:none;\">
				
				  <ul style=\"text-decoration:none;\">
				    <li style=\"display:inline;cursor:pointer;\" onclick=\"invite('" . $row['recipient'] . "', 'lobby_messages_" . $row['id'] . "');\">Invite <b style=\"color:red;\">" . $row['recipient'] . "</b> to play</li>
				  </ul>
				</span>
			      </li>";	    
		    }
		}
	    
	   
      
      }
      
      
      $sql = db_query("select * from lobby_messages where (domain = '$_REQUEST[domain]' or domain
      = 'www.$_REQUEST[domain]' or domain = '" . str_replace("www.", "", $_REQUEST['domain']) . "') and recipient = '$_REQUEST[username]' and (alert_type = 'alert' or alert_type = 'invitation') order by id desc limit 1");
	    
	      $obj_alert = db_fetch_object($sql);
	      if(!empty($obj_alert->id)){
	      
		  echo "<script>alert_button(" . $obj_alert->id . ");</script>"; 
	      
	      
	      }
?>
</ul>
<div class="clear"></div>

