<?php

class PaypalProInfo extends PayMethod {
    private $username;
    private $password;
    private $signature;

    public function  __construct() {
        parent::__construct("paypalpro");
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username=$username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password=$password;
    }

    public function setSignature($signature) {
        $this->signature=$signature;
    }

    public function getSignature() {
        return $this->signature;
    }
}
