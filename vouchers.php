<?php

include("config/connect.php");

include("session.php");

include("functions.php");
include_once 'common/seosupport.php';

$changeimage = "myaccount";

$uid = $_SESSION["userid"];



if(!$_GET['pgno']) {

    $PageNo = 1;

}

else {

    $PageNo = $_GET['pgno'];

}



$qryselupd = "select *,uv.id as uservoucherid from user_vouchers uv left join vouchers v on uv.voucherid=v.id where uv.user_id='$uid'";

$resselupd = db_query($qryselupd);

$totalupd = db_num_rows($resselupd);

while($obj1 = db_fetch_array($resselupd)) {

    $status = "";

    if($obj1["expirydate"]!="0000-00-00 00:00:00" && $obj1["voucher_status"]==0) {

        $expiry = strtotime($obj1["expirydate"]);

        $today = time();

        if($today>$expiry) {

            $status="expire";

        }

    }

    if($status=="expire") {

        $qry = "update user_vouchers set voucher_status='2' where id='".$obj1["uservoucherid"]."'";

        db_query($qry) or die(db_error());

    }

}





$qrysel = "select *,".$lng_prefix."voucher_desc as voucher_desc from user_vouchers uv left join vouchers v on uv.voucherid=v.id where uv.user_id='$uid'";

$ressel = db_query($qrysel);

$total = db_num_rows($ressel);

$totalpage=ceil($total/$PRODUCTSPERPAGE);	



if($totalpage>=1) {

    $startrow=$PRODUCTSPERPAGE*($PageNo-1);

    $qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";

    //echo $sql;

    $ressel=db_query($qrysel);

    $total=db_num_rows($ressel);

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

 <?php include("page_headers.php"); ?>

    </head>



    <body class="single">
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
       
    </body>
</html>
