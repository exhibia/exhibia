<?php


include("config/config.inc.php");
if(!isset($_SESSION['userid'])){
header("location: login.php");
}
if (!isset($_REQUEST["aid"])) {
    header("location: index.php");
}

include_once 'data/auction.php';
include_once 'data/avatar.php';
include_once 'common/sitesetting.php';
include_once 'common/seosupport.php';

include("functions.php");



$prid = isset($_REQUEST["pid"]) ? chkInput($_REQUEST["pid"], 'i') : 0; // never to use



if (isset($_REQUEST["aid"])) {
    $aucid = $_REQUEST["aid"];

    $aucid = $aucid == 0 ? 1 : $aucid;
} else {

    $aucid = 1;

    header("location: index.php");
}



$uid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : 0;

switch(basename($_SERVER['PHP_SELF'])){

case('viewproduct.php'):
$qrysel = "select shippingcharge,auc_plus_price,auc_plus_time, username,avatar,adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,am.picture as auctypepic,
        use_free,beginner_auction,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,lockauction,cashauction,reserve,locktype,lockprice,locktime,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_banner2,bidpack_banner3,bidpack_banner4,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,picture2,picture3,picture4,short_desc,long_desc,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " .
        "from auction a left join products p on p.productID=a.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 " .
        "left join auc_due_table adt on a.auctionID=adt.auction_id left join registration r on a.buy_user=r.id " .
        "left join shipping sp on a.shipping_id=sp.id " .
        "left join avatar av on av.id=r.avatarid " .
        "left join auction_management am on am.auc_manage=a.time_duration where a.auctionID=$aucid";
break;
case('viewproduct_lowest.php'):

$qrysel = "select shippingcharge,auc_plus_price, username,avatar,auc_plus_time,.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,am.picture as auctypepic,
        use_free,allowbuynow,beginner_auction,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,lockauction,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_banner2,bidpack_banner3,bidpack_banner4,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,picture2,picture3,picture4,short_desc,long_desc, " .
        "(select count(*) from unique_bid u where u.auctionid=a.auctionID) as lowbidcount,(select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount  " .
        "from auction a left join products p on p.productID=a.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 " .
        "left join auc_due_table adt on a.auctionID=adt.auction_id left join registration r on a.buy_user=r.id " .
        "left join shipping sp on a.shipping_id=sp.id " .
        "left join avatar av on av.id=r.avatarid " .
        "left join auction_management am on am.auc_manage=a.time_duration where a.auctionID=$aucid";

break;
}
$ressel = db_query($qrysel);
if (db_num_rows($ressel) <= 0) {
    header("location:{$SITE_URL}index.php");
}
$obj = db_fetch_array($ressel);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>



 <?php include("page_headers.php"); ?>


     

    </head>


    <body onload="OnloadPage();" class="single">

          <?php
          
	      foreach($addons as $key => $value){

		if(file_exists($BASE_DIR . "/include/addons/$value/$template/top_bar.php")){
		
		    include($BASE_DIR . "/include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists($BASE_DIR . "/include/addons/$value/top_bar.php")){
		

		    include_once($BASE_DIR . "/include/addons/$value/top_bar.php");

		}


	      }
	      
	      if(file_exists($BASE_DIR . "/include/$template/" . basename($_SERVER['PHP_SELF']))){
		include($BASE_DIR . "/include/$template/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/" . basename($_SERVER['PHP_SELF']));
		
		}
	  ?>
	  <div id="auction_id_history" style="display:none;"><?php echo $_REQUEST['aid']; ?></div>
    </body>
</html>