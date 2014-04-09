<?php
        $idealing=$gateway->getIdealing();
        $idealing->setEnabled($_POST['enabled']);
        $idealing->setTestMode($_POST['testmode']);
        $gateway->updateIdealing($idealing);
 