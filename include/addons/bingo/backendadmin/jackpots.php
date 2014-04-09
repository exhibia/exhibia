<?php
include("../../../../config/config.inc.php");
if($_REQUEST['jackpots'] != 'products'){

$places = array('first', 'second', 'third');

?>


	    <ul style="list-style:none;">
	    
		  <?php
		  foreach($places as $place){
		  $data = db_query("select * from bingo_jackpots where bingo_id = '$_REQUEST[id]' and place = '$place'");
		  
		  $row_j = db_fetch_array($data);
		  if(empty($row_j['reward_points'])){
		  
		  $row_j['reward_points'] = 0;
		  }
		  if(empty($row_j['which_to_give'])){
		  $row_j['which_to_give'] = 'free_bids';
		  }
		  ?>
		<li>
		  <ul style="list-style:none;">
		  
			<li style="display:inline;"><?php echo ucfirst($place); ?>:
			  <input type="text" id="reward_per_card[<?php echo $place; ?>]" name="reward_per_card[<?php echo $place; ?>]" value="<?php echo $row_j['reward_points']; ?>" />%
			</li>
			<li style="display:inline;">
			   <select id="which_to_give[<?php echo $place; ?>]" name="which_to_give[<?php echo $place; ?>]" style="width:100px!important;">
			      <option value="free_bids" <?php if($row_j['which_to_give'] == 'free_bids'){ echo 'selected'; } ?>>Free Bids</option>
			      <option value="final_bids" <?php if($row_j['which_to_give'] == 'final_bids'){ echo 'selected'; } ?>>Actual Bids</option>
			   </select>
			</li>
		      </ul>
		</li>
		<?php } ?>
	</ul>
<?php }else{ ?>
		  <ul style="list-style:none;">
		      <li style="">
			    First: <select id="productID[first]" name="productID[first]" style="width:100px!important;">
			      <?php
			      $sql = db_query("select * from products");
				  while($row_j = db_fetch_array($sql)){
				  ?>
				      <option value="<?php echo $row_j['productID']; ?>"><?php echo $row_j['name']; ?></option>
				  <?php
				  }
				  ?>
			   </select>
		      </li>
		      <li style="">
			    Second: <select id="productID[second]" name="productID[second]" style="width:100px!important;">
			      <?php
			      $sql = db_query("select * from products");
				  while($row_j = db_fetch_array($sql)){
				  ?>
				      <option value="<?php echo $row_j['productID']; ?>"><?php echo $row_j['name']; ?></option>
				  <?php
				  }
				  ?>
			   </select>
		      </li>
		      <li style="">
			    Third: <select id="productID[third]" name="productID[third]" style="width:100px!important;">
			      <?php
			      $sql = db_query("select * from products");
				  while($row_j = db_fetch_array($sql)){
				  ?>
				      <option value="<?php echo $row_j['productID']; ?>"><?php echo $row_j['name']; ?></option>
				  <?php
				  }
				  ?>
			   </select>
		      </li>
		</ul>
<?php } ?>
