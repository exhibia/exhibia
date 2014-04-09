<?php
        $idealpro=$gateway->getIdealPro();
        $idealpro->setEnabled($_POST['enabled']);
        $idealpro->setTestMode($_POST['testmode']);
        $gateway->updateIdealPro($idealpro);
   