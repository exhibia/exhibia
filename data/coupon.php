<?php
   if(file_exists("config/connect.php")){
      include("config/connect.php");
   }else if(file_exists("../config/connect.php")){
      include("../config/connect.php");
   
   }else if(file_exists("../../config/connect.php")){
      include("../../config/connect.php");
   
   }
   require_once $BASE_DIR . '/common/dbmysql.php';
   require_once $BASE_DIR . '/common/guid.class.php';
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Coupon
 *
 * 
 */
class Coupon {
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
        if(isset($this->db)&&$this->db!=null) {
            //db_close($this->db);
        }
    }

    /**
     *
     * @param <type> $title
     * @param <type> $discount
     * @param <type> $freebids
     * @param <type> $isuniversal
     * @param <type> $startdate
     * @param <type> $enddate
     * @param <type> $db
     */
    public function insert($title,$discount,$freebids,$isuniversal,$startdate,$enddate) {
        $universal=$isuniversal==true?1:0;
        $createDate=date('Y-m-d');
        $code='';
        if($isuniversal==true) {
            $guid = new Guid();
            $code=$guid->toString();
        }

        $sql="insert into coupon(title,discount,freebids,assigned,isuniversal,createdate,startdate,enddate,couponcode) values('{$title}','{$discount}','{$freebids}',0,'{$universal}','{$createDate}','{$startdate}','{$enddate}','{$code}');";
        return $this->db->executeQuery($sql);
    }

    /**
     *
     * @param <type> $title
     * @param <type> $discount
     * @param <type> $freebids
     * @param <type> $isuniversal
     * @param <type> $startdate
     * @param <type> $enddate
     * @param <type> $db
     */
    public function update($id,$title,$discount,$freebids,$startdate,$enddate) {
        $universal=$isuniversal=true?1:0;
        $sql="update coupon set title='{$title}',discount='{$discount}',freebids='{$freebids}',startdate='{$startdate}',enddate='{$enddate}' where id={$id}";
        return $this->db->executeQuery($sql);
    }

    public function updateAssign($id,$assign) {
        $sql="update coupon set assigned='$assign' where id=$id;";
        return $this->db->executeQuery($sql);
    }


    public function countUniversal($startStr,$status) {
        $sql="select count(*) from coupon where title like '$startStr%' and isuniversal=1";
        if($status=='1') {
            $sql="select count(*) from coupon where title like '$startStr%' and enddate>=CURDATE() and isuniversal=1";
        }else if($status=='2') {
            $sql="select count(*) from coupon where title like '$startStr%' and enddate<CURDATE() and isuniversal=1";
        }
        $query=$this->db->executeQuery($sql);
        $row=db_fetch_row($query);
        return $row[0];
    }

    public function selectUniversal($startStr,$offset,$count,$status) {
        $sql="select * from coupon where title like '$startStr%' and isuniversal=1 order by createdate desc LIMIT $offset,$count";
        if($status=='1') {
            $sql="select * from coupon where title like '$startStr%' and enddate>=CURDATE() and isuniversal=1 order by createdate desc LIMIT $offset,$count";
        }else if($status=='2') {
            $sql="select * from coupon where title like '$startStr%' and enddate<CURDATE() and isuniversal=1 order by createdate desc LIMIT $offset,$count";
        }
        return $this->db->executeQuery($sql);
    }

    public function selectAssignedUniversal() {
        $sql="select * from coupon where isuniversal=1 and assigned=1";
        return $this->db->executeQuery($sql);
    }

    /**
     *
     * @param <type> $title
     */
    public function selectByTitle($title) {
        $title=strtolower(trim($title));
        $sql="select * from coupon where lower(title) like '$title'";

        return $this->db->executeQuery($sql);
    }

    public function selectAll($isuniversal){
        $sql="select * from coupon where isuniversal=$isuniversal order by createdate;";
        return $this->db->executeQuery($sql);
    }

    public function count($startStr,$status) {
        $sql="select count(*) from coupon where title like '$startStr%'";
        if($status=='1') {
            $sql="select count(*) from coupon where title like '$startStr%' and enddate>=CURDATE()";
        }else if($status=='2') {
            $sql="select count(*) from coupon where title like '$startStr%' and enddate<CURDATE()";
        }
        $query=$this->db->executeQuery($sql);
        $row=db_fetch_row($query);
        return $row[0];
    }

    /**
     *
     */
    public function select($startStr,$offset,$count,$status) {
        $sql="select * from coupon where title like '$startStr%' order by createdate desc LIMIT $offset,$count";
        if($status=='1') {
            $sql="select * from coupon where title like '$startStr%' and enddate>=CURDATE() order by createdate desc LIMIT $offset,$count";
        }else if($status=='2') {
            $sql="select * from coupon where title like '$startStr%' and enddate<CURDATE() order by createdate desc LIMIT $offset,$count";
        }
        return $this->db->executeQuery($sql);
    }

    /**
     *
     * @param <type> $id
     */
    public function selectById($id) {
        $sql="select * from coupon where id={$id}";
        return $this->db->executeQuery($sql);
    }

    /**
     *
     * @param <type> $id
     * @param <type> $db
     */
    public function delete($id) {
        $this->db->begin();
        $sql="delete from coupon where id='{$id}'";
        $this->db->executeQuery($sql);
        $this->db->executeQuery("delete from user_coupon where couponid={$id}");
        $this->db->executeQuery("delete from user_coupon_history where couponid={$id}");
        $this->db->commit();
    }
}
?>
