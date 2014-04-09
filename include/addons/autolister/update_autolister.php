<?php
ini_set('display_errors', 1);
ini_set('max_execution_time', 0);
require("../../../config/config.inc.php");
//    echo $DATABASENAME;
    @db_query("alter table auction_running modify column auctionID int(11) unique not null;");
    @db_query("alter table auction_run_status modify column auctionID int(11) unique not null;"); 
    @db_query("alter table auc_due_table modify column auctionID int(11) unique not null;"); 
    $debug = 'true';
    if(!class_exists('Colors')){
	class Colors {
		private $foreground_colors = array();
		private $background_colors = array();
 
		public function __construct() {
			// Set up shell colors
			$this->foreground_colors['black'] = '0;30';
			$this->foreground_colors['dark_gray'] = '1;30';
			$this->foreground_colors['blue'] = '0;34';
			$this->foreground_colors['light_blue'] = '1;34';
			$this->foreground_colors['green'] = '0;32';
			$this->foreground_colors['light_green'] = '1;32';
			$this->foreground_colors['cyan'] = '0;36';
			$this->foreground_colors['light_cyan'] = '1;36';
			$this->foreground_colors['red'] = '0;31';
			$this->foreground_colors['light_red'] = '1;31';
			$this->foreground_colors['purple'] = '0;35';
			$this->foreground_colors['light_purple'] = '1;35';
			$this->foreground_colors['brown'] = '0;33';
			$this->foreground_colors['yellow'] = '1;33';
			$this->foreground_colors['light_gray'] = '0;37';
			$this->foreground_colors['white'] = '1;37';
 
			$this->background_colors['black'] = '40';
			$this->background_colors['red'] = '41';
			$this->background_colors['green'] = '42';
			$this->background_colors['yellow'] = '43';
			$this->background_colors['blue'] = '44';
			$this->background_colors['magenta'] = '45';
			$this->background_colors['cyan'] = '46';
			$this->background_colors['light_gray'] = '47';
		}
	      
		// Returns colored string
		public function getColoredString($string, $foreground_color = null, $background_color = null) {
			$colored_string = "";
 
			// Check if given foreground color found
			if (isset($this->foreground_colors[$foreground_color])) {
				$colored_string .= "\033[" . $this->foreground_colors[$foreground_color] . "m";
			}
			// Check if given background color found
			if (isset($this->background_colors[$background_color])) {
				$colored_string .= "\033[" . $this->background_colors[$background_color] . "m";
			}
 
			// Add string and end coloring
			$colored_string .=  $string . "\033[0m";
 
			return $colored_string;
		}
 
		// Returns all foreground color names
		public function getForegroundColors() {
			return array_keys($this->foreground_colors);
		}
 
		// Returns all background color names
		public function getBackgroundColors() {
			return array_keys($this->background_colors);
		}
	}
 
    }
 function insert_auction($row, $rowP, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME){
  
  require("../../../config/config.inc.php");
  
  $colors = new Colors();


    db_connect($DBSERVER, $USERNAME, $PASSWORD);


    db_select_db($DATABASENAME, $db);



    @db_query("alter table auction_running add column autolister tinyint(1) null default '0'");
    @db_query("alter table auction add column autolister tinyint(1) null default '0'");
    
      
 
	      $qryins = "Insert into auction(auctionID, categoryID, productID, auc_start_price,  fixedpriceauction, pennyauction, nailbiterauction, offauction, openauction, uniqueauction, reverseauction, shipping_id, tax1, tax2, reserve, auc_status, use_free, autolister, halfbackauction, cashauction, beginner_auction)";

			  if($row['reserve'] == '' | $row['reserve'] == 'null'){
			    $row['reserve'] = '0.00';
			  
			  }
			  if($row['tax1'] == '' | $row['tax1'] == 'null'){
			    $row['tax1'] = '0';
			  
			  }
			  if($row['tax2'] == '' | $row['tax2'] == 'null'){
			    $row['tax2'] = '0';
			  
			  }
			  $qryins .= "values(null, '$rowP[categoryID]', '$row[productID]', '$row[aucstartprice]', '$row[fixedpriceauction]', '$row[pa]', '$row[nailbiterauction]', '$row[offauction]', '$row[openauction]', '$row[uniqueauction]', '$row[reverseauction]', '$row[shippingmethod]', '$row[tax1]', '$row[tax2]', '$row[reserve]', '1', '', 1, '$row[halfbackauction]', '$row[cashauction]', '$row[beginner_auction]');";
					   
		 
		 
	//	 echo $qryins . "\n\n";
			db_query($qryins);
			
			      $auctionid = db_insert_id();
			     echo $colors->getColoredString("!!!!!!!!ADDED AUCTIONID => $auctionid !!!!!!!!!!", "blue")."\n";
			     db_free_result();
			     usleep(100);
			      return $auctionid;
			      
	}

	
function add_updates($auctionid, $row, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME){

    

    db_connect($DBSERVER, $USERNAME, $PASSWORD);


    db_select_db($DATABASENAME, $db);
    
				if($row['allow_buy_now'] >= '1'){
					  $update = "update auction set allowbuynow = '$row[allow_buy_now]', buynowprice =  '$row[buynowprice]' where auctionID = '$auctionid'";				      
				      
				      
				      }else{
					  $update = "update auction set allowbuynow = '0', buynowprice =  '0' where auctionID = '$auctionid'";
				      
				      
				      }
				    
		db_query($update);
		db_free_result();
		usleep(100);
	//	echo "\t" . $update . "\n\n";
				      
	}
	
function add_time_to_auction($auctionid, $starttime, $start_readable_date, $end_readable_date, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME){
				
      db_connect($DBSERVER, $USERNAME, $PASSWORD);


      db_select_db($DATABASENAME, $db);				
				
					  $update = "update auction set auc_start_date = '$start_readable_date[0]', 
					auc_start_time = '$start_readable_date[1]', auc_end_date = '$end_readable_date[0]', 
					auc_end_time = '$end_readable_date[1]',  
					future_tstamp = '" . $starttime . "', time_duration = '20sa' where auctionID = '$auctionid' limit 1";
					
					db_query($update);
					//echo $update;
					db_free_result();
					usleep(100);
					
}
	  
function FutureAuctionManage2($auctionid, $localtime, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME) {
    


      db_connect($DBSERVER, $USERNAME, $PASSWORD);


      db_select_db($DATABASENAME, $db);


    $sqlsel = "select * from auction where auctionID = '$auctionid'";
    $result = db_query($sqlsel);
    $auc = db_fetch_array($result);
        
        $aid = $auctionid;
        
        $now = time();

        if($auc['future_tstamp'] <= $now){
        


	    $sqlsel = "select * from auction where auctionID='$aid'";
	    
	    
	    $result = db_query($sqlsel);
	 
	    
		echo "\tAuction time reached => auction added to running table \n\n\n";
		
		
		$auction = db_fetch_array($result);
		$sqlins = "insert into auction_running(auctionID,productID,auc_start_price,auc_status,pause_status,time_duration,use_free,fixedpriceauction,
		    pennyauction,nailbiterauction,offauction,nightauction,openauction,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,
		    seatbids,lockauction,locktype,locktime,lockprice,relist,cashauction,reserve, autolister, beginner_auction) values('{$auction['auctionID']}','{$auction['productID']}','{$auction['auc_start_price']}','{$auction['auc_status']}','{$auction['pause_status']}','{$auction['time_duration']}','{$auction['use_free']}','{$auction['fixedpriceauction']}',
		    '{$auction['pennyauction']}','{$auction['nailbiterauction']}','{$auction['offauction']}','{$auction['nightauction']}','{$auction['openauction']}','{$auction['reverseauction']}','{$auction['uniqueauction']}','{$auction['halfbackauction']}','{$auction['seatauction']}','{$auction['minseats']}','{$auction['maxseats']}',
		    '{$auction['seatbids']}','{$auction['lockauction']}','{$auction['locktype']}','{$auction['locktime']}','{$auction['lockprice']}','{$auction['relist']}','{$action['cashauction']}', '{$aucton['reserve']}', '1', '{$auction['beginner_auction']}')";
		db_query($sqlins);
		
		
		
	    $auc['total_time'] = strtotime($auc['auc_end_date'] . " " . $auc['auc_end_time']) - $localtime;
	    db_query("update auction set total_time = '$auc[total_time]' where auctionID = $auctionid");
	    
		$sqlins2 = "insert into auction_run_status(auctionid,lefttime,newprice,heighuseravatar,heighuser,uniqueauction,lowbidcount,seatauction,seatauctionnow,seatcount,minseats)
		    values('{$auction['auctionID']}','{$auction['total_time']}','{$auction['auc_start_price']}','','[]','{$auction['uniqueauction']}','0','{$auction['seatauction']}','{$auction['seatauction']}','0','{$auction['minseats']}')";
		db_query($sqlins2);
	 
	   
	    
	    $sqlins = "insert into auc_due_table (auction_id, auc_due_time, auc_due_price) values('{$auc['auctionID']}','{$auc['total_time']}','{$auc['auc_start_price']}')";
	    db_query($sqlins); 

	    $upsql = "update auction set auc_status='2' where auctionID='$auctionid'";
	      db_query($upsql);
	    $upsql = "update auction_running set auc_status='2' where auctionID='$auctionid'";
	      db_query($upsql);
	  
	  
       }else{
       
       
	    $auc['total_time'] = strtotime($auc['auc_end_date'] . " " . $auc['auc_end_time']) - $localtime;
	    db_query("update auction set total_time = '$auc[total_time]' where auctionID = $auctionid");
	    
		$auction = db_fetch_array($result);
		$sqlins = "insert into auction_running(auctionID,productID,auc_start_price,auc_status,pause_status,time_duration,use_free,fixedpriceauction,
		    pennyauction,nailbiterauction,offauction,nightauction,openauction,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,
		    seatbids,lockauction,locktype,locktime,lockprice,relist,cashauction,reserve, autolister, beginner_auction) values('{$auction['auctionID']}','{$auction['productID']}','{$auction['auc_start_price']}','{$auction['auc_status']}','{$auction['pause_status']}','{$auction['time_duration']}','{$auction['use_free']}','{$auction['fixedpriceauction']}',
		    '{$auction['pennyauction']}','{$auction['nailbiterauction']}','{$auction['offauction']}','{$auction['nightauction']}','{$auction['openauction']}','{$auction['reverseauction']}','{$auction['uniqueauction']}','{$auction['halfbackauction']}','{$auction['seatauction']}','{$auction['minseats']}','{$auction['maxseats']}',
		    '{$auction['seatbids']}','{$auction['lockauction']}','{$auction['locktype']}','{$auction['locktime']}','{$auction['lockprice']}','{$auction['relist']}','{$action['cashauction']}', '{$aucton['reserve']}', '1', '{$auction['beginner_auction']}')";
		db_query($sqlins);

		$sqlins2 = "insert into auction_run_status(auctionid,lefttime,newprice,heighuseravatar,heighuser,uniqueauction,lowbidcount,seatauction,seatauctionnow,seatcount,minseats)
		    values('{$auction['auctionID']}','{$auction['total_time']}','{$auction['auc_start_price']}','','[]','{$auction['uniqueauction']}','0','{$auction['seatauction']}','{$auction['seatauction']}','0','{$auction['minseats']}')";
		db_query($sqlins2);
		
		
	  echo "\tAuction time not yet reached\n\n\n";
	  db_query("update auction set auc_status = '1' where auctionID = '$auctionid'");
	  $upsql = "update auction_running set auc_status='1' where auctionID='$auctionid'";
	      db_query($upsql);
	  
       }
       db_free_result();
       usleep(100);
       
     
}	  
	  



function start_all_now($row, $rowP, $prev_row, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME, $starttime = false, $endtime = false){
      db_connect($DBSERVER, $USERNAME, $PASSWORD);


      db_select_db($DATABASENAME, $db);
      
      

$colors = new Colors();

			if(!$starttime){
			    $starttime = strtotime(date("Y-m-d H:i:s"));
			 }
			 
			 
			    $startdate = date("Y-m-d H:i:s", $starttime);

			    $start_readable_date = explode(" ", $startdate);			    
			    
			    
			 if(!$endtime){  
			 
			
			    $endtime = $row['run_for'] + $starttime;
			  }
			  
			  
			if($row['stagger'] == '1'){
        		
			    $prev_auto_result = db_fetch_array(db_query("select auc_end_date, auc_end_time from auction where auc_status = '2' order by auctionID desc limit 1"));
			     
			     if((empty($prev_auto_result[0]) | empty($prev_auto_result[1])) | ($prev_auto_result[0] == '0000-00-00' | $prev_auto_result[1] == '00:00:00')){//there are no auctions
				$prev_auto_result[0] = date("Y-m-d");
				$prev_auto_result[1] = date("H:i:s");
			      
			      }
				  $endtime = strtotime($prev_auto_result[0] . " " . $prev_auto_result[1]);
				  
				  if(!empty($prev_row['start_every'])){
				      $stagger = $prev_row['start_every'];
				    }else{
				      $stagger = 0;
				    }
				  
				  
				  $endtime = $row['run_for'] + $endtime; 
					    //echo $colors->getColoredString("THIS IS EXPERIMENTAL USE AT YOUR OWN RISK*****", "red") . "\n\n\n";
					    
					    
			 }else{
			
			  $prev_auto_result = db_fetch_array(db_query("select auc_end_date, auc_end_time from auction where auc_status = '2' order by auctionID desc limit 1"));
			  
			  
			      if((empty($prev_auto_result[0]) | empty($prev_auto_result[1])) | ($prev_auto_result[0] == '0000-00-00' | $prev_auto_result[1] == '00:00:00')){//there are no auctions
				$prev_auto_result[0] = date("Y-m-d");
				
				$prev_auto_result[1] = date("H:i:s");
			      
			      }
			   
			       if(!empty($prev_row['start_every'])){
				      $stagger = $prev_row['start_every'];
				    }else{
				      $stagger = 60;
				    }
				    
				    if(!$starttime){
					$starttime = strtotime(date("Y-m-d H:i:s"));
				    }
			 
			 if(!empty($row['start_now'])){
			 $starttime = time();
			 
			 
			 }
			 
			 
				  $endtime = strtotime($prev_auto_result[0] . " " . $prev_auto_result[1]);
				  
				  if(!empty($prev_row['start_every'])){
				      $stagger = $prev_row['start_every'];
				    }else{
				      $stagger = 0;
				    }
				  
				  
				  $endtime = $row['run_for'] + $endtime; 		 
			 }
			 
			 
			 
			    $enddate = date("Y-m-d H:i:s", $endtime);
			   
			    $end_readable_date = explode(" ", $enddate);	  
		      
		  
	  
	  

				      $diff = $endtime - $now;

				      
				     
			  
			

					
					
					
				$auctionid = insert_auction($row, $rowP, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
				db_query("update autolister set auction_id = '$auctionid' where id = $row[id] limit 1");
				
				
				add_time_to_auction($auctionid, $starttime, $start_readable_date, $end_readable_date, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
				
			if($row['allow_buy_now'] >= '1'){
					  $update = "update auction set allowbuynow = '1', buynowprice =  '$row[buynowprice]' where auctionID = '$auctionid'";				      
				      
				      
				      }else{
					  $update = "update auction set allowbuynow = '0', buynowprice =  '0' where auctionID = '$auctionid'";
				      
				      
				      } 
				   db_query($update);
				   
				   
			if($row['reserve'] != ''){
			
			 $update = "update auction set reserve = '$row[reserve]' where auctionID = '$auctionid'";
			
			
			}
		                db_query($update);
		                
				FutureAuctionManage2($auctionid, $starttime, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME); 
		
		
		$recuurences = $row['recuurences'] - 1;
				
		 	
		 db_free_result();
		
		 return $auctionid;
}
  
  
function get_start_time($row, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME){

      db_connect($DBSERVER, $USERNAME, $PASSWORD);


      db_select_db($DATABASENAME, $db);
      
      
      $colors = new Colors();
     $auctionid = '';
  $max_auctions = db_fetch_array(db_query("select * from autolister_settings where setting = 'max_auctions' limit 1"));


  $prev_row = db_fetch_array(db_query("select * from auction, autolister where autolister >= '1' and timestamp = '$row[timestamp]' order by auctionID desc limit 1"));
		
		//Add New Auction Here

	if(db_num_rows(db_query("select * from auction where autolister >= '1' and auc_status = '2'")) < $max_to_list){
	
	
        	$starttime = strtotime(date("Y-m-d H:i:s"));
        	
        		if($row['stagger'] == '1'){
        		
			      $prev_auto_result = db_fetch_array(db_query("select start_every from autolister where id < $row[id] order by id,sort desc limit 1"));
			     
			     
			    if($prev_auto_result['start_every'] > 1){	
				  $starttime = $starttime + ($prev_auto_result['start_every'] * 60);
					    
			      echo $colors->getColoredString("*****ALERT STAGGERING THIS AUCTION TO START ON ". date("Y-m-d H:i:s", $starttime) . " By Adding " . $prev_auto_result['start_every'] * 60 . " Seconds to the start time****", "purple") . "\n\n\n";
				}	    
					    //echo $colors->getColoredString("THIS IS EXPERIMENTAL USE AT YOUR OWN RISK*****", "red") . "\n\n\n";
					    
			 }
			 
  db_free_result();
  usleep(100);
			 
	 return $starttime;
	
	}
     
}


  
function makeAuctionTime($row, $starttime, $records, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME){
if(empty($records)){
$records = 1;
}


      db_connect($DBSERVER, $USERNAME, $PASSWORD);


      db_select_db($DATABASENAME, $db);
      
      
@db_query("alter table autolister add column auction_id varchar(20) null");
$colors = new Colors();

     


     
  			$max_auctions = db_fetch_array(db_query("select * from autolister_settings where setting = 'max_auctions' limit 1"));
		      
		
			$rowP = db_fetch_array(db_query("select * from products where productID = '$row[productID]' limit 1"));
			
			
			
			
//	echo "Limiting Auto Lister to $max_auctions[2] at a time\n\n\n";
		$now = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));	
		
			
		$max_to_list = $max_auctions[2];	    
			    
			if(!empty($row['start_now'])){
			
				    $auctionid = start_all_now($row, $rowP, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
				    //if set to start now
			
			}else{
			    
			    
			    
			    
		$prev_auto_result = db_fetch_array(db_query("select start_every from auction, autolister where autolister.auction_id = auction.auctionID and auction.auctionID != '$row[auction_id]' order by auction.auctionID desc limit 1"));
					
			    
			    
			    if( db_num_rows(db_query("select * from auction_running where autolister >= '1' and auc_status = '2'")) < $max_to_list){
//need to test limiting auctions	

					      echo $colors->getColoredString("****ALERT THIS AUCTION STARTS NOW TO FILL UP THE AUCTION RESULTS OF $max_to_list*****", "red") . "\n\n";
						
						
						
						
						
				    $auctionid = start_all_now($row, $rowP, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
				    //we need more auctions so do the default and start this one until they are full
				
			         }else{
			         
			         
				    //	print_r($prev_row);
				    
				  if( get_start_time($row) >= $now){
				  
				      $auctionid = start_all_now($row, $rowP, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
				  
				  
			}else{
				  
			$auctionid = 'waitting';
				  
		    }
					      
	  
	  
	      }
 
 
 
	}

	db_query("update autolister set auction_id = 'waitting' where id = '$row[id]'");
	db_free_result();
	usleep(200);
	
	if(!empty($auctionid)){
	return $auctionid;
	}else{
	return '';
	}

}


	
	
function start_autolister($starttime,$DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME, $records = null){
global $starttime;
db_query("update auction set auc_status = '3' where auc_end_date <= '1999-01-01';");

    if(empty($records)){
      $records = 1;
    }
$colors = new Colors();
    


    db_connect($DBSERVER, $USERNAME, $PASSWORD);


    db_select_db($DATABASENAME, $db);
      
      
    
    $start = '';
    echo "select * from autolister where recuurences > '0' order by sort, timestamp, id asc";
     $Sql = db_query("select * from autolister where recuurences > '0' order by sort, timestamp, id asc");
      echo db_error();
	$auctionid = '';
	
	$run = 1;
	
	$max_auctions = db_fetch_array(db_query("select * from autolister_settings where setting = 'max_auctions' limit 1"));
	if(db_num_rows(db_query("select * from auction where auc_status = 2")) < $max_auctions['value']){
	  while($row = db_fetch_array($Sql)){
	  
	
	  
	print_r($row);	
	      
			
		      
			
			$rowP = db_fetch_array(db_query("select * from products where productID = '$row[productID]' limit 1"));
			
			
			$prev_row = db_fetch_array(db_query("select * from auction order by auctionID desc limit 1"));
			
			      
			
			if(db_num_rows(db_query("select * from auction where autolister >= 1 and auc_status = '2'")) < $max_auctions['value']){

			    $new_auction = db_fetch_array(db_query("select * from autolister where auction_id = 'waitting' or auction_id = '' or auction_id = 'NULL' order by id asc limit 1"));
			
			    $auctionid = start_all_now($row, $rowP, $prev_row, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
			
			
			}else{
		/*$run++;
		    if($run == $max_auctions[2]){
		      $records++;
		    }			
		*/	
			  $auctionid = makeAuctionTime($row, $starttime, $records, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
		}
		if(!empty($auctionid)){
		
		    db_query("update autolister set auction_id = '$auctionid' where id = $row[id] limit 1");
		    db_query("update autolister set recuurences=recuurences-1 where id = $row[id] limit 1");
		
		}
			
	      echo db_error();
	 

	 

	  }
	  
	  echo db_error();
	  db_free_result($row);
	}
      return $records;
      
      }
      
      
      
      
      $i = 0;
	$colors = new Colors(); 
      
  	  echo $colors->getColoredString("************STARTING AUTOLISTER DAEMON************\n\n", "red");
  	  
      
	    while($i < 2){
	    $starttime = time();
		

		echo $colors->getColoredString("[" . date("Y-m-d H:i:s", $starttime) . "]", "white");
		echo $colors->getColoredString("\tWaiting for new listings", "blue") . "\n\n";
		$records = start_autolister($starttime, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME, $records); 
	
	      usleep(1000);
	     $i = 3;
	    }
?>
