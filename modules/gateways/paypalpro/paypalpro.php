<?
/* authoize and carit card for paypal */
require_once 'paypal/CallerService.php';
require_once 'paypal/constants.php';
include_once 'common/constvariable.php';
include_once 'data/registration.php';
require_once 'data/userhelper.php';
$regdb = new Registration(null);
$resreg = $regdb->selectById($userid);
$obj = db_fetch_array($resreg);
$paymentType = urlencode("Sale");
$creditCardType = urlencode($_POST["creditCardType"]);
$creditCardNumber = urlencode($_POST["creditCardNumber"]);
$cvv2Number = urlencode($_POST["cvv2Number"]);
$expDateMonth = urlencode($_POST["expDateMonth"]);
$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
$expDateYear = urlencode($_POST["expDateYear"]);
$firstName = urlencode($_POST["firstName"]);
$lastName = urlencode($_POST["lastName"]);
$address1 = urlencode($_POST["address1"]);
$city = urlencode($_POST["city"]);
$state = urlencode($_POST["state"]);
$zip = urlencode($_POST["zip"]);
$countryCode = urlencode($obj["country"]);
$currencyCode = urlencode($CurrencyName);

//end PennyAuctionSoft add

$nvpstr = "&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=" . $padDateMonth . $expDateYear . "&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state" . "&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode";

$resArray = hash_call("doDirectPayment", $nvpstr);
$ack = strtoupper($resArray["ACK"]);

if ($ack == "SUCCESS") {
    $userhelper = new UserHelper(null);
    $userhelper->processOrder($orderid, $amount);
    header("location: payment_success.php?payfor=$payfor&itemid=$itemid");
} else {
    $errorCode = $resArray['L_ERRORCODE0'];
    $errorMessage = $resArray['L_LONGMESSAGE0'];
    header("location: payment_unsuccess.php?msg=($errorCode) $errorMessage&payfor=$payfor&orderid=$orderid");
}
?>
