<?
include_once 'config/connect.php';
include("session.php");

include_once("functions.php");

include_once 'data/usercoupon.php';

$changeimage = "mycoupon";

$uid = $_SESSION["userid"];

if(!$_GET['pgno']) {
    $PageNo = 1;
}else {
    $PageNo = $_GET['pgno'];
}

$userCoupondb=new UserCoupon(null);

$total = $userCoupondb->count($uid);

$totalpage=ceil($total/$PRODUCTSPERPAGE);

$startrow=$PRODUCTSPERPAGE*($PageNo-1);

$ressel=$userCoupondb->selectByUser($uid, $startrow, $PRODUCTSPERPAGE);

//echo $sql;
$total=db_num_rows($ressel);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

 <?php include("page_headers.php"); ?>
        

    </head>

    <body class="single">
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
