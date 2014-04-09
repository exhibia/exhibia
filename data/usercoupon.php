<?php

    include_once $BASE_DIR . '/common/guid.class.php';

    include_once $BASE_DIR . '/common/guid.class.php';

    require_once $BASE_DIR . '/common/dbmysql.php';


include_once $BASE_DIR . '/data/coupon.php';
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of usercoupon
 *
 * 
 */
class UserCoupon {
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
        if($this->db!=null) {
            //db_close($this->db);
        }
    }

    /**
     *
     * @param <type> $userid
     * @param <type> $couponid
     * @param <type> $uniqueid
     * @param <type> $db the $db will be not null, when want a transaction
     */
    public function insert($userid,$couponid,$uniqueid) {
        $addigndate=date('Y-m-d');
        $sql="insert into user_coupon(regid,couponid,assigndate,uniqueid) values('{$userid}','{$couponid}',CURDATE(),'{$uniqueid}');";
        return $this->db->executeQuery($sql);
    }


    public function assign($users,$couponid,$isuniversal,$couponcode) {
        $this->db->begin();
        $guid = new Guid();
        $uniqueid=$couponcode;

        foreach($users as $user) {
            if($isuniversal==FALSE) {
                $guid->getGuid();
                $uniqueid=$guid->toString();
            }
            $this->insert($user->id, $couponid, $uniqueid);
        }
        $coupondb=new Coupon($this->db);
        $coupondb->updateAssign($couponid,1);
        if($this->db->affectedRows()>0) {
            $this->db->commit();
            return true;
        }else {
            $this->db->rollback();
            return false;
        }
    }

    public function assignSingle($userid,$couponid) {
        $guid = new Guid();
        $uniqueid=$guid->toString();
        return $this->insert($userid, $couponid, $uniqueid);
    }

    public function unAssign($couponid) {
        $this->db->begin();
        $this->db->executeQuery("delete from user_coupon where couponid={$couponid}");
        $coupondb=new Coupon($this->db);
        $coupondb->updateAssign($couponid,0);
        $this->db->commit();
    }

    /**
     *
     * @param <type> $id
     * @param <type> $db the $db will be not null, when want a transaction
     */
    public function delete($id) {
        return $this->db->executeQuery("delete from user_coupon where id='$id'");
    }

    public function count($userid) {
        $this->clearOverdue($userid);
        $sql="select count(*) from user_coupon where regid='$userid' ;";
       
        $query = $this->db->executeQuery($sql);
        $row=db_fetch_row($query);
        return $row[0];
    }

    public function selectById($id) {
        return $this->db->executeQuery("select * from user_coupon where id='$id'");
    }

    public function selectByUser($userId,$offset,$count) {
        $this->clearOverdue($userId);
        $sql="select user_coupon.id as id, assigndate,isuniversal,uniqueid,title,discount,freebids,startdate,enddate from user_coupon left join coupon
            on user_coupon.couponid=coupon.id where user_coupon.regid='$userId' order by enddate desc LIMIT $offset,$count;";
        //echo $sql;
        return $this->db->executeQuery($sql);
    }

    private function clearOverdue($userId) {
        $assigndate=date('Y-m-d');
        $this->db->executeQuery("delete from user_coupon left join coupon on user_coupon.couponid=coupon.id where coupon.enddate < '$assigndate' and user_coupon.regid='$userId';");
    }

    public function selectByUniqueId($userId,$uniqueId) {
        $this->clearOverdue($userId);
        
        if(db_num_rows(db_query("select * from coupon where (coupon.couponcode = '$uniqueId' or coupon.title = '$uniqueId') and is_promo >= 1")) > 0){
        
	$sql = "select * from coupon where (coupon.couponcode = '$uniqueId' or coupon.title = '$uniqueId') and is_promo >= 1";
        
        }else{
        $sql="select user_coupon.id as id,coupon.id as couponid, assigndate,uniqueid,title,discount,freebids,startdate,enddate,operand, combinable,max_per_user, max_overall from user_coupon left join coupon
            on user_coupon.couponid=coupon.id where user_coupon.regid='$userId' and (user_coupon.uniqueid like '$uniqueId' or coupon.title = '$uniqueId')";
	}
        return $this->db->executeQuery($sql);
    }
    
      public function selectByUniqueIdMultiple($userId,$uniqueId,$existing_ids) {
          $this->clearOverdue($userId);
          
	  $existing_ids = explode(",", $existing_ids);
    
	  $ids = '';
	
	    foreach($existing_ids as $key => $value){
	    if(!empty($value) & !preg_match("/$value/", $ids)){
	      $ids .= "'" . $value . "',";
	      }
	      
	      }
	      $ids = rtrim($ids, ",");
	/*$sql1="select distinct(user_coupon.id) as id,coupon.id as couponid, assigndate,uniqueid,title,discount,freebids,startdate,enddate,operand, combinable,max_per_user, max_overall from user_coupon left join coupon on user_coupon.couponid=coupon.id where user_coupon.regid='$userId' and (user_coupon.uniqueid like '$uniqueId' or coupon.title = '$uniqueId') and (combinable != 'true' or combinable != 'yes') and user_coupon.uniqueid in ($ids) limit 1";
	
	if(db_num_rows(db_query($sql1)) == 0){*/
	
	
	if(db_num_rows(db_query("select * from coupon where (coupon.uniqueid like '$uniqueId' or coupon.title = '$uniqueId') and is_promo >= 1")) > 0){
        
	  $sql = "select * from coupon where (coupon.uniqueid like '$uniqueId' or coupon.title = '$uniqueId') and is_promo >= 1";
        }else{

	  $sql="select user_coupon.id as id,coupon.id as couponid, assigndate,uniqueid,title,discount,freebids,startdate,enddate,operand, combinable,max_per_user, max_overall from user_coupon left join coupon on user_coupon.couponid=coupon.id where user_coupon.regid='$userId' and (user_coupon.uniqueid like '$uniqueId' or coupon.title = '$uniqueId') and user_coupon.uniqueid "; 
	 }
	      if(!empty($ids)){
	      
	      $sql .= " not in ($ids) ";
	      }
	      
	      $ids = "limit 1";
	//}
	
        return $this->db->executeQuery($sql);
    }

}
?>
