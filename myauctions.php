<?php
include("config/connect.php");
include("session.php");
include("functions.php");
include_once 'common/seosupport.php';

$uid = $_SESSION["userid"];
$changeimage = "myaccount";

$qrysel = "select * from bidpack order by id";
$rssel = db_query($qrysel);
$totalbpack = db_num_rows($rssel);
if ($totalbpack > 0) {
    $selected = ceil($totalbpack / 2);
}

if (!$_GET['pgno']) {
    $PageNo = 1;
} else {
    $PageNo = $_GET['pgno'];
}

$qryselauc = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,beginner_auction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,
(select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount from auction a left join bid_account ba on a.auctionID=ba.auction_id left join free_account fa on a.auctionID=fa.auction_id left join auc_due_table adt on a.auctionID=adt.auction_id left join bidpack b on b.id=a.productID left join products p on a.productID=p.productID where a.auc_status='2' and adt.auc_due_time!='0' and (ba.user_id='$uid' or fa.user_id='$uid') group by ba.auction_id,fa.auction_id order by auc_due_time";

$resselauc = db_query($qryselauc);
$totalauc = db_num_rows($resselauc);
$totalpage = ceil($totalauc / $PRODUCTSPERPAGE_MYACCOUNT);

if ($totalpage >= 1) {
    $startrow = $PRODUCTSPERPAGE_MYACCOUNT * ($PageNo - 1);
    $qryselauc.=" LIMIT $startrow,$PRODUCTSPERPAGE_MYACCOUNT";
    //echo $sql;
    $resselauc = db_query($qryselauc);
    $totalauc = db_num_rows($resselauc);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <?php include("page_headers.php"); ?>
        <script language="javascript">
            function setname(name)
            {
                var temp = document.getElementById('bidpackname'+name).value;
                document.getElementById('bidpackname').innerHTML = temp;
            }
        </script>
    </head>

    <body class="single"  onload="javascript:OnloadPage();">
         <?php
	      foreach($addons as $key => $value){

		if(file_exists("include/addons/$value/$template/top_bar.php")){
		
		    include("include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists("include/addons/$value/top_bar.php")){
		

		    include_once("include/addons/$value/top_bar.php");

		}


	      }
	
	      if(file_exists($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF'])  )  ) {
		include($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/user_pages/" . basename($_SERVER['PHP_SELF']));
		
		}
	  ?>



      
    </body>
</html>
