<?php
        $paypalPro=$gateway->getPaypalPro();
        $paypalPro->setUsername($_POST['apiusername']);
        $paypalPro->setPassword($_POST['apipassword']);
        $paypalPro->setSignature($_POST['apisignature']);
        $paypalPro->setEnabled($_POST['enabled']);
        $paypalPro->setTestMode($_POST['testmode']);
        $gateway->updatePaypalPro($paypalPro);
