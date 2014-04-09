
			<a href="javascript:;" onclick="show_winners();" style="background: url(include/addons/bingo/images/winners.png) no-repeat scroll 0 0 rgba(0, 0, 0, 0);
color: #FFFFFF;
float: right;
font-size: 26px;
font-weight: bold;
width: 170px;
height: 40px;
margin-right: 60px;
margin-top: 20px;
text-align: center;
background-size: 170px 35px;
padding-top: 5px;">Winners</a>
<div class="clear"></div>
<?php
			    $bingo_sql = db_query("select * from bingo_games where finished != '1' and finished != '2' order by timestamp asc");
			 if(db_num_rows($bingo_sql)>=1){
			    while($row_bingo = db_fetch_array($bingo_sql)){
				$days = explode(":every ", rtrim(ltrim($row_bingo['days'], "every "), ":"));
				$days_array = array("S" => "Sun", "M" => "Mon", "T" => "Tue", "W" => "Wed", "Th" => "Thu", "F" => "Fri", "Sa" => "Sat");						      $day_to_start = date('w');
					      $week_start = date('m-d-Y', strtotime('-'.$day_to_start.' days'));
					      $week_end = date('m-d-Y', strtotime('+'.(6-$day_to_start).' days'));
					      $time = explode(":", $row_bingo['time_b']);
					      
					      $date = explode("-", $row_bingo['date']);
					      
					      
					     // echo date("Y-m-d H:i:s", mktime($time[2], $time[0], $time[1], 0, 0, $date[0]));
					      if(  strtotime(date("Y-m-d H:i:s", mktime($time[2], $time[0], $time[1], 0, 0, 0))) > strtotime(date("Y-m-d H:i:s"))  ){
					      
					      $day_to_start++;
					      
					      }
					      //check if game has run or not
					      if(strtotime(date("Y-m-d") . " " . $row_bingo['time_b']) < time()){
					      $day_to_start++;
					      }
					      $days = rearrange_array($days, $day_to_start);
			    
			    ?>
			<ul>			    
				<li  class="live-auction" style="vertical-align:top;">
				    <ul style="vertical-align:top;">
				   
					<li style="vertical-align:top;display:inline-block;width:200px;margin:10px 0 0 20px;cursor:pointer;">
					<h3  id="game_name_<?php echo $row_bingo['id']; ?>">#<?php echo $row_bingo['id']; ?> - <?php echo $row_bingo['name']; ?></h3>
					 
					<p><span style="font-weight:bold;">Start Time: </span><span id="start_time_<?php echo $row_bingo['id'];?>"><?php echo $row_bingo['time_b'] . '</span><br /> ' . date("M d, Y", strtotime($row_bingo['date'])) . " " . date("T", strtotime($row_bingo['time_b'])); ?></p>
					
					
					<p style="display:none;"><span style="font-weight:bold;">Server Time: </span><span class="server_time" id="timer_<?php echo $row_bingo['id'];?>" title="<?php echo $row_bingo['id'];?>"><?php echo date("H:i:s") . ' ' . date('T'); ?></span> <?php echo date('T'); ?></p>
					
					<p>
					      <span style="font-weight:bold;">Next Game Starts in: </span>
					      <br />
					      <span id="game_countdown_<?php echo $row_bingo['id']; ?>" alt="<?php echo strtotime($days_array[$days[0]] . ' ' .$row_bingo['time_b'] . ' ' .  date('T')); ?>" style="font-weight:normal;font-size:12px;float:none;"></span>
					</p>
					<script>
					date = new Date(<?php echo strtotime($row_bingo['time_b'] . ' ' . $row_bingo['date']) * 1000; ?>);
					$('#game_countdown_<?php echo $row_bingo['id']; ?>').countdown({until: date});
					</script>
					<script>

					
					    
					  //  sClock(<?php echo date("H") . ',' . date("m") . ',' . date("s"). ',"' . date("D") . '"'; ?>);
					
					
					
					</script>
					
					</li>
					<li style="display:inline-block;vertical-align:top;min-width:300px;"><h3>Prizes</h3>
					
					<ol style="vertical-align:top;">
					<?php
					$sql_u = db_query("select distinct(userid) from bingo_user_data where instance = $row_bingo[id]");
							$total_cards = 0;
							
					while($row_u =db_fetch_array($sql_u)){
						
							    $count_cards = db_fetch_array(db_query("select count(distinct(card)) from bingo_user_data where instance = $row_bingo[id] and userid=$row_u[userid]"));
							  
							    $total_cards = number_format($total_cards, 0, '', '') + number_format($count_cards[0], 0 , '', '');
							}
							
					  $sql_jackpots = db_query("select * from bingo_jackpots left join products p on p.productID=bingo_jackpots.productID where bingo_id = $row_bingo[id]");
					  while($row_jackpots = db_fetch_array($sql_jackpots)){
					    ?>
					      <li  style="vertical-align:top;">
						  <span style="font-weight:bold;float:left;"><?php echo ucfirst($row_jackpots['place']); ?> Place: <?php if(!empty($row_jackpots['productID'])){ echo $row_jackpots['name']; } ?>
							<span style="font-weight:normal;"><?php if(!empty($row_jackpots['reward_points'])){ echo $row_jackpots['reward_points'] . '%' . ' ' . ucwords(str_replace('_', ' ', str_replace('final', '', $row_jackpots['which_to_give']))) . ' Of Purse'; } ?>
							<span id="current_<?php echo $row_bingo['id'];?>" style="color:green;"> Currently:
							<?php
							
							
							
							$count_user = db_num_rows($sql_u);
							
						
							echo round(($total_cards * $row_bingo['cost_per_card']) * $row_jackpots['reward_points'] / 100); 
							
							
							?>
							</span>
							</span>
						  </span>
					      </li>
					      <li class="clear"></li>
					   <?php
					   }
					   ?>
					   </ol>
					</li>
					
					<li style="display:none;vertical-align:top;margin:0 0 0 10px;"><h3>Previous Winners</h3>
					<ol>
					    <?php
					    $sql = db_query("select distinct(place), winner from bingo_winners where game_name = '$row_bingo[name]' and place = 'first' order by id desc limit 1");
					    while($row_history = db_fetch_array($sql)){
					      ?>
						<li><span style="font-weight:bold;">First: </span><?php echo $row_history['winner'];?> <?php echo $row_history['first_bids'];?></li>
					      <?php } ?>
					    <?php
					    $sql = db_query("select distinct(place), winner from bingo_winners where game_name = '$row_bingo[name]' and place = 'second' order by id desc limit 1");
					    while($row_history = db_fetch_array($sql)){
					      ?>
						<li><span style="font-weight:bold;">Second: </span><?php echo $row_history['winner'];?> <?php echo $row_history['second_bids'];?></li>
					      <?php } ?>
					    <?php
					    $sql = db_query("select distinct(place), winner from bingo_winners where game_name = '$row_bingo[name]' and place = 'second' order by id desc limit 1");
					    while($row_history = db_fetch_array($sql)){
					      ?>
						<li><span style="font-weight:bold;">Third: </span><?php echo $row_history['winner'];?> <?php echo $row_history['third_bids'];?></li>
					      <?php
					    }
					    if(db_num_rows($sql) >= 1){
						?>
						  <li><a href="javascript:;" onclick="more_winners(<?php echo $row_bingo['id'];?>);">More Winners</a></li>
						<?php
					    }
					    ?>
					  </ol>
					</li>
					
					<li style="display:inline-block;vertical-align:top;margin:0 20px 0 50px;float:right;">
					<?php
					
					//if(!empty($days)){
					
					?>
					   <ol>
					      <?php

					    // foreach($days as $value){
					      
					     //if(!in_array($value,$days_shown[$instance])){
					     // $days_shown[$instance][] = $value;
					 
						      $instance = $row_bingo['id'];
						 
						      $cards = db_fetch_array(db_query("select count(distinct(card)) from bingo_user_data where instance = '$instance' and userid = '$_SESSION[userid]'" ));
						   
						      if(empty($row_bingo['max_cards'])){
						       $row_bingo['max_cards'] == '1000';
						      
						      }
						    
						      if($cards[0] < $row_bingo['max_cards']){
						     
						         if(db_num_rows(db_query("select * from bingo_numbers where instance = '$row_bingo[id]'")) == 0){
						      ?>
					    
							    <li>   <a style="vertical-align:top;" class="bingo_button1" onclick="buy_cards('<?php echo $row_bingo['id']; ?>', '<?php echo strtotime($row_bingo['date']); ?>');">Buy Cards</a>
							    </li>
							    
							    <?php }
							    
							    if(db_num_rows(db_query("select * from bingo_user_data where userid = '$_SESSION[userid]' and instance = '$row_bingo[id]'")) >= 1){
							    ?>
							    <li>
							      
								    <?php if($cards >= 1){ ?>
									<a style="float:right;" class="bingo_button2" href="bingo.php?game=<?php echo $instance; ?>">Go to game</a> 
							    </li>
								  <?php
								
									}
									
								  }else{
								  ?>
							    
							    <li>
							      
								    <?php //if($cards >= 1){ ?>
									<a style="float:right;" class="bingo_button2" href="bingo.php?game=<?php echo $instance; ?>">Watch game</a> 
							    </li>
								  <?php
								  //}
								  
								  }
							      }else{ 
							      
							      if(db_num_rows(db_query("select * from bingo_user_data where userid = '$_SESSION[userid]' and instance = '$row_bingo[id]'")) >= 1){
							      
							      ?>
							
								    
							      <li>
								    <a style="float:right;" class="bingo_button2" href="bingo.php?game=<?php echo $instance; ?>">Go to game</a>
							      </li>  
							      
							<?php } else{ ?>
							     
							
							
							
							<?php } 
							} ?>
							
							
					   </ol>
					</li>
					<li style="display:inline-block;vertical-align:top;margin:0 0 0 10px;float:right;"><h3>Status</h3>
					    <ol>
					<?php
					 
					      foreach($days as $value){
					      ?>
					      
						
					      <?php
					      $instance = $row_bingo['id'];// . '-' . strtotime($day[$value] . ' ' .$row_bingo['time_b'] . ' ' .  date('T'));
					   //   if(db_num_rows(db_query("select * from bingo_user_data where instance = '$instance' and userid = '$_SESSION[userid]'" )) >= 1){
					      if(db_num_rows(db_query("select * from bingo_numbers where instance = '$instance' ")) >= 1){
					      
						      if(db_num_rows(db_query("select * from bingo_winners where instance = '$instance' and place = 'third'")) == 0){
						    
							
							?><li style="font-size:16px;color:green;font-weight:bold;">Running</li><?php
							
							}else{
							
							?><li style="font-size:16px;color:red;font-weight:bold;">Game Over</li><?php
							
							}
						    }else{
						      $players = db_fetch_array(db_query("select count(distinct(userid)) from bingo_user_data where instance='$instance'"));
						      
						      
						    ?><li style="font-size:14px;color:blue;font-weight:bold;"><?php if(db_num_rows(db_query("select * from bingo_emails where status = 'delayed' and instance = '$instance'"))>=1){ echo "Delayed, waiting for <br />additional Players"; } else{ echo "Not yet started, <br />buy your cards now!"; } ?></li><?php
						    echo $players[0] . ' out of '. $row_bingo['min_players'] . ' min. players have joined';
						    
						    }
					   //   }
					      
					      }
					?>
					    </ol>
					</li>
				    </ul>
				</li>
			    </ul>
			    <?php
			    }
			    }else{
			    echo "<center><img src=\"css/ajaxy/morebingocomingsoon.png\" /></center>";
			    }
			    echo db_error();