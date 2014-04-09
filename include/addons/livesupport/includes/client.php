<script type="text/javascript" src="<?php echo $SITE_URL . $livesupportpath; ?>js/support.js"></script>

<?php
// define page functions
function online() {
// globals
global $available,$config,$livesupportpath;
$path=$livesupportpath;
// build box
echo '<div id="status_box" style="width:250px;">';
echo '<h3><img src="'.$path.'images/icons/ls.png" width="50" alt="'.$config['title'].'" title="'.$config['title'].'" style="vertical-align:middle;" /> '.$config['title'].'</h3>';
	if($available == "true") {
		?><div class="ls_available"><a href="javascript:;" onclick="launchSupport('<?php echo $SITE_URL;?><?=$path;?>chat.php', '200', '200', '510', '440')">Online, Click here to begin</a></div> <?
	} else {
		?><div class="ls_unavailable"><a href="javascript:;" onclick="launchSupport('<?php echo $SITE_URL;?><?=$path;?>leavemessage.php', '200', '200', '510', '440')">Currently Unavailable</a></div> <?
		echo '<p>'.$config['offlineMessage'].'</p>';
	}
echo '</div>';
}


function online1() {
// globals
global $available,$config,$livesupportpath;
// build box
$path=$livesupportpath;

//echo '<h3><img src="'.$path.'images/icons/ls.png" width="50" alt="'.$config['title'].'" title="'.$config['title'].'" style="vertical-align:middle;" /> '.$config['title'].'</h3>';
	if($available == "true") {
		?><a href="javascript:;" id="btn-support" onclick="launchSupport('<?php echo $SITE_URL;?><?=$path;?>chat.php', '200', '200', '510', '440')"><span><?php echo LIVE_SUPPORT; ?>:</span> <?php echo ONLINE; ?></a> <?
	} else {
		?><a href="javascript:;" id="btn-support" class="offline" onclick="launchSupport('<?php echo $SITE_URL;?><?=$path;?>leavemessage.php', '200', '200', '510', '440')"><span><?php echo LIVE_SUPPORT; ?>:</span> <?php echo OFFLINE; ?></a> <?
		//echo '<p>'.$config['offlineMessage'].'</p>';
	}

}

// db connection
include "base.php";
// first check to make sure that there is no timed out logins
$agentTimeout = 180;
$check = db_query("SELECT * FROM users ");
while ($row=db_fetch_array($check)) {

	if(strtotime(date("Y-m-d H:i:s")) > ($row['keepAlive'] + $agentTimeout ) ) {
		db_query("UPDATE users SET available = 'no' WHERE username = '".$row['username']."' "); 
	}
}
// check availablility
$available = "false";
$check = db_query("SELECT available FROM users ");
while ($row=db_fetch_array($check)) {
	if($row['available'] == "yes") {
		$available = "true";
	}
}
// get config
$fetch = db_query("SELECT * FROM config ");
$config = db_fetch_array($fetch);

?>

