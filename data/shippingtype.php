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
/* * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class ShippingType {

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
        $qryauc = "select * from shippingtype where id=$id";

        return $this->db->executeQuery($qryauc);
    }

    public function count(){
        $result=$this->db->executeQuery("select count(*) from shippingtype");
        return db_result($result, 0);
    }

    public function selectAll(){
        return $this->db->executeQuery('select * from shippingtype');
    }

    public function insert($name,$logoimage,$url){
        $sql="insert into shippingtype(name,logoimage,url) values('$name','$logoimage','$url');";
        return $this->db->executeQuery($sql);
    }

    public function update($id,$name,$logoimage,$url){
        $sql="update shippingtype set name='$name',logoimage='$logoimage',url='$url' where id=$id";
        return $this->db->executeQuery($sql);
    }

    public function delete($id){
        $sql="delete from shippingtype where id=$id";
        return $this->db->executeQuery($sql);
    }

}
?>
