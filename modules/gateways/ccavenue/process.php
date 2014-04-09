<?php
/* * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require("ccavenue/libfuncs.php");
include_once 'data/paygateway.php';
include_once("sendmail.php");
include_once("functions.php");
include_once("email.php");

$paygateway = new PayGateway(null);
$ccavenue = $paygateway->getPaymentCCAvenue();

$Merchant_Id = $ccavenue->getMerchantID();
$Order_Id = $orderid;
$Redirect_Url = $SITE_URL . 'payment_ccavenue_notify.php';
$WorkingKey = $ccavenue->getWorkingKey();

$cancelUrl = $SITE_URL;
$Checksum = getCheckSum($Merchant_Id, $amount, $Order_Id, $Redirect_Url, $WorkingKey);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title></title>
        <script type="text/javascript">
            function frmnew()
            {
                document._xclick.submit();
            }
        </script>
    </head>

    <body onload="frmnew();">
        <form method="post" name="_xclick" action="https://www.ccavenue.com/shopzone/cc_details.jsp">
            <input type=hidden name=Merchant_Id value="<?php echo $Merchant_Id; ?>"/>
            <input type=hidden name=Amount value="<?php echo $amount; ?>"/>
            <input type=hidden name=Order_Id value="<?php echo $Order_Id; ?>"/>
            <input type=hidden name=Redirect_Url value="<?php echo $Redirect_Url; ?>"/>
            <input type=hidden name=Checksum value="<?php echo $Checksum; ?>"/>
            <input type="hidden" name="Merchant_Param" value="<?php echo $itemid.'|'.$payfor; ?>"/>
            <input type="hidden" name="billing_cust_name" value=""/>
            <input type="hidden" name="billing_cust_address" value=""/>
            <input type="hidden" name="billing_cust_country" value=""/>
            <input type="hidden" name="billing_cust_tel" value=""/>
            <input type="hidden" name="billing_cust_email" value=""/>
            <input type="hidden" name="billing_cust_email" value=""/>
            <input type="hidden" name="delivery_cust_name" value=""/>
            <input type="hidden" name="delivery_cust_address" value=""/>
            <input type="hidden" name="delivery_cust_tel" value=""/>
            <input type="hidden" name="delivery_cust_notes" value=""/>
        </form>
    </body>
</html>