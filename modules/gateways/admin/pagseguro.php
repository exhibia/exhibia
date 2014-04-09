<?php
if(!class_exists('getPagseguro')){
class getPagseguro extends PayGateway {
    public function getPagseguro(){
        $pageseguro=new CPagseguro();
        $result=$this->select($pageseguro->getName());
        if(db_num_rows($result)==0){
            $this->insert($pageseguro->getName(),'','','EN','');
            return $pageseguro;
        }else{
            $obj=db_fetch_object($result);
            $pageseguro->setEmail($obj->business_id);
            $pageseguro->setToken($obj->token);
            $pageseguro->setFreightType($obj->additional1);
            $pageseguro->setEnabled($obj->enabled);
            $pageseguro->setTestMode($obj->testmode);
            return $pageseguro;
        }
    }
 
    public function updatePagseguro($pageseguro){
        $this->update($pageseguro->getName(), $pageseguro->getEmail(), $pageseguro->getToken(), $pageseguro->isEnabled(), $pageseguro->isTestMode(), $pageseguro->getFreightType(), '');
    }
}
}