<?php

        $authnetInfo=$gateway->getAuthnet();
        $authnetInfo->setLoginId($_POST['loginid']);
        $authnetInfo->setTransKey($_POST['transkey']);
        $authnetInfo->setEnabled($_POST['enabled']);
        $authnetInfo->setTestMode($_POST['testmode']);
        $gateway->updateAuthnet($authnetInfo);
