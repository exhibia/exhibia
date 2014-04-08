<?php

$loadlanguage = false;
include("config/connect.php");
include("functions_s.php");
//include("functions.php");

if ($_SERVER["HTTP_X_REQUESTED_WITH"] != "XMLHttpRequest") {
    exit;
}


$aucid = chkInput($_GET["aucid_new"], 'i');
$uid = $_SESSION["userid"];

$timekey='lasthistoryvisittime-'.$aucid;
$starttime = microtime_float();
if (isset($_SESSION[$timekey]) && $starttime - $_SESSION[$timekey] < 0.5) {
    echo json_encode(array('message' => 'failed', 'interval' => $starttime - $_SESSION[$timekey]));
    exit;
}

$_SESSION[$timekey] = $starttime;

echo GetProductHistory($aucid, $uid);

function GetProductHistory($aucid, $uid) {

    $qryhis = "select username,adddate,position from unique_bid u left join registration r on r.id=u.userid where u.auctionid=$aucid order by u.id desc limit 0,6";

    $reshis = db_query($qryhis) or die(db_error());
    $total = db_num_rows($reshis);
    for ($i = 1; $i <= $total; $i++) {
        $obj = db_fetch_object($reshis);
//        if ( $lprice == $obj->bidding_price ) {
//            break;
//            $flg=1;
//        }
        if ($i == 1) {
            $temp2 = '{"his":{"un":"' . $obj->username . '","ad":"' . date('m/d/Y H:i:s', strtotime($obj->adddate)) . '","latlng":"' . $obj->position . '"}}';
        } else {
            $temp2 .= ',{"his":{"un":"' . $obj->username . '","ad":"' . date('m/d/Y H:i:s', strtotime($obj->adddate)) . '","latlng":"' . $obj->position . '"}}';
        }
    }

    db_free_result($reshis);


    if ($flg != 1) {
        $qryhis1 = "select username,bidprice,adddate from unique_bid u left join registration r on r.id=u.userid where u.userid='$uid' and u.auctionid=$aucid order by u.id desc limit 0, 6;";

        $reshis1 = db_query($qryhis1) or die(db_error());
        $total1 = db_num_rows($reshis1);
        for ($i = 1; $i <= $total1; $i++) {
            $obj1 = db_fetch_object($reshis1);
            if ($i == 1) {
                $temp21 = '{"mhis":{"un":"' . $obj1->username . '","bp":"' . number_format($obj1->bidprice, 2, '.', '') . '","ad":"' . date('m/d/Y H:i:s', strtotime($obj->adddate)) . '"}}';
            } else {
                $temp21 .= ',{"mhis":{"un":"' . $obj1->username . '","bp":"' . number_format($obj1->bidprice, 2, '.', '') . '","ad":"' . date('m/d/Y H:i:s', strtotime($obj->adddate)) . '"}}';
            }
        }

        db_free_result($reshis1);

        /*
          $qrysel = "select * from bidbutler where user_id='$uid' and auc_id='$aucid' and butler_status='0' order by id desc limit 0,20";
          $ressel = db_query($qrysel);
          $total = db_num_rows($ressel);

          for($i=1;$i<=$total;$i++) {
          $obj = db_fetch_object($ressel);
          $bids=$obj->butler_bid-$obj->used_bids;
          if($i==1) {
          $bidbutler = '{"bidbutler":{"startprice":"'.number_format($obj->butler_start_price,2).'","endprice":"'.number_format($obj->butler_end_price,2).'","bids":"'.$bids.'","id":"'.$obj->id.'"}}';
          }
          else {
          $bidbutler .= ',{"bidbutler":{"startprice":"'.number_format($obj->butler_start_price,2).'","endprice":"'.number_format($obj->butler_end_price,2).'","bids":"'.$bids.'","id":"'.$obj->id.'"}}';
          }
          }
         */
        //echo '{"butlerslength":['.$bidbutler.']}';
    }

    if ($temp2 != "") {
        return '{"hiss":[' . $temp2 . '],"mhiss":[' . $temp21 . ']}';
    } else {
        return $temp2;
    }
}

/* 	$qryhis = "select * from bid_account ba left join auction a on ba.auction_id=a.auctionID left join registration r on ba.user_id=r.id where ba.auction_id='$aucid' and ba.bid_flag='d' order by ba.id desc limit 0,5";

  $reshis = db_query($qryhis) or die(db_error());
  $total  = db_num_rows($reshis);
  for($i=1;$i<=$total;$i++)
  {
  $obj = db_fetch_object($reshis);
  if($i==1)
  {
  $temp2 = $obj->bidding_price.":".$obj->username.":".$obj->bidding_type;
  }
  else
  {
  $temp2 .= "#".$obj->bidding_price.":".$obj->username.":".$obj->bidding_type;
  }
  }
  $qryhis1 = "select * from bid_account ba left join auction a on ba.auction_id=a.auctionID left join registration r on ba.user_id=r.id where ba.auction_id='$aucid' and ba.bid_flag='d' and ba.user_id='$uid' order by ba.id desc limit 0,5";

  $reshis1 = db_query($qryhis1) or die(db_error());
  $total1  = db_num_rows($reshis1);
  for($i=1;$i<=$total1;$i++)
  {
  $obj1 = db_fetch_object($reshis1);
  if($i==1)
  {
  $temp21 = $obj1->bidding_price."!".substr($obj1->bidpack_buy_date,10)."!".$obj1->bidding_type;
  }
  else
  {
  $temp21 .= "#".$obj1->bidding_price."!".substr($obj1->bidpack_buy_date,10)."!".$obj1->bidding_type;
  }
  }
  echo $temp2."|".$temp21;
 */
?>