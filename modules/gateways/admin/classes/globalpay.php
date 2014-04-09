<?php


class GlobalPayInfo extends PayMethod {
    /**
     * data filed business_id
     * @var <type>
     */
    private $businessId;
    private $token;
    private $password;

    public function __construct() {
        parent::__construct("globalpay");
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
    public function setPassword($password) {

        $this->password=$password;
    }
    public function getPassword() {
        return $this->password;
    }
    public function setPhone($phone) {

        $this->phone=$phone;
    }
    public function getPhone() {
        return $this->additional2;
    }
    public function getToken() {
        return $this->token;
    }

}
