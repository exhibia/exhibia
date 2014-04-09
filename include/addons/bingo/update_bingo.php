<?php
$i = 0;
ini_set("max_execution_time", 0);
ini_set("memory_limit", 0);

include("../../../config/config.inc.php");
include("$BASE_DIR/Functions/update_users_bids.php");
@db_query("alter table bingo_winners add column paid varchar(200) null");
@db_query("alter table bingo_winners add column user_data_id int(22) null");
@db_query("CREATE TABLE IF NOT EXISTS `bingo_numbers` (
				      `id` bigint(20) unsigned NOT NULL auto_increment,
				      `instance` varchar(200) not null,
				      `bingo_id` varchar(200) not null,
				      `number`  varchar(200) NOT NULL,
				      
				      PRIMARY KEY  (`id`)
				      
				    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");
				    
function unique_number($array){
  $letters = array("B", "I", "N", "G", "O");
	  $rand_letter = $letters[rand(0,4)];
	  switch($rand_letter){
				case 'B':
				$top = 15;
				$bottom = 1;
				break;
				case 'I': 
				$top = 30;
				$bottom = 16;
				break;
				case 'N':
				$top = 45;
				$bottom = 31;
				break;
				case 'G':
				$top = 60;
				$bottom = 46;
				break;
				case 'O':
				$top = 75;
				$bottom = 61;
				break;
	}
	
		$number = rand($top,$bottom);
	     return $rand_letter . '-' . $number;
}

class TextToSpeech {
    public $mp3data;
    function __construct($text="") {
        $text = trim($text);
        if(!empty($text)) {
            $text = urlencode($text);
            $this->mp3data = file_get_contents("http://translate.google.com/translate_tts?ie=UTF-8&q=$text&tl=en&total=1&idx=0&textlen=12&prev=input");
        }
    }

    function setText($text) {
        $text = trim($text);
        if(!empty($text)) {
            $text = urlencode($text);
            $this->mp3data = file_get_contents("http://translate.google.com/translate_tts?ie=UTF-8&q=$text&tl=en&total=1&idx=0&textlen=12&prev=input");
            return $mp3data;
        } else { return false; }
    }

    function saveToFile($filename) {
        $filename = trim($filename);
        if(!empty($filename)) {
            return file_put_contents($filename,$this->mp3data);
        } else { return false; }
    }

}



class  System {
    function  currentTimeMillis() {
        list($usec,  $sec)  =  explode("  ",microtime());
        return  $sec.substr($usec,  2,  3);
    }
}
class  NetAddress1 {
    var  $Name  =  'localhost';
    var  $IP  =  '127.0.0.1';
    function  getLocalHost()  //  static
    {
        $address  =  new  NetAddress1();
        $address->Name  =  $_ENV["COMPUTERNAME"];
        $address->IP  =  $_SERVER["SERVER_ADDR"];
        return  $address;
    }
    function  toString() {
        return  strtolower($this->Name.'/'.$this->IP);
    }
}
class  Random {
    function  nextLong() {
        $tmp  =  rand(0,1)?'-':'';
        return  $tmp.rand(1000,  9999).rand(1000,  9999).rand(1000,  9999).rand(100,  999).rand(100,  999);
    }
}

class  Guid {
    var  $valueBeforeMD5;
    var  $valueAfterMD5;
    function  Guid() {
        $this->getGuid();
    }
    //
    function  getGuid() {
        $address  =  NetAddress1::getLocalHost();
        $this->valueBeforeMD5  =  $address->toString().':'.System::currentTimeMillis().':'.Random::nextLong();
        $this->valueAfterMD5  =  md5($this->valueBeforeMD5);
    }
    function  newGuid() {
        $Guid  =  new  Guid();
        return  $Guid;
    }
    function  toString() {
        $raw  =  strtoupper($this->valueAfterMD5);
        return  substr($raw,0,8).'-'.substr($raw,8,4).'-'.substr($raw,12,4).'-'.substr($raw,16,4).'-'.substr($raw,20);
    }
}





function payout($place, $winner, $instance, $divisor){
echo "The winner is " . $winner . "\n";



include("../../../config/config.inc.php");
    $card_info = db_fetch_array(db_query("select * from bingo_games left join bingo_jackpots bj on bj.bingo_id=bingo_games.id where bingo_games.id = '$instance' and place = '$place'"));
   
    $game = db_fetch_object(db_query("select * from bingo_games where id = '$instance' order by id desc limit 1"));
    $jackpot= db_fetch_object(db_query("select * from bingo_jackpots where instance = '$instance' and place = '$place' order by id desc limit 1"));
    
    $user = db_fetch_array(db_query("select * from registration where id = '$winner'"));
    
    if(!empty($card_info['productID'])){
	  $row = db_fetch_array(db_query("select * from products where productID = '$card_info[productID]'"));
	  
	  $guid = substr( strtoupper( time() . $instance ),0,8 ).'-'.substr( strtoupper(md5($row['name'])),0,4).'-'.substr(strtoupper(md5($winner . $place . $card_info['productID'])),0,4).'-'.substr(strtoupper(md5($user['email'] .time())),0,4).'-'.substr(strtoupper(md5($row['short_desc'])),0, 12);
	
	 
	
	  db_query("INSERT INTO payment_order_history(orderid,userid,amount,shippingcharge,itemid,itemname,itemdescription,payfor,paymentway,datetime, auction_id) values('" . $guid . "','" . $user['id'] . "','0','0','" .$row['productID'] . "','" . addslashes($row['name']) . "','" . addslashes(substr((str_replace("<br />", "", $row['short_desc']))), 0, 200) . "','Won Bingo','$place',NOW(), $instance);");
    
    }
    if(!empty($card_info['which_to_give'])){
    if(!empty($card_info['reward_points'])){
   
   
      
      echo db_error();
      $divisor_h = db_num_rows(db_query("select winner from bingo_winners where instance = $instance and place = '$place'"));
      
     $sql_u = db_query("select distinct(userid) from bingo_user_data where instance = $instance");
							$total_cards = 0;
		
							
					while($row_u =db_fetch_array($sql_u)){
						print_r($row_u);
						$count_cards = db_fetch_array(db_query("select count(distinct(card)) from bingo_user_data where instance = $instance and userid=$row_u[userid]"));
							   
							   echo "$row_u[userid] has " . $count_cards[0] . "\n";
							   
							    $total_cards = number_format($total_cards, 0, '', '') + number_format($count_cards[0], 0 , '', '');
							    
							}
							
							$total = round((($total_cards * $card_info['cost_per_card']) * $card_info['reward_points']) / 100);
							
							$total = round($total / $divisor_h);
							
							echo "\ntotal cards " . $total_cards . "\n"; 
							echo "cost per card " .$card_info['cost_per_card'] . "\n"; 
							echo "reward_points " . $card_info['reward_points'] . "\n";
							echo "total " . $total . "\n";
							echo " divisor " . $divisor_h . "\n";
    
	}else{
	
	$total = 0;
	
	
	}
	if(!empty($card_info['which_to_give'])){
	  $which = $card_info['which_to_give'];
	}else{
	  $which = 'free_bids';
	}
	if($which == 'free_bids'){
	
	    $sql = "insert into free_account values(null, '$user[id]', '', NOW(), '$total', '',  '',  'c', '0.00', '', '$instance', '', '', 'For Winning Bingo');";
	    
	}else{
	
	    $sql = "insert into bid_account values(null, '$user[id]', '', NOW(), '$total', '',  '',  'c', '0.00', '', '$instance', '', '', 'For Winning Bingo');";
	
	}
echo $sql . "\n";
	    db_query($sql);
	update_users_bids($user['id']);
	
	
	mail($user['email'], 'Congratulations '. $user['username'], "You won $place Place at Bingo on $SITE_NM" . " Your " . ucwords(str_replace("_" , " " , $which)) . " has been credited " . $total . " Points.", null, '-f support@' . $_SERVER['SERVER_NAME']);
    }

}
function get_other_winners($place, $number, $winner, $bud_id, $instance, $name){
    $sql = db_query("select * from bingo_user_data left join registration r on r.id=bingo_user_data.userid where ((userid = r.id and card != '$bud_id') or userid != r.id) and number = '$number' and instance = '$instance' and winner = 1 and marked = 1");
    while($row = db_fetch_array($sql)){
    
    
	  if(db_num_rows(db_query("select * from bingo_winners left join registration r on r.id=bingo_winners.userid where number = '$number' and instance = '$instance' and winner = '$row[username]' and bingo_user_data = $row[card] and place = '$place'")) == 0){
			$winning_numbers = '';
		/*	$sql_h = db_query("select * from bingo_user_data where card = '$row[card]' and instance = '$instance' and userid = '$row[userid]' and $diagonal order by number asc");
			
			    while($row_h = db_fetch_array($sql_h)){
				$winning_numbers .= ':' . $row_h['number'];
			    }	*/
	db_query("insert into bingo_winners values(null, '$instance', '$number', '$row[username]', '$place', '" . addslashes($name['name']) . "', '$dir', '$winning_numbers', '', '$row[card]');");
	}
    }
    
    
        $sql = db_query("select * from bingo_user_data left join registration r on r.username='$winner' and r.id=bud.userid where (userid = r.id and card != '$bud_id') and number = '$number' and instance = '$instance' and winner = 1 and marked = 1");
	while($row = db_fetch_array($sql)){
	   if(db_num_rows(db_query("select * from bingo_winners left join registration r on r.id='$winner' where number = '$number' and instance = '$instance' and winner = '$row[username]' and bingo_user_data = $row[card] and place = '$place'")) == 0){
	    
		  db_query("insert into bingo_winners values(null, '$instance', '$number', '$row[username]', '$place', '" . addslashes($name['name']) . "', '$dir', '$winning_numbers', '', '$row[card]');");
	   }
	}
}




function first_place($instance, $number, $name, $dir, $winning_numbers, $winner, $bud_id){
	
	    db_query("insert into bingo_winners values(null, '$instance', '$number', '$winner', 'first', '" . addslashes($name['name']) . "', '$dir', '$winning_numbers', '', $bud_id);");
	    get_other_winners('first', $number, $winner, $bud_id , $instance, $name);

}
function second_place($instance, $number, $name, $dir, $winning_numbers, $winner, $bud_id){

	    	    db_query("insert into bingo_winners values(null, '$instance', '$number', '$winner', 'second', '" . addslashes($name['name']) . "', '$dir', '$winning_numbers', '', $bud_id)");
	    	    get_other_winners('second', $number, $winner, $instance, $name);

}
function third_place($instance, $number, $name, $dir, $winning_numbers, $winner, $bud_id){

	      db_query("insert into bingo_winners values(null, '$instance', '$number', '$winner', 'third', '" . addslashes($name['name']) . "', '$dir', '$winning_numbers', '', $bud_id)");
	      get_other_winners('third', $number, $winner, $bud_id, $instance, $name);

}
function check_winners($instance, $winner, $number, $game_id, $dir, $winning_numbers, $bud_id){
@db_query("alter table bingo_winners add column game_name varchar(500) null;");
@db_query("alter table bingo_winners add column dir varchar(500) null;");
@db_query("alter table bingo_winners add column winning_numbers varchar(500) null;");
$name = db_fetch_array(db_query("select * from bingo_games where id = '$instance'"));
$num_winners = db_num_rows(db_query("select * from bingo_winners where instance = '$instance' and number != '$number'"));
    
    if(db_num_rows(db_query("select * from bingo_winners where winner = '$winner' and dir = '$dir' and instance = '$instance' and (number = '$number' or winning_numbers = '$winning_numbers')")) == 0){ //make sure use rwasx not placed here previously
    
    
    

	$num_winners = db_num_rows(db_query("select * from bingo_winners where instance = '$instance' and number != '$number'"));
    
	if(db_num_rows(db_query("select * from bingo_winners where instance = '$instance' and place='second' and number != '$number'"))>=1){
      
	    third_place($instance, $number, $name, $dir, $winning_numbers, $winner, $bud_id);
	    
	    
	}else if(db_num_rows(db_query("select * from bingo_winners where instance = '$instance' and place='first' and number != '$number'"))>=1 ){

	    second_place($instance, $number, $name, $dir, $winning_numbers, $winner, $bud_id);
	   die();
	    
	}else{
	
	  
	    first_place($instance, $number, $name, $dir, $winning_numbers, $winner, $bud_id);
	    die();
	
	}

	
	
	
	
	
	
    }
    
  
}
@db_query("CREATE TABLE IF NOT EXISTS `bingo_emails` (
			`id` bigint(20) unsigned NOT NULL auto_increment,
			`instance` varchar(200) not null,
			`email` varchar(200) not null,
			`status`  varchar(200) NOT NULL,
			PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");
@db_query("CREATE TABLE IF NOT EXISTS `bingo_winners` (
			`id` bigint(20) unsigned NOT NULL auto_increment,
			`instance` varchar(200) not null,
			`number` varchar(200) not null,
			`winner`  varchar(200) NOT NULL,
			`place`  varchar(200) NOT NULL,
			PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");			
			
function start_game($instance){
      $sql = db_query("select distinct(r.email) from bingo_user_data left join registration r on r.id = bingo_user_data.userid where instance = '$instance'");
     while($row = db_fetch_array($sql)){
	if(db_num_rows(db_query("select * from bingo_emails where email = '" . addslashes($row['email']) . "' and status = 'started' and instance = '$instance'")) ==0){ print_r($row);
	    db_query("insert into bingo_emails values(null, '$instance', '" . addslashes($row['email']) . "', 'started');");
	    
	    mail($row['email'], "Bingo Game Has Begun", "This is to inform you that your bingo game has started. To watch it in action go <a href='$SITE_URL/bingo.php?game=$instance'>Here</a>", null, '-f support@' . $_SERVER['SERVER_NAME']);
	}
      }
      echo db_error();
       return true;
}
function delay_game($instance){
      $sql = db_query("select  distinct(r.email) from  bingo_user_data left join registration r on r.id = bingo_user_data.userid where instance = '$instance'");
     while($row = db_fetch_array($sql)){
   
	if(db_num_rows(db_query("select * from bingo_emails where email = '" . addslashes($row['email']) . "' and status = 'delayed' and instance = '$instance'")) ==0){
	
	    mail($row['email'], "Delayed Bingo Game", "Sorry but the game for which you registered has not yet reached the minimum number of users so it has been delayed to start at a later time. You will be contacted when the game begins. Sorry for the inconvience", null, '-f support@' . $_SERVER['SERVER_NAME']);
	    
	    db_query("insert into bingo_emails values(null, '$instance', '" . addslashes($row['email']) . "', 'delayed');");
	}
      }
      echo db_error();
      return true;
}

   if(!file_exists("$BASE_DIR/include/addons/bingo/sounds/bingo.mp3")){
	
	
	file_put_contents("$BASE_DIR/include/addons/bingo/sounds/bingo.mp3", file_get_contents("http://translate.google.com/translate_tts?ie=UTF-8&q=bingo&tl=en&total=1&idx=0&textlen=12&prev=input"));
	@shell_exec("chmod 777 $BASE_DIR/include/addons/bingo/sounds/bingo.mp3");
	
    }
    
    
    
    
    
    
    
    
while($i < 10){


@db_query("alter table bingo_games add column finished varchar(1) default '0' null;");
@db_query("alter table bingo_user_data add column winner varchar(200) null;");
@db_query("alter table bingo_user_data add column finish datetime null;");
echo "select * from bingo_games where timestamp <= '" . time() . "' and finished != 2\n";

$qry = db_query("select * from bingo_games where timestamp <= '" . time() . "' and finished != 2");

$winners = array();
$num_games = db_num_rows(db_query("select * from bingo_games where timestamp <= '" . time() . "' and finished != 2"));

    while($row = db_fetch_array($qry)){
      $instance = $row['id'];
	
	if($row['timestamp'] <= time()){
	echo "feed me some cards for $instance\n";
	
	
	
	
	
    if(db_num_rows(db_query("select * from bingo_winners where instance = '$instance' and place = 'third'")) == 0){
//$row['min_players'] = 5;
if($row['id'] == 241){
echo $row['min_players'];
}
      if(db_num_rows(db_query("select distinct(userid) from bingo_user_data where instance = '$instance'")) < $row['min_players']){
      echo "Delaying game $instance\n";
	  delay_game($instance);
    
      
      }else{
      echo "starting game";
	  
          start_game($instance);
       if(db_num_rows(db_query("select * from bingo_numbers where bingo_id = '$row[id]'")) == 0){
	
	    $number = unique_number($row);
	      
	
	    }else{
    
	   $number = unique_number($row);
    
	}
	if(!file_exists("$BASE_DIR/include/addons/bingo/sounds/$number". ".mp3")){
	  @$tts = new TextToSpeech();
	  @$tts->setText($number);
	  @$tts->saveToFile("$BASE_DIR/include/addons/bingo/sounds/$number.mp3");
	    @shell_exec("chmod 777 $BASE_DIR/include/addons/bingo/sounds/$number.mp3");
	}
	db_query("insert into bingo_numbers values(null, '$instance', '$row[id]', '$number');"); 



	$qry_card = db_query("select * from bingo_user_data left join registration r on bingo_user_data.userid=r.id where instance = '$instance' and number = '$number'");
	
		  while($row_card = db_fetch_array($qry_card)){
		
		      db_query("update bingo_user_data set marked = '1' where instance = '$instance' and number = '$number'");
		      $id = $row_card['id'];
		      echo $id . "\n";
		      
		      $number_data = explode("-", $number);
		      
		      //four vertical
		      if(db_num_rows(db_query("select * from bingo_user_data where card = '$row_card[card]' and instance = '$row_card[instance]' and userid = '$row_card[userid]' and letter = '$number_data[0]' and marked = 1")) >= 5){  
		      
			$winning_numbers = '';
			$sql_v = db_query("select * from bingo_user_data where card = '$row_card[card]' and instance = '$row_card[instance]' and userid = '$row_card[userid]' and letter = '$number_data[0]' and marked = 1 order by number asc");
			
			    while($row_v = db_fetch_array($sql_v)){
				$winning_numbers .= ':' . $row_v['number'];
			    }
			      db_query("update bingo_user_data set winner = '1', finish = NOW() where instance = '$instance' and card = '$row_card[card]' and userid = '$row_card[userid]' and letter = '$number_data[0]' and marked = 1");
			      
			      check_winners($instance, $row_card['username'], $number, $row['id'], '4v', $winning_numbers, $row_card['card']); 
		      }else
			  
		      //four horizontal
		      if(db_num_rows(db_query("select * from bingo_user_data where card = '$row_card[card]' and instance = '$row_card[instance]' and userid = '$row_card[userid]' and `card_index` = '" . ceil($row_card['card_index']/5) *5 . "' and marked = 1")) >= 5 ){
		      
		      
		      
			$winning_numbers = '';
			$sql_h = db_query("select * from bingo_user_data where card = '$row_card[card]' and instance = '$row_card[instance]' and userid = '$row_card[userid]' and `card_index` = '" . floor($row_card['card_index']/5) *5 . "' and marked = 1 order by number asc");
			
			    while($row_h = db_fetch_array($sql_h)){
				$winning_numbers .= ':' . $row_h['number'];
			    }		      
		      
		      
			  db_query("update bingo_user_data set winner = '1', finish = NOW() where instance = '$instance' and card = '$row_card[card]' and userid = '$row_card[userid]' and `card_index` = '" . floor($row_card['card_index']/5) *5 . "' and marked = 1");
			  
			  check_winners($instance, $row_card['username'], $number, $row['id'], '4h', $winning_numbers, $row_card['card']); 
		      
		      }else{
		      $co = "1,5,7,9,13,17,19,21,25";
		      //top left to bottom right
		      $diagonal = "((row = 1 and marked = 1) or (row = 7 and marked = 1) or (row = 13) or (row = 19 and marked = 1) or (row = 25 and marked = 1 ) )";
		      
		      $row_diag = db_query("select * from bingo_user_data where instance = '$instance' and userid = '$row_card[userid]'  and card = '$row_card[card]'  and  $diagonal");
		      
		      if(db_num_rows($row_diag) >= 5){
		      while($check_diag = db_fetch_array($row_diag)){
		      	
		      
		      
		      $winning_numbers = '';
			$sql_h = db_query("select * from bingo_user_data where card = '$row_card[card]' and instance = '$row_card[instance]' and userid = '$row_card[userid]' and $diagonal order by number asc");
			
			    while($row_h = db_fetch_array($sql_h)){
				$winning_numbers .= ':' . $row_h['number'];
			    }	
		      
			    db_query("update bingo_user_data set winner = '1', finish = NOW() where instance = '$instance' and card = '$row_card[card]' and userid = '$row_card[userid]'  and $diagonal");
			    check_winners($instance, $row_card['username'], $number, $row['id'], 'tl-br', $winning_numbers, $row_card['card']); 
		      }
		      
		  }
		  
		  //top right to bottom left
		  $diagonal = "( (row = 5 and marked = 1) or (row = 9 and marked = 1) or (row = 13) or (row = 17 and marked = 1) or (row = 21 and marked = 1)) ";
		      
		    $row_diag = db_query("select * from bingo_user_data where instance = '$instance' and userid = '$row_card[userid]'  and card = '$row_card[card]'  and  $diagonal");
		      
		      if(db_num_rows($row_diag) >= 5){
		      while($check_diag = db_fetch_array($row_diag)){
		      
		      
			  $winning_numbers = '';
			$sql_h = db_query("select * from bingo_user_data where card = '$row_card[card]' and instance = '$row_card[instance]' and userid = '$row_card[userid]' and $diagonal order by number asc");
			
			    while($row_h = db_fetch_array($sql_h)){
				$winning_numbers .= ':' . $row_h['number'];
			    }	
			    
		      
			    db_query("update bingo_user_data set winner = '1', finish = NOW() where instance = '$instance' and card = '$row_card[card]' and userid = '$row_card[userid]'  and $diagonal  ");
			    
			    check_winners($instance, $row_card['username'], $number, $row['id'], 'tr-bl', $winning_numbers, $row_card['card']); 
		      }
		      
		  }
		  
		}
		      echo db_error();
		      
		     //Do payouts here
		  
	 }
    }
  //
  
  }
$places = array('first', 'second', 'third');
if(db_num_rows(db_query("select * from bingo_numbers where instance = '$instance'")) >= 375){
db_query("update bingo_games set finished = 2 where id = '$instance'");
}
  	if(db_num_rows(db_query("select * from bingo_winners where place = 'third' and instance = '$instance' and paid = ''")) >= 1){
	   
	    foreach($places as $place){
	    
		$divisor = db_num_rows(db_query("select * from bingo_winners where instance = '$instance' and place = '$place'"));
		
		$winners_sql = db_query("select bingo_winners.winner, bingo_winners.id from bingo_winners where place = '$place' and paid = '' and instance = '$instance' ");
	   
		  while($row_winners = db_fetch_array($winners_sql)){
		print_r($row_winners);
		$user = db_fetch_array(db_query("select id from registration where username = '" . addslashes($row_winners['winner']) . "'"));
		
		
		      payout($place, $user['id'], $instance, $divisor);
		      db_query("update bingo_winners set paid = 'paid' where instance = '$instance' and id=$row_winners[id]");
		      
		  
		  }
		  echo db_error();
	    }
	     db_query("update bingo_games set finished = 2 where id = '$instance'");
  	}
  	$testing = 1;
  	
  	}
  	if($testing == true){
  	usleep(10000);
  	}else{
  	
  	$interval = floor(25 / $num_games);
  	echo "Game interval is $interval when using $num_games Games\n";
sleep($interval);

}
}
}

echo db_error();
