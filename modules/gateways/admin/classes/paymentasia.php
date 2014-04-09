<?php


class PaymentasiaInfo extends PayMethod{

    private $merchantID;
    private $merchantEMAIL;
    private $referenceTitle;

    public function __construct(){
        parent::__construct('paymentasia');
    }

    public function getMerchantID(){
        return $this->merchantID;
    }

    public function setMerchantID($merchantID){
        $this->merchantID=$merchantID;
    }

    public function getMerchantEmail(){
        return $this->merchantEMAIL;
    }

    public function setMerchantEmail($merchantEmail){
        $this->merchantEMAIL=$merchantEmail;
    }

    public function getReferenceTitle(){
        return $this->referenceTitle;
    }

    public function setReferenceTitle($referenceTitle){
        $this->referenceTitle=$referenceTitle;
    }

}

