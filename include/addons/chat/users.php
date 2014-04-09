<?php
  $these_users = array();
  ?>
<style>
#chat_box ul:first-child {
clear: both;
display: block;
max-height: 375px;
min-height: 375px;
overflow: auto;
position: relative;
}
#facebook_buttons {
  position: relative;
  top: -5px;
}
</style>
<div id="chat_box">
<h3><em></em> Users Online</h3>
  <span>
    <ul id="chat_stream" style="list-style:none;margin:0;">
    
    </ul>
  </span>
  <textarea id="send_message" resizable="false"></textarea>
 
						    <script>
							
							
							  function stream_callback (post_id, exception) {
						      if (post_id) {
						      $.get('<?php echo $SITE_URL;?>facebook.log.php?message=' + uriEncodeComponent('Check out these fantastic deals!!!') + '&post_id=' + post_id, function(data) {

							document.getElementById('msg').innerHTML = response;
						      });
						      }
						    }
						    function postToFeed(message) {
							  var description;
							  var name;
							  <?php
							  if(!preg_match("/wonauction/", $_SERVER['PHP_SELF'])){
							  ?>name = uriEncodeComponent('Hey check out the great deal I just got at <?php echo addslashes($SITE_NM);?>');
							  <?php

							  }else{
							  ?>name = uriEncodeComponent('Hey check out the great deals at <?php echo addslashes($SITE_NM);?>');
							  <?php

							  }
							  ?>
						    if(!message){
						    if(! $('meta[name=description]').attr("content")){
							description = uriEncodeComponent('Check out the great deals on <?php echo addslashes($SITE_NM);?>');
							}else{
							description = uriEncodeComponent($('meta[name=description]').attr("content"));

						      }
						      }else{
						      description = message;
						      }
							    // calling the API ...
							    var obj = {
							      method: 'feed',
							      link: window.location.href,
							      picture: '<?php echo $SITE_URL;?>/img/logo.png',
							      name: name,
							      caption: document.getElementsByTagName('title')[0].innerHTML,
							      description: description
							    };

							    function callback(response) {
							      document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
							    }

							    FB.ui(obj, callback);
							  }
								      (function(d, s, id) {
									  var js, fjs = d.getElementsByTagName(s)[0];
									  if (d.getElementById(id)) return;
									  js = d.createElement(s); js.id = id;
									  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=129299757101755";
									  fjs.parentNode.insertBefore(js, fjs);
									}(document, 'script', 'facebook-jssdk'));
								
								    <?php
								    $fbstr = '';
								    foreach($_GET as $key => $value){
								    if($key != 'share_net'){
								    $fbstr .= "$key=" . urlencode("$value") . "&";
								    }
								    }
								    $fbstr .= 'share_net=faceb00k&';

								    ?>
								(function(d){
								  var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
								  if (d.getElementById(id)) {return;}
								  js = d.createElement('script'); js.id = id; js.async = true;
								  js.src = "//connect.facebook.net/en_US/all.js";
								  ref.parentNode.insertBefore(js, ref);
								}(document));

						  
					</script>
				    <div id="facebook_buttons">      
				  
					    <div id="msg"></div>
					<table>
					    <tr>
						<td colspan="2" align="left">					    
						    <div class="fb-like" data-href="<?php echo $SITE_URL . basename($_SERVER['PHP_SELF']); ?>?<?php echo $fbstr;?>" data-send="true" data-width="450" data-show-faces="false" connections="5"></div>
						</td>
					      </tr>
					    
					  </table>
				      </div>
</div>