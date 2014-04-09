<script type="text/javascript" src="js/ui/jquery.ui.accordion.js"></script>
<?php
		    $sql = db_query("select distinct(card) from bingo_user_data where instance = '$_REQUEST[game]' and userid = '$_SESSION[userid]'" );
			      
		       $game_data = db_fetch_array(db_query("select * from bingo_games where id = '$_REQUEST[game]'"));
		       
		       if(db_num_rows($sql) >= 1){
			  ?>
			  <script>
			  update_cards('<?php echo $_REQUEST['game']; ?>', <?php echo $_SESSION['userid']; ?>);
			  
			  </script>
			  
			  <table>
			      <tr>
				<td valign="top" height="100%">
				    <div class="balls_holder_outer" style="float:left;width:300px;height:160px;"></div>
				</td>
				<td valign="top" height="100%">
				      <ul id="balls_<?php echo $_REQUEST['game']; ?>" class="balls_holder">
					  <li style="font-size:30px;font-weight:bold;text-align:center;">
					      Game Begins In <br />
					      <span style="font-size:45px;" id="game_begin_time" alt="<?php echo strtotime($game_data['time_b'] . ' ' . $game_data['date']); ?>"><?php create_time( strtotime($game_data['time_b'] . ' ' . $game_data['date']) - time()); ?></span>
					  </li>
				      </ul>
				</td>
				<script>
				date = new Date(<?php echo strtotime($game_data['time_b'] . ' ' . $game_data['date']) * 1000; ?>);
				$('#game_begin_time').countdown({until: date});
				</script>
				<td valign="top" height="100%">
				<?php
				$jackpots = array();
				$sql_u = db_query("select distinct(userid) from bingo_user_data where instance = $game_data[id]");
							$total_cards = 0;
							
					while($row_u =db_fetch_array($sql_u)){
						
							    $count_cards = db_fetch_array(db_query("select count(distinct(card)) from bingo_user_data where instance = $game_data[id] and userid=$row_u[userid]"));
							  
							    $total_cards = number_format($total_cards, 0, '', '') + number_format($count_cards[0], 0 , '', '');
							}
							
					  $sql_jackpots = db_query("select * from bingo_jackpots where bingo_id = $game_data[id]");
					  while($row_jackpots = db_fetch_array($sql_jackpots)){
					    if($row_jackpots['which_to_give'] != 'product'){
					      $jackpots[$row_jackpots['place']] = (($total_cards * $game_data['cost_per_card']) * $row_jackpots['reward_points']) / 100 . " " . ucwords(str_replace("_", " ", $row_jackpots['which_to_give']));
					    }
					  }
				
				?>
				
				    <ul id="winners" style="float: right;font-size: 16px;text-align: left;margin: 10px 0 0 -40px;">
					<li style="    color: #008000; font-size: 26px;   font-weight: bold;  margin: -10px 0 0 40px; padding-bottom: 10px;  text-decoration: underline;">Winners</li>
					<li style="font-size:14px;"><b>First:</b><span id="first_place"><ul style="font-size:10px;"></ul></span>  Currently: <?php echo $jackpots['first'];?></li>
					<li style="font-size:14px;"><b>Second:</b><span id="second_place"><ul style="font-size:10px;"></ul></span> Currently: <?php echo $jackpots['second'];?></li>
					<li style="font-size:14px;"><b>Third:</b><span id="third_place"><ul style="font-size:10px;"></ul></span> Currently: <?php echo $jackpots['third'];?></li>
					<li id="game_status_over" style="font-size:22px;color:red;font-weight:bold;"> </li>
				    </ul>
				    <div style="display:none;" id="sounds"></div>
				</td>
			      </tr>
			   </table>
			  <div class="clear"></div>
			  
			  
			  
			  <ul style="border-top:1px solid red;">
			  <?php if($_SESSION['userid'] == 11){ ?>
			  <span id="chat">
				<p>Chat</p>
				    <ul id="user_list2">
				    <?php
				    $users = db_query("select distinct r.username, userid from bingo_user_data left join registration r on r.id=bingo_user_data.userid where instance = '$instance'");
				    while($row_users = db_fetch_array($users)){
				    ?>
				        <li><?php echo $row_users['username']; ?></li>
				    <?php
				    }
				    echo db_error();
				    ?>
				    </ul>
				</span>
				<script>
				    $('#chat').click(function(){
				   
				    
					if($('#user_list').css('display') == 'none'){
					 prompt('test');
					    $('#user_list').css('display', 'block');
					}else{
					    $('#user_list').css('display', 'none');
					
					}
				    
				    });
				    
				</script>
				<?php } ?>
				<div class="clear"></div>
				<ul class="large" id="game_area_<?php echo $_SESSION['userid']; ?>">
			  <?php
			      while($row = db_fetch_array($sql)){
			      $letters = array("B", "I", "N", "G", "O");
			      $card = '';
				$card .= '<li id="card_' .$row['card'] . '" style="float:left;background-color:#CACACA;color:#fff!important;font-size:42px;max-width:320px!important;height:285px;border-radius:6px;margin: 5px 17px 5px 18px;" class="user_' . $_SESSION['userid'] . '">';
					  
					  $card .= '<ul id="place_text_' . $_SESSION['userid'] . '_' . $row['card'] . '" style="list-style:none;color:#fff!important;font-weight:bold;padding:5px 0 5px 0;text-align:center;">
						      <li style="display:inline;width:60px;padding: 0 5px 0 5px;">B</li>
						      <li style="display:inline;width:60px;padding: 0 5px 0 5px;">I</li>
						      <li style="display:inline;width:60px;padding: 0 5px 0 5px;">N</li>
						      <li style="display:inline;width:60px;padding: 0 5px 0 5px;">G</li>
						      <li style="display:inline;width:60px;padding: 0 5px 0 5px;">O</li>
						   </ul>';
					  
					  $card .= '<ol class="card_data" style="width:220px;text-align:center;margin: 0 8px 0 8px;">';
					  $p = 1;
				   foreach($letters as $letter){				
						$card .= '<li class="' . $letter. '" style="float:left;text-align:center;">
							    <dl style="background-color: #FFFFFF !important;word-wrap:break-word;border-left: 2px solid #CACACA;border-right: 2px solid #CACACA;font-size:18px;">'; 
			      
			   
			      
							      $sql_card = db_query("select * from bingo_user_data where instance = '$_REQUEST[game]' and userid = '$_SESSION[userid]' and card = '$row[card]' and number like '$letter-%'" );
								  while($row_card = db_fetch_array($sql_card)){
				         
					 
					  
								    $card .= '<dd style="';
								    
								    
								    if($row_card['marked'] == 1){
								    
								    $card .= '';
								    
								    $card .= 'text-align:center;vertical-align:center;min-width:39px!important;min-height:40px;border-right:1px solid #000;border-bottom:1px solid #000;color:#fff;" class="circle ' . $row_card['number'] . ' user_' . $_SESSION['userid'] . '"><span style="position:relative;top:10px;color:#fff;">';
								    
									if($p != 13){
									    $card .= str_replace("$letter-", "", $row_card['number']);
									}else{
									    
									
									}
								    $card .= ' </span></dd>';
								    
								    }else{
								    
								    $card .= 'text-align:center;vertical-align:center;min-width:39px!important;min-height:40px;border-right:1px solid #000;border-bottom:1px solid #000;" class="' . $row_card['number'] . ' user_' . $_SESSION['userid'] . '"><span style="position:relative;top:10px;color:#000;">' .str_replace("$letter-", "", $row_card['number']) . '</span></dd>';
								    
								    }
							  $p++;
							}  
				
						      $card .= '</dl>';
						$card .= '</li>';
				   
				   
				   }
					
					  $card .= '</ol>';
					  $card .= '</li>';
				
					  
					  echo $card;				    
				}
				?>
				</ul>
				
				<?php
					    
			     $game_data = db_fetch_array(db_query("select * from bingo_games where id = '$_REQUEST[game]'"));
		      
				if(db_num_rows(db_query("select * from bingo_games where id = '$_REQUEST[game]'")) >= 1){
				
			    
			    ?>
			    <!--<script>
			    
			     function user_data(userid){
				$('.accordion_body').css('display', 'none');
				$('.accordion_header').each(function(){
				    $('#accordion_' + $(this).attr('alt')).html('');
				    $('body').append('<div id="stop_game_' + $(this).attr('alt') + '"></div>');
				
				});
				
				$('#stop_game_' + userid).remove();
				
				
				  $('#accordion_' + userid).css('display', 'block');
				  $.ajax({
					  url: 'include/addons/bingo/watch_game.php',
					  data: { page: 'watch_game', game: '<?php echo $_REQUEST['game']; ?>', userid: userid },
					  dataType: 'html',
					  success: function(response){
					  $('#accordion_' + userid).html(response);
					     
					      update_cards('<?php echo $_REQUEST['game']; ?>', userid);
					       
					  }
				  })
			      }
			    </script>
			    
			    
			    <div class="clear"></div>
			  
			     <ul class="accordion">
			     <?php
			    $usernames = array();
			    $sql = db_query("select * from bingo_user_data left join registration r on r.id=bingo_user_data.userid left join avatar a on a.id = r.avatarid where instance = '$_REQUEST[game]' and bingo_user_data.userid != $_SESSION[userid]" );
			    $start = false;
				while($row = db_fetch_array($sql)){
				
				
				if(!in_array($row['username'], $usernames)){
				  $usernames[] = $row['username'];
				
				    ?>
				   
				      <li class="accordion_header" id="accordion_header_<?php echo $row['userid']; ?>" style="max-height:650px;overflow:scrolling; height:auto!important;margin:0px 0 20px 0;" alt="<?php echo $row['userid']; ?>">
					<h3 class="accordion_user_info" style="color:#fff;background-color:#c2c2c2;font-size:18px;min-width:1000px;min-height:35px;padding:10px 0 5px 20px;margin:20px 0 10px 0;border-radius:8px 8px 0 0;"><?php echo $row['username']; ?></h3>
					  <span id="accordion_<?php echo $row['userid']; ?>" class="accordion_body" style="height:auto!important;margin:-10px 0 0 0;display:none;"></span>
				      </li>
				     <li class="clear"></li>
				  <?php
				  }
				
				}
				echo db_error();
			    ?>
			    </ul>-->
			    <div class="clear"></div>
			    <?php
				}
			     }else{
			    
			     $game_data = db_fetch_array(db_query("select * from bingo_games where id = '$_REQUEST[game]'"));
		      
				if(db_num_rows(db_query("select * from bingo_games where id = '$_REQUEST[game]'")) >= 1){
				
			    
			    ?>
			    <script>
			    
			     function user_data(userid){
				/*$('.accordion_body').css('display', 'none');
				$('.accordion_header').each(function(){
				    $('#accordion_' + $(this).attr('alt')).html('');
				    $('body').append('<div id="stop_game_' + $(this).attr('alt') + '"></div>');
				
				});*/
				
				//$('#stop_game_' + userid).remove();
				
				
				  $('#accordion_' + userid).css('display', 'block');
				  $.ajax({
					  url: 'include/addons/bingo/watch_game.php',
					  data: { page: 'watch_game', game: '<?php echo $_REQUEST['game']; ?>', userid: userid },
					  dataType: 'html',
					  success: function(response){
					  $('#accordion_' + userid).html(response);
					     
					      update_cards('<?php echo $_REQUEST['game']; ?>', userid);
					       
					  }
				  })
			      }
			    </script>
			    
			    
			     <table>
			      <tr>
				<td valign="top" height="100%">
				    <div class="balls_holder_outer" style="float:left;width:300px;height:160px;"></div>
				</td>
				<td valign="top" height="100%">
				      <ul id="balls_<?php echo $_REQUEST['game']; ?>" class="balls_holder">
					  <li style="font-size:30px;font-weight:bold;text-align:center;">
					      Game Begins In <br />
					      <span style="font-size:45px;" id="game_begin_time" alt="<?php echo strtotime($game_data['time_b'] . ' ' . $game_data['date']); ?>"><?php create_time( strtotime($game_data['time_b'] . ' ' . $game_data['date']) - time()); ?></span>
					  </li>
				      </ul>
				</td>
				<script>
				date = new Date(<?php echo strtotime($game_data['time_b'] . ' ' . $game_data['date']) * 1000; ?>);
				$('#game_begin_time').countdown({until: date});
				</script>
				<td valign="top" height="100%">
				<?php
				$jackpots = array();
				$sql_u = db_query("select distinct(userid) from bingo_user_data where instance = $game_data[id]");
							$total_cards = 0;
							
					while($row_u =db_fetch_array($sql_u)){
						
							    $count_cards = db_fetch_array(db_query("select count(distinct(card)) from bingo_user_data where instance = $game_data[id] and userid=$row_u[userid]"));
							  
							    $total_cards = number_format($total_cards, 0, '', '') + number_format($count_cards[0], 0 , '', '');
							}
							
					  $sql_jackpots = db_query("select * from bingo_jackpots where bingo_id = $game_data[id]");
					  while($row_jackpots = db_fetch_array($sql_jackpots)){
					    if($row_jackpots['which_to_give'] != 'product'){
					      $jackpots[$row_jackpots['place']] = (($total_cards * $game_data['cost_per_card']) * $row_jackpots['reward_points']) / 100 . " " . ucwords(str_replace("_", " ", $row_jackpots['which_to_give']));
					    }
					  }
				
				?>
				
				    <ul id="winners" style="float: right;font-size: 16px;text-align: left;margin: 10px 0 0 -40px;">
					<li style="    color: #008000; font-size: 26px;   font-weight: bold;  margin: -10px 0 0 40px; padding-bottom: 10px;  text-decoration: underline;">Winners</li>
					<li style="font-size:14px;"><b>First:</b><span id="first_place"><ul style="font-size:10px;"></ul></span>  Currently: <?php echo $jackpots['first'];?></li>
					<li style="font-size:14px;"><b>Second:</b><span id="second_place"><ul style="font-size:10px;"></ul></span> Currently: <?php echo $jackpots['second'];?></li>
					<li style="font-size:14px;"><b>Third:</b><span id="third_place"><ul style="font-size:10px;"></ul></span> Currently: <?php echo $jackpots['third'];?></li>
					<li id="game_status_over" style="font-size:22px;color:red;font-weight:bold;"> </li>
				    </ul>
				    <div style="display:none;" id="sounds"></div>
				</td>
			      </tr>
			   </table>
			  <div class="clear"></div>
			  
			  
			     <ul class="accordion">
			     <?php
			    $usernames = array();
			    $sql = db_query("select * from bingo_user_data left join registration r on r.id=bingo_user_data.userid left join avatar a on a.id = r.avatarid where instance = '$_REQUEST[game]'" );
			    $start = false;
				while($row = db_fetch_array($sql)){
				
				
				if(!in_array($row['username'], $usernames)){
				  $usernames[] = $row['username'];
				
				    ?>
				   
				      <li class="accordion_header" id="accordion_header_<?php echo $row['userid']; ?>" style="max-height:650px;overflow:scrolling; height:auto!important;margin:0px 0 20px 0;" alt="<?php echo $row['userid']; ?>">
					<h3 class="accordion_user_info" style="color:#fff;background-color:#c2c2c2;font-size:18px;min-width:1000px;min-height:35px;padding:10px 0 5px 20px;margin:20px 0 10px 0;border-radius:8px 8px 0 0;"><?php echo $row['username']; ?></h3>
					  <span id="accordion_<?php echo $row['userid']; ?>" class="accordion_body" style="height:auto!important;margin:-10px 0 0 0;display:none;"></span>
				      </li>
				     <li class="clear"></li>
				  <?php
				  }
				  if($start == false){
				?>
				<script>
				  user_data(<?php echo $row['userid']; ?>);
				</script>
				<?php
				$start = true;
				}
				}
				echo db_error();
			    ?>
			    </ul>
			    <div class="clear"></div>
			    <?php
				}
			    } ?>
			    
			    <script>
			    $('.accordion_header').click( function(){
				id = $(this).attr('alt');
				
				if($('#accordion_' + id).css('display') == 'block'){
				    $('#accordion_' + id).css('display', 'none')
				    $('body').append('<div id="stop_game_' + id + '"></div>');
				  
						
				
				}else{
				    $('#stop_game_' + id).remove();
				    $('#accordion_' + id).css('display', 'block')
				    user_data(id);
				}
			    })
			    </script>