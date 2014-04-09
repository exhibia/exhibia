<?php

    require_once $BASE_DIR . '/common/dbmysql.php';

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of registration
 *
 * 
 */
class Registration {
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

    public function getAllUser() {
        $sql="select * from registration";
        $result=$this->db->executeQuery($sql);
        $arr=array();
        while($user = db_fetch_object($result)) {
            array_push($arr, $user);
        }
        db_free_result($result);
        return $arr;
    }

    public function selectById($id){
        $sql="select * from registration where id=$id";
        $result=$this->db->executeQuery($sql);
        return $result;
    }

    public function setUserAvatar($userid,$avatarid){
        $sql="update registration set avatarid='$avatarid' where id='$userid'";
        return $this->db->executeQuery($sql);
    }

    public function updateBids($id,$finalbids=null,$freebids=null){
        if($finalbids!=null || $freebids!=null){
            $sql="update registration set ";// .;
            if($finalbids!=null){
                $sql=$sql."final_bids='$finalbids'";
                if($freebids!=null){
                    $sql=$sql.",";
                }

            }
            if($freebids!=null){
                $sql=$sql."free_bids='$freebids'";
            }

            $sql=$sql." where id='$id'";
            
             if(!empty($_GET['debug'])){
		  echo $sql;
		}
            $this->db->executeQuery($sql);
            echo db_error();
           
        }
    }

}
?>
