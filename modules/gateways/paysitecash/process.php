<?php
//include_once 'lib/Paysitecash/pgs.php';
include_once 'data/paygateway.php';
include_once 'data/registration.php';

$regdb = new Registration(null);
$paygateway = new PayGateway(null);
$paysitecash = $paygateway->getPaysitecash();
$resreg = $regdb->selectById($userid);

$userobj = db_fetch_array($resreg);
/*
$pgs = new pgs(array(
            'email_cobranca' => $paysitecash->getEmail(),
            'tipo' => 'CP',
            'tipo_frete' => $paysitecash->getFreightType(),
            'ref_transacao' => $orderid,
        ));

$pgs->cliente(array(
    'nome' => $userobj['firstname'] . " " . $userobj['lastname'],
    'cep' => $userobj['postcode'],
    'compl' => $userobj['addressline1'],
    'cidade' => $userobj['city'],
    'uf' => $userobj['state'],
    'tel' => $userobj['phone'],
    'email' => $userobj['email'],
));


$pgs->adicionar(array(
    'id' => $itemid,
    'quantidade' => 1,
    'valor' => $amount,
    'descricao' => $itemname . '-' . $itemdescription,
));*/
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

    <body><!-- onload="frmnew();">-->
        <form name="_xclick" action="https://billing.paysite-cash.biz/" method="post">
            <input type="text" name="test" value="<?php echo $paysitecash->isTestMode(); ?>"/>
            <input type="text" name="url_ref" value="<?php echo $SITE_URL;?>"/>
<input id="url" type="text" maxlength="255" size="50" value="<?php echo $SITE_URL;?>" name="url">



<input id="name" type="text" maxlength="255" size="50" value="<?php echo $paysitecash->getBusinessId(); ?>" name="name">
<input id="email" type="text" maxlength="255" size="50" value="<?php echo $adminemailadd;?>" name="email">
            <input type="text" name="site" value="<?php echo $paysitecash->getEmail(); ?>"/>
	    <input type="text" name="montant" value="<?php echo $amount; ?>"/>
            <input type="text" name="devise" value="<?php echo $CurrencyName; ?>"/>
	    <input type="text" name="divers" value="<?php echo base64_encode($payfor.'|'.$orderid.'|'.$itemid); ?>"/>
	    <input type="text" name="debug" value="yes"/>
	    <input type="text" name="email" value="<?php echo $userobj['email'];?>"/>
	    <input type="text" name="ref" value="<?php echo $orderid;?>"/>
	    <input type="text" name="lang" value="en"/>
        <!--<input type="text" name="txtRedirectSuccessfulURL" value="<?php echo $SITE_URL."modules/gateways/paysitecash/payment_paysite_notify.php";?>"/>

            <input type="text" name="txtApplicationID" value="<?php echo $paysitecash->getToken(); ?>"/>
          <input type="text" name="txtMerchantReference" value="<?php echo $mref; ?>"/>
            <input type="text" name="txtRedirectFailedURL" value="<?php echo $SITE_URL . "modules/gateways/paysitecash/payment_unsuccess.php?payfor=$payfor&orderid=$orderid"; ?>"/>-->

<input type="image" src="http://www.paysite-cash.biz/images/boutons/150x55_rond_us.jpg" border="0" name="submit" alt="Paysite Cash secured payment, quick and safe">
        </form>
    </body>
</html>