<?php
require("../../../../config/config.inc.php");

ini_set('display_errors', 1);
$error = '';

if($_REQUEST['time_b'] == '24:00:00'){
$_REQUEST['time_b'] = '00:00:01';
$_REQUEST['day_once'] = date("Y-m-d", strtotime($_REQUEST['day_once'])  + (24*3600) );
}

db_query("alter table bingo_games add column timestamp bigint(22) null;");

if(isset($_REQUEST['deletegame'])){


    db_query("update bingo_games set finished = 2 where name = '" . addslashes($_REQUEST['name']) . "'" );

}else
if(isset($_REQUEST['addgame']) | isset($_REQUEST['editgame'])){
    if(db_num_rows(db_query("select * from bingo_games where time_b='$_REQUEST[time_b]' and date='$_REQUEST[day_once]'")) >=1 ){
    $error .= "You already have a game running at $_REQUEST[time_b] $_REQUEST[day_once] Please choose another time";
    
    }
      if(empty($_REQUEST['name'])){
	$error .= "Please name your game";
      }

    if(!empty($error)){
      echo $error;

      }else{
      
      
      	    $days = '';

	      foreach($_REQUEST['day'] as $key => $value){
		if(!in_array($value,$days_shown)){
		//echo "$key => $value<br />";
		    $days_shown[] = $value;
		      $days .= $value . ":";
		
		}

	      }	
	
	
	@db_query("CREATE TABLE IF NOT EXISTS `bingo_games` (
	  `id` bigint(20) unsigned NOT NULL auto_increment,
	  `name` text NOT NULL,
	  `cost_per_card` int(11) NOT  NULL,
	   `which_to_take` varchar(200) not null,
	  `min_cards`  int(11) NOT NULL,
	  `max_cards`  int(11) NOT NULL,
	  `time_b` time NOT NULL,
	  `date` date NULL,
	  `days` text not null,
	  PRIMARY KEY  (`id`)
	  
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");
	@db_query("CREATE TABLE IF NOT EXISTS `bingo_jackpots` (
	  `id` bigint(20) unsigned NOT NULL auto_increment,

	  `bingo_id` bigint(20) unsigned NOT NULL,
	  `place` varchar(200) not null,
	  `reward_points` int(11) NOT  NULL,
	  `which_to_give` varchar(200) NOT NULL,
	  `productID`  int(11) NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");
	@db_query("alter table bingo_games add column min_players int(11) null");
	
	
	if(db_num_rows(db_query("select * from bingo_games where name = '" .addslashes($_REQUEST['name']) . "'")) >= 1){
	  //  db_query("delete from bingo_games where name = '" .addslashes($_REQUEST['name']) . "'");
	      db_query("update bingo_games set time_b='$_REQUEST[time_b]', day_once = '$_REQUEST[day_once]', min_players = '$_REQUEST[min_players]', cost_per_card = '$_REQUEST[cost_per_card]', min_cards = '$_REQUEST[min_cards]', max_cards = '$_REQUEST[max_cards]', timestamp = '" . strtotime($_REQUEST['day_once'] . " " . $_REQUEST['time_b']) . "' where name = '$_REQUEST[game_name]'");
	}

	if(empty($_REQUEST['day_once'])){
	  $_REQUEST['day_once'] = date("Y-m-d");
	}
	

	  $date = explode("/", $_REQUEST['day_once']);
	  $_REQUEST['day_once'] = $date[2] . "/" . $date[0] . "/" .$date[1];

	
	    db_query("insert into bingo_games(id, name, cost_per_card, min_cards, max_cards, which_to_take, time_b, date, min_players, days,timestamp) values(null, '" . addslashes($_REQUEST['name']) . "', '$_REQUEST[cost_per_card]', '$_REQUEST[min_cards]', '$_REQUEST[max_cards]', '$_REQUEST[which_to_take]', '$_REQUEST[time_b]', '$_REQUEST[day_once]', '$_REQUEST[min_players]', '$days', '" . strtotime($_REQUEST['day_once'] . " " . $_REQUEST['time_b']) . "');");
	    $id = db_insert_id();

	if(!empty($_REQUEST['bingo_id']) & $_REQUEST['running'] == 'true'){
	      $users = db_query("select distinct(r.email) from bingo_user_data left join registration r on r.id = bingo_user_data.userid");
	      while($row_u = db_fetch_array($users)){
		  mail($row_u['email'], 'Attention Your Game Has Changed', $SITE_NM . ' has changed the link to your Bingo Game. The new link is ' . $SITE_URL . 'bingo.php?game=' . $id, null, '-f support@' . $_SERVER['SERVER_NAME']);
	      
	      }
	      db_query("update bingo_user_data set instance = '$id' where instance = '$_REQUEST[bingo_id]'");
	      
	}
	
	  

echo db_error();

	    foreach($_REQUEST['productID'] as $key => $value){
		db_query("insert into bingo_jackpots(id, place, bingo_id, productID) values(null, '$key', $id, $value);");

	    }
	    foreach($_REQUEST['reward_per_card'] as $key => $value){
		db_query("insert into bingo_jackpots(id, place, bingo_id, reward_points, which_to_give) values(null, '$key', $id, $value, '" . $_REQUEST['which_to_give'][$key] . "');");


	    }
	    
	
    
    }
 }