<?php
        $paymentasia=$gateway->getPaymentasia();
        $paymentasia->setMerchantID($_POST['merchantid']);
        $paymentasia->setMerchantEmail($_POST['merchantemail']);
        $paymentasia->setEnabled($_POST['enabled']);
        $paymentasia->setTestMode($_POST['testmode']);
        $paymentasia->setReferenceTitle($_POST['referencetitle']);
        $gateway->updatePaymentasia($paymentasia);
