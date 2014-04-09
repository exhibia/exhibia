<?php
class  System {
    public function  currentTimeMillis() {
        list($usec,  $sec)  =  explode("  ",microtime());
        return  $sec.substr($usec,  2,  3);
    }
}
class  NetAddress1 {
    var  $Name  =  'localhost';
    var  $IP  =  '127.0.0.1';
    public function  getLocalHost()  //  static
    {
        $address  =  new  NetAddress1();
        $address->Name  =  $_ENV["COMPUTERNAME"];
        $address->IP  =  $_SERVER["SERVER_ADDR"];
        return  $address;
    }
    public function  toString() {
        return  strtolower($this->Name.'/'.$this->IP);
    }
}
class  Random {
    public function nextLong() {
        $tmp  =  rand(0,1)?'-':'';
        return  $tmp.rand(1000,  9999).rand(1000,  9999).rand(1000,  9999).rand(100,  999).rand(100,  999);
    }
}
//  Three sections
//  Microsecond period is the address period is a period random number
class  Guid {
    var  $valueBeforeMD5;
    var  $valueAfterMD5;
    function  Guid() {
        $this->getGuid();
    }
    //
    function  getGuid() {
        $address  =  NetAddress1::getLocalHost();
        $this->valueBeforeMD5  =  $address::toString().':'.System::currentTimeMillis().':'.Random::nextLong();
        $this->valueAfterMD5  =  md5($this->valueBeforeMD5);
    }
    function  newGuid() {
        $Guid  =  new  Guid();
        return  $Guid;
    }
    function  toString() {
        $raw  =  strtoupper($this->valueAfterMD5);
       
        return  substr($raw,0,8).'-'.substr($raw,8,4).'-'.substr($raw,12,4).'-'.substr($raw,16,4).'-'.substr($raw,20);
    }
}
?>
