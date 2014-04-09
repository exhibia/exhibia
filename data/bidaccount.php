<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    require_once $BASE_DIR . '/common/dbmysql.php';


/**
 * Description of bidaccount
 *
 * 
 */
class Bidaccount {

    private $db;

    //put your code here
    public function __construct($db) {
        if ($db == null) {
            $this->db = new DBMysql();
        } else {
            $this->db = $db;
        }
    }

    public function selectById($id, $bidflag='', $rechargetype='') {
        $sql = "select * from bid_account where user_id='$id'";
        if ($bidflag != '') {
            $sql = $sql . " and bid_flag='$bidflag'";
        }
        if ($rechargetype != '') {
            $sql = $sql . " and recharge_type='$rechargetype'";
        }
        return $this->db->executeQuery($sql);
    }

    public function insertForSponser($userid, $bidcount, $refererid) {
        $sql = "Insert into bid_account (user_id, bidpack_buy_date, bid_count, bid_flag,recharge_type,referer_id,credit_description) values('$userid',NOW(),'$bidcount','c','af','$refererid','Refferal Bouns')";
        return $this->db->executeQuery($sql);
    }

    public function insertWonPack($userid, $bidpackid, $bidcount, $description) {
        $sql = "Insert into bid_account (user_id,bidpack_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('$userid','$bidpackid',NOW(),'$bidcount','c','wp','$description')";
        return $this->db->executeQuery($sql);
    }

    public function insert($userid, $bidpackid, $bidcount, $description, $table = 'bid_account') {
        $sql = "Insert into $table (user_id,bidpack_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('$userid','$bidpackid',NOW(),'$bidcount','c','re','$description')";
        return $this->db->executeQuery($sql);
    }

    public function countByUserID($aucid, $userid) {
        $sql = "select sum(bid_count) from bid_account where bid_flag='d' and auction_id='$aucid' and user_id='$userid'";
	$data = db_fetch_array($this->db->executeQuery($sql));
       return $data[0];
      
       
        
    }

}

?>
