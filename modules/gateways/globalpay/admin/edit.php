<?php
ini_set('display_errors', 1);
	$paypalInfo=$gateway->getGlobalPay();
        $paypalInfo->setBusinessId($_POST["businessid"]);
        $paypalInfo->setToken($_POST['token']);
        $paypalInfo->setPassword($_POST['password']);
        $paypalInfo->setPhone($_POST['phone']);
        $paypalInfo->setEnabled($_POST['enabled']);
        $paypalInfo->setTestMode($_POST['testmode']);
        $gateway->updateGlobalPay($paypalInfo);
