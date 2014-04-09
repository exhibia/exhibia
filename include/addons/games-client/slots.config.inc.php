<?php

$fruits = array();
$payouts = array();
if(empty($admin_s)){
$slot_details = 'distinct(name)';
}else{
$slot_details = 'distinct(name)';
}
$sql_f = db_query("select $slot_details from sitesetting where name like 'games:slots:%'");
    $i = 0;
    while($row_f = db_fetch_array($sql_f)){
	$fruit_s = explode(":", $row_f['name']);
	$fruits[$i] = $fruit_s[2];
	
	   $sql_pay = db_query("select value from sitesetting where name = 'games:slots:" . $fruit_s[2] . "' order by value asc");
	    
	    while($row_pay = db_fetch_array($sql_pay)){
		$payout_value = explode(":", $row_pay['value']);
		$payouts[$fruit_s[2]][$payout_value[0]] = $payout_value[1];
	    
	   }
    $i++;
    }
    if(empty($admin)){
      echo json_encode($payouts);
    }
