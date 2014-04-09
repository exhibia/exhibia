<?php





class AuthnetInfo extends PayMethod {
    private $loginid;
    private $transkey;

    public function  __construct() {
        parent::__construct('authnet');
    }

    public function getLoginId() {
        return $this->loginid;
    }

    public function setLoginId($loginid) {
        $this->loginid=$loginid;
    }

    public function getTransKey() {
        return $this->transkey;
    }

    public function setTransKey($transKey) {
        $this->transkey=$transKey;
    }
}


