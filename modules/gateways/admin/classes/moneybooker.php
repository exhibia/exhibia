<?php

class MoneyBookerInfo extends PayMethod {
    private $merchantEmail;
    private $secretword;

    public function  __construct() {
        parent::__construct('moneybooker');
    }

    public function getMerchantEmail(){
        return $this->merchantEmail;
    }

    public function setMerchantEmail($email){
        $this->merchantEmail=$email;
    }

    public function getSecretword(){
        return $this->secretword;
    }

    public function setSecretword($sw){
        $this->secretword=$sw;
    }
}
