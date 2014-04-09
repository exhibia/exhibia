<?php
print_r($_POST);
	$paypalInfo=$gateway->getPesapal();
        $paypalInfo->setBusinessId($_POST["businessid"]);
        $paypalInfo->setToken($_POST['token']);
        $paypalInfo->setEnabled($_POST['enabled']);
        $paypalInfo->setTestMode($_POST['testmode']);
        $gateway->updatePesapal($paypalInfo);
