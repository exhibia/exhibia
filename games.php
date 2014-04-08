<?php
ini_set('display_errors', 1);
include("config/connect.php");

include("session.php");

include("functions.php");

include_once('data/registration.php');
include_once('common/sitesetting.php');
include_once('data/avatar.php');
include_once 'common/seosupport.php';


$uid = $_SESSION["userid"];

$changeimage = "myaccount";


if (isset($_GET['avatarid'])) {
    $avatarid = chkInput($_GET['avatarid'], 'i');
    $regdb = new Registration(null);
    $regdb->setUserAvatar($uid, $avatarid);
}

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
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,lockauction,seatauction,cashauction,reserve,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,
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

	  db_query("CREATE TABLE IF NOT EXISTS refer_points (
	    `id` int(11) NOT NULL AUTO_INCREMENT,
	    `dsipensed` int(11) NOT NULL,
	    `bid_points` text not null,
	    `userid` text NOT NULL,
	    PRIMARY KEY (`id`),
	    KEY `index` (`id`)
	  );");
	  @db_query("alter table refer_points add column reason text not null");
	  
	  
 if(db_num_rows(db_query("select * from registration where id = '$_SESSION[userid]' and birth_date = '" . date("Y-m-d") . "'")) >= 1){
 



	  $bid_info = db_fetch_object(db_query("SELECT * from refer_points_admin where retrieve_condition = 'Birthday'"));

	  if(empty($bid_info->num_times_to_dispense)){
	  $bid_info->num_times_to_dispense = 0;
	  }
	  if(empty($bid_info->bid_points)){
	  $bid_info->bid_points = 0;
	  }


	 if(db_num_rows(db_query("SELECT * FROM refer_points where userid = '" . $_SESSION['userid'] . "' and reason = 'Birthday'")) <= $bid_info->num_times_to_dispense){



	  db_query("INSERT INTO refer_points values(null, '" . $bid_info->num_times_to_dispense . "', '" . $bid_info->bid_points . "', '" . $_SESSION['userid'] . "', 'Birthday');");
	  echo db_error();
	  
      $qrysel1 = "select * from registration where id='" . $_SESSION['userid'] . "'";
        $ressel1 = db_query($qrysel1);

        $objreg = db_fetch_array($ressel1);

                $final_bids = $objreg["free_bids"];
                $totalbids = $final_bids + $bonusbid;

                $qryupd = "update registration set free_bids='" . $totalbids . "' where id='" . $_SESSION['userid'] . "'";
                db_query($qryupd);


	       $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('" . $_SESSION['userid'] . "',NOW(),'" . $bid_info->bid_points . "','c','ad','Happy Birthday')";
	      
		db_query($qryins);
		

	  } 
 
 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

  

 <?php include("page_headers.php"); ?>
   <style>
   #footer ul {}
 </style>

        <script language="javascript">

            function setname(name)

            {

                if(document.getElementById('bidpackname'+name)!=null){

                    var temp = document.getElementById('bidpackname'+name).value;

                    document.getElementById('bidpackname').innerHTML = temp;

                }

            }

        </script>

    </head>



    <body onload="javascript:setname(<?= $selected; ?>);OnloadPage();" class="single" >
         <?php
         if(in_array('games-client', $addons) | $_SERVER['SERVER_NAME'] == 'pennyauctionsoftdemo.com'){
	      foreach($addons as $key => $value){

		if(file_exists($BASE_DIR . "/include/addons/$value/$template/top_bar.php")){
		
		    include($BASE_DIR . "/include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists($BASE_DIR . "/include/addons/$value/top_bar.php")){
		

		    include_once($BASE_DIR . "/include/addons/$value/top_bar.php");

		}


	      }
	      $page = 'myaccount.php';
	  
	      if(file_exists($BASE_DIR . "/include/$template/user_pages/games-client.php")){
		
		     include_once($BASE_DIR . "/include/$template/user_pages/games-client.php");
		
		}else{
		
		   include_once($BASE_DIR . "/include/user_pages/games-client.php");
		
		}
		
		
	    }
	    
	    
	  ?>



    </body>

</html>

