<?php

if (file_exists('common/dbmysql.php')) {
    require_once 'common/dbmysql.php';
} else {
    require_once '../common/dbmysql.php';
}
/* * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auction
 *
 *
 */
class Avatar {

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
        $qryauc = "select * from avatar where id=$id";

        return $this->db->executeQuery($qryauc);
    }

    public function selectAll(){
        return $this->db->executeQuery('select * from avatar');
    }


}
?>
