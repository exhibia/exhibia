<?php ///if (!empty($_SESSION["userid"])) {
$query = "select * from registration left join avatar a on a.id=registration.avatarid where registration.id = $_SESSION[userid]";

$row = db_fetch_object(db_query("$query"));
if(file_exists($BASE_DIR . "/include/addons/user_levels/login.php")){
include("include/addons/user_levels/login.php");
$levels = $level_str;
}
?>
<style>


.navbarnew {
 background: none repeat scroll 0 0 #E3F2F7;
height: 40px;
position: fixed;
top: 0;
width: 1296px;
z-index: 5;
margin: 0 auto;

}

</style>

<div class="navbarnew navbarnew-fixed-top">
  <div class="navbarnew-inner">
    <div >
<a class="brand" href="<?php echo $SITE_URL; ?>">Exhibia</a>
<ul class="nav">
            <li class="active"><a href="help.php">how it works</a></li>
            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Brands <b class="caret"></b></a>
              <ol class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="nav-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ol>
            </li>-->
            <li class="">
              <a href="help.php" class="dropdown-toggle" data-toggle="dropdown">faq <!--<b class="caret"></b>--></a>
              <!--<ol class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="nav-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ol>-->
            </li>
             <?php 
             if(!empty($_SESSION['userid'])){ 
             $user = db_fetch_object(db_query("select * from registration left join avatar a on a.id=registration.avatarid where id = '$_SESSION[userid]'"));
             echo db_error();
            if(empty($user->avatar) | !file_exists("$BASE_DIR/uploads/avatars/" . $user->avatar)){
		$avatar = $SITE_URL . "uploads/avatars/default.png";
	    }else{
		$avatar = $SITE_URL . "uploads/avatars/" . $user->avatar;
	    }
	    if(function_exists('social_avatar')){
		$avatar = social_avatar($_SESSION['userid'], $avatar);
	    }
             ?>
           <li class="dropdownq" id="user_drop_down_menu">
              <p style="margin-top:20px;"><img src="<?php echo $avatar; ?>" style="width:30px; height:30px;float:left;margin-right:5px;" /><a style="float:right;margin-top:5px;"><?php echo $_SESSION['username']; ?></a> </p>
              <ol class="dropdown-menuq" id="user_drop_down_menu_ul" style="list-style:none;margin:0;">
                <li onclick="window.location.href = '<?php echo $SITE_URL;?>myaccount.php'">My Account</li>
              
                 <li onclick="window.location.href = '<?php echo $SITE_URL;?>logout.php'">Log Out</li>
              </ol>
            </li>
         <?php }else{ ?>
          <li class="register_btn"><a href="<?php echo $SITE_URL;?>registration.php">sign up</a></li>
            <li class="login_btn"><a href="javascript:;" onclick="modal('<?php echo $SITE_URL;?>include/social_login.php');">log in</a></li>
           
          <?php } ?>
          </ul>
          <ul class="nav pull-right">
         
            
            <form class="navbarnew-search pull-left" action="">
             <input type="text" class="search-query span2" placeholder="Search">
             <input type="image" src="img/search_bg.png" name="submit" value="" />
           </form>
           
          </ul>
</div>
  </div>
</div>
<script>
$(document).ready(function(){
    $('.dropdownq').each(function(){
	var id = $(this).attr('id');

	    $('#' + id + ' p:first-child').qtip({
	  	show: {
    event: 'click mouseover'
},

hide: { event : 'unfocus' },
	      content: { text: $('#' + id + ' ol').clone() },
	      position: { target: $('#' + id), 
			  my : 'top left', at: 'left bottom',
			  adjust: { mouse: false, x:0, y:0 }
	      } 
	      ,
	    style: {
		tip: {
		    corner: 'top left',
		    mimic: 'top center'
		},
		solo: true,
	
	    }
	  });
    });
});  
$('.ui-tooltip-content .dropdown-menuq').bind('mouseout', function(){
$(this).qtip('destroy');


});
  function modal(url){
    if($('#content_modal').length== 0){
      $('body').append('<div id="content_modal"></div>');
      $('#content_modal').dialog({
	  autoOpen: false,
	  width:600,
	  height:550,
	  title: 'sign up',
	  modal: true
      });
    
	  $.ajax({
		url:url,
		type:'get',
		dataType: 'html',
		
		success: function(response){
		if(response.indexOf('<') > -1){
		  $('#content_modal').append(response);
		  $('#content_modal').dialog('open');
		 }
		}
		
	  });
	}else{
	  $.ajax({
		url:url,
		type:'get',
		dataType: 'html',
		
		success: function(response){
		  if(response.indexOf('<') > -1){
		  if(url.match("social_login.php")){
		   $('#content_modal').html(response);
		   $('#content_modal').dialog('open');
		  }else{
		    $('#content_modal').append(response);
		   $('#content_modal').dialog('open');
		  
		  }
		}
		}
	  });	
	
	
	}
    }
				  
				
				    
				    function fb_login(){
				      FB.login(function(response) {

					  if (response.authResponse) {
					      
					      //console.log(response); // dump complete info
					      access_token = response.authResponse.accessToken; //get access token
					      user_id = response.authResponse.userID; //get FB UID

					      FB.api('/me', function(response) {
						  user_email = response.email; //get user email
					    // you can store this data into your database     
					    window.location.href = 'verify_account_or_register.php?social_verify=facebook'
					      });

					  } else {
					      //user hit cancel button
					      console.log('User cancelled login or did not fully authorize.');

					  }
				      }, {
					  scope: 'publish_stream,email,user_birthday'
				      });
				  }
				
						
				  window.fbAsyncInit = function() {
  	FB.init({
							  appId      : '129299757101755', // App ID
							  channelUrl : '//<?php echo $SITE_URL;?>channel.html', // Channel File
							  status     : true, // check login status
							  cookie     : true, // enable cookies to allow the server to access the session
							  xfbml      : true  // parse XFBML
							});

    // Additional initialization code here
  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
				  
			</script>  