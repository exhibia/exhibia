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
class AdvertPosition {

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
        $qryauc = "select * from advertposition where id=$id";

        return $this->db->executeQuery($qryauc);
    }

    public function isActive($id){
        $qryauc = "select * from advertposition where id=$id";
        $result=$this->db->executeQuery($qryauc);

        $obj=db_fetch_object($result);

        return $obj->active;
    }

    public function updateStatus($id,$status){
        $qryauc = "update advertposition set active=$status where id=$id";
        return $result=$this->db->executeQuery($qryauc);
    }

    public function selectAll(){
        return $this->db->executeQuery('select * from advertposition');
    }
}
?>
