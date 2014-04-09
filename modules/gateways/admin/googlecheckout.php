<?php
if(!class_exists('getGoogleCheckOut')){
class getGoogleCheckOut extends PayGateway {
   public function getGoogleCheckOut() {
        $googleInfo=new GoogleCheckoutInfo();
        $result=$this->select($googleInfo->getName());
        if(db_num_rows($result)==0) {
            $this->insert($googleInfo->getName(),'','','','');
            return $googleInfo;
        }else {
            $obj=db_fetch_object($result);
            $googleInfo->setMerchantId($obj->business_id);
            $googleInfo->setMerchantKey($obj->token);
            $googleInfo->setEnabled($obj->enabled);
            $googleInfo->setTestMode($obj->testmode);
            return $googleInfo;
        }
    }

    public function updateGoogleCheckOut($googleCheckOut) {
        $this->update($googleCheckOut->getName(),$googleCheckOut->getMerchantId(),$googleCheckOut->getMerchantKey(), $googleCheckOut->isEnabled(),$googleCheckOut->isTestMode(), '','');

    }
}
}