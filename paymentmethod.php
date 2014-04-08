<?php
ini_set('display_errors', 1);
include("config/connect.php");

$uid = $_SESSION["userid"];
$changeimage = "myaccount";

$winid = base64_decode($_REQUEST['winid']);
$snew = explode("&", $winid);
$amount = $snew[0];
$waucid = $snew[1];


$ressel = db_query("select * from auction a " .
                "left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 " .
                "where a.auctionID=$waucid");
$total = db_num_rows($ressel);

if ($total <= 0) {
    header('location:wonauctions.php');
}

$obj = db_fetch_object($ressel);
include("session.php");
include_once 'data/auction.php';
include("functions.php");
include_once 'data/paygateway.php';
include($BASE_DIR . '/common/constvariable.php');


if ($_POST["paymentmethod"] != "") {
    $paymentmethod = $_POST["paymentmethod"];
    if ($paymentmethod == "paypal") {
        header("location: buybidspayment.php?bpid=" . $_POST["bidpackid"]);
        exit;
    } elseif ($paymentmethod == "creditcard") {
        header("location: checkout.php?bpid=" . $_POST["bidpackid"]);
        exit;
    }
}


$payGateway = new PayGateway(null);
$gateways = $payGateway->get_em_all(1);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include($BASE_DIR . '/page_headers.php'); ?>
<script type="text/javascript" src="js/payment.js"></script>
<script language="javascript" type="text/javascript">

 <?php include($BASE_DIR . '/modules/gateways/javascript.php'); ?>
 $('input[type="radio"]').click(function(){

    $('input[type="radio"]').parent().removeClass('highlight');
    $(this).parent().addClass('highlight')
 
 })
</script>

</head>

<body class="single">
       <?php
         
         
	      foreach($addons as $key => $value){

		if(file_exists($BASE_DIR .  "/include/addons/$value/$template/top_bar.php")){
		
		    include($BASE_DIR . "/include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists($BASE_DIR . "/include/addons/$value/top_bar.php")){
		

		    include_once($BASE_DIR . "/include/addons/$value/top_bar.php");

		}


	      }
	      if(file_exists($BASE_DIR . "/include/$template/product_pages/" . basename($_SERVER['PHP_SELF']))){
		include($BASE_DIR . "/include/$template/product_pages/" . basename($_SERVER['PHP_SELF']));
	
		}else{
		
		include($BASE_DIR . "/include/product_pages/" . basename($_SERVER['PHP_SELF']));
		
		}
		


	  ?>
</body>
</html>
