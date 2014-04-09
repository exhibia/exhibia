<?php
define('END_GAME', 'End Game');
include("$BASE_DIR/include/addons/games-server/api/connect4.config.inc.php");
$_REQUEST['domain'] = str_replace("www.", "", $_REQUEST['domain']);
?>
<style>
#wrapper_game {
  top: 50px;
  position: relative;
  z-index:1;
  left:10px;
}
#game_area {
position:static!important;
top: 50px !important;
z-index: 10000 !important;
float:none!important;
clear:none!important;
}   
#myqb-wrap {
  padding: 0 25px 0 268px;
  min-height: 700px;
}

.black_chip {
display:none;
}
#board_wrapper { /* 84 x 6 = 504 */
background-color: #FFFFFF;
border-left: 1px solid #000000;
border-radius: 8px;
border-top: 1px solid;
box-shadow: 6px 6px 6px #666666;
height: 452px;
padding: 8px 4px 2px;
width: 455px;

}

div.row_wrapper {
	height: 60px;
	margin: 0 0 0 4px;
	clear:both;
}

div.row_wrapper div { /* total width 104 */
background: url("<?php echo $games_server; ?>//include/addons/games-server/connectfour/image/connect4.png");
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

left: 500px;
position: absolute;
z-index: 9;
top: 0px;
cursor:move;
width:60px;
height:60px;
}

canvas.black_chip {
  left: 500px;
  position: absolute;
 width:60px;
height:60px;
  z-index: 9;
}
canvas.red_chip.dragagble.ui-draggable {
background-color:#cacaca!important;
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
left: -20px !important;
position: relative !important;
top: -150px !important;
}
#game_info h3{
width:200px;

}
audio {
	display: none;
}
</style>

<script>
var debug = 'true';


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
	function showAlertBoxWon(msg){
	$('#alert_message').html(msg);

	    
	    $( "#alert_message" ).dialog({
			modal: true,
			autoOpen: false,
			buttons: {
			    "<?php echo OK; ?>": function() {
				$( this ).dialog( "close" );
			    }
			},
			
				open: function(){
				
					$("#alert_message").css({"zIndex": findHighestZIndex('*') + 10 });
					setTimeout("window.location.href = window.location.href;", 10000);
				
				  },
				  close: function(){
				   // clear_game($('#me').val(), $('#domain').val());
				  
				  }
			    
			
		    });
		 $( "#alert_message" ).dialog('open');
		 ///clear_game($('#me').val(), $('#domain').val());
	}
	function showAlertBoxLost(msg){
	$('#alert_message').html(msg);

	  
	    $( "#alert_message" ).dialog({
			modal: true,
			autoOpen: false,
			buttons: {
			    "<?php echo OK; ?>": function() {
				$( this ).dialog( "close" );
			    }
			},
			
				open: function(){
				
					$("#alert_message").css({"zIndex": findHighestZIndex('*') + 10 });
					clear_game_lost($('#me').val(), $('#domain').val());
				  },
				  close: function(){
				//  clear_game($('#me').val(), $('#domain').val());
				  }
			    
			
		    });
		 $( "#alert_message" ).dialog('open');   
		// clear_game($('#me').val(), $('#domain').val());
	}
	function congratulate(color) {
		$('.chip_holder').removeClass('red_chip');
		$('.chip_holder').removeClass('cannot_place');
		$('.chip_holder').removeClass('blue_chip');
		$('.chip_holder').removeClass('can_place');
		$('.chip_holder').removeClass('droppable');
		
		
		
		//Add invitation to here
		$.ajax({
			url: '<?php echo $games_server; ?>/include/addons/games-server/connectfour/check_game_data.php',
			data: { loser: $('#opponent').val(), username: $('#me').val(), winner: $('#me').val(), opponent: $('#opponent').val(), gameID: $('#game_instance_id').val(), domain: $('#domain').val() , room : $('#game_room').val() },
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
					showAlertBoxWon('Game Over. <br />You Won!<br /><a href="javascript:;" onclick="invite(\'' + $('#opponent').val() + '\');">Invite </a>' + $('#opponent').val() + ' To another game');
					
					
					
			  // return complete = 'true';
			
			}
		      });
		    
		      
		      /*$.ajax({ 
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
			url: '<?php echo $games_server; ?>/include/addons/games-server/connectfour/check_game_data.php',
			data: { opponent: $('#opponent').val(), winner: $('#opponent').val(), loser: $('#me').val(), username: $('#me').val(), gameID: $('#game_instance_id').val(), domain: $('#domain').val(), room: $('#game_room').val() },
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
					showAlertBoxLost('Game Over. ' + $('#opponent').val() + ' Wins!<br /><a href="javascript:;" onclick="invite(\'' + $('#opponent').val() + '\');">Invite </a>' + $('#opponent').val() + ' To another game');
					
					 
					
			 //return complete = 'true';
			
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
		} else {
			color = 'blue';
			//$('#' + index).addClass('him');
		} 
		
		
		
		//prompt(color);
		var circle = document.getElementsByTagName('canvas')[index].getContext('2d');
		circle.beginPath();
		
			circle.arc(30, 30, 30, 0, 2 * Math.PI, false);
		
		
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
	      url: '<?php echo $games_server; ?>/include/addons/games-server/connectfour/check_game_data.php',
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
			    create_circle(index, 'red');
			    $('#' + index).removeClass('draggable');
			}
		    
		    
		    }
		  }
		 }
		 // if(!empty(response.last_move)){
	
		      //move_player_peice(response.last_move);
		      $.each(response.chips.black,  function(i, item){
			  id = parseInt(item);
			
			  create_circle(parseInt(id) - 1, 'blue');
			  $('#' + id).removeClass('can_place');
			  $('#' + id).addClass('cannot_place');
			  $('#' + id).addClass('blue_chip');
			  //if(!$('#' + id).hasClass('cannot_place')){
			  // $('#' + parseInt(id - 7)).addClass('can_place');
			  //}
		      });
		      $.each(response.chips.red,  function(i, item){
			  id = parseInt(item);
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
			    refresh_game_play(gameID);
			  if(response.game != 'game over'){
			 //   setTimeout("refresh_game_play('" + gameID + "')", 5000);
			   }
		    }else{
			if(response.game != 'game over'){
			  remove_circles();
			//  setTimeout("refresh_game_play('" + gameID + "')", 5000);
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
				   // prompt(drop_square_number);
				}
				var landing_square_results = find_landing_square(drop_square_number);
				
				var distance          = landing_square_results[0];
				var square_to_land_on = parseInt(landing_square_results[1]);
				
				if(!empty(debug)){
				  //prompt(square_to_land_on);
				}
				
				
				$(ui.draggable).animate(
					{ top:distance },
					300,
					'linear', 
					function() {
					piece_drop.play();
					}
				);
				
				
			//	$('.red_chip').draggable({ disabled: true });
				
				
				
				if ($('#' + square_to_land_on).attr('id') < 8) {
					$(this).droppable({ disabled: true });
					
				}
				       
					
					$.ajax({ 
					      url: '<?php echo $games_server; ?>/include/addons/games-server/connectfour/check_game_data.php',
					      data: { gameID: $('#game_instance_id').val(), username : $('#me').val(), domain: '<?php echo $_REQUEST['domain']; ?>', opponent: $('#opponent').val(), move: square_to_land_on },
					      type: 'get',
					      dataType: 'jsonp',
					      crossDomain: true,
					      
					      ajaxTimeOut: 1000,
					      success: function(response){
					    // prompt(response.final_bids);  	   
					    // prompt(response.free_bids); 

					      
					      $('#whos_turn').val(response.whos_turn);
						      if(response.whos_turn != $('#me').val()){
							    
							      for (index = 43; index < 84; index++) {
								$('.red_chip').draggable({ disabled: true });
							      }
							}else{
							      for (index = 43; index < 84; index++) {
								$('.red_chip').draggable({ disabled: false });
							      }
							}
					        
						      if(!empty(response.final_bids)){
							  $('#bids_count_tb').html(response.final_bids);
							  $('#bids_count').html(response.final_bids);
						      }
						      if(!empty(response.free_bids)){
							  $('#free_bids_count_tb').html(response.free_bids);
							  $('#free_bids_count').html(response.free_bids);
						      
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
		soundHandle.src = '<?php echo $games_server;?>/include/addons/games-server/connectfour/sounds/piece-drop.wav';
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
	
	<?php 
	
	$letters = array('a' => array(1,2,3,4,5,6,7), 'b' => array(8,9,10,11,12,13,14), 'c' => array(15,16,17,18,19,20,21), 'd' => array(22,23,24,25,26,27,28), 'e' => array(29,30,31,32,33,34,35), 'f' => array(36,37,38,39,40,41,42));
	foreach($letters as $letter => $start){
	 
	    
	?>
	<div id="<?php echo $letter; ?>" class="row_wrapper">
	<?php
	      foreach($letters[$letter] as $p){
	 ?>
	    
		    
				<div id="<?php echo $p; ?>" class="chip_holder">
				    <canvas width="60" height="60"></canvas>
				</div>
	 <?php
	 
		}
		?>
	</div>
 	    <?php 
	    } ?>
	</div><!-- end board_wrapper -->
	<?php $p = 43;
	while($p <= 63){
	?>
	  <canvas width="60" height="60" id="<?php echo $p; ?>" class="red_chip draggable"></canvas>
	<?php $p++ ; 
	
	}
	?>
    <?php $p = 64;
	while($p <= 84){
	?>
	  <canvas width="60" height="60" id="<?php echo $p; ?>" class="black_chip draggable"></canvas>
    
    <?php
    $p++;
    }
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