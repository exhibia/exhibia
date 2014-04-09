<?php
            @db_query("alter table payment_order add column auction_id int(11) not null");
            @db_query("alter table payment_order_history add column auction_id int(11) not null");
            
@db_query("alter table products add column free_points varchar(20) null");
@db_query("alter table products add column bid_points varchar(20) null");
@db_query("alter table products add column credit_back varchar(20) null");

$credit_back = $row->credit_back;
$free_points = $row->free_points;
$bid_points = $row->bid_points;

?>
    <!--[if !IE]>start row<![endif]-->
                                        
                                                                <div class="row" style="border:1px dashed gray;border-radius:8px;">
                                                              
								  <table>
								  <tr>
								  <td colspan="3">
								      <h2>Award Points</h2>
								  </td>
								  </tr>
								      <tr>
									  <td>
									     
									 <b>Free Points:</b>
									     
										      <input type="text" value="<?php echo $free_points;?>" name="free_points" id="free_points" />
									
									  
									  </td><td>
									   <td>
									     
									  <b>Bid Points:</b>
									     
										      <input type="text" value="<?php echo $bid_points;?>" name="bid_points" id="bid_points" />
									
									  
									  </td><td>
									  
									      <b>Full Buy Now?:(spent points awarded back)</b>
									     
										      <select name="credit_back" id="credit_back">
											  
											  <option value="1" <?php if(!empty($credit_back)) { echo ' selected'; } ?>>Yes</option>
											  <option value="" <?php if(empty($credit_back)){ echo ' selected'; } ?>>No</option>
										      </select>
										
									  </td>
								      </tr>
								      
								   </table>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
