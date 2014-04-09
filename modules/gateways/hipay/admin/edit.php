<?php

	$hipayInfo=$gateway->getHipay();
        $hipayInfo->setBusinessId($_POST["businessid"]);
        $hipayInfo->setToken($_POST['token']);
        $hipayInfo->setEnabled($_POST['enabled']);
        $hipayInfo->setTestMode($_POST['testmode']);
        $gateway->updateHipay($hipayInfo); 
        
        
   
