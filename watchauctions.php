<?
include("config/connect.php");
include("session.php");
include("functions.php");
include_once 'common/seosupport.php';

$uid = $_SESSION["userid"];
$changeimage = "myaccount";
if ($_POST["delauction"] != "") {
    $count = count($_POST["delauction"]);
    for ($i = 0; $i < $count; $i++) {
        $id = $_POST["delauction"][$i];
        $qrydel = "delete from watchlist where id=" . $id;
        db_query($qrydel) or die(db_error());
    }
    header("location: watchauctions.php");
    exit;
}
if (!$_GET['pgno']) {
    $PageNo = 1;
} else {
    $PageNo = $_GET['pgno'];
}
$qrysel = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,lockauction,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,
(select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount,w.id as wid from watchlist w left join auction a on w.auc_id=a.auctionID left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID left join auc_due_table adt on a.auctionID=adt.auction_id where w.user_id=$uid order by w.id desc";
$ressel = db_query($qrysel);
$total = db_num_rows($ressel);
$totalpage = ceil($total / $PRODUCTSPERPAGE_MYACCOUNT);
if ($totalpage >= 1) {
    $startrow = $PRODUCTSPERPAGE_MYACCOUNT * ($PageNo - 1);
    $qrysel .= " LIMIT $startrow,$PRODUCTSPERPAGE_MYACCOUNT";
    //echo $sql;
    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <?php include("page_headers.php"); ?>
        <script language="javascript">
            function deleteauc()
            {
                if(confirm('Are you sure to delete this watchauction?'))
                {
                    document.watchauc.submit();
                }
            }
        </script>
    </head>
    <body onload="OnloadPage();" class="single">
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
