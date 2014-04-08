<?php
include("config/connect.php");
include("session.php");
include("paypal/CallerService.php");

require_once 'data/auction.php';
require_once 'data/userhelper.php';
require_once 'data/registration.php';
require_once 'authorize/authnet.php';
include_once 'data/paygateway.php';

$uid = $_SESSION["userid"];

if($_POST["auctionId"]!="") {
    $auctionId = base64_decode($_POST["auctionId"]);

    $auctiondb=new Auction(null);
    $ressel = $auctiondb->selectByAuctionId($auctionId);
    $total = db_num_rows($ressel);
    $auction = db_fetch_array($ressel);

    $success=false;

    if($total>0 && $auction['allowbuynow']) {

        $regdb=new Registration(null);
        $resreg = $regdb->selectById($uid);
        $obj = db_fetch_array($resreg);

        $paymentType =urlencode("Sale");

        $amount = $auctiondb->getBuyPriceWithTax($uid, $auctionId);
        
        //$amount = urlencode($auction["buynowprice"]);

        $creditCardType = urlencode($_POST["creditCardType"]);
        $creditCardNumber = urlencode($_POST["creditCardNumber"]);
        $cvv2Number = urlencode($_POST["cvv2Number"]);
        $expDateMonth =urlencode($_POST["expDateMonth"]);
        $padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
        $expDateYear =urlencode($_POST["expDateYear"]);
        $firstName = urlencode($_POST["firstName"]);
        $lastName = urlencode($_POST["lastName"]);
        $address1 = urlencode($_POST["address1"]);
        $city = urlencode($_POST["city"]);
        $state = urlencode($_POST["state"]);
        $zip = urlencode($_POST["zip"]);

      
        $countryCode = urlencode($obj["country"]);
        $currencyCode=urlencode($CurrencyName);

        $pay_method=$_POST['pay_method'];

        if($pay_method=="paypalcredit") {
            //end PennyAuctionSoft add

            $nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state"."&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode";

            $resArray=hash_call("doDirectPayment",$nvpstr);
            $ack = strtoupper($resArray["ACK"]);



            if($ack=="SUCCESS") {
                $success=true;
            }
            else {
                $errorCode = $resArray['L_ERRORCODE0'];
                $errorMessage = $resArray['L_LONGMESSAGE0'];
                header("location: payunsuccess.php?pro=product&msg=($errorCode) $errorMessage");
            }
        }else if($pay_method=="authorize") {
            //get is test
            $payGateway=new PayGateway(null);
            $authnetInfo=$payGateway->getAuthnet();
            //get is test
            $authnet=new Authnet($authnetInfo->isTestMode());
            $authnet->setLogin($authnetInfo->getLoginId());
            $authnet->setTransKey($authnetInfo->getTransKey());

            $authnet->transaction($creditCardNumber, $padDateMonth.substr($expDateYear,2), $amount, $cvv2Number);
            $authnet->setParameter('x_address', $address1);
            $authnet->setParameter('x_first_name', $firstName);
            $authnet->setParameter('x_last_name', $lastName);
            $authnet->setParameter('x_city', $city);
            $authnet->setParameter('x_state', $state);
            $authnet->setParameter('x_zip', $zip);
            $authnet->process();
            if ($authnet->isApproved()) {
                // Display a printable receipt
                $success=true;
            } else if ($authnet->isDeclined()) {
                $reason = $authnet->getResponseText();
                header("location: payunsuccess.php?pro=product&msg=$reason");
                // As for another form of payment
            }else {
                header("location: payunsuccess.php?pro=product&msg={$authnet->getResponseText()}!");
            }
        }else {
            header("location: payunsuccess.php?pro=product");
        }

        if($success==true) {
            $userHelperdb=new UserHelper(null);
            $userHelperdb->buyitnow($auctionId, $uid);
            //end frdora add

            header("location: paysuccess.php?px=".$_POST["auctionId"].'&pro=product');
        }

    }else {
        header("location: payunsuccess.php?pro=product");
    }
}
?>
