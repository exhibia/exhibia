
                        <?php if ($obj['allowbuynow'] == true) {
 ?>

                                           <div class="product-box buynowbackground">
						<div class="product-content buynowbox">
						<table align="right">
						  <tr>
						    <td valign="top" height="100%">
                                                              
                                                               
                                                               <ul style="<?php if ($uid != 0 & in_array('award_points', $addons)){?>position:relative;top:10px;left:0px;<?php } ?>">
                                                                <h4><?php echo BUY_THIS_PRODUCT_NOW; ?></h4>
                                                                   <li><span><?php echo WORTH_UP_TO; ?>:</span> <em  style="float:right;margin-right:20px;" class="buynowprice"><?= $Currency . $price; ?></em></li>

                                                                   <li><span><?php echo SAVINGS; ?>:</span><em  style="float:right;margin-right:20px;"><?= $Currency; ?><em id="placebidsamount" class="innerspan"><?= number_format(($obj['price'] - $fprice), 2); ?></em></em></li>
                                                                   <li style="border-top:1px solid gray;padding-top:10px;"><span><?php echo YOUR_PRICE; ?>:</span><em class="buynowprice" id="newbuynowprice"  style="float:right;margin-right:20px;"><?= $Currency . number_format($buynowprice, 2); ?></em></li>

                                                               
                                                
                                                              <li> <div><small><?php echo ALL_PRICES_ARE_IN_US_DOLLARS; ?></small></div></li>
                                                              
                                                             </ul>
                                                       </td>
                                                     
                                                          
                                                              
<?php if ($uid != 0) {
                                       
  if(in_array('award_points', $addons)){
  $addon = 'award_points';
$valid_rows = "select * from nav_conditionals where menu_name = 'addons' and link_name = '$addon'";
			$sql_check =db_fetch_array($valid_rows);
			
	      if(db_num_rows(db_query($valid_rows)) == 0){

		    include("include/addons/$addon/index.php");
		}else{
		
		
		if(check_addons_conditionals($sql_check, $addon) >= 1){
		
		
		
		  include("include/addons/$addon/index.php");

	      }
	  }
	  
	  
if(in_array('design_suite', $addons) & $admin >= 1){
		
		    include("include/addons/design_suite/ADDONS/edit_addons.php");
		
		}


}
                                        
						
 ?>
		
			</tr>
		      </table>
          
 <?php
   }else{
   
   
   
    ?>
							
			  </tr>
		      </table>
		      
		      
                                    <?php } 
                                    ?>

                                               </div><!-- /product-content -->                                   
                                           </div><!-- /product-box -->
                                           
                                           

<?php }


?> 
