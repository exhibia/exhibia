<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    require_once $BASE_DIR . '/common/dbmysql.php';


/**
 * Description of freeaccount
 *
 * 
 */
class Freeaccount {

    private $db;

    //put your code here
    public function __construct($db) {
        if ($db == null) {
            $this->db = new DBMysql();
        } else {
            $this->db = $db;
        }
    }

    public function insertWonPack($userid, $bidpackid, $freebids) {
        $sql = "Insert into free_account(user_id,bidpack_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('$userid','$bidpackid',NOW(),'$freebids','c','wp','Free Bids')";
        return $this->db->executeQuery($sql);
    }

    public function insert($userid, $bidpackid, $freebids) {
        $sql = "Insert into free_account(user_id,bidpack_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('$userid','$bidpackid',NOW(),'$freebids','c','re','Free Bids')";
        return $this->db->executeQuery($sql);
    }

}

?>
