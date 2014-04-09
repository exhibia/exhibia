<?php

    require_once $BASE_DIR . '/common/dbmysql.php';


/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of usercouponhistory
 *
 * 
 */
class UserCouponHistory {
    private $db;
    //put your code here
    public function  __construct($db) {
        if($db==null) {
            $this->db =new DBMysql();
        }else {
            $this->db=$db;
        }
    }

    public function  __destruct() {
        if($this->db!=null){
           // db_close($this->db);
        }
    }

    /**
     *
     * @param <type> $userid
     * @param <type> $couponid
     * @param <type> $uniqueid
     * @param <type> $db the $db will be not null, when want a transaction
     */
    public function insert($userid,$couponid,$uniqueid) {
        $usedate=date('Y-m-d');
        $sql="insert into user_coupon_history(regid,couponid,usedate,uniqueid) values('{$userid}','{$couponid}','$usedate','{$uniqueid}');";
        return $this->db->executeQuery($sql);
    }

    /**
     *
     * @param <type> $id
     * @param <type> $db the $db will be not null, when want a transaction
     */
    public function delete($id) {

    }

    public function count($userid) {
        $query = $this->db->executeQuery("select count(*) from user_coupon_history where regid='$userId' ;");
        $row=db_fetch_row($query);
        return $row[0];
    }

    public function selectByUser($userId,$offset,$count) {
        return $this->db->executeQuery("select user_coupon_history.id as id, usedate,uniqueid,title,discount,freebids,startdate,enddate from user_coupon_history left join coupon
            on user_coupon_history.couponid=coupon.id where user_coupon_history.regid='$userId' order by usedate desc LIMIT $offset,$count;");
    }

    public function selectByUniqueId($uniqueId) {

    }
}
?>
