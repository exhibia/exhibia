<style>
#cabinet {
background: url("http://pennyauctionsoftdemo.com/include/addons/games-server/slots/image/wood.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
border: 1px solid #000000;
border-radius: 20px;
left: 120px;
min-height: 820px;
position: relative;
top: 75px;
width: 475px;
left: -10px;
}
#wheelcanvas {
position: relative;
top: -50px;
left: -30px;
}
#game_area {
min-height:900px;
}
#game_info {
  position: absolute;
  top: 120px;
  left: 500px;
  font-weight:bold;
}
#felt {
background: url("<?php echo $games_server;?>/include/addons/games-server/roulette/images/felt.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
border-radius: 20px;
box-shadow: -6px -6px 4px #666666 inset;
display: block;
height: 790px;
margin: 15px;
width: 445px;
border: 1px solid #000;
}
#spots {
left: 45px;
list-style: none outside none;
margin: 10px;
max-width: 280px;
position: relative;
top: -55px;
}

#spots li {
border: 1px solid #808080;
color: #FFFFFF;
display: inline-block;
font-size: 20px;
min-height: 20px;
min-width: 25px;
padding: 10px 8px 7px;
text-align: center;
vertical-align: middle;
}
#chip_holder {
left: 50px;
max-height: 35px;
position: absolute;
top: 450px;
width: 35px;
color:#fff;
text-align:center;
}
#spin {
background-color: #0000FF;
border-radius: 10px;
box-shadow: 6px 6px 6px #666666;
color: #FFFFFF;
font-size: 25px;
height: 30px;
left: 185px;
padding: 5px 20px 35px;
position: relative;
text-transform: uppercase;
top: 20px;
z-index: 2147483647;

}
#sides {
color: #FFFFFF !important;
float: right;
height: auto;
left: 215px;
min-height: 400px;
min-width: 400px;
position: relative;
top: -290px;
width: auto;
}
#side_spots {


}
#side_spots_two {
font-size: 12px !important;
left: 55px;
position: relative;
top: -193px;

}
#side_spots li {
background-color: #CACACA;
border: 1px solid #808080;
color: #000000;

font-size: 20px;
height: 35px;
left: 25px;
margin: 5px;
padding: 10px 0 0;
position: relative;
text-align: center;
transform: rotate(-90deg);
-moz-transform: rotate(-90deg);
-webkit-transform: rotate(-90deg);
-khtml-transform: rotate(-90deg);
-o-transform: rotate(-90deg);
-sand-transform: rotate(-90deg);
width: 85px;
}
#side_spots_two li {
background-color: #CACACA;
border: 1px solid #808080;
color: #000000;

font-size: 12px;
height: 35px;
left: 25px;
margin: 5px;
padding: 10px 0 0;
position: relative;
text-align: center;
transform: rotate(-90deg);
-moz-transform: rotate(-90deg);
-webkit-transform: rotate(-90deg);
-khtml-transform: rotate(-90deg);
-o-transform: rotate(-90deg);
-sand-transform: rotate(-90deg);
width: 50px;
}
.chip {
width:30px;
height:30px;
background:url(<?php echo $games_server;?>/include/addons/games-server/roulette/images/red-checker.png);
background-repeat:no-repeat;
background-size:30px 30px;
}
#first_12 {
position:relative;
top:-20px;
}
#second_12 {
position:relative;
top:15px;
}
#third_12 {
position:relative;
top:50px;
}

</style>





<div id="cabinet">
<input type="button" value="spin" onclick="spin();" style="float: left;" id="spin" />

  <div id="felt">
    <canvas id="wheelcanvas" width="500" height="500"></canvas>
    
	  
	    <ul id="spots" >
	    
	    
	    </ul>
	    <div id="sides" >
	      <ul id="side_spots" >
		  <li id="first_12" alt="first_12" class="droppable">1st 12</li>
		  <li id="second_12" alt="2nd_twelve" class="droppable">2nd 12</li>
		  <li id="third_12" alt="3rd_twelve" class="droppable">3rd 12</li>
	      </ul>
	      <ul id="side_spots_two" >
		  <li id="1to18" alt="1to18" class="droppable">1 to 18</li>
		  <li id="even" alt="even" class="droppable">Even</li>
		  <li id="red" alt="red" class="droppable">Red</li>
		  <li id="black" alt="black" class="droppable">Even</li>
		  <li id="19to36" alt="19to36" class="droppable">19 to 36</li>
	      </ul> 
	    </div>
   
    <div id="chip_holder"></div>
  </div>
  
</div>
<div style="float:right;vertical-align:top;" id="game_info">
		      <?php
		    
		      if($master_game_settings['allow_user_bid_price'] == 'yes'){  ?>
			  <label style="float:left;margin-right:20px;margin-left:25px;font-weight:bold;font-size:16px;">Bet</label>
			  <input type="text" value="<?php echo $master_game_settings['price_per_bid'];?>" style="border-radius:10px;" id="bids_placed" />
			  <label style="display:inline;margin-right:10px;font-weight:bold;font-size:16px;margin-top:8px;"><?php echo ucfirst(str_replace("_", "", $html_element_prefix)); ?> Bids</label>
		      <?php }else{ ?>
		      <label style="float:left;margin-right:20px;margin-left:25px;margin-top:2px;font-weight:bold;font-size:16px;">Max Bet: </label>
			<label style="display:inline;font-weight:bold;font-size:16px;margin-top:8px;position:relative;top:2px;color:#000;"><?php echo $master_game_settings['price_per_bid'];?></label><input type="hidden" value="<?php echo $master_game_settings['price_per_bid'];?>" style="height:25px;width:120px;border-radius:10px;" id="bids_placed" />
			<label style="display:inline;margin-right:20px;margin-left:5px;margin-top:8px;position:relative;top:2px;font-weight:bold;font-size:16px;color:#000!important;"><?php echo ucfirst(str_replace("_", "", $html_element_prefix_to)); ?> Bids</label>
		      
		      <?php } ?>
		      <br />
				    <input type="hidden" name="me" id="me" value="<?php echo $_REQUEST['username']; ?>" />
				    <input type="hidden" name="domain" id="domain" value="<?php echo str_replace("www.", "", $_REQUEST['domain']); ?>" />
				    
				    
				    <input type="hidden" name="whos_turn" id="whos_turn" value="<?php echo $whos_turn; ?>" />
				    
				    <input type="hidden" name="opponent" id="opponent" class="opponents" value="<?php echo $opponent; ?>" />
				    
				    <input type="hidden" name="game_instance_id" id="game_instance_id" value="<?php echo $data->gameID; ?>" />
				    <audio id="piece_drop"></audio>
				    <audio id="spin_sound"></audio>
				    <audio id="dealer_voice"></audio>
				    
		  <div style="display:none;" id="take_from"><?php echo $connect4['take_from']; ?>_count</div>
		  <p>Cost of Game <span id="bids_to_take"><?php echo $connect4['take']; ?></span> <span id="take_from_txt"><?php echo ucwords(str_replace("_", " ", $connect4['take_from'])); ?></span></p>
		  <p>Prize <span id="reward"><?php echo $connect4['reward']; ?></span> <span id="reward_with"><?php echo ucwords(str_replace("_", " ", $connect4['reward_with'])); ?></span></p>

</div>
<script type="application/javascript">
  var colors = ["red", "black"];
  var restaraunts = [0, 28, 9, 26, 30, 11, 7, 20, 32, 17, 5, 22, 34, 15, 3, 24, 36, 13, 1, 27, 10, 25, 29, 12, 8, 19, 31, 18, 6, 21, 33, 16, 4, 23, 35, 14, 2]
  
  
  var startAngle = 0;
  var arc = Math.PI / 18;
  var spinTimeout = null;
  
  var spinArcStart = 10;
  var spinTime = 0;
  var spinTimeTotal = 0;
  
  var ctx;
      for(var i = 0; i < 10; i++) {
	  if($('#chip_' +i).length ==0 ){
	    $('#chip_holder').prepend('<div class="chip" style="position:absolute;z-index:' + (parseInt(i) * 50) + ';" >Me</div>');
	  }
      }
      
  function draw() {
    drawRouletteWheel();
  }
  
  function drawRouletteWheel() {
    var canvas = document.getElementById("wheelcanvas");
    if (canvas.getContext) {
      var outsideRadius = 200;
      var textRadius = 160;
      var insideRadius = 125;
      
      ctx = canvas.getContext("2d");
      ctx.clearRect(0,0,500,500);
      
      
      ctx.strokeStyle = "black";
      ctx.lineWidth = 2;
      
      ctx.font = 'bold 12px sans-serif';
      
      for(var i = 0; i < 36; i++) {
      
	if(i == 0){
	      spot_color = "green";
	}else{
	  if(i % 2 == 0){
	    spot_color = "black";
	  }else{
	  
	    spot_color = "red";
	  }
	}
      if($('#spot_' + i).length == 0){ 
	  $('#spots').append("<li id='spot_" + i + "' alt='" + i + "' style='background-color:" + spot_color + ";' class='droppable'>" + i + "</li>");
      }
        var angle = startAngle + i * arc;
       
      if(i == 0){
	  ctx.fillStyle = "green";
      }else{
	  if(i % 2 == 0){
	    ctx.fillStyle = "black";
	  }else{
	  
	    ctx.fillStyle = "red";
	  }
      }       
        ctx.beginPath();
        ctx.arc(250, 250, outsideRadius, angle, angle + arc, false);
        ctx.arc(250, 250, insideRadius, angle + arc, angle, true);
        ctx.stroke();
        ctx.fill();
        
        ctx.save();
        ctx.shadowOffsetX = -1;
        ctx.shadowOffsetY = -1;
        ctx.shadowBlur    = 0;
        ctx.shadowColor   = "rgb(220, 220, 220)";
      if(restaraunts[i] == 0){
	  ctx.fillStyle = "red";
      }else{
	  if(restaraunts[i] % 2 == 0){
	    ctx.fillStyle = "white";
	  }else{
	  
	    ctx.fillStyle = "white";
	  }
      }
        ctx.translate(250 + Math.cos(angle + arc / 2) * textRadius, 250 + Math.sin(angle + arc / 2) * textRadius);
        ctx.rotate(angle + arc / 2 + Math.PI / 2);
        var text = restaraunts[i];
        ctx.fillText(text, -ctx.measureText(text).width / 2, 0);
        ctx.restore();
      } 
      
      //Arrow
      ctx.fillStyle = "black";
      ctx.beginPath();
      ctx.moveTo(250 - 4, 250 - (outsideRadius + 5));
      ctx.lineTo(250 + 4, 250 - (outsideRadius + 5));
      ctx.lineTo(250 + 4, 250 - (outsideRadius - 5));
      ctx.lineTo(250 + 9, 250 - (outsideRadius - 5));
      ctx.lineTo(250 + 0, 250 - (outsideRadius - 13));
      ctx.lineTo(250 - 9, 250 - (outsideRadius - 5));
      ctx.lineTo(250 - 4, 250 - (outsideRadius - 5));
      ctx.lineTo(250 - 4, 250 - (outsideRadius + 5));
      ctx.fill();
    }
   $('.chip').draggable({
    drag: function( event, ui ) {
        var snapTolerance = $(this).draggable('option', 'snapTolerance');
        var topRemainder = ui.position.top % 20;
        var leftRemainder = ui.position.left % 20;

        if (topRemainder <= snapTolerance) {
            ui.position.top = ui.position.top - topRemainder;
        }

        if (leftRemainder <= snapTolerance) {
            ui.position.left = ui.position.left - leftRemainder;
        }
    } ,
    
    revert : function(event, ui) {
            // on older version of jQuery use "draggable"
            // $(this).data("draggable")
            // on 2.x versions of jQuery use "ui-draggable"
            // $(this).data("ui-draggable")
            $(this).data("uiDraggable").originalPosition = {
                top : 0,
                left : 0
            };
            // return boolean
            return !event;
            // that evaluate like this:
            // return event !== false ? false : true;
        }
  
  });
       $('.droppable').droppable({
	    accept: ".chip",
	    
		drop: function( event, ui ) {
		    var draggableId = ui.draggable.attr("id");
		    var droppableIdx = $(this).attr("alt");
		    var droppableId = $(this).attr("id");
		    $('#' + droppableId).addClass('bet_placed');
		    //get_other_user_chips('<?php echo $_REQUEST['username']; ?>');
		}
	    });
      
      
   
  }
  
  function spin() {
    spinAngleStart = Math.random() * 10 + 10;
    spinTime = 0;
    spinTimeTotal = Math.random() * 3 + 4 * 1000;
    rotateWheel();
  }
  
  function rotateWheel() {
    spinTime += 30;
    if(spinTime >= spinTimeTotal) {
      stopRotateWheel();
      return;
    }
    var spinAngle = spinAngleStart - easeOut(spinTime, 0, spinAngleStart, spinTimeTotal);
    startAngle += (spinAngle * Math.PI / 180);
    drawRouletteWheel();
    spinTimeout = setTimeout('rotateWheel()', 30);
  }
  
  function stopRotateWheel() {
    clearTimeout(spinTimeout);
    var degrees = startAngle * 180 / Math.PI + 90;
    var arcd = arc * 180 / Math.PI;
    var index = Math.floor((360 - degrees % 360) / arcd);
    ctx.save();
    ctx.font = 'bold 30px sans-serif';
    var text = restaraunts[index]
    ctx.fillText(text, 250 - ctx.measureText(text).width / 2, 250 + 10);
    ctx.restore();
  }
  
  function easeOut(t, b, c, d) {
    var ts = (t/=d)*t;
    var tc = ts*t;
    return b+c*(tc + -3*ts + 3*t);
  }
 /* function get_other_user_chips('<?php echo $_REQUEST['username']; ?>', reload){
      var chips = '';
      $('.droppable').each(function(){
	  
	    chips += $(this).attr('alt') + ',';
      
      });
      $.ajax({
	  url: '<?php echo $games_server;?>/include/addons/games/get_opponent_data.php',
	  crossDomain: true,
	  dataType : 'json',
	  data: { username: '<?php echo $_REQUEST['username']; ?>', domain: '<?php echo $_REQUEST['domain']; ?>', game: 'roulette', gameInstanceID : $('#instance_id').val(), my_chips: chips }
	    success: function(response){
	    
	    
	    
	    }
   
   
	});
	if(reload == 'true'){
	  setTimeout("get_other_user_chips('<?php echo $_REQUEST['username']; ?>');", 3000);
	}
    }*/  
  draw();
  $(document).ready(function(){
     
//     get_other_user_chips('<?php echo $_REQUEST['username']; ?>', 'true');
 
   
   });
</script>
