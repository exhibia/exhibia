<?php
ini_set('display_errors', 1);

include($BASE_DIR . "/config/config.inc.php");
$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
if (!$db) {
   // die('Could not connect: ' . db_error());
}

db_select_db($DATABASENAME, $db);

   


include($BASE_DIR . "/sendmail.php");
include($BASE_DIR . "/functions.php");

include_once($BASE_DIR . '/common/dbmysql.php');
include_once($BASE_DIR . '/common/constvariable.php');
include_once($BASE_DIR . '/data/userhelper.php');

include_once($BASE_DIR . '/data/paygateway.php');

    

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

foreach ($_REQUEST as $key => $value) {
    $value = urlencode(stripslashes($value));
    $req .= "&$key=$value";
}
// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

$paygateway=new PayGateway(null);
$paypalInfo=$paygateway->getPaypal();

if($paypalInfo->isTestMode()==true) {


    $fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);
}else {
    $fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
}
/*
$fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);*/
// assign posted variables to local variables
$item_name = $_REQUEST['item_name'];
$item_number = $_REQUEST['item_number'];
$payment_status = $_REQUEST['payment_status'];
$payment_amount = $_REQUEST['mc_gross'];
$payment_currency = $_REQUEST['mc_currency'];
$txn_id = $_REQUEST['txn_id'];
$receiver_email = $_REQUEST['receiver_email'];
$payer_email = $_REQUEST['payer_email'];
$amount=$_REQUEST['amount'];
// custom varible
$invoice_id = $_REQUEST['invoice_id'];
//retrieve payment status
$payment_status = $_REQUEST['payment_status'];
$customvar = $_REQUEST["custom"];

$data = '';
foreach($_REQUEST as $key => $value){

$data .= $key . "=" . $value . "\n";

}

//$debug = 'true';
if(!empty($debug)){
  $payment_status = "Completed";
}

if (!$fp) {
    // HTTP ERROR
  
} else {

    fputs ($fp, $header . $req);
    
    while (!feof($fp)) {
   
               
        $res = fgets ($fp, 1024);
        //if (strcmp ($res, "VERIFIED") == 0) {

            if ($payment_status == "Completed") {
           
                $userhelper=new UserHelper(null);
                $userhelper->processOrder($customvar,$amount);
                
                
           }

       //}
       // else if (strcmp ($res, "INVALID") == 0) {
            // log for manual investigation
       // }
    }
    fclose ($fp);
}

?>
