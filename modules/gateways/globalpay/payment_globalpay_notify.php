<?php
error_reporting (E_ALL ^ E_DEPRECATED);
ini_set('display_errors', 1);
ini_set ('soap.wsdl_cache_enabled', 0);
require($_SERVER['DOCUMENT_ROOT'] . "/config/config.inc.php");
$fp = fopen('log.txt', 'a');
$str = "":

foreach($_REQUEST as $key => $value){

$str.= "$key=$value\n";

}
fwrite($fp, $str);
fclose($fp);

require_once($BASE_DIR . '/data/paygateway.php');
require_once($BASE_DIR . '/modules/gateways/globalpay/lib/class.nusoap_base.php');
require_once($BASE_DIR . '/modules/gateways/globalpay/lib/class.soapclient.php');
require_once($BASE_DIR . '/modules/gateways/globalpay/lib/class.soap_transport_http.php');
require_once($BASE_DIR . '/modules/gateways/globalpay/lib/class.wsdl.php');
$client = new nusoap_client('http://172.29.50.10/GlobalpayWebService_demo/service.asmx?wsdl', true);
//$client = new soapclient('http://172.29.50.10/GlobalpayWebService_demo/service.asmx?wsdl','wsdl');
$soapaction = "http://www.eazypaynigeria.com/globalpay_demo/getTransactions";
$namespace = "http://www.eazypaynigeria.com/globalpay_demo/";
$client->soap_defencoding = 'UTF-8';

  //$merch_txnref=""; 
  //$channel="" ; 
  //$merchantID=""; 
  //$start_date=""; 
  //$end_date=""; 
  //$uid=""; 
  //$pwd=""; 
  //$payment_status="" ; 
        $paygateway = db_fetch_object(db_query("select * from paypal_info where name = 'globalpay'"));
     
        $businessid = $paypalInfo->business_id; //getPaypalInfo(1);
        
        
  $merch_txnref=$_REQUEST['txnref']; 
  $channel="" ; 
  $merchantID=$businessid; 
  $start_date=""; 
  $end_date=""; 
  $uid=$paypalInfo->token(); 
  $pwd=$paypalInfo->additional1(); 
  $payment_status=$_REQUEST['status'] ; 

$err = $client->getError();
if ($err) {
echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
return $err;
}
// Doc/lit parameters get wrapped
$MethodToCall= "getTransactions";
//$MethodToCall= "Checkcenter";
$param = array('merch_txnref' => $merch_txnref, 
'channel' => $channel,
'merchantID' => $merchantID,
'start_date' => $start_date,
'end_date' => $end_date,
'uid' => $uid,
'pwd' => $pwd,
'payment_status' => $payment_status
);
$result = $client->call('getTransactions', 
array('parameters' => $param), 
'http://www.eazypaynigeria.com/globalpay_demo/', 
'http://www.eazypaynigeria.com/globalpay_demo/getTransactions', 
false, 
true
);

// Check for a fault
if ($client->fault) {
echo '<h2>Fault</h2><pre>';
print_r($result);
echo '</pre>';
return $result;
} 
else {
// Check for errors
$err = $client->getError();
if ($err) {
// Display the error
echo '<h2>Error</h2><pre>' . $err . '</pre>';
return $err;
} else {
// Display the result
echo '<h2>Result</h2><br>';
$WebResult=$MethodToCall."Result";//This gives getTransactionsResult
echo $WebResult."<br>";
print_r("<pre>".$result[$WebResult]."</pre>");
echo "<br><br><br>";
//Interpret XML String result into an object using simplexml_load_string
$xml = simplexml_load_string($result[$WebResult]);
print_r($xml);
return $result;
}
}

?>