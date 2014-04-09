<?php
            @db_query("alter table payment_order add column auction_id int(11) not null");
            @db_query("alter table payment_order_history add column auction_id int(11) not null");
$credit_back = $row->credit_back;
if($credit_back == 1){
$credit_back =  'Yes';
}else{
$credit_back = 'No';
}
$free_points = $row->free_points;
$bid_points = $row->bid_points;
?>

<tr>

    <td  colspan="7" width="100%" style="border:1px dashed gray; border-radius:5px;">
	<ul style="list-style:none;display:inline;">
	  <li style="display:inline;margin-right:50px;"><b>Bid Points:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $bid_points;?></li>
	  <li style="display:inline;margin-right:50px;"><b>Free Points:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $free_points;?></li>
	  <li style="display:inline;"><b>Credit Back Spent Bids:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $credit_back;?></li>
	</ul>
    </td>
</tr>
  
