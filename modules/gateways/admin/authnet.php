<?php 

if(!class_exists('getAuthnet')){
class getAuthnet extends PayGateway {

    public function getAuthnet() {
        $authnetInfo=new AuthnetInfo();
        $result=$this->select($authnetInfo->getName());
        if(db_num_rows($result)==0) {
            $this->insert($authnetInfo->getName(), '','','','');
            return $authnetInfo;
        }else {
            $obj=db_fetch_object($result);
            $authnetInfo->setLoginId($obj->business_id);
            $authnetInfo->setTransKey($obj->token);
            $authnetInfo->setEnabled($obj->enabled);
            $authnetInfo->setTestMode($obj->testmode);
            return $authnetInfo;
        }
    }

    public function updateAuthnet($authnetInfo) {
        $this->update($authnetInfo->getName(),$authnetInfo->getLoginId(),$authnetInfo->getTransKey(),$authnetInfo->isEnabled(),$authnetInfo->isTestMode(), '','');
    }

 }

       
}

 



