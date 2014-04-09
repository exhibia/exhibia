<?php

    require_once $BASE_DIR . '/common/dbmysql.php';

/**
 * Description of UserProduct
 *
 * 
 */
class UserProduct {
    private $db;
    //put your code here
    public function  __construct($db) {
        if($db==null) {
            $this->db =new DBMysql();
        }else {
            $this->db=$db;
        }
    }

    public function insert($productid,$userid,$price) {
	if(is_array($price)){
	    $sql="insert into user_product(productid,userid,price,status,buydate) values($productid,$userid,$price[total],1,NOW());";
        }else{
	    $sql="insert into user_product(productid,userid,price,status,buydate) values($productid,$userid,$price,1,NOW());";
        }
        return $this->db->executeQuery($sql);
    }

    public function select($offset,$count,$status) {
        if($status!=-1) {
            $sql="select up.id as upid,p.name,up.price,up.buydate,up.status,userid,up.productid,reg.username,ss.id as ssid
            from user_product up left join registration reg on up.userid=reg.id left join products p on p.productID=up.productid left join shippingstatus ss on ss.orderid=up.id and ss.ordertype=2 where status=$status order by up.buydate desc LIMIT $offset,$count;";
        }else {
            $sql="select up.id as upid,p.name,up.price,up.buydate,up.status,userid,up.productid,reg.username,ss.id as ssid from user_product up left join registration reg on up.userid=reg.id left join products p on p.productID=up.productid left join shippingstatus ss on ss.orderid=up.id and ss.ordertype=2 order by up.buydate desc LIMIT $offset,$count;";
        }
       
        return $this->db->executeQuery($sql);
    }

    public function count($status) {
        if($status!=-1) {
            $sql="select count(*) from user_product where status=$status";
        }else {
            $sql="select count(*) from user_product";
        }
        $query=$this->db->executeQuery($sql);
        $row=db_fetch_row($query);
        return $row[0];
    }

    public function selectByUser($userid,$offset,$count,$status) {
        if($status!=1) {
            $sql="select up.id as id,p.name,up.price,up.buydate,up.status,userid,up.productid,reg.username,ss.id as ssid,tracknumber,st.url as sturl,st.logoimage as stlogoimage, p.picture1, p.short_desc from user_product up left join registration reg on up.userid=reg.id left join products p on p.productID=up.productid left join shippingstatus ss on ss.orderid=up.id and ss.ordertype=2 left join shipping s on s.id=ss.shippingtypeid left join shippingtype st on st.id=s.shippingtypeid where userid=$userid and ss.status=$status order by up.buydate desc LIMIT $offset,$count;";
        }else {
            $sql="select up.id as id,p.name,up.price,up.buydate,up.status,userid,up.productid,reg.username,ss.id as ssid,tracknumber ,st.url as sturl,st.logoimage as stlogoimage, p.picture1, p.short_desc from user_product up left join registration reg on up.userid=reg.id left join products p on p.productID=up.productid left join shippingstatus ss on ss.orderid=up.id and ss.ordertype=2 left join shipping s on s.id=ss.shippingtypeid join shippingtype st on st.id=s.shippingtypeid where userid=$userid order by up.buydate desc LIMIT $offset,$count;";
        }
     
        return $this->db->executeQuery($sql);
    }

    public function countByUser($userid,$status) {
        if($status!=-1) {
            $sql="select count(*) from user_product where status=$status and userid=$userid";
        }else {
            $sql="select count(*) from user_product where userid=$userid";
        }
        $query=$this->db->executeQuery($sql);
        $row=db_fetch_row($query);
        return $row[0];
    }


    public function setStatus($id,$status){
        $sql="update user_product set status=$status where id=$id;";
        return $this->db->executeQuery($sql);
    }
}
?>
