<?php
if(!class_exists('getPayflowLink')){
class getPayflowLink extends PayGateway {
   public function getPayflowLink(){
        $payflowlink=new PayflowLinkInfo();
        $result=$this->select($payflowlink->getName());
        if(db_num_rows($result)==0){
            $this->insert($payflowlink->getName(),'','','','');
            return $payflowlink;
        }else{
            $obj=db_fetch_object($result);
            $payflowlink->setLogin($obj->business_id);
            $payflowlink->setParter($obj->token);
            $payflowlink->setEnabled($obj->enabled);
            $payflowlink->setTestMode($obj->testmode);
            return $payflowlink;
        }
    }

    public function updatePayflowLink($payflowlink){
        $this->update($payflowlink->getName(),$payflowlink->getLogin(),$payflowlink->getParter(),$payflowlink->isEnabled(),'0','','');
    }
}
}