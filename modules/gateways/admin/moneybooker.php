<?php
if(!class_exists('getMoneyBooker')){
class getMoneyBooker extends PayGateway {
    public function getMoneyBooker(){
        $mbinfo=new MoneyBookerInfo();
        $result=$this->select($mbinfo->getName());
        if(db_num_rows(($result))==0){
            $this->insert($mbinfo->getName(), '', '', '', '');
            return $mbinfo;
        }else{
            $obj=db_fetch_object($result);
            $mbinfo->setMerchantEmail($obj->business_id);
            $mbinfo->setSecretword($obj->token);
            $mbinfo->setEnabled($obj->enabled);
            $mbinfo->setTestMode($obj->testmode);
            return $mbinfo;
        }
    }    
    public function updateMoneyBooker($mbinfo){
        $this->update($mbinfo->getName(),$mbinfo->getMerchantEmail(),$mbinfo->getSecretword(),$mbinfo->isEnabled(),$mbinfo->isTestMode(), '','');
    }
}
}