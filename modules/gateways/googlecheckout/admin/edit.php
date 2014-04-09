<?php

       $googlecheckoutInfo=$gateway->getGoogleCheckOut();
        $googlecheckoutInfo->setMerchantId($_POST['merchantid']);
        $googlecheckoutInfo->setMerchantKey($_POST['merchantkey']);
        $googlecheckoutInfo->setEnabled($_POST['enabled']);
        $googlecheckoutInfo->setTestMode($_POST['testmode']);
        $gateway->updateGoogleCheckOut($googlecheckoutInfo);
