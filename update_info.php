<?php

//if(preg_match("/" . str_replace($_SERVER['SERVER_NAME']) . "/", $_SERVER['HTTP_REFER'])){
header("Access-Control-Allow-Origin: *");
header("content-type: application/json");
//}
session_start();
$json_script_two = 'set';



$json_script = 'true';

require("config/config.inc.php");



include("Functions/update_users_bids.php");

include_once $BASE_DIR . '/data/bidaccount.php';

include_once $BASE_DIR . '/data/auction.php';
include_once $BASE_DIR . '/Functions/cornerImag.php';
include_once $BASE_DIR . '/Functions/social_avatar.php';
//include("pcntl.php");
    
function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float) $usec + (float) $sec);
}
function rfloor($real,$decimals) {
        return substr($real, 0,strrpos($real,'.',0) + (1 + $decimals));
    }



    include_once $BASE_DIR . '/common/sitesetting.php';





      if(Sitesetting::EnableFireworks() == true ) {
	  $fireworks = 'enabled';
	}
	if(Sitesetting::EnableGavel() == true ) {
	  $gavel = 'enabled';
	} 	     
	    


	if(Sitesetting::isEnableTimerDelay() == true ) {
	$timerdelay = 'enabled';
	
	}
	


/*
 * PennyAuctionSoft08 add 2010-1-28
 * get the price and bidcount via ajax
*/


if ($_SERVER["HTTP_X_REQUESTED_WITH"] != "XMLHttpRequest") {
    //exit;
}
if(empty($_REQUEST['uid'])){
$uid = $_SESSION["userid"];
}else{
$uid = $_REQUEST['uid'];

}





$qry = db_query("select distinct(value) from sitesetting where name = 'addons'");

$addons = array();

while($row = db_fetch_array($qry)){

$addons[] = $row[0];


}

$display_avatar = '';
if (!empty($_REQUEST['avatar'])) {
    $display_avatar = $_REQUEST['avatar'];
}
$tempkey='lastvisittime'. $_SERVER['REMOTE_ADDR'];
$starttime = microtime_float();

if(!isset($_REQUEST['cornerImag'])){
if(isset($_SESSION[$tempkey]) && $starttime-$_SESSION[$tempkey]<0.9 ){
  // echo json_encode(array('message' => 'failed','interval'=>$starttime-$_SESSION[$tempkey]));
  //  exit;
}
}
$_SESSION[$tempkey] = '';
$_SESSION[$tempkey]=$starttime;

$_SESSION['lastruntime'] = time();

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
function GetProductHistoryNew($aucid, $uid) {

global $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME, $db;
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
        
      if($obj['bidding_price'] == 0.00){
            $temp2[$i] = array("his" => array("bp"=>number_format(0.00, 2, '.', ''),"un"=>$obj['username'], "bt"=>$obj['bidding_type'],"latlng"=>$obj['position']));
	}else{
	
	       $temp2[$i] = array("his" => array("bp"=>number_format($obj['bidding_price'], 2, '.', ''),"un"=>$obj['username'], "bt"=>$obj['bidding_type'],"latlng"=>$obj['position']));
	
	
	}
     
     
     $i++;  
    }

   
        if ( $objcheck["use_free"] == 1 ) {
            $qryhis1 = "select * from free_account_bidding where auction_id='$aucid' and user_id='$uid' order by id desc limit 0,4";
        } else {
            $qryhis1 = "select * from bid_account_bidding where auction_id='$aucid' and user_id='$uid' order by id desc limit 0,4";
        }

        $reshis1 = db_query($qryhis1);
        echo db_error();
        $total1  = db_num_rows($reshis1);
        $temp21 = array();
        $i = 0;
        while($obj1 = db_fetch_array($reshis1)){
           if($obj1['bidding_price'] == 0.00 & db_num_rows(db_query("select * from bid_account_bidding where auction_id = " . $aucid)) == 0 & db_num_rows(db_query("select * from free_account_bidding where auction_id = " . $aucid)) == 0){
                $temp21[$i] = array("mhis"=>array("bp"=>number_format(0.00, 2, '.', ''),"t"=>substr($obj1['bidpack_buy_date'],10),"bt"=>$obj1['bidding_type']));
	      }else{
		 $temp21[$i] = array("mhis"=>array("bp"=>number_format($obj1['bidding_price'], 2, '.', ''),"t"=>substr($obj1['bidpack_buy_date'],10),"bt"=>$obj1['bidding_type']));
	    
	      
	      }
          
          $i++; 
        }

        $qrysel = "select * from bidbutler where user_id='$uid' and auc_id='$aucid' and butler_status='0' order by id desc limit 0,4";
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

    if (!empty($temp2)) {
        return array("hiss"=>$temp2,"mhiss"=>$temp21,"butlerslength"=>$bidbutler);
    } else {
        return array("butlerslength"=>$bidbutler);
    }
}

if(!is_array($_REQUEST['auctionlist'])){
$auctionlist =urldecode($_REQUEST['auctionlist']);



$aucids = explode(",", $auctionlist);
}else{

$aucids = $_REQUEST['auctionlist'];

}


$display_avatar = '';
if (isset($_REQUEST['avatar'])) {
    $display_avatar = $_REQUEST['avatar'];
}



$arrResult = array();

foreach($aucids as $key => $value){
$qrysel = "select * from auction left join auction_management am on am.auc_manage = auction.time_duration left join auc_due_table adt on adt.auction_id=auction.auctionID left join auction_run_status s on auction.auctionID = s.auctionid left join products p on auction.productID=p.productID left join bidpack b on auction.productID=b.id where auction.auctionID = '$value'";

$ressel = db_query($qrysel);

while ($obj = db_fetch_array($ressel)) {
//print_r($obj);
    $aucdata=new stdClass();
    $aucdata->prid=$obj['productID'];
   $aucdata->np = number_format($obj['newprice'], 2, '.', ''); 
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




$np = number_format($obj['newprice'], 2, '.', '');
$reserve = number_format($obj['reserve'], 2, '.', '');



$reserve_icon = Sitesetting::reserve_icon();
if($reserve > 0.00 & $np <= $reserve){
$aucdata->newreserve = 'true';
	if(!empty($reserve_icon)){
	
	    $aucdata->reserve_icon = 'true';
	
	}else{
	$aucdata->reserve_icon = 'false';
	
	}
}else{
$aucdata->newreserve = 'false';

}




if($np > $reserve){
    if(!empty($obj['reserve'])){
	$aucdata->reserve = $obj['reserve'];
    }else{
    $aucdata->reserve = $obj['reserve'];
    }
}else{
    
	$aucdata->reserve = $obj['auction_message'];

}


if(empty($aucdata->reserve)){
$aucdata->reserve = '';
}

	  $seated = array();

	    $querySb = db_query("select user_id from auction_seat where auction_id = '" . $aucdata->id . "'");

	      while($rowSb = db_fetch_array($querySb)){
	    
		$seated[]= $rowSb['user_id'];

	    }

	      $aucdata->sbids=$seated;
   
    

    
    
    
		    //  echo db_error();
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
			//	echo db_error();
				$aucdata->hu = $aucdata->seated_users[0];
				
		

	}else{
	$aucdata->seated_users = $obj['heighuser'];
	
     }
       



 $p = count($heighuser); 
 if($p < 3){

 while($p <= 3){
 array_push($heighuser, "Be the first bidder");
 $p++;
 }
}
        $aucdata->hu = $heighuser[0];
        $uid = db_fetch_array(db_query("select * from registration where username = '" . $aucdata->hu . "'"));
        if(!empty($uid['id'])){
	    $aucdata->winid = base64_encode($aucdata->np . "&". $obj['auctionID']);
	    $aucdata->uid = $uid['id'];
	    $aucdata->winner = $uid['id'];
	 }else{
	    $aucdata->uid = 0;
	    $aucdata->winner = 0;
	 }
	    $av = db_fetch_array(db_query("select * from registration left join avatar a on a.id = registration.avatarid where registration.id = '" . $aucdata->uid . "'"));
	    if(!empty($aucdata->uid)){
	    update_users_bids($aucdata->uid);
	    $user_bids = get_users_bids($aucdata->uid);
	    }
	    if(empty($av['avatar']) | !file_exists("$BASE_DIR/uploads/avatars/" . $av['avatar'])){
		$aucdata->av = $SITE_URL . "uploads/avatars/default.png";
	    }else{
		$aucdata->av = $SITE_URL . "uploads/avatars/" . $av['avatar'];
	    }
	    if(function_exists('social_avatar')){
		$aucdata->av = social_avatar($uid[0], $aucdata->av);
	    }
	    if(empty($aucdata->hu)){
	      $aucdata->hu = 'Be the first bidder';
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

$price = $obj['bidpack'] ? $obj['bidpack_price'] : $obj['price'];

$badb=new Bidaccount(null);
$aucdb=new Auction(null);

//if(ceil($starttime % 5) == 0){

	 //	    if(!empty($_SESSION['userid']) & $_SESSION['userid'] != 0 & $aucdata->uid=$_SESSION['userid']){
	    
			  $aucdata->totbid=$badb->countByUserID($obj['auctionID'], $_SESSION['userid']);
			  
			  
			  $user_price = $aucdb->getBuynowPrice($_SESSION['userid'], $obj['auctionID']);
			  $aucdata->buynowprice=number_format($user_price['price'],2);
			  
			  
			  update_users_bids($_SESSION['userid']);
				
				
			  $user_bids = get_users_bids($_SESSION['userid']);
			  
			  $aucdata->my_final_bids = $user_bids['final_bids'];
			  $aucdata->my_free_bids = $user_bids['free_bids'];
			  $aucdata->price=number_format($price, 2, '.', '');
			  $aucdata->fprice=number_format($fprice, 2, '.', '');


			  $aucdata->totbidprice=number_format($aucdata->totbid*$onlineperbidvalue,2, '.', '');
    
    
			  $aucdata->saving=number_format($price-$aucdata->np,2, '.', '');
			  $aucdata->savingpercent=rfloor(number_format(($aucdata->saving/$aucdata->price)*100, 2, '.', ''), 1);			  

	   // }else{

	    
		  //  if(!empty($aucdata->uid)){
			      //$aucdata->totbid=$badb->countByUserID($obj['auctionID'], $aucdata->uid);
			      //$user_price = $aucdb->getBuynowPrice($aucdata->uid, $obj['auctionID']);
			      //$aucdata->buynowprice=number_format($user_price['price'],2);
			  //    if(!empty($_SESSION['userid'])){
			      
				//      $aucdata->your_price = $aucdata->buynowprice=number_format($aucdb->getBuynowPrice($_SESSION['userid'], $obj['auctionID']),2);
			 //     }else{
			      //$aucdata->your_price = $price;
			//      }

		//	}else{
			
			    //$aucdata->your_price = $price;
			    //$aucdata->totbid = 0;
			    //$aucdata->totbidprice = 0.00;
			    //$fprice = 0.00;
			
		//	}

	    //}



    
//}    
    
if(empty($aucdata->saving) | !is_numeric($aucdata->saving)){
$aucdata->savings = 0.00;
}
if(empty($aucdata->buynowprice) | !is_numeric($aucdata->buynowprice)){
$aucdata->buynowprice = $aucdata->price;
}	



	    //Taxes and shipping
	    $uid_info = db_fetch_array(db_query("select * from registration where id = $_SESSION[userid]"));
	    $taxes = $aucdb->getTaxes($obj, $uid_info);
	    $aucdata->tax1 = $taxes[0];
	    $aucdata->tax2 = $taxes[1];
	    
	    $aucdata->taxamount = number_format($taxes[0] + $taxes[1],2);


	  
	  
	  
	 
	 
	//if(ceil($starttime % 5) == 0){ 
	 $history = GetProductHistoryNew($obj['auctionID'], $_SESSION['userid']);
	  
	 
	  
	  $aucdata->history = $history;
	  
	//}else{
    
	//  $aucdata->history = array();
    
	//}
	  
	  


      if(!empty($_SESSION['userid'])){
           $my_bids = db_fetch_array(db_query("select * from bidbutler where auc_id = '" . $obj['auctionID'] . "' and user_id = '$_SESSION[userid]'"));
           

           $aucdata->my_bids = $my_bids['butler_bid'];
           $aucdata->my_used_bids = $my_bids['used_bids'];
           $aucdata->butler_status = $my_bids['butler_status'];
           $aucdata->sp = $my_bids['butler_start_price'];
           $aucdata->ep = $my_bids['butler_end_price'];
           
      }else{
	   $aucdata->my_bids = '';
           $aucdata->sp = '';
           $aucdata->ep = '';
      
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
	  
	 

	if($gavel == 'enabled'){
	if($timerdelay == true){
		if($aucdata->lt <=4){
		  
		    $aucdata->gavel = 1;
		    
		}else{

		    $aucdata->gavel = 1;
		}
	  }else{
	      if($aucdata->lt <=10){
		
		  $aucdata->gavel = 1;
		  
	      }else{

		  $aucdata->gavel = 1;
	      }
	      
	      
	      
	      
	      }
	}
	if($fireworks == 'enabled'){
	    $aucdata->fireworks = 1;
	}
	  
	  

	 // echo db_error();
	 
if(!empty($_REQUEST['cornerImag'])){	  
	$aucdata->image = cornerImag($obj);

	$tooltip = db_fetch_object(db_query("select * from languages where language = 'english' and constant = '" . str_replace(".png", "", str_replace(".gif", "", $aucdata->image)) . "' limit 1"));

	$aucdata->image_tooltip = str_replace('[[SITE_NM]]', $SITE_NM, $tooltip->value);
}

if(isset($as_time)){	  
$aucdata->lt = gmdate("H:i:s", $aucdata->lt);	  
}

$aucdata->quality = $lasttime;

$aucdata->tb = $heighuser;

    array_push($arrResult, $aucdata);
}

}
if(ceil($starttime % 5) == 0){
			foreach($addons as $key => $value){

			    if(file_exists("include/addons/$value/json.php") & $value != 'similar'){

				//  include_once("include/addons/$value/json.php");

			    }

			}
			foreach($addons as $key => $value){

			    if(file_exists("include/addons/$value/update_info.php") & $value != 'similar'){

				//  include_once("include/addons/$value/update_info.php");

			    }

			}
}
echo json_encode(array('message' => 'ok', 'data' => array_values($arrResult), 'time' => microtime_float() - $starttime));

?>