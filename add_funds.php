<?php
include_once("config/connect.php");
if(empty($_SESSION['userid'])){

  include("$BASE_DIR/include/exhibia/social_login.php");

}else if(empty($_REQUEST['bidpack'])){

    $qry = db_query("select * from bidpack order by id asc limit 0, 3");
    ?>
 <form action="buybids.php" method="get">
    <ul style="min-height:260px;list-style:none;max-width:300px;margin:0 5px 0 -15px;;float:left;">
    <?php
    $i = 1;
      while($row = db_fetch_array($qry)){
      ?><li style="margin:5px 5px 5px 0px;background-image:url(uploads/products/<?php echo $row['bidpack_banner']; ?>);width:298px;height:60px;background-size:298px 60px;">
	  <input style=" margin: 24px 0 0 10px;" type="radio" name="bidpack" id="bidpack_<?php echo $row['id']; ?>" onclick="change_bidpack(<?php echo $row['id']; ?>);" />
	  <span>
	      <ul class="chrome_ul" style="clear: both !important;float: right !important;left: -75px;min-width: 80px;position: relative;top: -30px;text-align:center;">
		<li style="display:inline;block;float:left;margin-right:10px;">
		    <ol style="list-style:none;text-align:center;">
		       <li style="font-size:22px;color:<?php echo $row['bid_color']; ?>;"><?php echo $row['bid_size']; ?></li>
		       <li style="text-align:center;">Bids</li>
		    </ol>
		</li>
		<li style="display:inline;block;float:right;margin-left:10px;text-align:center;">
		    <ol style="list-style:none;text-align:center;font-weight:normal;">
		      <li style="text-align:center;font-size:18px;"><?php echo ceil($row['bid_bonus_percent']); ?>%</li>
		      <li style="text-align:center;">Bonus</li>
		    </ol>
		</li>
		<li style="display:inline;block;float:right;text-align:center;">+</li>
	      </ul>
		
	  </span>
	 
      </li><?php
      
      $i++;
	
      }
    ?>
    </ul>
    <?php
    $qry = db_query("select * from bidpack order by id asc limit 3, 6");
    ?>
    <ul style="min-height:260px;list-style:none;max-width:300px;margin:0;float:right;position:relative;left:-65px;">
    <?php
    $i = 1;
      while($row = db_fetch_array($qry)){
      ?><li style="margin:5px 5px 5px 0;background-image:url(uploads/products/<?php echo $row['bidpack_banner']; ?>);width:298px;height:60px;background-size:298px 60px;">
	  <input style=" margin: 24px 0 0 10px;" type="radio" name="bidpack" id="bidpack_<?php echo $row['id']; ?>" onclick="change_bidpack(<?php echo $row['id']; ?>);" />
	   <span>
	      <ul class="chrome_ul" style="clear: both !important;float: right !important;left: -70px;min-width: 80px;position: relative;top: -30px;text-align:center;">
		<li style="display:inline;block;float:left;margin-right:10px;">
		    <ol style="list-style:none;text-align:center;">
		       <li style="font-size:22px;color:<?php echo $row['bid_color']; ?>;"><?php echo $row['bid_size']; ?></li>
		       <li style="text-align:center;">Bids</li>
		    </ol>
		</li>
		<li style="display:inline;block;float:right;margin-left:10px;text-align:center;">
		    <ol style="list-style:none;text-align:center;font-weight:normal;">
		      <li style="text-align:center;font-size:18px;"><?php echo ceil($row['bid_bonus_percent']); ?>%</li>
		      <li style="text-align:center;font-size:14px;">Bonus</li>
		    </ol>
		</li>
		<li style="display:inline;block;float:right;text-align:center;">+</li>
	      </ul>
		
	  </span>
	 
      </li>
      <?php
      
      $i++;
	
      }
    ?>
    </ul>
    <div class="clear"></div>
    <input type="hidden" name="pkg" id="pkg" value="<?php echo $obj["id"]; ?>" />
    <input type="hidden" name="payfor" id="payfor" value="buybids" />
    <input type="hidden" name="bidpackid" id="bidpackid" value="" />
    <input type="hidden" name="buybids" id="buybids" value="" />
    <input type="hidden" name="fund_id" id="fund_id" value="<?php echo $_REQUEST['aid']; ?>" />
    <ul style="margin:20px 0 0 0px;width:580px;clear:both;">
	<li style="width:400px;display:inline-block; margin: 0 0 0px 0;"></li>
	<li style="display:inline-block;font-size:26px;font-weight:bold;">Total:<span style="font-weight:bold;font-size:24px;" id="bid_price"></span></li>
    </ul>
    <div class="clear"></div>
    <ul style="margin:0px 0 0 -10px;border-top:1px solid #000;width:580px;clear:both;">
	<li style="width:400px;display:inline-block; margin: 0 0 30px 0;"></li>
	<li style="display:inline-block;"><input type="submit" name="submit"  value="cancel" class="button grey" onclick="$('#funds_modal').dialog('close');" /></li>
	<li style="display:inline-block;"><input disabled id="bidpack_submit" type="submit" name="submit" value="buy bids" class="button" /></li>

    </ul>
    </form>
    <?php
}else{





}