<?php
$loadlanguage=false;
ini_set('display_errors', 1);
$json_script = 'true';
include("config/connect.php");

function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float) $usec + (float) $sec);
}
//include("functions.php");

if ($_SERVER["HTTP_X_REQUESTED_WITH"] != "XMLHttpRequest") {
    exit;
}

if($_GET["aucid_new"] == 'null'){
//die();
}
$aucid=$_GET["aucid_new"];
$uid = $_SESSION["userid"];

$timekey='lasthistoryvisittime-'.$aucid;
$starttime = microtime_float();
if (isset($_SESSION[$timekey]) && $starttime - $_SESSION[$timekey] < 0.5) {
    echo json_encode(array('message' => 'failed', 'interval' => $starttime - $_SESSION[$timekey]));
    exit;
}

$_SESSION[$timekey] = $starttime;



function GetProductHistory($aucid, $uid) {
    $rescheck = db_query("select use_free from auction_running where auctionID=$aucid");
    $objcheck = db_fetch_array($rescheck);

    if ( $objcheck["use_free"] == 1 ) {
        $qryhis = "select * from free_account_bidding where auction_id='$aucid' order by id desc limit 0,5";
    } else {
        $qryhis = "select * from bid_account_bidding where auction_id='$aucid' order by id desc limit 0,5";
    }
    $reshis = db_query($qryhis) or die(db_error());
    $total  = db_num_rows($reshis);
    for ($i = 1; $i <= $total; $i++) {
        $obj = db_fetch_object($reshis);
        if ( $lprice == $obj->bidding_price ) {
            break;
            $flg=1;
        }
        if($obj->bidding_price == 0.00){
	    $obj->bidding_price = 0.00;
        }else{
        
	    $obj->bidding_price = $obj->bidding_price;
        
        
        }
        if ( $i == 1 ) {
        
            $temp2 = '{"his":{"bp":"'.number_format($obj->bidding_price,2).'","un":"'.$obj->username.'","bt":"'.$obj->bidding_type.'"}}';
        } else {
            $temp2 .= ',{"his":{"bp":"'.number_format($obj->bidding_price,2).'","un":"'.$obj->username.'","bt":"'.$obj->bidding_type.'"}}';
        }
    }

    if ( $flg != 1 ) {
        if ( $objcheck["use_free"] == 1 ) {
            $qryhis1 = "select * from free_account_bidding where auction_id='$aucid' and user_id='$uid' order by id desc limit 0,5";
        } else {
            $qryhis1 = "select * from bid_account_bidding where auction_id='$aucid' and user_id='$uid' order by id desc limit 0,5";
        }

        $reshis1 = db_query($qryhis1) or die(db_error());
        $total1  = db_num_rows($reshis1);
        for ($i=1; $i <= $total1; $i++) {
            $obj1 = db_fetch_object($reshis1);
            
        if($obj1->bidding_price == 0.00){
	    $obj->bidding_price = 0.00;
        }else{
        
	    $obj1->bidding_price = $obj1->bidding_price;
        
        
        }
        
            if ( $i == 1 ) {
                $temp21 = '{"mhis":{"bp":"'.number_format($obj1->bidding_price,2).'","bt":"'.$obj1->bidding_type.'"}}';
            } else {
                $temp21 .= ',{"mhis":{"bp":"'.number_format($obj1->bidding_price,2).'","bt":"'.$obj1->bidding_type.'"}}';
            }
        }

        $qrysel = "select * from bidbutler where user_id='$uid' and auc_id='$aucid' and butler_status='0' order by id desc limit 0,10";
        $ressel = db_query($qrysel);
        $total = db_num_rows($ressel);
       
        for($i=1;$i<=$total;$i++) {
            $obj = db_fetch_object($ressel);
            $bids=$obj->butler_bid-$obj->used_bids;
        if($obj->bidding_price == 0.00){
	    $obj->bidding_price = 0.00;
        }else{
        
	    $obj->bidding_price = $obj->bidding_price;
        
        
        }
            if($i==1) {
                $bidbutler = '{"bidbutler":{"startprice":"'.number_format($obj->butler_start_price,2).'","endprice":"'.number_format($obj->butler_end_price,2).'","bids":"'.$bids.'","id":"'.$obj->id.'"}}';
            }
            else {
                $bidbutler .= ',{"bidbutler":{"startprice":"'.number_format($obj->butler_start_price ,2).'","endprice":"'.number_format($obj->butler_end_price,2).'","bids":"'.$bids.'","id":"'.$obj->id.'"}}';
            }
        }
        //echo '{"butlerslength":['.$bidbutler.']}';
    }

    if ( $temp2 != "" ) {
        return '{"hiss":['.$temp2.'],"mhiss":['.$temp21.'],"butlerslength":['.$bidbutler.']}';
    } else {
        return $temp2;
    }
}


echo GetProductHistory($aucid,$uid);
?>