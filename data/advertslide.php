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
class AdvertSlide {

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
        $qryauc = "select * from advertslide where id=$id";

        return $this->db->executeQuery($qryauc);
    }

    public function count(){
        $result=$this->db->executeQuery("select count(*) from advertslide");
        return db_result($result, 0);
    }

    public function selectAll(){
        return $this->db->executeQuery('select * from advertslide');
    }

    public function selectByGroup($gid){
        return $this->db->executeQuery("select * from advertslide where groupid=$gid");
    }

    public function insert($groupid,$image,$url){
        $sql="insert into advertslide(groupid,image,url) values('$groupid','$image','$url');";
        return $this->db->executeQuery($sql);
    }

    public function update($id,$image,$url){
        $sql="update advertslide set image='$image',url='$url' where id=$id";
        return $this->db->executeQuery($sql);
    }

    public function delete($id){
        $sql="delete from advertslide where id=$id";
        return $this->db->executeQuery($sql);
    }

}
?>
