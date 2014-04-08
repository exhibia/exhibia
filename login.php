<?php
include("config/connect.php");

include("functions.php");
include_once 'common/seosupport.php';



$uid = $_SESSION["userid"];

$tid = $_GET['tid'];

$fid = $_GET['fid'];

//Query for display three live auction

if(!empty($_REQUEST['verifycode']) & db_num_rows(db_query("select * from registration where verifycode = '$_REQUEST[verifycode]'")) >= 1){

$user = db_fetch_object(db_query("select * from registration where verifycode = '$_REQUEST[verifycode]'"));
$_SESSION['username'] = $user->username;
$_SESSION['email'] = $user->email;
$_SESSION['userid'] = $user->id;
$_SESSION['ipid'] = $_SERVER['REMOTE_ADDR'];
header("location: " . $_SERVER['HTTP_REFERER']);

}

$qryauc = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc from auction a left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID left join auc_due_table adt on a.auctionID=adt.auction_id where adt.auc_due_time!=0 and a.auc_status=2 order by adt.auc_due_time limit 0,3";

$resauc = db_query($qryauc);

$totalauc = db_num_rows($resauc);



//end query



$qryregmsg = "select * from general_setting where id='4'";

$resregmsg = db_query($qryregmsg);

$objregmsg = db_fetch_array($resregmsg);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('page_headers.php'); ?>
    </head>
    <body onload="OnloadPage();" class="single">
   <?php

     foreach($addons as $key => $value){

		if(file_exists($BASE_DIR . "/include/addons/$value/$template/top_bar.php")){
		
		   include_once($BASE_DIR . "/include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists($BASE_DIR . "/include/addons/$value/top_bar.php")){
		

		    include_once($BASE_DIR . "/include/addons/$value/top_bar.php");

		}


	      }
	     
	   ?>
          <?php
	
	      
	      if(file_exists($BASE_DIR . "/include/$template/" . basename($_SERVER['PHP_SELF'])  )  ) {
		include($BASE_DIR . "/include/$template/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/" . basename($_SERVER['PHP_SELF']));
		
		}
	  ?>
  
    </body>
</html>
