<?php
if(!class_exists('getGlobalPay')){

class getGlobalPay extends PayGateway {

    public function getGlobalPay() {
        $paypalInfo=new GlobalPayInfo();
        $result=$this->select($paypalInfo->getName());
        if(db_num_rows($result)==0) {
            $this->insert($paypalInfo->getName(), '', '', '', '');
            return $paypalInfo;
        }else {
            $obj=db_fetch_object($result);
            $paypalInfo->setBusinessId($obj->business_id);
            $paypalInfo->setToken($obj->token);
            $paypalInfo->additional1($obj->additional1);
            $paypalInfo->setEnabled($obj->enabled);
            $paypalInfo->setTestMode($obj->testmode);
            return $paypalInfo;
        }
    }

    public function updateGlobalPay($paypalInfo) {
        $this->update($paypalInfo->getName(),$paypalInfo->getBusinessId(),$paypalInfo->getToken(),$paypalInfo->isEnabled(), $paypalInfo->isTestMode(), $paypalInfo->additional1(),'');
    }
}
}