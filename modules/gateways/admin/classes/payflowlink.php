<?php
class PayflowLinkInfo extends PayMethod{
    private $login;
    private $parter;

    public function __construct(){
        parent::__construct('payflowlink');
    }

    public function getLogin(){
        return $this->login;
    }

    public function setLogin($login){
        $this->login=$login;
    }

    public function getParter(){
        return $this->parter;
    }

    public function setParter($parter){
        $this->parter=$parter;
    }

}
