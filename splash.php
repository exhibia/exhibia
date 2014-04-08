<?php


ini_set('display_errors', 1);
define('INST_RUNSCRIPT', pathinfo(__FILE__, PATHINFO_BASENAME));
define('INST_BASEDIR', str_replace(INST_RUNSCRIPT, '', __FILE__));
define('INST_RUNFOLDER', 'installer/');
define('INST_RUNINSTALL', 'installer.php');
if (is_dir(INST_BASEDIR . INST_RUNFOLDER) &&
        is_readable(INST_BASEDIR . INST_RUNFOLDER . INST_RUNINSTALL)){
    require(INST_BASEDIR . INST_RUNFOLDER . INST_RUNINSTALL);
   

}
?>
<?php
if(empty($dont_show_left)){
$dont_show_left = array();
}
if(empty($dont_show_right)){
$dont_show_right = array();
}
//Uncomment items below to remove them from ALL PAGES for ALL TEMPLATES SO LONG AS THEY ARE 100% USING THE NORMAL FRAMEWORK...IF NOT THEN LETS FIX THAT FIRST
//Skinny column
//$dont_show_left[] = 'testimonials';
//$dont_show_left[] = 'last_winner';
//$dont_show_left[] = 'right_social';
//$dont_show_left[] = 'coupon_menu';
//$dont_show_left[] = 'bidpack_menu';
//$dont_show_left[] = 'user_menu';
//$dont_show_left[] = 'help_menu';
//$dont_show_left[] = 'faq_menu';
//$dont_show_left[] = 'top_menu';
//$dont_show_left[] = 'search_box';
//$dont_show_left[] = 'category_menu';
//$dont_show_right[] = 'steps_box';
//$dont_show_right[] = 'auction_boxes';
//$dont_show_right[] = 'slider';
//$dont_show_right[] = 'category_menu';
//$dont_show_right[] = 'top_menu';
//$dont_show_right[] = 'search_box';

?>
<?php
include_once("config/connect.php");

include_once 'functions.php';

include_once 'include/advertisefunction.php';


$uid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : 0;
$changeimage = "home";
$pagename = "index";
if (!isset($_SESSION["ipid"]) && !isset($_SESSION["login_logout"])) {

    $_SESSION["ipid"] = date("Y-m-d G:i:s");

    $_SESSION["ipaddress"] = $_SERVER['REMOTE_ADDR'];



    $qryipins = "Insert into login_logout (ipaddress,load_time) values('" . $_SESSION["ipaddress"] . "', '" . $_SESSION["ipid"] . "')";

    db_query($qryipins) or die(db_error());
}

$featuredcount = Sitesetting::getFeaturedAuctionCount();
if(empty($_REQUEST['pgno'])){
		    $PageNo = 0;
		    }else{
		    $PageNo = $_REQUEST['pgno'];
		    }
//if ( $_GET["ref"] != "" ) $_SESSION["refid"] = $_GET["ref"];
//first six products get by this query
if(!empty($co)){
$exclude = "and a.auctionID not in ( $co )";
}else{
$exclude = '';
}
$qryauc = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,cashauction,reserve,minseats,maxseats,seatbids,bidpack,a.tax1,a.tax2,bidpack_name,bidpack_banner,bidpack_price,price,p.name,p.picture1,(select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " . "from auction a " .
        "left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join auc_due_table adt on a.auctionID=adt.auction_id " .
        "where adt.auc_due_time!=0 and a.auc_status='2' $exclude order by adt.auc_due_time limit $PageNo, $featuredcount";

$resauc = db_query($qryauc) or die(db_error());

$totalauc = db_num_rows($resauc);

//end for first nine products
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

 <?php  include($BASE_DIR . "/page_headers.php"); ?>

    </head>

    <body class="homepage" onload="OnloadPage();">
    
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
	
              <?php include($BASE_DIR . "/include/splash.php");  ?>
        
    </body>

</html>
