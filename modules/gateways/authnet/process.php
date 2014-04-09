<?

/* authoize and carit card for paypal */

include_once 'common/constvariable.php';

include_once 'data/registration.php';
include_once 'authorize/authnet.php';
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


$payGateway = new PayGateway(null);
$authnetInfo = $payGateway->getAuthnet();
//get is test
$authnet = new Authnet($authnetInfo->isTestMode());
$authnet->setLogin($authnetInfo->getLoginId());
$authnet->setTransKey($authnetInfo->getTransKey());

$authnet->transaction($creditCardNumber, $padDateMonth . substr($expDateYear, 2), $amount, $cvv2Number);
$authnet->setParameter('x_address', $address1);
$authnet->setParameter('x_first_name', $firstName);
$authnet->setParameter('x_last_name', $lastName);
$authnet->setParameter('x_city', $city);
$authnet->setParameter('x_state', $state);
$authnet->setParameter('x_zip', $zip);
$authnet->process();

if ($authnet->isApproved()) {
    // Display a printable receipt
    $userhelper = new UserHelper(null);
    $userhelper->processOrder($orderid, $amount);
    header("location: payment_success.php?payfor=$payfor&itemid=$itemid");
} else if ($authnet->isDeclined()) {
    $reason = $authnet->getResponseText();
    header("location: payment_unsuccess.php?msg=$reason&orderid=$orderid");
    // As for another form of payment
} else {
    header("location: payment_unsuccess.php?msg={$authnet->getResponseText()}&orderid=$orderid");
}
?>
