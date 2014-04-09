<?php
ini_set('display_errors', 1);

include("connect.php");
include("functions.php");

if ($_REQUEST["prid"] != "") {


    $prid = chkInput($_REQUEST["prid"], 'i');
    
        $sql = "select bidpack_price,bidpack_banner,bidpack_banner2,bidpack_banner3,bidpack_banner4 from bidpack where id='$prid'";
        $res = db_query($sql) or die(db_error());
        if (db_num_rows($res) >= 1 & $_REQUEST['isbidpack'] == 'true') {
            $obj = db_fetch_array($res);

            $data->price = $obj['bidpack_price'] . "||";
            $data->picture1 = $obj['bidpack_banner'];
            $data->picture2 = $obj['bidpack_banner2'];
            $data->picture3 = $obj['bidpack_banner3'];
            $data->picture4 = $obj['bidpack_banner4'];
	    $data->product_list = array();
            echo json_encode($data);
        }
     else {
        $qrysel = "select * from products where productID='$prid'";

        $res = db_query($qrysel);

        $totalrow = db_affected_rows();
        $row = db_fetch_object($res);
        $data->price = $row->price . "|" . $row->product_qty . "|" . $row->qty_flag;
        $data->picture1 = $row->picture1;
        $data->picture2 = $row->picture2;
        $data->picture3 = $row->picture3;
        $data->picture4 = $row->picture4;
	if($row->default_tx1 == '' | $row->default_tx1 == 'NULL' | $row->default_tx1 == 'null'){
	$row->default_tx1 = '0';
	}
	$data->tax1 = $row->default_tx1;
	if($row->default_tx2 == '' | $row->default_tx2 == 'NULL' | $row->default_tx2 == 'null'){
	$row->default_tx2 = '0';
	}
	if($row->default_reserve == '' | $row->default_reserve == 'NULL' | $row->default_reserve == 'null'){
	$row->reserve = '0.00';
	}else{
	$row->reserve = $row->default_reserve;
	}
	    $data->tax2 = $row->default_tx2;
	    $data->reserve = $row->reserve;
	    
	      $data->shippingmethod = $row->default_shippingmethod;
		$qryshipping = db_fetch_object(db_query("select * from shipping where id = '" . $row->shippingmethod . "' limit 1"));
		
		  $data->shippingvalue = $qryshipping->shipping_title;
		  $data->product_list = array();
		  
		  
		  $qry_pr = db_query("select productID, name, picture1, price from products where price >= " . number_format($data->price - 5.00, 2) ." and price <= " . number_format($data->price + 5.00, 2));
		  
		  while($row_pr = db_fetch_array($qry_pr)){
		  
		      $data->product_list[] = array('productID' => $row_pr['productID'], 'name' => $row_pr['name'], 'picture' => $row_pr['picture1'], 'price' => $row_pr['price']);  
		  
		  }
		  
        echo json_encode($data);
    }
}


?>