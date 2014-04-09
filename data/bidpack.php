<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

    require_once $BASE_DIR . '/common/dbmysql.php';

/**
 * Description of bidpack
 *
 * 
 */
class Bidpack {
    //put your code here
    private $db;
    //put your code here
    public function  __construct($db) {
        if($db==null) {
            $this->db =new DBMysql();
        }else {
            $this->db=$db;
        }
    }

    public function selectById($id){
        $sql="select * from bidpack where id='$id'";
        return $this->db->executeQuery($sql);
    }
}
?>
