<?php
session_start();
$loadlanguage=false;
ini_set('display_errors', 1);
include("config/connect.php");
function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float) $usec + (float) $sec);
}
include_once $BASE_DIR . '/common/sitesetting.php';
$json_script = 'true';
/*
 * PennyAuctionSoft08 add 2010-1-28
 * get the price and bidcount via ajax
*/
include_once 'data/bidaccount.php';
include_once 'data/auction.php';
if ($_SERVER["HTTP_X_REQUESTED_WITH"] != "XMLHttpRequest") {
    //exit;
}
if(empty($_POST['uid'])){
  $uid = $_SESSION["userid"];
}else{
  $uid = $_POST['uid'];
}
$aucid=$_REQUEST["aid"];

$timekey='savingprice-'.$aucid;
$starttime = microtime_float();
if ($starttime - $_SESSION[$timekey] < 3) {
    echo json_encode(array('msg' => 'failed', 'interval' => $starttime - $_SESSION[$timekey]));
    exit;
}

$_SESSION[$timekey] = $starttime;
$onlineperbidvalue = Sitesetting::getBidPrice();

$qry = "select * from auction left join bidpack b on auction.productID=b.id left join products p on auction.productID=p.productID left join auction_management am on auction.time_duration=am.auc_manage left join auc_due_table adt on adt.auction_id=auction.auctionID where auctionID=$aucid";
$auc_data = db_fetch_object(db_query($qry));
$price=$auc_data->price;
$fprice=$auc_data->price;
$np=$auc_data->auc_due_price;
if($auc_data->pennyauction != 1){
  if(empty($auc_data->auc_plus_price)){
      $onlineperbidvalue = Sitesetting::getBidPrice();
      
      }else{
      
	  $onlineperbidvalue =$auc_data->auc_plus_price;
      
   }
}else{
      $onlineperbidvalue = .01;
}

$fprice=$auc_data->auc_final_price;
$price = $auc_data->bidpack ? $auc_data->bidpack_price : $auc_data->price;
$badb=new Bidaccount(null);
$totbid=$badb->countByUserID($aucid, $uid);
$aucdb=new Auction(null);
$buynow = $aucdb->getBuynowPrice($uid, $aucid);
$buynowprice=number_format($buynow['price'],2);
$qry_b = db_fetch_object(db_query("select * from sitesetting where name='bidprice'"));
$buynow_bidrebate = $qry_b->value * $totbid;

if($totbid!=false){
    $totbidprice=number_format($totbid*$onlineperbidvalue,2);
    $saving=number_format($price-$totbidprice,2);
    $savingpercent=number_format(($saving/$price)*100, 1);

    
    echo "{\"msg\":\"ok\",\"data\":{\"price\":\"$price\",\"totbid\":\"$totbid\",\"totbidprice\":\"$totbidprice\",\"saving\":\"$saving\",\"buynowprice\":\"" . $buynowprice . "\",\"savingpercent\":\"$savingpercent\", \"id\":\"" . $auc_data->auctionID . "\",\"uid\":\"$uid\", \"np\":\"" . $auc_data->auc_due_price . "\", \"buynow_rebate\": \"" . $buynow_bidrebate . "\"}}";
}else{
    echo '{"msg":"zero"}';
}
?>