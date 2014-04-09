<?php
include("../../../config/config.inc.php");

if(!empty($_REQUEST['date'])){
  $date = date("Y-m-d", $_REQUEST['date']);
}
$extra = '';

$game = db_fetch_object(db_query("select * from bingo_games where bingo_games.id='$_REQUEST[id]'" . $extra . " order by id desc limit 1"));

if($game->max_cards == 0 ){

$game->max_cards = 1000;
}

$game_data_user = db_fetch_array(db_query("select count(distinct(card)) from bingo_user_data where instance='$_REQUEST[id]' and userid='$_SESSION[userid]'"));
					$sql_u = db_query("select distinct(userid) from bingo_user_data where instance = " . $game->id);
							$total_cards = 0;
							
					while($row_u =db_fetch_array($sql_u)){
						
							    $count_cards = db_fetch_array(db_query("select count(distinct(card)) from bingo_user_data where instance = " . $game->id . " and userid=$row_u[userid]"));
							   
							    $total_cards = number_format($total_cards, 0, '', '') + number_format($count_cards[0], 0 , '', '');
							}
							
							
		$jackpot = array();
		$game_data = array();
		$game_data[0] = $total_cards;
		


$jackpots = db_query("select * from bingo_jackpots where bingo_id = $_REQUEST[id] order by id asc");

while($row_j = db_fetch_array($jackpots)){


    $jackpot['place'][$row_j['place']] = array(
					    "percent" => $row_j['reward_points'],
					    "cards_bought" => $game_data[0],
					    "value" => ceil(($game_data[0] * $game->cost_per_card) * $row_j['reward_points'] / 100), 
					    "reward_with" => ucwords(str_replace("_", " ", $row_j['which_to_give']))
					    );
}


if(db_num_rows(db_query("select * from bingo_numbers where instance = '$_REQUEST[instance]'")) >= 1){
echo "<h2>Sorry this game has already started, please refresh your page to get the next game time.</h2>";

exit;
}else{
?>

<p>
      <span style="float:left;font-weight:bold;">
      How many cards would you like to buy?
      </span>
</p>
<p class="clear"></p>
<p>
     <span style="float:left;">
     <datalist id="powers">
	  <?php
	  $game->max_cards = $game->max_cards - $game_data_user[0];
	  
	  $i = $game->min_cards;
	  while($i >= $game->min_cards & $i <= $game->max_cards){
	  ?>
	    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
	  <?php $i++;
	  } ?>
      </datalist>
      <input type="range" id="my_cards" name="my_cards" value="<?php echo $game->min_cards; ?>" min="<?php echo $game->min_cards; ?>" max="<?php echo $game->max_cards; ?>" list="powers" />
    </span>
	  
      <span style="float:right;" id="count_cards"></span>
      <input type="hidden" name="cost_per_card" id="cost_per_card" value="<?php echo $game->cost_per_card; ?>" />
      <input type="hidden" name="which_to_take" id="which_to_take" value="<?php echo $game->which_to_take; ?>" />
      <input type="hidden" name="date" id="date" value="<?php echo $_REQUEST['date']; ?>" />    
      <input type="hidden" name="bingo_id" id="bingo_id" value="<?php echo $_REQUEST['id']; ?>" /> 
</p>
<p class="clear"></p>
<p>
      <span style="float:left;font-weight:bold;">
      Cost: 
      </span>
      <span style="float:right;">
	  <span id="final_cost" style="display:inline;"></span>
	  <span style="display:inline;">
	  <?php if($game->which_to_take == 'free_bids'){ echo 'Free Points'; } else { echo "Donations"; } ?>
	  </span>
      </span>
      
      
</p>
<p class="clear"></p>

<p>
      <span style="float:left;font-weight:bold;">
      Current Jackpots
      </span>
</p>
<p class="clear"></p>
<p style="text-align:left;">
      <ul style="text-align:left;">
      <?php
     
      foreach($jackpot['place'] as $key => $value){
	
	  echo "<li id=\"payout_$key\" class=\"payouts\" alt=\"" . $jackpot['place'][$key]['percent'] . "\" title=\"" . $jackpot['place'][$key]['cards_bought'] . "\">" . ucfirst($key) . " Place: <span class=\"payout\">" . $jackpot['place'][$key]['value'] . "</span> " . $jackpot['place'][$key]['reward_with'] . "</li>";
      }
      ?>
      </ul>
</p>
<p>
<input type="submit" class="button" id="buy_cards" name="buy_cards" value="Buy Cards" style="position:relative;left:180px;top:-50px;" />
</p>

<ul id="cards_area" style="max-width: 490px; max-height: 280px; overflow-y: scroll;position:relative;top:-50px;">

</ul>
<script>
function create_blank_card(num){
  var card = '';
  
  for(i=0; i < num; i++){

      card += '<li style="float:left;background-color: #cacaca;color:#fff!important;font-size:16px;max-width:120px!important;height:130px;border-radius:6px;margin: 5px 5px 5px 5px;">';
      card += '<ul style="list-style:none;color:#fff!important;font-weight:bold;padding:5px 0 5px 0;"><li style="display:inline;width:20px;padding: 0 5px 0 5px;">B</li><li style="display:inline;width:20px;padding: 0 5px 0 5px;">I</li><li style="display:inline;width:20px;padding: 0 5px 0 5px;">N</li><li style="display:inline;width:20px;padding: 0 5px 0 5px;">G</li><li style="display:inline;width:20px;padding: 0 5px 0 5px;">O</li></ul>';
      card += '<ul style="background-color: #FFFFFF !important;max-width: 100px !important;border-left: 2px solid #cacaca;border-right: 2px solid #cacaca;">'; 
      for(p=1; p<=25; p++){
	if(p == 13){
	    card += '<li style="float:left;width:19px!important;border-right:1px solid #000;border-bottom:1px solid #000;height:18px!important;"></li>';
	}else{
	  card += '<li style="float:left;width:19px!important;border-right:1px solid #000;border-bottom:1px solid #000;">' + Math.floor((Math.random()*99)+1)+ '</li>';
	}
	if(p % 5 == 0){
	card += '<li class="clear"></li>';
	}
      }
      card += '</ul>';
      card += '</li>';
  }
return card;
}

$('#final_cost').html( $('#my_cards').val() * $('#cost_per_card').val() );
$('#count_cards').html( $('#my_cards').val() + ' Cards' );

function update_card_info(){

    $('#final_cost').html( $('#my_cards').val() * $('#cost_per_card').val() )
    $('#count_cards').html( $('#my_cards').val() + ' Cards' );
    $('#cards').html('');
   
	card = create_blank_card($('#my_cards').val());
	
	$('#cards_area').html(card);
	$('.payouts').each(function(){

	    percent = $(this).attr('alt');
	    id = $(this).attr('id');
	    exist_v = parseInt($(this).attr('title'));
	    cards = parseInt($('#my_cards').val());
	    
	    total_cards = parseInt(cards) + parseInt(<?php echo $total_cards;?>);
	   
	    
	    total_p = parseInt(total_cards)  * parseInt($('#cost_per_card').val());
	
	    payout = parseInt(total_p) * parseInt(percent) / 100;
	
	    $('#' + id + ' .payout').html(Math.ceil(payout));
	
	})
	
     
}

</script>
<?php } ?>