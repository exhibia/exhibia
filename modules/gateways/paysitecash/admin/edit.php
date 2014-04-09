<?php


	$paysiteInfo=$gateway->getPaysitecash();
	
        $paysiteInfo->setBusinessId($_POST["businessid"]);
        $paysiteInfo->setToken($_POST['token']);
        $paysiteInfo->setEnabled($_POST['enabled']);
        $paysiteInfo->setTestMode($_POST['testmode']);
        $gateway->updatePaysitecash($paysiteInfo);
