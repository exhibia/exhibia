<?php
        $pagseguro=$gateway->getPagseguro();
        $pagseguro->setEmail($_POST['email']);
        $pagseguro->setToken($_POST['token']);
        $pagseguro->setFreightType($_POST['freighttype']);
        $pagseguro->setEnabled($_POST['enabled']);
        $pagseguro->setTestMode($_POST['testmode']);
        $gateway->updatePagseguro($pagseguro);
