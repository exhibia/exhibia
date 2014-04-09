							    <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        
                                                                        <tr>
                                                                            <!-- DISPLAY THE SUBCATEGORIES AND ON CLICK GO TO SUB CATEGORIES -->
                                                                                <?
                                                                                if($totalcat!="") {
                                                                                    while($catdisp = db_fetch_array($result)) {
                                                                                        ?>
                                                                            <td><?php if($catdisp["products_count"]>0) {?><a class="folder" href="pandl.php?catID=<?=$catdisp["categoryID"];?>"><img alt="" class="folder" src="<?='images/icons/folder.gif'?>"/>&nbsp;&nbsp;<?=$catdisp["name"];?></a><?php } else {?> <img alt="" class="folder" src="<?='images/icons/folder.gif'?>"/>&nbsp;&nbsp;<?=$catdisp["name"];?><?php }?>&nbsp;&nbsp;Products : <?=$catdisp["products_count"];?></td>
                                                                        </tr>
                                                                                    <?
                                                                                }
                                                                            }
                                                                            ?>
                                                                        <tr>
                                                                            <td colspan="8">
                                                                                <!--END DISPLAY CATEGORIES-->
                                                                            </td>
                                                                        </tr>

                                                                            <?php
                                                                            if($total>0) {
                                                                                ?>
                                                                        <tr class="th-a">
                                                                            <th style="width:42px;text-align:center;">No</th>
                                                                            <th style="width:132px;text-align:center;" class="photo">Image</th>
                                                                            <th style="width:107px;">Code</th>
                                                                            <th style="width:210px;">Product</th>
                                                                           
                                                                            <!--<TD  width="10%">InStock</TD>-->
                                                                            <th style="width:208px;">My Cost</th>
                                                                            <th style="text-align:left">Buy Now Price</th>
                                                                        </tr>
                                                                                <?php
                                                                            }
                                                                            ?>

                                                                            <?php
                                                                            $totals = array();
                                                                            for($i=0;$i<$total;$i++) {

?>
<table  style="border:1px solid black;" width="100%">
<?php
                                                                                $row = db_fetch_object($result);
                                                                             
                                                                                $id=$row->productID;
                                                                                $catID=$row->categoryID;
                                                                                $image = $row->picture1;
                                                                                $code=$row->product_code;

                                                                                $name = $row->name;
                                                                                $price= $Currency.$row->price;
                                                                                $status = $row->enabled;

                                                                                $cellColor = "";
                                                                                $cellColor = ConfigcellColor($i);

                                                                                if($PageNo>1) {
                                                                                    $srno = ($PageNo-1)*10+$i+1;
                                                                                }
                                                                                else {
                                                                                    $srno = $i+1;
                                                                                }

                                                                                ?>
                                                                        <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>" valign="center" style="">
                                                                            <td style="width:42px;text-align:center;height:70px;">
                                                                                        <?php echo $srno;?>
                                                                            </td>
                                                                            <td style="width:132px;text-align:center;">
                                                                                <a href="pandl.php?prodID=<?=$id?>&catID=<?=$catID?>" class="product_thumb">
                                                                                            <?php if($image!="") {
                                                                                                echo "<img src='../uploads/products/thumbs/thumb_".$image."'>";
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            } ?>
                                                                                </a>
                                                                            </td>
                                                                            <td style="width:107px;">
                                                                                        <?php if($code!="") {
                                                                                            echo $code;
                                                                                        }else {
                                                                                            echo "&nbsp;";
                                                                                        }?>
                                                                            </td>
                                                                            <td style="width:210px;">
                                                                                <a href="pandl.php?prodID=<?=$id?>&catID=<?=$catID?>" class="product_name">
                                                                                            <?php if($name!="") {
                                                                                                echo stripslashes($name);
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            } ?>
                                                                                </a>
                                                                            </td>
                                                                            
                                                                            <td style="width:208px;">
                                                                                        <?php echo $row->actual_cost;?>
                                                                            </td>
                                                                            <td style="" align="center">
                                                                                <div class="actions_menu">
                                                                               <?php echo $row->price;?>
                                                                                </div>
                                                                            </td>
                                                                        </tr>

<tr><td colspan="6"><h5>
Auction Results for <?php echo $row->name; ?>
</h5>
</td></tr>

<tr>
<th style="width:42px;text-align:center;">No</th>
<th class="photo" style="width:132px;text-align:center;">Category</th>

<th style="width: 107px;">Start Date / End Date</th>
<th style="width: 210px;">Start Price / End Price</th>
<th style="text-align: left;width:208px;">Cost</th>
<th style="text-align: left;">Result</th>
</tr>
<?php
$sqlAuctions = "SELECT auctionID,categoryID, auc_start_price, auc_final_price, auc_start_date, auc_end_date, auc_status, auc_type FROM auction WHERE productID = $row->productID AND auc_end_date != '0000-00-00'";
    $queryAuctions = db_query($sqlAuctions);
	$totals[$row->productID] = '';
	
	$count = db_num_rows($queryAuctions);
	while($rowAuctions = db_fetch_array($queryAuctions)){
	
	$totals[$row->productID] = $rowAuctions['auc_final_price'] + $totals[$row->productID];

?>
<tr>
  
	  <td>
	    <?php echo $rowAuctions['auctionID'];?>
	  </td>
	  <td>
	    <?php echo $rowAuctions['categoryID'];?>
	  </td>
	   <td>
	    <?php echo $rowAuctions['auc_start_date'];?> /
	    <?php echo $rowAuctions['auc_end_date'];?>
	  </td>
	  <td>
	    <?php echo $Currency; 
		  echo $rowAuctions['auc_start_price'];
		  echo ' '. $CurrencyName;?> / <?php echo $Currency . $rowAuctions['auc_final_price'] . ' ' . $CurrencyName;?>
	  </td>
	  <td>
	    <?php echo $Currency; 
		  echo $row->actual_cost; 
		  echo $CurrencyName;
	    ?>
	  </td>	 
	   <td style="<?php if($rowAuctions['auc_final_price'] - $row->actual_cost > 0){ ?>color:blue;font-weight:bold;<?php }else{ ?>color:red;font-weight:bold;<?php } ?>">
	    <?php echo $rowAuctions['auc_final_price'] - $row->actual_cost;?><?php echo $Currency; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo percent($row->actual_cost, $rowAuctions['auc_final_price'] - $row->actual_cost, 2); ?>% 
	  </td>
</tr>
<?php





} 
?>
<tr><td colspan="3"><h5>Aggregate Information:</h5></td>
<td><h5>Total Sales: <?php 

echo $Currency . $totals[$row->productID];?> - <?php echo $Currency; echo $row->actual_cost * $count; ?> = <?php 

	    
	    $n = $totals[$row->productID] - ($row->actual_cost * $count);	
	    if($n <= 0){  
		echo "<span style=\"color:red;\">-" . $Currency . ltrim($n, "-") . "</span>";
	    }else{
	    
		echo "<span style=\"color:green;\">" . $Currency;  
		echo $n;
		echo "</span>";
	    }
      echo "&nbsp;&nbsp;&nbsp;&nbsp;Actions: (" . $count . ") ";
 ?></h5></td>
<td colspan="1"></td>
<td><h5>Productivity Percent</h5>
<?php
	$percent = percent($row->actual_cost * $count,$n, '2');
	if($percent < 0){
	      echo "<h4 style=\"color:red\">$percent" . "%</h4>";
	}else{
	      echo "<h4 style=\"color:green\">$percent" . "%</h4>";	
	
	}
?>
</td>
</tr>
<tr><td colspan="6" height="50px"></td></tr>


</table>


                                                                                <?php }
                                                                            ?>
                                                                    </tbody>
                                                                </table>