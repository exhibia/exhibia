<?php


class PaypalInfo extends PayMethod {
    /**
     * data filed business_id
     * @var <type>
     */
    private $businessId;
    private $token;

    public function __construct() {
        parent::__construct("paypal");
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

}
