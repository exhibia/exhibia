<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(file_exists('common/dbmysql.php')) {
    require_once 'common/dbmysql.php';
}else {
    require_once '../common/dbmysql.php';
}
/**
 * Description of paymentorder
 *
 * @author fedora
 */
class PaymentOrder {
    private $db;
    //put your code here
    public function  __construct($db) {
        if($db==null) {
            $this->db =new DBMysql();
        }else {
            $this->db=$db;
        }
    }
    public function select($offset, $count, $status = 'paid', $filter_array = '') {
      $extra = '';
	if(is_array($filter_array)){
	foreach($filter_array as $key => $value){
	    if($key != 'pgno' & $key != 'submit' & !empty($filter_array[$key]) & !preg_match('/filter_with/', $key) & $key != 'limit' & $key != 'sort' & $key != 'order' & $key != 'order_by'){
	    
	    switch($filter_array[$key . '_filter_with']){
	    case 'equals':
	    $filter = "=";
	    break;
	    case 'doesntequal':
	    $filter = "!=";
	    break;
	    case 'like':
	    $filter = "like";
	    break;
	    case 'gt':
	    $filter = '>';
	    break;
	    case 'lt':
	    $filter = '<';
	    break;
	    case 'ltequal':
	    $filter = '<=';
	    break;
	    case 'gtequal':
	    $filter = '>=';
	    break;
	    }
	        $extra .= " and " . str_replace("_", ".", $key) . " $filter '" . addslashes($value);
		if($filter == 'like') { $extra .= "%"; }
		$extra .= "'";
	    }
	}
	}else{
	
	 $filter_array['order'] = 'desc';
	 
	}

	  if(empty($filter_array['order_by'])){
	  $order_by = 'oid';
	  }else{
	  $order_by = str_replace("_", ".", $filter_array['order_by']);
	    
	  }
	  if($status == 'paid'){
	    $sql = "select distinct o.orderid, o.itemid, r.username as username, o.userid, o.id as oid,o.auction_id,amount,itemname,itemdescription,payfor,paymentway,o.datetime as datetime,p.productID as pid, a.auctionID as aid, c.categoryID as cid, c.name as catname, r.id as uid, r.email as uemail, tr.country, tr.state, tr.tax, tr.st_tax, r.delivery_addressline1, r.delivery_addressline2, r.delivery_city, r.delivery_state, r.delivery_country, r.delivery_postcode,r.phone from payment_order_history o join registration r on r.id=o.userid left join auction a on a.auctionID = o.auction_id left join products p on p.productID = a.productID left join categories c on c.categoryID=p.categoryID left join tax_records tr on tr.invoiceid=o.orderid where o.id != '' $extra order by $order_by $filter_array[order]";
	    if(!empty($offset) & !empty($count)){
		$sql .= " limit $offset,$count";
	    }
	  }else{
	  
	      $sql = "select distinct o.orderid, o.itemid,r.username as username, o.userid, o.itemid, o.id as oid,o.auction_id,amount,itemname,itemdescription,payfor,paymentway,o.datetime as datetime,p.productID as pid, a.auctionID as aid, c.categoryID as cid, c.name as catname, r.id as uid, r.email as uemail, tr.country, tr.state, tr.tax, tr.st_tax, r.delivery_addressline1, r.delivery_addressline2, r.delivery_city, r.delivery_state, r.delivery_country, r.delivery_postcode,r.phone  from payment_order o join registration r on r.id=o.userid left join auction a on a.auctionID = o.auction_id left join products p on p.productID = a.productID left join categories c on c.categoryID=p.categoryID left join tax_records tr on tr.invoiceid=o.orderid where o.id != '' $extra order by $order_by $filter_array[order]";
	    if(!empty($offset) & !empty($count)){
		$sql .= " limit $offset,$count";
	    }
	  
	  }
        return $this->db->executeQuery($sql);
    }

    public function count($table = 'payment_order_history', $filter_array = '') {
	$extra = '';
	if(is_array($filter_array)){
	foreach($filter_array as $key => $value){
	  if($key != 'pgno' & $key != 'submit' & !empty($filter_array[$key]) & !preg_match('/filter_with/', $key) & $key != 'limit' & $key != 'sort' & $key != 'order' & $key != 'order_by'){
	  switch($filter_array[$key . '_filter_with']){
	    case 'equals':
	    $filter = "=";
	    break;
	    case 'doesntequal':
	    $filter = "!=";
	    break;
	    case 'like':
	    $filter = "like";
	    break;
	    case 'gt':
	    $filter = '>';
	    break;
	    case 'lt':
	    $filter = '<';
	    break;
	    case 'ltequal':
	    $filter = '<=';
	    break;
	    case 'gtequal':
	    $filter = '>=';
	    break;
	    }
	        $extra .= " and " . str_replace("_", ".", $key) . " $filter '" . addslashes($value);
		if($filter == 'like') { $extra .= "%"; }
		$extra .= "'";
	    }
	}
	}
        $sql = "select count(*) from $table where id != '' $extra";
        $query = $this->db->executeQuery($sql);
        $row = db_fetch_row($query);
        return $row[0];
    }

    public function delete($orderid, $table = 'payment_order_history'){
        $sql="delete from $table where orderid='$orderid'";
        $this->db->executeQuery($sql);
    }
}
?>
