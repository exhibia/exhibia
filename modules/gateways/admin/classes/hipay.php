<?php

class HipayInfo extends PayMethod {
    /**
     * data filed business_id
     * @var <type>
     */
    private $businessId;
 

    public function __construct() {
        parent::__construct("hipay");
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
