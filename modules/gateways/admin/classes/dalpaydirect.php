<?php


class DalPayDirectInfo extends PayMethod {
    /**
     * data filed business_id
     * @var <type>
     */
    private $businessId;
    private $token;

    public function __construct() {
        parent::__construct("dalpay");
    }

    public function getBusinessId() {
        return $this->businessId;
    }

    public function setBusinessId($businessid) {
        $this->businessId=$businessid;
    }

    public function setToken($token) {
        $this->token=$token;
    }

    public function getToken() {
        return $this->token;
    }
    public function setPassword($password) {
        $this->password=$password;
    }

    public function getPassword() {
        return $this->additional1;
    }
}
