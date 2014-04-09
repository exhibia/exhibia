<?php

	$paypalInfo=$gateway->getDalPay();
        $paypalInfo->setBusinessId($_POST["businessid"]);
        $paypalInfo->setToken($_POST['token']);
        $paypalInfo->setEnabled($_POST['enabled']);
        $paypalInfo->setTestMode($_POST['testmode']);
        $gateway->updateDalPay($paypalInfo);
