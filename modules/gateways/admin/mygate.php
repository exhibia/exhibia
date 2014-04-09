<?php
if(!class_exists('getPaymentMyGate')){
class getPaymentMyGate extends PayGateway {

 
    public function getPaymentMyGate(){
        $mygate=new CMyGateInfo();
        $result=$this->select($mygate->getName());
        if(db_num_rows($result)==0){
            $this->insert($mygate->getName(),'','','','');
            return $mygate;
        }else{
            $obj=db_fetch_object($result);
            $mygate->setMerchantID($obj->business_id);
            $mygate->setApplicationID($obj->token);
            $mygate->setEnabled($obj->enabled);
            $mygate->setTestMode($obj->testmode);
            return $mygate;
        }
    }

    public function updatePaymentMyGate($mygate){
        $this->update($mygate->getName(), $mygate->getMerchantID(), $mygate->getApplicationID(), $mygate->isEnabled(), $mygate->isTestMode(), '', '');
    }
}
}