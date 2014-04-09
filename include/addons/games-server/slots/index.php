<?php 
//if(empty($games_server)){

require("$BASE_DIR/include/addons/games-server/config.inc.php"); 
//}


?>
<link href='http://fonts.googleapis.com/css?family=Gravitas+One&text=1234567' rel='stylesheet' type='text/css'>

<!-- Syntax highlighting, ignore this -->
<link rel="stylesheet" href="<?php echo $games_server; ?>include/addons/games-server/slots/SyntaxHighlighter/Styles/SyntaxHighlighter.css" type="text/css" media="screen" title="no title" charset="utf-8">
<script>

(function ($)
{
    // Zachary Johnson
    // http://www.zachstronaut.com
    // December 2009
    
    $.fn.ignite = function (burn)
    {
   
        $(this).each(
            function ()
            {
           
                var letters = $(this).text().split('');
                $(this).html('<span>' + letters.join('</span><span>') + '</span>');
                $spans = $(this).find('span');
                setInterval(function () {$spans.each(burn);}, 200);
            }
        );
    }
})(jQuery);


function gasFlame()
{
    // Zachary Johnson
    // http://www.zachstronaut.com
    // December 2009
   
   colors = ['#fff', '#99f', '#00f', '#009'];
    
    if (Math.random() > 0.90)
    {
       // colors.push('#f90');
    }
    
    var hv = 0.009;
    
    textShadows = [];

    var c = 0;
    var h = 0;
    var s = 0;

    while (c < colors.length)
    {
        s = 2 + Math.round(Math.random() * 2);

        while (s--)
        {
            shadow = '0 ' + h + 'em ' + -h + 'em ' + colors[c];

            textShadows.push(shadow);

            h -= hv;
        }

        c++;
    }

    $(this).css({color: '#a6a6d9', textShadow: textShadows.join(', ')});
}

function redFlame()
{
    // Zachary Johnson
    // http://www.zachstronaut.com
    // December 2009
   
     colorsRed = ['#fff', '#f38b7a', '#ff2400', '#b52912'];
    
    if (Math.random() > 0.90)
    {
       // colors.push('#f90');
    }
    
    var hv = 0.009;
    
    textShadowsRed = [];

    var c = 0;
    var h = 0;
    var s = 0;

    while (c < colorsRed.length)
    {
        s = 2 + Math.round(Math.random() * 2);

        while (s--)
        {
            shadowRed = '0 ' + h + 'em ' + -h + 'em ' + colorsRed[c];

            textShadowsRed.push(shadowRed);

            h -= hv;
        }

        c++;
    }

    $(this).css({color: 'red', textShadow: textShadowsRed.join(', ')});
}


function greenFlame()
{

    // Zachary Johnson
    // http://www.zachstronaut.com
    // December 2009
    
     colorsGreen = ['#fff', '#87f', '#008', '#006'];
   
    if (Math.random() > 0.90)
    {
       // colors.push('#f90');
    }
    
    var hv = 0.009;
    
   textShadowsGreen = [];

    var c = 0;
    var h = 0;
    var s = 0;

    while (c < colorsGreen.length)
    {
        s = 2 + Math.round(Math.random() * 2);

        while (s--)
        {
            shadowGreen = '0 ' + h + 'em ' + -h + 'em ' + colorsGreen[c];

            textShadowsGreen.push(shadowGreen);
           

            h -= hv;
        }

        c++;
    }

    $(this).css({color: 'green', textShadow: textShadowsGreen.join(', ')});
}
$(begin);

function begin()
{

		
    $('#alert_area').ignite(gasFlame);
}







/*
function flame()
{
    var colors = ['#000', '#fff', '#ff0', '#f90', '#f00'];
    
    //var colors = ['#fff', '#99f', '#00f', '#009'];
    
    if (Math.random() > 0.90)
    {
        colors.push('#000');
        colors.push('#c00');
        
        //colors.push('#f90');
    }
    
    var textShadows = [];
    
    var c = 0;
    
    var h = 0;
    
    var s = 0;
    
    while (c < colors.length)
    {
        s = 2 + Math.round(Math.random() * 2);

        while (s--)
        {
            shadow = '0 ' + h + 'em ' + -h + 'em ' + colors[c];

            textShadows.push(shadow);
            
            //h -= 0.05;
            
            h -= 0.04;
        }
        
        c++;
    }
    
    $(this).css({color: colors[0], textShadow: textShadows.join(', ')});
}*/

</script>


<style type="text/css">


ul {
    padding: 0;
    margin: 0;
    list-style: none;
}

.jSlots-wrapper {
    overflow: hidden;
    height: 20px;
    display: inline-block; /* to size correctly, can use float too, or width*/
    border: 1px solid #999;
    margin-left:40px;
    

}

#slot {
    position:relative;
    
}
.slot {
    float: right;

}
#slots_outer {

}
input[type="button"] {
    display: block;
}

/* ---------------------------------------------------------------------
   FANCY EXAMPLE
--------------------------------------------------------------------- */
.fancy .jSlots-wrapper {
border: 1px solid #999999;
display:inline-block;
height: 120px;
overflow: hidden;
border-radius:6px;
margin-left:25px;

}
#slots_outer {
background: none repeat scroll 0 0 #5A5A5A;
border-radius: 10px 10px 10px 10px;

height: 120px;
left: 15px;
margin-bottom: 8px;
padding: 10px;
position: relative;
width: 425px;
top: -10px;
}

.fancy .slot li {
    width: 120px;
    line-height: 100px;
    text-align: center;
    font-size: 70px;
    font-weight: bold;
    color: #fff;
    text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.8);
    font-family: 'Gravitas One', serif;
    border-right: 1px solid #999;
     background: url("<?php echo $games_server; ?>/include/addons/games-server/slots/image/bg.png") no-repeat;
     position:relative;
     z-index:1;
}

.fancy .slot:first-child li {
   
    margin-right:2px;
    
}
.fancy .slot:last-child li {

margin-left:2px;
}


.fancy .slot li span {
    display: block;
}

/* ---------------------------------------------------------------------
   ANIMATIONS
--------------------------------------------------------------------- */

@-webkit-keyframes winner {
        0%, 50%, 100% {
            -webkit-transform: rotate(0deg);
            font-size:70px;
            color: #fff;
        }
        25% {
            -webkit-transform: rotate(20deg);
            font-size:90px;
            color: #FF16D8;
        }
        75% {
            -webkit-transform: rotate(-20deg);
            font-size:90px;
            color: #FF16D8;
        }
}
@-moz-keyframes winner {
        0%, 50%, 100% {
            -moz-transform: rotate(0deg);
            font-size:70px;
            color: #fff;
        }
        25% {
            -moz-transform: rotate(20deg);
            font-size:90px;
            color: #FF16D8;
        }
        75% {
            -moz-transform: rotate(-20deg);
            font-size:90px;
            color: #FF16D8;
        }
}
@-ms-keyframes winner {
        0%, 50%, 100% {
            -ms-transform: rotate(0deg);
            font-size:70px;
            color: #fff;
        }
        25% {
            -ms-transform: rotate(20deg);
            font-size:90px;
            color: #FF16D8;
        }
        75% {
            -ms-transform: rotate(-20deg);
            font-size:90px;
            color: #FF16D8;
        }
}


@-webkit-keyframes winnerBox {
        0%, 50%, 100% {
            box-shadow: inset 0 0  0px yellow;
            background-color: #FF0000;
        }
        25%, 75% {
            box-shadow: inset 0 0 30px yellow;
            background-color: aqua;
        }
}
@-moz-keyframes winnerBox {
        0%, 50%, 100% {
            box-shadow: inset 0 0  0px yellow;
            background-color: #FF0000;
        }
        25%, 75% {
            box-shadow: inset 0 0 30px yellow;
            background-color: aqua;
        }
}
@-ms-keyframes winnerBox {
        0%, 50%, 100% {
            box-shadow: inset 0 0  0px yellow;
            background-color: #FF0000;
        }
        25%, 75% {
            box-shadow: inset 0 0 30px yellow;
            background-color: aqua;
        }
}



.winner li {
    -webkit-animation: winnerBox 2s infinite linear;
       -moz-animation: winnerBox 2s infinite linear;
        -ms-animation: winnerBox 2s infinite linear;
}
.winner li span {
     -webkit-animation: winner 2s infinite linear;
        -moz-animation: winner 2s infinite linear;
         -ms-animation: winner 2s infinite linear;
}

/* Syntax Highlighter, ignore */
.dp-highlighter ol {
    padding: 10px;
}
#playFancy {
position:absolute;
float:left;
height:400px;
width:110px;
margin:0px 0px 0px 30px;


}
.slot li img {
width: 120px;
height: 120px;
}


.you_won {
  background:transparent url("<?php echo $games_server; ?>/img/fireworks.gif") 55px 20px no-repeat;
  background-size:50px auto;
}
.you_won h2 {
  color:green!important;
}

.sold  {
  color:red!important;
}
.ended  {
  color:blue!important;
}
.bar {

background:url("<?php echo $games_server; ?>/include/addons/games-server/slots/image/lose-bar.png") no-repeat;
position:relative;
top:98px;
z-index:10000;
margin-bottom:-98px;

}
#alert_area{
background: url("<?php echo $games_server; ?>/include/addons/games-server/slots/image/bg2.png") repeat-x scroll 80px center transparent;
border: 1px solid #000000;
border-radius: 10px 10px 10px 10px;
box-shadow: 5px 5px 5px #666666;
color: blue;
font-size: 45px;
font-weight: bold;
height: 60px;
left: 15px;
margin-top: -10px;
padding: 10px;
position: relative;
text-align: center;
top: 15px;
width: 425px;
}
#alert_area span{
position: relative;
text-align: center;
top: 10px;
}
#cabinet {
background: url("<?php echo $games_server; ?>/include/addons/games-server/slots/image/wood.png") repeat scroll 0 0 transparent;
border-radius: 20px 20px 0px 0px;
border:1px solid #000;
min-height:520px;
width:475px;
position:relative;
left:120px;

}
.red {
color:red;
}
.green {
color:green;
}
</style>

    <img src="<?php echo $games_server; ?>/include/addons/games-server/slots/image/blank-light.gif" style="z-index:1;position:relative;left:300px;width:80px;height:auto;margin-bottom:-2px;" id="top_light" />
    <div id="cabinet">
	    <div id="alert_area"><a><b>Spin To Win!</b></a></div>
	    
            <div class="fancy" style="margin-top:30px;">
            <img src="<?php echo $games_server; ?>/include/addons/games-server/slots/image/handle.png" id="playFancy" style="cursor:pointer;margin-left:-110px;margin-top:-50px;" />
             
             <div id="slots_outer">
                <ul class="slot" id="slot">
                <?php
                require("$BASE_DIR/include/addons/games-server/slots/config.inc.php");
                foreach($fruits as $key => $fruit){
                ?>
                    <!-- In reverse order so the 7s show on load -->
                    <li alt="<?php echo $key + 1;?>"><span><img src="<?php echo $games_server; ?>/include/addons/games-server/slots/image/<?php echo $fruit;?>.png" /></span></li>
		   <?php } ?>
                </ul>
             </div>
             
            

	    <div id="payout" style="margin-left:5px;width:460px;background:#fff;min-height:260px;height:auto;border:2px inset #000;box-shadow: inset 5px 5px 5px #666;margin-top:-18px;">
	    <br />
	     <div>
		  <span style="display:inline;">
		   
		      <?php
		    
		      if($master_game_settings['allow_user_bid_price'] == 'yes'){  ?>
			  <label style="float:left;margin-right:20px;margin-left:25px;font-weight:bold;font-size:16px;">Place your bid</label>
			  <input type="text" value="<?php echo $master_game_settings['price_per_bid'];?>" style="border-radius:10px;" id="bids_placed" />
			  <label style="display:inline;margin-right:10px;font-weight:bold;font-size:16px;margin-top:8px;"><?php echo ucfirst(str_replace("_", "", $html_element_prefix)); ?> Bids</label>
		      <?php }else{ ?>
		      <label style="float:left;margin-right:20px;margin-left:25px;margin-top:2px;font-weight:bold;font-size:16px;">Price to Spin: </label>
			<label style="display:inline;font-weight:bold;font-size:16px;margin-top:8px;position:relative;top:2px;color:#000;"><?php echo $master_game_settings['price_per_bid'];?></label><input type="hidden" value="<?php echo $master_game_settings['price_per_bid'];?>" style="height:25px;width:120px;border-radius:10px;" id="bids_placed" />
			<label style="display:inline;margin-right:20px;margin-left:5px;margin-top:8px;position:relative;top:2px;font-weight:bold;font-size:16px;color:#000!important;"><?php echo ucfirst(str_replace("_", "", $html_element_prefix_to)); ?> Bids</label>
		      
		      <?php } ?>
		  </span>
		  
		  <span style="display:inline;margin-left:25px;position:relative;">
		      <label style="display:inline;font-weight:bold;font-size:16px;margin-top:8px;">Available:</label><span id="<?php echo $html_element_prefix; ?>bids_count_two" style="display:inline;margin-right:10px;margin-left:5px;font-weight:bold;font-size:16px;"></span>
		      <script>
			  $('#<?php echo $html_element_prefix; ?>bids_count_two').html($('#<?php echo $html_element_prefix; ?>bids_count').html());
			  </script>
		 </span>
	     </div>
	    <br />
	    <h2 style="text-align:center;width:460px;margin-top:-5px;">Payout Schedule</h2>
		<?php
		
		    $m = 0;
		    $f_shown = array();
		    foreach($fruits as $key => $fruit){
		    
		    if(!in_array($fruit, $f_shown)){
		    $f_shown[] = $fruit;
		    if($fruit == 'grape'){
		    echo "</div>";
		    }
		    if($fruit == 'cherry' | $fruit == 'grape'){
		    echo "<div style='float:";
		       if($fruit == 'cherry'){
			  echo 'left'; 
		      }else{ echo 'right'; }
		      echo ";max-width:200px;margin-right:25px;margin-left:5px;'>";
		    }
		    ?>
		    <ul>
			<li>
			
			<?php
			
			    foreach($payouts[$fruit] as $number => $payout){
			    if($payout > 0){
			    ?>
			    <ul >
			   
			     <li style="margin-left:5px;float:left;font-size:15px;font-weight:bold;width:200px;">
			      <?php
			    $l = 1;
			     while($l <= $number){ 
			    ?>
				  <img style="width:35px;height:35px;float:left;display:inline;" src="<?php echo $games_server; ?>/include/addons/games-server/slots/image/<?php echo $fruit;?>.png" />
			   
			    
			    
			    <?php
			      $l++;
			      
			     }
			     ?>
			     
			     
			     <span style="margin-left:25px;float:right;"> <?php echo $payout * $master_game_settings['price_per_bid'] ; ?> </span></li>
			     </ul>
			     <?php
			    
			    }
			
			  ?>
			</li>
			
		    </ul>
			
		    <?php
		   
		    }
		    
		    ?>
		</ul>
		
		<?php
		 if($fruit == 'watermelon'){
		    echo "</div>";
		    }
		 $m++;
		}
		}
		?>
	   <p style="text-align:center;"> *Payouts are in <?php echo ucfirst(str_replace("_", "", $html_element_prefix)); ?> Bids</p>
	    
	    </div>
	</div>
	</div>
<script src="<?php echo $games_server; ?>/include/addons/games-server/slots/jquery.easing.1.3.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    
    /*
 * jQuery jSlots Plugin
 * http://matthewlein.com/jslot/
 * Copyright (c) 2011 Matthew Lein
 * Version: 1.0.2 (7/26/2012)
 * Dual licensed under the MIT and GPL licenses
 * Requires: jQuery v1.4.1 or later
 */

(function($){

    $.jSlots = function(el, options){

        var base = this;

        base.$el = $(el);
        base.el = el;

        base.$el.data("jSlots", base);

        base.init = function() {

            base.options = $.extend({},$.jSlots.defaultOptions, options);

            base.setup();
            base.bindEvents();

        };


        // --------------------------------------------------------------------- //
        // DEFAULT OPTIONS
        // --------------------------------------------------------------------- //

        $.jSlots.defaultOptions = {
	    alert_area: '#slot_alert',
	    bid_area: '<?php echo $html_element_prefix; ?>bids_count',
	    bid_area_two: '<?php echo $html_element_prefix; ?>bids_count_two',
	    bid_area_three: '<?php echo $html_element_prefix; ?>bids_count_tb',
            <?php echo $html_element_prefix; ?>bids: document.getElementById('<?php echo $html_element_prefix; ?>bids_count').innerHTML,
            payout_1:'<?php echo $html_element_prefix_po; ?>bids_count',
            payout_2:'<?php echo $html_element_prefix_po; ?>bids_count_tb',
            payout_3:'<?php echo $html_element_prefix_po; ?>bids_count_three',
            number : 3,          // Number: number of slots
            winnerNumber : 1,    // Number or Array: list item number(s) upon which to trigger a win, 1-based index, NOT ZERO-BASED
            spinner : '',        // CSS Selector: element to bind the start event to
            spinEvent : 'click', // String: event to start slots on this event
            onStart : $.noop,    // Function: runs on spin start,
            onEnd : $.noop,      // Function: run on spin end. It is passed (finalNumbers:Array). finalNumbers gives the index of the li each slot stopped on in order.
            onWin : $.noop,      // Function: run on winning number. It is passed (winCount:Number, winners:Array)
            onLose : $.noop,
	    easing : 'swing',    // String: easing type for final spin
            time : 7000,         // Number: total time of spin animation
            loops : 6,            // Number: times it will spin during the animation
            ajax_url : '',
	    bids_placed: '#bids_placed',
	    no_bids_message: 'Please place a bid'
	    
        };

        // --------------------------------------------------------------------- //
        // HELPERS
        // --------------------------------------------------------------------- //

        base.randomRange = function(low, high) {
            return Math.floor( Math.random() * (1 + high - low) ) + low;
        };

        // --------------------------------------------------------------------- //
        // VARS
        // --------------------------------------------------------------------- //
	
        base.isSpinning = false;
        base.spinSpeed = 0;
        base.winCount = 0;
        base.doneCount = 0;

        base.$liHeight = 0;
        base.$liWidth = 0;

        base.winners = [];
        base.allSlots = [];

        // --------------------------------------------------------------------- //
        // FUNCTIONS
        // --------------------------------------------------------------------- //


        base.setup = function() {

            // set sizes

            var $list = base.$el;
            var $li = $list.find('li').first();

            base.$liHeight = $li.outerHeight();
            base.$liWidth = $li.outerWidth();

            base.liCount = base.$el.children().length;

            base.listHeight = base.$liHeight * base.liCount;

            base.increment = (base.options.time / base.options.loops) / base.options.loops;

            $list.css('position', 'relative');

            $li.clone().appendTo($list);

            base.$wrapper = $list.wrap('<div class="jSlots-wrapper"></div>').parent();

            // remove original, so it can be recreated as a Slot
            base.$el.remove();

            // clone lists
            for (var i = base.options.number - 1; i >= 0; i--){
                base.allSlots.push( new base.Slot() );
            }

        };

        base.bindEvents = function() {
            $(base.options.spinner).bind(base.options.spinEvent, function(event) {
                if (!base.isSpinning) {
                    base.playSlots();
                }
            });
        };

        // Slot contstructor
        base.Slot = function() {

            this.spinSpeed = 0;
            this.el = base.$el.clone().appendTo(base.$wrapper)[0];
            this.$el = $(this.el);
            this.loopCount = 0;
            this.number = 0;

        };


        base.Slot.prototype = {

            // do one rotation
            spinEm : function() {

                var that = this;

                that.$el
                    .css( 'top', -base.listHeight )
                    .animate( { 'top' : '0px' }, that.spinSpeed, 'linear', function() {
                        that.lowerSpeed();
                    });

            },

            lowerSpeed : function() {

                this.spinSpeed += base.increment;
                this.loopCount++;

                if ( this.loopCount < base.options.loops ) {

                    this.spinEm();

                } else {

                    this.finish();

                }
            },

            // final rotation
            finish : function() {

                var that = this;

                var endNum = base.randomRange( 1, base.liCount );

                var finalPos = - ( (base.$liHeight * endNum) - base.$liHeight );
                var finalSpeed = ( (this.spinSpeed * 0.5) * (base.liCount) ) / endNum;

                that.$el
                    .css( 'top', -base.listHeight )
                    .animate( {'top': finalPos}, finalSpeed, base.options.easing, function() {
                        base.checkWinner(endNum, that);
                    });

            }

        };

        base.checkWinner = function(endNum, slot) {
	    
	    val = $(base.options.bids_placed).val();
            base.doneCount++;
            // set the slot number to whatever it ended on
            slot.number = endNum;

            
	    if (base.doneCount === base.options.number) {

                var finalNumbers = [];

                $.each(base.allSlots, function(index, val) {
                    finalNumbers[index] = val.number;
                });

                if ( $.isFunction( base.options.onEnd ) ) {
                    base.options.onEnd(finalNumbers);
                }
              
	       
               if ( base.winCount && $.isFunction(base.options.onWin) ) {
                    base.options.onWin(base.winCount, base.winners, finalNumbers);
                }
                base.isSpinning = false;
		
		
	    }
	   
	    if(finalNumbers){
	     
	     if(finalNumbers.length >= 3){
              $.ajax({
		    url: base.options.ajax_url + finalNumbers + '&bids=' + val,
		    dataType: 'json',
		    success: function(response){
		     
		      $.each(response, function(i, item){
		      
			   $('#' + base.options.payout_1).html(item.<?php echo $pre; ?>bids);
			   $('#' + base.options.payout_2).html(item.<?php echo $pre; ?>bids);
			   $('#' + base.options.payout_3).html(item.<?php echo $pre; ?>bids);
			    
			  if(item.flag === 'c'){
			    
			    audioElementWin.play();
			    
			
			    base.winCount++;
			    
			    winners_in = item.winners_a.replace('"', '');
			    winners_in = winners_in.split(',');
			    
			   $.each(winners_in, function(a, winner_out){
			    // console.log(winner.replace('"'));
			    
			     if(!isNaN(winner_out)){
				
				base.winners.push(winner_out);
				
				$('.slot li[alt="' + winner_out + '"] span img').addClass('blink');
				$('.slot li[alt="' + winner_out + '"] span a').addClass('you_won');
				$('#bids_placed').prop('disabled', false);
			  
			     }
				
				
			   });
			  
			  $('#top_light').attr('src', '<?php echo $games_server; ?>include/addons/games-server/slots/image/flashing-light.gif');
			
			   
			   base.onWin();
			  }else{
			    
			    audioElementLose.play();
			    base.onLose();
			  }
			  $.each(finalNumbers, function(b, num_check){
			    
			    if(!inArray(num_check, base.winners)){
			      
			      
			    }
			    
			  });
			 <?php
			if($master_game_settings['which_to_use'] == 'free_'){
			?>
				    document.getElementById(base.options.bid_area_two).innerHTML = item.free_bids;
				    document.getElementById(base.options.bid_area_three).innerHTML = item.free_bids;
				
				    document.getElementById(base.options.bid_area).innerHTML = item.free_bids;
			      
			<?php
			    }else{
			    ?>
				    document.getElementById(base.options.bid_area_two).innerHTML = item.final_bids;
				    document.getElementById(base.options.bid_area_three).innerHTML = item.final_bids;
				
				    document.getElementById(base.options.bid_area).innerHTML = item.final_bids;
			    
			    
			 <?php 
			    
			    }
			  ?>
			});
		    
		    }
	      
		  });
	      }
	    }
	    
        };


        base.playSlots = function() {
	 
	    if( $(base.options.bids_placed).val() <= 0){
		
		showAlertBox(base.options.no_bids_message);
		
	    }else
	    if($('#bids_placed').val() > parseInt($('#<?php echo $html_element_prefix; ?>bids_count').html())){
	    
	    alert('You need to recharge your account');
	    
	    }else{
	    
			
			audioElement.play();
			
		  base.isSpinning = true;
		  base.winCount = 0;
		  base.doneCount = 0;
		  base.winners = [];

		  if ( $.isFunction(base.options.onStart) ) {
		      
			
			
		      existing_bids = parseInt($('#' + base.options.bid_area).html());
		      //prompt('#' + base.options.bid_area);
		    
		      $('#' + base.options.bid_area).html( existing_bids - parseInt($('#bids_placed').val()));;
		      
		      $('#' + base.options.bid_area + '_tb').html( existing_bids - parseInt($('#bids_placed').val()));
		      
		      $('#' + base.options.bid_area_two).html(existing_bids - $(base.options.bids_placed).val());
		      $('#' + base.options.bid_area_three).html(existing_bids - $(base.options.bids_placed).val());
			base.options.onStart();
		      $('#top_light').attr('src', '<?php echo $games_server; ?>include/addons/games-server/slots/image/blank-light.gif');
		     
		  }

		  $.each(base.allSlots, function(index, val) {
		      this.spinSpeed = 0;
		      this.loopCount = 0;
		      this.spinEm();
		  });
	    }
	    
	    
        };
	base.onLose = function() {
            if ( $.isFunction(base.options.onLose) ) {
            
	      base.options.onLose();
	      
	      
		
	      
	    }
	},
        base.onWin = function() {
        
			
        $('#alert_area').ignite(greenFlame);
            if ( $.isFunction(base.options.onWin) ) {
                base.options.onWin();
            }
        };


        // Run initializer
        base.init();
    };


    // --------------------------------------------------------------------- //
    // JQUERY FN
    // --------------------------------------------------------------------- //

    $.fn.jSlots = function(options){
        if (this.length) {
            return this.each(function(){
                (new $.jSlots(this, options));
            });
        }
    };

})(jQuery);

     var audioElement = document.createElement('audio');
     var audioElementWin = document.createElement('audio');
     var audioElementLose = document.createElement('audio');
			audioElementLose.setAttribute('src', '<?php echo $games_server; ?>include/addons/games-server/slots/sounds/lose.mp3');
			audioElement.setAttribute('src', '<?php echo $games_server; ?>include/addons/games-server/slots/sounds/lever.mp3');
			audioElementWin.setAttribute('src', '<?php echo $games_server; ?>include/addons/games-server/slots/sounds/win.mp3');
			//audioElement.setAttribute('autoplay', 'autoplay');
    

        // normal example
	function inArray(needle, haystack) {
	      var length = haystack.length;
	      for(var i = 0; i < length; i++) {
		  if(haystack[i] == needle) return true;
	      }
	      return false;
	  }
	function randomFromInterval(from,to)
	  {
	      return Math.floor(Math.random()*(to-from+1)+from);
	  }

        // fancy example
        $('.fancy .slot').jSlots({
	    alert_area: '#slot_alert',
            number : 3,
            winnerNumber : 7,
            spinner : '#playFancy',
            easing : 'easeOutSine',
            time : 7000,
            loops : randomFromInterval(6, 10),
            crossDomain: true,
            ajax_url : '<?php echo $games_server;?>include/addons/games-server/slots/check_payout.php?userid=<?php echo $_REQUEST['userid'];?>&remote_server=<?php echo urlencode($remote_server); ?>&final=',
	    bids_placed: '#bids_placed',
            
           // no_bids_message: '<?php echo PLEASE_PLACE_A_BID;?>',
            onStart : function() {
         
             if($('#bids_placed').val() > parseInt($('#<?php echo $html_element_prefix; ?>bids_count').html())){
	      
		  showAlertBox('<?php echo YOU_DO_NOT_HAVE_ENOUGH_BIDS_FOR_THIS;?>');
	      
	      }else{
			
			
		$('#alert_area').html('<a><b>Please Wait!</b></a>');
		
		
		$('#alert_area').ignite(gasFlame);
		$('#alert_area a').removeClass('blink');
		$('#alert_area a').removeClass('red');
		$('#alert_area a').removeClass('green');
		
		$('#bids_placed').prop('disabled', true);
		//$('#bids_placed').prop('disabled', true);
		$('.slot li span img').removeClass('blink');
                $('.slot li span a').removeClass('you_won');
                
               }
			
			
                	
			
			
			
            },
            onLose : function() {
            
		$('#alert_area').html('<a><b>Sorry Try Again!</b></a>');
		$('#alert_area a').addClass('blink');
	
		
		$('#bids_placed').prop('disabled', false);
		$('.slot li span').addClass('loser');
		
		$('#alert_area').ignite(redFlame);
		
			
            },
            onWin : function(winCount, winners, finalNumbers) {
            $('#alert_area').html('<a><b>You Win!</b></a>');
            
            $('#alert_area').ignite(greenFlame);
		
		$('#alert_area a').addClass('blink');
		
		$('#alert_area a').addClass('green');
		
			
			
		
                if ( winCount === 1 ) {
                    //alert('You got ' + winCount + ' 7!!!');
                } else if ( winCount > 1 ) {
                    //alert('You got ' + winCount + ' 7’s!!!');
                }

            }
        });
        $(document).ready(function(){
	  //  $('.fancy ul').css('display', 'inline-block');
	  
	  $('#bids_placed').keyup( function(){
	      if($(this).val() > parseInt($('#<?php echo $html_element_prefix; ?>bids_count').html())){
	      
		  showAlertBox('<?php echo YOU_DO_NOT_HAVE_ENOUGH_BIDS_FOR_THIS;?>');
	      
	      }
	  
	  });
        
        });


    </script>

  