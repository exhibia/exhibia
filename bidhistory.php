<?php
ini_set('display_errors', 1);
include("config/connect.php");
include($BASE_DIR . "/session.php");
include($BASE_DIR . "/functions.php");
include_once $BASE_DIR . '/common/seosupport.php';
  
	 
$uid = $_SESSION["userid"];

$changeimage = "myaccount";


if (!$_GET['pgno']) {
    $PageNo = 1;
} else {
    $PageNo = $_GET['pgno'];
}

$qrysel = "select *,credit_description as credit_description from bid_account ba left join bidpack b on ba.bidpack_id=b.id where user_id=$uid order by ba.id desc";
$rssel = db_query($qrysel);
$total = db_num_rows($rssel);
$totalpage = ceil($total / $PRODUCTSPERPAGE_MYACCOUNT);

if ($totalpage >= 1) {
    $startrow = $PRODUCTSPERPAGE_MYACCOUNT * ($PageNo - 1);
    $qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE_MYACCOUNT";
    //echo $sql;
    $rssel = db_query($qrysel);
    $total = db_num_rows($rssel);
}

if (!$_GET['pgNo']) {
    $PageNo1 = 1;
} else {
    $PageNo1 = $_GET['pgNo'];
}

$qrysel1 = "select a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,sum(ba.bid_count) as bidcount, a.auc_status as aucstatus from bid_account ba left join products p on ba.product_id=p.productID left join auction a on ba.auction_id=a.auctionID left join bidpack b on b.id=a.productID where user_id='$uid' and bidding_type!='m' and (ba.bid_flag='d' or ba.bid_flag='b' or ba.bid_flag='s') group by ba.auction_id order by ba.id desc";
$rssel1 = db_query($qrysel1);
$total1 = db_num_rows($rssel1);
$totalpage1 = ceil($total1 / $PRODUCTSPERPAGE_MYACCOUNT);

if ($totalpage1 >= 1) {
    $startrow = $PRODUCTSPERPAGE_MYACCOUNT * ($PageNo1 - 1);
    $qrysel1.=" LIMIT $startrow,$PRODUCTSPERPAGE_MYACCOUNT";
    //echo $sql;
    $rssel1 = db_query($qrysel1);
    $total1 = db_num_rows($rssel1);
}

if (!$_GET['pgno2']) {
    $PageNo2 = 1;
} else {
    $PageNo2 = $_GET['pgno2'];
}

$qryself_free = "select * from free_account fa left join bidpack b on fa.bidpack_id=b.id left join redemption r on fa.redemption_id=r.id left join bingo_games bg on bg.id=fa.auction_id where user_id='$uid' order by fa.id desc";

$resself_free = db_query($qryself_free);
$totalself_free = db_num_rows($resself_free);

$totalpagesself_free = ceil($totalself_free / $PRODUCTSPERPAGE_MYACCOUNT);
if ($totalself_free >= 1) {
    $startrow1 = $PRODUCTSPERPAGE_MYACCOUNT * ($PageNo2 - 1);
    $qrysel_free1 = $qryself_free . " LIMIT $startrow1,$PRODUCTSPERPAGE_MYACCOUNT";
    //echo $sql;
    
    $resself_free1 = db_query($qrysel_free1);
   
}

$qryself2 = "select *,sum(bid_count) as placebids from free_account fa left join auction a on fa.auction_id=a.auctionID where user_id='$uid' and bid_flag!='b' and auction_id!='0' group by fa.auction_id order by fa.id desc";

if ($PageNo2 > $totalpagesself) {
    $qryself = $qryself2;
    $qryflag1 = 1;
}
$resself2 = db_query($qryself2);
$totalself2 = db_num_rows($resself2);
$totalpagesself2 = ceil($totalself2 / $PRODUCTSPERPAGE_MYACCOUNT);

$totalpagesselfmain = ($totalpagesself + $totalpagesself2);

if ($totalpagesselfmain >= 1) {
    $startrow = $PRODUCTSPERPAGE_MYACCOUNT * ($PageNo2 - 1);
    if ($qryflag1 == 1) {
        $startrow = $PRODUCTSPERPAGE_MYACCOUNT * ((($PageNo2 - $totalpagesself)) - 1);
    }
    $qryself.=" LIMIT $startrow,$PRODUCTSPERPAGE_MYACCOUNT";
    //echo $sql;
    $resself = db_query($qryself);
    $totalself = db_num_rows($resself);
}

if (!$_GET['pgNo']) {
    $PageNo1 = 1;
} else {
    $PageNo1 = $_GET['pgNo'];
}
if(empty($_REQUEST['admin_pass'])){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <?php include($BASE_DIR . "/page_headers.php"); ?>
        <!--[if lte IE 6]>
        <link href="css/menu_ie.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <script language="javascript">
            function BidHistoryPlus(id,plus,minus)
            {
                document.getElementById(plus).style.display = 'none';
                document.getElementById(minus).style.display = 'block';
                document.getElementById(id).style.display = 'block';
            }

            function BidHistoryMinus(id,plus,minus)
            {
                document.getElementById(plus).style.display = 'block';
                document.getElementById(minus).style.display = 'none';
                document.getElementById(id).style.display = 'none';
            }
        </script>
    </head>
<?php 
} 

if(empty($_REQUEST['admin_pass'])){
?>
    <body class="single">
        <?php

	  foreach($addons as $key => $value){
		if(file_exists($BASE_DIR . "/include/addons/$value/$template/top_bar.php")){
		   include_once($BASE_DIR . "/include/addons/$value/$template/top_bar.php");
		}else	if(file_exists($BASE_DIR . "/include/addons/$value/top_bar.php")){
		    include_once($BASE_DIR . "/include/addons/$value/top_bar.php");
		}
	      }
	   ?>
         <?php
         
         }
          
	      if(file_exists($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF'])    ) ){
		include($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/user_pages/" . basename($_SERVER['PHP_SELF']));
		
		}
		

if(empty($_REQUEST['admin_pass'])){
	  ?>

    </body>
</html>
<?php } ?>
