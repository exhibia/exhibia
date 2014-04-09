<?php

    if($_POST['for']=='paypal') {
        $paypalInfo=$gateway->getPaypal();
        $paypalInfo->setBusinessId($_POST["businessid"]);
        $paypalInfo->setToken($_POST['token']);
        $paypalInfo->setEnabled($_POST['enabled']);
        $paypalInfo->setTestMode($_POST['testmode']);
        $gateway->updatePaypal($paypalInfo);
    }
    else if($_POST['for']=='pesapal'){
        $paypalPro=$gateway->getPaypalPro();
        $paypalPro->setUsername($_POST['apiusername']);
        $paypalPro->setPassword($_POST['apipassword']);
        $paypalPro->setSignature($_POST['apisignature']);
        $paypalPro->setEnabled($_POST['enabled']);
        $paypalPro->setTestMode($_POST['testmode']);
        $gateway->updatePaypalPro($paypalPro);
    }else if($_POST['for']=='paypalpro'){
        $paypalPro=$gateway->getPaypalPro();
        $paypalPro->setUsername($_POST['apiusername']);
        $paypalPro->setPassword($_POST['apipassword']);
        $paypalPro->setSignature($_POST['apisignature']);
        $paypalPro->setEnabled($_POST['enabled']);
        $paypalPro->setTestMode($_POST['testmode']);
        $gateway->updatePaypalPro($paypalPro);
    }else if($_POST['for']=='authnet'){
        $authnetInfo=$gateway->getAuthnet();
        $authnetInfo->setLoginId($_POST['loginid']);
        $authnetInfo->setTransKey($_POST['transkey']);
        $authnetInfo->setEnabled($_POST['enabled']);
        $authnetInfo->setTestMode($_POST['testmode']);
        $gateway->updateAuthnet($authnetInfo);
    }else if($_POST['for']=='googlecheckout'){
        $googlecheckoutInfo=$gateway->getGoogleCheckOut();
        $googlecheckoutInfo->setMerchantId($_POST['merchantid']);
        $googlecheckoutInfo->setMerchantKey($_POST['merchantkey']);
        $googlecheckoutInfo->setEnabled($_POST['enabled']);
        $googlecheckoutInfo->setTestMode($_POST['testmode']);
        $gateway->updateGoogleCheckOut($googlecheckoutInfo);
    }else if($_POST['for']=='moneybooker'){
        $mbinfo=$gateway->getMoneyBooker();
        $mbinfo->setMerchantEmail($_POST['merchantemail']);
        $mbinfo->setSecretword($_POST['secretword']);
        $mbinfo->setEnabled($_POST['enabled']);
        $mbinfo->setTestMode($_POST['testmode']);
        $gateway->updateMoneyBooker($mbinfo);
    }else if($_POST['for']=='payflowlink'){
        $payflow=$gateway->getPayflowLink();
        $payflow->setLogin($_POST['login']);
        $payflow->setParter($_POST['parter']);
        $payflow->setEnabled($_POST['enabled']);
        $gateway->updatePayflowLink($payflow);
    }else if($_POST['for']=='paymentasia'){
        $paymentasia=$gateway->getPaymentasia();
        $paymentasia->setMerchantID($_POST['merchantid']);
        $paymentasia->setMerchantEmail($_POST['merchantemail']);
        $paymentasia->setEnabled($_POST['enabled']);
        $paymentasia->setTestMode($_POST['testmode']);
        $paymentasia->setReferenceTitle($_POST['referencetitle']);
        $gateway->updatePaymentasia($paymentasia);
    }else if($_POST['for']=='ccavenue'){
        $ccavenue=$gateway->getPaymentCCAvenue();
        $ccavenue->setMerchantID($_POST['merchantid']);
        $ccavenue->setWorkingKey($_POST['workingkey']);
        $ccavenue->setEnabled($_POST['enabled']);
        $ccavenue->setTestMode($_POST['testmode']);
        $gateway->updatePaymentCCAvenue($ccavenue);
    }else if($_POST['for']=='mygate'){
        $mygate=$gateway->getPaymentMyGate();
        $mygate->setMerchantID($_POST['merchantid']);
        $mygate->setApplicationID($_POST['applicationid']);
        $mygate->setEnabled($_POST['enabled']);
        $mygate->setTestMode($_POST['testmode']);
        $gateway->updatePaymentMyGate($mygate);
    }else if($_POST['for']=='pagseguro'){
        $pagseguro=$gateway->getPagseguro();
        $pagseguro->setEmail($_POST['email']);
        $pagseguro->setToken($_POST['token']);
        $pagseguro->setFreightType($_POST['freighttype']);
        $pagseguro->setEnabled($_POST['enabled']);
        $pagseguro->setTestMode($_POST['testmode']);
        $gateway->updatePagseguro($pagseguro);
    }

    header("location: message.php?msg=54");
