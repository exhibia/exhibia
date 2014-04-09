<?php
   
    ini_set ('soap.wsdl_cache_enabled', 0);
    include($BASE_DIR . '/modules/gateways/globalpay/lib/nusoap.php');
    include($BASE_DIR . "/config/config.inc.php");
    
    include($BASE_DIR . "/data/paygateway.php");
    
    $paygateway=new PayGateway(null);
    $paypalInfo=$paygateway->getGlobalPay();
  
  
  if($paypalInfo->isTestMode == true){
    $client = new nusoap_client('https://demo.globalpay.com.ng/GlobalpayWebService_demo/service.asmx?wsdl', true);
    
    $soapaction = "http://www.eazypaynigeria.com/globalpay_demo/getTransactions";
    $namespace = "http://www.eazypaynigeria.com/globalpay_demo/";
   }else{
    $client = new nusoap_client('https://www.globalpay.com.ng/globalpaywebservice/service.asmx?wsdl', true);
    
    $soapaction = "https://www.eazypaynigeria.com/globalpay/getTransactions";
    $namespace = "https://www.eazypaynigeria.com/globalpay/";   
   }
    
    
    
    $client->soap_defencoding = 'UTF-8';
  	
  	$txnref = $_GET["txnref"];
  	
    $merch_txnref=$txnref; 
    $channel="" ; 
    $merchantID= $paypalInfo->getBusinessId(); 
    $start_date=""; 
    $end_date=""; 
    $uid=$paypalInfo->getToken();
    $pwd=$paypalInfo->getPassword(); 
    $payment_status="" ; 
    
    $err = $client->getError();
    
    if ($err) {
        echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
        return $err;
    }
    // Doc/lit parameters get wrapped
    $MethodToCall= "getTransactions";
    //$MethodToCall= "Checkcenter";
    
    $param = array(
        'merch_txnref' => $merch_txnref, 
        'channel' => $channel,
        'merchantID' => $merchantID,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'uid' => $uid,
        'pwd' => $pwd,
        'payment_status' => $payment_status
    );

    $result = $client->call(
        'getTransactions', 
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
        } 
        else {
            //This gives getTransactionsResult
            $WebResult=$MethodToCall."Result";
            // Pass the result into XML
            $xml = simplexml_load_string($result[$WebResult]);
            
            //echo $xml;
            
            $amount = $xml->record->amount;
            $txn_date = $xml->record->payment_date;
            $pmt_method = $xml->record->channel;
            $pmt_status = $xml->record->payment_status;
            $pmt_txnref = $xml->record->txnref;
            $currency = $xml->record->field_values->field_values->field[2]->currency;
           // $pnr = 'PNR';
            $trans_status = $xml->record->payment_status_description;
            }
	  		

	  	  //Get information from your database
	  	 //$merch_amt = 
	  	//echo "select * from payment_order where orderid = '$txnref'";
	  	 $qry_trans = db_fetch_object(db_query("select * from payment_order where orderid = '$txnref'"));
	  	 $merch_amt = $qry_trans->amount;
	  	 
	  	 $merch_name = $SITE_NM; 
	  	 $merch_phoneno  = $paypalInfo->getPhone();
	  	
	  if(empty($merch_amt)){
	  
	  
	  header("location: payment_unsuccess.php");
	  exit;
	  
	  }else{

         //Format and display the necessary parameters including the one above
          
	      
         if ($pmt_status == 'successful')
         {
         	if ($amount == $merch_amt)
         	{
         	
         	?>
         	<p class="bid-title"><strong><?php echo $SITE_NM; ?> - <?php echo PAYMENT_SUCCESS; ?></strong></p>
         	<?php
         	echo "Name : ". $merch_name . "<br />\n";
	      echo "Phone number : ".$merch_phoneno . "<br />\n";
         		echo "Transaction Amount : ".$merch_amt . "<br />\n";
         		echo "Debited Amount : ". $amount . "<br />\n";
	            echo "Transaction Date : ".$txn_date . "<br />\n";
	            echo "Payment Method : ".$pmt_method . "<br />\n";
	            echo "Payment Status : ".$pmt_status . "<br />\n";
	            echo "Transaction Reference Number : ".$pmt_txnref . "<br />\n";
	            echo "Currency : ".$currency . "<br />\n";
	            echo "Transaction Status : ".$trans_status . "<br />\n";
	         
	        include_once($BASE_DIR . '/data/userhelper.php');
                $userhelper=new UserHelper(null);
                $userhelper->processOrder($txnref,$amount);	            
	            
         	}
         	else
         	{
         	?>
         	<p class="bid-title"><strong><?php echo $SITE_NM; ?> - <?php echo PAYMENT_FAILED; ?></strong></p>
         	<?php
         	echo "Name : ". $merch_name . "<br />\n";
	      echo "Phone number : ".$merch_phoneno . "<br />\n";
         		echo "Transaction Amount : ".$merch_amt . "<br />\n";
         		echo "Debited Amount : ". $amount . "<br />\n" ;
	            echo "Transaction Date : ".$txn_date . "<br />\n";
	            echo "Payment Method : ".$pmt_method . "<br />\n";
	            echo "Payment Status : Unsuccessful ( Amount does not match and no service will be rendered)" . "<br />\n";
	            echo "Transaction Reference Number : ".$pmt_txnref . "<br />\n";
	            echo "Currency : ".$currency . "<br />\n";
	            echo "Transaction Status : ".$trans_status . " by GlobalPay. Transaction Unsuccessful Denied by " .$SITE_NM . "<br />\n";
         	}
         	
         }
         else
         {
		  echo "Name : ". $merch_name . "<br />\n";
	      echo "Phone number : ".$merch_phoneno . "<br />\n";
         		echo "Amount : ". $amount . "<br />\n" ;
	            echo "Transaction Date : ".$txn_date . "<br />\n";
	            echo "Payment Method : ".$pmt_method . "<br />\n";
	            echo "Payment Status : ".$pmt_status . "<br />\n";
	            echo "Transaction Reference Number : ".$pmt_txnref . "<br />\n";
	            echo "Currency : ".$currency . "<br />\n";
	            echo "Transaction Status : ".$trans_status . "<br />\n";
         }
            
	
}
}
?>