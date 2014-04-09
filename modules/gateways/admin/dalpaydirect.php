test<?php
if(!class_exists('DalPayDirectInfo')){
class DalPayDirectInfo extends PayGateway {

    public function getDalPayDirect() {
        $paypalInfo=new PaypalInfo();
        $result=$this->select($paypalInfo->getName());
        if(db_num_rows($result)==0) {
            $this->insert($paypalInfo->getName(), '', '', '', '');
            return $paypalInfo;
        }else {
            $obj=db_fetch_object($result);
            $paypalInfo->setBusinessId($obj->business_id);
            $paypalInfo->setToken($obj->token);
            $paypalInfo->setEnabled($obj->enabled);
            $paypalInfo->setTestMode($obj->testmode);
            return $paypalInfo;
        }
    }

    public function updateDalPayDirect($paypalInfo) {
        $this->update($paypalInfo->getName(),$paypalInfo->getBusinessId(),$paypalInfo->getToken(),$paypalInfo->isEnabled(), $paypalInfo->isTestMode(), '','');
    }
}
}