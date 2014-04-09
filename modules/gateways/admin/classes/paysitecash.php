<?php

class CPaysitecash extends PayMethod{

    private $token;
    private $email;
    private $feightType;

     public function __construct(){
        parent::__construct('paysitecash');

    }

    public function getToken(){
        return $this->token;
//echo 'test';
    }

    public function setToken($token){
        $this->token=$token;
    }

    public function getEmail(){

        return $this->email;

    }

    public function setEmail($email){
        $this->email=$email;
    }

    public function getFreightType(){
        return $this->feightType;
    }

    public function setFreightType($feightType){
        $this->feightType=$feightType;
    }
    
        public function getBusinessId() {
        return $this->businessId;
    }

    public function setBusinessId($businessid) {
        $this->businessId=$businessid;
    }
}
