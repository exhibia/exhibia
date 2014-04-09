<?php

class CMyGateInfo extends PayMethod{

    private $merchantID;
    private $applicationID;

    public function __construct(){
        parent::__construct('mygate');
    }

    public function getMerchantID(){
        return $this->merchantID;
    }

    public function setMerchantID($merchantID){
        $this->merchantID=$merchantID;
    }

    public function getApplicationID(){
        return $this->applicationID;
    }

    public function setApplicationID($applicationID){
        $this->applicationID=$applicationID;
    }

}
