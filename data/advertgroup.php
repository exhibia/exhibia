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
class AdvertGroup {

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
        $qryauc = "select * from advertgroup where id=$id";
        return $this->db->executeQuery($qryauc);
    }

    public function selectByPosition($id) {
        $qryauc = "select * from advertgroup ag where positionid=$id and actived=1 and (select count(*) from advertslide where groupid=ag.id)>0";
        return $this->db->executeQuery($qryauc);
    }

    public function count(){
        $result=$this->db->executeQuery("select count(*) from advertgroup");
        return db_result($result, 0);
    }

    public function selectLimit($offset,$count){
        return $this->db->executeQuery("select ag.id as id,ap.id as pid,name,width,height,stretch,delay,effect,position,actived,(select count(*) from advertslide where groupid=ag.id) as slidecount from advertgroup ag left join advertposition ap on ag.positionid=ap.id LIMIT $offset,$count");
        //$result=db_query("select ag.id as id,ap.id as pid,name,width,height,stretch,delay,effect,position,(select count(*) from advertslide as slidecount) from advertgroup ag left join advertposition ap on ag.positionid=ap.id LIMIT $offset,$count") or die(db_error());
        //return $result;
    }

    public function selectAll(){
        return $this->db->executeQuery('select * from advertgroup');
    }

    public function insert($name,$width,$height,$stretch,$delay,$effect,$position,$actived){
        $sql="insert into advertgroup(name,width,height,stretch,delay,effect,positionid,actived) values('$name','$width','$height','$stretch','$delay','$effect','$position','$actived');";
        return $this->db->executeQuery($sql);
    }

    public function update($id,$name,$width,$height,$stretch,$delay,$effect,$position,$actived){
        $sql="update advertgroup set name='$name',width='$width',height='$height',stretch='$stretch',delay='$delay',effect='$effect',positionid='$position',actived='$actived' where id=$id";
        return $this->db->executeQuery($sql);
    }

    public function delete($id){
        $sql="delete from advertgroup where id=$id";
        return $this->db->executeQuery($sql);
    }

}
?>
