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
 * Description of shippingstatus
 *
 * @author fedora
 */
class ShippingStatus {
    private $db;

    //put your code here

    public function __construct($db) {
        if ($db==null) {
            $this->db = new DBMysql();
        } else {
            $this->db = $db;
        }
    }

    public function selectById($id) {
        $qryauc = "select * from shippingstatus where id=$id";

        return $this->db->executeQuery($qryauc);
    }

    public function count(){
        $result=$this->db->executeQuery("select count(*) from shippingstatus");
        return db_result($result, 0);
    }

    public function selectAll(){
        return $this->db->executeQuery('select * from shippingstatus');
    }

    public function insert($shippingtypeid,$orderid,$ordertype,$tracknumber){
        $sql="insert into shippingstatus(shippingtypeid,orderid,ordertype,tracknumber,adddate) values('$shippingtypeid','$orderid','$ordertype','$tracknumber',NOW());";
        return $this->db->executeQuery($sql);
    }

    public function update($id,$shippingtypeid,$tracknumber){
        $sql="update shippingstatus set tracknumber='$tracknumber',shippingtypeid='$shippingtypeid' where id=$id";
        return $this->db->executeQuery($sql);
    }

    public function delete($id){
        $sql="delete from shippingstatus where id=$id";
        return $this->db->executeQuery($sql);
    }

}
?>
