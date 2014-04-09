<?php

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
$qrysel = "select shippingcharge,auc_plus_price, username,avatar,adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,am.picture as auctypepic,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,lockauction,cashauction,reserve,locktype,lockprice,locktime,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_banner2,bidpack_banner3,bidpack_banner4,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,picture2,picture3,picture4,short_desc,long_desc,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " .
        "from auction a left join products p on p.productID=a.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 " .
        "left join auc_due_table adt on a.auctionID=adt.auction_id left join registration r on a.buy_user=r.id " .
        "left join shipping sp on a.shipping_id=sp.id " .
        "left join avatar av on av.id=r.avatarid " .
        "left join auction_management am on am.auc_manage=a.time_duration where a.auctionID=$aucid";
break;
case('viewproduct_lowest.php'):

$qrysel = "select shippingcharge,auc_plus_price, username,avatar,adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,am.picture as auctypepic,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,lockauction,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_banner2,bidpack_banner3,bidpack_banner4,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,picture2,picture3,picture4,short_desc,long_desc, " .
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

db_free_result($ressel);


//
$onlineperbidvalue = Sitesetting::getBidPrice();

//the price - bid times
$aucdb = new Auction(null);
$buynowprice = $aucdb->getBuynowPrice($uid, $aucid);

if ($uid <> 0) {
    $reswatch = db_query("select count(*) from watchlist where auc_id=$aucid and user_id=$uid");

    if (db_num_rows($reswatch) > 0) {

        $totalwatch = db_result($reswatch, 0);

        //$totalwatch = $totalwatch !== FALSE ? 0 : $totalwatch;
    } else {

        $totalwatch = 0;
    }

    db_free_result($reswatch);
} else {

    $totalwatch = 0;
}



$resregmsg = db_query("select reg_message from general_setting where id=4");

$regmsg = db_num_rows($resregmsg) > 0 ? db_result($resregmsg, 0) : FALSE;

db_free_result($resregmsg);
?>
        
        <?php if($template != 'quibids-2.0'){ ?>
        <div id="main">
           
            	 <?php include_once('header.php'); ?>
	<?php }else{ ?>
        <div id="main">
            	 <?php include_once('include/' . $template . '/header.php'); ?>
		

	
	<?php } ?>
	
		  <div id="container" class="wrapper">
		      
		      <?php

			    load_addon_by_position('container', $addons, $admin);
			?>

			     
		  </div>
		  
		<?php if(empty($footer)){ include("include/$template/footer.php"); } ?>        
        </div>
            
        <div style="display:none;">
            <?php
            $avatardb = new Avatar(null);
            $avatarresult = $avatardb->selectAll();
            while ($avatar = db_fetch_object($avatarresult)) {
            ?>
                <img alt="" src="uploads/avatars/<?php echo $avatar->avatar; ?>"/>
            <?php } ?>

	 </div>

       