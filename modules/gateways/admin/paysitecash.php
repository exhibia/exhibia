<?php
if(!class_exists('CPaysitecash')){
class CPaysitecash extends PayGateway {
     public function getPaysitecash(){
        $paysitecash=new CPaysitecash();

        $result=$this->select($paysitecash->getName());
        if(db_num_rows($result)==0){
            $this->insert($paysitecash->getName(),'','','EN','');
            return $paysitecash;
        }else{
            $obj=db_fetch_object($result);
            $paysitecash->setEmail($obj->business_id);
            $paysitecash->setToken($obj->token);
            $paysitecash->setFreightType($obj->additional1);
            $paysitecash->setEnabled($obj->enabled);
            $paysitecash->setTestMode($obj->testmode);


            return $paysitecash;
        }

    }
   public function updatePaysitecash($paysitecash){

        $this->update($paysitecash->getName(), $paysitecash->getEmail(), $paysitecash->getToken(), $paysitecash->isEnabled(), $paysitecash->isTestMode(), '', '');
    }
}
}