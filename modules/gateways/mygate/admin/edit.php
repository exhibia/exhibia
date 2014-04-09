<?php
        $mygate=$gateway->getPaymentMyGate();
        $mygate->setMerchantID($_POST['merchantid']);
        $mygate->setApplicationID($_POST['applicationid']);
        $mygate->setEnabled($_POST['enabled']);
        $mygate->setTestMode($_POST['testmode']);
        $gateway->updatePaymentMyGate($mygate);
