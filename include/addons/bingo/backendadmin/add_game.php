<?php

?>
<style>
input, select {
max-width:50px;
}
td {
text-align:left;
}
ul {
margin:0 0 0 -40px;
text-align:left;
}
input[type="submit"] {
z-index:999999999999;
}

</style>
<?php
include("../../../../config/config.inc.php");
if(empty($_REQUEST['verified'])){


die();
}else{
$uniqid = $_REQUEST['unique'];
    if(empty($_REQUEST['add'])){
	?>
	
	     <form method="post" action="javascript: verify_game('<?php echo $uniqid; ?>');" id="<?php echo $uniqid; ?>" name="bingo_<?php echo $uniqid; ?>">
	     
	    <table style="width:1500px;">
	      <tbody>
		<tr>
		  <th>Name</th>
		  <th>Cost Per Card</th>
		  <th>Jackpot</th>
		  <th>Min # of Cards Per Person</th>
		  <th>Max # of Cards Per Person</th>
		  
		  
		  <th style="width:180px;">Game Start Time </th>
		  <th>Min # of Players</th>
		  <th></th>
	  
		</tr>
		<tr>
		  <td valign="top" height="100%">
		      <input type="text" name="name" id="name_<?php echo $uniqid; ?>" style="min-width:140px!important;" />
		  </td>
		  <td valign="top" height="100%">
		      <ul>
			<li style="display:inline;">
			  <input type="text" id="cost_per_card_<?php echo $uniqid; ?>" name="cost_per_card" value="10" style="min-width:100px!important;" />
			</li>
			<li style="display:inline;">
			
			   <select id="which_to_take_<?php echo $uniqid; ?>" name="which_to_take" style="min-width:100px!important;">
			      <option value="free_bids">Free Bids</option>
			      <option value="final_bids">Actual Bids</option>
			   </select>
			</li>
		      </ul>
		  </td>
		
		  <td valign="top" height="100%"><div id="edit_jackpots_<?php echo $uniqid; ?>"></div>
		      <select id="jackpots_<?php echo $uniqid; ?>" name="jackpots" onchange="choose_jackpots();" style="min-width:100px!important;">
			<option value="">Select</option>
			<option value="products">Product</option>
			<option value="percent">Percent of purse</otpion>
		      </select>
		      <script>
			  function choose_jackpots(){
				  $.ajax({
					  url: '<?php echo $SITE_URL;?>/include/addons/bingo/backendadmin/jackpots.php',
					  data: { 'jackpots' : $('#jackpots_<?php echo $uniqid; ?>').val()},
					  success: function(response){
					      $('#edit_jackpots_<?php echo $uniqid; ?>').html(response);
					  }
				  });
			    }
		      </script>
					    
		  </td>
		  <td valign="top" height="100%">
			<input type="text" name="min_cards" id="min_cards_<?php echo $uniqid; ?>" value="1"  style="min-width:50px!important;" />
		  </td>	
		  <td valign="top" height="100%">
			<input type="text" name="max_cards" id="max_cards_<?php echo $uniqid; ?>" value="5" style="min-width:50px!important;" /><br /><span style="font-size:10px;">25 Max</span>
		  </td>	
		  <td valign="top" height="100%">
			
			<?php $days = array("S" => "Sunday", "M" => "Monday", "T" => "Tuesday", "W" => "Wednesday", "Th" => "Thursday", "F" => "Friday", "Sa" => "Saturday"); ?>
			    <ul>
			      <li style="display:inline;float:left;">
				<ul style="list-style-type:none;" >
				<?php $unique = uniqid(); ?>
				 
				    <li><input class="time_b" type="text" id="time_b_<?php echo $uniqid; ?>" name="time_b" autocomplete="off"></li>
			   <li><b>Date</b></li>
				    <li><input id="day_once_<?php echo $uniqid; ?>" name="day_once" class="day_once" /></li>
				  <script>
				      $('#day_once_<?php echo $uniqid; ?>').datepicker({});
				       $('#time_b_<?php echo $uniqid; ?>').timepicker({ 'timeFormat': 'H:i:s', step: 5 });
				  
				  </script>
				</ul>
			      </li>
			
			 
			     <!-- <li style="display:inline;float:right;">
			      <ul style="list-style-type:none;" >
				
				    <li style="padding-left:30px;"><b>Or Every</b></li>
				    <?php
				      foreach($days as $key => $day){
				      ?>
				      <li><?php echo $day; ?> <input type="checkbox" name="day[]" id="day[]" value="every <?php echo $key;?>" style="float:right;" />
				      <?php
				      }
				    ?>
				</ul> 
			      </li>-->
			   
			   </ul>
			    
		  </td>
		  <td valign="top" height="100%">
		  <select id="min_players_<?php echo $uniqid; ?>" name="min_players" class="min_players" style="min-width:100px!important;">
			<option value="">Select</option>
			<?php
			$r = 1;
			while($r <= 1000){
			?><option value="<?php echo $r;?>"><?php echo $r; ?></option><?php
			$r++;
			}
			?>
		      </select>
		  
		  </td>
		   <input type="hidden" name="plugin" id="plugin" value="<?php echo $_REQUEST['plugin']; ?>" />
		  <input type="hidden" id="page" name="page" value="<?php echo $_REQUEST['page']; ?>" />
		  <td valign="top" height="100%">
			
												<span class="button send_form_btn">
												    <span>
													<span>
													    <?php echo 'Edit Game'; ?>
													
													    <input type="submit">
													    <input type="hidden" name="<?php echo 'editgame'; ?>" id="editgame_<?php echo $uniqid;?>" />
													</span>
												      </span>
												 </span>
		  </td>
		</tr>
	       </tbody>
	      </table>
	      </form>
	<?php
    }else{


    }
    
}
