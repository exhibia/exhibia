<?php
	$ccavenue=$gateway->getPaymentCCAvenue();
        $ccavenue->setMerchantID($_POST['merchantid']);
        $ccavenue->setWorkingKey($_POST['workingkey']);
        $ccavenue->setEnabled($_POST['enabled']);
        $ccavenue->setTestMode($_POST['testmode']);
        $gateway->updatePaymentCCAvenue($ccavenue);
