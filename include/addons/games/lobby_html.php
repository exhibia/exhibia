
<style>
#alert_message, .ui-dialog{
z-index:999999999999999999999999!important;
position:absolute!important;
}
#game_area {
position:absolute;
z-index:1;
}
#lobby_outer {
position:relative;
z-index:99999999999;

left:0px;
float:right;
}
#lobby_box {
border-radius: 0 0 6px 6px;
height: 40px;
left: 0;
position: relative;
top: 7px;
width: 100%;
z-index: 2147483647;
}
.snapbids#lobby_box_domain{
position:relative;

z-index:9999999999999;

}
#lobby_box_domain{
z-index:9999999999999;
background-color: #315E7C;
border-radius: 0px 0px 10px 10px;
color: #FFFFFF;
height: 40px;
width: 250px;
}
#lobby_box_domain h2{
color: #fff;
width: 180px;
margin: 5px 0 5px 20px;
font-size: 14px;

}
#lobby_header li {
display:inline-block;
color:#fff;
}
#alert {
position: relative;
top: 5px;
visibility: hidden;
left: 15px;
}
#open_lobby img{
position:relative;
left:10px;
top:-15px;
float:right;
z-index: 9999999999999999999999999999999;
}
#room {
position:relative;
top:0px;
left:10px;
}
#chat_output {
position:relative;

background:#fff;
z-index:9999999999999;
min-height:300px!important;
border-left:2px #315e7c solid;
border-right:2px #315e7c solid;
border-top:10px #315e7c solid;
display:none;
width:245px;
max-height:280px;
overflow-x:hidden;
overflow-y:auto;
word-warp:break-word;
}
#chat_output ul li.message{
border:1px #315e7c dotted;
width:220px;
word-wrap:break-word;
border-radius:4px;
margin:3px 0 5px 2px;

}
#end_game {
background-image: url("http://pennyauctionsoftdemo.com//include/addons/games/images/end_game.png");
background-repeat: no-repeat !important;
background-size: 130px 40px !important;
color: #FFFFFF !important;
min-height: 45px;
min-width: 130px;
display: block;
text-align: center!important;
padding: 15px 0 5px 0;
text-indent: -15px;
font-weight: bold;
}

#lobby_box{
border-radius: 0 0 6px 6px;
height: 40px;
left: 230px;
position: absolute;
top: 7px;
width: 100%;
z-index: 2147483647;
}
#game_info p span {
  font-weight: normal;
}
#game_info > p {
  font-weight: bold;
}
.chat_box {
  color: #FFFFFF;
  background-color: #315E7c;
  max-width: 100px;
  font-size: 11px;
  text-align: center;
  height: 25px;
  margin: 5px;
  position: absolute;
  z-index: 999999;
  top:-50px;
  right:230px;
  border-radius: 10px 10px 0px 0px;
  padding-top: 10px;
}

.chat_holder {
background-color: #315E7C;
border-radius: 0 0 6px 6px;
box-shadow: 3px 3px 3px #666666;
height: 300px;
position: relative;
text-align: center;
top: 1px;
width: 170px;
float:right;
}
.chat_holder ul {
background-color: #FFFFFF;

left: 5px;
position: relative;
top: 5px;
padding-top:5px;
width: 162px;

}
.chat_holder ul {
width:182px!important;
width:182px!important;
max-height: 230px!important;
}
.chat_ul {
overflow-y:auto;
max-height: 230px!important;
max-width:162px;
color:#000;

}
.chat_holder textarea {
border-radius: 0 0 6px 6px;
height: 40px;
position: relative;
resize: none;
top: 7px;
width: 146px;
z-index: 2147483647;
left: 1px;
}
.highlight_chat {
color:red!important;

}
.mCSB_container {
max-width:152px!important;
min-width:152px!important;
padding-right:0px!important;

}
.mCSB_draggerRail {
position:relative!important;
left:3px!important;
width:3px!important;
height:200px!important;
}
.mCSB_dragger {
position:relative!important;
left:7px!important;
max-width:3px!important;
width:3px!important;
max-height:50px!important;
}
#wrapper_game {
  top: 50px;
  position: relative;
  z-index:1;
}
#chat_box_0 {
margin-right:50px;
}
</style>

<div id="lobby_box" class="<?php echo $template; ?>">
<input type="hidden" name="game_room" id="game_room" value="<?php echo str_replace(" ", "+", $_REQUEST['game']); ?>" />
<input type="hidden" name="game_level" id="game_level" value="<?php echo str_replace(" ", "+", $_REQUEST['game_level']); ?>" />
<div id="lobby_outer">
    <div id="chat_output"></div>
      <div id="lobby_box_domain" class="<?php echo $_GET['template']; ?>">
     
	    <ul id="lobby_header">
		<li id="alert"><img src="<?php echo $game_server;?>include/addons/games/alerts.png" /></li>
		<li id="room"><?php echo "<h2>Room: $_GET[room]</h2>"; ?></li>
		
	    </ul>
      <span id="open_lobby"><img src="<?php echo $game_server;?>/include/addons/games/arrow-down.png" onclick="open_chat();" /></span>
    </div>
</div>     


</div>
 <?php
 
 include("$BASE_DIR/include/addons/games/$_REQUEST[room]/index.php");
      if(db_num_rows(db_query("select * from lobby where username = '$_GET[username]' and domain = '$_GET[domain]'")) == 0){
	  db_query("insert into lobby (id, userid, username, domain) values(null, '$_GET[userid]', '$_GET[username]', '$_GET[domain]');");
      }
      if(!empty($_GET['room'])){
	  db_query("update lobby set room = '$_GET[room]' where username = '$_GET[username]' and domain = '$_GET[domain]'");
	  
	  
      }
      ?>
     
      <script>
      function open_chat(){
      
       $('#open_lobby img').css('top', '-10px');
	  if($('#open_lobby img').attr('src')== '<?php echo $game_server;?>/include/addons/games/arrow-down.png'){
	  
	      $('#open_lobby img').attr('src', '');
	      $('#chat_output').css('display','block');
	      update_chat();
	      
	     
	  }else{
	      
	      
	      $('#open_lobby img').attr('src', '<?php echo $game_server;?>/include/addons/games/arrow-down.png');
	      $('#chat_output').css('display','none');
	      $('#open_lobby img').css('top', '-15px');$('#open_lobby img').css('left', '10px');
	  }
	  
      }
     /* $('#chat_output').mCustomScrollbar({
		    mouseWheel:false,
		    scrollButtons:{
		      enable:false
		    }
	      });*/
	function clear_game(username, domain){
	  if($('#stop_game').length == 0){
	    $('body').append('<div id="stop_game"></div>');
	  }
	
	  $.ajax({
		   url: '<?php echo $game_server; ?>/include/addons/games/end_game.php',
		   data: { room: $('#end_game').attr('alt'), game: $('#end_game').attr('alt'), opponent: $('#opponent').val(), gameID : $('#game_instance_id').val(), domain: domain, username: $('#me').val() },
		   type: 'get',
		   crossDomain: true,
		   success: function(response){
		alert(response);
		   parseScript(response);
		    window.location.href = window.location.href;
	
		    }
	    });
	    try{
	    document.getElementById('in_game').innerHTML = '';
	    }catch(oo){}
	}

function game_start(gameID){
console.log("checking if we should start " + gameID);
if( $('#stop_game').length == 0 ){
//checks to see if game should begin

	$.ajax({
	      url: '<?php echo $game_server; ?>/include/addons/games/<?php echo strtolower(str_replace(" ", "", $_REQUEST['game']));?>/check_game_data.php',
	      data: { gameID: gameID, init: 'true', min_players: '<?php echo $_REQUEST['min_players'];?>', room : '<?php echo $_REQUEST['game'];?>', username : $('#me').val() },
	      dataType: 'jsonp',
	      type: 'get',
	      crossDomain: true,
	      success: function(response){


		if(response.game == 'true' | response.game == 'running'){
		  if(response.game != 'running'){
		  //  showAlertBox('<?php echo $_REQUEST['game']; ?> ready to start');
		  }
		      Init_<?php
		      echo str_replace(" ", "", ucwords($_REQUEST['game']));
		      
		      ?>();
			
		// $('#end_game').remove();
			
		      if(response.game != 'game over'){
		      
			
			if(!document.getElementById('in_game')){
			    $('body').append('<div id="in_game" style="display:none;">' + gameID + '</div>');
			 }
			if(!document.getElementById('game_room')){
			  $('#domain').after('<input type="text" id="game_room" value="<?php echo $_REQUEST['game'];?>" />');
			}
			if($('#end_game').length == 0){
		    //  prompt('test');
			      $('#game_info').append('<span id="end_game" onclick="clear_game(\'' + $('#me').val() + '\', \'<?php echo $_REQUEST['domain']; ?>\');" alt="<?php echo $_REQUEST['game'];?>"><?php echo END_GAME; ?></span>');
			}
			refresh_game_play(gameID);
		      }
		      
		      
		     
		      
		   
		      chat_boxes();
		  }else{
		    if(response.game != 'game over'){
		      $('#in_game').remove();
		      setTimeout("game_start('" + gameID + "')", 1000);
		     
		      
		    }
		    // $('#end_game').remove();
		  }
		  
		  }
	  });
  //  }
  
  }
}
function send_message(me, him, domain, box, msg){

if($('#stop_game').length == 0){
	$.ajax({
	      url: '<?php echo $game_server; ?>/include/addons/chat/index.php',
	      data: { username: me, domain: domain, msg: msg, him: him },
	      type: 'get',
	       dataType: 'html',
	      crossDomain: true,
	      cache:false,
	      success: function(response){
		
		//  prompt(response);
		  document.getElementById('messages_holder_' + box).innerHTML = response;
		 
			 parseScript(response);   
		  
	      
	      }, error : function(string, text, msg) { 
	      
	      }
	 });

  }
}
function highlight(id){
    $('#chat_box_' + id + ' a:first-child').addClass('highlight_chat');
    $('#chat_box_' + id + ' a:first-child').click(function(){
    
      $('#chat_box_' + id + ' a:first-child').removeClass('highlight_chat');
    });

}
function retrieve_chat(me, domain, box){
if($('#stop_game').length == 0){	
      $.ajax({
	      url: '<?php echo $game_server; ?>/include/addons/chat/index.php?',
	      data: { username:me, domain: domain, box: box },
	      type: 'get',
	      dataType: 'html',
	      crossDomain: true,
	      cache:false,
	      success: function(response){
		
		//  prompt(response);
		  document.getElementById('messages_holder_' + box).innerHTML = response;
		 
			 parseScript(response);   
		  
	      
	      }, error : function(string, text, msg) { 
	      
	      }
	        
	 });
	 setTimeout("retrieve_chat('" + $("#me").val() + "', '<?php echo $_REQUEST['domain']; ?>', '" + box + "')", 3000);
	 // $('#messages_holder_' + box).mCustomScrollbar('scrollTo', 'bottom');
	 var objDiv = document.getElementById('messages_holder_' + box);
	  objDiv.scrollTop = objDiv.scrollHeight;
    }
}

function hide_show(id){

    if($('#chat_box_div_' + id).css('visibility') == 'collapse'){
	$('#chat_box_div_' + id).css('visibility', 'visible');
	
    
    }else{
      
	$('#chat_box_div_' + id).css('visibility', 'collapse');
    }
}

function chat_boxes(){

if($('#stop_game').length == 0){
   $('.opponents').each( function(i, item) {
   console.log(i);
    him = $(this).val();
    if($('#chat_box_' + i).length == 0){
  
	$('#lobby_box').prepend('<div class="chat_box" id="chat_box_' + i + '"><a style="color:#fff;" onclick="hide_show(' + i + ');">' + him + '</a><div id="chat_box_div_' + i + '" style="visibility:collapse;" class="chat_holder"><div id="chat_scroll_' + i + '" style="height:230px;"><ul id="messages_holder_' + i + '" class="chat_ul" style="max-height:230px!important;min-height:230px!important;overflow-x:hidden;"></ul></div><textarea alt="' + i + '" name="message_' + i + '" id="message_' + i + '"></textarea><input type="hidden" name="recipient" id="recipient_' + i + '" value="' + him + '" /></div></div>');
    }
	
	
	   $('#messages_holder_' + i ).mCustomScrollbar({ 
			theme:"light",
			  horizontalScroll:false,
			  verticalScroll:true,
				    scrollButtons:{
						    enable:false
					    },
					    advanced:{
					  updateOnContentResize: true
			      }
	      });
	   
	     
	  
	  $('#message_' + i ).bind('keyup', function(e){
	      if(e.which == 13) {
	    
		e.preventDefault();
		jQuery(this).blur();
		
		send_message($('#me').val(), him, '<?php echo $_REQUEST['domain'];?>', $(this).attr('alt'), $('#message_' + $(this).attr('alt') ).val())
		$(this).val('');
	      }
	  
	  
	  });
      setTimeout('retrieve_chat(\'' + $("#me").val() + '\', \'<?php echo $_REQUEST['domain']; ?>\', ' + i + ')', 3000);
     
    });
    
  
}
}

	

    function letsbegin(user, gameID){
    // if(document.getElementById('in_game') == true){
    // console.log('<?php echo $game_server; ?>/include/addons/games/get_lobby.php?');
      if($('#stop_game').length == 0){
	if(empty(user)){
	user = $('#opponent').val();
	}
	$.ajax({
	
	  url: '<?php echo $game_server; ?>/include/addons/games/get_lobby.php?',
	  data: { room : '<?php echo urlencode($_REQUEST['game']); ?>', userid: '<?php echo $_REQUEST['userid'];?>', username: $('#me').val(), remote_server: 'http://' + $('#domain').val() + '/', domain: $('#domain').val(), key : '<?php echo $_REQUEST['key']; ?>', max_players: '<?php echo $_REQUEST['max_players']; ?>', min_players: '<?php echo $_REQUEST['min_players'];?>', gameID: gameID, opponent: user, check_bids: 'true', accept : user },
	  crossDomain: true,
	  method: 'get',
	  dataType: 'jsonp',
	  success: function(response){
	
	
	      //if($('#chat_output').css('display') == 'block'){
		 
		  $('#game_instance_id').val(response.id);
		  $('#opponent').val(response.opponent);
		  $('#whos_turn').val(response.whos_turn);
		  
		 
	     // }
	 
	     game_start(response.id);
	      
	  }
	
	
	
	
	});
      }
    //  }
    }
    function delete_message(ID, reload){
   
    $.ajax({
	
	  url: '<?php echo $game_server; ?>/include/addons/games/get_lobby.php?',
	  data: { delete_message: ID },
	  crossDomain: true,
	  method: 'get',
	  dataType: 'html',
	 
	  success: function(response){
	  if(reload == 'true'){
	  prompt(response);
	 // window.location.href = window.location.href;
	  }
	    }
	});
    
    
    }
    function accept(user, gameID){

    if(parseInt( $('#' + $('#take_from').html() ).html() ) >= parseInt($('#bids_to_take').html())){
    
	$.ajax({
	
	  url: '<?php echo $game_server; ?>/include/addons/games/get_lobby.php?',
	  data: { room : '<?php echo urlencode($_REQUEST['game']); ?>', userid: '<?php echo $_REQUEST['userid'];?>', username: $('#me').val(), remote_server: '<?php echo $game_server; ?>', domain: $('#domain').val(), key : '<?php echo $_REQUEST['key']; ?>', output: 'true', max_players: '<?php echo $_REQUEST['max_players']; ?>', min_players: '<?php echo $_REQUEST['min_players'];?>', accept: user, gameID: gameID },
	  crossDomain: true,
	  method: 'get',
	  dataType: 'jsonp',
	 
	  success: function(response){

	
	      //if($('#chat_output').css('display') == 'block'){
		
		  $('#game_instance_id').val(response.id);
		  $('#opponent').val(response.opponent);
		  $('#whos_turn').val(response.whos_turn);
		 
	     // }
	   
	      game_start(response.id);
				  $.ajax({
				      url: '<?php echo $game_server; ?>/include/addons/games/get_lobby.php?', // URL to the local file
				      type: 'GET', // POST or GET
				      dataType: 'json',
				      data: { message_id : response.id, delete_m: 'true'}, // Data to pass along with your request
				      crossDomain: true,
				      success: function(data, status) {
					  $('#alert').qtip('destroy');
					  $('#alert').css('visibility', 'hidden');
				      
				   }
				   
				  }); 
	  }
	
	
	
	
	});

      }else{
      
	showAlertBox('Sorry you do not have enough ' + $('#take_from_txt').html() + ' to play this game');
      
      
      
      }
    
    }
    
    function invite(user, element){
  
      if(parseInt( $('#' + $('#take_from').html() ).html() ) >= parseInt($('#bids_to_take').html())){
       $('#' + element).remove();
	$.ajax({
	
	  url: '<?php echo $game_server; ?>/include/addons/games/get_lobby.php',
	  data: { room : '<?php echo urlencode($_REQUEST['game']); ?>', userid: '<?php echo $_REQUEST['userid'];?>', username: '<?php echo $_REQUEST['username']; ?>', remote_server: '<?php echo 'http://' . $_REQUEST['domain'] . '/';?>', domain: '<?php echo $_REQUEST['domain'];?>', key : '<?php echo $_REQUEST['key']; ?>', output: 'true', max_players: '<?php echo $_REQUEST['max_players']; ?>', min_players: '<?php echo $_REQUEST['min_players'];?>', invite: user },
	  crossDomain: true,
	  method: 'get',
	  success: function(response){
	   
	      $('#chat_output').html(response);
	      if($('#chat_output').css('display') == 'block'){
		  $('#open_lobby img').css('top', '-55px');
		  $('#open_lobby img').css('left', '22px');
		  $('#open_lobby img').attr('src', '<?php echo $game_server;?>/include/addons/games/arrow-right.png');
	      }
	      parseScript(response);
	      
	  }
	
	
	
	
	});
      }else{
      
	showAlertBox('Sorry you do not have enough ' + $('#take_from_txt').html() + ' to play this game');
      
      
      
      }

      
    }
    function enable_play(){
    
    
	
    
    
    
    
    }
    function alert_button(id){
    
    var alert_id = id;
    
	$('#alert').css('visibility', 'visible');
    
	//$('#alert').click(function(){
	if(!document.getElementById('alert_dialog_' + alert_id)){
	    $('#alert').qtip({
	    
			id: 'alert_dialog_' + alert_id,
			content:{
				//text: $('#message_' + alert_id).html()
				
			},
			show: {
			      ready : true,
			      solo: true,
			      hide: { target: $('#alert_entry_' + alert_id).next('a').click() }
			},
			style: {
			      width: 250,
			      height:'auto'
			},
			position: {
			      my: 'top right',
			      at: 'bottom left'
			}, 
			events: {
				hide: function(event, api) {
			
				      $.ajax({
					  url: '<?php echo $game_server; ?>/include/addons/games/get_lobby.php?', // URL to the local file
					  type: 'GET', // POST or GET
					  dataType: 'html',
					  data: { message_id : alert_id, delete_m: 'true'}, // Data to pass along with your request
					  success: function(response) {
					      $('#alert').qtip('destroy');
					      $('#alert').css('visibility', 'hidden');
				      }
				   
				  }); 
				   
				}
			      }
			
		  });
	}
   
    }
    function parseScript(_source) {
		var source = _source;
		var scripts = new Array();
	
		while(source.indexOf("<script") > -1 || source.indexOf("</script") > -1) {
			var s = source.indexOf("<script");
			var s_e = source.indexOf(">", s);
			var e = source.indexOf("</script", s);
			var e_e = source.indexOf(">", e);
			
			// Add to scripts array
			scripts.push(source.substring(s_e+1, e));
			// Strip from source
			source = source.substring(0, s) + source.substring(e_e+1);
		}
		
		// Loop through every script collected and eval it
		for(var i=0; i<scripts.length; i++) {
			try {
				eval(scripts[i]);
				
			}catch(ex) {}
				
		      }
		
		
		// Return the cleaned source
		return source;

    }  
  function update_chat(){
  if($('#stop_game').length == 0){
  //if(document.getElementById('in_game') == true){
 // $('#open_lobby img').css('top', '-15px');
      $.ajax({
	  url: '<?php echo $game_server; ?>/include/addons/games/get_lobby.php',
	  data: { room : '<?php echo urlencode($_REQUEST['game']); ?>', userid: '<?php echo $_REQUEST['userid'];?>', username: $('#me').val(), remote_server: 'http://' + $('#domain').val() + '/', domain: $('#domain').val(), key : '<?php echo $_REQUEST['key']; ?>', output: 'true', max_players: '<?php echo $_REQUEST['max_players']; ?>', min_players: '<?php echo $_REQUEST['min_players'];?>' },
	  crossDomain: true,
	  method: 'get',
	  success: function(response){
	  
	      $('#chat_output').html(response);
	      if($('#chat_output').css('display') == 'block'){
	      
		//if($('#open_lobby img').attr('src') != '<?php echo $game_server;?>include/addons/games/arrow-right.png'){
		  $('#open_lobby img').css('top', '-55px');
		  $('#open_lobby img').css('left', '22px');
		  $('#open_lobby img').attr('src', '<?php echo $game_server;?>/include/addons/games/arrow-right.png');
		//}
	      }
	      parseScript(response);
	      $("#chat_output").scrollTop($("#chat_output").scrollHeight);
	    
	      
	  }
      });
     
      setTimeout("update_chat()", 5000); 
     } 
  }
  setTimeout("update_chat()", 1000);
</script>
