<?php

class CCAvenueInfo extends PayMethod{

    private $merchantID;
    private $workingKey;

    public function __construct(){
        parent::__construct('ccavenue');
    }

    public function getMerchantID(){
        return $this->merchantID;
    }

    public function setMerchantID($merchantID){
        $this->merchantID=$merchantID;
    }

    public function getWorkingKey(){
        return $this->workingKey;
    }

    public function setWorkingKey($workingKey){
        $this->workingKey=$workingKey;
    }

}

