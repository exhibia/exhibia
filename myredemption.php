<?php
	include("config/connect.php");
	include("session.php");
	include("functions.php");
        include_once 'common/seosupport.php';
        
	$uid = $_SESSION["userid"];
	$changeimage = "myaccount";

	if(!$_GET['pgno'])
	{
		$PageNo = 1;
	}
	else
	{
		$PageNo = $_GET['pgno'];
	}
	
	$qrysel = "select * from redemption_order ro left join redemption re on ro.redem_id=re.id left join products p on re.product_id=p.productID where ro.user_id='".$uid."' order by ro.pur_date desc";
	$ressel = db_query($qrysel);
	$total = db_num_rows($ressel);
	$totalpage=ceil($total/$PRODUCTSPERPAGE_MYACCOUNT);

	if($totalpage>=1)
	{
		$startrow=$PRODUCTSPERPAGE_MYACCOUNT*($PageNo-1);
		$qrysel .=" LIMIT $startrow,$PRODUCTSPERPAGE_MYACCOUNT";
		$ressel =db_query($qrysel);
		$total =db_num_rows($ressel);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <?php include("page_headers.php"); ?>

</head>

<body class="single">
 <?php
	      foreach($addons as $key => $value){

		if(file_exists($BASE_DIR . "/include/addons/$value/$template/top_bar.php")){
		
		    include($BASE_DIR . "/include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists($BASE_DIR . "/include/addons/$value/top_bar.php")){
		

		    include_once($BASE_DIR . "/include/addons/$value/top_bar.php");

		}


	      }

	      if(file_exists($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF'])  )  ) {
		include_once($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include_once($BASE_DIR . "/include/user_pages/" . basename($_SERVER['PHP_SELF']));
		
		}
	  ?>

</body>
</html>
