<?php
if(file_exists('common/dbmysql.php')) {
    require_once 'common/dbmysql.php';
}else {
    require_once '../common/dbmysql.php';
}

/**
 * Description of product
 *
 * 
 */
class Product {
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
        $sql="select * from products where productID=$id;";
        return $this->db->executeQuery($sql);
    }
}
?>
