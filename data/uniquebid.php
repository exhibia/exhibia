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
 * Description of uniquebid
 *
 * @author fedora
 */
class UniqueBid {

    //put your code here
    private $db;

    //put your code here

    public function __construct($db) {
        if ($db == null) {
            $this->db = new DBMysql();
        } else {
            $this->db = $db;
        }
    }

    public function isExistByUserPrice($userid, $aucid, $price) {
        $sql = "select * from unique_bid where auctionid='$aucid' and userid='$userid' and bidprice='$price'";
        $result = $this->db->executeQuery($sql);
        if (db_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }


}
?>
