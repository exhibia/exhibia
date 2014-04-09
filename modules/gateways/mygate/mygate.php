<?php
/* * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'data/paygateway.php';

$paygateway = new PayGateway(null);
$mygate = $paygateway->getPaymentMyGate();

$mref = time();
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
        <form name="_xclick" action="https://www.mygate.co.za/virtual/8x0x0/dsp_ecommercepaymentparent.cfm" method="post">
            <input type="hidden" name="Mode" value="<?php echo $mygate->isTestMode() == true ? '0' : '1'; ?>"/>
            <input type="hidden" name="txtMerchantID" value="<?php echo $mygate->getMerchantID(); ?>"/>
            <input type="hidden" name="txtApplicationID" value="<?php echo $mygate->getApplicationID(); ?>"/>
            <input type="hidden" name="txtMerchantReference" value="<?php echo $mref; ?>"/>
            <input type="hidden" name="txtPrice" value="<?php echo $amount; ?>"/>
            <input type="hidden" name="txtCurrencyCode" value="<?php echo $CurrencyName; ?>"/>
            <input type="hidden" name="txtRedirectSuccessfulURL" value="<?php echo $SITE_URL."payment_mygate_notify.php";?>"/>
            <input type="hidden" name="txtRedirectFailedURL" value="<?php echo $SITE_URL . "payment_unsuccess.php?payfor=$payfor&orderid=$orderid"; ?>"/>
            <input type="hidden" name="Variable1" value="<?php echo $payfor.'|'.$orderid.'|'.$itemid; ?>"/>
        </form>
    </body>
</html>