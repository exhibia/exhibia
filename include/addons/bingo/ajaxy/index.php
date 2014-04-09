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
			      .large .ribbon {
				  width:auto!important;
				  height:50px!important;
				  margin: 0 -20px 0 20px;
				  z-index:1;
			      }
			      #live_ajax_auctions {
			      margin: 0 0 30px 0!important;
			      min-height:800px!important;
			      height:auto!important;
			      }
			      .live-auction {
				background: url("css/snapbids/live-auction-body-bg.png") no-repeat scroll 0 0 / 1033px 170px rgba(0, 0, 0, 0);
				height: 170px;
				margin: 10px auto 6px;
				width: 1033px;
			      }
			      .large .second {
				font-size:38px;
			      }
			      .large .third {
				font-size:38px;
			      }
			      .large .first {
				font-size:38px;
			      }
			      .accordion_body .second {
				font-size:19px;
			      }
			      .accordion_body .third {
				font-size:19px;
			      }
			      .accordion_body .first {
				font-size:19px;
			      }
			      .circle {
			      background-size:40px 40px;
			      background-image: url(<?php echo $SITE_URL;?>/include/addons/bingo/images/circle.png);
			      background-repeat:no-repeat;
			      color:#fff!important;
			      }
			           .accordion_body .circle {
			      background-size:20px 20px;
			      
			    }
			    .accordion_body .ribbon {
				  width:17px!important;
				  height:20px!important;
				  display:inline!important;
				 float:left!important;
				 z-index:1;
				 margin: 0 -10px 0 10px!important;
				 padding: 0 0 0 0!important;
			      
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
    function capitaliseFirstLetter(string)
    {
    return string.charAt(0).toUpperCase() + string.slice(1);
    }
    function update_cards(instance, userid){
    var balls = new Array();

    
    balls[instance] = '';
    if(!userid){
	userid = '<?php echo $_SESSION['userid'];?>';
    }
     if(!document.getElementById('stop_game_' + userid)){
    
    
   
    data_area =  "#game_area_" + userid;
		    $.ajax({ 
			    url: '<?php echo $SITE_URL; ?>/include/addons/bingo/update_info_bingo.php',
			    data: { userid : userid, instance_id: instance },
			    dateType: 'json',
			    type: 'post',
			  ajaxTimeout: 25000,
            success: function(response) {
               // if(response.message!='ok') return;

                var data=response.data;
           if(data.length == 0){
          // sClock(<?php echo date("H") . ',' . date("m") . ',' . date("s"). ',"' . date("D") . '"'; ?>);
			
	    }
                $.each(data, function(i, item) {
                
                
                
			$(data_area + ' .' + item.squares).addClass('circle');
			
			  if(item.winning_card){
			  
					  if($('#game_area_' + item.userid +  ' #card_' + item.winning_card).hasClass('user_' + item.userid) == true && !empty(item.userid) && $('#game_area_' + item.userid + ' #card_'  + item.winning_card + ' .' + item.winner).hasClass('user_' + item.userid) == true){
					        $('#game_area_' + item.userid + ' #card_' + item.winning_card).effect('highlight',{color: 'gold'},500);
					        $('#game_area_' + item.userid + ' #card_'  + item.winning_card + ' .' + item.winner).addClass('winner');
					    }
			 
			  }
			  
			      if(!empty(item.balls)){
			        column_row = item.balls.split('-');
			      
				balls[instance] += '<li class="' + column_row[0] + ' ball ball_' + instance + '">' + item.balls.replace('-', '') + '</li>';
			      }
			
		      if(item.places){
			$.each(item.places, function(place, place_data){
			console.log(place);
			t = 0;
			$.each(place_data, function(id,idx){
			
		          $.each(idx, function(wid, wname){
		        
		          
			      uname = idx.username;
			      uid = idx.userid;
			      card = idx.card;
			     
				if(!document.getElementById(place +'_' + uid)){
				      showAlertBox('Congratulations ' + uname + ' For winning ' + place + ' place');
				      bingo_sound();
				      
				  $('#' + place + '_place ul').append('<li id="'+ place + '_' + uid + '">' + uname + '</li>');
				  
				  }
				  
				       
					 
				
				    if(place == 'first'){
					$('#place_text_' + uid + '_' + card).html('<li><span class="first" style="text-align:center;color:blue;width:' + $('#place_text_' + uid + '_' + card).parent().css('width') + ';"><img src="include/addons/bingo/images/first.png" style="float:left;" class="ribbon" />1st Place</span></li>')
				    }else if(place == 'second' & !$('#place_text_' + uid + '_' + card + ' li span').hasClass('first')){
					$('#place_text_' + uid + '_' + card).html('<li><span class="second" style="text-align:center;color:red;width:' + $('#place_text_' + uid + '_' + card).parent().css('width') + ';"><img src="include/addons/bingo/images/second.png" style="float:left;" class="ribbon" />2nd Place</span></li>')
				    
				    }else if(place == 'third' & !$('#place_text_' + uid + '_' + card + ' li span').hasClass('first') & !$('#place_text_' + uid + '_' + card + ' li span').hasClass('second')){
					$('#place_text_' + uid + '_' + card).html('<li><span class="third" style="text-align:center;color:green;width:' + $('#place_text_' + uid + '_' + card).parent().css('width') + ';"><img src="include/addons/bingo/images/third.png" style="float:left;" class="ribbon" />3rd Place</span></li>')
				    
				    }
			          
			         
					
				  
			      
			      t++;
			  });
			  
			  });
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
		      setTimeout(function(){ update_cards(instance , userid ); },5000);
		    }
                });
                
		    
		    }
                }
                
                
		

		
		
	
</script>

        <!-- ============= Header =============  -->
        <div class="pagewidth">
            <?php include $BASE_DIR . '/include/' . $template . '/header.php'; ?>
        
            <div id="wrapper" class="clearfix">
                <div id="maincol">

                    <!-- ============= Live Auctions =============  -->
	
 <?php //include 'include/searchbox.php'; ?>
                   
                    <div class="clear"></div>
                    
                 
		  
			<div id="live_ajax_auctions">
			

			<?php
			
			if(empty($_REQUEST['game'])){
			
			      include("$BASE_DIR/include/addons/bingo/$template/game_list.php");
			
			  }else{
			  
			      
				include("$BASE_DIR/include/addons/bingo/$template/game.php");
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
<div class="clear"></div>