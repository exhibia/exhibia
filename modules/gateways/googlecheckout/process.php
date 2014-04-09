<?php
require_once('library/googlecart.php');
require_once('library/googleitem.php');
require_once('library/googleshipping.php');
require_once('library/googletax.php');
include_once 'common/constvariable.php';

$payGateway = new PayGateway(null);
$googleCheckoutInfo = $payGateway->getGoogleCheckOut();
$merchant_id = $googleCheckoutInfo->getMerchantId(); //"149275761255387";  // Your Merchant ID
$merchant_key = $googleCheckoutInfo->getMerchantKey(); //"UtX2qKW2yLqOP_oUAxWhsg";  // Your Merchant Key
if ($googleCheckoutInfo->isTestMode() == true) {
    $server_type = "sandbox";
} else {
    $server_type = "live";
}

$cart = new GoogleCart($merchant_id, $merchant_key, $server_type, $CurrencyName);
$total_count = 1;
$item1 = new GoogleItem($itemname, // Item name
                $itemdescription, // Item description
                $total_count, // Quantity
                $amount); // Unit price
$cart->AddItem($item1);
$cart->SetContinueShoppingUrl($SITE_URL . "payment_success.php?payfor=$payfor&itemid=$itemid");
$privatedata = new MerchantPrivateData(array('orderid' => $orderid));
$cart->SetMerchantPrivateData($privatedata);
list($status, $error) = $cart->CheckoutServer2Server();

echo "<script>window.location =\"payment_unsuccess.php?orderid=$orderid&msg=($status) payment error check your payment setting please\";</script>";

?>