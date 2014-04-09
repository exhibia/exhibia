<?php




$active="Database";
include("connect.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");


@db_query("alter table autolister add column auction_id varchar(20) null");
db_query("CREATE TABLE IF NOT EXISTS `autolister_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting` varchar(20) not null,
  `value` varchar(20) not null,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;");

@db_query("alter table auction add column autolister tinyint(1) null default '0'");

db_query("CREATE TABLE IF NOT EXISTS `autolister` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) null,
  `timestamp` text not null,
  `productID` int(11) not null,

  `aucstartprice` text null,
  `tax1` text null,
  `tax2` text null,
  `shippingmethod` text null,
  `buynowprice` text null,
  
  
  `start_every` int(11) null,
  `run_for` int(11) null,
  `recur_force` text null,
  `recuurences` int(11) null,
  `allow_buy_now` tinyint(1) null,

  
  
  `nailbiterauction` tinyint(1) null,
  `offauction` tinyint(1) null,
  `uniqueauction` tinyint(1) null,
  `openauction` tinyint(1) null,
  `pa` tinyint(1) null,
  `fixedpriceauction` tinyint(1) null,
  `reverseauction` tinyint(1) null,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;");
@db_query("alter table autolister add column cashauction tinyint(1) null");
@db_query("alter table autolister add column halfback tinyint(1) null");

@db_query("alter table autolister add column stagger tinyint(1) null default '0'");
@db_query("alter table autolister add column start_now varchar(20) null");






@db_query("alter table autolister modify colum stagger varchar(20) null");



    if($perpage['manageProductPage']) {
	$PRODUCTSPERPAGE = 10;
    }
    else {
	if(trim($PRODUCTSPERPAGE)=="") {
	    $PRODUCTSPERPAGE=10;
	}
    }

if(!empty($_REQUEST['oldtimestamp'])){


	  if(ctype_alnum($_REQUEST['newtimestamp'])) { 
	  db_query("update autolister set timestamp = '$_REQUEST[newtimestamp]' where timestamp = '" . $_REQUEST['oldtimestamp'] . "'");

		echo "<b>You updated the name for this auto lister</b>|" . $_REQUEST['newtimestamp'];
	    ?>

	    <?php

	  }else{


	      echo "<b>Auto Lister Names Must Be Alpha-Numeric</b>|" . $_REQUEST['oldtimestamp'];
	    ?>
		  
	      
	    <?php
	  }
	  
	  
	  
}else{


      if(!empty($_REQUEST['delete_list']) | !empty($_GET['auto_id'])){

	      if(!empty($_REQUEST['confirm'])){


		  $timestamp = $_GET['delete_list'];


		    if(!empty($_GET['delete_list']) | !empty($_GET['auto_id'])){


			  if(!empty($_GET['auto_id'])){


			      db_query("delete from autolister where id = '$_GET[auto_id]' limit 1");

			  }else{
				if(!empty($_GET['delete_list'])){
				  db_query("delete from autolister where timestamp = '$_GET[delete_list]'");
				  }

			  }



		if(!empty($_GET['list_id']) | !empty($_GET['auction_id'])){

		    ?>
			  <script>
			  
			  load_auction_list_default_view(0, 25);
			  
			  </script>
			<?php  

		      }else{
		      
			?>
			  <script>
			    $('#list[' + <?php echo $timestamp;?> + ']').remove();
			  </script>
		    <?php  

		  }


	    }


}else{
	  if(!empty($_GET['list_id']) | !empty($_GET['auto_id'])){


	      echo "<div id=\"box[" . $_REQUEST['auto_id'] ."]\"> Please Confirm that you want to delete this listing? <a href=\"javascript: delete_confirm('". $_REQUEST['delete_list'] . "', '" . $_GET['auto_id'] . "'); \">Yes</a>&nbsp;&nbsp;";

	      echo "<a href=\"javascript: load_auction_list('$timestamp'); \">Cancel</a>&nbsp;&nbsp;</div>";
	      

	  }else{
	      echo "<div id=\"box[" . $_REQUEST['delete_list'] ."]\"> Please Confirm you want to delete this list? <a href=\"javascript: delete_confirm('". $_REQUEST['delete_list'] . "'); \">Yes</a>&nbsp;&nbsp;";

	      echo "<a href=\"javascript: load_auction_lists(); \">Cancel</a>&nbsp;&nbsp;</div>";
	      
	  }
}

		    }else{
			if(!empty($_GET['list']) | !empty($_GET['default_view'])){


			      if(!empty($_REQUEST['timestamp']) | !empty($_GET['default_view'])){
 
			      if(!empty($_GET['default_view'])){
	
				    $query = "select * from autolister, products where autolister.auction_id = 'waitting' and autolister.productID = products.productID";
				$order = 'id, sort, timestamp ';
	     
				}else{
	      
				  $query = "select * from autolister, products, auction where timestamp = '" . $_REQUEST['timestamp'] . "' and  products.productID  = autolister.productID and autolister.auction_id = auctionID and auc_status != '2'";
	     
				  $order = 'sort, id, timestamp ';
			}
	      
	      $PageNo=$_GET['pageno'];
		  
		    $total=db_num_rows(db_query($query));
		    echo db_error();
		    $totexprecords = $total;
		    $totalpage=ceil($total/$_GET['limit']);
		   
		    if($totalpage>=1) {
			$startrow=$_GET['limit']*($_GET['pageno']);
			$query.="  order by $order asc LIMIT $startrow," . $_GET['limit'];
		   
			$result=db_query($query);
			
		    }
		    

		while($row = db_fetch_array($result)){
		
		
		
		if(!empty($_GET['default_view'])){
		
		    $sql_check = "select * from auction_running, autolister where autolister.id = '$row[id]' and autolister.auction_id = auctionID";
		
		}else{
		    $sql_check = "select * from auction_running, autolister where autolister.id = '$row[id]' and autolister.auction_id = auctionID";
		}
		
		//if(db_num_rows(db_query($sql_check)) >= 1) { 
		
		?>
							    
		<!--				<li id="message"></li> -->
				    		 <li id="sortable[<?php echo $row['id']; ?>]">
						      <table id="<?php echo $_REQUEST['timestamp'];?>" width="850px;" align="left" class="sortable"  style="position:relative;left:-40px;width:850px;border: 1px solid black;border-radius:3px;margin-bottom:5px;background-color:#cbe2ed;">
							   <tr>
							     <td id="product_name[<?php echo $row[3]; ?>]" class="<?php echo $_REQUEST['timestamp'];?>" align="center" valign="top">
							     <div class="title_wrapper_2">
							     <h3> <?php echo $row['name']; 
							     
							     if(!empty($_GET['default_view'])){
							     ?>
								  <a href="javascript:;" onclick="load_auction_list('<?php echo $row['timestamp'];?>');" style="margin-left:10px;">List:<?php echo $row['timestamp'];?></a>
							     <?php
							     }
							     
								?>
								  <a href="javascript:;" onclick="show_details('<?php echo $row[3]; ?>');" style="font-size:8px;position:relative;left:300px;color:green;">Details</a>
								  
								  <a href="javascript:;" onclick="remove_from_auction_and_list('<?php echo $row[3]; ?>', '<?php echo $row['timestamp'];?>', '<?php echo $row['auction_id'];?>', '<?php echo $row['id'];?>');" style="font-size:8px;position:relative;left:350px;color:red;">Remove</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								  
								  <a href="javascript:;" onclick="toggle('<?php echo $row[3]; ?>');" style="font-size:8px;position:relative;left:400px;color:yellow;">Customize</a>
								  
								  
							     
							    <?php  if(db_num_rows(db_query("select * from auction_running, autolister where autolister.id = '$row[id]' and autolister.auction_id = auctionID and auc_status = '2'")) >= 1) { ?>
							    
							    <font style="color:green;">Running</font>
							    
							    
							    
							    <?php }else{ 
							     if(db_num_rows(db_query("select * from auction_running, autolister where autolister.id = '$row[id]' and autolister.auction_id = auctionID and auc_status = '3'")) >= 1) { ?>
							    
							    <font style="color:yellow;">Sold</font>
							    
							    
							    
							    <?php
							    
							    
							    
								}else{
								if(db_num_rows(db_query("select * from auction_running, autolister where autolister.id = '$row[id]' and autolister.auction_id = auctionID and auc_status = '1'")) >= 1) {
								?>
							    
									
							    
							    <?php
								    }else{
								     ?>
									
								    
								    <?php
								    
									
								    }
							    
								} 
							    
							    }
							    
							    ?>
								</h3>
							   <span class="title_wrapper_left_2"></span>
                                                           <span class="title_wrapper_right_2"></span></div>
							        
							    </td>
							 </tr>
							 <tr>
							   <td valign="top" id="detailed_info" width="100%">
							      
							
							            <table width="850px">
								     <tr>	
							      
								      <td style="width:120px;max-height:75px;" valign="top"><div id="image[<?php echo $row[3]; ?>]" style="width:120px;max-height:75px;display:none;" align="center" valign="top"><img src="../uploads/products/thumbs_small/thumbsmall_<?php echo $row['picture1'];?>" align="center"/></div></td>
							      
							     
								
								      <td style="max-height:75px;width:730px;" align="center" valign="top"><div  id="description[<?php echo $row[3]; ?>]" style="display:none;font-size:9px;"><b><?php echo substr(strip_tags($row['long_desc']), 0, 200);?></b></div></td>
							
								    </tr>
								  </table>
							    
							    
							    </td>
							 </tr>
							 <tr> 
							   <td  id="advanced[<?php echo $row[3]; ?>]" width="850x;" colspan="2" style="display:none;max-height:75px;width:850px;">
								
								
							      <input type="hidden" id="pr_id[<?php echo $row[3]; ?>]" name="pr_id[<?php echo $row[3]; ?>]" value="<?php echo $row[3]; ?>" />
							      
							      
							      <input type="hidden" id="sort[<?php echo $row[3]; ?>]" name="sort[<?php echo $row[3]; ?>]" value="<?php echo $row['sort']; ?>" class="sortable_inputs" />
							  
							  
								
							   <table width="100%">
								
							      <tr>
								<td style="max-height:75px;"> 
								  
								      
								      <table style="font-size:9px;margin-left:20px;max-height:75px;">
			


								      <tr><td width="12%" valign="top"  class="auction_choices">
									
									
									    
									      
									  
									      
									<input <?= $rows->offauction == "1" ? "checked" : "" ?> type="checkbox" name="offauction[<?php echo $row[3]; ?>]" id="offauction[<?php echo $row[3]; ?>]" value="1" class="off"/> 100% off<br />
									<input checked type="checkbox" name="pa[<?php echo $row[3]; ?>]" id="pa[<?php echo $row[3]; ?>]" value="1" class="cent" /> Cent<br />
									<input <?= $rows->halfback == "1" ? "checked" : "" ?> type="checkbox" name="halfback[<?php echo $row[3]; ?>]" id="halfback[<?php echo $row[3]; ?>]" value="1" class="halfback" /> Half Back<br />
									  
									
									    
							                    </td>
								            <td width="12%" valign="top" class="auction_choices">
									
                                                                               <input <?= $rows->nailbiterauction == "1" ? "checked" : "" ?> type="checkbox" name="nailbiterauction[<?php echo $row[3]; ?>]" id="nailbiterauction[<?php echo $row[3]; ?>]" value="1" class="nail" /> NailBiter<br />
                                                                               
										<input <?= $rows->cashauction == "1" ? "checked" : "" ?> type="checkbox" name="cashauction[<?php echo $row[3]; ?>]" id="cashauction[<?php echo $row[3]; ?>]" value="1" class="cashauction" /> No Bid<br /> 



								      


                                                                   
                                                                                <input <?php echo $uniqueauction == 1 ? "checked" : "" ?> type="checkbox" id="uniqueauction[<?php echo $row[3]; ?>]" name="uniqueauction[<?php echo $row[3]; ?>]" value="1" class="unique" /> Lowest<br />
								   
								      
								      
								            <td width="22%" valign="top" align="left">									
								        Start Price
								     
                                                                                <input name="aucstartprice[<?php echo $row[3]; ?>]" type="text" class="start_price" id="aucstartprice[<?php echo $row[3]; ?>]" value="0.00" size="6" maxlength="20" style="font-size:9px;"/>
                                                                    
                                                                           <?= $Currency; ?>
									     <br />
                                                                       
								      
								       Tax 1
                                                                      
                                                                            <input name="tax1[<?php echo $row[3]; ?>]" type="text" style="font-size:9px;" value="<?= $tax1; ?>" size="4" id="tax1[<?php echo $row[3]; ?>]" maxlength="6" class="tax1" />
                                                                     
									  %<br />
                                                                       
									 Tax 2 
                                                                       
                                                                            <input name="tax2[<?php echo $row[3]; ?>]" type="text" style="font-size:9px;" value="<?= $tax2; ?>" size="4" id="tax2[<?php echo $row[3]; ?>]" maxlength="6" class="tax2" />
                                                                      
									  %<br />
                                                                      
									
                                                                       
									 Shipping
                                                                            <select name="shippingmethod[<?php echo $row[3]; ?>]" id="shippingmethod[<?php echo $row[3]; ?>]" style="font-size:9px;" class="shipping_sub">
                                                                      
                                                                                <?php
                                                                                $qryshipping = "select * from shipping";
                                                                                $resshipping = db_query($qryshipping);
                                                                                while ($objshipping = db_fetch_object($resshipping)) {
                                                                                ?>
                                                                                    <option <?= $objshipping->id == $shippingchargeid ? "selected" : ""; ?> value="<?= $objshipping->id; ?>"><?= $objshipping->shipping_title; ?></option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
								       									

							                     </td>
								             <td width="22%" valign="top" align="left">
									
									       Delay At End<br /><select name="start_every[<?php echo $row[3]; ?>]" id="start_every[<?php echo $row[3]; ?>]" style="font-size:9px;max-height:75px;" class="start_every_sub">
										<option value="60" <?php if($row['run_for'] == 60){ echo 'selected'; } ?>>Immediately</option>
										<option value="300" <?php if($row['run_for'] == 300){ echo 'selected'; } ?>>5 Minutes</option>
										<option value="600" <?php if($row['run_for'] == 600){ echo 'selected'; } ?>>10 Minutes</option>
										<option value="900" <?php if($row['run_for'] == 900){ echo 'selected'; } ?>>15 Minutes</option>
										<option value="1200" <?php if($row['run_for'] == 1200){ echo 'selected'; } ?>>20 Minutes</option>
										<option value="1800" <?php if($row['run_for'] == 1800){ echo 'selected'; } ?>>30 Minutes</option>
										<option value="2700" <?php if($row['run_for'] == 2700){ echo 'selected'; } ?>>45 Minutes</option>
										<option value="3600" <?php if($row['run_for'] == 3600){ echo 'selected'; } ?>>1 Hours</option>
										<option value="7200" <?php if($row['run_for'] == 7200){ echo 'selected'; } ?>>2 Hours</option>
										<option value="10800" <?php if($row['run_for'] == 10800){ echo 'selected'; } ?>>3 Hours</option>
										<option value="28800" <?php if($row['run_for'] == 28800){ echo 'selected'; } ?>>8 Hours</option>
										<option value="43200" <?php if($row['run_for'] == 43200){ echo 'selected'; } ?>>12 Hours</option>
										<option value="86400" <?php if($row['run_for'] == 86400){ echo 'selected'; } ?>>24 Hours</option>
										<option value="604800" <?php if($row['run_for'] == 604800){ echo 'selected'; } ?>>1 Week</option>
										
										<option value="1209600" <?php if($row['run_for'] == 1209600){ echo 'selected'; } ?>>2 Weeks</option>
										<option value="4838400" <?php if($row['run_for'] == 4838400){ echo 'selected'; } ?>>1 Month</option>
										</select><br />
									 
									  
									<input type="hidden" id="stagger[<?php echo $row[3]; ?>]" value="<?php echo $row['stagger']; ?>" class="stagger" />
									
								Duration For This Auction<select name="run_for[<?php echo $row[3]; ?>]" id="run_for[<?php echo $row[3]; ?>]" style="font-size:9px;" class="run_for">
										<option value="60" <?php if($row['run_for'] == 60){ echo 'selected'; } ?>>Immediately</option>
										<option value="300" <?php if($row['run_for'] == 300){ echo 'selected'; } ?>>5 Minutes</option>
										<option value="600" <?php if($row['run_for'] == 600){ echo 'selected'; } ?>>10 Minutes</option>
										<option value="900" <?php if($row['run_for'] == 900){ echo 'selected'; } ?>>15 Minutes</option>
										<option value="1200" <?php if($row['run_for'] == 1200){ echo 'selected'; } ?>>20 Minutes</option>
										<option value="1800" <?php if($row['run_for'] == 1800){ echo 'selected'; } ?>>30 Minutes</option>
										<option value="2700" <?php if($row['run_for'] == 2700){ echo 'selected'; } ?>>45 Minutes</option>
										<option value="3600" <?php if($row['run_for'] == 3600){ echo 'selected'; } ?>>1 Hours</option>
										<option value="7200" <?php if($row['run_for'] == 7200){ echo 'selected'; } ?>>2 Hours</option>
										<option value="10800" <?php if($row['run_for'] == 10800){ echo 'selected'; } ?>>3 Hours</option>
										<option value="28800" <?php if($row['run_for'] == 28800){ echo 'selected'; } ?>>8 Hours</option>
										<option value="43200" <?php if($row['run_for'] == 43200){ echo 'selected'; } ?>>12 Hours</option>
										<option value="86400" <?php if($row['run_for'] == 86400){ echo 'selected'; } ?>>24 Hours</option>
										<option value="604800" <?php if($row['run_for'] == 604800){ echo 'selected'; } ?>>1 Week</option>
										
										<option value="1209600" <?php if($row['run_for'] == 1209600){ echo 'selected'; } ?>>2 Weeks</option>
										<option value="4838400" <?php if($row['run_for'] == 4838400){ echo 'selected'; } ?>>1 Month</option>
									
									  <?php if ($reccur == 'true'){ ?>
								       Number of Times';
								       <input type="text" name="recuurences[<?php echo $row[3]; ?>]" id="recuurences[<?php echo $row[3]; ?>]" size="6" maxlength="3" style="font-size:9px;" value="<?php echo $row['recuurences'];?>" /><br />
								       
									 <?php }else{ ?>
									   
									   <input type="hidden" name="recuurences[<?php echo $row[3]; ?>]" id="recuurences[<?php echo $row[3]; ?>]" size="6" maxlength="3" style="font-size:9px;" value="<?php echo $row['recuurences'];?>" />
									   
								       <?php } if ($reccur == 'true'){ ?>
									  Force Duplication
									    <input type="checkbox" name="force_new[<?php echo $row[3]; ?>]" id="force_new[<?php echo $row[3]; ?>]"><br />
									      <?php } ?> 	
										
										
										
							                     </td>
								             <td width="20%" valign="top" align="left">										
										
										
										
								     Buy Now?<input type="checkbox" name="allow_buy_now[<?php echo $row[3]; ?>]" class="buy_now_sub" id="allow_buy_now[<?php echo $row[3]; ?>]" /><br />
								        Buy Now Price
                                                                          <input name="buynowprice[<?php echo $row[3]; ?>]" type="text" class="buy_now_price" value="<?= $buynowprice ?>" size="6" id="buynowprice[<?php echo $row[3]; ?>]"  maxlength="20" style="font-size:9px;" />
								     <?= $Currency; ?><br />
								     
								     
                                                                          Reserve Price: <input name="reserve[<?php echo $row[3]; ?>]" type="text" class="reserve_price" value="<?= $buynowprice ?>" size="6" id="reserve[<?php echo $row[3]; ?>]"  maxlength="20" style="font-size:9px;" />
								     
								       <?= $Currency; ?><br />									
								       
									</td></tr>      </table>


</td></tr>      </table>
								      						      
								      
								      
								  
							      
								</td></tr></table>
								
								<input type="hidden" vlaue="<?php echo $row['start_now'];?>" class="start_now" id="start_now[<?php echo $row[3]; ?>]" />
								
								</li>
								
								


	<?php							
								
    //}
}

						if($total) { ?>
                                                    <!--[if !IE]>start pagination<![endif]-->
                                                    <li >
                                                    <div class="pagination" >
                                                        <span class="page_no">Page <?php echo $PageNo + 1; ?> of <?php echo $totalpage; ?></span>
                                                        <ul class="pag_list">
                                                                <?php
                                                                if($PageNo>1) {
                                                                    $PrevPageNo = $PageNo-1;
                                                                    ?>
                                                            <li  style="position:relative;left:-200px;"><a href="javascript: <?php if(!empty($_GET['default_view'])){ ?>load_auction_list_default_view(<?php echo $PageNo - 1; ?>, <?php echo $_GET['limit'];?>);<?php }else{?>load_auction_list('<?php echo $row['timestamp'];?>', <?php echo $PageNo - 1; ?>, <?php echo $_GET['limit'];?>);<?php }?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                    <?php } ?>

                                                                <?php
                                                                $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                $pageTo=$PageNo+3>$totalpage?$totalpage:$PageNo+3;
                                                                for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                    ?>
                                                                    <?php if($i==$PageNo) { ?>
                                                            <li style="position:relative;left:-100px;"><a href="javascript: <?php if(!empty($_GET['default_view'])){ ?>load_auction_list_default_view(<?php echo $i - 1; ?>, <?php echo $_GET['limit'];?>);<?php }else{?>load_auction_list('<?php echo $row['timestamp'];?>', <?php echo $i - 1; ?>, <?php echo $_GET['limit'];?>);<?php }?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                        <?php }else {?>
                                                            <li style="position:relative;left:-100px;"><a href="javascript: <?php if(!empty($_GET['default_view'])){ ?>load_auction_list_default_view(<?php echo $i - 1; ?>, <?php echo $_GET['limit'];?>);<?php }else{?>load_auction_list('<?php echo $row['timestamp'];?>', <?php echo $i - 1; ?>, <?php echo $_GET['limit'];?>);<?php }?>"><?php echo $i; ?></a></li>
                                                                        <?php }
                                                                }
                                                                ?>
                                                                <?php
                                                                if($PageNo<$totalpage) {
                                                                    $NextPageNo = 	$PageNo + 1;
                                                                    ?>
                                                            <li style="position:relative;left:-100px;"><a href="javascript: <?php if(!empty($_GET['default_view'])){ ?>load_auction_list_default_view(<?php echo $_GET['pageno'] + 1; ?>, <?php echo $_GET['limit'];?>);<?php }else{?>load_auction_list('<?php echo $row['timestamp'];?>', <?php echo $_GET['pageno'] + 1; ?>, <?php echo $_GET['limit'];?>);<?php }?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                                    <?php } ?>
                                                        </ul>

                                                    </div>
                                                 </li>
                                                    <!--[if !IE]>end pagination<![endif]-->
                                                        <?php }?>

                                                
  
  								<script>
								   $('.admin_bar').css('display', 'block');
								 </script>
<?php								 
echo db_error();
}else{
$sql = "select distinct(timestamp) from autolister, auction where auction.auctionID = autolister.auction_id and auc_status != '2'";
    $result = db_query($sql);

    if(db_num_rows($result) >= 1 ){
      $i = 0;
      
      $sql .=  " order by timestamp desc";
      
      $result = db_query($sql);
      
      
	while($row = db_fetch_array($result)){
	if(is_numeric($row['timestamp'])){
	  ?>
	    <li id="list[<?php echo $row['timestamp'];?>]" style="border: 1px dotted blue;position:relative;left:-40px;    background-color:#cbe2ed;width:850px;      border-radius:6px;margin-bottom:5px;height:30px;" class="task_list">Created on 
	      <input onkeyup="submit_on_enter(event, '<?php echo $i; ?>');" type="text" id="timestamp[<?php echo $i; ?>]" name="timestamp" value="<?php echo date("Y-m-d H:i:s", $row['timestamp']); ?>" class="task_list" /><?php
	 }else{
	 
	   ?>
	 
	    <li id="list[<?php echo $row['timestamp'];?>]" style="border: 1px dotted blue; position:relative;left:-40px;    background-color:#cbe2ed;width:850px;      border-radius:6px;margin-bottom:5px;height:30px;" class="task_list">Named 
	    
	      <input onkeyup="submit_on_enter(event, '<?php echo $i; ?>');" type="text" id="timestamp[<?php echo $i; ?>]" name="timestamp" value="<?php echo $row['timestamp']; ?>"  class="task_list" /><?php
	 
	 }
	   ?>
	     <input type="hidden" value="<?php echo $row['timestamp'];?>" id="oldtimestamp[<?php echo $i;?>]"  class="task_list" />
	   <?php
	    echo  " &nbsp;&nbsp;&nbsp;&nbsp;" . db_num_rows(db_query("select distinct productID from autolister where timestamp = '$row[timestamp]'")) . " Products with ";
	    
	    
	    echo "(" . db_num_rows(db_query("select productID, recuurences from autolister where timestamp = '$row[timestamp]' and recuurences != '0'")) . ") Active Out Of ";
	    
	    echo "(" . db_num_rows(db_query("select productID from autolister where timestamp = '$row[timestamp]'")) . ")s";
	    
	      ?>
		<a href="javascript: load_auction_list('<?php echo $row['timestamp']; ?>');"  class="task_list">Edit This Auto Lister</a>
	      &nbsp;&nbsp;&nbsp;&nbsp;
		<a href="javascript: delete_auction_list('<?php echo $row['timestamp']; ?>');"  class="task_list">Delete This Auto Lister</a>
		<div id="message[<?php echo $i;?>]" class="task_list"></div>
		
	      </li>
	    <?php
	    
	        $i++;
	}
      

    }
}

}else{

if(!empty($_REQUEST['pr_id'])){ 

//echo "/usr/bin/php -q $BASE_DIR/include/addons/update_autolister.php";
if(!isset($_REQUEST['timestamp'])){
$timestamp = time();

 foreach($_REQUEST['sort'] as $key=>$value){
 
    if(!empty($key) & !is_array($key) & $key != 'Array'){

	     if(db_num_rows(db_query("select * from autolister_settings where setting = 'max_auctions'")) == 0){
	     
		
		db_query("insert into autolister_settings values(null, 'max_auctions', '$_REQUEST[max_auctions]');");
	
	
		}else{
	     
		db_query("update autolister_settings set value = '$_REQUEST[max_auctions]' where setting = 'max_auctions'");
	     
	     }
	     
	     echo db_error();

	     
	     
	      db_query("insert into autolister(id, timestamp, sort) values(null, '$timestamp', '$value');");
	
	
	      $insert = db_insert_id();
	     
	      $array = array('number_of_runs', 'nailbiterauction', 'openauction', 'openauction', 'pa', 'fixedpriceauction', 'reverseauction', 'offauction', 'aucstartprice', 'tax1', 'tax2', 'shippingmethod', 'start_every', 'run_for', 'recur_force', 'recuurences', 'allow_buy_now', 'buynowprice', 'pr_id', 'start_now', 'cashauction', 'halfback', 'stagger');
	      
	      foreach($array as $key2 => $value2){
	      
	      
		  if($value2 == 'pr_id'){
		    $pointer = 'pr_id';
		    $value2 = 'productID';
		    
		    	if(preg_match('/-/', $_REQUEST[$key2][$key])){
				$ex = explode("-", $_REQUEST[$key2][$key]);
				  $_REQUEST[$key2][$key] = $ex[0];
			    
			    }
		    }else{
		    $pointer = $value2;
		    }
	      
		  if($_REQUEST[$pointer][$key] != '' & !is_array($_REQUEST[$pointer][$key]) & $_REQUEST[$pointer][$key] != "Array[$key]"){
		      if($value2 == 'stagger'){
		      echo "update autolister set $value2 = '". $_REQUEST[$pointer][$key] . "' where id = '" . $insert . "'";
		      }
		   //   echo "update autolister set $value2 = '". $_REQUEST[$pointer][$key] . "' where id = '" . $insert . "'";
		    db_query("update autolister set $value2 = '". $_REQUEST[$pointer][$key] . "' where id = '" . $insert . "'");
		  
		  }
	      
	      }
    
      } 
 
 } 

 
}else{
$timestamp = trim($_REQUEST['timestamp']);
db_query("delete from autolister where timestamp = '" . $timestamp . "'");



	     
 foreach($_REQUEST['sort'] as $key=>$value){
    if(!empty($key) & !is_array($key) & $key != 'Array'){


	     if(db_num_rows(db_query("select * from autolister_settings where setting = 'max_auctions'")) == 0){
		db_query("insert into autolister_settings values(null, 'max_auctions', '$_REQUEST[max_auctions]');");
	     }else{
	     
		db_query("update autolister_settings set value = '$_REQUEST[max_auctions]' where setting = 'max_auctions'");
	     
	     }
	     
	     echo db_error();
	     
	     
	db_query("insert into autolister(id, timestamp, sort) values(null, '$timestamp', '$value');");
	
	
	      $insert = db_insert_id($db);
	  
	     
	      $array = array('number_of_runs', 'nailbiterauction', 'openauction', 'openauction', 'pa', 'fixedpriceauction', 'reverseauction', 'offauction', 'aucstartprice', 'tax1', 'tax2', 'shippingmethod', 'start_every', 'run_for', 'recur_force', 'recuurences', 'allow_buy_now', 'buynowprice', 'pr_id', 'start_now', 'cashauction', 'halfback', 'stagger');
	      
	      foreach($array as $value2){
	      
		  if($value2 == 'pr_id'){
		    $pointer = 'pr_id';
		    $value2 = 'productID';
		    
		    	if(preg_match('/-/', $_REQUEST[$key2][$key])){
				$ex = explode("-", $_REQUEST[$key2][$key]);
				  $_REQUEST[$key2][$key] = $ex[0];
			    
			    }
		    }else{
		    $pointer = $value2;
		    }
	      
		  if($_REQUEST[$pointer][$key] != '' & !is_array($_REQUEST[$pointer][$key]) & $_REQUEST[$pointer][$key] != "Array[$key]"){
		  if($value2 == 'stagger'){
		// echo "update autolister set $value2 = '". $_REQUEST[$pointer][$key] . "' where id = '" . $insert . "'";
		 }
		    db_query("update autolister set $value2 = '". $_REQUEST[$pointer][$key] . "' where id = '" . $insert . "'");
		  
		  }
	      
	      }
     db_query("update autolister set auction_id = 'waitting' where id = '" . $insert . "'");
      } 
 
 } 

}
 shell_exec("cd $BASE_DIR/include/addons/autolister/");
 //shell_exec("/usr/bin/php -q $BASE_DIR/include/addons/autolister/update_autolister.php");


echo db_error();
echo " Yours Have Been Submitted";
  ?>
    <script>
      load_auction_list_default_view();
      </script>
      
 <?php
 //echo "/usr/bin/php -q $BASE_DIR/include/addons/update_autolister.php";


}else{
if(!empty($_GET['product_id'])){

    if(!empty($_GET['submit'][$_GET['product_id']])){
    
      if(empty($_GET['update'][$_GET['product_id']])){
      
      //do insert here
      
      
      
      }else{
      
      
      //do update here
      
      
      
      }
    
    
    
    }
      $result = db_fetch_array(db_query("select * from products where productID = '$_GET[product_id]' limit 1"));
      
      echo json_encode($result);

//reload current result set here use a function for this that can be reused
}else{




if(!empty($_REQUEST['getproducts'])){

  if($_REQUEST['categoryID'] != '1'){
  
    if(!empty($_REQUEST['json'])){
    
    if(empty($_REQUEST['productID'])){
	$sql = "select productID, name, picture1, long_desc, default_tx1, default_tx2, default_shippingmethod, price from products";	
	}else{
	
	  if(empty($_REQUEST['search'])){
	    if(empty($_REQUEST['row'])){
	    
		$_REQUEST['row'] = 'name';
	    }
	    $sql = "select $_REQUEST[row] from products where productID = $_REQUEST[productID]";
	    }else{
	    
	      $sql = "select * from products where name LIKE '$_REQUEST[search]%' or short_desc LIKE '$_REQUEST[search]%'";
	    
	    }
	
	}
	
	}else{
	
	    if(empty($_REQUEST['search'])){
	      $sql = "select * from products";
	     }else{
	    
	      $sql = "select * from products where name LIKE '$_REQUEST[search]%' or short_desc LIKE '$_REQUEST[search]%'";
	    
	    }
	}  
	  
	  
	    if(!empty($_REQUEST['categoryID'])){
	    
		  if(empty($_REQUEST['productID'])){
		      $sql .= " where categoryID = '$_REQUEST[categoryID]'";
		  }
	    }
    }else{
     $sql = "select * from bidpack";
    }
    $query = db_query($sql);
 
    
    if(!empty($_REQUEST['json'])){
	  $result =  array();
	  while($row = db_fetch_array($query, MYSQL_ASSOC)){
		if(empty($_REQUEST['productID'])){
		   $row['name'] = substr(strip_tags(addslashes($row['name'])));
		   $row['long_desc'] = substr(strip_tags(addslashes($row['long_desc'])), 0, 200);
		  $result[$row['productID']] = $row;
		}else{
		
		  $result = $row[$_REQUEST['row']];
		
		}
	  
	  }
	  if(empty($_REQUEST['productID'])){
	    echo json_encode(array("products" => $result));
	  }else{
	  
	    echo substr(strip_tags($result), 0 , 600);
	  }
    
    }else{
      ?><ul style="list-style-type:none;width:120px;">
	
	  <?php
	  while($row = db_fetch_array($query)){
	 
  
 	    ?>
	      <li style="font-size:8px;" id="products[<?php echo $row['productID'];?>]" onclick="add_to_auction_list('products[<?php echo $row['productID'];?>]', '<?php echo $row['productID'];?>', '<?php echo $row['picture1'];?>','<?php echo substr(strip_tags(preg_replace("/\n/", " ", str_replace("'", "&quot;", $row['name']))), 0, 100);?>', '<?php echo str_replace("'", "&quot;", preg_replace("/\n/", " ", $row['name']));?>', '<?php echo $row['default_tx2'];?>','<?php echo $row['default_tx2'];?>','<?php echo $row['default_shippingmethod'];?>','<?php echo $row['price'];?>', 1, 1, 'prepend');">
		
	      <?php echo $row['name']; ?>
	      <img src="<?php echo $UploadImagePath;?>products/thumbs_small/thumbsmall_<?php echo $row['picture1']; ?>" />
	
	     
	    </li>
	  <?php 
  }


	
 ?></ul><?php
 
 
    }
    
shell_exec("cd $BASE_DIR/include/addons/autolister/");
// shell_exec("/usr/bin/php -q $BASE_DIR/include/addons/autolister/update_autolister.php");
}else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
	<title>Auto /  Speed Lister-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="popupimage.js"></script>
    <link rel="stylesheet" href="<?php echo $SITE_URL;?>css/themes/jquery-ui-1.10.0.custom.min.css" media="screen,projection" type="text/css" />
    <script src="<?php echo $SITE_URL;?>js/jquery-1.9.1.js"></script>
    <script>
		jQuery.uaMatch = function( ua ) {
		ua = ua.toLowerCase();
		var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
		    /(webkit)[ \/]([\w.]+)/.exec( ua ) ||
		    /(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
		    /(msie) ([\w.]+)/.exec( ua ) ||
		    ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
		    [];
		return {
		    browser: match[ 1 ] || "",
		    version: match[ 2 ] || "0"
		};
		};
		if ( !jQuery.browser ) {
		matched = jQuery.uaMatch( navigator.userAgent );
		browser = {};
		if ( matched.browser ) {
		    browser[ matched.browser ] = true;
		    browser.version = matched.version;
		}
		// Chrome is Webkit, but Webkit is also Safari.
		if ( browser.chrome ) {
		    browser.webkit = true;
		} else if ( browser.webkit ) {
		    browser.safari = true;
		}
		jQuery.browser = browser;
		}
		</script>
		  
    <script src="<?php echo $SITE_URL;?>js/ui/jquery-ui-1.10.3.custom.min.js"></script>
    
    
    <style>
    .admin_bar b {
    font-size:10px;
    font-weight:bolder;
    font-variant:small-caps;
    }
      .sortable {
      max-height:75px;
      min-height:25px;
      height:auto;
      }

      .sortable img{
      height:35px;
      width:auto;
      }
      .sortable-placeholder {
      margin-top:5px;
      margin-bottom:5px;
      height:auto;
      width:100%;
      max-height:75px;
      min-height:25px;
      opacity:.70;
   
      
      }
   
       
	.title_wrapper_left_2 {
	  display: block;
	  width: 4px;
	  height: 15px;
	  overflow: hidden;
	  background:url(css/layout/site/title_wrapper_left_auto.png);
	  position: absolute;
	  top: -1px;
	 left:-4px;
	  }
      .title_wrapper_right_2 {
	      
	      display: block;
	      width: 4px;
	      height: 15px;
	      overflow: hidden;
	      background:url(css/layout/site/title_wrapper_right_auto.png);
	      position: absolute;
	      top: -1px;
	      right: -4px;
      }

      .title_wrapper_2 {
	      background:#6997a7 url(css/layout/site/title_wrapper_middle_auto.png) repeat-x;
	     
	     
	  
	      position: relative;
	      top: -3px;
	      left: 0;
	      color: #fff;
	      min-height: 1px;
      }

      .title_wrapper_2:after {
	  content: "."; 
	  display: block; 
	  height: 0; 
	  clear: both; 
	  visibility: hidden;
      } 

      .title_wrapper_2 h3 {
	      font-size: 12px;
	      font-weight: bold;
	      color: white;
	      margin: 0;
	      padding: 0;
	      float: left;
	      text-align:left;
	      white-space: nowrap;
	      width:730px;
      }
  
          .title_wrapper_2 a {
	      font-size: 12px;
	      font-weight: normal;
	      color: white;
	    
      } 
      .edit_table_new {
      border-radius:6px;
      background-color:#cbe2ed;
      padding-top:5px;
      padding-bottom:5px;
      padding-left:10px;
      padding-right:10px;
      width:800px;
      position:relative;
      top:5px;
      border: 1px solid black;
      height:auto;
      max-height:75px;
      }
      #auction_list {
      height:auto;
      max-height:1000px;
    
     
      list-style-type: none; padding: 0; width: 100%; position:relative;left:35px;
      }
      #auction_list li {
      margin: 0px 3px 3px 3px; padding: 0.4em;  font-size: 9px; max-height: 75px;min-height:25px;
      }
      #auction_list li span { position: absolute;  }
      #product_list {
      margin-left:-30px;max-height:1200px;height:auto;overflow-y:auto;text-align:left;padding-right:10px;
      }
    </style>
        <script type="text/javascript">
	  
	function submit_on_enter(event, id){
	
	    var id;
	  
	    
	    
	      var keypressed = event.keyCode || event.which;
		if (keypressed == 13) {
		//alert($('#oldtimestamp[' + id + ']').val());
		    $.get('autolister.php?id=' + id + '&oldtimestamp=' + document.getElementById('oldtimestamp[' + id + ']').value + '&newtimestamp=' + document.getElementById('timestamp[' + id + ']').value,
		    
		    function(response){
		    document.getElementById('timestamp[' + id + ']').value = '';
		    data = response.split('|');
		      document.getElementById('menu_loading').style.display = 'block';
		      document.getElementById('menu_loading').innerHTML = data[0];
		      document.getElementById('timestamp[' + id + ']').value = data[1];
		      window.setTimeout("return_to();",3000);
		    });
		}
	    
	}
	
	
	function return_to(){
	
	    document.getElementById('menu_loading').style.display = 'none';
	      document.getElementById('menu_loading').innerHTML = '<img src="images/icons/loading-bar.gif" align="center" />';
	     
	
	}
        function save_auctions(){
	
	    document.getElementById('auction_list').style.display = 'none';
	    document.getElementById('menu_loading').style.display = 'block';
	    $('.admin_bar').css('display', 'none');
	    var str = "max_auctions=" + document.getElementById('max_auctions').value + "&" + $('#auction_form').serialize();
	 
	    $.post(
		    '<?php echo $SITE_URL; ?>/backendadmin/autolister.php?' + str, function(result){
	    
		$('#auction_list').html(result);
	      window.setTimeout("load_auction_list_default_view();", 100);
	      document.getElementById('auction_list').style.display = 'block';
	    
	    });
	    
	
	
	}
	function delete_auction_list(id){
	  $.get('autolister.php?delete_list=' + id, function(data){
	
		   document.getElementById('list[' +id + ']').innerHTML = data;
	
	    
	  });
	  
	  
	  
	  }
	  
	function delete_confirm(id, auto_id, list_id){
	
	extra = '';

	  if(auto_id){
	  extra += "&auto_id=" + auto_id;
	  }
	  if(list_id){
	  
	  extra += "&list_id=" + list_id;
	  }
	      if(auto_id){
	    
	       $('#menu_loading').css('display', 'block');
		    $('.admin_bar').css('display', 'none');
		    
		  $.get('autolister.php?confirm=yes&'+ extra, function(data){
		 
			 $(document.getElementById('sortable[' + auto_id + ']')).remove();    
		     $('#menu_loading').css('display', 'none');
		    $('.admin_bar').css('display', 'block');
		  });
	      
	      
	      }else{
		  $('#menu_loading').css('display', 'block');
		    $('.admin_bar').css('display', 'none');
		     
		     
		     
		  $.get('autolister.php?confirm=yes&delete_list=' + id + extra, function(data){
		 
			window.setTimeout("return_to();",3000);	
			window.setTimeout("load_auction_list_default_view();", 3000);		     
		    
		  });
	  
	      }
	  
	  }
	function load_auction_list(list_id, pageno, limit){
	     document.getElementById('menu_loading').innerHTML = '<img src="images/icons/loading-bar.gif" align="center" />';
	     $('#menu_loading').css('display', 'block');
	    $('.admin_bar').css('display', 'none');
	    document.getElementById('auction_list').innerHTML = '';
		if(!pageno){
		  pageno = 0;
		  }
		  if(!limit){
		  limit = 25;
		  }

	$.get('autolister.php?timestamp=' + list_id + '&list=yes&pageno=' + pageno + '&limit=' + limit, function(data){
	
		     $('#auction_list').html(data);
		      document.getElementById('menu_loading').style.display = 'none';
  
		
	  });
	
	
			 
	
	}
      function load_auction_list_default_view(pageno, limit){
	     document.getElementById('menu_loading').innerHTML = '<img src="images/icons/loading-bar.gif" align="center" />';
	     $('#menu_loading').css('display', 'block');
	    $('.admin_bar').css('display', 'none');
	    document.getElementById('auction_list').innerHTML = '';
	if(!pageno){
	pageno = 0;
	}
	if(!limit){
	limit = 25;
	}

	$.get('autolister.php?default_view=true&list=yes&pageno=' + pageno + '&limit=' + limit, function(data){
	
		     $('#auction_list').html(data);
		      document.getElementById('menu_loading').style.display = 'none';
  
		
	  });
	
	
			 
	
	}					     
	function load_auction_lists(){
	    document.getElementById('auction_list').innerHTML = '';
	    $('.admin_bar').css('display', 'none');
	    
	    
	     document.getElementById('menu_loading').innerHTML = '<img src="images/icons/loading-bar.gif" align="center" />';
	     $('#menu_loading').css('display', 'block');
	    
	    
	    
	  $.get('autolister.php?list=yes', function(result){
									  
		      $('#auction_list').html(result);
		    document.getElementById('menu_loading').style.display = 'none';  
	      }
	  );
	  
	  
	}
	
	
					      function change_category(id){
					      
						
							if($('#replace_type').val() == 'replace'){
							document.getElementById('auction_list').innerHTML = '';
							$('.admin_bar').css('display', 'none');
							}
							
							$("#product_list").html('<img src="images/icons/loading.gif" align="center" style="text-align:center;position:relative;left:60px;" />');
							
							
							document.getElementById('menu_loading').style.display = 'block';
							  var product_list = '';
							  
							   //	 document.getElementById('product_select').innerHTML = '';
							 
							 //  prompt('autolister.php?json=true&getproducts=true&categoryID='+ $("#" + id).val());
							  $.getJSON('autolister.php?json=true&getproducts=true&categoryID='+ $("#" + id).val(),
							      function(data){
								$("#product_list").html('<ul style="list-style-type:none;"></ul>');
								var item = eval(data);
								
								cnt = 0;
								for(key in data.products) {
								  cnt++;
								}
								
								i = 1;
								      $.each(item.products, function(pr_id){
									
									var product_data = data.products[pr_id];
									     
										
									i++;
										if($('#replace_type').val() != 'manual'){
											add_to_auction_list('products[' + pr_id + ']', pr_id, product_data.picture1, product_data.long_desc.replace("'",'&quot;'), product_data.name.replace("'",'&quot;'), product_data.default_tx1, product_data.default_tx2, product_data.default_shippingmethod, product_data.price, cnt, i );
										}else{
										
										document.getElementById('menu_loading').style.display = 'none'; 
									    $('.admin_bar').css('display', 'block');
										
										
										}
										
										  product_link = '<li style="font-size:9px;">' + product_data.name + '</li><li><img src="../uploads/products/thumbs_small/thumbsmall_' + product_data.picture1 + '" onclick="';
										  
										 product_link += 'javascript: add_to_auction_list(\'products[' + pr_id + ']\',' + pr_id + ',\'' + product_data.picture1 + '\',\'' + product_data.long_desc.replace("'",'&quot;') + '\',\'' + product_data.name.replace("'",'&quot;') + '\',\'' + product_data.default_tx1 + '\',\'' + product_data.default_tx2 + '\',\'' + product_data.default_shippingmethod + '\',\'' + product_data.price + '\',1,1, \'prepend\');';
										  
										  product_link += '" /></li>';
										  
										  
										  $("#product_list ul").append(product_link);	
									

									  });
								      
									
								    
								      }
								   );
								    
							    
							   
							    
							
							    
							// $("#loading-bar").remove();
							   
							      
							  }
							  
							  function remove_from_auction(pr_id, unique_id){
							  
							  
							  $("#" + unique_id).remove();
							  
							  
							  
							  }
							  
							  function remove_from_auction_and_list(pr_id, unique_id, auction_id, list_id){
							  
							  var url = "autolister.php?auto_id=" + pr_id + "&delete_list=" + unique_id + "&auction_id=" + auction_id + "&auto_id=" + list_id;
							 
							      $.get(url , function(data){
								document.getElementById('sortable[' + list_id + ']').innerHTML = data;
							      
							      });
							  
							  
							  }
							  
							  
							  
							  function toggle(pr_id){
							  
							    if( document.getElementById('advanced[' + pr_id + ']').style.display == 'block'){
							    
							    document.getElementById('advanced[' + pr_id + ']').style.display = 'none';
							    
							    
							    
							    
							    }else{
							   
							    
							    document.getElementById('advanced[' + pr_id + ']').style.display = 'block';
							    
							    
							    }
							  
							  
							  
							  }
					
					
					
					
					function show_details(id){
					
					      if(document.getElementById('image[' +id + ']').style.display == 'block'){
					      
					      document.getElementById('description[' +id + ']').style.display = 'none';
					      document.getElementById('image[' +id + ']').style.display = 'none';
					      }
					      else{
					      
					      document.getElementById('description[' +id + ']').style.display = 'block';
					      document.getElementById('image[' +id + ']').style.display = 'block';
					      
					      }
				      }
					
					
							  
						var sort = 0;
						
						function add_to_auction_list(id, pr_id, photo, description, name, tax1, tax2, shippingmethod, buy_now, cnt, i, type){
						 var timestamp = new Date().getUTCMilliseconds();
						 
						 
						if(document.getElementById('product_name[' + pr_id + ']')){
						
						  pr_id = pr_id + "-" + timestamp;
						
						}
						
							 
							  
							  
							//  $.getJSON('autolister.php?product_id=' + pr_id, function(data){
							  
							//  var item = eval(data);
							    
								      
								    
								    
								 
							 
							//    }
							//  );
							
							$('.task_list').remove();
							
							
						      var listing_form = '<li id="sortable[' + pr_id + ']">';
							      
							      
							      
							      
							 listing_form += '<table id="' + timestamp + '" width="910px;" align="left" class="sortable"  style="position:relative;left:-40px;width:910px;border: 1px solid black;border-radius:3px;margin-bottom:5px;background-color:#cbe2ed;">';
							 listing_form += '  <tr>';
							   listing_form += '    <td id="product_name[' + pr_id + ']" class="' + timestamp + '" align="center"  valign="top">';
							      listing_form += '     <div class="title_wrapper_2">';
								
							listing_form += '     <h3>' + name + '';
							    listing_form += '<a href="javascript:;" onclick="show_details(\'' +pr_id+ '\');" style="font-size:8px;position:relative;left:300px;">Details</a><a href="javascript:;" onclick="remove_from_auction(\'' +pr_id+ '\', \'' + timestamp + '\');" style="font-size:8px;position:relative;left:350px;">Remove</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="toggle(' + pr_id + ');" style="font-size:8px;position:relative;left:400px;">Customize</a></h3>';
							   
							   
							    listing_form += '     <span class="title_wrapper_left_2"></span>';
                                                            listing_form += '     <span class="title_wrapper_right_2"></span></div>';
							   
							    listing_form += '</td></tr><tr><td valign="top" id="detailed_info" width="100%">';
							      
							
							            listing_form += '<table width="850px"><tr>';	
							      
								      listing_form += '<td style="width:120px;max-height:75px;" valign="top"><div id="image[' + pr_id + ']" style="display:none;"><img src="../uploads/products/thumbs_small/thumbsmall_' + photo + '" /></div></td>';
							      
							     
								
									listing_form += '<td style="max-height:75px;width:730px;" align="center" valign="top"><div  id="description[' +pr_id + ']" style="display:none;">' + description + '</div></td>';
							
								    listing_form += '</tr></table>';
							    
							    
							    listing_form += '</td></tr><tr><td  id="advanced[' + pr_id + ']" width="850x;" colspan="2" style="display:none;max-height:75px;width:850px;">';
								
								
							  listing_form += '<input type="hidden" id="pr_id[' + pr_id + ']" name="pr_id[' + pr_id + ']" value="' + pr_id + '" />';
							  
							  
							  if($("#master_start").attr('checked')){
							  start_yes_no = 'yes';
							  }else{
							  start_yes_no = '';
							  }
							  listing_form += '<input type="hidden" class="start_now" id="start_now[' + pr_id + ']" name="start_now[' + pr_id + ']" value="' + start_yes_no + '" />';
							  
							  listing_form += '<input type="hidden" id="sort[' + pr_id + ']" name="sort[' + pr_id + ']" value="' + sort + '" class="sortable_inputs" />';
							  
							  
								
							      listing_form += '<table width="100%>';
								
							      listing_form +=  '<tr><td style="max-height:75px;">'; 
								  
								      
								      listing_form += '<table style="font-size:9px;margin-left:20px;max-height:75px;margin-top:-20px;">';
			


								      listing_form += '<tr><td width="12%" valign="top" class="auction_choices">';
									
									
									    
									      
									selected_type = $('#auction_select').val();
									listing_form += '<input checked type="checkbox" name="pa[' + pr_id + ']" id="pa[' + pr_id + ']" value="1" class="standard"';
									
									if(selected_type == 'standard'){
									listing_form += ' checked';
									
									}
									listing_form += ' /> Standard<br />';
									
									listing_form += '<input type="checkbox" name="pa[' + pr_id + ']" id="pa[' + pr_id + ']" value="1" class="cent"';
									
									if(selected_type == 'cent'){
									listing_form += ' checked';
									
									}
									listing_form += ' /> Cent<br />';
									
									      
									listing_form += '<input <?= $rows->offauction == "1" ? "checked" : "" ?> type="checkbox" name="offauction[' + pr_id + ']" id="offauction[' + pr_id + ']" value="1" class="off"';
									
									if(selected_type == 'off'){
									listing_form += ' checked';
									
									}
									listing_form += ' /> 100% off<br />';
									
									
									
									listing_form += '<input type="checkbox" name="cashauction[' + pr_id + ']" id="cashauction[' + pr_id + ']" value="1" class="cashauction"';
									
									if(selected_type == 'cashauction'){
									listing_form += ' checked';
									
									}
									listing_form += ' /> No Bid<br />';
									  
									    
									    
							              listing_form += '      </td>';
								      listing_form += '      <td width="12%" valign="top" class="auction_choices">'
									
                                                                      listing_form += '         <input <?= $rows->nailbiterauction == "1" ? "checked" : "" ?> type="checkbox" name="nailbiterauction[' + pr_id + ']" id="nailbiterauction[' + pr_id + ']" value="1" class="nail"';
									
									if(selected_type == 'nail'){
									listing_form += ' checked';
									
									}
									listing_form += ' /> NailBiter<br />';
                                                                      listing_form += '         <input <?= $rows->halfback == "1" ? "checked" : "" ?> type="checkbox" name="halfback[' + pr_id + ']" id="halfback[' + pr_id + ']" value="1" class="halfback"';
									
									if(selected_type == 'halfback'){
									listing_form += ' checked';
									
									}
									listing_form += ' /> Half Back<br />';
                                                                  



								      


                                                                   
                                                                      listing_form += '          <input <?php echo $uniqueauction == 1 ? "checked" : "" ?> type="checkbox" id="uniqueauction[' + pr_id + ']" name="uniqueauction[' + pr_id + ']" value="1" class="unique"';
									
									if(selected_type == 'unique'){
									listing_form += ' checked';
									
									}
									listing_form += ' /> Lowest<br />';
								   
								      
								      
							              listing_form += '      </td>';
								      
								      listing_form += '      <td width="22%" valign="top" align="left">';									
								       listing_form += ' Start Price';
								     
                                                                       listing_form += '         <input name="aucstartprice[' + pr_id + ']" type="text" class="start_price" id="aucstartprice[' + pr_id + ']" value="0.00" size="6" maxlength="20" style="font-size:9px;"/>';
                                                                    
                                                                       listing_form += '    <?= $Currency; ?>';
									 listing_form += '    <br />';
                                                                       
								      
								       listing_form += 'Tax 1';
                                                                      
                                                                       listing_form += '     <input name="tax1[' + pr_id + ']" type="text" style="font-size:9px;" value="' + tax1 + '" size="4" id="tax1[' + pr_id + ']" maxlength="6" class="tax1" />';
                                                                     
									 listing_form += ' %<br />';
                                                                       
									 listing_form += 'Tax 2 ';
                                                                       
                                                                       listing_form += '     <input name="tax2[' + pr_id + ']" type="text" style="font-size:9px;" value="' + tax2 + '" size="4" id="tax2[' + pr_id + ']" maxlength="6" class="tax2" />';
                                                                      
									 listing_form += ' %<br />';
                                                                      
									
                                                                       
									 listing_form += 'Shipping';
                                                                       listing_form += '     <select name="shippingmethod[' + pr_id + ']" id="shippingmethod[' + pr_id + ']" style="font-size:9px;" class="shipping_sub">';
                                                                     
                                                                                <?php
                                                                                $qryshipping = "select * from shipping";
                                                                                $resshipping = db_query($qryshipping);
                                                                                while ($objshipping = db_fetch_object($resshipping)) {
                                                                                ?>
                                                                       listing_form += '             <option <?= $objshipping->id == $shippingchargeid ? "selected" : ""; ?> value="<?= $objshipping->id; ?>"><?= $objshipping->shipping_title; ?></option>';
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                       listing_form += '     </select>';
								     							

							               listing_form += '      </td>';
								       listing_form += '      <td width="22%" valign="top" align="left">';
									
									 listing_form += 'Delay at End<br /><select name="start_every[' + pr_id + ']" id="start_every[' + pr_id + ']" style="font-size:9px;max-height:75px;" class="start_every_sub">';
								     listing_form += '		<option value="60">Immediately</option>';
								      listing_form += '		<option value="300">5 Minutes</option>';
								      listing_form += '		<option value="600">10 Minutes</option>';
								      listing_form += '		<option value="900">15 Minutes</option>';
								      listing_form += '		<option value="1200">20 Minutes</option>';
								      listing_form += '		<option value="1800">30 Minutes</option>';
								      listing_form += '		<option value="2700">45 Minutes</option>';
								      listing_form += '		<option value="3600">1 Hours</option>';
								      listing_form += '		<option value="7200">2 Hours</option>';
								      listing_form += '		<option value="10800">3 Hours</option>';
								      listing_form += '		<option value="28800">8 Hours</option>';
								      listing_form += '		<option value="43200">12 Hours</option>';
								      listing_form += '		<option value="86400">24 Hours</option>';
								      listing_form += '		<option value="604800">1 Week</option>';
								      
								      listing_form += '		<option value="1209600">2 Weks</option>';
								      listing_form += '		<option value="4838400">1 Month</option>';
								      listing_form += '	</select><br />';
								      
							if($("#master_stagger").attr('checked')){
							  stagger_yes_no = 'yes';
							  }else{
							  stagger_yes_no = '';
							  }
								      listing_form += ' <input type="hidden" id="stagger[' +pr_id + ']" name="stagger[' +pr_id + ']" value="' + stagger_yes_no + '" class="stagger" />';

									 
									  
									  
									
								listing_form += 'Duration For This Auction<br /><select name="run_for[' + pr_id + ']" id="run_for[' + pr_id + ']" style="font-size:9px;" class="run_for">';
								     listing_form += '		<option value="60">Immediately</option>';
								      listing_form += '		<option value="300">5 Minutes</option>';
								      listing_form += '		<option value="600">10 Minutes</option>';
								      listing_form += '		<option value="900">15 Minutes</option>';
								      listing_form += '		<option value="1200">20 Minutes</option>';
								      listing_form += '		<option value="1800">30 Minutes</option>';
								      listing_form += '		<option value="2700">45 Minutes</option>';
								      listing_form += '		<option value="3600">1 Hours</option>';
								      listing_form += '		<option value="7200">2 Hours</option>';
								      listing_form += '		<option value="10800">3 Hours</option>';
								      listing_form += '		<option value="28800">8 Hours</option>';
								      listing_form += '		<option value="43200">12 Hours</option>';
								      listing_form += '		<option value="86400">24 Hours</option>';
								      listing_form += '		<option value="604800">1 Week</option>';
								      
								      listing_form += '		<option value="1209600">2 Weks</option>';
								      listing_form += '		<option value="4838400">1 Month</option>';
									listing_form += '	</select><br />';
									
									  <?php if ($reccur == 'true'){ ?>
								       listing_form += 'Number of Times';
								       listing_form += '<input type="text" name="recuurences[' + pr_id + ']" id="recuurences[' + pr_id + ']" size="6" maxlength="3" style="font-size:9px;" value="1" /><br />';
								       
									 <?php }else{ ?>
									   listing_form += '<input type="text" name="recuurences[' + pr_id + ']" id="recuurences[' + pr_id + ']" size="6" maxlength="3" style="font-size:9px;" value="1" />';
									   
								       <?php }
								       
								       
								       if ($reccur == 'true'){ ?>
									  listing_form += 'Force Duplication';
									    listing_form += '<input type="checkbox" name="force_new[' + pr_id + ']" id="force_new[' + pr_id + ']"><br />';
									      <?php }else{ ?> 	
										
										listing_form += 'Force Duplication';
									    listing_form += '<input type="checkbox" name="force_new[' + pr_id + ']" id="force_new[' + pr_id + ']"><br />';
									    <?php } ?>
										
							               listing_form += '      </td>';
								       listing_form += '      <td width="20%" valign="top" align="left">';										
										
										
										
								     listing_form += 'Buy Now?<input type="checkbox" name="allow_buy_now[' + pr_id + ']" class="buy_now_sub" id="allow_buy_now[' + pr_id + ']" /><br />';
								     listing_form += '   Buy Now Price';
                                                                     listing_form += '     <input name="buynowprice[' + pr_id + ']" type="text" class="buy_now_price" value="' + buy_now + '" size="6" id="buynowprice[' + pr_id + ']"  maxlength="20" style="font-size:9px;" />';
								     listing_form += '<?= $Currency; ?><br />';
								     
								     
                                                                     listing_form += '     Reserve Price: <input name="reserve[' + pr_id + ']" type="text" class="reserve_price" value="<?= $buynowprice ?>" size="6" id="reserve[' + pr_id + ']"  maxlength="20" style="font-size:9px;" />';
								     
								       listing_form += '<?= $Currency; ?><br />';									
								       
									listing_form += '</td></tr>      </table>';



								      						      
								      
								      
								  
							      
								listing_form += '</td></tr></table></li>';
							
							 $("#" + id).css('border', '2px solid green');
							 
					var selObj = document.getElementById('replace_type');
					var selIndex = selObj.selectedIndex;
					replace_type = selObj.options[selIndex].value;
					
					
					if(replace_type == 'replace'){
					
					
					$("#auction_list").append(listing_form);
					
					}else{
							
						if(replace_type == 'append' | replace_type == 'manual'){
							
							$("#auction_list").append(listing_form);
							
							
						}else{
							  if(replace_type == 'prepend'){
							  
							  
								$("#auction_list").prepend(listing_form);
							    
							    }else{
							    
							    $("#auction_list").html(listing_form);
							    
							    }
							    
						 }
						 
					    }
								    
								       if(shippingmethod != 'null'){
									  $('#shippingmethod[' + pr_id + ']').attr('selected', shippingmethod); 
								      
									}	
								      
								      if(document.getElementById('tax1[' + pr_id + ']').value == 'null'){
								      
									document.getElementById('tax1[' + pr_id + ']').value = '';
								      
								      
								      }
								      
								      if(document.getElementById('tax2[' + pr_id + ']').value == 'null'){
								      
									document.getElementById('tax2[' + pr_id + ']').value = '';
								      
								      
								      }
								      
																
									if(i == cnt){
									   
									    document.getElementById('menu_loading').style.display = 'none'; 
									    $('.admin_bar').css('display', 'block');
									
									}	      
								      
							  sort++;
							  resort();
							  
							  
							  change_all_run();
							 
							  change_all_buy_now();
									if($('#master_stagger').attr('checked')){
									    
										$('.stagger').each( function(){
										
										      $(this).attr('value', '1');
										
										 
										});
										$('.start_every_sub').each( function(){
										
										      $(this).val($('#start_all').val())
										
										
										});
									      
									    }
									    
									 //   change_auction_types(); 
							  
							  }
							  
							  
							  
							  
							  
							  
							  
							  function change_auction_types(){
							
							    my_class = $("#auction_select").val(); 
							
							$('.auction_choices input').each(function(){
							    $(this).prop('checked', false);
							      
							});
							 
							 
							      $('.' + my_class).each( function(){
							      
								  $(this).prop('checked',true);
							      });
							  
							  }
							  
							  
							
								
						function change_all_buy_now(){
						
						    if($('#allow_buy_all').prop('checked') == true){
						   
						       $('.buy_now_sub').each(function(){
							  $(this).prop('checked', true);
							});
						    
						    }else{
						    
						       $('.buy_now_sub').each(function(){
							$('.buy_now_sub').attr('checked', false);
							});
							    
						
						    }
						}
						function change_all_start(){
						
						    value = $('#start_all').val();
						
						    $('.start_every_sub').each(function(){
						      $(this).val(value);
						      
						    });
						    
						
						}
						
						
						function change_all_run(){
						
						  value = $('#run_all').val();
						
						    $('.run_for').val(value);
						
						}
						function change_auction_prices(){
						
						    value = $('#start_price').val();
						
						    $('.start_price').val(value);
						
						}
						
						function change_auction_shipping(){
						
						value = $('#shipping_all').val();
						
						   $('.shipping_sub').val(value);
						
						
						}
						
						
						function change_tax_2(){
						
						value = $('#tax2_all').val();
						if(isNaN(value)){
						
						alert('Inalid Format');
						}else{
						    $('.tax2').val(value);
						}
						
						}
						
						function change_tax_1(){
						
						value = $('#tax1_all').val();
						    if(isNaN(value)){
						    
						    alert('Inalid Format');
						    }else{
							$('.tax1').val(value);
						    
						    }
						
						}
						function resort(){
						var m=0;
						$(".sortable_inputs").each(function(i, el){
						
						    document.getElementById(this.id).value = m++;
						
						});
						
						
						}
						
						function remove_stagger_auctions(){
						
						    if($('#master_start').prop('checked') == true){
						    
						      $('#master_stagger').prop('checked', false);	
						
						      $('#master_stagger_box').css('display', 'none');
						      $('.start_every_sub').val('0');
						      $("#start_all_now").val('yes');
						      $(".start_now").val('yes');
						    }else{
						    
						    
						      $('#master_stagger').prop('checked', true);
						      $('#master_stagger').css('display', 'block');
						      $('#master_stagger_box').css('display', 'block');
						      change_all_start();
						      $("#start_all_now").val('');
						      $(".start_now").val('');
						    }
						    stagger_auctions();
						
						}
						
						
						
						function stagger_auctions(){
						    
						      if($('#master_stagger').prop('checked') == true){
							    $('#master_stagger_box').css('display', 'block');
							    $('#master_start_box').css('display', 'none');
							    $('.stagger').each( function(){
							  
								  $(this).attr('value', '1');
							  
							  
							    });
						      document.getElementById('wait_box').style.display = 'block';
						      
						      }else{
						      
						      $('#master_start_box').css('display', 'block');
							$('.stagger').each( function(){
							  
							  $(this).attr('value', '');
							  
							  
							  });
						      
						      document.getElementById('wait_box').style.display = 'none';
						      
						      }
						
						
						
						}
						
						function search_products(){
						  $('#product_list').html('<img src="images/icons/loading.gif" align="center" style="position:relative;left:50px;" />');
						  
						    if(document.getElementById('search').value.length >= 4){
						    $.get('autolister.php?getproducts=true&search=' + $('#search').val(), function(result){
						    
							$('#product_list').html(result);
							
						    });
						  }
						}
				 </script>


    </head>

    <body>
        <!--[if !IE]>start wrapper<![endif]-->
        <div id="wrapper">
            <!--[if !IE]>start head<![endif]-->
            <div id="head">
	      
		<?php include('include/header.php'); ?>
            </div>
            <!--[if !IE]>end head<![endif]-->

            <!--[if !IE]>start content<![endif]-->
            <div id="content">
                <!--[if !IE]>start page<![endif]-->
                <div id="page">
                    <div class="inner">
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Auto Lister</h2>
                                <span class="title_wrapper_left"></span>
                                <span class="title_wrapper_right"></span>
                            </div>
                            <!--[if !IE]>end title wrapper<![endif]-->
                            <!--[if !IE]>start section content<![endif]-->
                            <div class="section_content">
                                <!--[if !IE]>start section content top<![endif]-->
				
			
							   
							
                                
                                  
				      
                                        <div class="sct_right">
                                            <div class="sct_left">
					      <table width="100%">
						<tr>
						  <td colspan="2">
						    
						    	 <table width="100%" style="height:auto;">
							      <tr>
								
								<td align="left" valign="top" height="100%">
								   <b> Category</b>
									<select id="category" name="category" onchange="change_category('category');" style="font-size:9px;">
									  <option>Select to Filter</option>
									  <?php
									  
									  $sqlCat = db_query("select * from categories where categoryID != '1'");
									  
									  while($rowCat = db_fetch_array($sqlCat)){
									  
									  
									    ?><option value="<?php echo $rowCat['categoryID']; ?>"><?php echo $rowCat['name']; ?></option><?php
									  
									  
									  }
									    ?>
									  </select>
								</td>
								<td><b>Product Load Method</b>
									  <select id="replace_type" name="replace_type" style="font-size:9px;">
									    <option value="manual" selected>I will add my own</option>
									    <option value="replace">Replace results</option>
									    <option value="append">Append Results</option>
									    <option value="prepend">Prepend Results</option>
									  </select>
									
								</td>
								<td>
								      <b>Search:</b>
									
									<input id="search" name="search" value="" onkeyup="search_products();" type="text" size="12" style="font-size:9px;" /></li>
									

							      </td>
							      <td style="width:120px;" align="left">   
								     
									
								      <div>
								      <?php
									      $sql_lists = db_query("select * from autolister, products where products.productID  = autolister.productID");
									      
										if(db_num_rows($sql_lists) >= 1){
										  ?>
										    <a href="javascript: load_auction_lists();" style="font-size:9x;"><b>Load Lists</a>
								      <?php } ?>
									
								      </div>
	   
								      </td>
							      <td style="width:120px;" align="left">   
								     
									
								      <div>
								      <?php
									      $sql_lists = db_query("select * from autolister, products where products.productID  = autolister.productID");
									      
										if(db_num_rows($sql_lists) >= 1){
										  ?>
										    <a href="javascript: load_auction_list_default_view();" style="font-size:9x;"><b>Queue</a>
								      <?php } ?>
									
								      </div>
	   
								      </td>								     
							    </tr>
							</table>
						 
						  </td>
						</tr>
						<tr>
						  <td width="150px" valign="top">
					     
								  <div id="product_list"></div>
								  
								  <script>
								      $.get('autolister.php?getproducts=true',
									  function(response){
									  
									    $("#product_list").html(response);
									  
									  }
								      );
								  </script>						    
						    
						  </td>
						  <td valign="top">
								<table width="100%" style="width:100%;" class="edit_table_new">
							    
							    
								  <tr>
								    
								      
								      
								      <td valign="top"><div class="admin_bar">
									<b>Auction Type
									  <br>
									    <select name="auction_select" id="auction_select" onchange="javascript: change_auction_types();" style="font-size:9px;">
									     <option value="" selected style="font-weight:bold;">Standard</option>
									      <option value="off"> 100% off</option>
									      <option value="cent"> Cent</option>
									     
									      <option value="nail"> NailBiter</option>
									      <option value="cashauction"> No Bid</option>
									      <option value="unique"> Lowest</option>
									      <option value="halfback"> Half Back</option>
									
									    </select>
									</b>
								      </div>
								      </td>
								      <td valign="top"><div class="admin_bar">
										      <b>Start Price</b>
									      <br>
										<input type="text" name="start_price" id="start_price" value="0.00" onkeyup="change_auction_prices();" style="font-size:9px;" size="6" />
									        </div>
									    </td>
									    <td valign="top"><div class="admin_bar">
									      <b>Shipping</b>
									      
									      <br />
									      <select name="shipping_all" id="shipping_all" onchange="change_auction_shipping();" style="font-size:9px;">
										
										
											  
											    <?
											    $qryshipping = "select * from shipping";
											    $resshipping = db_query($qryshipping);
											    while ($objshipping = db_fetch_object($resshipping)) {
											    ?>
											      <option <?= $objshipping->id == $shippingchargeid ? "selected" : ""; ?> value="<?= $objshipping->id; ?>"><?= $objshipping->shipping_title; ?></option>
											    <?
											    }
											    ?>
										  </select>
										    </div>
									    </td>
									    <td valign="top"><div class="admin_bar">
									      <b>Tax 1</b><br />
										  
										<input name="tax1_all" type="text" style="font-size:9px;" class="text" value="<?= $tax1; ?>" size="4" id="tax1_all" maxlength="6" onkeyup="change_tax_1();" />
										%
										  </div>
									  </td>
									  <td valign="top"><div class="admin_bar"> 
									      <b>Tax 2</b><br />
										  
										<input name="tax2_all" type="text" style="font-size:9px;" class="text" value="<?= $tax2; ?>" size="4" id="tax2_all" maxlength="6"  onkeyup="change_tax_2();" />
										%
										  </div>
									    </td>
									   
									    <td valign="top" align="left"><div class="admin_bar">
									    <b>Max #</b><br />
									    <input type="text" value="10" id="max_auctions" name="max_auctions" size="3" style="font-size:9px;" class="text" />
									     </td>
									    <td valign="top" align="left"><div class="admin_bar">
									    <span id="master_start_box" name="master_start_box" style="display: block;">
									       <b>Start All Now?</b>
									      <input type="checkbox" id="master_start" name="master_start" onclick="remove_stagger_auctions();" />
									      
									      
									      <br />
									      </span>
									      <span id="master_stagger_box">
									       <b>Stagger Auctions?</b>
									      <input type="checkbox" id="master_stagger" name="master_stagger" onclick="stagger_auctions();" />
									      </span>
									      <br />
									      <div id="wait_box" style="display:none;">
									      <b>Delay At End</b><br />
									      <select id="start_all" name="start_all" onchange="javascript: change_all_start();" style="font-size:9px;">
										<option value="60">Immediately</option>
										<option value="300">5 Minutes</option>
										<option value="600">10 Minutes</option>
										<option value="900">15 Minutes</option>
										<option value="1200">20 Minutes</option>
										<option value="1800">30 Minutes</option>
										<option value="2700">45 Minutes</option>
										<option value="3600">1 Hours</option>
										<option value="7200">2 Hours</option>
										<option value="10800">3 Hours</option>
										<option value="28800">8 Hours</option>
										<option value="43200">12 Hours</option>
										<option value="86400">24 Hours</option>
										<option value="604800">1 Week</option>
										
										<option value="1209600">2 Weeks</option>
										<option value="4838400">1 Month</option>									  
										
									      </select>
									      
										    </div>
									        </div>
									    </td>
									    <td valign="top">
									      <div class="admin_bar">
									      <b>Duration of Auctions</b><br />
									      <select id="run_all" name="run_all" onchange="change_all_run();" style="font-size:9px;">
										<option value="60">Immediately</option>
										<option value="300">5 Minutes</option>
										<option value="600">10 Minutes</option>
										<option value="900">15 Minutes</option>
										<option value="1200">20 Minutes</option>
										<option value="1800">30 Minutes</option>
										<option value="2700">45 Minutes</option>
										<option value="3600">1 Hours</option>
										<option value="7200">2 Hours</option>
										<option value="10800">3 Hours</option>
										<option value="28800">8 Hours</option>
										<option value="43200">12 Hours</option>
										<option value="86400">24 Hours</option>
										<option value="604800">1 Week</option>
										
										<option value="1209600">2 Weeks</option>
										<option value="4838400">1 Month</option>
										
									      </select>
									      </div>	
									    </td>
									    
									    <td valign="top"><div class="admin_bar"> 
									      <?php if($reccur == 'yes'){
										?>
									      <b>Recurrence</b>
									      <?php } ?>
									        </div>
									    </td>
									    <td valign="top"><div class="admin_bar">
									      <b>Allow Buy Now</b><br />
									      <input type="checkbox" value="" id="allow_buy_all" name="allow_buy_all" onchange="change_all_buy_now();" />
									        </div>
									    </td>								
									    
									  
									  
									  
									  
									    <td align="right"><div class="admin_bar">
										  
										  <input type="submit" name="submit" id="submit" value="Save" onclick="javascript: save_auctions();">
										  
									
									  </div>
								
								      </td>
								    </tr>
								    <tr>
								      <td colspan="10" align="center">
									<div id="menu_loading" class="loading" style="text-align:center;display:none;">
									  <img src="images/icons/loading-bar.gif" />
									  </div>
								      </td>
								    </tr>
								  </table>
							    
								  
											      
					      <form action="javascript: save_auctions();" id="auction_form" name="auction_form">

						  <input type="hidden" name="start_all_now" id="start_all_now" value="" />								  
								  <ul id="auction_list">
								  </ul>
					      </form>
								  <script>
								   load_auction_list_default_view();
								   $('#auction_list').sortable({
									placeholder: "sortable-placeholder", cursor: 'crosshair', forceHelperSize : true, stop : function(event, ui){
									
									resort();
									
									}
								      });
								  </script>
								 </td>
							    </tr>
							
							  </table>	
							  
						  </td>
						  
						</tr>
					      </table>
						      
						
                                <!--[if !IE]>end section content bottom<![endif]-->
				
				</div>
			      </div>
			   

                            </div>
                            <!--[if !IE]>end section content<![endif]-->
                        </div>
                        <!--[if !IE]>end section<![endif]-->
                    </div>
                </div>
                <!--[if !IE]>end page<![endif]-->
                <!--[if !IE]>start sidebar<![endif]-->
                <div id="sidebar">
                    <div class="inner">
    
<!--[if !IE]>start section<![endif]-->
<div class="section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h4>Auto Lister</h4>
        <span class="title_wrapper_left"></span>
        <span class="title_wrapper_right"></span>
    </div>
    <!--[if !IE]>end title wrapper<![endif]-->
    <!--[if !IE]>start section content<![endif]-->
    <div class="section_content">
        <!--[if !IE]>start section content top<![endif]-->
        <div class="sct">
            <div class="sct_left">
                <div class="sct_right">
                    <div class="sct_left">
                        <div class="sct_right">
			  
			  <ul style="list-style-type:none;margin-left:-40px;margin-top:0px;"><h3 style="text-align:center;">Features</h3>
			    <li><b>Multiple Uses</b>
			      <ul>
				<li>Add Multiple Auctions all at once</li>
				<li style="text-align:center;margin-left:-20px;list-style-type:none;">Or</li>
				<li>Stagger Auction Start Times With Configurable Delays After The Last One Ends</li>
				<li>Customize Each Individual Auction Or Simply Submit Using The Product Defaults</li>
				<li>Reuse Previous Auction Lists</li>
				<li>Easy Sorting Of Products</li>
				<li>Rename Previously Loaded Lists</li>
				<li>Set Duration Of Auctions Using Quick Bar Or Customize Each One</li>
			      </ul>
			    </ul> 
			  <ul style="list-style-type:none;margin-left:-40px;margin-top:-10px;margin-bottom:0px;"><h3 style="text-align:center;">Instructions</h3>
			    <li><b>Quick Start Guide</b><img src="images/icons/video-help.png" style="height:30px; width:auto;margin-right:10px;" align="right" />
			    
			      <ul>
				<li class="tooltip" title="basics">Beginners</li>
			      <li class="tooltip" title="customizing">Customizing Auctions</li>
			      <li class="tooltip" title="relisting">Relisting Auctions</li>
			      <li class="tooltip" title="wheretofind">Where To Find Auctions After</li>

			    </ul>
			  </li>
			  
			</ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--[if !IE]>end section content top<![endif]-->
        <!--[if !IE]>start section content bottom<![endif]-->
        <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
        <!--[if !IE]>end section content bottom<![endif]-->

    </div>
    <!--[if !IE]>end section content<![endif]-->
</div>
<!--[if !IE]>end section<![endif]-->
   


                    </div>
                </div>
                <!--[if !IE]>end sidebar<![endif]-->

            </div>
            <!--[if !IE]>end content<![endif]-->

        </div>
        <!--[if !IE]>end wrapper<![endif]-->

        <!--[if !IE]>start footer<![endif]-->
        <div id="footer">
            <div id="footer_inner">
                <?php include 'include/footer.php'; ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->

    </body>
</html>


<?php
}
}
}
}
}
}
