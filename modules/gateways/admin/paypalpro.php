<?php
if(!class_exists('getPaypalPro')){
class getPaypalPro extends PayGateway {
    public function getPaypalPro() {
        $paypalPro=new PaypalProInfo();
        $result=$this->select($paypalPro->getName());
        if(db_num_rows($result)==0) {
            $this->insert($paypalPro->getName(), '', '','','');
            return $paypalPro;
        }else {
            $obj=db_fetch_object($result);
            $paypalPro->setUsername($obj->business_id);
            $paypalPro->setPassword($obj->token);
            $paypalPro->setSignature($obj->additional1);
            $paypalPro->setEnabled($obj->enabled);
            $paypalPro->setTestMode($obj->testmode);
            return $paypalPro;
        }
    }

    public function updatePaypalPro($paypalPro) {
        $this->update($paypalPro->getName(),$paypalPro->getUsername(),$paypalPro->getPassword(),$paypalPro->isEnabled(), $paypalPro->isTestMode(),$paypalPro->getSignature(), '');
    }
}
}