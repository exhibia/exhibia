<?php

ini_set('display_errors', 1);
include_once 'config/connect.php';
include("session.php");


include_once("functions.php");

include_once $BASE_DIR . '/data/userproduct.php';

$uid = $_SESSION["userid"];

//set the status of the user product.
if (isset($_REQUEST['sent'])) {
    $sendid = $_REQUEST['sent'];
    $updb = new UserProduct(null);
    $updb->setStatus($sendid, 2);
}

if (!$_GET['pgno']) {
    $PageNo = 1;
} else {
    $PageNo = $_GET['pgno'];
}

$status = 1;
if (isset($_GET['status'])) {
    $status = $_GET['status'];
}

$updb = new UserProduct(null);

$total = $updb->countByUser($uid, $status);

$totalpage = ceil($total / $PRODUCTSPERPAGE);

$startrow = $PRODUCTSPERPAGE * ($PageNo - 1);

$ressel = $updb->selectByUser($uid, $startrow, $PRODUCTSPERPAGE, $status);

//echo $sql;
$total = db_num_rows($ressel);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

 <?php include("page_headers.php"); ?>
        <script type="text/javascript">

            function sentconfirm(loc)
            {
                if(confirm("<?php echo CONFIRM_TO_GOT_THE_PRODUCT; ?>"))
                {                    
                    window.location.href=loc;
                }
                return false;
            }
           
        </script>
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
