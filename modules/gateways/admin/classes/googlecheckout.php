<?php

class GoogleCheckoutInfo extends PayMethod {
    private $merchantId;
    private $merchantKey;
    public function  __construct() {
        parent::__construct('googlecheckout');
    }

    public function getMerchantId() {
        return $this->merchantId;
    }

    public function setMerchantId($merchantId) {
        $this->merchantId=$merchantId;
    }

    public function getMerchantKey() {
        return $this->merchantKey;
    }

    public function setMerchantKey($merchantKey) {
        $this->merchantKey=$merchantKey;
    }
}
