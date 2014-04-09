<?php
        $paygateway = new PayGateway(null);
        $paypalInfo = $paygateway->getDalPay();
        $businessid = $paypalInfo->getBusinessId(); //getPaypalInfo(1);
        $token = $paypalInfo->getToken();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?= $AllPageTitle; ?></title>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript">
            function frmnew()
            {
                document._xclick.submit();
            }
        </script>
    </head>

    <body onload="frmnew();">
    
     <form name="_xclick" action="https://secure.dalpay.is/cgi-bin/order2/processorder1.pl" method="post">

            <input type="hidden" name="cmd" value="_xclick" />
            <input type="hidden" name="mer_id" value="<?php echo $businessid; ?>"/>
            <input type="hidden" name="pageid" value="1"/>
            <input type="hidden" name="notify_url" value="<?php echo $SITE_URL; ?>modules/gateways/dalpay/payment_dalpay_notify.php"/>
            <input type="hidden" name="return" value="<?php echo $SITE_URL; ?>/index.php?module=cart&action=payment_success&payfor=<?php echo $payfor; ?>&itemid=<?php echo $_SESSION['sess_id']; ?>"/>
            <input type="hidden" name="cancel_return" value="<?php echo $SITE_URL; ?>/index.php?module=cart&action=payment_unsuccess&payfor=<?php echo $payfor; ?>&itemid=<?php echo $_SESSION['sess_id']; ?>"/>
            <input type="hidden" name="currency_code" value="<?php echo $CurrencyName; ?>" />
            <input type="hidden" name="item_name" value="<?php echo $itemdescription; ?>"/>
            <input type="hidden" name="amount" value="<?php echo $amount; ?>"/>
            <input type="hidden" name="custom" value="<?php echo $invoice_id; ?>" />
        </form>
    </body>
</html>