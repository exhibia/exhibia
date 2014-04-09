<?php

include("config/connect.php");
require_once('library/googleresponse.php');
require_once('library/googlemerchantcalculations.php');
require_once('library/googleresult.php');
require_once('library/googlerequest.php');
include("functions.php");
include("sendmail.php");
include("email.php");
include_once 'data/paygateway.php';
include_once"config/connect.php";
require_once 'data/userhelper.php';
include_once 'common/constvariable.php';


define('RESPONSE_HANDLER_ERROR_LOG_FILE', 'googleerror.log');
define('RESPONSE_HANDLER_LOG_FILE', 'googlemessage.log');

$payGateway = new PayGateway(null);
$googleCheckoutInfo = $payGateway->getGoogleCheckOut();

$merchant_id = $googleCheckoutInfo->getMerchantId(); //"149275761255387";  // Your Merchant ID
$merchant_key = $googleCheckoutInfo->getMerchantKey(); // "UtX2qKW2yLqOP_oUAxWhsg";  // Your Merchant Key
if ($googleCheckoutInfo->isTestMode() == true) {
    $server_type = "sandbox";  // change this to go live
} else {
    $server_type = "live";
}
$currency = $CurrencyName;  // set to GBP if in the UK

$Gresponse = new GoogleResponse($merchant_id, $merchant_key);

$Grequest = new GoogleRequest($merchant_id, $merchant_key, $server_type, $currency);

//Setup the log file
$Gresponse->SetLogFiles(RESPONSE_HANDLER_ERROR_LOG_FILE,
        RESPONSE_HANDLER_LOG_FILE, L_ALL);
//$testfp = @fopen('d:/test.txt','a');
// Retrieve the XML sent in the HTTP POST request to the ResponseHandler
$xml_response = isset($HTTP_RAW_POST_DATA) ?
        $HTTP_RAW_POST_DATA : file_get_contents("php://input");
if (get_magic_quotes_gpc ()) {
    $xml_response = stripslashes($xml_response);
}
list($root, $data) = $Gresponse->GetParsedXML($xml_response);
$Gresponse->SetMerchantAuthentication($merchant_id, $merchant_key);

$status = $Gresponse->HttpAuthentication();
if (!$status) {
    die('authentication failed');
}


/* Commands to send the various order processing APIs
 * Send charge order : $Grequest->SendChargeOrder($data[$root]
 *    ['google-order-number']['VALUE'], <amount>);
 * Send process order : $Grequest->SendProcessOrder($data[$root]
 *    ['google-order-number']['VALUE']);
 * Send deliver order: $Grequest->SendDeliverOrder($data[$root]
 *    ['google-order-number']['VALUE'], <carrier>, <tracking-number>,
 *    <send_mail>);
 * Send archive order: $Grequest->SendArchiveOrder($data[$root]
 *    ['google-order-number']['VALUE']);
 *
 */

switch ($root) {
    case "request-received": {
            break;
        }
    case "error": {
            break;
        }
    case "diagnosis": {
            break;
        }
    case "checkout-redirect": {
            break;
        }
    case "merchant-calculation-callback": {
            // Create the results and send it

            break;
        }
    case "new-order-notification": {
            //fwrite($testfp, $root.'/r/n');
            $orderid = $data[$root]['shopping-cart']['merchant-private-data']['orderid']['VALUE'];
            
            $userhelper = new UserHelper(null);
            $userhelper->processOrder($orderid, '');
//            if($buyfor=='buybids') {
//                $bidpackid=$data[$root]['shopping-cart']['merchant-private-data']['bidpackid']['VALUE'];
//                $userid=$data[$root]['shopping-cart']['merchant-private-data']['userid']['VALUE'];
//                $usercouponid=$data[$root]['shopping-cart']['merchant-private-data']['usercouponid']['VALUE'];
//                $couponid=$data[$root]['shopping-cart']['merchant-private-data']['couponid']['VALUE'];
//
//                //fwrite($testfp, $userid.'-'.$bidpackid.'-'.$usercouponid.'-'.$couponid.'/r/n');
//
//                if($bidpackid!='') {
//                    $userHelperdb=new UserHelper(null);
//                    $userHelperdb->buybids($userid, $bidpackid, $usercouponid, $couponid);
//                }
//            }else if($buyfor=='buyitnow') {
//                $auctionid=$data[$root]['shopping-cart']['merchant-private-data']['auctionid']['VALUE'];
//                $userid=$data[$root]['shopping-cart']['merchant-private-data']['userid']['VALUE'];
//                $userHelperdb=new UserHelper(null);
//                $userHelperdb->buyitnow($auctionid, $userid);
//            }else if($buyfor=='redeem') {
//                $redeemid=$data[$root]['shopping-cart']['merchant-private-data']['redeemid']['VALUE'];
//                $userid=$data[$root]['shopping-cart']['merchant-private-data']['userid']['VALUE'];
//                $userHelperdb=new UserHelper(null);
//                $userHelperdb->redempayment($redeemid,$userid);
//            }else if($buyfor=='paywonauction') {
//                $woninfo=$data[$root]['shopping-cart']['merchant-private-data']['woninfo']['VALUE'];
//                $wonaucidexp = explode("|",$woninfo);
//                $wonaucid = $wonaucidexp[0];
//                $voucherid = $wonaucidexp[1];
//                $uid = $wonaucidexp[2];
//                $userHelperdb=new UserHelper(null);
//                $userHelperdb->paywonauction($wonaucid, $voucherid, $uid);
//            }
            $Gresponse->SendAck();
            break;
        }
    case "order-state-change-notification": {
            $Gresponse->SendAck();
            $new_financial_state = $data[$root]['new-financial-order-state']['VALUE'];
            $new_fulfillment_order = $data[$root]['new-fulfillment-order-state']['VALUE'];

            switch ($new_financial_state) {
                case 'REVIEWING': {
                        break;
                    }
                case 'CHARGEABLE': {
                        //$Grequest->SendProcessOrder($data[$root]['google-order-number']['VALUE']);
                        //$Grequest->SendChargeOrder($data[$root]['google-order-number']['VALUE'],'');
                        break;
                    }
                case 'CHARGING': {
                        break;
                    }
                case 'CHARGED': {
                        break;
                    }
                case 'PAYMENT_DECLINED': {
                        break;
                    }
                case 'CANCELLED': {
                        break;
                    }
                case 'CANCELLED_BY_GOOGLE': {
                        //$Grequest->SendBuyerMessage($data[$root]['google-order-number']['VALUE'],
                        //    "Sorry, your order is cancelled by Google", true);
                        break;
                    }
                default:
                    break;
            }

            switch ($new_fulfillment_order) {
                case 'NEW': {
                        break;
                    }
                case 'PROCESSING': {
                        break;
                    }
                case 'DELIVERED': {
                        break;
                    }
                case 'WILL_NOT_DELIVER': {
                        break;
                    }
                default:
                    break;
            }
            break;
        }
    case "charge-amount-notification": {
            //$Grequest->SendDeliverOrder($data[$root]['google-order-number']['VALUE'],
            //    <carrier>, <tracking-number>, <send-email>);
            //$Grequest->SendArchiveOrder($data[$root]['google-order-number']['VALUE'] );
            $Gresponse->SendAck();
            break;
        }
    case "chargeback-amount-notification": {
            $Gresponse->SendAck();
            break;
        }
    case "refund-amount-notification": {
            $Gresponse->SendAck();
            break;
        }
    case "risk-information-notification": {
            $Gresponse->SendAck();
            break;
        }
    default:
        $Gresponse->SendBadRequestStatus("Invalid or not supported Message");
        break;
}

//fclose($testfp);
/* In case the XML API contains multiple open tags
  with the same value, then invoke this function and
  perform a foreach on the resultant array.
  This takes care of cases when there is only one unique tag
  or multiple tags.
  Examples of this are "anonymous-address", "merchant-code-string"
  from the merchant-calculations-callback API
 */
function get_arr_result($child_node) {
    $result = array();
    if (isset($child_node)) {
        if (is_associative_array($child_node)) {
            $result[] = $child_node;
        } else {
            foreach ($child_node as $curr_node) {
                $result[] = $curr_node;
            }
        }
    }
    return $result;
}

/* Returns true if a given variable represents an associative array */

function is_associative_array($var) {
    return is_array($var) && !is_numeric(implode('', array_keys($var)));
}

?>