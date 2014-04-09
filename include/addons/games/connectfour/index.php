<?php
$game_server = 'http://pennyauctionsoftdemo.com';
include("$BASE_DIR/include/addons/games/api/connect4.config.inc.php");
$_REQUEST['domain'] = str_replace("www.", "", $_REQUEST['domain']);
?>
<style>
#game_area {
clear: both;
float: right !important;
height: auto !important;

position: absolute !important;
top: 50px !important;
z-index: 10000 !important;
}   
#myqb-wrap {
  padding: 0 25px 0 268px;
  min-height: 700px;
}

.black_chip {
display:none;
}
#board_wrapper { /* 84 x 6 = 504 */
background-color: white;
border-left: 1px solid #000000;
border-radius: 8px 8px 8px 8px;
border-top: 1px solid;
box-shadow: 6px 6px 6px #666666;
height: 452px;
padding: 8px 4px 2px 4px;

}

div.row_wrapper {
	height: 60px;
	margin: 0 0 0 4px;
	clear:both;
}

div.row_wrapper div { /* total width 104 */
background: url("http://pennyauctionsoftdemo.com//include/addons/games/connectfour/image/connect4.png");
background-repeat:no-repeat;
background-position: left top;
background-color:transparent;
border: 2px inset #3387A2;
float: left;
height: 60px;
width: 60px;


	
}
.ui-widget-content {
  background: url("images/ui-bg_flat_75_ffffff_40x100.png") repeat-x scroll 50% 50% #FFFFFF;
  border: 1px solid #DDDDDD;
  color: #444444;
  min-height: 200px;
}
.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset {
  float: right;
  position: relative;
  top: 150px;
}
.ui-widget-content a {
  color: #444444;
  text-decoration: underline;
}
div.row_wrapper:nth-child(1) {
	
}

#dropspots {
	background-color: #fff;
}


canvas, .can_place canvas {
background-color:white!important;
}

canvas.red_chip {
	position: absolute;
	top: 0px;
	left: -90px;
}

canvas.black_chip {
	position: absolute;
	top: 0px;
	left: 500px;
}

input[type="button"] {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf) );
	background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf');
	background-color:#ededed;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #dcdcdc;
	display:inline-block;
	color:#777777;
	font-family:arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:1px 1px 0px #ffffff;
	position: absolute;
	left: -182px;
}

#reset {
	top: 592px;
	left: 0px;
	padding:6px 39px 6px 30px;
}

#undo {
	top: 592px;
	left: 160px;
}

input[type="button"]:hover, input[type="button"]:active {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed) );
	background:-moz-linear-gradient( center top, #dfdfdf 5%, #ededed 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed');
	background-color:#dfdfdf;
	cursor: pointer;
}
#game_info {
left: 200px !important;
position: relative !important;
top: -350px !important;
}
#game_info h3{
width:200px;

}
audio {
	display: none;
}
</style>

<script>
var debug = '';


	function send_winner_now(color){
	
	  
	
	}
	var check_for_win = function(square, color) {
		
		var four_in_a_row_check = function() {
			if ($('#' + i).hasClass(color)) {
				win_count += 1;
				if (win_count == 4) { send_winner_now(color); return true; }
			} else {
				win_count = 0;
			}
		}
		
		var check_horiz_win = function (color, square) {
			win_count = 0;
			for (i = square; i < square + 7; i += 1) {
				if (four_in_a_row_check()) {
				
					return true;	
				}
			}
		}
		
		// check for vertical win
		var original_square = square;
		while (square > 7) {
			square -= 7;
		}
		for (i = square; i < 43; i += 7) {
			if (four_in_a_row_check()) {
			   
				return true;
			}
		}
		var square = original_square;
		
		// check for horizontal win
		var left_squares = [1, 8, 15, 22, 29, 36];
		var in_array = jQuery.inArray(square, left_squares);
		
		if (in_array > -1) {
			if (check_horiz_win(color, square)) {
			 
				return true;
			}
		} else {
			while (result = jQuery.inArray(square, left_squares) == -1) {
				square -= 1;
				if (result = jQuery.inArray(square, left_squares) !== -1) {
					if (check_horiz_win(color, square)) {
						return true;	
					}
				}
			}
		}
		
		// check for diagonal win
		win_count = 0;
		var square = original_square;
		var top_left_bottom_right = [];
		
		//check from top left to bottom right first		
		while ((square > 8 && square < 43)) { // get squares left of current one
			var square = square - 8;
			var iterated_square = $('#' + (square));
			var id = parseInt(iterated_square.attr('id'));		
			if  (iterated_square.hasClass(color)) {
				top_left_bottom_right.push(id);
			}		
		}
		var square = original_square;
		top_left_bottom_right.push(parseInt($('#' + (square)).attr('id'))); // add current square to array
		
		while ((square > 0 && square < 35) && $('#' + square).hasClass(color)) { // get squares right of current one
			var square = square + 8;
			var iterated_square = $('#' + (square));
			var id = parseInt(iterated_square.attr('id'));		
			if  (iterated_square.hasClass(color)) {
				top_left_bottom_right.push(id);
			}
		}
		
		top_left_bottom_right.sort(function(a,b) { return a-b } ); // sort numerically ascending
		
		for (j = 0; j < top_left_bottom_right.length; j++) {
			i = top_left_bottom_right[j];
			if (four_in_a_row_check()) {
				return true;
			}
		}
		
		// now check from bottom left to top right
		win_count = 0;
		var square = original_square;
		var bottom_left_top_right = [];
			
		while ((square > 7 && square < 43)) { // get squares right of current one	
			var square = square - 6;
			var iterated_square = $('#' + (square));
			var id = parseInt(iterated_square.attr('id'));		
			if  (iterated_square.hasClass(color)) {
				bottom_left_top_right.push(id);
			}	
		}
		var square = original_square;
		bottom_left_top_right.push(parseInt($('#' + (square)).attr('id'))); // add current square to array
		
		while ((square > 0 && square < 35) && $('#' + square).hasClass(color)) { // get squares left of current one
			var square = square + 6;
			var iterated_square = $('#' + (square));
			var id = parseInt(iterated_square.attr('id'));		
			if  (iterated_square.hasClass(color)) {
				bottom_left_top_right.push(id);
			}	
		}
		
		bottom_left_top_right.sort(function(a,b) { return a-b } ); // sort numerically ascending
		
		for (j = 0; j < bottom_left_top_right.length; j++) {
			i = bottom_left_top_right[j];
			if (four_in_a_row_check()) {
				return true;
			}
		}
		return false; // no horizontal, vertical or diagonal win found
	}
	function congratulate(color) {
		$('.chip_holder').removeClass('red_chip');
		$('.chip_holder').removeClass('cannot_place');
		$('.chip_holder').removeClass('blue_chip');
		$('.chip_holder').removeClass('can_place');
		$('.chip_holder').removeClass('droppable');
		
		
		
		//Add invitation to here
		$.ajax({
			url: '<?php echo $game_server; ?>/include/addons/games/connectfour/check_game_data.php',
			data: { winner: $('#me').val(), gameID: $('#game_instance_id').val(), domain: $('#domain').val() , room : $('#game_room').val() },
			dataType: 'jsonp',
			crossDomain: true,
			type: 'GET',
			
			
			success: function(response){
			
			
					if(!empty(response.final_bids)){
					    $('#bids_count_tb').html(response.final_bids);
					    $('#bids_count').html(response.final_bids);
					}
					if(!empty(response.free_bids)){
					    $('#free_bids_count_tb').html(response.free_bids);
					    $('#free_bids_count').html(response.free_bids);
					
					}
					showAlertBox('Game Over. <br />You Won!<br /><a href="javascript:;" onclick="invite(\'' + $('#opponent').val() + '\');">Invite </a>' + $('#opponent').val() + ' To another game');
					
					
					setTimeout("window.location.href = window.location.href;", 10000);
			   return complete = 'true';
			
			}
		      });
		    
		     /* if(!empty(complete)){
			//setTimeout("clear_game('" + $('#me').val() + "', '" + $('#domain').val() + "');", 10000);
			$.ajax({ 
				url: 'http://' + $('#domain').val() + '/include/addons/games/checkbids.php?',
				data: { gameID: $('#game_instance_id').val(), username : $('#me').val(), winner: $('#me').val(), domain: $('#domain').val() , opponent: $('#opponent').val(), room : '<?php echo $_REQUEST['room'];?>' },
				type: 'post',
				dataType: 'json',
				crossDomain: true,
				success: function(response){
				
				
						
				    }
				});
			}*/
	  
		
	}
	function game_over(color){
	var complete;
	
	    $('.chip_holder').removeClass('red_chip');
		$('.chip_holder').removeClass('cannot_place');
		$('.chip_holder').removeClass('blue_chip');
		$('.chip_holder').removeClass('can_place');
		$('.chip_holder').removeClass('droppable');

	  
	    
		  $.ajax({
			url: '<?php echo $game_server; ?>/include/addons/games/connectfour/check_game_data.php',
			data: { loser: $('#me').val(), username: $('#me').val(), gameID: $('#game_instance_id').val(), domain: $('#domain').val(), room: $('#game_room').val() },
			type: 'GET',
			crossDomain: true,
			dataType: 'jsonp',
			
			
			success: function(response){
			
					//prompt(response.url);
				      if(!empty(response.final_bids)){
					  $('#bids_count_tb').html(response.final_bids);
					  $('#bids_count').html(response.final_bids);
				      }
				      if(!empty(response.free_bids)){
					  $('#free_bids_count_tb').html(response.free_bids);
					  $('#free_bids_count').html(response.free_bids);
					  
				      
				      }
					showAlertBox('Game Over. ' + $('#opponent').val() + ' Wins!<br /><a href="javascript:;" onclick="invite(\'' + $('#opponent').val() + '\');">Invite </a>' + $('#opponent').val() + ' To another game');
					
					  setTimeout("window.location.href = window.location.href;", 10000);
					
					
			 return complete = 'true';
			
			}
		      });
		     
		      
		      /*if(!empty(complete)){
			  //Add invitation to here
			  $.ajax({ 
			      url: 'http://' + $('#domain').val() + '/include/addons/games/checkbids.php?',
			      data: { gameID: $('#game_instance_id').val(), username : $('#me').val(), domain: $('#domain').val() , loser: $('#me').val(), room : $('#room').val() },
			      type: 'GET',
			      dataType: 'json',
			      crossDomain: true,
			      success: function(response){
				if(!empty(response.game_result)){
			      
			      
			      
			      }
			      prompt(response.url + ' ' + response.final_bids);
					
				      if(!empty(response.final_bids)){
					  $('#bids_count_tb').html(response.final_bids);
					  $('#bids_count').html(response.final_bids);
				      }
				      if(!empty(response.free_bids)){
					  $('#free_bids_count_tb').html(response.free_bids);
					  $('#free_bids_count').html(response.free_bids);
					  
				      
				      }
					showAlertBox('Game Over. ' + $('#opponent').val() + ' Wins!<br /><a href="javascript:;" onclick="invite(\'' + $('#opponent').val() + '\');">Invite </a>' + $('#opponent').val() + ' To another game');
					$('#alert_message button').click(function(){
					
					//clear_game($('#me').val(), $('#domain').val());
					
					});
				  }
			      });
			      
			      
			      }*/
			
			 
		 
		
	
	}

	function create_circle(index, color) {
			
		if (color == 'red') {
			color = 'rgb(255, 0, 0)';
			//$('#' + index).removeClass('me');
		} else if (color == 'blue') {
			color = 'blue';
			//$('#' + index).addClass('him');
		} else {
		        color = 'white';
		}
		
		
		
		//prompt(color);
		var circle = document.getElementsByTagName('canvas')[index].getContext('2d');
		circle.beginPath();
		if (color != 'white') {
			circle.arc(30, 30, 30, 0, 2 * Math.PI, false);
		} else {
			circle.arc(30, 30, 39.5, 0, 2 * Math.PI, false);
		}
		
		$('#' + index).css('backgroundColor', '#fefefe');
		circle.fillStyle = color;
		circle.fill();
		//check_for_win();
		var result = check_for_win(index, 'red_chip');
				
				if (result == true) {
					congratulate('red_chip');
				}
		var result = check_for_win(index, 'blue_chip');
				
				if (result == true) {
					game_over('blue_chip');
				}
	}
function remove_circles() {
		
		color = 'white';
		//prompt(color);
		$('.chip_holder').each(function(item){
		
		
		  id=$(this).attr('id');
		    if($('#' + id).hasClass('red_chip') | $('#' + id).hasClass('blue_chip')){
			  $('#' + id).removeClass('red_chip');
			  $('#' + id).removeClass('blue_chip');
			  $('#' + id).removeClass('cannot_place');
			  $('#' + id).removeClass('can_place');
			  $('#' + id).css('opacity', '1.0');
			    var circle = document.getElementsByTagName('canvas')[parseInt(id - 1)].getContext('2d');
			    circle.beginPath();
			    
				    circle.arc(30, 30, 39.5, 0, 2 * Math.PI, false);
			    
			    $('#' + index).css('backgroundColor', '#fefefe');
			    circle.fillStyle = color;
			    circle.fill();
		    }
	      });
		
		
	}
function refresh_game_play(gameID){
//checks for last move and updates jquery accordingly
	  $.ajax({
	      url: '<?php echo $game_server; ?>/include/addons/games/connectfour/check_game_data.php',
	      data: { gameID: gameID, init: 'check_move', username: $('#me').val()  },
	      dataType: 'jsonp',
	      crossDomain: true,
	      success: function(response){
	   //  prompt(response.final_bids);  	   
	// prompt(response.free_bids);
		 if(!empty(response.whos_turn)){
		
		    $('#whos_turn').val(response.whos_turn);
		   if(response.game != 'game over'){
		   
		    if(response.whos_turn == $('#me').val() ){
			for (index = 43; index < 84; index++) { // make chips
			    create_circle(index, 'red');
			     
				  
				  $('#' + index).addClass('draggable');
				  $('.red_chip').draggable({ disabled: false });
				  
				 //  prompt(response.final_bids);
				 //   prompt(response.free_bids);
			
				if(!empty(response.final_bids)){
				    $('#bids_count_tb').html(response.final_bids);
				    $('#bids_count').html(response.final_bids);
				}
				if(!empty(response.free_bids)){
				     $('#free_bids_count_tb').html(response.free_bids);
				     $('#free_bids_count').html(response.free_bids);
				
				}
			}
		    
		    }else{
			 $('.red_chip').draggable({ disabled: true });
			for (index = 64; index < 85; index++) { // make chips
			  //  create_circle(index, 'black');
			  //  $('#' + index).removeClass('draggable');
			}
		    
		    
		    }
		  }
		 }
		 // if(!empty(response.last_move)){
	
		      //move_player_peice(response.last_move);
		      $.each(response.chips.black,  function(i, item){
			  id = item;
			
			  create_circle(id -1, 'blue');
			  $('#' + id).removeClass('can_place');
			  $('#' + id).addClass('cannot_place');
			  $('#' + id).addClass('blue_chip');
			  //if(!$('#' + id).hasClass('cannot_place')){
			  // $('#' + parseInt(id - 7)).addClass('can_place');
			  //}
		      });
		      $.each(response.chips.red,  function(i, item){
			  id = item;
			  create_circle(id - 1, 'red');
			  $('#' + id).removeClass('can_place');
			  $('#' + id).addClass('cannot_place');
			  $('#' + id).addClass('red_chip');
			  //if(!$('#' + id).hasClass('cannot_place')){
			    //$('#' + parseInt(id - 7)).addClass('can_place');
			  //}
		      });
		      
		   
		   
		  //}
		  if(response.game == 'game over'){ 
		  
		      if(response.winner == $('#me').val()){
		      
			 congratulate('red_chip');
		      //Add invitation to here
		      }else{
		      
			game_over('blue_chip');
		      //Add invitation to here
		      }
		  
		  
		  }
		  if(response.game == 'true' | response.game == 'running' ){
			    Init_Connectfour();
			   // chat_boxes(response.opponents);
			   // refresh_game_play(gameID);
			  if(response.game != 'game over'){
			    setTimeout("refresh_game_play('" + gameID + "')", 1000);
			   }
		    }else{
			if(response.game != 'game over'){
			remove_circles();
			  setTimeout("refresh_game_play('" + gameID + "')", 1000);
		        }
		    }
		 }
	
	
	});
   

}
	

	function Init_Connectfour(){
	
	
	
	
	var find_landing_square = function (column_dropped_on) {
		//prompt(column_dropped_on);
		for (i = column_dropped_on + 35; i >= column_dropped_on; i -= 7) {
			var iterated_square = $('#' + i);
			var iterated_square_num = iterated_square.attr('id');
			
			if (!iterated_square.hasClass('cannot_place')) {				
				if (iterated_square_num > 35) {
					return ['395px', iterated_square_num];
				} else if (iterated_square_num > 28) {
					return ['332px', iterated_square_num];
				} else if (iterated_square_num > 21) {
					return ['268px', iterated_square_num];
				} else if (iterated_square_num > 14) {
					return ['204px', iterated_square_num];
				} else if (iterated_square_num > 7) {
					return ['140px', iterated_square_num];
				} else {
					return ['76px', iterated_square_num];
				}
			}
		}
	}
	

	
	
	
	
	$('.red_chip, .black_chip').addClass('draggable');

	$('.draggable').draggable({
		cancel: '.played',
		snap: ".droppable", 
		snapMode: "inner",
		snapTolerance: 30,
		containment: $('#game_area'),
		cursor: 'pointer',
		stack: 'canvas',
		axis: 'x',
		revert: 'invalid'
	});
		
	$('.droppable').droppable({
			
        drop: function(event, ui) {
        	
        	//$('canvas.last_played').removeClass('last_played');
			
			if ($(ui.draggable)) {
				
			/*	var current_color = 'red_chip';
				var next_color = 'black_chip';
				
				$('.' + current_color).draggable({ disabled: true });
				$('.' + next_color).draggable({ disabled: false });
			*/	
			
			var current_color = 'red_chip';
			
				var drop_square_number = parseInt($(this).attr('id'));
				
			//	$('#' + drop_square_number).addClass('me');
				
				if(!empty(debug)){
				    prompt(drop_square_number);
				}
				var landing_square_results = find_landing_square(drop_square_number);
				
				var distance          = landing_square_results[0];
				var square_to_land_on = parseInt(landing_square_results[1]);
				
				if(!empty(debug)){
				  prompt(square_to_land_on);
				}
				
				
				$(ui.draggable).animate(
					{ top:distance },
					300,
					'linear', 
					function() {
					piece_drop.play();
					}
				);
				
				
				$('.red_chip').draggable({ disabled: true });
				
				
				
				if ($('#' + square_to_land_on).attr('id') < 8) {
					$(this).droppable({ disabled: true });
					
				}
				       
					
					$.ajax({ 
					      url: '<?php echo $game_server; ?>/include/addons/games/connectfour/check_game_data.php',
					      data: { gameID: $('#game_instance_id').val(), username : $('#me').val(), domain: '<?php echo $_REQUEST['domain']; ?>', opponent: $('#opponent').val(), move: square_to_land_on },
					      type: 'get',
					      dataType: 'jsonp',
					      crossDomain: true,
					      success: function(response){
					    // prompt(response.final_bids);  	   
					    // prompt(response.free_bids); 
					      if(!empty(response.final_bids)){
						  $('#bids_count_tb').html(response.final_bids);
						  $('#bids_count').html(response.final_bids);
					      }
					      if(!empty(response.free_bids)){
						  $('#free_bids_count_tb').html(response.free_bids);
						  $('#free_bids_count').html(response.free_bids);
					      
					      }
					      
					      $('#whos_turn').val(response.whos_turn);
					      if($('#whos_turn').val() != response.whos_turn){
						showAlertBox('Please wait for ' + response.whos_turn + ' to make their move');
						  setTimeout(function()
							{

							  $('#alert_message').dialog('close');

							}, 5000);   
							if(response.whos_turn != $('#me').val()){
							    
							      for (index = 43; index < 84; index++) {
								$('.red_chip').draggable({ disabled: true });
							      }
							}else{
							      for (index = 43; index < 84; index++) {
								$('.red_chip').draggable({ disabled: false });
							      }
							}
						      
						      refresh_game_play(response.gameID);
					      }
					     }
					});
					
					
				
				
			
				
				
       		}
       			
   			$('#undo').click(function() {
				if (current_color == 'red_chip' && $(ui.draggable).hasClass('last_played')) {
					$(ui.draggable).animate({ top: '0px', left: '-90px' });
					$('#' + square_to_land_on).addClass('can_place').removeClass('cannot_place ' + current_color);
					$('#' + (square_to_land_on - 7)).removeClass('can_place');
					$('.' + current_color).draggable({ disabled: false });
					$('.' + next_color).draggable({ disabled: true });
					$(ui.draggable).removeClass('played last_played');
					
				} else if (current_color == 'black_chip' && $(ui.draggable).hasClass('last_played')) {
					$(ui.draggable).animate({ top: '0px', left: '600px' });
					$('#' + square_to_land_on).addClass('can_place').removeClass('cannot_place ' + current_color);
					$('#' + (square_to_land_on - 7)).removeClass('can_place');
					$('.' + current_color).draggable({ disabled: false });
					$('.' + next_color).draggable({ disabled: true });
					$(ui.draggable).removeClass('played last_played');
				}
			});
        	}
		});
		$(function mark_playable_squares() { // add 'can_place' class for bottom row
		for (i = 36; i < 43; i++) {
		    if(!$('#' + i).hasClass('cannot_place')){
			$('#' + i).addClass('can_place');
		    }
		}
		});
	    }
	    
$(document).ready(function() {
	
	var win_count = 0;
	var soundHandle = document.getElementById('piece_drop');
		soundHandle.src = '<?php echo $game_server;?>/include/addons/games/connectfour/sounds/piece-drop.wav';
	});	
	
	    

	




</script>
<div class="clear"></div>
<div id="wrapper_game">
	<div id="board_wrapper">
	      <div id="dropspots" class="row_wrapper">
		    <div id="1_chip_target" class="droppable"></div>
		    <div id="2_chip_target" class="droppable"></div>
		    <div id="3_chip_target" class="droppable"></div>
		    <div id="4_chip_target" class="droppable"></div>
		    <div id="5_chip_target" class="droppable"></div>
		    <div id="6_chip_target" class="droppable"></div>
		    <div id="7_chip_target" class="droppable"></div>
	      </div>
	<div id="a" class="row_wrapper">
		<div id="1" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="2" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="3" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="4" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="5" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="6" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="7" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
	</div>
	<div id="b" class="row_wrapper">
		<div id="8" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="9" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="10" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="11" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="12" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="13" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="14" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
	</div>
	<div id="c" class="row_wrapper">
		<div id="15" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="16" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="17" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="18" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="19" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="20" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="21" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
	</div>
	<div id="d" class="row_wrapper">
		<div id="22" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="23" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="24" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="25" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="26" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="27" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="28" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
	</div>
	<div id="e" class="row_wrapper">
		<div id="29" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="30" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="31" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="32" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="33" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="34" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="35" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
	</div>
	<div id="f" class="row_wrapper">
		<div id="36" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="37" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="38" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="39" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="40" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="41" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
		<div id="42" class="chip_holder">
		    <canvas width="60" height="60"></canvas>
		</div>
	</div>
	</div><!-- end board_wrapper -->
    <canvas width="60" height="60" id="43" class="red_chip"></canvas>
    <canvas width="60" height="60" id="44" class="red_chip"></canvas>
    <canvas width="60" height="60" id="45" class="red_chip"></canvas>
    <canvas width="60" height="60" id="46" class="red_chip"></canvas>
    <canvas width="60" height="60" id="47" class="red_chip"></canvas>
    <canvas width="60" height="60" id="48" class="red_chip"></canvas>
    <canvas width="60" height="60" id="49" class="red_chip"></canvas>
    <canvas width="60" height="60" id="50" class="red_chip"></canvas>
    <canvas width="60" height="60" id="51" class="red_chip"></canvas>
    <canvas width="60" height="60" id="52" class="red_chip"></canvas>
    <canvas width="60" height="60" id="53" class="red_chip"></canvas>
    <canvas width="60" height="60" id="54" class="red_chip"></canvas>
    <canvas width="60" height="60" id="55" class="red_chip"></canvas>
    <canvas width="60" height="60" id="56" class="red_chip"></canvas>
    <canvas width="60" height="60" id="57" class="red_chip"></canvas>
    <canvas width="60" height="60" id="58" class="red_chip"></canvas>
    <canvas width="60" height="60" id="59" class="red_chip"></canvas>
    <canvas width="60" height="60" id="60" class="red_chip"></canvas>
    <canvas width="60" height="60" id="61" class="red_chip"></canvas>
    <canvas width="60" height="60" id="62" class="red_chip"></canvas>
    <canvas width="60" height="60" id="63" class="red_chip"></canvas>
    
   <canvas width="60" height="60" id="64" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="65" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="66" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="67" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="68" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="69" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="70" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="71" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="72" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="73" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="74" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="75" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="76" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="77" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="78" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="79" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="60" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="81" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="82" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="83" class="black_chip draggable"></canvas>
    <canvas width="60" height="60" id="84" class="black_chip draggable"></canvas>
    <?php
     $data = db_fetch_object(db_query("select * from in_game where username = '$_REQUEST[username]' and domain = '$_REQUEST[domain]'"));

    if(!empty($data->gameID)){
	?>
		<script>
		
		//prompt('refresh_game_play');
		$(document).ready(function(){
			refresh_game_play('<?php echo $data->gameID; ?>');
			chat_boxes();
			$('#game_info').append('<span id="end_game" onclick="clear_game(\'' + $('#me').val() + '\', \'' + $('#domain').val() + '\');" alt="<?php echo $_REQUEST['room'];?>"><?php echo END_GAME; ?></span>');
		});
		</script>
		<?php
	$row = db_fetch_object(db_query("select * from in_game where username != '$_REQUEST[username]' and domain = '$_REQUEST[domain]' and room = '" . $data->room . "' and gameID = '" . $data->gameID . "'"));
	
	if(!empty($row->username)){
	      $opponent = $row->username;
	      
	      $whos_turn = db_fetch_object(db_query("select * from in_game where domain = '$_REQUEST[domain]' and room = '" . $data->room . "' and gameID = '" . $data->gameID . "' order by id desc limit 1"));
	
		if($whos_turn->username != $_REQUEST['username']){
		
		    $whos_turn = $whos_turn->username;
		}else{
		    $whos_turn = $_REQUEST['username'];
		
		}
		///if(db_num_rows(db_query("select * from in_game where gameID = '" . $data->gameID . "' and last_move != 'won' and last_move != 'lost'")) == 0 ){
		
		//}
			    $red = array();
			    
			    $sql = db_query("select * from in_game where gameID = '" . $data->gameID . "' and username = '$_REQUEST[username]' and (last_move NOT LIKE 'Invited%' and last_move not like 'Accepted%') order by id asc");
			    
			    while($row = db_fetch_array($sql)){
			    
			      $red[] = $row['last_move'];
			    
			    }
			    
		
			    $black = array();
			    
			    $sql = db_query("select * from in_game where gameID = '" . $data->gameID . "' and username != '$_REQUEST[username]' and (last_move NOT LIKE 'Invited%' and last_move not like 'Accepted%')  order by id asc");
			    
			    while($row = db_fetch_array($sql)){
			    
			      $black[] = $row['last_move'];
			    
			    }
	
	}else{
	      $opponent = '';
	
	}
	
	
    }else{
      $data->gameID = '';
    
    }
    
    foreach($black as $value){
    ?>
      <script>
    //  create_circle(<?php echo $value; ?>, 'blue');
      
      </script>
    <?php  
    
    }
    foreach($red as $value){
     ?>
      <script>
      
      // create_circle(<?php echo $value; ?>, 'red');
      </script>
    <?php  
    
    }
    ?>
	<input type="hidden" name="me" id="me" value="<?php echo $_REQUEST['username']; ?>" />
	<input type="hidden" name="domain" id="domain" value="<?php echo str_replace("www.", "", $_REQUEST['domain']); ?>" />
	
	
	<input type="hidden" name="whos_turn" id="whos_turn" value="<?php echo $whos_turn; ?>" />
	
	<input type="hidden" name="opponent" id="opponent" class="opponents" value="<?php echo $opponent; ?>" />
	
	<input type="hidden" name="game_instance_id" id="game_instance_id" value="<?php echo $data->gameID; ?>" />
	<audio id="piece_drop"></audio>

</div>
<div style="float:right;vertical-align:top;" id="game_info">
      <div style="display:none;" id="take_from"><?php echo $connect4['take_from']; ?>_count</div>
      <p>Cost of Game <span id="bids_to_take"><?php echo $connect4['take']; ?></span> <span id="take_from_txt"><?php echo ucwords(str_replace("_", " ", $connect4['take_from'])); ?></span></p>
      <p>Prize <span id="reward"><?php echo $connect4['reward']; ?></span> <span id="reward_with"><?php echo ucwords(str_replace("_", " ", $connect4['reward_with'])); ?></span></p>

</div>
</div><!-- end wrapper -->