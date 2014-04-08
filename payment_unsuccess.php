<?php
if(empty($_SESSION['userid']) | empty($_GET['orderid'])){
die();
}
include("config/connect.php");


include("session.php");
include("functions.php");
include_once 'common/constvariable.php';
$payfor = $_GET['payfor'];
if (isset($_GET['orderid'])) {
    $orderid = $_GET['orderid'];
    $sql = "delete from payment_order where orderid='$orderid'";
    db_query($sql);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('page_headers.php'); ?>
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
	      if(file_exists("include/$template/product_pages/$_SERVER[PHP_SELF]")){
		include("include/$template/product_pages/$_SERVER[PHP_SELF]");
		}else{
		    if(file_exists("include/$template/user_pages/$_SERVER[PHP_SELF]")){
			include("include/$template/user_pages/$_SERVER[PHP_SELF]");
		    }else{
			include("include/product_pages/$_SERVER[PHP_SELF]");
		    }
		}
		


	  ?>
    </body>
</html>