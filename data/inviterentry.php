<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (file_exists('common/dbmysql.php')) {
    require_once 'common/dbmysql.php';
} else {
    require_once '../common/dbmysql.php';
}

/**
 * Description of inviterentry
 *
 * @author fedora
 */
class InviterEntry {

    //put your code here
    private $username = '';
    private $apikey = '';
    private $subject = '';
    private $body = '';

    public function __construct() {
        
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setApikey($apikey) {
        $this->apikey = $apikey;
    }

    public function getApikey() {
        return $this->apikey;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getBody() {
        return $this->body;
    }

}

class InviterEntryFactory {

    public static function getInviterEntry() {
        $db = new DBMysql();
        $sql = "select * from pluginsetting where name='openinviter'";
        $result = $db->executeQuery($sql);
        $entry = new InviterEntry();
        if (db_num_rows($result) > 0) {
            $obj = db_fetch_array($result);
            $entry->setUsername($obj['option1']);
            $entry->setApikey($obj['option2']);
            $entry->setSubject($obj['option3']);
            $entry->setBody($obj['option4']);
        } else {
            $sql = "insert into pluginsetting(name,option1,option2,option3,option4) values('openinviter','','','','');";
            $db->executeQuery($sql);
        }
        return $entry;
    }

    public static function updateInviterEntry($entry) {
        $sql = "update pluginsetting set option1='{$entry->getUsername()}',option2='{$entry->getApikey()}',option3='{$entry->getSubject()}',option4='{$entry->getBody()}'";
        $db=new DBMysql();
        $db->executeQuery($sql);
    }

}

?>
