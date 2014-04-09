<?php
        $paygateway = new PayGateway(null);
        $paypalInfo = $paygateway->getDalPay();
        $businessid = $paypalInfo->getBusinessId(); //getPaypalInfo(1);
        $token = $paypalInfo->getToken();

include_once("$BASE_DIR/modules/gateways/phpcreditcard.php");
$error = '';
/*
if(!checkCreditCard ($_POST['creditCardNumber'], strtolower($_POST['creditCardType']))){

    $error .= "Invalid Credit Card Number<br />";

}

if(empty($_POST['firstName'])){

    $error .= "Please Supply a First Name<br />";


}
if(empty($_POST['lastName'])){

    $error .= "Please Supply a Last Name<br />";

}
if(empty($_POST['city'])){

    $error .= "Please Supply a Billing City<br />";

}
if(empty($_POST['state'])){

    $error .= "Please Supply a Billing State<br />";

}
if(empty($_POST['zip'])){

    $error .= "Please Supply a Billing Postal Code<br />";

}
if(empty($_POST['address1'])){

    $error .= "Please Supply a Billing Address<br />";

}*/
$row = db_fetch_object(db_query("select * from registration where id = '$_SESSION[userid]'"));

$ccv = $_POST['cvv2Number'];
if(strlen($_POST['expDateMonth']) == 1){
$_POST['expDateMonth'] = "0" . $_POST['expDateMonth'];
}

$name = "$_POST[firstName] $_POST[lastName]";

$name = "$_POST[firstName]";
$date = $_POST['expDateMonth'] . "/" . str_replace("20", "", $_POST['expDateYear']);
$test = '';
if(empty($error)){
      $url = "https://secure.dalpay.is/cgi-bin/order2/processorder1.pl";
      
      $data = "auth_only=1&mer_id=$businessid" . "&page_id=1&next_phase=paydata&mer_url_idx=1&password=$token&card_num=" . $_POST['creditCardNumber'] . "&client_ip=$_SERVER[REMOTE_ADDR]&pay_method_type=creditcard_" . strtolower($_POST['creditCardType']) . "&agree_terms=1&card_name=xXuXNyxc&card_exp=$date&card_code=$ccv&pay_type=" . ucfirst($_POST['creditCardType']) . "&cust_name=xXuXNyxc";
      
      if(empty($test)){
      
      $data .= "$_POST[lastName]";
      
      }
      $data .= "&cust_address1=$_POST[address1]&cust_address2=$_POST[address2]&cust_city=$_POST[city]&cust_state=$_POST[state]&cust_zip=$_POST[zip]&cust_country_code=US&cust_email=" . $row->email . "&cust_phone=" . $row->phone . "&ship_address1=" . $row->delivery_addressline1 . "&ship_address2=" . $row->delivery_addressline2 . "&ship_city=" . delivery_city . "&ship_state=" . $row->delivery_state . "&ship_zip=" . $row->delivery_postcode . "&ship_country_code=US&ship_phone=" . $row->phone . "&num_items=1&item1_desc=$itemdescription&item1_price=$amount&item1_qty=1&agree2terms=1&user1=$orderid";
      
      
      
      
      
      $data = "auth_only=1&mer_id=$businessid" . "&page_id=1&next_phase=paydata&mer_url_idx=1&password=$token&card_num=4222222222222&client_ip=$_SERVER[REMOTE_ADDR]&pay_method_type=creditcard_visa&agree_terms=1&card_name=xXuXNyxc&card_exp=07/18&card_code=$ccv&pay_type=Visa&cust_name=xXuXNyxc";
      
      if(empty($test)){
      
      $data .= "$_POST[lastName]";
      
      }
      $data .= "&cust_address1=605 Union Stree&cust_address2=&cust_city=Manchester&cust_state=NH&cust_zip=03103&cust_country_code=US&cust_email=" . $row->email . "&cust_phone=" . $row->phone . "&ship_address1=605 Union Street&ship_address2=&ship_city=Manchester&ship_state=NH&ship_zip=03103&ship_country_code=US&ship_phone=" . $row->phone . "&num_items=1&item1_desc=$itemdescription&item1_price=$amount&item1_qty=1&agree2terms=1&user1=$orderid";
      
      $data = str_replace(" ", "%20", $data);
  //   
//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_HEADER, true);
//curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
curl_setopt($ch,CURLOPT_SSLVERSION, 3);
curl_setopt($ch, CURLOPT_REFERER, $SITE_URL . basename($_SERVER['PHP_SELF']));

//execute post
$result = curl_exec($ch);

echo $url ."?" .$data;
die();
//close connection
curl_close($ch);



}else{

header("location: $_SERVER[HTTP_REFERER]&error=" . urlencode($error));


}

?>