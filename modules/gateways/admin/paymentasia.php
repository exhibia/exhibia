<?php
if(!class_exists('getPaymentasia')){
class getPaymentasia extends PayGateway {
    public function getPaymentasia(){
        $paymentasia=new PaymentasiaInfo();
        $result=$this->select($paymentasia->getName());
        if(db_num_rows($result)==0){
            $this->insert($paymentasia->getName(), '', '', '', '');
            return $paymentasia;
        }else{
            $obj=db_fetch_object($result);
            $paymentasia->setMerchantID($obj->business_id);
            $paymentasia->setMerchantEmail($obj->token);
            $paymentasia->setEnabled($obj->enabled);
            $paymentasia->setTestMode($obj->testmode);
            $paymentasia->setReferenceTitle($obj->additional1);
            return $paymentasia;
        }        
    }

    public function updatePaymentasia($paymentasia){
        $this->update($paymentasia->getName(), $paymentasia->getMerchantID(), $paymentasia->getMerchantEmail(),$paymentasia->isEnabled(),$paymentasia->isTestMode(), $paymentasia->getReferenceTitle(), '');
    }
}

}