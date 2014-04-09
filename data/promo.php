<?php

if(file_exists('common/guid.class.php')) {
    include_once 'common/guid.class.php';
}else {
    include_once '../common/guid.class.php';
}

if(file_exists('common/dbmysql.php')) {
    require_once 'common/dbmysql.php';
}else {
    require_once '../common/dbmysql.php';
}

include_once 'coupon.php';
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of usercoupon
 *
 * 
 */
class Promo {
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
        if($this->db!=null) {
            //db_close($this->db);
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
        $addigndate=date('Y-m-d');
        $sql="insert into promocodes(id,discount,assigndate,uniqueid) values(null,'{$discount}',CURDATE(),'{$uniqueid}');";
        return $this->db->executeQuery($sql);
    }

    /**
     *
     * @param <type> $id
     * @param <type> $db the $db will be not null, when want a transaction
     */
    public function delete($id) {
        return $this->db->executeQuery("delete from promocodes where id='$id'");
    }

   

    public function selectById($id) {
        return $this->db->executeQuery("select * from promocodes where uniqueid='$uniqueid'");
    }

   
}
?>
