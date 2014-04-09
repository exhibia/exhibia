<?php

if(!class_exists('getPaymentCCAvenue')){
class getPaymentCCAvenue extends PayGateway {
  public function getPaymentCCAvenue(){
        $ccavenue=new CCAvenueInfo();
        $result=$this->select($ccavenue->getName());
        if(db_num_rows($result)==0){
            $this->insert($ccavenue->getName(), '', '', '', '');
            return $ccavenue;
        }else{
            $obj=db_fetch_object($result);
            $ccavenue->setMerchantID($obj->business_id);
            $ccavenue->setWorkingKey($obj->token);
            $ccavenue->setEnabled($obj->enabled);
            $ccavenue->setTestMode($obj->testmode);
            return $ccavenue;
        }
    }

    public function updatePaymentCCAvenue($ccavenue){
        $this->update($ccavenue->getName(), $ccavenue->getMerchantID(), $ccavenue->getWorkingKey(), $ccavenue->isEnabled(), $ccavenue->isTestMode(), '', '');
    }

}

}