
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
        <?php
        $paygateway = new PayGateway(null);
        $mbinfo = $paygateway->getMoneyBooker();
        if ($mbinfo->isTestMode() == true) {
            $url = "https://www.moneybookers.com/app/payment.pl";
        } else {
            $url = "https://www.moneybookers.com/app/payment.pl";
        }
        ?>

        <form action="<?php echo $url; ?>" method="post" name="_xclick">
            <input type="hidden" name="pay_to_email" value="<?php echo $mbinfo->getMerchantEmail(); ?>"/>
            <input type="hidden" name="recipient_description" value="<?php echo $SITE_NM; ?>"/>
            <input type="hidden" name="status_url" value="<?php echo $SITE_URL; ?>payment_moneybooker_notify.php"/>
            <input type="hidden" name="return_url" value="<?php echo $SITE_URL; ?>payment_success.php?payfor=<?php echo $payfor; ?>&itemid=<?php echo $itemid; ?>"/>
            <input type="hidden" name="cancel_url" value="<?php echo $SITE_URL; ?>payment_unsuccess.php?payfor=<?php echo $payfor; ?>orderid=<?php echo $orderid;?>"/>
            <input type="hidden" name="language" value="EN"/>
            <input type="hidden" name="amount" value="<?php echo $amount; ?>"/>
            <input type="hidden" name="currency" value="<?php echo $CurrencyName; ?>"/>
            <input type="hidden" name="detail1_description" value="Description:"/>
            <input type="hidden" name="detail1_text" value="<?= $itemdescription; ?>"/>
            <input type="hidden" name="merchant_fields" value="orderid"/>
            <input type="hidden" name="orderid" value="<?php echo $orderid; ?>"/>

        </form>
    </body>
</html>