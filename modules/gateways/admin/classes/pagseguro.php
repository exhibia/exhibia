<?php

class CPagseguro extends PayMethod{
    private $token;
    private $email;
    private $feightType;

     public function __construct(){
        parent::__construct('pagseguro');
    }

    public function getToken(){
        return $this->token;
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
}
