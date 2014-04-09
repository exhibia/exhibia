<?php

       $mbinfo=$gateway->getMoneyBooker();
        $mbinfo->setMerchantEmail($_POST['merchantemail']);
        $mbinfo->setSecretword($_POST['secretword']);
        $mbinfo->setEnabled($_POST['enabled']);
        $mbinfo->setTestMode($_POST['testmode']);
        $gateway->updateMoneyBooker($mbinfo);
