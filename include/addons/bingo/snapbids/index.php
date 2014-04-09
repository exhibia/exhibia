<?php	
$uid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : 0;
$changeimage = "home";
$pagename = "index";
if (!isset($_SESSION["ipid"]) && !isset($_SESSION["login_logout"])) {

    $_SESSION["ipid"] = date("Y-m-d G:i:s");

    $_SESSION["ipaddress"] = $_SERVER['REMOTE_ADDR'];



    $qryipins = "Insert into login_logout (ipaddress,load_time) values('" . $_SESSION["ipaddress"] . "', '" . $_SESSION["ipid"] . "')";

    db_query($qryipins) or die(db_error());
}

$featuredcount = Sitesetting::getFeaturedAuctionCount();

//if ( $_GET["ref"] != "" ) $_SESSION["refid"] = $_GET["ref"];
//first six products get by this query


//end for first nine products
function rearrange_array($array, $key) {
    while ($key > 0) {
        $temp = array_shift($array);
        $array[] = $temp;
        $key--;
    }
    return $array;
}
function create_time($timestamp){
    $time = $timestamp; // time duration in seconds

$days = floor($time / (60 * 60 * 24));
$time -= $days * (60 * 60 * 24);

$hours = floor($time / (60 * 60));
$time -= $hours * (60 * 60);
if(strlen($hours) == 1){
$hours = '0' . $hours;
}

$minutes = floor($time / 60);
$time -= $minutes * 60;
if(strlen($minutes) == 1){
$minutes = '0' . $minutes;
}
$seconds = floor($time);
$time -= $seconds;

if(strlen($seconds) == 1){
$seconds = '0' . $seconds;
}


if($days >= 1){
echo $days . ":";
}
echo "{$hours}:{$minutes}:{$seconds}";

}
?>
<?php $day = array("S" => "Sunday", "M" => "Monday", "T" => "Tuesday", "W" => "Wednesday", "Th" => "Thursday", "F" => "Friday", "Sa" => "Saturday"); ?>
<script type="text/javascript" src="include/addons/bingo/js/jquery.timer.js"></script>
<script>

				
</script>					
			      <style>
			      .live-auction {
				background: url("css/snapbids/live-auction-body-bg.png") no-repeat scroll 0 0 / 1033px 155px rgba(0, 0, 0, 0);
				height: 160px;
				margin: 10px auto 6px;
				width: 1033px;
			      }
			      .circle {
			      background-size:40px 40px;
			      background-image: url(<?php echo $SITE_URL;?>/include/addons/bingo/images/circle.png);
			      background-repeat:no-repeat;
			      color:#fff!important;
			      }
			      .ball {
			      display:inline-block;
			      background-size:40px 40px;
			      background-image: url(<?php echo $SITE_URL;?>/include/addons/bingo/images/ball.png);
			      background-repeat:no-repeat;
			      color:#000!important;
			      font-weight:bold!important;
			      min-height:40px!important;
			      min-width:40px!important;
			      padding-top:10px;
			      margin:3px;
			      font-size:15px;
			      text-align:center;
			      }
			      .balls_holder_outer {
			      background-image: url(<?php echo $SITE_URL;?>/include/addons/bingo/images/machine2.gif);
			      background-repeat:no-repeat;
			      min-height:157px;
			      }
			      .balls_holder {
			      left: -70px;
			      max-width: 600px;
			      min-width: 600px;
			      position: relative;
			      word-wrap: break-word;
			      overflow-y:auto;
			      }
			      .winner {
			      background-image: url(<?php echo $SITE_URL;?>/include/addons/bingo/images/star.gif);
			      background-repeat:no-repeat;
			      min-height:157px;
			      }
			      .circle span {
			      color:#fff!important;
			      }
			      #user_list {
			      display:none;
			      }
			      #chat {
			
				background-color: #1F497D !important;
				border-radius: 0 0 8px 8px;
				color: #000000 !important;
				display: block;
				font-size: 22px;
				min-height: 35px;
				min-width: 260px;
				position: relative;
				top: -22px;
				z-index: 2147483647;
				max-width: 350px;

			      }
			      #chat p {
			      text-align:center;
			      color:#fff;
			      padding-top:5px;
			      }
/* jQuery Countdown styles 1.6.3. */
.hasCountdown {
	
	
}
.countdown_rtl {
	direction: rtl;
}
.countdown_holding span {
	color: #888;
}
.countdown_row {
	clear: both;
	width: 100%;
	padding: 0px 2px;
	text-align: center;
}
.countdown_show1 .countdown_section {
	width: 98%;
}
.countdown_show2 .countdown_section {
	width: 48%;
}
.countdown_show3 .countdown_section {
	width: 32.5%;
}
.countdown_show4 .countdown_section {
	width: 24.5%;
}
.countdown_show5 .countdown_section {
	width: 19.5%;
}
.countdown_show6 .countdown_section {
	width: 16.25%;
}
.countdown_show7 .countdown_section {
	width: 14%;
}
.countdown_section {
	display: block;
	float: left;
	font-size: 75%;
	text-align: center;
}
.countdown_amount {
	font-size: 200%;
}
.countdown_descr {
	display: block;
	width: 100%;
}

			      </style>
<script>
    var instance;
    function bingo_sound(){
    
	  $('#sounds').append('<audio id="bingo_sound"  autoplay="true" preload><source src="<?php echo $SITE_URL;?>/include/addons/bingo/sounds/bingo.ogg" type="audio/ogg" /><source src="<?php echo $SITE_URL;?>/include/addons/bingo/sounds/bingo.mp3" autoplay="true" /><object data="<?php echo $SITE_URL;?>/include/addons/bingo/sounds/bingo.mp3" type="application/x-mplayer2" width="0" height="0"><param name="filename" value="<?php echo $SITE_URL;?>/include/addons/bingo/sounds/bingo.mp3"></object><embed type="application/x-mplayer2" src="<?php echo $SITE_URL;?>/include/addons/bingo/sounds/bingo.ogg" height="0" width="0" ></audio>');
    
    }
    function update_cards(instance){
    var balls = new Array();
    balls[instance] = '';
    
		    $.ajax({ 
			    url: '<?php echo $SITE_URL; ?>/include/addons/bingo/update_info_bingo.php',
			    data: { userid : '<?php echo $_SESSION['userid'];?>', instance_id: instance },
			    dateType: 'json',
			    type: 'post',
			  
            success: function(response) {
               // if(response.message!='ok') return;

                var data=response.data;
           if(data.length == 0){
          // sClock(<?php echo date("H") . ',' . date("m") . ',' . date("s"). ',"' . date("D") . '"'; ?>);
			
	    }
                $.each(data, function(i, item) {
                
                
                
			$('.' + item.squares).addClass('circle');
			
		    if(item.winning_card){
			$('#data_area_' + item.userid + '#card_' + item.winning_card).effect('highlight',{color: 'gold'},500);
		    
			$('#data_area_' + item.userid + '#card_' + item.winning_card + ' .' + item.winner).addClass('winner');
			
		    }
			
			      if(!empty(item.balls)){
			        column_row = item.balls.split('-');
			      
				balls[instance] += '<li class="' + column_row[0] + ' ball ball_' + instance + '">' + item.balls.replace('-', '') + '</li>';
			      }
			   
		      if(item.first_place){
		          $.each(item.first_place, function(t, first){
			      if(!document.getElementById('first_' + t)){
				showAlertBox('Congratulations ' + first + ' For winning first place');
				bingo_sound();
			     
			    
			      $('#first_place ul').append('<li id="first_' + t + '">' + first + '</li>');
			      }
			  });
		          
		      }
		      if(item.second_place){
			  $.each(item.second_place, function(t, second){
			      if(!document.getElementById('second_' + t)){
				showAlertBox('Congratulations ' + second + ' For winning second place');
				bingo_sound();
			      
			    
			      $('#second_place ul').append('<li id="second_' + t + '">' + second + '</li>');
			      }
			  });
			 
		      }	
		      if(item.third_place){
		      
			$.each(item.third_place, function(t, third){
			     if(!document.getElementById('third_' + t)){
				showAlertBox('Congratulations ' + third + ' For winning third place');
				bingo_sound();
			      
			      
				$('#third_place ul').append('<li id="third_' + t + '">' + third + '</li>');
			      }
			  });
		      }
		      if(!empty(item.sound)){
			if(!document.getElementById('sound_' + item.sound)){
			      $('#sounds').append('<audio id="sound_' + item.sound + '" preload  autoplay="true"><source src="<?php echo $SITE_URL;?>/include/addons/bingo/sounds/' + item.sound +'.ogg" type="audio/ogg" /><source src="<?php echo $SITE_URL;?>/include/addons/bingo/sounds/' + item.sound +'.mp3" /><object data="<?php echo $SITE_URL;?>/include/addons/bingo/sounds/' + item.sound +'.mp3" type="application/x-mplayer2" width="0" height="0"><param name="filename" value="<?php echo $SITE_URL;?>/include/addons/bingo/sounds/' + item.sound +'.mp3"></object><embed type="application/x-mplayer2" src="<?php echo $SITE_URL;?>/include/addons/bingo/sounds/' + item.sound +'.ogg" height="0" width="0" ></audio>');
			      
			  
			  }
			
			}
			      if(item.game_over == 'true'){
				if($('#game_status_over').html() == ''){
				    showAlertBox('Game Over');
				}
				  $('#game_status_over').html('Game Over') == 'Game Over';
			      }
			    if(item.started == 'true'){
			   
			      $('#balls_' + instance).html(balls[instance]);
			    }else{
		
			    if(!item.delayed){
			    //  sClock(<?php echo date("H") . ',' . date("m") . ',' . date("s"). ',"' . date("D") . '"'; ?>);
			    }else{
			    
				$('#balls_' + instance).html('<h2>Delayed, waiting for more players to join</h2>');
			    }
			    } 
			
		      });
		    }
                });
                
		    setTimeout("update_cards('" + instance + "')",1000);
                }
                
                
		
		
		
		
	
</script>

        <!-- ============= Header =============  -->
        <div class="pagewidth">
            <?php include $BASE_DIR . '/include/' . $template . '/header.php'; ?>
        </div>
        <!-- ============= End Header =============  -->

   
        <div class="pagewidth">
            <div id="wrapper" class="clearfix">
                <div id="maincol">

                    <!-- ============= Live Auctions =============  -->
	
 <?php //include 'include/searchbox.php'; ?>
                   
                    <div class="clear"></div>
                    
                 
		  
			<div id="live_ajax_auctions">
			

			<?php
			
			if(empty($_REQUEST['game'])){
			?>
						<a href="javascript:;" onclick="show_winners();" style="background: url(include/addons/bingo/images/winners.png) no-repeat scroll 0 0 rgba(0, 0, 0, 0);
color: #FFFFFF;
float: right;
font-size: 26px;
font-weight: bold;
width: 140px;
height: 40px;
margin-right: 30px;
margin-top: 20px;
text-align: center;
padding-top: 5px;">Winners</a>
<div class="clear"></div>
<?php
			    $bingo_sql = db_query("select * from bingo_games where finished != '1' and finished != '2' order by date, time_b desc");
			 
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
					<li style="vertical-align:top;display:inline-block;width:200px;margin:10px 0 0 20px;cursor:pointer;"><h3  id="game_name_<?php echo $row_bingo['id']; ?>"><?php echo $row_bingo['name']; ?></h3>
					<p><span style="font-weight:bold;">Start Time: </span><span id="start_time_<?php echo $row_bingo['id'];?>"><?php echo $row_bingo['time_b'] . '</span> ' . date('A', strtotime($row_bingo['time_b'])) . ' ' .  $days_array[$days[0]] . ' ' . date('T'); ?></p>
					
					
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
									
								  }
							      }else{ 
							      
							      if(db_num_rows(db_query("select * from bingo_user_data where userid = '$_SESSION[userid]' and instance = '$row_bingo[id]'")) >= 1){
							      
							      ?>
							
								    
							      <li>
								    <a style="float:right;" class="bingo_button2" href="bingo.php?game=<?php echo $instance; ?>">Go to game</a>
							      </li>  
							      
							<?php } 
							
							}
							
							?>
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
			    echo db_error();
			  }else{
			  
			      $sql = db_query("select distinct(card) from bingo_user_data where instance = '$_REQUEST[game]' and userid = '$_SESSION[userid]'" );
			      
			      $game_data = db_fetch_array(db_query("select * from bingo_games where id = '$_REQUEST[game]'"));
			  ?>
			  <script>
			  update_cards('<?php echo $_REQUEST['game']; ?>');
			  
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
				
				
				    <ul id="winners" style="float: right;font-size: 16px;text-align: left;margin: 10px 0 0 -40px;">
					<li style="    color: #008000; font-size: 26px;   font-weight: bold;  margin: -10px 0 0 40px; padding-bottom: 10px;  text-decoration: underline;">Winners</li>
					<li style="font-size:14px;"><b>First:</b><span id="first_place"><ul style="font-size:10px;"></ul></span></li>
					<li style="font-size:14px;"><b>Second:</b><span id="second_place"><ul style="font-size:10px;"></ul></span></li>
					<li style="font-size:14px;"><b>Third:</b><span id="third_place"><ul style="font-size:10px;"></ul></span></li>
					<li id="game_status_over" style="font-size:22px;color:red;font-weight:bold;"></li>
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
			  <?php
			      while($row = db_fetch_array($sql)){
			      $letters = array("B", "I", "N", "G", "O");
			      $card = '';
				$card .= '<li id="card_' .$row['card'] . '" style="float:left;background-color:#CACACA;color:#fff!important;font-size:42px;max-width:320px!important;height:285px;border-radius:6px;margin: 5px 17px 5px 18px;">';
					  
					  $card .= '<ul style="list-style:none;color:#fff!important;font-weight:bold;padding:5px 0 5px 0;">
						      <li style="display:inline;width:60px;padding: 0 5px 0 5px;">B</li>
						      <li style="display:inline;width:60px;padding: 0 5px 0 5px;">I</li>
						      <li style="display:inline;width:60px;padding: 0 5px 0 5px;">N</li>
						      <li style="display:inline;width:60px;padding: 0 5px 0 5px;">G</li>
						      <li style="display:inline;width:60px;padding: 0 5px 0 5px;">O</li>
						   </ul>';
					  
					  $card .= '<ol class="card_data" style="width:220px;margin-left:8px;">';
					  $p = 1;
				   foreach($letters as $letter){				
						$card .= '<li class="' . $letter. '" style="float:left;">
							    <dl style="background-color: #FFFFFF !important;word-wrap:break-word;border-left: 2px solid #CACACA;border-right: 2px solid #CACACA;font-size:18px;">'; 
			      
			   
			      
							      $sql_card = db_query("select * from bingo_user_data where instance = '$_REQUEST[game]' and userid = '$_SESSION[userid]' and card = '$row[card]' and number like '$letter-%'" );
								  while($row_card = db_fetch_array($sql_card)){
				         
					 
					  
								    $card .= '<dd style="';
								    
								    
								    if($row_card['marked'] == 1){
								    
								    $card .= '';
								    
								    $card .= 'text-align:center;vertical-align:center;min-width:39px!important;min-height:40px;border-right:1px solid #000;border-bottom:1px solid #000;color:#fff;" class="circle ' . $row_card['number'] . '"><span style="position:relative;top:10px;color:#fff;">';
								    
									if($p != 13){
									    $card .= str_replace("$letter-", "", $row_card['number']);
									}else{
									    
									
									}
								    $card .= ' </span></dd>';
								    
								    }else{
								    
								    $card .= 'text-align:center;vertical-align:center;min-width:39px!important;min-height:40px;border-right:1px solid #000;border-bottom:1px solid #000;" class="' . $row_card['number'] . '"><span style="position:relative;top:10px;color:#000;">' .str_replace("$letter-", "", $row_card['number']) . '</span></dd>';
								    
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
			  }
			?>

			</div>

                      
<script>
 function show_winners(offset){
				  if(!offset){
				  offset = 0;
				  }
				  $.ajax({
					url: '<?php echo $SITE_URL;?>include/addons/bingo/winners.php',
					data: { offset:offset },
					dataType: 'html',
					success: function(response){
					    $('#live_ajax_auctions').html(response);
					}
				  
				  })
			      }
    function buy_cards(id, date){
	$('#card_prompt form').html('Loading');
    
	$('#card_prompt').dialog({ title: '"' + $('#game_name_' + id).html() + '"' + ' ' + new Date(date * 1000), width:510, height:650, modal: true } );
	$.ajax({
	      url: '<?php echo $SITE_URL;?>/include/addons/bingo/buy_cards.php',
	      data: { id: id, date: date },
		dataType: 'html',
		type: 'get',
		success: function(response){
		  $('#card_prompt form').html(response);
		//  update_card_info();
		      $("#my_cards").bind('onblur, change, keyup, click', function(){ 
			     update_card_info() 
			});;

		}
	
	});
	
    }
</script>
  <div id="card_prompt" style="display:none;"><form action="javascript:submit_card_payment();">Loading</form></div>
       

   <script>
function create_blank_card(num){
  var card = '';
  
  for(i=0; i < num; i++){

      card += '<li style="float:left;background-color:#CACACA;color:#fff!important;font-size:16px;max-width:120px!important;height:130px;border-radius:6px;margin: 5px 5px 5px 5px;">';
      card += '<ul style="list-style:none;color:#fff!important;font-weight:bold;padding:5px 0 5px 0;"><li style="display:inline;width:20px;padding: 0 5px 0 5px;">B</li><li style="display:inline;width:20px;padding: 0 5px 0 5px;">I</li><li style="display:inline;width:20px;padding: 0 5px 0 5px;">N</li><li style="display:inline;width:20px;padding: 0 5px 0 5px;">G</li><li style="display:inline;width:20px;padding: 0 5px 0 5px;">O</li></ul>';
      card += '<ul style="background-color: #FFFFFF !important;max-width: 100px !important;border-left: 2px solid #CACACA;border-right: 2px solid #CACACA;">'; 
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

function submit_card_payment(){
data = $('#card_prompt form').serialize();
$('#card_prompt form').html('Submitting');
      $.ajax({
	      url: '<?php echo $SITE_URL; ?>/include/addons/bingo/join_game.php',
	      data: data,
	      dataType: 'html',
	      type: 'post',
	      success: function(response){
		  if(response != ''){
	      
		  $('#card_prompt form').html(response);
		  
		  }else{
		      window.location.href = window.location.href;
		  
		  }
	      
	      }
	})
}

</script> 
</div>
</div>
</div>