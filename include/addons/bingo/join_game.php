<?php
ini_set('display_errors', 1);
include("../../../config/config.inc.php");
$uid = $_SESSION['userid'];
				    
				    $letters = array("B", "I", "N", "G", "O");
 if(db_num_rows(db_query("select * from bingo_numbers where instance = '$_REQUEST[bingo_id]'")) >= 1){
        
        
        
  echo "<h2>Sorry this game has already started, please refresh your page to get the next game time.</h2>";
}else{				    
				    
function random_number($value, $m, $p, $instance, $z){
  include("../../../config/config.inc.php");
@db_query("alter table bingo_games add column finished varchar(1) default '0' null;");
@db_query("alter table bingo_user_data add column winner varchar(200) null;");
@db_query("alter table bingo_user_data add column finish datetime null;");
	  switch($value){
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
		$rand = rand($top,$bottom);
		
	
						
		$square = $value . '-' . $rand;
	 if(db_num_rows(db_query("select * from bingo_user_data where instance = '$instance' and number = '$square' and userid = '$_SESSION[userid]' and card = '$p'")) >= 1){
			
	    random_number($value, $m, $p, $instance, $z);

	}else{
	
	      if($z == 13){
		  db_query("insert into bingo_user_data values(null, '$instance', '$_SESSION[userid]', '" . $p . "', '$square', 1, '" . $m * 5 . "', '$value', '" . $z . "','', '');");	      
	      }else{
		  db_query("insert into bingo_user_data values(null, '$instance', '$_SESSION[userid]', '" . $p . "', '$square', 0, '" . $m * 5 . "', '$value', '" . $z . "','', '');");
	      }
	}

}
if($_REQUEST['which_to_take'] == 'free_bids'){
  $table = 'free_account';
  $row_to_take = 'free_bids';
}else{
  $table = 'bid_account';
  $row_to_take = 'final_bids';
}



        $qrysel = "select " . $row_to_take . ",username,position from registration where id=$uid";
        $ressel = db_query($qrysel);
        $obj = db_fetch_array($ressel);
        
        $final_bal = $obj[$row_to_take] - ($_REQUEST['my_cards'] * $_REQUEST['cost_per_card']);
        
        
        if(db_num_rows(db_query("select * from bingo_numbers where instance = '$_REQUEST[bingo_id]'")) >= 1){
        
        
        
	  echo "<h2>Sorry this game has already started, please refresh your page to get the next game time.</h2>";
	}else{
        
        
        if($final_bal < 0){
		
		echo "Sorry you do not have enough " . ucwords(str_replace("_", " ", $_REQUEST['which_to_take'])) . " to play this game. Try buying fewer cards.";
		include("buy_cards.php");
        
        }else{
	   if($_REQUEST['which_to_take'] == 'free_bids'){
		$table = 'free_account';
		$row_to_take = 'free_bids';
	      }else{
		$table = 'bid_account';
		$row_to_take = 'final_bids';
	      } 
	      $total = $_REQUEST['my_cards'] * $_REQUEST['cost_per_card'];
        
		$qryins = "Insert into $table (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time,credit_description) values('$uid','" . date("Y-m-d H:i:s", time()) . "','" . $total . "','$_REQUEST[bingo_id]','$_REQUEST[bingo_id]','d','','ad','', 'Bingo Cards bought for $_REQUEST[bingo_id]')";
		  db_query($qryins);


		$qryupd = "update registration set $row_to_take=" . $final_bal . " where id=$uid";
	        db_query($qryupd);
            
			@db_query("CREATE TABLE IF NOT EXISTS `bingo_user_data` (
				      `id` bigint(20) unsigned NOT NULL auto_increment,
				      `instance` varchar(200) not null,
				      `userid` int(11) NOT  NULL,
				      `card` varchar(200) not null,
				      `number`  varchar(200) NOT NULL,
				      
				      PRIMARY KEY  (`id`)
				      
				    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");
			@db_query("CREATE TABLE IF NOT EXISTS `bingo_numbers` (
				      `id` bigint(20) unsigned NOT NULL auto_increment,
				      `instance` varchar(200) not null,
				      `number`  varchar(200) NOT NULL,
				      
				      PRIMARY KEY  (`id`)
				      
				    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");
				    
				    
				    $instance = $_REQUEST['bingo_id'];

				    
				    
				    
				    $numbers = array();
				    $offset_g = db_fetch_array(db_query("select max(card) from bingo_user_data where userid = '$_SESSION[userid]' and instance = '$instance'" ));
				   
				   
				   if(empty($offset_g[0])){
				    $offset = 0;
				   }else{
				   
				    $offset = $offset_g[0];
				   }
				   
				    $p = 1;
				    $total_cards = $_REQUEST['my_cards'] + $offset;
				    $p = $p + $offset;
				    
				    while($p <= $total_cards){
					$z = 1;
					foreach($letters as $value){
					
					$m = 1;
					  while($m <= 5){
					      random_number($value, $m, $p, $instance, $z);
					      $m++;
					      $z++;
					   }
					  
					}
				    
				    $p++;
				    }
	      
            }
            
         }
         }