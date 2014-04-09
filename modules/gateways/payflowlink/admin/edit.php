<?php
 $payflow=$gateway->getPayflowLink();
        $payflow->setLogin($_POST['login']);
        $payflow->setParter($_POST['parter']);
        $payflow->setEnabled($_POST['enabled']);
        $gateway->updatePayflowLink($payflow);
