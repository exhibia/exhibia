<?php
ini_set('display_errors', 0);
$debug = true;
include("config/connect.php");
include("functions_s.php");
include_once $BASE_DIR . '/data/bidaccount.php';
include_once $BASE_DIR . '/data/auction.php';
include_once $BASE_DIR . '/Functions/cornerImag.php';
include_once $BASE_DIR . '/Functions/social_avatar.php';
include_once $BASE_DIR . '/common/sitesetting.php';
if(empty($debug)){
ob_start();

}
ini_set("max_execution_time", 300);

if ($_SERVER['REMOTE_ADDR'] != '') {
    exit;
}


$badb=new Bidaccount(null);
$aucdb=new Auction(null);
	if(Sitesetting::EnableFireworks() == true ) {
	  $fireworks = 'enabled';
	}
	if(Sitesetting::EnableGavel() == true ) {
	  $gavel = 'enabled';
	} 	     
	if(Sitesetting::isEnableTimerDelay() == true ) {
	  $timerdelay = 'enabled';
	}       
       

function save_cache($data, $name, $timeout) {
    // delete cache
    $id=shmop_open(get_cache_id($name), "a", 0, 0);
    shmop_delete($id);
    shmop_close($id);
    
    // get id for name of cache
    $id=shmop_open(get_cache_id($name), "c", 0644, strlen(serialize($data)));
    
    // return int for data size or boolean false for fail
    if ($id) {
        set_timeout($name, $timeout);
        return shmop_write($id, serialize($data), 0);
    }
    else return false;
}

function get_cache($name) {
    if (!check_timeout($name)) {
        $id=shmop_open(get_cache_id($name), "a", 0, 0);

        if ($id) $data=unserialize(shmop_read($id, 0, shmop_size($id)));
        else return false;          // failed to load data

        if ($data) {                // array retrieved
            shmop_close();
            return $data;
        }
        else return false;          // failed to load data
    }
    else return false;              // data was expired
}

function get_cache_id($name) {
    // maintain list of caches here
    $id=array(  'test1' => 1,
                'test2' => 2
                );

    return $id[$name];
}

function set_timeout($name, $int) {
    $timeout=new DateTime(date('Y-m-d H:i:s'));
    date_add($timeout, date_interval_create_from_date_string("$int seconds"));
    $timeout=date_format($timeout, 'YmdHis');

    $id=shmop_open(100, "a", 0, 0);
    if ($id) $tl=unserialize(shmop_read($id, 0, shmop_size($id)));
    else $tl=array();
    shmop_delete($id);
    shmop_close($id);

    $tl[$name]=$timeout;
    $id=shmop_open(100, "c", 0644, strlen(serialize($tl)));
    shmop_write($id, serialize($tl), 0);
}

function check_timeout($name) {
    $now=new DateTime(date('Y-m-d H:i:s'));
    $now=date_format($now, 'YmdHis');

    $id=shmop_open(100, "a", 0, 0);
    if ($id) $tl=unserialize(shmop_read($id, 0, shmop_size($id)));
    else return true;
    shmop_close($id);

    $timeout=$tl[$name];
    return (intval($now)>intval($timeout));
}
function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float) $usec + (float) $sec);
}
function rfloor($real,$decimals) {
        return substr($real, 0,strrpos($real,'.',0) + (1 + $decimals));
    }
function getBidValue($obj){
      
		$onlineperbidvalue = Sitesetting::getBidPrice();
	    
return $onlineperbidvalue;

}
function templateRecordLimit($template){
$limit = 8;
      switch($template){
	  
	  case('wavee'):
	  $limit = 5;
	  break;
	  case('sticky'):
	  $limit = 5;
	  break;
      }
    return $limit;
}
function is_url($url){
    $url = substr($url,-1) == "/" ? substr($url,0,-1) : $url;
    if ( !$url || $url=="" ) return false;
    if ( !( $parts = @parse_url( $url ) ) ) return false;
    else {
        if ( $parts[scheme] != "http" && $parts[scheme] != "https" && $parts[scheme] != "ftp" && $parts[scheme] != "gopher" ) return false;
        else if ( !eregi( "^[0-9a-z]([-.]?[0-9a-z])*.[a-z]{2,4}$", $parts[host], $regs ) ) return false;
        else if ( !eregi( "^([0-9a-z-]|[_])*$", $parts[user], $regs ) ) return false;
        else if ( !eregi( "^([0-9a-z-]|[_])*$", $parts[pass], $regs ) ) return false;
        else if ( !eregi( "^[0-9a-z/_.@~-]*$", $parts[path], $regs ) ) return false;
        else if ( !eregi( "^[0-9a-z?&=#,]*$", $parts[query], $regs ) ) return false;
    }
    return true;
}
function GetProductHistoryNew($aucid, $uid) {

global $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME, $db, $debug;
if(!$db){
$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
}

db_select_db($DATABASENAME, $db);
$limit = templateRecordLimit($template);

    $rescheck = db_query("select use_free from auction_running where auctionID=$aucid");
    $objcheck = db_fetch_array($rescheck);
if(!$db){
$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
}

db_select_db($DATABASENAME, $db);
$limit = templateRecordLimit($template);
    $rescheck = db_query("select use_free from auction_running where auctionID=$aucid");
    $objcheck = db_fetch_array($rescheck);

    if ( $objcheck["use_free"] == 1 ) {
        $qryhis = "select * from free_account_bidding where auction_id='$aucid' order by id desc limit 0, $limit";
    } else {
        $qryhis = "select * from bid_account_bidding where auction_id='$aucid' order by id desc limit 0, $limit";
    }
    $reshis = db_query($qryhis) or die(db_error());
    $total  = db_num_rows($reshis);
    $temp2 = array();
    $i= 0;
    while($obj = db_fetch_array($reshis)){

	  $temp1[$i] = array("his" => array("bp"=>number_format($obj['bidding_price'], 2, '.', ''), "un"=>$obj['username'], "bt"=>$obj['bidding_type'],"latlng"=>$obj['position']));
	  $temp2[$i] = array("mhis"=>array("bp"=>number_format($obj['bidding_price'], 2, '.', ''),"t"=>substr($obj['bidpack_buy_date'],10),"bt"=>$obj['bidding_type']), "un"=>$obj['username']);
     $i++;  
    }
        $qrysel = "select * from bidbutler where auc_id='$aucid' and butler_status='0' order by id desc limit 0,$limit";
        $ressel = db_query($qrysel);
        $total = db_num_rows($ressel);
	$bidbutler = array();
	$i = 0;
        while($obj = db_fetch_array($ressel)){
            $bids=$obj['butler_bid']-$obj['used_bids'];
           
                $bidbutler[$i] = array("bidbutler"=>array("startprice"=>number_format($obj['butler_start_price'],2),"endprice"=>number_format($obj['butler_end_price'],2),"bids"=>$bids,"id"=>$obj['id']));
           $i++;
        }
        //echo '{"butlerslength":['.$bidbutler.']}';

        return array("hiss"=>$temp1,"mhiss"=>$temp2,"butlerslength"=>$bidbutler);
   
    echo db_error();
}
      $aggregate_seats_and_bids = 'yes';
 
	class Colors_CLI {
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
 
$newpauseglobalcounter = 1;
$auction_pause_status = 0;
$totalauctpassel;
$reserve_icon = Sitesetting::reserve_icon();

$adminautobidtype = Sitesetting::getAdminAutoBidderType() == '0' ? 'b' : 's';
db_query("alter table auction modify column reserve decimal(11,2) ;");
db_query("alter table auction_running modify column reserve decimal(11,2) ;");
    @db_query("alter table auction_running modify column auctionID int(11) unique not null;");
    @db_query("alter table auction_run_status modify column auctionID int(11) unique not null;"); 
    @db_query("alter table auc_due_table modify column auction_id int(11) unique not null;"); 
    
    

function initUpdateTime() {

$colors = new Colors_CLI();

    global $auction_pause_status, $newpauseglobalcounter, $totalauctpassel, $db, $debug;
    $qry = "select * from auction_pause_management where id='1'";
    $rs = db_query($qry);
    $total = db_num_rows($rs);
    $ob = db_fetch_object($rs);
    $st = explode(":", $ob->pause_start_time);
    $et = explode(":", $ob->pause_end_time);
      if(!empty( $debug )){
        echo $colors->getColoredString("****ALERT CHECKING PAUSED AUCTIONS****", "red") . "\n";
       }
    $querysel = "select auctionId from auction_running where auc_status='2' and pause_status='1' limit 0,1";
    $resultsel = db_query($querysel) or die(db_error());
    $totalauctpassel = db_num_rows($resultsel);

    if ($totalauctpassel > 0) {
        $startpausetime = $ob->pause_start_timestamp;
        $auction_pause_status = 1;
        if(!empty( $debug )){
           echo $colors->getColoredString("!!!!!!!!!AUCTIONS ARE PAUSED!!!!!!", "brown") . "\n";
            echo $colors->getColoredString("!!!!!!!!!OUTPUT WILL NOT DISPLAY UNTIL THEY RESTART!!!!!!", "purple") . "\n";
          }
        //fetch from query which is set when auction is actually paused.
    } else {
	if(!empty( $debug )){
	 echo $colors->getColoredString("!!!!!!!!!AUCTIONS ARE LIVE!!!!!!", "green") . "\n";
	}
 
	$startpausetime = mktime($st[0], $st[1], $st[2], date("m"), date("d"), date("Y"));
    }
      if(!empty( $debug )){
	  echo $totalauctpassel . "\n";
	  echo CheckTimeGreater($st[0], $st[1], $st[2], $et[0], $et[1], $et[2]) . "\n";
      }
    if (CheckTimeGreater($st[0], $st[1], $st[2], $et[0], $et[1], $et[2]) == 1) {
        if ($totalauctpassel > 0) {
            if (date("Y-m-d") > date("Y-m-d", $startpausetime)) {
                $endpausetime = mktime($et[0], $et[1], $et[2], date("m"), date("d"), date("Y"));
            } else {
                $endpausetime = mktime($et[0], $et[1], $et[2], date("m"), date("d") + 1, date("Y"));
            }
            // if server date is greater then timestamp date then dont add one day otherwise add one day in date.
        } else {
            $endpausetime = mktime($et[0], $et[1], $et[2], date("m"), date("d") + 1, date("Y"));
        }
    } else {
        $endpausetime = mktime($et[0], $et[1], $et[2], date("m"), date("d"), date("Y"));
    }
    return $auction_pause_status;
}

clearEndedTable();
initUpdateTime();

$auctiontime_record = 0;

$scriptstarttime = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));

if ($scriptstarttime > mktime(12, 0, 0, date("m"), date("d"), date("Y"))) {
    $scriptendtime = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
} else {
    $scriptendtime = mktime(12, 0, 0, date("m"), date("d"), date("Y"));
}

$colors =new Colors_CLI();

$thisloop = 0;

while($thisloop < 1){
    $auction_settings = db_fetch_array(db_query("select * from sitesetting where name = 'resettime' limit 1"));
    $reserve_text_timeout = db_fetch_array(db_query("select * from sitesetting where name = 'reservetext_limit' limit 1"));
    $aggregate_seats_and_bids = db_fetch_array(db_query("select * from sitesetting where name = 'aggregate' limit 1"));
    $reservetext = db_fetch_array(db_query("select * from sitesetting where name = 'reservetext' limit 1"));
    $resettime = $auction_settings[2];
    $aggregate_seats_and_bids = $aggregate_seats_and_bids[2];
    $reserve_text_timeout = $reserve_text_timeout[2];
    $reservetext = $reservetext[2];

    $qryupdtime2 = "update auction_pause_management set referral_bids='1' where id='4'";
    db_query($qryupdtime2);
    $auction_record = FALSE;
    while ($auction_record == FALSE) {
	
	$querysel = "select auctionId from auction_running where auc_status='2' and pause_status='1' limit 0,1";
	$resultsel = db_query($querysel) or die(db_error());
	$totalauctpassel = db_num_rows($resultsel);

	    if ($totalauctpassel > 0) {
	    }else{
	      $auction_paused = 1;
		if(!empty( $debug )){
		  echo $colors->getColoredString("[" . date("Y-m-d H:i:s") . "] ****TIMERS RUNNING****", "green") ."\n";
		}
	    }
	$loopstarttime = microtime(true);
	if(!empty( $debug )){
	    echo $scriptstarttime . "\n"; 
	    echo $scriptendtime . "\n";
	}
	if (time() >= $scriptstarttime && time() <= $scriptendtime) {
	    $qryupdtime = "update auction_pause_management set referral_bids=referral_bids+1 where id='4'";
	    db_query($qryupdtime);

	    $qrysel = "select * from auc_due_table adt left join auction au on au.auctionId=adt.auction_id left join auction_running a on a.auctionID=adt.auction_id left join auction_run_status ars on ars.auctionID=adt.auction_id inner join auction_management am on am.auc_manage=au.time_duration where auc_due_time>0 and (au.auc_status = 2 or au.escroe=1) and (au.pause_status = 0 or au.escroe=1) order by adt.auction_id";

	    $ressel = db_query($qrysel);
	    $total = db_num_rows($ressel);
	    $arrResult = array();
	    while ($obj = db_fetch_array($ressel)) {
	    $resettime = $obj['time_duration'];  

	    
	      $aucdata=new stdClass();
	      $escrow_data = db_fetch_array(db_query("select sum(bids_pledged) as bids, count(user_id) as backers from auction_escrow where auction_id = '$obj[auction_id]' and completed = '1'"));
	      if($obj['escroe'] == 1){
		  $aucdata->backers = $escrow_data['backers'];
		  $aucdata->bids_needed = number_format($obj['escroe_bids'],0) - number_format($escrow_data['bids'], 0);
		  $aucdata->percent_funded = number_format(floor((number_format($escrow_data['bids'], 0)/number_format($obj['escroe_bids'],0))*100), 0);
		  if($debug == true){
		    echo "Escrow Bids" . $escrow_data['bids'] . "\n";
		    echo "Bids still needed = " .$aucdata->bids_needed . "\n";
		    echo "Minimum needed to fund " . number_format($obj['escroe_bids'], 0) . "\n";
		  
		    echo $aucdata->percent_funded . "\n";
		  }
		  
		  if(number_format($escrow_data['bids'], 0) >= number_format($obj['escroe_bids'], 0)){
		    $override_time = false;
		      if(db_num_rows(db_query("select * from auction where escroe = '0'")) < 20){
			$qry_backers = db_query("select r.id,r.email, r.username, r.firstname, r.lastname from auction_escrow left join registration r on r.id=auction_escrow.user_id where auction_escrow.auction_id = '$obj[auction_id]'");
			while($row_backers = db_fetch_array($qry_backers)){
			   SendFundedMail($obj['auction_id'], $row_backers);
			}
			db_query("update auction set escroe = '0' where auctionID = '$obj[auction_id]' and escroe = '1'");
		//	db_query("update auction set pause_status = '0' where auctionID = '$obj[auction_id]'");
		
		      }
		      else{
			  $override_time = true;
		//	  db_query("update auction set pause_status = 1 where auctionID = '$obj[auction_id]'");
	      
		    } 
		  }else{
		    $override_time = true;
		//    db_query("update auction set pause_status = 1 where auctionID = '$obj[auction_id]'");
	      
		}
	      } else {
		$override_time = false;
	      
	      }
	     
		echo db_error();
		if(empty($obj['productID'])){
		    db_query("delete from auction where auctionID = '$obj[auctionID]' limit 1");
		    db_query("delete from auction_running where auctionID = '$obj[auctionID]' limit 1");
		    db_query("delete from auction_run_status where auctionID = '$obj[auctionID]' limit 1");
		    db_query("delete from auc_due_table where auction_id = '$obj[auctionID]' limit 1");
		}
		$reservetime = '';
		$oldtime = $obj["auc_due_time"];
		if ($oldtime <= 0) {
		    if($override_time == true){
		      $newtime = $oldtime;
		    }else{
		      
		      $newtime = 0;
		   }
		} else {
		    if($override_time == true){
		      $newtime = $oldtime;
		    }else{
		      
		      $newtime = $oldtime - 1;
		   }
		}

		$aid = $obj["auction_id"];

		$autoret = -1;
		if ($autoret == -1) {
		    $temptime = $obj['auc_due_time'];

		    if ($newtime <= $obj['max_plus_time'] && $newtime >= 0) {
	      
		    }
		}else{
		    $newtime=$autoret;
		}
		begin();
		$lefttime=getLeftTime($aid);
		if($lefttime!=$oldtime && $lefttime>$newtime){
		    $newtime=$lefttime;
		}
		if(db_num_rows(db_query("SELECT reserve from auction where auctionid = '$aid' AND (reserve > '0' or reserve != '')")) >= 1 ){
		  $reservetime = '';
		  $aucdata->reserve_icon = 'true';
		      if(!empty( $debug )){
			echo $colors->getColoredString("*****A RESERVE HAS BEEN SET => EVALUATING TIMER AND PRICE for $aid ****** ", "red") . "\n";
		      }
			$qryselres = "select auction.auctionID, auc_final_price, auction.reserve, newprice, auction.seatauction, auction.minseats, auction.seatbids from auction, auction_run_status";
			    $qryselres .= " where auction.auctionID = auction_run_status.auctionid and  auction.auctionID = '$aid'";
			    $qryselres .= "AND auction_run_status.auctionid = '$aid'";
			    $resselres = db_query($qryselres);
			    $objres = db_fetch_array($resselres);
			      if(!empty($aggregate_seats_and_bids)){
				if($objres[4] >= 1){
				    $users_seat = db_fetch_array(db_query("select count(user_id) from auction_seat where auction_id = '$objres[0]'"));
				    $seat_total_price = number_format($objres[6] * $users_seat[0], 2, '.', '') + number_format($objres[3], 2, '.', '');
					if(!empty( $debug )){
					      echo $colors->getColoredString("*****TESTING TO SEE IF THIS IS A SEATED AUCTION WITH A RESERVE AND HOW TO PROCEED", "purple") . "\n";
					      echo $colors->getColoredString("*****TESTING TO SEE IF CHECK TO SEE IF THIS IS A SEATED AUCTION*****", "white") . "\n";
				    
					      echo $colors->getColoredString("", "red") . "\n";
					      echo $colors->getColoredString("*****SEATED AUCTION WITH A RESERVE FOUND FOR for $aid ****** ", "red") . "\n";
					      echo $colors->getColoredString("*****SEATED AUCTION WITH A RESERVE FOUND FOR for $aid ****** ", "red") . "\n";
					      echo $colors->getColoredString("*****SEATED AUCTION WITH A RESERVE FOUND FOR for $aid ****** ", "red") . "\n";
					      echo $colors->getColoredString("", "red") . "\n";		  
		      
					      echo $colors->getColoredString("*****GET THE NUMBER OF SEATS ON THE AUCTION AND PROCEED IF GREATER THAN MINSEATS****", "white") . "\n";
					  
					      echo $colors->getColoredString("*****THE NUMBER OF SEATS IS $users_seat[0] THE MINIMUM REQUIREMENT IS $obj[minseats] ****", "white") . "\n";
					  }
			      }else{
		
				  $seat_total_price = number_format($objres[3], 2, '.', '');
			}
		}else{
			          $seat_total_price = number_format($objres[3], 2, '.', '');
		
		}
			if($seat_total_price >= $objres[2] ){
				$aucdata->reserve = $objres[2];
				$aucdata->newreserve = 'true';
				if(!empty( $debug )){
				      echo $colors->getColoredString("*****RESERVE AND SEAT BIDS EXCEEDS THE RESERVE => AUCTION SHOULD PROCEED ****", "green") . "\n";
				  }
				  db_query("update auction_run_status set auction_message = '' where auctionid = '$aid'");	
				}else{
				$aucdata->reserve = $objres[2];
				$aucdata->newreserve = 'true';
				db_query("update auction_run_status set auction_message = '' where auctionid = '$aid'");	
				  if($lefttime <= 3 ){
				    @db_query("alter table auction_run_status add column auction_message varchar(20) null");
					$newtime = $resettime; 
					if(!empty( $debug )){
					      echo $colors->getColoredString("*****RESERVE AND SEAT BIDS HAS NOT YET MET THE RESERVE => ADD OUR NEW TIME ( $newtime ) HERE ****", "yellow") . "\n";
					  }
					  $aucdata->reserve = $reservetext;
					  $aucdata->newreserve = $reservetext;
					  db_query("update auction_run_status set auction_message = '" . db_real_escape_string($reservetext) . "' where auctionid = '$aid'");
					  echo db_error();
				    }else{
				    if(!empty( $debug )){
				      echo $colors->getColoredString("*****RESETTING AUCTION MESSAGE ****", "white") . "\n";
				    }	
				      $aucdata->reserve = $objres[2];
				      $aucdata->newreserve = $objres[2];
				      $ignoretime = $resettime - $reserve_text_timeout;
				      if($lefttime >= $ignoretime & $lefttime > $obj['max_plus_time'] ){
					  if($lefttime <= $resettime & $lefttime >= $ignoretime ){
					      $aucdata->reserve = $reservetext;
					      db_query("update auction_run_status set auction_message = '" . db_real_escape_string($reservetext) . "' where auctionid = '$aid'");	
					      }else{
					         $aucdata->reserve = $objres[2];
					         db_query("update auction_run_status set auction_message = '' where auctionid = '$aid'");
					     }
				      }
				      else{
					  $aucdata->reserve = $objres[2];
					  $aucdata->newreserve = $objres[2];
					  db_query("update auction_run_status set auction_message = '' where auctionid = '$aid'");
				      }
				    }
	      }
      }else{
	    if(!empty( $debug )){
	      echo $colors->getColoredString("*****NO RESERVE HAS BEEN SET => UPDATING TIMER for $aid ****** ", "yellow") . "\n";
	    }
	    
	 }
	  if($obj['seatauction'] == '1'){
	      $users_seat = db_fetch_array(db_query("select count(user_id) from auction_seat where auction_id = '$obj[auctionID]'"));
	      if(!empty( $debug )){
		  echo $colors->getColoredString("", "red") . "\n";
		  echo $colors->getColoredString("*****SEATED AUCTION FOUND FOR for $aid ****** ", "red") . "\n";
		  echo $colors->getColoredString("*****SEATED AUCTION FOUND FOR for $aid ****** ", "red") . "\n";
		  echo $colors->getColoredString("*****SEATED AUCTION FOUND FOR for $aid ****** ", "red") . "\n";
		  echo $colors->getColoredString("", "red") . "\n";
		  echo $colors->getColoredString("*****THE NUMBER OF SEATS IS $users_seat[0] THE MINIMUM REQUIREMENT IS $obj[minseats] ****", "white") . "\n";
	      }
		    if($users_seat[0] >= $obj['minseats']){
			$seats_sql = db_query("select * from auction_seat left join registration r on r.id=auction_seat.user_id where auction_id=$obj[auctionID]");
			while($row_seated_users = db_fetch_array($seats_sql)){
			      SendSeatMail($obj['auctionID'], $row_seated_users);
			}
			    if(!empty( $debug )){
				  echo $colors->getColoredString("*****SEATS HAVE BEEN FILLED => STARTING AUCTION $aid NOW ****", "white") . "\n";
			      }
				    $qryupd = "update auc_due_table set auc_due_time='$newtime' where auction_id='$aid'";
				    db_query($qryupd) or die(db_error());
				    $upsql = "update auction_run_status set lefttime='$newtime' where auctionid='$aid'";			
			    }else{
				if(!empty( $debug )){
				  echo $colors->getColoredString("*****SEATS HAVE NOT BEEN FILLED => STARTING AUCTION $aid LATER ****", "yellow") . "\n";
				}
			    }
	      }else{
		      $qryupd = "update auc_due_table set auc_due_time='$newtime' where auction_id='$aid'";
		      db_query($qryupd) or die(db_error());
		      $upsql = "update auction_run_status set lefttime='$newtime' where auctionid='$aid'";
		      db_query($qryupd) or die(db_error());
			if(!empty( $debug )){  
			    echo $colors->getColoredString("*****Updating time for $aid NOW ****", "white") . "\n";
			}
	    }
	    
		db_query($upsql);
		commit();

		if ($newtime == 0) {                
		    UpdateAuction($aid);
		    UpdateCompleteButlers($aid, $obj["use_free"]);
		    //clear the seat_auction table when the end auction is seat auction
		    if ($obj['seatauction'] == true) {
			$delqry = "delete from auction_seat where auction_id='$aid'";
			db_query($delqry);
		    }

		    if ($obj['relist'] == true ) {
			      echo $colors->getColoredString("*****RELISTING AUCTION $auctionID *******", "cyan") ."\n";
			      $sql_check = "select * from auction where relisted_from = '$aid'";
			      if(db_num_rows(db_query($sql_check)) == 0){
				    
				
				     $obj_res = db_fetch_array(db_query("select * from auction where auctionID = '$aid'"));
				    
				      $interval_b = strtotime($obj_res['auc_end_date'] . ' ' . $obj_res['auc_end_time']) - strtotime($obj_res['auc_start_date'] . ' ' . $obj_res['auc_start_time']);
				      $now_b = time();
				      $startdate_b = date('Y-m-d', $now_b);
				      $starttime_b = date('H:i:s', $now_b);
				      $enddate_b = date('Y-m-d', $now + $interval_b);
				      $endtime_b = date('H:i:s', $now + $interval_b);
				      $qryins_b = "Insert into auction (categoryID,productID,auc_start_price,auc_fixed_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_recurr,total_time,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,use_free,allowbuynow,buynowprice,uniqueauction,reverseauction,halfbackauction,tax1,tax2,relist,bidpack,reserve, cashauction, minseats, maxseats , free_seats, seatauction, relisted_from, escroe, escroe_bids) values('{$obj_res['categoryID']}','{$obj_res['productID']}',{$obj_res['auc_start_price']},{$obj_res['auc_fixed_price']},'','$startdate','$enddate','$starttime','$endtime','2','{$obj_res['auc_type']}','{$obj_res['fixedpriceauction']}','{$obj_res['pennyauction']}','{$obj_res['nailbiterauction']}','{$obj_res['offauction']}','{$obj_res['nightauction']}','{$obj_res['openauction']}','{$obj_res['time_duration']}','{$obj_res['auc_recurr']}','$interval','{$obj_res['shipping_id']}','$now','{$obj_res['recurr_count']}','{$obj_res['auction_min_price']}','" . $obj_res['min_win_price'] . "','{$obj_res['use_free']}','{$obj_res['allowbuynow']}','{$obj_res['buynowprice']}','{$obj_res['uniqueauction']}','{$obj_res['reverseauction']}','{$obj_res['halfbackauction']}','{$obj_res['tax1']}','{$obj_res['tax2']}','{$obj_res['relist']}','{$obj_res['bidpack']}', '{$obj_res['reserve']}', '{$obj_res['cashauction']}', '{$obj_res['minseats']}', '{$obj_res['maxseats']}', '{$obj_res['free_seats']}', '{$obj_res['seatauction']}', '{$obj_res['auctionID']}', '{$obj['escroe']}', '{$obj['escroe_bids']}')";
			      

			             db_query($qryins_b); echo db_error();
			      

				      $newid = db_fetch_array(db_query("select auctionID from auction order by auctionID desc limit 1")); 
				      $qry_b = "Insert into auc_due_table (auction_id,auc_due_time,auc_due_price) values($newid[0],'$interval','{$obj_res['auc_start_price']}')";
				      db_query($qry_b);
				      initRunningTable($newid[0]);    
			  }else{
			  
			  echo $colors->getColoredString("*****IGNORE RELIST for $obj[auctionID] since it has already been relisted*******", "cyan") ."\n";
			  
			}
			  
		    }
		}
	  $aucdata->prid=$obj['productID'];
	  $aucdata->np = number_format($obj['auc_due_price'], 2, '.', ''); 
	  $aucdata->bids_to_take = $obj['bids_to_take'];


	      if($obj['lefttime'] >= 0 ){
		    $aucdata->lt=$obj['lefttime'];
		    $aucdata->p=$obj['pause_status'];
	      }else{
		  if($obj['auc_status'] == 1){
		      $aucdata->lt=$obj['future_tstamp'] - time();
		      $aucdata->p='Future';
		  }else if($obj['auc_status'] == 2){
		      $aucdata->p='Active';
		  }else if($obj['auc_status'] == 3){
		      $aucdata->p='Ended';
		  }
	      }	

	      $aucdata->id=$obj['auctionID'];
	      $aucdata->ua=$obj['uniqueauction'];
	      $aucdata->biddercount = db_num_rows(db_query("select distinct(username) from bid_account_bidding where auction_id = " .$aucdata->id ));
		  if($obj['uniqueauction']){
		      $aucdata->lbc=$obj['lowbidcount'];
		  }
		  $heighuser=json_decode($obj['heighuser']);
              $aucdata->cashauction = $obj['cashauction'];
		  $seated = array();

		  $querySb = db_query("select user_id from auction_seat where auction_id = '" . $aucdata->id . "'");

		  while($rowSb = db_fetch_array($querySb)){
		    $seated[]= $rowSb['user_id'];
		  }
	      $aucdata->sbids=$seated;
       	      $aucdata->san=$obj['seatauctionnow'];

		  $objSc = db_num_rows(db_query("select id from auction_seat where auction_id = '" . $obj['auctionID']  . "'"));
		  $aucdata->sc=$objSc;
	    
	    
		if($obj['seatauction'] == 1){
	      $aucdata->sa=$obj['seatauction'];
		}
	      $aucdata->ms=$obj['minseats'];
	    
		  if($objSc < $obj['minseats']){
	      
	      $aucdata->seated_users = array();
		  
			        $sql_seated_users = db_query("select distinct(user_id), username from auction_seat, registration where auction_id = '" . $aucdata->id  . "' and registration.id=auction_seat.user_id order by auction_seat.id desc");
			        $r = 0;
				while($row_seated_users = db_fetch_array($sql_seated_users)){
		    
				    array_push($aucdata->seated_users, urlencode($row_seated_users['username']));
				    $heighuser[$r] = urlencode($row_seated_users['username']);
				$r++;
			        }
	      $aucdata->hu = $aucdata->seated_users[0];
		  }else{
	      $aucdata->seated_users = $obj['heighuser'];
		  }
		  $p = count($heighuser); 
		  if($p < 3){

		  while($p <= 3){
		  array_push($heighuser, "---");
		  $p++;
		  }
		  
		  }
		  if($heighuser[0] == '---'){
		  $heighuser[0] = 'Bid first';
		  }
	      $aucdata->hu = $heighuser[0];
	    
	      $uid = db_fetch_array(db_query("select * from registration left join avatar a on a.id = registration.avatarid where username = '" . $aucdata->hu . "'"));
	  
	    
		  if(!empty($uid['id'])){
	      $aucdata->winid[$obj['auctionID']] = base64_encode($aucdata->np . "&". $obj['auctionID']);
	      $aucdata->uid = $uid['id'];
	      $aucdata->winner[$obj['auctionID']] = $uid['id'];
		  }else{
	      $aucdata->uid = 0;
	      $aucdata->winner[$obj['auctionID']] = 0;
		  }

		if(!empty($aucdata->uid)){
		    update_users_bids($aucdata->uid);
		    $user_bids = get_users_bids($aucdata->uid);
		}
		
		if(empty($aucdata->hu)){
	            $aucdata->hu = '';
		  }else{
		  
		    if(empty($uid['avatar']) | !file_exists("$BASE_DIR/uploads/avatars/" . $uid['avatar'])){
	      $aucdata->av = $SITE_URL . "uploads/avatars/default.png";
		    }else{
	      $aucdata->av = $SITE_URL . "uploads/avatars/" . $uid['avatar'];
		    }
		  if(function_exists('social_avatar')){
		    $aucdata->av = social_avatar($uid[0], $aucdata->av);
		  }
		}
		  $qry = "select * from auction left join bidpack b on auction.productID=b.id left join products p on auction.productID=p.productID left join auction_management am on auction.time_duration=am.auc_manage where auctionID=" . $obj['auctionID'];
		  $auc_data = db_fetch_object(db_query($qry));
		  $onlineperbidvalue = getBidValue($obj);

		    if ($obj["fixedpriceauction"] == "1") {
			$fprice = $obj["auc_fixed_price"];
		    } elseif ($obj["offauction"] == "1") {
			$fprice = "0.00";
		    } else {
			$fprice = $obj["auc_due_price"];
		    }
			if($timerdelay == 'enabled'){
			  $aucdata->tdelay = 1;
			  $aucdata->lt = $aucdata->lt - 4;
			      if($aucdata->lt <= 0){
				  if($aucdata->lt == 0){
				      $aucdata->delay_text = 'Going Once';
				  }else if($aucdata->lt == -1){
				      $aucdata->delay_text = 'Going Twice';
				  }else if($aucdata->lt == -2){
					  $aucdata->delay_text = 'Gone';
				  }else{
				  if($reserve <= 0.00 | $np > $reserve){
				      $aucdata->delay_text = $aucdata->lt;
				      $aucdata->tdelay = 0;
				    }
				  
				  }
			      
			      }else{
				  $aucdata->delay_text = $aucdata->lt;
			      }
			    
			  }else{
				
			      $aucdata->delay_text = $aucdata->lt;
			  }
			if($gavel == true){
			    if($aucdata->lt <=10){
			      $aucdata->gavel = 1;
			    }else{
			      $aucdata->gavel = 0;
			    }
		
			}
			if($fireworks == true){
			    $aucdata->fireworks = 1;
			}
		    $aucdata->tb = $heighuser;
		    $aucdata->at= $obj['auc_plus_time']; 
		    if(empty($aucdata->at)){
		      $aucdata->at = '30';
		    }
		    $aucdata->history = GetProductHistoryNew($obj['auctionID'], $aucdata->hu);
		array_push($arrResult, $aucdata);
	  }
    $fp = fopen("update_results.json", "w+");
    fwrite($fp, json_encode(array('message' => 'ok', 'data' => array_values($arrResult))));
    fclose($fp);
    shell_exec("chmod 777 update_results.json");
    shell_exec("chown nginx:nginx update_results.json");

	    FutureAuctionManage();

	    if (time() >= $startpausetime && $endpausetime >= time() && $auction_pause_status == 0) {
		PauseDayAuction();
		$qryupdtstamp = "update auction_pause_management set pause_start_timestamp='" . $startpausetime . "' where id='1'";
		db_query($qryupdtstamp) or die(db_error());
		Makeentryinlog($startpausetime, $endpausetime, time(), $newpauseglobalcounter);
		$auction_pause_status = 1;
		$newpauseglobalcounter++;
	    }
	    if (time() > $endpausetime && $auction_pause_status == 1) {
		RunDayAuction();
		Makeentryinlog($startpausetime, $endpausetime, time(), $newpauseglobalcounter);
		$auction_pause_status = 2;
		$newpauseglobalcounter++;
	    }
	    $counter_record++;
	    if ($counter_record >= 100) {
		initUpdateTime();
		$qry = "select * from auction_pause_management where id='1'";
		$rs = db_query($qry);
		$total = db_num_rows($rs);
		$ob = db_fetch_object($rs);
		Makeentryinlog($startpausetime, $endpausetime, time(), $newpauseglobalcounter);
		if ($ob->auction_end == 1) {
		    exit;
		}
		$counter_record = 0;
	    }

	    $loopendtime = microtime(true);
	    $consumingtime = (1 - (($loopendtime - $loopstarttime) ));
	    if ($consumingtime > 0) {
		usleep($consumingtime * 1000000);
	    }
	    $auctiontime_record++;
	    if ($auctiontime_record >= 300/* 43200 */) {
		$auction_record = TRUE;
	    }
	} else {
	    $auction_record = TRUE;
	}
    }
}
if(empty($debug)){
ob_end_clean();
}

?>