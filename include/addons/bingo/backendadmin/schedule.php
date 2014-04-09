<script>
function delete_game(url){
    $.ajax({
	url: url,
	success:function(response){
	
	window.location.href = window.location.href;
	}
    
    
    
    })


}
function validateTime(strTime) {

var regex = new RegExp("([0-1][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])");

if (regex.test(strTime)) {
return true;
} else {
return false;
}

}

  function verify_game(formID){
    v_time = $('#time_b_' + formID).val();
    date_parts = $('#day_once_' + formID).val().split("/");
    v_date = date_parts[2] + ', ' + date_parts[0] + ', ' + date_parts[1];

    this_time = new Date(v_date + ' ' + v_time).getTime() / 1000;
    
    if($('#' + formID).hasClass('disabled')){
    
	alert('This game is running it can not be edited any more');
	
    
    
    }else{
 
    if(!validateTime(v_time)){
    
	alert('Time is not in the correct format')
    }else
    if( parseInt(this_time) <  $('#hidden_date').val()  ){
      
	  alert('Date and time must be in the future')
	 
      
      }else{
      
	  data =$('#' + formID).serialize();
	 
	  if(   $('#cost_per_card_' + formID).val() ==  ''){
	      alert('Please enter a cost per card');
	  
	  }else
	  
	  
	  if(   $('#name_' + formID).val() ==  ''){
	      alert('Please enter  Name');
	  
	  }else
	  
	  if($('#max_cards_' + formID).val() > 25){
	      alert('Too many cards, use fewer than 26')
	  
	  }
	  if(   $('#max_cards_' + formID).val() ==  '' | $('#max_cards_' + formID).val() == 0 | $('#max_cards_' + formID).val() <= $('#min_cards_' + formID).val() | isNaN($('#max_cards_' + formID).val())){
	      alert('Please select a maximum number of cards. Greater than Minimum cards.');
	  
	  }else
	  
	  if( $('#min_cards_' + formID).val() ==  '' | $('#min_cards_' + formID).val() == 0 | $('#min_cards_' + formID).val() >= $('#max_cards_' + formID).val() | isNaN($('#min_cards_' + formID).val())){
	      alert('Please select a minimum number of cards. Less than Maximum Cards.');
	      
	      
	  }else if(   $('#min_players_' + formID).val() ==  ''){
	      alert('Please select a minimum number of players');
	  
	  }else{
	  $.ajax({
		  url: '<?php echo $SITE_URL;?>/include/addons/bingo/backendadmin/submit_game.php',
		  type: 'post',
		  dataType: 'html',
		  data: data,
		  success: function(response){
		//  prompt(response)
		    if(response != 'error'){
		      window.location.href = window.location.href;
		      }else{
		      alert(response)
		      }
		  }
	  
	  
	  });
	  //return true;
      
      }
  }
  }
  }
</script>
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
.ui-timepicker-list{
list-style:none;
max-height:80px;
overflow-y:scroll;
z-index:9999;
background-color:#fff;
position:relative;
left:-10px;
width:70px;
}
.button input {
  border: 0 none;
  cursor: pointer;
  display: block;
  margin: 0;
  opacity: 0;
  padding: 0;
  left:0px !important;
  position: absolute;
  top: 0px!important;
  width: 100px;
  height:70px;
}
</style>
<?php
if(!empty($_POST['name'])){
  if(!empty($_POST['delete_game'])){
  
  
  }else if(!empty($_POST['edit_game'])){
  
  }else if(!empty($_POST['add_game'])){
  
  
  }
  
}

?>
<!--[if !IE]>start section content top<![endif]-->
                                <div class="sct">
                                    <div class="sct_left">
                                        <div class="sct_right">
                                            <div class="sct_left">
                                                <div class="sct_right">
                                                    <div class="categoryorder">
                                                       
                                                    </div>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                                <?php //if(($totalcat<=0 && !$total) or ($total<=0 && !totalcat)) { ?>
                                                                <!--<ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No product To Display</strong></li>
                                                                </ul>-->
                                                                    <?php //}else { 
                                                                    $uniqid = uniqid();
                                                                   
                                                                    ?>
                                                                
                                                                <table cellpadding="0" cellspacing="0" width="1500px">
                                                                    <tbody>
                                                                       
                                                                        <tr>
									      <table style="width:1500px;">
											<tbody>
											  <tr>
											    <th>Name</th>
											    <th>Cost Per Card</th>
											    <th>Jackpot</th>
											    
											    <th>Min # of Cards Per Person</th>
											    <th>Max # of Cards Per Person</th>
											    <th>Game Start Time </th>
											    <th>Min # of Players</th>
											    <th></th>
										    
											  </tr>
											 
											     <?php
											     $sql = db_query("select * from bingo_games where finished != 2 order by date, time_b, id desc");
											     while($row = db_fetch_array($sql)){
											     $uniqid = uniqid();
											      if($row['finished'] == '1'){
                                                                    
												  $status_css = 'background-color:red;color:#fff;height:100%;padding:20px 0 0px 0;';
											      }else{
											      
												if(db_num_rows(db_query("select * from bingo_numbers where bingo_id = '$row[id]'")) >= 1 | db_num_rows(db_query("select * from bingo_user_data where instance = '$row[id]'")) >= 1){
												$status = 'disabled';
												    $status_css = 'background-color:green;color:#fff;height:150px;padding:20px 0 0px 0;';
												
												}else{
												  $status_css = '';
												}
												echo db_error();
											      }
											     ?>
											     <form method="post" action="javascript: verify_game('<?php echo $uniqid; ?>');" id="<?php echo $uniqid; ?>" name="bingo_<?php echo $uniqid; ?>" style="<?php echo $status_css;?>" class="<?php echo $status; ?>">
											<?php
											if($status == 'disabled'){
											?>
											<input type="hidden" value="<?php echo $row['id']; ?>" name="bingo_id" />
											<input type="hidden" name="running" value="true" />
											
											
											<?php } ?>
											     <tr style="<?php echo $status_css;?>" >
												   <td style="<?php echo $status_css;?>">
												<input type="text" name="name" id="name_<?php echo $uniqid; ?>" value="<?php echo $row['name'];?>" />
											    </td>
											    <td style="<?php echo $status_css;?>">
												<ul>
												  <li style="display:inline;">
												    <input type="text" id="cost_per_card_<?php echo $uniqid; ?>" name="cost_per_card" value="<?php echo $row['cost_per_card']; ?>" />
												  </li>
												  <li style="display:inline;">
												    <select id="which_to_take" name="which_to_take">
													<option value="free_bids" <?php if($row['which_to_take'] == 'free_bids'){ echo 'selected'; } ?>>Free Bids</option>
													<option value="final_bids" <?php if($row['which_to_take'] == 'final_bids'){ echo 'selected'; } ?>>Actual Bids</option>
												    </select>
												  </li>
												</ul>
											    </td>
											  
											    <td style="<?php echo $status_css;?>"><div id="edit_jackpots_<?php $uinique = uniqid(); echo $row['id']; ?>">
											    <?php
											    $_REQUEST['id'] = $row['id'];
											    include("$BASE_DIR/include/addons/bingo/backendadmin/jackpots.php");
											    ?>
											    </div>
												<select id="jackpots_<?php echo $uniqid; ?>" name="jackpots" onchange="choose_jackpots(<?php echo $row['id']; ?>);">
												  <option value="">Select</option>
												  <option value="products" <?php if(!empty($row['productID'])){  echo 'selected'; } ?>>Product</option>
												  <option value="percent" <?php if(empty($row['productID'])){  echo 'selected'; } ?>>Percent of purse</otpion>
												</select>
												<script>
												    function choose_jackpots(id){
													    $.ajax({
														    url: '<?php echo $SITE_URL;?>/include/addons/bingo/backendadmin/jackpots.php',
														    data: { 'jackpots' : $('#jackpots').val(), id: id },
														    success: function(response){
													             $('#edit_jackpots_' + id).html(response);
														    }
													    });
												      }
												      
												</script>
														      
											    </td>
											    <td style="<?php echo $status_css;?>">
												  <input type="text" name="min_cards" id="min_cards_<?php echo $uniqid; ?>" value="<?php echo $row['min_cards']; ?>" />
											    </td>	
											    <td style="<?php echo $status_css;?>">
												  <input type="text" name="max_cards" id="max_cards_<?php echo $uniqid; ?>" value="<?php echo $row['max_cards']; ?>" /><span style="font-size:10px;">25 Max</span>
											    </td>	
											    <td style="<?php echo $status_css;?>">
												  
												  <?php $days = array("S" => "Sunday", "M" => "Monday", "T" => "Tuesday", "W" => "Wednesday", "Th" => "Thursday", "F" => "Friday", "Sa" => "Saturday"); ?>
												      <ul>
													<li style="display:inline;float:left;">
													  <ul style="list-style-type:none;" >
													  
													  
													      <li><input class="time_b" type="text" id="time_b_<?php echo $uniqid; ?>" name="time_b" autocomplete="off" value="<?php echo $row['time_b']; ?>"></li>
												    <li><b>Date</b></li>
													      <li>
													      
													      <input id="day_once_<?php echo $uniqid; ?>" name="day_once" value="<?php $date_g = explode("-", $row['date']); echo $date_g[1] . '/' . $date_g[2] . '/' . $date_g[0]; ?>" class="day_once" /></li>
													    <script>
														$(document).ready(function(){
														    $('#time_b_<?php echo $uniqid; ?>').timepicker({ 'timeFormat': 'H:i:s', step: 5 });
														});
													    </script>
													  </ul>
													</li>
												    <!--  <li style="display:inline;float:right;">
													     <ul style="list-style-type:none;" >
														
														    <li style="padding-left:30px;"><b>Or Every</b></li>
														    <?php
														    
														    $days_set = explode(":", $row['days']);
														   
														      foreach($days as $key => $day){
														      ?>
														      <li><?php echo $day; ?> <input type="checkbox" name="day[]" id="day[]" value="every <?php echo $key;?>" style="float:right;" <?php if(in_array("every $key", $days_set)){ echo 'checked'; } ?> />
														      <?php
														      }
														    ?>
														</ul> 
													      </li>-->
												  
												
												    
												    </ul>
												      
											    </td>
											  <td  style="<?php echo $status_css;?>">
											  <span>
												    <select id="min_players_<?php echo $uniqid; ?>" name="min_players" class="min_players" style="min-width:100px!important;">
													  <option value="">Select</option>
													  <?php
													  $r = 1;
													  while($r <= 1000){
													  ?>
													  <option value="<?php echo $r;?>" <?php if($row['min_players'] == $r){ echo 'selected'; } ?>><?php echo $r; ?></option>
													  
													  <?php
													  $r++;
													  }
													  ?>
													</select>
											    </span>
											  </td>		
		  <input type="hidden" name="plugin" id="plugin" value="<?php echo $_REQUEST['plugin']; ?>" />
											    <input type="hidden" id="page" name="page" value="<?php echo $_REQUEST['page']; ?>" />
											    <td style="<?php echo $status_css;?>">
												  <span class="button send_form_btn"><span><span><?php echo 'Edit Game'; ?></span></span><input type="submit">
												  <input type="hidden" name="<?php echo 'editgame'; ?>" id="editgame_<?php echo $row['id'];?>" <?php echo $status; ?>
												  /></span>
												  <?php if($status != 'disabled'){ ?>
												  <br />
												   <span class="button send_form_btn" id="deletegame_<?php echo $row['id'];?>" onclick="javascript:delete_game('<?php echo $SITE_URL;?>/include/addons/bingo/backendadmin/submit_game.php?deletegame=true&plugin=<?php echo $_REQUEST['plugin'];?>&page=<?php echo $_REQUEST['page'];?>&name=<?php echo $row['name'];?>');"><span><span><?php echo 'Delete Game'; ?></span></span></span>
												  <?php } ?>
											    </td>
											  </tr>
											     </tr>
											     </form>
											     <?php
											     }
											     ?>
											  
										</table>
										
									  </tr>
                                                                          <tr style="<?php echo $status_css;?>">
									      <td clospan="8" style="<?php echo $status_css;?>">
									    
                                                                            
                                                                            <!-- DISPLAY THE SUBCATEGORIES AND ON CLICK GO TO SUB CATEGORIES -->
                                                                                <?php
                                                                                if($totalcat!="") {
                                                                                    while($catdisp = db_fetch_array($result)) {

                                                                                    $pr_count = db_num_rows(db_query("select * from products where categoryID = $catdisp[categoryID]"));
                                                                                    $uniqid = uniqid();
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
											   
											    <th>Game Start Time </th>
											    <th></th>
										    
											  </tr>
											  <tr style="<?php echo $status_css;?>" >
											    <td style="<?php echo $status_css;?>">
												<input type="text" name="name" id="name_<?php echo $uniqid; ?>" />
											    </td>
											    <td style="<?php echo $status_css;?>">
												<ul>
												  <li style="display:inline;">
												    <input type="text" id="cost_per_card_<?php echo $uniqid; ?>" name="cost_per_card" value="10" />
												  </li>
												  <li style="display:inline;">
												    <select id="which_to_take" name="which_to_take">
													<option value="free_bids">Free Bids</option>
													<option value="final_bids">Actual Bids</option>
												    </select>
												  </li>
												</ul>
											    </td>
											 
											    <td style="<?php echo $status_css;?>"><div id="edit_jackpots_<?php echo $uniqid; ?>" style="<?php echo $status_css;?>"></div>
												<select id="jackpots" name="jackpots" onchange="choose_jackpots();">
												  <option value="">Select</option>
												  <option value="products">Product</option>
												  <option value="percent">Percent of purse</otpion>
												</select>
												<script>
												    function choose_jackpots(id){
													    $.ajax({
														    url: '<?php echo $SITE_URL;?>/include/addons/bingo/backendadmin/jackpots.php',
														    data: { 'jackpots' : $('#jackpots').val(), id: id },
														    success: function(response){
															$('#edit_jackpots').html(response);
														    }
													    });
												      }
												</script>
														      
											    </td>
											    <td style="<?php echo $status_css;?>">
												  <input type="text" name="min_cards" id="min_cards_<?php echo $uniqid; ?>" value="1" />
											    </td>	
											    <td style="<?php echo $status_css;?>">
												  <input type="text" name="max_cards" id="max_cards_<?php echo $uniqid; ?>" value="5" /><span style="font-size:10px;">25 Max</span>
											    </td>	
											    <td style="<?php echo $status_css;?>">
												  
												  <?php $days = array("S" => "Sunday", "M" => "Monday", "T" => "Tuesday", "W" => "Wednesday", "Th" => "Thursday", "F" => "Friday", "Sa" => "Saturday"); ?>
												      <ul>
													<li style="display:inline;float:left;">
													  <ul style="list-style-type:none;" >
													  
													  
													      <li><input class="time_b" type="text" id="time_b_<?php echo $uniqid; ?>" name="time_b" autocomplete="off"></li>
												    <li><b>Date</b></li>
													      <li><input id="day_once_<?php echo $uniqid; ?>" name="day_once" class="day_once" /></li>
													    <script>
														
														$('.time_b').timepicker({ 'timeFormat': 'H:i:s', step: 5 });
													    
													    </script>
													  </ul>
													</li>
													  <!--   <li style="display:inline;float:right;">
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
											    <td style="<?php echo $status_css;?>">
												  <span>
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
												  </span>
											    </td>
											    <td style="<?php echo $status_css;?>">
											    <input type="hidden" name="plugin" id="plugin" value="<?php echo $_REQUEST['plugin']; ?>" />
											    <input type="hidden" id="page" name="page" value="<?php echo $_REQUEST['page']; ?>" />
												  <span class="button send_form_btn"><span><span><?php echo ($_GET['game_edit'] != "") ? 'Edit Game' : 'Add Game'; ?></span></span><input type="submit" >
												  <input type="hidden" name="<?php echo ($_GET['game_edit'] != "") ? 'editgame' : 'addgame'; ?>" id="editgame_<?php echo $row['id'];?>" /></span>
											    </td>
											  </tr>
											</tbody>
											</table>
											</form>
                                                                                    <?
                                                                                }
                                                                            }
                                                                            ?>
                                                                        <tr>
                                                                            <td colspan="8" style="<?php echo $status_css;?>">
                                                                                <!--END DISPLAY CATEGORIES-->
                                                                            </td>
                                                                        </tr>

                                                                      
                                                                            <tr style="<?php echo $status_css;?>">
                                                                            <td colspan="8" style="<?php echo $status_css;?>">
                                                                            <?php $uniqid = uniqid(); ?>
                                                                      
                                                                            
                                                                            
                                                                            
                                                                            <div id="game_editor">
                                                                            
                                                                            </div>
										
                                                                            <a href="javascript:;" onclick="add_game('<?php echo $uniqid; ?>');">Add Game</a>
                                                                            </td>
                                                                          </tr>
                                                                    </tbody>
                                                                </table>
							    </div>
                                                        </div>
                                                        <!--[if !IE]>end table_wrapper<![endif]-->
                                                    </div>
						    <script>
							function add_game(unique){
							
							    $.ajax({
								    url: "<?php echo $SITE_URL; ?>include/addons/bingo/backendadmin/add_game.php?verified=true&unique=" + unique,
								    type: "get",
								    dataType: "html",
								    success: function(response){
									$('#game_editor').html(response);
									
								    }
								   });
							  }
						    </script>
								    
                                                    <?php if($total) { ?>
                                                    <!--[if !IE]>start pagination<![endif]-->
                                                    <div class="pagination">
                                                        <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpages; ?></span>
                                                        <ul class="pag_list">
                                                                <?php
                                                                if($PageNo>1) {
                                                                    $PrevPageNo = $PageNo-1;
                                                                    ?>
                                                            <li><a href="manageproducts.php?order=<?php echo $iid ?>&pgno=<?php echo $PrevPageNo; ?>&catID=<?echo $cID; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                    <?php } ?>

                                                                <?php
                                                                $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                $pageTo=$PageNo+3>$totalpages?$totalpages:$PageNo+3;
                                                                for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                    ?>
                                                                    <?php if($i==$PageNo) { ?>
                                                            <li><a href="manageproducts.php?order=<?php echo $iid ?>&pgno=<?php echo $i;?>&catID=<?php echo $cID; ?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                        <?php }else {?>
                                                            <li><a href="manageproducts.php?order=<?php echo $iid ?>&pgno=<?php echo $i;?>&catID=<?php echo $cID; ?>"><?php echo $i; ?></a></li>
                                                                        <?php }
                                                                }
                                                                ?>
                                                                <?php
                                                                if($PageNo<$totalpages) {
                                                                    $NextPageNo = 	$PageNo + 1;
                                                                    ?>
                                                            <li><a href="manageproducts.php?order=<?php echo $iid ?>&pgno=<?php echo $NextPageNo;?>&catID=<?php echo $cID; ?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                                    <?php } ?>
                                                        </ul>

                                                    </div>
                                                    <!--[if !IE]>end pagination<![endif]-->
                                                        <?php }?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
				    $('.time_b').each(function() {
					id = $(this).attr('id');
					$('#' + id).timepicker({ 'timeFormat': 'H:i:s', steps: 15 });
				    });
				    $('.day_once').each(function() {
					id = $(this).attr('id');
					$('.day_once').datepicker({});
				     });
				</script>
                                <!--[if !IE]>end section content top<![endif]-->
                                <!--[if !IE]>start section content bottom<![endif]-->
                                <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                
                                
                                <input type="hidden" id="hidden_date" name="hidden_date" value="<?php echo strtotime(date("H:i:s") . ' ' .date("Y-m-d")); ?>" />