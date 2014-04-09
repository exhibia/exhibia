<?php
if(!class_exists('getHipay')){
class getHipay extends PayGateway {
     public function getHipay() {
        $hipayInfo=new HipayInfo();
        $result=$this->select($hipayInfo->getName());
        if(db_num_rows($result)==0) {
            $this->insert($hipayInfo->getName(), '', '', '', '');
            return $hipayInfo;
        }else {
            $obj=db_fetch_object($result);
            $hipayInfo->setBusinessId($obj->business_id);
	    $hipayInfo->setToken($obj->token);
            $hipayInfo->setEnabled($obj->enabled);
            $hipayInfo->setTestMode($obj->testmode);
            return $hipayInfo;
        }
    }
    public function updateHipay($hipayInfo) {
        $this->update($hipayInfo->getName(),$hipayInfo->getBusinessId(),$paypalInfo->getToken(),$paypalInfo->isEnabled(), $paypalInfo->isTestMode(), '','');

    } 
}
}