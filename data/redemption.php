<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(file_exists('common/dbmysql.php')) {
    require_once 'common/dbmysql.php';
}else {
    require_once '../common/dbmysql.php';
}
/**
 * Description of redeem
 *
 * 
 */
class Redemption {
    //put your code here
    private $db;

    public function  __construct($db) {
        if($db==null) {
            $this->db =new DBMysql();
        }else {
            $this->db=$db;
        }
    }

    public function selectById($id){
        $qrysel = "select * from redemption r left join products p on r.product_id=p.productID left join shipping s on r.redem_shipping=s.id where r.id='$id'";
        return $this->db->executeQuery($qrysel);
    }
}
?>
