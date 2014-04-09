  <?php
  $user = db_fetch_array(db_query("select * from registration left join avatar a on a.id = registration.avatarid where registration.id = '$_SESSION[userid]'"));
  echo db_error();
  if(empty($user['avatar'])){
    $avatar = 'uploads/avatars/default.png';
  }else{
    $avatar = 'uploads/avatars/' . $user['avatar'];
  }
	    if(function_exists('social_avatar')){
		$avatar = social_avatar($_SESSION['userid'], $avatar);
	    }
include("include/addons/chat/users.php");

if(!empty($_SESSION['userid'])){
?>
<div id="my_profile">
<h3><em></em> My Profile</h3>
  <span>
    <ul id="chat_stream" style="margin:0;list-style:none;">
      <!--<li id="user_notifications" style="min-height:25px;">where is this coming from?new code?</li>-->
      <li id="user_details" style="border-top:1px solid #D6EBEE;border-bottom:1px solid #D6EBEE;min-height:45px;">
	  <ul>
	    <li style="display:inline-block;width:48px;margin:2px 2px 2px 2px!important;"><img src="<?php echo $avatar; ?>" id="right_avatar" /></li>
	    <li style="display:inline-block;">
		<ul style="list-style:none;margin:0!important;">
		    <li style="font-weight:bold;font-size:18px;color:#4aa5eb;"><?php echo $user['username']; ?></li>
		    <li>Since: <?php echo $user['registration_date']; ?></li>
		</ul>
	    </li>
	  </ul>
      </li>
      <li id="user_data" style="border-bottom:1px solid #D6EBEE;">
          <ul style="margin-top:10px;margin-left:10px;">
	    <li style="display:inline-block;font-size:12px;font-weight:bold;color:#4aa5eb;width:120px;cursor:pointer;" onclick="window.location.href = 'wonauctions.php'">Won Auctions (<span id="won_total_total">0</span>)</li>
	    <li style="display:inline-block;font-size:12px;font-weight:bold;color:#4aa5eb;width:120px;cursor:pointer;">Notifications (<span id="notifications_total" >0</span>)</li>
	    <li style="display:inline-block;font-size:12px;font-weight:bold;color:#4aa5eb;width:120px;margin-top:5px;cursor:pointer;" onclick="window.location.href = 'watchauctions.php'">My Watchlist (<span id="total_watched">0</span>)</li>
	    <li style="display:inline-block;font-size:12px;font-weight:bold;color:#4aa5eb;width:120px;margin-top:5px;cursor:pointer;" onclick="window.location.href = 'mybuynow.php'">Buy Now History (<span id="total_buynow">0</span>)</li>
	  </ul>
	  <ul style="margin-top:10px;margin-left:10px;">
	    <li style="display:inline-block;font-size:12px;font-weight:bold;color:#000;width:120px;">Paid Bids <span id="bids_count"><?php echo $user['final_bids']; ?></span></li>
	    <li style="display:inline-block;font-size:12px;font-weight:bold;color:#000;width:120px;">Free Points <span id="free_bids_count"><?php echo  $user['free_bids'] != "" ? $user['free_bids'] : "0"; ?></span></li>
	  </ul>
      </li>
      <li id="bid_msg" style="font-weight:bold;text-align:center;width:100%;"></li>
    </ul>
  </span>
</div>
<?php } ?>
<div id="video_box">
<h3><em></em> Bidcast</h3>
  <iframe width="280" height="180" src="//www.youtube.com/embed/S0OrTiij3_I?feature=player_detailpage" frameborder="0" allowfullscreen></iframe>
</div>

<ul id="bid_buttons">
  <li><a href="">Earn Bids</a></li>
  <li><a href="">Buy Points</a></li>
</ul>