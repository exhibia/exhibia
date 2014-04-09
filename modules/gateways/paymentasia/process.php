<?php
/* * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'data/paygateway.php';
include_once 'common/constvariable.php';
$cancelUrl = $SITE_URL;
$paygateway = new PayGateway(null);
$paymentasia = $paygateway->getPaymentasia();
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
        <form action='http://secure.paymentasia.com/pg/' name="_xclick" method="post">
            <input name="merchantID" type="hidden" value="<?php echo $paymentasia->getMerchantID(); ?>" />
            <input name="merchantEMAIL" type="hidden" value="<?php echo $paymentasia->getMerchantEmail(); ?>" />
            <input name="successURL" type="hidden" value="<?php echo $SITE_URL . "payment_success.php?payfor=$payfor&itemid=$itemid"; ?>" />
            <input name="cancelURL" type="hidden" value="<?php echo $cancelUrl; ?>" />
            <input name="failURL" type="hidden" value="<?php echo $SITE_URL . "payment_unsuccess.php?payfor=$payfor&orderid=$orderid"; ?>" />
            <input name="orderSUBJECT" type="hidden" value="<?php echo $itemname; ?>" />
            <input name="orderDESC" type="hidden" value="<?php echo $itemdescription; ?>" />
            <input name="orderREF_L" type="hidden" value="<?php echo $paymentasia->getReferenceTitle() . '_' . $orderid; ?>" />
            <input name="amount" type="hidden" value="<?php echo $amount; ?>" />
            <input name="lang" type="hidden" value="<?php echo $defaultlanguage == 'chinese' ? 'C' : 'E'; ?>" />
            <input name="currency" type="hidden" value="<?php echo $CurrencyName; ?>" />
            <input name="paymentTYPE" type="hidden" value="" />
        </form>
    </body>
</html>