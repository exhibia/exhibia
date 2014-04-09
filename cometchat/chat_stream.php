<?php
ini_Set('display_errors', 1);
include("../../../config/config.inc.php");
include($BASE_DIR . "/Functions/social_avatar.php");
include($BASE_DIR . "/Functions/truncate.php");
//echo "select `userid` as `user_id`, `message`, av.avatar from cometchat_chatroommessages left join registration r on r.ID = cometchat_chatroommessages.userid left join avatar av on av.ID = r.avatarid  where chatroomid = 1 order by cometchat_chatroommessages.id desc limit 15";
$qry = db_query("select `userid` as `user_id`, `message`, av.avatar from cometchat_chatroommessages left join registration r on r.ID = cometchat_chatroommessages.userid left join avatar av on av.ID = r.avatarid  where chatroomid = 1 order by cometchat_chatroommessages.id desc limit 15");
//`to` = '$_SESSION[userid]' order by cometchat.id desc limit 15");
    while($row_users = db_fetch_array($qry)){
	    if($row_users['avatar'] == ''){
	      $row_users['avatar'] = $SITE_URL .'/uploads/avatars/default.png';
	    }else{
	      $row_users['avatar'] = $SITE_URL .'/uploads/avatars/' . $row_users['avatar'];
	    }
	    if(function_exists('social_avatar')){
		$row_users['avatar'] = social_avatar($row_users['user_id'], $row_users['avatar']);
	    }
	    if($row_users['user_id'] == 1){
	    
	    
	    }
	?>
		<li style="margin: 8px 2px 7px 5px;list-style:none;display:block;clear:both;">
			<?php
			    if($row_users['user_id'] != 1){
			?>
			<ol style="list-style:none;text-align:left;">
			    <img src="<?php echo $row_users['avatar']; ?>" style="float:left; margin: 2px 5px 0 0;width:40px;height:40px;" />
			    <li onclick="user_profile(<?php echo $row_users['user_id']; ?>);" style="color:#1f7bc6;font-size:18px;text-align:left;"><?php echo $row_users['username']; ?></li>
			 <?php }else{ ?>
			 <ol style="list-style:none;text-align:left;background-color:#cacaca;min-height:45px;height:auto;">
			    <img src="include/addons/cometchat/images/star.png" style="float:left; margin: 2px 5px 0 0;width:40px;height:40px;" />
			 <?php } ?>
			    <li onclick="user_profile(<?php echo $row_users['user_id']; ?>);" style="color:#000;font-size:12px;text-align:left;"><?php echo truncate($row_users['message'],75, '...'); ?></li>
			</ol>
		</li>
    <?php	
    }
    ?>
    <!--
    <?php /* $users = db_query("select username, a.avatar, r.avatarid from login_logout left join registration r on r.id=login_logout.user_id left join avatar a on a.id=r.avatarid where user_id != ''"); //and user_id != '$_SESSION[userid]'"); 
	  while($row_users = db_fetch_array($users)){
	  if(!in_array($row_users['username'], $these_users)){
	    if($row_users['avatar'] == ''){
	      $row_users['avatar'] = 'uploads/avatars/default.png';
	    }else{
	      $row_users['avatar'] = 'uploads/avatars/' . $row_users['avatar'];
	    }
	    if(function_exists('social_avatar')){
		$row_users['avatar'] = social_avatar($_SESSION['userid'], $row_users['avatar']);
	    }
	      ?>
		<li style="margin: 2px 2px 3px 5px;list-style:none;clear:both;">
		  <img src="<?php echo $row_users['avatar']; ?>" style="float:left; margin-right:5px;width:40px;height:40px;" />
		    <li style="">
			<ol style="list-style:none;text-align:left;">
			    <li onclick="user_profile(<?php echo $row_users['user_id']; ?>);" style="color:#1f7bc6;font-size:18px;text-align:left;"><?php echo $row_users['username']; ?></li>
			    <li onclick="user_profile(<?php echo $row_users['user_id']; ?>);" style="color:#000;font-size:14px;text-align:left;">What is this supposed to be?</li>
			</ol>
		    </li>
		</li>
	      <?php
		$these_users[] = $row_users['username'];
	    }
	  } */
    ?>
    -->